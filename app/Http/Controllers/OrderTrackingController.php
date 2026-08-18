<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderTrackingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PAGE DE SUIVI
    |--------------------------------------------------------------------------
    */

    public function index(): View
    {
        return view('tracking.index');
    }

    /*
    |--------------------------------------------------------------------------
    | RECHERCHER UNE COMMANDE
    |--------------------------------------------------------------------------
    */

    public function search(
        Request $request
    ): View {

        $validated = $request->validate([
            'order_number' => [
                'required',
                'string',
                'max:50',
            ],

            'customer_phone' => [
                'required',
                'string',
                'max:30',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | NUMÉRO DE COMMANDE
        |--------------------------------------------------------------------------
        */

        $orderNumber = strtoupper(
            trim(
                $validated[
                    'order_number'
                ]
            )
        );

        /*
        |--------------------------------------------------------------------------
        | TÉLÉPHONE NORMALISÉ
        |--------------------------------------------------------------------------
        */

        $customerPhone =
            $this->normalizePhone(
                $validated[
                    'customer_phone'
                ]
            );

        /*
        |--------------------------------------------------------------------------
        | TÉLÉPHONE INCORRECT
        |--------------------------------------------------------------------------
        */

        if (! $customerPhone) {

            return view(
                'tracking.index',
                [
                    'order' => null,
                    'searched' => true,
                ]
            )
                ->withErrors([
                    'customer_phone' => 'Numéro de téléphone invalide.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | RECHERCHE
        |--------------------------------------------------------------------------
        */

        $order = Order::with([
            'items',
            'pickupSlot',
        ])
            ->where(
                'order_number',
                $orderNumber
            )
            ->where(
                'customer_phone',
                $customerPhone
            )
            ->first();

        return view(
            'tracking.index',
            [
                'order' => $order,
                'searched' => true,
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STATUT AUTOMATIQUE
    |--------------------------------------------------------------------------
    */

    public function status(
        Request $request
    ): JsonResponse {

        $validated = $request->validate([
            'order_number' => [
                'required',
                'string',
                'max:50',
            ],

            'customer_phone' => [
                'required',
                'string',
                'max:30',
            ],
        ]);

        $orderNumber = strtoupper(
            trim(
                $validated[
                    'order_number'
                ]
            )
        );

        $customerPhone =
            $this->normalizePhone(
                $validated[
                    'customer_phone'
                ]
            );

        if (! $customerPhone) {

            return response()->json([
                'found' => false,
            ], 422);
        }

        $order = Order::where(
            'order_number',
            $orderNumber
        )
            ->where(
                'customer_phone',
                $customerPhone
            )
            ->first();

        if (! $order) {

            return response()->json([
                'found' => false,
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | NOM DU STATUT
        |--------------------------------------------------------------------------
        */

        $statusLabel = match (
            $order->status
        ) {

            'pending' => 'En attente',

            'accepted' => 'Acceptée',

            'preparing' => 'En préparation',

            'ready' => 'Prête à retirer',

            'picked_up' => 'Retirée',

            'cancelled' => 'Annulée',

            default => $order->status,
        };

        /*
        |--------------------------------------------------------------------------
        | DESCRIPTION
        |--------------------------------------------------------------------------
        */

        $statusDescription = match (
            $order->status
        ) {

            'pending' => 'Votre commande a bien été reçue. Elle attend maintenant la validation du magasin.',

            'accepted' => 'Votre commande a été acceptée par Le Flash. Elle sera bientôt préparée.',

            'preparing' => 'Votre commande est actuellement en préparation. Nous rassemblons vos produits.',

            'ready' => 'Votre commande est prête. Vous pouvez venir la récupérer pendant votre créneau.',

            'picked_up' => 'Cette commande a été retirée. Merci pour votre commande.',

            'cancelled' => 'Cette commande a été annulée.',

            default => '',
        };

        return response()->json([
            'found' => true,

            'status' => $order->status,

            'status_label' => $statusLabel,

            'status_description' => $statusDescription,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | NORMALISER LE TÉLÉPHONE
    |--------------------------------------------------------------------------
    */

    private function normalizePhone(
        string $phone
    ): ?string {

        $phone = preg_replace(
            '/[^0-9+]/',
            '',
            trim($phone)
        );

        if (! $phone) {
            return null;
        }

        if (
            str_starts_with(
                $phone,
                '0033'
            )
        ) {

            $phone =
                '0'.
                substr(
                    $phone,
                    4
                );
        } elseif (
            str_starts_with(
                $phone,
                '+33'
            )
        ) {

            $phone =
                '0'.
                substr(
                    $phone,
                    3
                );
        }

        if (
            ! preg_match(
                '/^0[1-9][0-9]{8}$/',
                $phone
            )
        ) {
            return null;
        }

        return $phone;
    }
}
