<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AFFICHER LE PANIER
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        /*
        |--------------------------------------------------------------------------
        | Vérifier si le panier contient au moins un produit 18+
        |--------------------------------------------------------------------------
        */

        $hasAgeRestrictedProducts = collect($cart)->contains(function ($item) {
            return ! empty($item['age_restricted']);
        });

        /*
        |--------------------------------------------------------------------------
        | Compatibilité avec les anciens produits déjà présents en session
        |--------------------------------------------------------------------------
        |
        | Si le panier a été créé avant l'ajout de "age_restricted",
        | on vérifie directement dans la base de données.
        |
        */

        if (! $hasAgeRestrictedProducts && ! empty($cart)) {

            $productIds = collect($cart)
                ->pluck('product_id')
                ->filter()
                ->values();

            if ($productIds->isNotEmpty()) {

                $hasAgeRestrictedProducts = Product::whereIn(
                    'id',
                    $productIds
                )
                    ->where('age_restricted', true)
                    ->exists();
            }
        }

        return view('cart.index', [
            'cart' => $cart,
            'total' => $total,
            'hasAgeRestrictedProducts' => $hasAgeRestrictedProducts,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | AJOUTER UN PRODUIT
    |--------------------------------------------------------------------------
    */

    public function add(
        Request $request,
        Product $product
    ): RedirectResponse {

        if (! $product->active || $product->stock <= 0) {

            return back()->with(
                'error',
                'Ce produit n’est plus disponible.'
            );
        }

        $cart = $request->session()->get('cart', []);

        $productId = (string) $product->id;

        /*
        |--------------------------------------------------------------------------
        | Produit déjà dans le panier
        |--------------------------------------------------------------------------
        */

        if (isset($cart[$productId])) {

            if (
                $cart[$productId]['quantity']
                >= $product->stock
            ) {

                return back()->with(
                    'error',
                    'La quantité maximale disponible est atteinte.'
                );
            }

            $cart[$productId]['quantity']++;

            /*
            | Met à jour l'information 18+
            | même pour un ancien panier.
            */

            $cart[$productId]['age_restricted'] =
                (bool) $product->age_restricted;
        }

        /*
        |--------------------------------------------------------------------------
        | Nouveau produit
        |--------------------------------------------------------------------------
        */

        else {

            $cart[$productId] = [

                'product_id' => $product->id,

                'name' => $product->name,

                'price' => (float) $product->price,

                'quantity' => 1,

                'image' => $product->image,

                'age_restricted' => (bool) $product->age_restricted,
            ];
        }

        $request->session()->put('cart', $cart);

        return back()->with(
            'success',
            'Produit ajouté au panier.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | MODIFIER LA QUANTITÉ
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Product $product
    ): RedirectResponse {

        $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $cart = $request->session()->get('cart', []);

        $productId = (string) $product->id;

        if (! isset($cart[$productId])) {

            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Produit absent du panier.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Vérifier le stock
        |--------------------------------------------------------------------------
        */

        if ($product->stock <= 0) {

            unset($cart[$productId]);

            $request->session()->put(
                'cart',
                $cart
            );

            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Ce produit n’est plus disponible.'
                );
        }

        $quantity = min(
            (int) $request->quantity,
            $product->stock
        );

        $cart[$productId]['quantity'] =
            $quantity;

        /*
        |--------------------------------------------------------------------------
        | Synchroniser l'information 18+
        |--------------------------------------------------------------------------
        */

        $cart[$productId]['age_restricted'] =
            (bool) $product->age_restricted;

        $request->session()->put(
            'cart',
            $cart
        );

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Quantité mise à jour.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SUPPRIMER UN PRODUIT
    |--------------------------------------------------------------------------
    */

    public function remove(
        Request $request,
        Product $product
    ): RedirectResponse {

        $cart = $request->session()->get(
            'cart',
            []
        );

        $productId = (string) $product->id;

        unset($cart[$productId]);

        $request->session()->put(
            'cart',
            $cart
        );

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Produit supprimé du panier.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | VIDER LE PANIER
    |--------------------------------------------------------------------------
    */

    public function clear(
        Request $request
    ): RedirectResponse {

        $request->session()->forget('cart');

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Panier vidé.'
            );
    }
}
