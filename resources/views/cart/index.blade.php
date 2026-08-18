<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Mon panier — Le Flash</title>

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
            padding: 0 24px;
            margin: auto;

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

            font-size: 13px;
            font-weight: 700;
        }

        .alert.success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert.error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /*
        |--------------------------------------------------------------------------
        | 18+
        |--------------------------------------------------------------------------
        */

        .age-notice {
            display: flex;
            align-items: flex-start;
            gap: 13px;

            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;

            padding: 16px;
            border-radius: 13px;

            margin-bottom: 20px;
        }

        .age-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;

            border-radius: 50%;

            background: #ea580c;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 11px;
            font-weight: 900;
        }

        .age-notice strong {
            display: block;
            margin-bottom: 4px;
            font-size: 12px;
        }

        .age-notice-text {
            font-size: 11px;
            line-height: 1.6;
        }

        /*
        |--------------------------------------------------------------------------
        | LAYOUT
        |--------------------------------------------------------------------------
        */

        .cart-layout {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr)
                370px;

            gap: 24px;

            align-items: start;
        }

        /*
        |--------------------------------------------------------------------------
        | PRODUITS
        |--------------------------------------------------------------------------
        */

        .items {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .cart-item {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 15px;

            padding: 16px;

            display: grid;

            grid-template-columns:
                90px
                minmax(0, 1fr)
                auto;

            gap: 17px;

            align-items: center;

            transition: .15s;
        }

        .cart-item:hover {
            border-color: #d4d4d8;
            box-shadow: 0 5px 18px
                rgba(0, 0, 0, .04);
        }

        /*
        |--------------------------------------------------------------------------
        | IMAGE
        |--------------------------------------------------------------------------
        */

        .item-image {
            width: 90px;
            height: 90px;

            border-radius: 11px;

            overflow: hidden;

            background: #f4f4f5;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 30px;

            border: 1px solid #eee;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /*
        |--------------------------------------------------------------------------
        | INFORMATIONS PRODUIT
        |--------------------------------------------------------------------------
        */

        .item-main {
            min-width: 0;
        }

        .item-title {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 7px;
        }

        .item-title h3 {
            margin: 0;

            font-size: 15px;
            font-weight: 900;
        }

        .age-badge {
            display: inline-flex;
            align-items: center;

            background: #fee2e2;
            color: #b91c1c;

            padding: 4px 7px;

            border-radius: 999px;

            font-size: 9px;
            font-weight: 900;
        }

        .unit-price {
            margin-top: 5px;

            color: #71717a;
            font-size: 11px;
        }

        .line-total {
            margin-top: 9px;

            font-size: 14px;
            font-weight: 900;
        }

        /*
        |--------------------------------------------------------------------------
        | ACTIONS PRODUIT
        |--------------------------------------------------------------------------
        */

        .item-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 9px;
        }

        .quantity-form {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .quantity-input {
            width: 68px;

            border: 1px solid #d4d4d8;
            border-radius: 8px;

            padding: 9px;

            outline: none;
            text-align: center;
        }

        .quantity-input:focus {
            border-color: #111;
            box-shadow: 0 0 0 1px #111;
        }

        .button {
            border: 0;

            border-radius: 8px;

            min-height: 36px;
            padding: 0 11px;

            cursor: pointer;

            font-size: 10px;
            font-weight: 900;
        }

        .button.update {
            background: #111;
            color: white;
        }

        .button.update:hover {
            background: #292929;
        }

        .button.delete {
            background: #fef2f2;
            color: #b91c1c;
        }

        .button.delete:hover {
            background: #fee2e2;
        }

        /*
        |--------------------------------------------------------------------------
        | RÉSUMÉ
        |--------------------------------------------------------------------------
        */

        .summary {
            background: white;

            border: 1px solid #e7e7e7;
            border-radius: 15px;

            overflow: hidden;

            position: sticky;
            top: 102px;
        }

        .summary-header {
            padding: 20px 22px;

            border-bottom: 1px solid #eee;
        }

        .summary-header h2 {
            margin: 0;

            font-size: 17px;
            font-weight: 900;
        }

        .summary-header p {
            margin: 5px 0 0;

            color: #71717a;
            font-size: 11px;
        }

        .summary-body {
            padding: 22px;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            gap: 20px;

            padding: 9px 0;

            color: #52525b;
            font-size: 12px;
        }

        .summary-line strong {
            color: #111;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            gap: 20px;

            margin-top: 12px;
            padding-top: 18px;

            border-top: 2px solid #111;

            font-size: 22px;
            font-weight: 900;
        }

        /*
        |--------------------------------------------------------------------------
        | RESTRICTION
        |--------------------------------------------------------------------------
        */

        .restricted-summary {
            margin-top: 18px;

            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;

            padding: 12px;

            border-radius: 9px;

            font-size: 10px;
            font-weight: 700;
            line-height: 1.55;
        }

        /*
        |--------------------------------------------------------------------------
        | CHECKOUT
        |--------------------------------------------------------------------------
        */

        .checkout {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 100%;

            margin-top: 20px;

            min-height: 48px;

            background: #f97316;
            color: white;

            border-radius: 10px;

            font-size: 12px;
            font-weight: 900;

            transition: .15s;
        }

        .checkout:hover {
            background: #ea580c;
        }

        .checkout-help {
            margin-top: 9px;

            color: #a1a1aa;

            text-align: center;

            font-size: 9px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | VIDER
        |--------------------------------------------------------------------------
        */

        .clear-form {
            margin-top: 10px;
        }

        .clear {
            width: 100%;

            min-height: 39px;

            border: 0;

            background: #f4f4f5;
            color: #52525b;

            border-radius: 9px;

            cursor: pointer;

            font-size: 10px;
            font-weight: 800;
        }

        .clear:hover {
            background: #e4e4e7;
        }

        /*
        |--------------------------------------------------------------------------
        | PANIER VIDE
        |--------------------------------------------------------------------------
        */

        .empty {
            background: white;

            border: 1px solid #e7e7e7;
            border-radius: 18px;

            padding: 75px 25px;

            text-align: center;
        }

        .empty-icon {
            width: 70px;
            height: 70px;

            margin: auto auto 18px;

            border-radius: 50%;

            background: #f4f4f5;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 30px;
        }

        .empty h2 {
            margin: 0;

            font-size: 21px;
            font-weight: 900;
        }

        .empty p {
            margin: 8px 0 0;

            color: #71717a;
            font-size: 12px;
        }

        .catalog {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 42px;

            margin-top: 22px;

            background: #111;
            color: white;

            border-radius: 9px;

            padding: 0 17px;

            font-size: 11px;
            font-weight: 900;
        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE BOTTOM
        |--------------------------------------------------------------------------
        */

        .mobile-checkout {
            display: none;
        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 950px) {

            .cart-layout {
                grid-template-columns: 1fr;
            }

            .summary {
                position: static;
            }
        }

        @media (max-width: 700px) {

            body {
                padding-bottom: 80px;
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

            .page-header h1 {
                font-size: 27px;
            }

            .cart-item {
                grid-template-columns:
                    75px
                    minmax(0, 1fr);

                gap: 13px;
                padding: 13px;
            }

            .item-image {
                width: 75px;
                height: 75px;
            }

            .item-actions {
                grid-column: 1 / -1;

                width: 100%;

                display: grid;
                grid-template-columns: 1fr auto;
                align-items: center;

                padding-top: 12px;
                border-top: 1px solid #eee;
            }

            .quantity-form {
                width: 100%;
            }

            .quantity-input {
                flex: 1;
            }

            .summary .checkout {
                display: none;
            }

            .mobile-checkout {
                position: fixed;

                display: flex;

                left: 12px;
                right: 12px;
                bottom: 12px;

                z-index: 200;

                min-height: 54px;

                background: #f97316;
                color: white;

                border-radius: 13px;

                align-items: center;
                justify-content: space-between;
                gap: 15px;

                padding: 0 18px;

                box-shadow: 0 8px 30px
                    rgba(0, 0, 0, .25);

                font-size: 12px;
                font-weight: 900;
            }

            .mobile-checkout-price {
                font-size: 14px;
            }
        }

        @media (max-width: 430px) {

            .item-actions {
                grid-template-columns: 1fr;
            }

            .quantity-form {
                display: grid;
                grid-template-columns: 1fr auto;
            }

            .button.delete {
                width: 100%;
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
            href="{{ route('catalog.index') }}"
            class="back"
        >
            ← Continuer mes achats
        </a>

    </div>

</header>


<main class="container">


    <div class="page-header">

        <h1>
            Mon panier
        </h1>

        <p>
            Vérifiez vos produits avant de passer votre commande.
        </p>

    </div>


    @if(session('success'))

        <div class="alert success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert error">
            {{ session('error') }}
        </div>

    @endif


    @if($errors->any())

        <div class="alert error">

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif


    @if($hasAgeRestrictedProducts)

        <div class="age-notice">

            <div class="age-icon">
                18+
            </div>

            <div>

                <strong>
                    Produit réservé aux personnes majeures
                </strong>

                <div class="age-notice-text">

                    Votre panier contient au moins un produit
                    soumis à une restriction d'âge.

                    Votre majorité devra être confirmée avant
                    la validation de la commande et une pièce
                    d'identité pourra être demandée au retrait.

                </div>

            </div>

        </div>

    @endif


    @if(empty($cart))


        <div class="empty">

            <div class="empty-icon">
                🛒
            </div>

            <h2>
                Votre panier est vide
            </h2>

            <p>
                Ajoutez des produits depuis le catalogue pour commencer.
            </p>

            <a
                href="{{ route('catalog.index') }}"
                class="catalog"
            >
                Voir le catalogue
            </a>

        </div>


    @else


        <div class="cart-layout">


            <!-- PRODUITS -->

            <section class="items">


                @foreach($cart as $item)


                    <article class="cart-item">


                        <!-- IMAGE -->

                        <div class="item-image">

                            @if(!empty($item['image']))

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $item['image']
                                    ) }}"
                                    alt="{{ $item['name'] }}"
                                >

                            @else

                                🛍️

                            @endif

                        </div>


                        <!-- INFO -->

                        <div class="item-main">

                            <div class="item-title">

                                <h3>
                                    {{ $item['name'] }}
                                </h3>


                                @if(
                                    !empty(
                                        $item['age_restricted']
                                    )
                                )

                                    <span class="age-badge">
                                        🔞 18+
                                    </span>

                                @endif

                            </div>


                            <div class="unit-price">

                                Prix unitaire :

                                {{ number_format(
                                    $item['price'],
                                    2,
                                    ',',
                                    ' '
                                ) }} €

                            </div>


                            <div class="line-total">

                                {{ number_format(
                                    $item['price']
                                    *
                                    $item['quantity'],
                                    2,
                                    ',',
                                    ' '
                                ) }} €

                            </div>

                        </div>


                        <!-- ACTIONS -->

                        <div class="item-actions">


                            <form
                                method="POST"
                                action="{{ route(
                                    'cart.update',
                                    $item['product_id']
                                ) }}"
                                class="quantity-form"
                            >

                                @csrf
                                @method('PATCH')


                                <input
                                    class="quantity-input"
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    value="{{ $item['quantity'] }}"
                                    aria-label="Quantité de {{ $item['name'] }}"
                                    required
                                >


                                <button
                                    type="submit"
                                    class="button update"
                                >
                                    Modifier
                                </button>

                            </form>


                            <form
                                method="POST"
                                action="{{ route(
                                    'cart.remove',
                                    $item['product_id']
                                ) }}"
                                onsubmit="
                                    return confirm(
                                        'Retirer ce produit du panier ?'
                                    );
                                "
                            >

                                @csrf
                                @method('DELETE')


                                <button
                                    type="submit"
                                    class="button delete"
                                >
                                    Supprimer
                                </button>

                            </form>


                        </div>


                    </article>


                @endforeach


            </section>


            <!-- RÉSUMÉ -->

            <aside class="summary">


                <div class="summary-header">

                    <h2>
                        Résumé de la commande
                    </h2>

                    <p>
                        Retrait et paiement directement au Flash.
                    </p>

                </div>


                <div class="summary-body">


                    <div class="summary-line">

                        <span>
                            Nombre d'articles
                        </span>

                        <strong>
                            {{ collect($cart)->sum('quantity') }}
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
                            ) }} €

                        </span>

                    </div>


                    @if($hasAgeRestrictedProducts)

                        <div class="restricted-summary">

                            🔞 Cette commande contient au moins
                            un produit réservé aux personnes majeures.

                        </div>

                    @endif


                    <a
                        href="{{ route('checkout.index') }}"
                        class="checkout"
                    >
                        Passer la commande →
                    </a>


                    <div class="checkout-help">

                        Aucun paiement ne sera effectué en ligne.

                    </div>


                    <form
                        method="POST"
                        action="{{ route('cart.clear') }}"
                        class="clear-form"
                        onsubmit="
                            return confirm(
                                'Vider complètement le panier ?'
                            );
                        "
                    >

                        @csrf
                        @method('DELETE')


                        <button
                            type="submit"
                            class="clear"
                        >
                            Vider le panier
                        </button>

                    </form>


                </div>


            </aside>


        </div>


        <!-- CHECKOUT MOBILE -->

        <a
            href="{{ route('checkout.index') }}"
            class="mobile-checkout"
        >

            <span>
                Passer la commande
            </span>

            <span class="mobile-checkout-price">

                {{ number_format(
                    $total,
                    2,
                    ',',
                    ' '
                ) }} €

            </span>

        </a>


    @endif


</main>


</body>

</html>