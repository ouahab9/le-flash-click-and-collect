<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PickupSlotController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderTrackingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| SITE CLIENT — PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [CatalogController::class, 'index'])
    ->name('catalog.index');

/*
|--------------------------------------------------------------------------
| PANIER
|--------------------------------------------------------------------------
*/

Route::get('/panier', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/panier/ajouter/{product}', [CartController::class, 'add'])
    ->name('cart.add');

Route::patch('/panier/modifier/{product}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/panier/supprimer/{product}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::delete('/panier/vider', [CartController::class, 'clear'])
    ->name('cart.clear');

/*
|--------------------------------------------------------------------------
| COMMANDE CLIENT
|--------------------------------------------------------------------------
*/

Route::get('/commande', [CheckoutController::class, 'create'])
    ->name('checkout.index');

Route::post('/commande', [CheckoutController::class, 'store'])
    ->name('checkout.store');

Route::get(
    '/commande/succes/{order}',
    [CheckoutController::class, 'success']
)
    ->name('checkout.success');

/*
|--------------------------------------------------------------------------
| SUIVI DE COMMANDE
|--------------------------------------------------------------------------
*/

Route::get(
    '/suivi',
    [OrderTrackingController::class, 'index']
)
    ->name('tracking.index');

Route::post(
    '/suivi',
    [OrderTrackingController::class, 'search']
)
    ->name('tracking.search');

/*
|--------------------------------------------------------------------------
| SUIVI AUTOMATIQUE DU STATUT
|--------------------------------------------------------------------------
|
| Cette route est appelée automatiquement par JavaScript
| depuis la page de suivi.
|
*/

Route::post(
    '/suivi/statut',
    [OrderTrackingController::class, 'status']
)
    ->name('tracking.status');

/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
*/

Route::get(
    '/dashboard',
    [DashboardController::class, 'index']
)
    ->middleware([
        'auth',
        'admin',
    ])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMINISTRATION
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'admin',
])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | COMMANDES
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/commandes',
            [OrderController::class, 'index']
        )
            ->name('orders.index');

        Route::get(
            '/commandes/{order}',
            [OrderController::class, 'show']
        )
            ->name('orders.show');

        Route::patch(
            '/commandes/{order}/statut',
            [OrderController::class, 'updateStatus']
        )
            ->name('orders.status');

        /*
        |--------------------------------------------------------------------------
        | MODIFICATION RAPIDE DU STOCK
        |--------------------------------------------------------------------------
        */

        Route::patch(
            '/produits/{product}/stock',
            [ProductController::class, 'updateStock']
        )
            ->name('products.stock');

        /*
        |--------------------------------------------------------------------------
        | PRODUITS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'produits',
            ProductController::class
        )
            ->parameters([
                'produits' => 'product',
            ])
            ->names('products');

        /*
        |--------------------------------------------------------------------------
        | CATÉGORIES
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'categories',
            CategoryController::class
        )
            ->parameters([
                'categories' => 'category',
            ])
            ->names('categories');

        /*
        |--------------------------------------------------------------------------
        | CRÉNEAUX
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'creneaux',
            PickupSlotController::class
        )
            ->parameters([
                'creneaux' => 'pickupSlot',
            ])
            ->names('pickup-slots');
    });

/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
