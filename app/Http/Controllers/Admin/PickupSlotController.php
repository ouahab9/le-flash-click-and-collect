<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PickupSlot;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PickupSlotController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTE DES CRÉNEAUX
    |--------------------------------------------------------------------------
    */

    public function index(): View
    {
        $pickupSlots = PickupSlot::withCount([
            'orders as active_orders_count' => function ($query) {
                $query->where('status', '!=', 'cancelled');
            },
        ])
            ->orderBy('date')
            ->orderBy('start_time')
            ->paginate(20);

        return view('admin.pickup-slots.index', [
            'pickupSlots' => $pickupSlots,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | CRÉATION
    |--------------------------------------------------------------------------
    */

    public function create(): View
    {
        return view('admin.pickup-slots.create');
    }


    /*
    |--------------------------------------------------------------------------
    | ENREGISTRER UN CRÉNEAU
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request
    ): RedirectResponse {

        $validated = $request->validate(
            [
                'date' => [
                    'required',
                    'date',
                ],

                'start_time' => [
                    'required',
                    'date_format:H:i',
                ],

                'end_time' => [
                    'required',
                    'date_format:H:i',
                    'after:start_time',
                ],

                'max_orders' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:500',
                ],

                'active' => [
                    'nullable',
                    'boolean',
                ],
            ],
            [
                'date.required' =>
                    'La date du créneau est obligatoire.',

                'start_time.required' =>
                    'L’heure de début est obligatoire.',

                'end_time.required' =>
                    'L’heure de fin est obligatoire.',

                'end_time.after' =>
                    'L’heure de fin doit être après l’heure de début.',

                'max_orders.required' =>
                    'Le nombre maximum de commandes est obligatoire.',

                'max_orders.min' =>
                    'Le créneau doit accepter au moins une commande.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | VÉRIFIER QUE LE CRÉNEAU N'EST PAS DANS LE PASSÉ
        |--------------------------------------------------------------------------
        */

        $slotStart = Carbon::parse(
            $validated['date'] .
            ' ' .
            $validated['start_time']
        );


        if ($slotStart->isPast()) {

            return back()
                ->withErrors([
                    'date' =>
                        'Impossible de créer un créneau déjà passé.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | ÉVITER LES DOUBLONS EXACTS
        |--------------------------------------------------------------------------
        */

        $alreadyExists = PickupSlot::whereDate(
            'date',
            $validated['date']
        )
            ->where(
                'start_time',
                $validated['start_time']
            )
            ->where(
                'end_time',
                $validated['end_time']
            )
            ->exists();


        if ($alreadyExists) {

            return back()
                ->withErrors([
                    'start_time' =>
                        'Un créneau identique existe déjà.',
                ])
                ->withInput();
        }


        $validated['active'] =
            $request->boolean('active');


        PickupSlot::create(
            $validated
        );


        return redirect()
            ->route('admin.pickup-slots.index')
            ->with(
                'success',
                'Créneau créé avec succès.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | AFFICHER UN CRÉNEAU
    |--------------------------------------------------------------------------
    */

    public function show(
        PickupSlot $pickupSlot
    ): View {

        $pickupSlot->load([
            'orders',
        ]);


        return view(
            'admin.pickup-slots.show',
            [
                'pickupSlot' =>
                    $pickupSlot,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | MODIFIER UN CRÉNEAU
    |--------------------------------------------------------------------------
    */

    public function edit(
        PickupSlot $pickupSlot
    ): View {

        return view(
            'admin.pickup-slots.edit',
            [
                'pickupSlot' =>
                    $pickupSlot,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ENREGISTRER LES MODIFICATIONS
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        PickupSlot $pickupSlot
    ): RedirectResponse {

        $validated = $request->validate(
            [
                'date' => [
                    'required',
                    'date',
                ],

                'start_time' => [
                    'required',
                    'date_format:H:i',
                ],

                'end_time' => [
                    'required',
                    'date_format:H:i',
                    'after:start_time',
                ],

                'max_orders' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:500',
                ],

                'active' => [
                    'nullable',
                    'boolean',
                ],
            ],
            [
                'end_time.after' =>
                    'L’heure de fin doit être après l’heure de début.',

                'max_orders.min' =>
                    'Le créneau doit accepter au moins une commande.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | NOMBRE DE COMMANDES ACTIVES DÉJÀ PRÉSENTES
        |--------------------------------------------------------------------------
        */

        $activeOrdersCount =
            $pickupSlot->orders()
                ->where(
                    'status',
                    '!=',
                    'cancelled'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | EMPÊCHER UNE CAPACITÉ INFÉRIEURE AUX COMMANDES EXISTANTES
        |--------------------------------------------------------------------------
        */

        if (
            (int) $validated['max_orders']
            < $activeOrdersCount
        ) {

            return back()
                ->withErrors([
                    'max_orders' =>
                        'Ce créneau contient déjà ' .
                        $activeOrdersCount .
                        ' commande(s). La capacité ne peut pas être inférieure.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | DATE / HEURE DU NOUVEAU CRÉNEAU
        |--------------------------------------------------------------------------
        */

        $newSlotStart = Carbon::parse(
            $validated['date'] .
            ' ' .
            $validated['start_time']
        );


        /*
        |--------------------------------------------------------------------------
        | SI LE CRÉNEAU EST DÉJÀ PASSÉ
        |--------------------------------------------------------------------------
        |
        | On autorise uniquement la désactivation.
        |
        */

        $currentSlotStart = Carbon::parse(
            $pickupSlot->date->format('Y-m-d') .
            ' ' .
            $pickupSlot->start_time
        );


        if (
            $currentSlotStart->isPast()
            &&
            (
                $validated['date']
                    !== $pickupSlot->date->format('Y-m-d')
                ||
                substr(
                    $validated['start_time'],
                    0,
                    5
                ) !== substr(
                    $pickupSlot->start_time,
                    0,
                    5
                )
                ||
                substr(
                    $validated['end_time'],
                    0,
                    5
                ) !== substr(
                    $pickupSlot->end_time,
                    0,
                    5
                )
            )
        ) {

            return back()
                ->withErrors([
                    'date' =>
                        'Un créneau déjà passé ne peut plus être déplacé.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | EMPÊCHER DE DÉPLACER UN CRÉNEAU VERS LE PASSÉ
        |--------------------------------------------------------------------------
        */

        if (
            !$currentSlotStart->isPast()
            &&
            $newSlotStart->isPast()
        ) {

            return back()
                ->withErrors([
                    'date' =>
                        'Impossible de déplacer ce créneau dans le passé.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | ÉVITER LES DOUBLONS
        |--------------------------------------------------------------------------
        */

        $alreadyExists = PickupSlot::where(
            'id',
            '!=',
            $pickupSlot->id
        )
            ->whereDate(
                'date',
                $validated['date']
            )
            ->where(
                'start_time',
                $validated['start_time']
            )
            ->where(
                'end_time',
                $validated['end_time']
            )
            ->exists();


        if ($alreadyExists) {

            return back()
                ->withErrors([
                    'start_time' =>
                        'Un créneau identique existe déjà.',
                ])
                ->withInput();
        }


        $validated['active'] =
            $request->boolean('active');


        $pickupSlot->update(
            $validated
        );


        return redirect()
            ->route('admin.pickup-slots.index')
            ->with(
                'success',
                'Créneau modifié avec succès.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SUPPRIMER UN CRÉNEAU
    |--------------------------------------------------------------------------
    */

    public function destroy(
        PickupSlot $pickupSlot
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | NE JAMAIS SUPPRIMER UN CRÉNEAU UTILISÉ
        |--------------------------------------------------------------------------
        */

        if (
            $pickupSlot->orders()->exists()
        ) {

            return redirect()
                ->route('admin.pickup-slots.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce créneau car il est associé à une ou plusieurs commandes. Désactivez-le plutôt.'
                );
        }


        $pickupSlot->delete();


        return redirect()
            ->route('admin.pickup-slots.index')
            ->with(
                'success',
                'Créneau supprimé avec succès.'
            );
    }
}