<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Finaliser ma commande — Le Flash</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: #f5f5f5;
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

        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        .header {
            background: #111;
            color: white;
            border-bottom: 1px solid #27272a;

            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-inner {
            max-width: 1200px;

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
            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: #27272a;

            padding: 10px 14px;

            border-radius: 9px;

            font-size: 12px;
            font-weight: 800;

            transition: .15s;
        }

        .back:hover {
            background: #3f3f46;
        }

        /*
        |--------------------------------------------------------------------------
        | PAGE
        |--------------------------------------------------------------------------
        */

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 35px 24px 70px;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0;

            font-size: 32px;
            font-weight: 900;

            letter-spacing: -1px;
        }

        .page-header p {
            margin: 7px 0 0;

            color: #71717a;

            font-size: 13px;
            line-height: 1.6;
        }

        /*
        |--------------------------------------------------------------------------
        | ALERTES
        |--------------------------------------------------------------------------
        */

        .alert {
            padding: 14px 16px;

            border-radius: 11px;

            margin-bottom: 20px;

            font-size: 12px;
            line-height: 1.6;
        }

        .alert.error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert strong {
            font-weight: 900;
        }

        .alert ul {
            margin: 8px 0 0 18px;
            padding: 0;
        }

        /*
        |--------------------------------------------------------------------------
        | LAYOUT
        |--------------------------------------------------------------------------
        */

        .checkout-layout {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr)
                390px;

            gap: 24px;

            align-items: start;
        }

        .left-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /*
        |--------------------------------------------------------------------------
        | CARD
        |--------------------------------------------------------------------------
        */

        .card {
            background: white;

            border: 1px solid #e7e7e7;

            border-radius: 15px;

            overflow: hidden;
        }

        .card-header {
            padding: 20px 22px;

            border-bottom: 1px solid #e7e7e7;
        }

        .card-header h2 {
            margin: 0;

            font-size: 17px;
            font-weight: 900;
        }

        .card-header p {
            margin: 5px 0 0;

            color: #71717a;

            font-size: 11px;
            line-height: 1.5;
        }

        .card-body {
            padding: 22px;
        }

        /*
        |--------------------------------------------------------------------------
        | FORM
        |--------------------------------------------------------------------------
        */

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;

            gap: 18px;
        }

        .field {
            min-width: 0;
        }

        label {
            display: block;

            margin-bottom: 7px;

            font-size: 11px;
            font-weight: 900;
        }

        input[type="text"],
        input[type="tel"] {
            width: 100%;

            border: 1px solid #d4d4d8;

            background: white;
            color: #111;

            border-radius: 9px;

            padding: 12px;

            outline: none;

            font-size: 13px;
        }

        input[type="text"]:focus,
        input[type="tel"]:focus {
            border-color: #111;
            box-shadow: 0 0 0 1px #111;
        }

        .field-hint {
            margin-top: 6px;

            color: #a1a1aa;

            font-size: 10px;
            line-height: 1.45;
        }

        .error {
            margin-top: 6px;

            color: #b91c1c;

            font-size: 10px;
            font-weight: 700;
        }

        /*
        |--------------------------------------------------------------------------
        | SLOTS
        |--------------------------------------------------------------------------
        */

        .slots {
            display: grid;
            grid-template-columns: repeat(2, 1fr);

            gap: 10px;
        }

        .slot {
            position: relative;
        }

        .slot input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .slot label {
            height: 100%;

            margin: 0;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            gap: 12px;

            border: 1px solid #e4e4e7;

            border-radius: 11px;

            padding: 15px;

            cursor: pointer;

            transition: .15s;
        }

        .slot label:hover {
            border-color: #111;
        }

        .slot input:checked + label {
            border-color: #111;

            background: #fafafa;

            box-shadow:
                inset 0 0 0 1px #111;
        }

        .slot input:focus-visible + label {
            outline: 2px solid #111;
            outline-offset: 2px;
        }

        .slot-date {
            font-size: 12px;
            font-weight: 900;
        }

        .slot-day {
            color: #71717a;

            font-size: 10px;

            margin-top: 4px;

            text-transform: capitalize;
        }

        .slot-time {
            width: fit-content;

            background: #f4f4f5;
            color: #111;

            padding: 7px 9px;

            border-radius: 8px;

            font-size: 11px;
            font-weight: 900;
        }

        .slot input:checked + label .slot-time {
            background: #111;
            color: white;
        }

        /*
        |--------------------------------------------------------------------------
        | NO SLOT
        |--------------------------------------------------------------------------
        */

        .no-slots {
            padding: 18px;

            border-radius: 11px;

            background: #fef2f2;
            color: #991b1b;

            font-size: 11px;
            line-height: 1.6;
        }

        /*
        |--------------------------------------------------------------------------
        | AGE
        |--------------------------------------------------------------------------
        */

        .age-warning {
            background: #fff7ed;

            border: 1px solid #fed7aa;

            border-radius: 15px;

            overflow: hidden;
        }

        .age-warning-header {
            padding: 18px 20px;

            border-bottom: 1px solid #fed7aa;

            display: flex;
            gap: 13px;
            align-items: center;
        }

        .age-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;

            border-radius: 50%;

            background: #ea580c;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 12px;
            font-weight: 900;
        }

        .age-warning-title {
            color: #9a3412;

            font-size: 13px;
            font-weight: 900;
        }

        .age-warning-text {
            color: #c2410c;

            font-size: 10px;
            line-height: 1.5;

            margin-top: 4px;
        }

        .age-confirmation {
            padding: 18px 20px;
        }

        .age-checkbox {
            display: flex;
            align-items: flex-start;

            gap: 11px;

            margin: 0;

            cursor: pointer;
        }

        .age-checkbox input {
            width: 19px;
            height: 19px;

            min-width: 19px;

            margin: 1px 0 0;

            accent-color: #111;
        }

        .age-checkbox-text {
            color: #431407;

            font-size: 11px;
            line-height: 1.55;

            font-weight: 700;
        }

        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        .summary {
            position: sticky;
            top: 102px;
        }

        .order-items {
            display: flex;
            flex-direction: column;
        }

        .order-item {
            display: flex;

            justify-content: space-between;
            align-items: flex-start;

            gap: 15px;

            padding: 13px 0;

            border-bottom: 1px solid #eee;
        }

        .order-item:last-child {
            border-bottom: 0;
        }

        .item-name {
            font-size: 12px;
            font-weight: 900;
        }

        .item-quantity {
            margin-top: 4px;

            color: #71717a;

            font-size: 10px;
        }

        .restricted-badge {
            display: inline-block;

            margin-top: 6px;

            background: #fee2e2;
            color: #b91c1c;

            padding: 4px 7px;

            border-radius: 999px;

            font-size: 8px;
            font-weight: 900;
        }

        .item-price {
            font-size: 12px;
            font-weight: 900;

            white-space: nowrap;
        }

        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        .summary-details {
            margin-top: 15px;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;

            gap: 20px;

            padding: 9px 0;

            color: #52525b;

            font-size: 11px;
        }

        .summary-line strong {
            color: #111;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;

            gap: 20px;

            border-top: 2px solid #111;

            margin-top: 10px;
            padding-top: 18px;

            font-size: 22px;
            font-weight: 900;
        }

        /*
        |--------------------------------------------------------------------------
        | SUBMIT
        |--------------------------------------------------------------------------
        */

        .submit {
            width: 100%;

            min-height: 48px;

            margin-top: 20px;

            border: 0;

            background: #f97316;
            color: white;

            border-radius: 10px;

            cursor: pointer;

            font-size: 12px;
            font-weight: 900;

            transition: .15s;
        }

        .submit:hover {
            background: #ea580c;
        }

        .submit:disabled {
            background: #d4d4d8;

            color: #71717a;

            cursor: not-allowed;
        }

        .secure-text {
            text-align: center;

            margin-top: 10px;

            color: #a1a1aa;

            font-size: 9px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE SUBMIT
        |--------------------------------------------------------------------------
        */

        .mobile-submit {
            display: none;
        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 950px) {

            .checkout-layout {
                grid-template-columns: 1fr;
            }

            .summary {
                position: static;
            }
        }

        @media (max-width: 700px) {

            body {
                padding-bottom: 82px;
            }

            .header {
                position: static;
            }

            .header-inner {
                min-height: 70px;

                padding: 0 14px;
            }

            .brand-mark,
            .brand-subtitle {
                display: none;
            }

            .logo {
                font-size: 19px;
            }

            .back {
                padding: 9px 11px;

                font-size: 10px;
            }

            .container {
                padding: 24px 14px 45px;
            }

            .page-header {
                margin-bottom: 20px;
            }

            .page-header h1 {
                font-size: 27px;
            }

            .page-header p {
                font-size: 11px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .slots {
                grid-template-columns: 1fr;
            }

            .slot label {
                flex-direction: row;
                align-items: center;
            }

            .summary .submit {
                display: none;
            }

            .mobile-submit {
                position: fixed;

                left: 12px;
                right: 12px;
                bottom: 12px;

                z-index: 200;

                min-height: 56px;

                border: 0;

                border-radius: 13px;

                background: #f97316;
                color: white;

                display: flex;
                align-items: center;
                justify-content: space-between;

                gap: 15px;

                padding: 0 18px;

                cursor: pointer;

                box-shadow:
                    0 8px 30px
                    rgba(0, 0, 0, .25);

                font-size: 11px;
                font-weight: 900;
            }

            .mobile-submit:disabled {
                background: #a1a1aa;
                cursor: not-allowed;
            }

            .mobile-submit-price {
                font-size: 14px;
            }
        }

        @media (max-width: 430px) {

            .card-header,
            .card-body {
                padding-left: 16px;
                padding-right: 16px;
            }

            .age-warning-header,
            .age-confirmation {
                padding-left: 16px;
                padding-right: 16px;
            }

            .slot label {
                align-items: flex-start;
                flex-direction: column;
            }
        }

    </style>

</head>

<body>


<header class="header">

    <div class="header-inner">

        <a
            href="{{ route('catalog.index') }}"
            class="brand"
        >

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

        </a>


        <a
            href="{{ route('cart.index') }}"
            class="back"
        >
            ← Retour au panier
        </a>

    </div>

</header>


<main class="container">


    <div class="page-header">

        <h1>
            Finaliser ma commande
        </h1>

        <p>
            Renseignez vos coordonnées puis choisissez votre
            créneau de retrait.
        </p>

    </div>


    @if(session('error'))

        <div class="alert error">

            <strong>
                Impossible de valider la commande :
            </strong>

            <div style="margin-top:5px;">
                {{ session('error') }}
            </div>

        </div>

    @endif


    @if($errors->any())

        <div class="alert error">

            <strong>
                Vérifiez les informations suivantes :
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        id="checkout-form"
        method="POST"
        action="{{ route('checkout.store') }}"
    >

        @csrf


        <div class="checkout-layout">


            <!-- GAUCHE -->

            <div class="left-column">


                <!-- INFORMATIONS -->

                <section class="card">

                    <div class="card-header">

                        <h2>
                            1. Vos informations
                        </h2>

                        <p>
                            Elles servent à identifier votre commande
                            lors du retrait.
                        </p>

                    </div>


                    <div class="card-body">

                        <div class="form-grid">


                            <div class="field">

                                <label for="customer_name">
                                    Nom et prénom *
                                </label>

                                <input
                                    id="customer_name"
                                    name="customer_name"
                                    type="text"
                                    value="{{ old('customer_name') }}"
                                    placeholder="Jean Dupont"
                                    autocomplete="name"
                                    required
                                >

                                @error('customer_name')

                                    <div class="error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <div class="field">

                                <label for="customer_phone">
                                    Téléphone *
                                </label>

                                <input
                                    id="customer_phone"
                                    name="customer_phone"
                                    type="tel"
                                    value="{{ old('customer_phone') }}"
                                    placeholder="06 12 34 56 78"
                                    autocomplete="tel"
                                    inputmode="tel"
                                    required
                                >

                                <div class="field-hint">
                                    Utilisez ce même numéro pour suivre
                                    votre commande.
                                </div>

                                @error('customer_phone')

                                    <div class="error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                        </div>

                    </div>

                </section>


                <!-- CRÉNEAU -->

                <section class="card">

                    <div class="card-header">

                        <h2>
                            2. Créneau de retrait
                        </h2>

                        <p>
                            Choisissez le moment où vous viendrez
                            récupérer votre commande.
                        </p>

                    </div>


                    <div class="card-body">


                        @if($slots->count())


                            <div class="slots">


                                @foreach($slots as $slot)


                                    <div class="slot">


                                        <input
                                            id="slot-{{ $slot->id }}"
                                            type="radio"
                                            name="pickup_slot_id"
                                            value="{{ $slot->id }}"
                                            @checked(
                                                old(
                                                    'pickup_slot_id'
                                                )
                                                ==
                                                $slot->id
                                            )
                                            required
                                        >


                                        <label
                                            for="slot-{{ $slot->id }}"
                                        >


                                            <div>

                                                <div class="slot-date">

                                                    {{ $slot->date
                                                        ->locale('fr')
                                                        ->translatedFormat(
                                                            'd F Y'
                                                        ) }}

                                                </div>


                                                <div class="slot-day">

                                                    {{ $slot->date
                                                        ->locale('fr')
                                                        ->translatedFormat(
                                                            'l'
                                                        ) }}

                                                </div>

                                            </div>


                                            <div class="slot-time">

                                                {{ substr(
                                                    $slot->start_time,
                                                    0,
                                                    5
                                                ) }}

                                                —

                                                {{ substr(
                                                    $slot->end_time,
                                                    0,
                                                    5
                                                ) }}

                                            </div>


                                        </label>


                                    </div>


                                @endforeach


                            </div>


                        @else


                            <div class="no-slots">

                                <strong>
                                    Aucun créneau disponible
                                </strong>

                                <div style="margin-top:5px;">

                                    Aucun retrait ne peut actuellement
                                    être réservé.

                                    Revenez plus tard ou contactez
                                    Le Flash.

                                </div>

                            </div>


                        @endif


                        @error('pickup_slot_id')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror


                    </div>

                </section>


                <!-- 18+ -->

                @if($hasAgeRestrictedProducts)


                    <section class="age-warning">


                        <div class="age-warning-header">


                            <div class="age-icon">
                                18+
                            </div>


                            <div>

                                <div class="age-warning-title">

                                    Confirmation de majorité

                                </div>

                                <div class="age-warning-text">

                                    Votre commande contient au moins
                                    un produit réservé aux personnes
                                    majeures.

                                </div>

                            </div>


                        </div>


                        <div class="age-confirmation">


                            <label class="age-checkbox">


                                <input
                                    type="checkbox"
                                    name="age_confirmed"
                                    value="1"
                                    @checked(
                                        old('age_confirmed')
                                    )
                                    required
                                >


                                <span class="age-checkbox-text">

                                    Je certifie avoir au moins 18 ans.

                                    Je comprends qu'une pièce
                                    d'identité pourra être demandée
                                    lors du retrait et que la remise
                                    du produit pourra être refusée
                                    si je ne peux pas justifier mon âge.

                                </span>


                            </label>


                            @error('age_confirmed')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror


                        </div>


                    </section>


                @endif


            </div>


            <!-- RÉSUMÉ -->

            <aside class="card summary">


                <div class="card-header">

                    <h2>
                        Votre commande
                    </h2>

                    <p>
                        Vérifiez votre panier avant confirmation.
                    </p>

                </div>


                <div class="card-body">


                    <div class="order-items">


                        @foreach($cart as $item)


                            <div class="order-item">


                                <div>


                                    <div class="item-name">
                                        {{ $item['name'] }}
                                    </div>


                                    <div class="item-quantity">

                                        {{ $item['quantity'] }}
                                        ×
                                        {{ number_format(
                                            $item['price'],
                                            2,
                                            ',',
                                            ' '
                                        ) }}
                                        €

                                    </div>


                                    @if(
                                        !empty(
                                            $item['age_restricted']
                                        )
                                    )

                                        <span class="restricted-badge">
                                            🔞 18+
                                        </span>

                                    @endif


                                </div>


                                <div class="item-price">

                                    {{ number_format(
                                        $item['price']
                                        *
                                        $item['quantity'],
                                        2,
                                        ',',
                                        ' '
                                    ) }}
                                    €

                                </div>


                            </div>


                        @endforeach


                    </div>


                    <div class="summary-details">


                        <div class="summary-line">

                            <span>
                                Articles
                            </span>

                            <strong>

                                {{ collect($cart)
                                    ->sum('quantity') }}

                            </strong>

                        </div>


                        <div class="summary-line">

                            <span>
                                Retrait
                            </span>

                            <strong>
                                Click & Collect
                            </strong>

                        </div>


                        <div class="summary-line">

                            <span>
                                Paiement
                            </span>

                            <strong>
                                Au magasin
                            </strong>

                        </div>


                        <div class="summary-total">

                            <span>
                                Total
                            </span>

                            <span>

                                {{ number_format(
                                    $total,
                                    2,
                                    ',',
                                    ' '
                                ) }}
                                €

                            </span>

                        </div>


                    </div>


                    <button
                        type="submit"
                        class="submit"
                        @disabled(
                            $slots->isEmpty()
                        )
                    >

                        Confirmer la commande

                    </button>


                    <div class="secure-text">

                        Aucun paiement n'est effectué en ligne.
                        Vous réglerez votre commande au retrait.

                    </div>


                </div>


            </aside>


        </div>


        <!-- MOBILE -->


        <button
            type="submit"
            class="mobile-submit"
            @disabled(
                $slots->isEmpty()
            )
        >

            <span>
                Confirmer la commande
            </span>

            <span class="mobile-submit-price">

                {{ number_format(
                    $total,
                    2,
                    ',',
                    ' '
                ) }}
                €

            </span>

        </button>


    </form>


</main>


</body>

</html>