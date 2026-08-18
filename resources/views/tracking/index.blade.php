<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>Suivre ma commande — Le Flash</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f6f6f6;
            color: #111;
            font-family: Inter, ui-sans-serif, system-ui,
                -apple-system, BlinkMacSystemFont,
                "Segoe UI", sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font: inherit;
        }

        .header {
            background: #111;
            color: white;
        }

        .header-inner {
            max-width: 1100px;
            min-height: 82px;
            margin: auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: white;
            color: #111;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
        }

        .logo {
            font-size: 22px;
            font-weight: 900;
        }

        .brand-subtitle {
            color: #a1a1aa;
            font-size: 11px;
            margin-top: 2px;
        }

        .back {
            background: #27272a;
            padding: 10px 14px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 800;
            transition: .2s;
        }

        .back:hover {
            background: #3f3f46;
        }

        .container {
            max-width: 900px;
            margin: auto;
            padding: 45px 24px 70px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 900;
            letter-spacing: -1px;
        }

        .page-header p {
            color: #71717a;
            margin: 8px 0 0;
            font-size: 13px;
            line-height: 1.6;
        }

        /* RECHERCHE */

        .search-card {
            max-width: 650px;
            margin: auto;
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 16px;
            padding: 25px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 12px;
            font-weight: 800;
        }

        input {
            width: 100%;
            border: 1px solid #d4d4d8;
            border-radius: 9px;
            padding: 11px 12px;
            outline: none;
            font-size: 13px;
        }

        input:focus {
            border-color: #111;
            box-shadow: 0 0 0 1px #111;
        }

        .error {
            margin-top: 5px;
            color: #b91c1c;
            font-size: 11px;
        }

        .search-button {
            width: 100%;
            border: 0;
            background: #111;
            color: white;
            border-radius: 9px;
            padding: 13px;
            margin-top: 18px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 900;
            transition: .2s;
        }

        .search-button:hover {
            background: #292929;
        }

        .not-found {
            max-width: 650px;
            margin: 20px auto 0;
            padding: 18px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            color: #991b1b;
            font-size: 12px;
            text-align: center;
        }

        /* RESULTAT */

        .result {
            margin-top: 30px;
        }

        .status-card {
            background: #111;
            color: white;
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 20px;
        }

        .status-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .status-label {
            color: #a1a1aa;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .order-number {
            margin-top: 6px;
            font-size: 22px;
            font-weight: 900;
        }

        .live-status {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #a1a1aa;
            font-size: 10px;
            white-space: nowrap;
        }

        .live-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22c55e;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: .35;
            }

            100% {
                opacity: 1;
            }
        }

        .status-badge {
            display: inline-block;
            margin-top: 18px;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 900;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-accepted {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-preparing {
            background: #ede9fe;
            color: #6d28d9;
        }

        .status-ready {
            background: #dcfce7;
            color: #166534;
        }

        .status-picked_up {
            background: #e4e4e7;
            color: #3f3f46;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-description {
            margin-top: 12px;
            color: #d4d4d8;
            font-size: 12px;
            line-height: 1.6;
        }

        /* PROGRESSION */

        .progress-card {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .progress-title {
            margin: 0 0 28px;
            font-size: 15px;
            font-weight: 900;
        }

        .progress {
            display: flex;
            position: relative;
            justify-content: space-between;
        }

        .progress::before {
            content: "";
            position: absolute;
            top: 17px;
            left: 7%;
            right: 7%;
            height: 3px;
            background: #e4e4e7;
            z-index: 0;
        }

        .progress-line {
            position: absolute;
            top: 17px;
            left: 7%;
            height: 3px;
            background: #16a34a;
            z-index: 1;
            transition: width .4s ease;
        }

        .step {
            width: 20%;
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .step-circle {
            width: 36px;
            height: 36px;
            margin: auto;
            border-radius: 50%;
            background: #e4e4e7;
            color: #71717a;
            border: 4px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 900;
        }

        .step.completed .step-circle {
            background: #16a34a;
            color: white;
        }

        .step.current .step-circle {
            background: #111;
            color: white;
        }

        .step-name {
            margin-top: 8px;
            color: #a1a1aa;
            font-size: 9px;
            font-weight: 800;
        }

        .step.completed .step-name,
        .step.current .step-name {
            color: #111;
        }

        /* ANNULATION */

        .cancelled-card {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 20px;
            color: #991b1b;
        }

        .cancelled-title {
            font-size: 14px;
            font-weight: 900;
        }

        .cancelled-text {
            margin-top: 5px;
            font-size: 12px;
            line-height: 1.6;
        }

        /* INFORMATIONS */

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .card {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 14px;
            overflow: hidden;
        }

        .card-header {
            padding: 18px 20px;
            border-bottom: 1px solid #e7e7e7;
        }

        .card-header h2 {
            margin: 0;
            font-size: 15px;
            font-weight: 900;
        }

        .card-body {
            padding: 20px;
        }

        .info {
            margin-bottom: 15px;
        }

        .info:last-child {
            margin-bottom: 0;
        }

        .info-label {
            color: #71717a;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 13px;
            font-weight: 800;
        }

        /* PRODUITS */

        .item {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .item:last-child {
            border-bottom: 0;
        }

        .item-name {
            font-size: 12px;
            font-weight: 800;
        }

        .item-quantity {
            color: #71717a;
            font-size: 10px;
            margin-top: 3px;
        }

        .item-price {
            font-size: 12px;
            font-weight: 900;
            white-space: nowrap;
        }

        .total {
            display: flex;
            justify-content: space-between;
            border-top: 2px solid #111;
            padding-top: 15px;
            margin-top: 15px;
            font-size: 19px;
            font-weight: 900;
        }

        @media (max-width: 700px) {

            .form-grid,
            .grid {
                grid-template-columns: 1fr;
            }

            .header-inner {
                padding: 0 14px;
            }

            .container {
                padding: 30px 14px 50px;
            }

            .brand-mark,
            .brand-subtitle {
                display: none;
            }

            .page-header h1 {
                font-size: 27px;
            }

            .back {
                font-size: 10px;
            }

            .progress-card {
                padding: 20px 10px;
            }

            .step-name {
                font-size: 8px;
            }

            .step-circle {
                width: 30px;
                height: 30px;
            }

            .progress::before,
            .progress-line {
                top: 14px;
            }

            .status-top {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>

</head>

<body>


<header class="header">

    <div class="header-inner">

        <div class="brand">

            <div class="brand-mark">
                F
            </div>

            <div>

                <div class="logo">
                    LE FLASH
                </div>

                <div class="brand-subtitle">
                    Click & Collect
                </div>

            </div>

        </div>

        <a
            href="{{ route('catalog.index') }}"
            class="back"
        >
            ← Retour au catalogue
        </a>

    </div>

</header>


<main class="container">

    <div class="page-header">

        <h1>
            Suivre ma commande
        </h1>

        <p>
            Entrez votre numéro de commande et le numéro de téléphone
            utilisé lors de votre commande.
        </p>

    </div>


    <section class="search-card">

        <form
            method="POST"
            action="{{ route('tracking.search') }}"
        >

            @csrf

            <div class="form-grid">

                <div>

                    <label for="order_number">
                        Numéro de commande
                    </label>

                    <input
                        id="order_number"
                        name="order_number"
                        type="text"
                        value="{{ old(
                            'order_number',
                            $order->order_number ?? ''
                        ) }}"
                        placeholder="FLASH-XXXXXXXX"
                        autocomplete="off"
                        required
                    >

                    @error('order_number')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <div>

                    <label for="customer_phone">
                        Téléphone
                    </label>

                    <input
                        id="customer_phone"
                        name="customer_phone"
                        type="tel"
                        value="{{ old(
                            'customer_phone',
                            request('customer_phone')
                        ) }}"
                        placeholder="06 12 34 56 78"
                        required
                    >

                    @error('customer_phone')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>


            <button
                type="submit"
                class="search-button"
            >
                Rechercher ma commande
            </button>

        </form>

    </section>


    @if(isset($searched) && $searched && !$order)

        <div class="not-found">

            <strong>
                Commande introuvable
            </strong>

            <div style="margin-top:5px;">
                Vérifiez votre numéro de commande et votre numéro de téléphone.
            </div>

        </div>

    @endif


    @if(isset($order) && $order)

        @php

            $statusSteps = [
                'pending',
                'accepted',
                'preparing',
                'ready',
                'picked_up',
            ];

            $currentStep = array_search(
                $order->status,
                $statusSteps
            );

            $progressWidth = match($order->status) {
                'pending' => 0,
                'accepted' => 21.5,
                'preparing' => 43,
                'ready' => 64.5,
                'picked_up' => 86,
                default => 0,
            };

        @endphp


        <!--
        ================================================================
        FORMULAIRE CACHÉ UTILISÉ POUR RAFRAÎCHIR AUTOMATIQUEMENT
        ================================================================
        -->

        <form
            id="auto-refresh-form"
            method="POST"
            action="{{ route('tracking.search') }}"
            style="display:none;"
        >

            @csrf

            <input
                type="hidden"
                name="order_number"
                value="{{ $order->order_number }}"
            >

            <input
                type="hidden"
                name="customer_phone"
                value="{{ request('customer_phone') }}"
            >

        </form>


        <div class="result">

            <section class="status-card">

                <div class="status-top">

                    <div>

                        <div class="status-label">
                            Commande
                        </div>

                        <div class="order-number">
                            {{ $order->order_number }}
                        </div>

                    </div>


                    @if(
                        $order->status !== 'picked_up'
                        && $order->status !== 'cancelled'
                    )

                        <div class="live-status">

                            <span class="live-dot"></span>

                            Actualisation automatique

                        </div>

                    @endif

                </div>


                <div
                    id="order-status-badge"
                    class="
                        status-badge
                        status-{{ $order->status }}
                    "
                >

                    @switch($order->status)

                        @case('pending')
                            En attente
                            @break

                        @case('accepted')
                            Acceptée
                            @break

                        @case('preparing')
                            En préparation
                            @break

                        @case('ready')
                            Prête à retirer
                            @break

                        @case('picked_up')
                            Retirée
                            @break

                        @case('cancelled')
                            Annulée
                            @break

                        @default
                            {{ $order->status }}

                    @endswitch

                </div>


                <div
                    id="order-status-description"
                    class="status-description"
                >

                    @switch($order->status)

                        @case('pending')

                            Votre commande a bien été reçue.
                            Elle attend maintenant la validation du magasin.

                            @break


                        @case('accepted')

                            Votre commande a été acceptée par Le Flash.
                            Elle sera bientôt préparée.

                            @break


                        @case('preparing')

                            Votre commande est actuellement en préparation.
                            Nous rassemblons vos produits.

                            @break


                        @case('ready')

                            Votre commande est prête !
                            Vous pouvez venir la récupérer pendant votre créneau.

                            @break


                        @case('picked_up')

                            Cette commande a été retirée.
                            Merci pour votre commande.

                            @break


                        @case('cancelled')

                            Cette commande a été annulée.

                            @break

                    @endswitch

                </div>

            </section>


            @if($order->status !== 'cancelled')

                <section class="progress-card">

                    <h2 class="progress-title">
                        Progression de votre commande
                    </h2>


                    <div class="progress">

                        <div
                            class="progress-line"
                            style="width: {{ $progressWidth }}%;"
                        ></div>


                        @foreach([
                            'pending' => 'Reçue',
                            'accepted' => 'Acceptée',
                            'preparing' => 'Préparation',
                            'ready' => 'Prête',
                            'picked_up' => 'Retirée'
                        ] as $status => $label)

                            @php

                                $stepIndex = array_search(
                                    $status,
                                    $statusSteps
                                );

                            @endphp


                            <div
                                class="
                                    step

                                    @if(
                                        $currentStep !== false
                                        && $stepIndex < $currentStep
                                    )
                                        completed
                                    @endif

                                    @if(
                                        $order->status === $status
                                    )
                                        current
                                    @endif
                                "
                            >

                                <div class="step-circle">

                                    @if(
                                        $currentStep !== false
                                        && $stepIndex < $currentStep
                                    )

                                        ✓

                                    @else

                                        {{ $stepIndex + 1 }}

                                    @endif

                                </div>

                                <div class="step-name">
                                    {{ $label }}
                                </div>

                            </div>

                        @endforeach

                    </div>

                </section>

            @else

                <div class="cancelled-card">

                    <div class="cancelled-title">
                        Commande annulée
                    </div>

                    <div class="cancelled-text">
                        Cette commande a été annulée et ne sera pas préparée.
                    </div>

                </div>

            @endif


            <div class="grid">


                <section class="card">

                    <div class="card-header">

                        <h2>
                            Informations de retrait
                        </h2>

                    </div>


                    <div class="card-body">

                        <div class="info">

                            <div class="info-label">
                                Client
                            </div>

                            <div class="info-value">
                                {{ $order->customer_name }}
                            </div>

                        </div>


                        <div class="info">

                            <div class="info-label">
                                Date
                            </div>

                            <div class="info-value">

                                @if($order->pickupSlot)

                                    {{ $order->pickupSlot->date
                                        ->format('d/m/Y') }}

                                @elseif($order->pickup_date)

                                    {{ $order->pickup_date
                                        ->format('d/m/Y') }}

                                @else

                                    Non renseignée

                                @endif

                            </div>

                        </div>


                        <div class="info">

                            <div class="info-label">
                                Heure
                            </div>

                            <div class="info-value">

                                @if($order->pickupSlot)

                                    {{ substr(
                                        $order->pickupSlot->start_time,
                                        0,
                                        5
                                    ) }}

                                    —

                                    {{ substr(
                                        $order->pickupSlot->end_time,
                                        0,
                                        5
                                    ) }}

                                @elseif($order->pickup_time)

                                    {{ substr(
                                        $order->pickup_time,
                                        0,
                                        5
                                    ) }}

                                @else

                                    Non renseignée

                                @endif

                            </div>

                        </div>

                    </div>

                </section>


                <section class="card">

                    <div class="card-header">

                        <h2>
                            Votre commande
                        </h2>

                    </div>


                    <div class="card-body">

                        @foreach($order->items as $item)

                            <div class="item">

                                <div>

                                    <div class="item-name">
                                        {{ $item->product_name }}
                                    </div>

                                    <div class="item-quantity">
                                        Quantité : {{ $item->quantity }}
                                    </div>

                                </div>


                                <div class="item-price">

                                    {{ number_format(
                                        $item->total_price,
                                        2,
                                        ',',
                                        ' '
                                    ) }} €

                                </div>

                            </div>

                        @endforeach


                        <div class="total">

                            <span>
                                Total
                            </span>

                            <span>

                                {{ number_format(
                                    $order->total,
                                    2,
                                    ',',
                                    ' '
                                ) }} €

                            </span>

                        </div>

                    </div>

                </section>

            </div>

        </div>

    @endif

</main>


@if(isset($order) && $order)

<script>

    /*
    |--------------------------------------------------------------------------
    | ACTUALISATION AUTOMATIQUE DU SUIVI
    |--------------------------------------------------------------------------
    */

    document.addEventListener('DOMContentLoaded', function () {

        const currentStatus = @json($order->status);

        /*
        | Une commande terminée ou annulée
        | n'a plus besoin d'être surveillée.
        */

        if (
            currentStatus === 'picked_up'
            || currentStatus === 'cancelled'
        ) {
            return;
        }


        const orderNumber =
            @json($order->order_number);

        const customerPhone =
            @json((string) request('customer_phone'));

        const csrfToken =
            document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content');


        let lastKnownStatus =
            currentStatus;

        let requestRunning =
            false;


        async function checkOrderStatus() {

            /*
            | Évite plusieurs requêtes en même temps.
            */

            if (requestRunning) {
                return;
            }

            requestRunning = true;


            try {

                const response = await fetch(
                    @json(route('tracking.status')),
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type':
                                'application/json',

                            'Accept':
                                'application/json',

                            'X-CSRF-TOKEN':
                                csrfToken,
                        },

                        body: JSON.stringify({
                            order_number:
                                orderNumber,

                            customer_phone:
                                customerPhone,
                        }),
                    }
                );


                if (!response.ok) {
                    return;
                }


                const data =
                    await response.json();


                if (!data.found) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | LE STATUT A CHANGÉ
                |--------------------------------------------------------------------------
                */

                if (
                    data.status !==
                    lastKnownStatus
                ) {

                    lastKnownStatus =
                        data.status;


                    /*
                    | On met immédiatement le texte à jour.
                    */

                    const badge =
                        document.getElementById(
                            'order-status-badge'
                        );

                    const description =
                        document.getElementById(
                            'order-status-description'
                        );


                    if (badge) {

                        badge.textContent =
                            data.status_label;

                        badge.className =
                            'status-badge status-' +
                            data.status;
                    }


                    if (description) {

                        description.textContent =
                            data.status_description;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | RAFRAÎCHISSEMENT COMPLET
                    |--------------------------------------------------------------------------
                    |
                    | On renvoie automatiquement le formulaire
                    | de recherche afin de mettre à jour :
                    |
                    | - la progression
                    | - les étapes vertes
                    | - l'annulation
                    | - tous les textes
                    |
                    */

                    const refreshForm =
                        document.getElementById(
                            'auto-refresh-form'
                        );


                    if (refreshForm) {

                        setTimeout(
                            function () {
                                refreshForm.submit();
                            },
                            500
                        );
                    }
                }


            } catch (error) {

                /*
                | Si le client perd momentanément sa connexion,
                | on ne casse pas la page.
                */

                console.log(
                    'Vérification du statut impossible.'
                );

            } finally {

                requestRunning =
                    false;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | VÉRIFICATION PÉRIODIQUE
        |--------------------------------------------------------------------------
        */

        setInterval(
            checkOrderStatus,
            5000
        );

    });

</script>

@endif


</body>

</html>