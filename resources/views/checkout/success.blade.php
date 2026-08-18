<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Commande confirmée — Le Flash</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f5f5;
            color: #171717;
            font-family: Inter, Arial, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .header {
            background: #111;
            color: white;
        }

        .header-inner {
            max-width: 1000px;
            min-height: 82px;
            margin: auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: 900;
        }

        .subtitle {
            color: #a1a1aa;
            font-size: 12px;
            margin-top: 3px;
        }

        .catalog-link {
            background: #27272a;
            padding: 10px 15px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 800;
        }

        .container {
            max-width: 850px;
            margin: auto;
            padding: 45px 20px 70px;
        }

        .success-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            overflow: hidden;
        }

        .success-top {
            text-align: center;
            padding: 40px 25px 30px;
        }

        .success-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background: #dcfce7;
            color: #166534;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 900;
        }

        .success-title {
            margin: 0;
            font-size: 30px;
            font-weight: 900;
        }

        .success-text {
            color: #71717a;
            font-size: 14px;
            line-height: 1.6;
            margin: 10px auto 0;
            max-width: 550px;
        }

        .order-number-section {
            margin: 0 25px 30px;
            background: #111;
            color: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
        }

        .order-number-label {
            color: #a1a1aa;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .order-number {
            margin-top: 8px;
            font-size: 27px;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .order-number-help {
            color: #a1a1aa;
            margin-top: 9px;
            font-size: 11px;
        }

        .content {
            padding: 0 25px 30px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .box {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
        }

        .box-title {
            padding: 16px 18px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            font-weight: 900;
        }

        .box-content {
            padding: 18px;
        }

        .info {
            margin-bottom: 16px;
        }

        .info:last-child {
            margin-bottom: 0;
        }

        .info-label {
            color: #71717a;
            font-size: 10px;
            text-transform: uppercase;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 13px;
            font-weight: 800;
        }

        .status {
            display: inline-block;
            padding: 7px 11px;
            background: #fef3c7;
            color: #92400e;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 900;
        }

        .products-box {
            margin-top: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
        }

        .product {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 15px 18px;
            border-bottom: 1px solid #eee;
        }

        .product:last-child {
            border-bottom: 0;
        }

        .product-name {
            font-size: 13px;
            font-weight: 800;
        }

        .product-quantity {
            color: #71717a;
            font-size: 11px;
            margin-top: 4px;
        }

        .product-price {
            font-size: 13px;
            font-weight: 900;
            white-space: nowrap;
        }

        .total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px;
            border-top: 2px solid #111;
            font-size: 20px;
            font-weight: 900;
        }

        .important {
            margin-top: 20px;
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
            border-radius: 12px;
            padding: 15px 18px;
            font-size: 12px;
            line-height: 1.6;
        }

        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 25px;
        }

        .button {
            padding: 14px 18px;
            border-radius: 10px;
            text-align: center;
            font-size: 13px;
            font-weight: 900;
        }

        .button-track {
            background: #f97316;
            color: white;
        }

        .button-track:hover {
            background: #ea580c;
        }

        .button-catalog {
            background: #111;
            color: white;
        }

        .button-catalog:hover {
            background: #292929;
        }

        @media (max-width: 650px) {
            .header-inner {
                padding: 0 15px;
            }

            .subtitle {
                display: none;
            }

            .container {
                padding: 25px 12px 50px;
            }

            .success-top {
                padding: 30px 18px 25px;
            }

            .success-title {
                font-size: 25px;
            }

            .order-number-section {
                margin: 0 15px 25px;
                padding: 22px 12px;
            }

            .order-number {
                font-size: 22px;
            }

            .content {
                padding: 0 15px 20px;
            }

            .grid,
            .actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<header class="header">

    <div class="header-inner">

        <div>

            <div class="logo">
                LE FLASH
            </div>

            <div class="subtitle">
                Click & Collect
            </div>

        </div>

        <a
            href="{{ route('catalog.index') }}"
            class="catalog-link"
        >
            Retour au catalogue
        </a>

    </div>

</header>


<main class="container">

    <section class="success-card">

        <div class="success-top">

            <div class="success-icon">
                ✓
            </div>

            <h1 class="success-title">
                Commande enregistrée !
            </h1>

            <p class="success-text">
                Votre commande a bien été transmise au Flash.
                Conservez votre numéro de commande pour pouvoir
                suivre son état.
            </p>

        </div>


        <div class="order-number-section">

            <div class="order-number-label">
                Votre numéro de commande
            </div>

            <div class="order-number">
                {{ $order->order_number }}
            </div>

            <div class="order-number-help">
                Conservez ce numéro. Il vous permettra de suivre votre commande.
            </div>

        </div>


        <div class="content">

            <div class="grid">

                <div class="box">

                    <div class="box-title">
                        👤 Client
                    </div>

                    <div class="box-content">

                        <div class="info">

                            <div class="info-label">
                                Nom
                            </div>

                            <div class="info-value">
                                {{ $order->customer_name }}
                            </div>

                        </div>


                        <div class="info">

                            <div class="info-label">
                                Téléphone
                            </div>

                            <div class="info-value">
                                {{ $order->customer_phone }}
                            </div>

                        </div>


                        <div class="info">

                            <div class="info-label">
                                Statut
                            </div>

                            <div class="info-value">

                                <span class="status">

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

                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="box">

                    <div class="box-title">
                        🕐 Retrait
                    </div>

                    <div class="box-content">

                        <div class="info">

                            <div class="info-label">
                                Date
                            </div>

                            <div class="info-value">

                                @if($order->pickupSlot)

                                    {{ $order->pickupSlot->date->format('d/m/Y') }}

                                @elseif($order->pickup_date)

                                    {{ $order->pickup_date->format('d/m/Y') }}

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

                                    {{ substr($order->pickupSlot->start_time, 0, 5) }}

                                    à

                                    {{ substr($order->pickupSlot->end_time, 0, 5) }}

                                @elseif($order->pickup_time)

                                    {{ substr($order->pickup_time, 0, 5) }}

                                @else

                                    Non renseignée

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="products-box">

                <div class="box-title">
                    🛍️ Récapitulatif
                </div>


                @foreach($order->items as $item)

                    <div class="product">

                        <div>

                            <div class="product-name">
                                {{ $item->product_name }}
                            </div>

                            <div class="product-quantity">
                                Quantité : {{ $item->quantity }}
                                ×
                                {{ number_format(
                                    $item->unit_price,
                                    2,
                                    ',',
                                    ' '
                                ) }} €
                            </div>

                        </div>


                        <div class="product-price">

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


            <div class="important">

                <strong>Important :</strong>

                votre commande n'est pas encore prête tant que son statut
                n'est pas passé à

                <strong>« Prête à retirer »</strong>.

                Vous pouvez vérifier son état à tout moment depuis
                le suivi de commande.

            </div>


            <div class="actions">

                <a
                    href="{{ route('tracking.index') }}"
                    class="button button-track"
                >
                    📦 Suivre ma commande
                </a>


                <a
                    href="{{ route('catalog.index') }}"
                    class="button button-catalog"
                >
                    ← Retour au catalogue
                </a>

            </div>

        </div>

    </section>

</main>

</body>

</html>