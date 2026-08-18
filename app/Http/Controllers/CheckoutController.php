<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PickupSlot;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class CheckoutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AFFICHER LE CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function create(
        Request $request
    ): View|RedirectResponse {

        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('catalog.index')
                ->with(
                    'error',
                    'Votre panier est vide.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | PRODUITS DU PANIER
        |--------------------------------------------------------------------------
        */

        $productIds = collect($cart)
            ->pluck('product_id')
            ->filter()
            ->map(
                fn ($id) => (int) $id
            )
            ->unique()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | PRODUITS 18+
        |--------------------------------------------------------------------------
        */

        $hasAgeRestrictedProducts = Product::whereIn(
            'id',
            $productIds
        )
            ->where('age_restricted', true)
            ->exists();


        /*
        |--------------------------------------------------------------------------
        | CRÉNEAUX DISPONIBLES
        |--------------------------------------------------------------------------
        */

        $slots = PickupSlot::where('active', true)
            ->whereDate(
                'date',
                '>=',
                now()->toDateString()
            )
            ->orderBy('date')
            ->orderBy('start_time')
            ->get()
            ->filter(function ($slot) {

                $ordersCount = $slot->orders()
                    ->where(
                        'status',
                        '!=',
                        'cancelled'
                    )
                    ->count();

                return $ordersCount
                    < $slot->max_orders;
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | TOTAL AFFICHÉ
        |--------------------------------------------------------------------------
        */

        $total = 0;

        foreach ($cart as $item) {

            $product = Product::find(
                (int) $item['product_id']
            );

            if (!$product) {
                continue;
            }

            $total +=
                (float) $product->price
                * (int) $item['quantity'];
        }


        return view('checkout.index', [
            'cart' => $cart,
            'slots' => $slots,
            'total' => $total,
            'hasAgeRestrictedProducts' =>
                $hasAgeRestrictedProducts,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ENREGISTRER LA COMMANDE
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request
    ): RedirectResponse {

        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('catalog.index')
                ->with(
                    'error',
                    'Votre panier est vide.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | PRODUITS DU PANIER
        |--------------------------------------------------------------------------
        */

        $productIds = collect($cart)
            ->pluck('product_id')
            ->filter()
            ->map(
                fn ($id) => (int) $id
            )
            ->unique()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | PRODUITS 18+
        |--------------------------------------------------------------------------
        */

        $hasAgeRestrictedProduct =
            Product::whereIn(
                'id',
                $productIds
            )
                ->where(
                    'age_restricted',
                    true
                )
                ->exists();


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $rules = [
            'customer_name' => [
                'required',
                'string',
                'max:255',
            ],

            'customer_phone' => [
                'required',
                'string',
                'max:30',
            ],

            'pickup_slot_id' => [
                'required',
                'integer',
                'exists:pickup_slots,id',
            ],
        ];


        if ($hasAgeRestrictedProduct) {
            $rules['age_confirmed'] = [
                'required',
                'accepted',
            ];
        }


        $validated = $request->validate(
            $rules,
            [
                'customer_name.required' =>
                    'Veuillez renseigner votre nom.',

                'customer_phone.required' =>
                    'Veuillez renseigner votre numéro de téléphone.',

                'pickup_slot_id.required' =>
                    'Veuillez sélectionner un créneau de retrait.',

                'age_confirmed.required' =>
                    'Vous devez confirmer avoir au moins 18 ans.',

                'age_confirmed.accepted' =>
                    'Vous devez confirmer avoir au moins 18 ans.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | NORMALISATION DU TÉLÉPHONE
        |--------------------------------------------------------------------------
        */

        $normalizedPhone = $this->normalizePhone(
            $validated['customer_phone']
        );


        if (!$normalizedPhone) {

            return back()
                ->withErrors([
                    'customer_phone' =>
                        'Veuillez saisir un numéro de téléphone français valide.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | TRANSACTION
        |--------------------------------------------------------------------------
        */

        try {

            $order = DB::transaction(
                function () use (
                    $cart,
                    $validated,
                    $normalizedPhone
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | CRÉNEAU VERROUILLÉ
                    |--------------------------------------------------------------------------
                    */

                    $slot = PickupSlot::where(
                        'id',
                        $validated['pickup_slot_id']
                    )
                        ->lockForUpdate()
                        ->first();


                    if (!$slot) {
                        throw new \RuntimeException(
                            'Ce créneau n’existe plus.'
                        );
                    }


                    if (!$slot->active) {
                        throw new \RuntimeException(
                            'Ce créneau n’est plus disponible.'
                        );
                    }


                    if (
                        $slot->date->lt(
                            now()->startOfDay()
                        )
                    ) {
                        throw new \RuntimeException(
                            'Ce créneau est déjà passé.'
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | CAPACITÉ DU CRÉNEAU
                    |--------------------------------------------------------------------------
                    */

                    $ordersCount = $slot->orders()
                        ->where(
                            'status',
                            '!=',
                            'cancelled'
                        )
                        ->count();


                    if (
                        $ordersCount
                        >= $slot->max_orders
                    ) {
                        throw new \RuntimeException(
                            'Ce créneau est maintenant complet.'
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | PRODUITS VERROUILLÉS
                    |--------------------------------------------------------------------------
                    */

                    $lockedProducts = [];


                    foreach ($cart as $item) {

                        if (
                            empty($item['product_id'])
                        ) {
                            throw new \RuntimeException(
                                'Un produit du panier est invalide.'
                            );
                        }


                        $productId =
                            (int) $item['product_id'];

                        $quantity =
                            (int) $item['quantity'];


                        if ($quantity < 1) {
                            throw new \RuntimeException(
                                'Une quantité du panier est invalide.'
                            );
                        }


                        $product = Product::where(
                            'id',
                            $productId
                        )
                            ->lockForUpdate()
                            ->first();


                        if (!$product) {
                            throw new \RuntimeException(
                                'Un produit de votre panier n’existe plus.'
                            );
                        }


                        if (!$product->active) {
                            throw new \RuntimeException(
                                'Le produit "' .
                                $product->name .
                                '" n’est plus disponible.'
                            );
                        }


                        if (
                            $product->stock
                            < $quantity
                        ) {
                            throw new \RuntimeException(
                                'Stock insuffisant pour "' .
                                $product->name .
                                '". Disponible : ' .
                                $product->stock .
                                ' unité(s).'
                            );
                        }


                        $lockedProducts[] = [
                            'product' => $product,
                            'quantity' => $quantity,
                        ];
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | TOTAL RÉEL
                    |--------------------------------------------------------------------------
                    */

                    $total = 0;


                    foreach (
                        $lockedProducts as $data
                    ) {

                        $total +=
                            (float)
                            $data['product']->price
                            * $data['quantity'];
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | NUMÉRO UNIQUE
                    |--------------------------------------------------------------------------
                    */

                    do {

                        $orderNumber =
                            'FLASH-' .
                            strtoupper(
                                Str::random(8)
                            );

                    } while (
                        Order::where(
                            'order_number',
                            $orderNumber
                        )->exists()
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | CRÉATION COMMANDE
                    |--------------------------------------------------------------------------
                    */

                    $order = Order::create([
                        'pickup_slot_id' =>
                            $slot->id,

                        'order_number' =>
                            $orderNumber,

                        'customer_name' =>
                            trim(
                                $validated[
                                    'customer_name'
                                ]
                            ),

                        /*
                        | Le téléphone est enregistré
                        | sous une forme unique :
                        |
                        | 0612345678
                        */

                        'customer_phone' =>
                            $normalizedPhone,

                        'status' =>
                            'pending',

                        'pickup_date' =>
                            $slot->date,

                        'pickup_time' =>
                            $slot->start_time,

                        'total' =>
                            $total,
                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | ARTICLES + STOCK
                    |--------------------------------------------------------------------------
                    */

                    foreach (
                        $lockedProducts as $data
                    ) {

                        $product =
                            $data['product'];

                        $quantity =
                            $data['quantity'];

                        $unitPrice =
                            (float) $product->price;


                        OrderItem::create([
                            'order_id' =>
                                $order->id,

                            'product_id' =>
                                $product->id,

                            'product_name' =>
                                $product->name,

                            'quantity' =>
                                $quantity,

                            'unit_price' =>
                                $unitPrice,

                            'total_price' =>
                                $unitPrice * $quantity,
                        ]);


                        $product->stock -=
                            $quantity;

                        $product->save();
                    }


                    return $order;
                },
                5
            );


        } catch (Throwable $exception) {

            report($exception);

            return redirect()
                ->route('checkout.index')
                ->withInput()
                ->with(
                    'error',
                    $exception->getMessage()
                );
        }


        /*
        |--------------------------------------------------------------------------
        | PANIER VIDÉ
        |--------------------------------------------------------------------------
        */

        $request->session()->forget('cart');


        return redirect()
            ->route(
                'checkout.success',
                $order
            )
            ->with(
                'success',
                'Votre commande a été enregistrée.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | CONFIRMATION
    |--------------------------------------------------------------------------
    */

    public function success(
        Order $order
    ): View {

        $order->load([
            'items',
            'pickupSlot',
        ]);


        return view(
            'checkout.success',
            [
                'order' => $order,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | NORMALISER UN NUMÉRO DE TÉLÉPHONE FRANÇAIS
    |--------------------------------------------------------------------------
    |
    | Accepté :
    |
    | 06 12 34 56 78
    | 0612345678
    | 06.12.34.56.78
    | 06-12-34-56-78
    | +33 6 12 34 56 78
    | 0033 6 12 34 56 78
    |
    | Stocké :
    |
    | 0612345678
    |
    */

    private function normalizePhone(
        string $phone
    ): ?string {

        /*
        | Supprime espaces,
        | points, tirets, parenthèses...
        */

        $phone = preg_replace(
            '/[^0-9+]/',
            '',
            trim($phone)
        );


        if (!$phone) {
            return null;
        }


        /*
        |--------------------------------------------------------------------------
        | 0033XXXXXXXXX
        |--------------------------------------------------------------------------
        */

        if (
            str_starts_with(
                $phone,
                '0033'
            )
        ) {
            $phone =
                '0' .
                substr(
                    $phone,
                    4
                );
        }


        /*
        |--------------------------------------------------------------------------
        | +33XXXXXXXXX
        |--------------------------------------------------------------------------
        */

        elseif (
            str_starts_with(
                $phone,
                '+33'
            )
        ) {
            $phone =
                '0' .
                substr(
                    $phone,
                    3
                );
        }


        /*
        |--------------------------------------------------------------------------
        | FORMAT FRANÇAIS
        |--------------------------------------------------------------------------
        |
        | 10 chiffres
        | commence par 0
        |
        */

        if (
            !preg_match(
                '/^0[1-9][0-9]{8}$/',
                $phone
            )
        ) {
            return null;
        }


        return $phone;
    }
}