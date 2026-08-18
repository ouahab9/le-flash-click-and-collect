<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTE DES COMMANDES
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        /*
        |--------------------------------------------------------------------------
        | RÉCUPÉRATION DES FILTRES
        |--------------------------------------------------------------------------
        */

        $search = trim(
            (string) $request->query('search', '')
        );

        $status = $request->query('status');

        $allowedStatuses = [
            'pending',
            'accepted',
            'preparing',
            'ready',
            'picked_up',
            'cancelled',
        ];

        /*
        |--------------------------------------------------------------------------
        | SÉCURISATION DU STATUT
        |--------------------------------------------------------------------------
        */

        if (
            $status !== null &&
            !in_array($status, $allowedStatuses, true)
        ) {
            $status = null;
        }


        /*
        |--------------------------------------------------------------------------
        | REQUÊTE DES COMMANDES
        |--------------------------------------------------------------------------
        */

        $query = Order::with([
            'items',
            'pickupSlot',
        ]);


        /*
        |--------------------------------------------------------------------------
        | RECHERCHE
        |--------------------------------------------------------------------------
        |
        | Recherche par :
        |
        | - numéro de commande
        | - nom du client
        | - téléphone
        |
        */

        if ($search !== '') {

            $query->where(function ($query) use ($search) {

                $query
                    ->where(
                        'order_number',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'customer_name',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'customer_phone',
                        'like',
                        '%' . $search . '%'
                    );
            });
        }


        /*
        |--------------------------------------------------------------------------
        | FILTRE PAR STATUT
        |--------------------------------------------------------------------------
        */

        if ($status) {

            $query->where(
                'status',
                $status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $orders = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | COMPTEURS
        |--------------------------------------------------------------------------
        |
        | Les compteurs restent globaux.
        |
        | Exemple :
        |
        | Toutes       15
        | En attente    4
        | Acceptées     2
        | Préparation   3
        | Prêtes        2
        | Retirées      3
        | Annulées      1
        |
        */

        $counts = [
            'all' => Order::count(),

            'pending' => Order::where(
                'status',
                'pending'
            )->count(),

            'accepted' => Order::where(
                'status',
                'accepted'
            )->count(),

            'preparing' => Order::where(
                'status',
                'preparing'
            )->count(),

            'ready' => Order::where(
                'status',
                'ready'
            )->count(),

            'picked_up' => Order::where(
                'status',
                'picked_up'
            )->count(),

            'cancelled' => Order::where(
                'status',
                'cancelled'
            )->count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | ENVOI À LA VUE
        |--------------------------------------------------------------------------
        */

        return view('admin.orders.index', [
            'orders' => $orders,
            'search' => $search,
            'status' => $status,
            'counts' => $counts,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | DÉTAIL D'UNE COMMANDE
    |--------------------------------------------------------------------------
    */

    public function show(Order $order): View
    {
        $order->load([
            'items',
            'pickupSlot',
        ]);

        return view('admin.orders.show', [
            'order' => $order,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | MODIFICATION DU STATUT
    |--------------------------------------------------------------------------
    */

    public function updateStatus(
        Request $request,
        Order $order
    ): RedirectResponse {

        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,accepted,preparing,ready,picked_up,cancelled',
            ],
        ]);

        $newStatus = $validated['status'];


        try {

            DB::transaction(function () use (
                $order,
                $newStatus
            ) {

                /*
                |--------------------------------------------------------------------------
                | VERROUILLAGE DE LA COMMANDE
                |--------------------------------------------------------------------------
                */

                $lockedOrder = Order::where(
                    'id',
                    $order->id
                )
                    ->lockForUpdate()
                    ->firstOrFail();


                $oldStatus = $lockedOrder->status;


                /*
                |--------------------------------------------------------------------------
                | AUCUN CHANGEMENT
                |--------------------------------------------------------------------------
                */

                if ($oldStatus === $newStatus) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | ANNULATION
                |--------------------------------------------------------------------------
                |
                | Si une commande est annulée,
                | on remet automatiquement les produits en stock.
                |
                */

                if (
                    $oldStatus !== 'cancelled' &&
                    $newStatus === 'cancelled'
                ) {

                    $lockedOrder->load('items');


                    foreach ($lockedOrder->items as $item) {

                        if (!$item->product_id) {
                            continue;
                        }


                        $product = Product::where(
                            'id',
                            $item->product_id
                        )
                            ->lockForUpdate()
                            ->first();


                        if (!$product) {
                            continue;
                        }


                        $product->increment(
                            'stock',
                            $item->quantity
                        );
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | INTERDICTION DE RÉACTIVER UNE COMMANDE ANNULÉE
                |--------------------------------------------------------------------------
                */

                if (
                    $oldStatus === 'cancelled' &&
                    $newStatus !== 'cancelled'
                ) {

                    throw new \Exception(
                        'Une commande annulée ne peut pas être réactivée.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | MISE À JOUR DU STATUT
                |--------------------------------------------------------------------------
                */

                $lockedOrder->update([
                    'status' => $newStatus,
                ]);
            });


        } catch (\Throwable $exception) {

            return back()->with(
                'error',
                $exception->getMessage()
            );
        }


        /*
        |--------------------------------------------------------------------------
        | MESSAGE DE CONFIRMATION
        |--------------------------------------------------------------------------
        */

        if ($newStatus === 'cancelled') {

            return back()->with(
                'success',
                'Commande annulée. Les produits ont été remis en stock.'
            );
        }


        return back()->with(
            'success',
            'Statut de la commande mis à jour.'
        );
    }
}