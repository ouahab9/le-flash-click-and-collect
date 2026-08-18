<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = now()->toDateString();

        /*
        |--------------------------------------------------------------------------
        | COMMANDES DU JOUR
        |--------------------------------------------------------------------------
        */

        $ordersToday = Order::whereDate(
            'created_at',
            $today
        )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | CHIFFRE D'AFFAIRES DU JOUR
        |--------------------------------------------------------------------------
        */

        $revenueToday = Order::whereDate(
            'created_at',
            $today
        )
            ->where(
                'status',
                '!=',
                'cancelled'
            )
            ->sum('total');

        /*
        |--------------------------------------------------------------------------
        | COMMANDES EN ATTENTE
        |--------------------------------------------------------------------------
        */

        $pendingOrders = Order::where(
            'status',
            'pending'
        )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | COMMANDES ACCEPTÉES
        |--------------------------------------------------------------------------
        */

        $acceptedOrders = Order::where(
            'status',
            'accepted'
        )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | COMMANDES EN PRÉPARATION
        |--------------------------------------------------------------------------
        */

        $preparingOrders = Order::where(
            'status',
            'preparing'
        )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | COMMANDES PRÊTES
        |--------------------------------------------------------------------------
        */

        $readyOrders = Order::where(
            'status',
            'ready'
        )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | RETRAITS PRÉVUS AUJOURD'HUI
        |--------------------------------------------------------------------------
        */

        $pickupsToday = Order::whereDate(
            'pickup_date',
            $today
        )
            ->whereNotIn(
                'status',
                [
                    'cancelled',
                    'picked_up',
                ]
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | COMMANDES À TRAITER
        |--------------------------------------------------------------------------
        |
        | En attente + acceptées + préparation.
        |
        */

        $ordersToProcess =
            $pendingOrders
            +
            $acceptedOrders
            +
            $preparingOrders;

        /*
        |--------------------------------------------------------------------------
        | PRODUITS ACTIFS
        |--------------------------------------------------------------------------
        */

        $activeProducts = Product::where(
            'active',
            true
        )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | NOMBRE TOTAL DE PRODUITS EN STOCK FAIBLE
        |--------------------------------------------------------------------------
        */

        $lowStockCount = Product::where(
            'active',
            true
        )
            ->whereBetween(
                'stock',
                [1, 5]
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | LISTE STOCK FAIBLE
        |--------------------------------------------------------------------------
        */

        $lowStockProducts = Product::with(
            'category'
        )
            ->where(
                'active',
                true
            )
            ->whereBetween(
                'stock',
                [1, 5]
            )
            ->orderBy('stock')
            ->orderBy('name')
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RUPTURES
        |--------------------------------------------------------------------------
        */

        $outOfStockProducts = Product::where(
            'active',
            true
        )
            ->where(
                'stock',
                '<=',
                0
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | DERNIÈRES COMMANDES
        |--------------------------------------------------------------------------
        */

        $latestOrders = Order::with([
            'pickupSlot',
            'items',
        ])
            ->latest()
            ->take(8)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | COMMANDES URGENTES
        |--------------------------------------------------------------------------
        |
        | Priorité aux commandes en attente,
        | acceptées et en préparation.
        |
        */

        $urgentOrders = Order::with([
            'pickupSlot',
        ])
            ->whereIn(
                'status',
                [
                    'pending',
                    'accepted',
                    'preparing',
                ]
            )
            ->orderBy('pickup_date')
            ->orderBy('pickup_time')
            ->take(6)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TOTAL COMMANDES
        |--------------------------------------------------------------------------
        */

        $totalOrders = Order::count();

        /*
        |--------------------------------------------------------------------------
        | CA TOTAL
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Order::where(
            'status',
            '!=',
            'cancelled'
        )
            ->sum('total');

        /*
        |--------------------------------------------------------------------------
        | PANIER MOYEN
        |--------------------------------------------------------------------------
        */

        $validOrdersCount = Order::where(
            'status',
            '!=',
            'cancelled'
        )
            ->count();

        $averageOrderValue =
            $validOrdersCount > 0
                ? $totalRevenue / $validOrdersCount
                : 0;

        /*
        |--------------------------------------------------------------------------
        | VUE
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard',
            [
                'ordersToday' => $ordersToday,

                'revenueToday' => $revenueToday,

                'pendingOrders' => $pendingOrders,

                'acceptedOrders' => $acceptedOrders,

                'preparingOrders' => $preparingOrders,

                'readyOrders' => $readyOrders,

                'pickupsToday' => $pickupsToday,

                'ordersToProcess' => $ordersToProcess,

                'activeProducts' => $activeProducts,

                'lowStockCount' => $lowStockCount,

                'lowStockProducts' => $lowStockProducts,

                'outOfStockProducts' => $outOfStockProducts,

                'latestOrders' => $latestOrders,

                'urgentOrders' => $urgentOrders,

                'totalOrders' => $totalOrders,

                'totalRevenue' => $totalRevenue,

                'averageOrderValue' => $averageOrderValue,
            ]
        );
    }
}
