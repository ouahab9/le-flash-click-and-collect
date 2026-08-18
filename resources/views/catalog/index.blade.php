<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Le Flash — Click & Collect</title>

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
            color: #171717;
            font-family: Inter, Arial, sans-serif;
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
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #27272a;
        }

        .header-inner {
            max-width: 1250px;
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
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: white;
            color: #111;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 18px;
        }

        .logo {
            font-size: 24px;
            font-weight: 900;
            letter-spacing: -.5px;
        }

        .subtitle {
            font-size: 11px;
            color: #a1a1aa;
            margin-top: 2px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 15px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 800;
            transition: .2s;
        }

        .tracking {
            background: #27272a;
            color: white;
        }

        .tracking:hover {
            background: #3f3f46;
        }

        .cart {
            background: #f97316;
            color: white;
        }

        .cart:hover {
            background: #ea580c;
        }

        .cart-count {
            min-width: 21px;
            height: 21px;
            padding: 0 6px;
            border-radius: 999px;
            background: white;
            color: #111;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 900;
        }

        /*
        |--------------------------------------------------------------------------
        | CONTAINER
        |--------------------------------------------------------------------------
        */

        .container {
            max-width: 1250px;
            margin: auto;
            padding: 35px 24px 70px;
        }

        /*
        |--------------------------------------------------------------------------
        | MESSAGES
        |--------------------------------------------------------------------------
        */

        .message {
            padding: 14px 16px;
            border-radius: 11px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 700;
        }

        .message.success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .message.error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /*
        |--------------------------------------------------------------------------
        | HERO
        |--------------------------------------------------------------------------
        */

        .hero {
            background: #111;
            color: white;
            border-radius: 22px;
            padding: 50px;
            margin-bottom: 28px;
            overflow: hidden;
            position: relative;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            right: -100px;
            top: -130px;
            background: rgba(249, 115, 22, .17);
        }

        .hero-content {
            max-width: 650px;
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #27272a;
            padding: 7px 10px;
            border-radius: 999px;
            color: #d4d4d8;
            font-size: 10px;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .hero h1 {
            margin: 0;
            font-size: 42px;
            line-height: 1.05;
            letter-spacing: -1.5px;
            font-weight: 900;
        }

        .hero p {
            max-width: 560px;
            margin: 14px 0 0;
            color: #d4d4d8;
            line-height: 1.6;
            font-size: 14px;
        }

        /*
        |--------------------------------------------------------------------------
        | SEARCH / FILTERS
        |--------------------------------------------------------------------------
        */

        .catalog-tools {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 28px;
        }

        .search-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-wrapper {
            flex: 1;
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #71717a;
            font-size: 14px;
        }

        .search-input {
            width: 100%;
            border: 1px solid #d4d4d8;
            border-radius: 10px;
            padding: 12px 14px 12px 40px;
            outline: none;
            font-size: 13px;
        }

        .search-input:focus {
            border-color: #111;
            box-shadow: 0 0 0 1px #111;
        }

        .result-count {
            color: #71717a;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .categories {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            scrollbar-width: thin;
        }

        .category-button {
            border: 1px solid #e4e4e7;
            background: white;
            color: #52525b;
            padding: 9px 13px;
            border-radius: 999px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
            transition: .15s;
        }

        .category-button:hover {
            border-color: #111;
            color: #111;
        }

        .category-button.active {
            background: #111;
            border-color: #111;
            color: white;
        }

        /*
        |--------------------------------------------------------------------------
        | SECTION
        |--------------------------------------------------------------------------
        */

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 18px;
        }

        .section-title {
            margin: 0;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: -.5px;
        }

        .section-subtitle {
            color: #71717a;
            font-size: 12px;
            margin-top: 4px;
        }

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */

        .products {
            display: grid;
            grid-template-columns: repeat(
                4,
                minmax(0, 1fr)
            );
            gap: 18px;
        }

        .product {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            transition:
                transform .18s,
                box-shadow .18s,
                border-color .18s;
        }

        .product:hover {
            transform: translateY(-3px);
            border-color: #d4d4d8;
            box-shadow: 0 10px 30px
                rgba(0, 0, 0, .07);
        }

        .product.hidden {
            display: none;
        }

        /*
        |--------------------------------------------------------------------------
        | IMAGE
        |--------------------------------------------------------------------------
        */

        .product-image {
            height: 210px;
            background: #f4f4f5;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .25s;
        }

        .product:hover .product-image img {
            transform: scale(1.025);
        }

        .placeholder {
            font-size: 44px;
            opacity: .45;
        }

        /*
        |--------------------------------------------------------------------------
        | BADGES
        |--------------------------------------------------------------------------
        */

        .badges {
            position: absolute;
            top: 11px;
            left: 11px;
            right: 11px;
            z-index: 5;
            display: flex;
            justify-content: space-between;
            gap: 8px;
            pointer-events: none;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 9px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 900;
            box-shadow: 0 2px 6px
                rgba(0, 0, 0, .12);
        }

        .badge-age {
            margin-left: auto;
            background: #dc2626;
            color: white;
        }

        .badge-low {
            background: #fff7ed;
            color: #c2410c;
        }

        /*
        |--------------------------------------------------------------------------
        | PRODUCT CONTENT
        |--------------------------------------------------------------------------
        */

        .product-content {
            padding: 17px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .category-name {
            color: #a1a1aa;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 6px;
        }

        .product h3 {
            margin: 0;
            font-size: 16px;
            line-height: 1.35;
            font-weight: 900;
        }

        .description {
            color: #71717a;
            font-size: 12px;
            line-height: 1.55;
            margin: 8px 0 0;
            flex: 1;
        }

        .age-warning {
            margin-top: 12px;
            background: #fef2f2;
            color: #991b1b;
            border-radius: 8px;
            padding: 9px 10px;
            font-size: 10px;
            line-height: 1.45;
            font-weight: 700;
        }

        /*
        |--------------------------------------------------------------------------
        | STOCK
        |--------------------------------------------------------------------------
        */

        .stock {
            margin-top: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 10px;
            font-weight: 800;
            color: #52525b;
        }

        .stock-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #16a34a;
        }

        .stock.low {
            color: #c2410c;
        }

        .stock.low .stock-dot {
            background: #f97316;
        }

        /*
        |--------------------------------------------------------------------------
        | PRICE / ADD
        |--------------------------------------------------------------------------
        */

        .product-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 16px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .price {
            font-size: 19px;
            font-weight: 900;
            white-space: nowrap;
        }

        .add-form {
            margin: 0;
        }

        .add {
            border: 0;
            background: #111;
            color: white;
            min-height: 39px;
            padding: 0 13px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 900;
            transition: .15s;
        }

        .add:hover {
            background: #f97316;
        }

        /*
        |--------------------------------------------------------------------------
        | EMPTY SEARCH
        |--------------------------------------------------------------------------
        */

        .empty {
            grid-column: 1 / -1;
            background: white;
            border: 1px solid #e7e7e7;
            padding: 55px 20px;
            text-align: center;
            border-radius: 16px;
            color: #71717a;
        }

        .empty-search {
            display: none;
            background: white;
            border: 1px solid #e7e7e7;
            padding: 45px 20px;
            text-align: center;
            border-radius: 16px;
            color: #71717a;
        }

        .empty-search.visible {
            display: block;
        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE CART
        |--------------------------------------------------------------------------
        */

        .mobile-cart {
            display: none;
        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1050px) {

            .products {
                grid-template-columns: repeat(
                    3,
                    minmax(0, 1fr)
                );
            }
        }

        @media (max-width: 800px) {

            .products {
                grid-template-columns: repeat(
                    2,
                    minmax(0, 1fr)
                );
            }

            .hero {
                padding: 35px 28px;
            }

            .hero h1 {
                font-size: 34px;
            }
        }

        @media (max-width: 650px) {

            body {
                padding-bottom: 75px;
            }

            .header {
                position: static;
            }

            .header-inner {
                min-height: 72px;
                padding: 0 15px;
            }

            .brand-mark {
                width: 38px;
                height: 38px;
            }

            .logo {
                font-size: 19px;
            }

            .subtitle {
                display: none;
            }

            .header-actions .cart {
                display: none;
            }

            .header-button {
                min-height: 38px;
                padding: 0 11px;
                font-size: 10px;
            }

            .container {
                padding: 20px 14px 45px;
            }

            .hero {
                padding: 28px 22px;
                border-radius: 17px;
            }

            .hero h1 {
                font-size: 29px;
            }

            .hero p {
                font-size: 12px;
            }

            .search-row {
                align-items: stretch;
                flex-direction: column;
            }

            .result-count {
                padding-left: 2px;
            }

            .products {
                gap: 12px;
            }

            .product-image {
                height: 160px;
            }

            .product-content {
                padding: 13px;
            }

            .product h3 {
                font-size: 14px;
            }

            .description {
                font-size: 11px;
            }

            .price {
                font-size: 16px;
            }

            .add {
                padding: 0 10px;
                font-size: 10px;
            }

            .section-title {
                font-size: 21px;
            }

            .mobile-cart {
                display: flex;
                position: fixed;
                z-index: 200;
                left: 12px;
                right: 12px;
                bottom: 12px;
                min-height: 52px;
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

            .mobile-cart-count {
                background: white;
                color: #111;
                min-width: 24px;
                height: 24px;
                padding: 0 6px;
                border-radius: 999px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 10px;
            }
        }

        @media (max-width: 430px) {

            .products {
                grid-template-columns: 1fr;
            }

            .product-image {
                height: 210px;
            }

            .tracking-text {
                display: none;
            }

            .tracking::after {
                content: "Suivi";
            }
        }

    </style>

</head>

<body>


@php

    $cart = session('cart', []);

    $cartQuantity = collect($cart)
        ->sum('quantity');

@endphp


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

                <div class="subtitle">
                    Votre bureau de tabac — Click & Collect
                </div>

            </div>

        </a>


        <div class="header-actions">

            <a
                href="{{ route('tracking.index') }}"
                class="header-button tracking"
            >

                <span>
                    📦
                </span>

                <span class="tracking-text">
                    Suivre ma commande
                </span>

            </a>


            <a
                href="{{ route('cart.index') }}"
                class="header-button cart"
            >

                🛒 Mon panier

                @if($cartQuantity > 0)

                    <span class="cart-count">
                        {{ $cartQuantity }}
                    </span>

                @endif

            </a>

        </div>

    </div>

</header>


<main class="container">


    @if(session('success'))

        <div class="message success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="message error">
            {{ session('error') }}
        </div>

    @endif


    @if($errors->any())

        <div class="message error">

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif


    <!-- HERO -->

    <section class="hero">

        <div class="hero-content">

            <div class="hero-badge">
                ⚡ Click & Collect
            </div>

            <h1>
                Commandez.<br>
                Récupérez. C'est prêt.
            </h1>

            <p>
                Sélectionnez vos produits, choisissez votre créneau
                de retrait et récupérez votre commande directement
                au Flash.
            </p>

        </div>

    </section>


    <!-- RECHERCHE / FILTRES -->

    <section class="catalog-tools">

        <div class="search-row">

            <div class="search-wrapper">

                <span class="search-icon">
                    🔎
                </span>

                <input
                    id="product-search"
                    class="search-input"
                    type="search"
                    placeholder="Rechercher un produit..."
                    autocomplete="off"
                >

            </div>


            <div
                id="result-count"
                class="result-count"
            >
                {{ $products->count() }}
                produit(s)
            </div>

        </div>


        <div class="categories">

            <button
                type="button"
                class="category-button active"
                data-category="all"
            >
                Tous
            </button>


            @foreach($categories as $category)

                <button
                    type="button"
                    class="category-button"
                    data-category="{{ $category->id }}"
                >

                    @if($category->icon)
                        {{ $category->icon }}
                    @endif

                    {{ $category->name }}

                </button>

            @endforeach

        </div>

    </section>


    <!-- PRODUITS -->

    <div class="section-header">

        <div>

            <h2 class="section-title">
                Nos produits
            </h2>

            <div class="section-subtitle">
                Produits actuellement disponibles.
            </div>

        </div>

    </div>


    <div
        id="products-grid"
        class="products"
    >

        @forelse($products as $product)


            <article
                class="product"
                data-name="{{ mb_strtolower(
                    $product->name
                ) }}"
                data-description="{{ mb_strtolower(
                    $product->description ?? ''
                ) }}"
                data-category="{{ $product->category_id ?? '' }}"
            >


                <!-- BADGES -->

                <div class="badges">

                    <div>

                        @if($product->stock <= 5)

                            <span class="badge badge-low">
                                Plus que {{ $product->stock }}
                            </span>

                        @endif

                    </div>


                    @if($product->age_restricted)

                        <span class="badge badge-age">
                            🔞 18+
                        </span>

                    @endif

                </div>


                <!-- IMAGE -->

                <div class="product-image">

                    @if($product->image)

                        <img
                            src="{{ asset(
                                'storage/' .
                                $product->image
                            ) }}"
                            alt="{{ $product->name }}"
                            loading="lazy"
                        >

                    @else

                        <span class="placeholder">
                            🛍️
                        </span>

                    @endif

                </div>


                <!-- CONTENT -->

                <div class="product-content">


                    <div class="category-name">

                        {{ $product->category?->name
                            ?? 'Sans catégorie' }}

                    </div>


                    <h3>
                        {{ $product->name }}
                    </h3>


                    <p class="description">

                        {{ $product->description
                            ?: 'Produit disponible en Click & Collect.' }}

                    </p>


                    @if($product->age_restricted)

                        <div class="age-warning">

                            🔞 Réservé aux personnes majeures.
                            Une pièce d'identité pourra être
                            demandée lors du retrait.

                        </div>

                    @endif


                    <div
                        class="
                            stock
                            {{ $product->stock <= 5 ? 'low' : '' }}
                        "
                    >

                        <span class="stock-dot"></span>

                        @if($product->stock <= 5)

                            Plus que
                            {{ $product->stock }}
                            en stock

                        @else

                            Disponible

                        @endif

                    </div>


                    <div class="product-bottom">

                        <span class="price">

                            {{ number_format(
                                $product->price,
                                2,
                                ',',
                                ' '
                            ) }} €

                        </span>


                        <form
                            method="POST"
                            action="{{ route(
                                'cart.add',
                                [
                                    'product' =>
                                        $product
                                ]
                            ) }}"
                            class="add-form"
                        >

                            @csrf


                            <button
                                type="submit"
                                class="add"
                            >
                                + Ajouter
                            </button>

                        </form>

                    </div>


                </div>


            </article>


        @empty


            <div class="empty">

                <div style="font-size:40px;">
                    🛍️
                </div>

                <h3>
                    Aucun produit disponible
                </h3>

                <p>
                    Les produits disponibles apparaîtront ici.
                </p>

            </div>


        @endforelse

    </div>


    <div
        id="empty-search"
        class="empty-search"
    >

        <div style="font-size:38px;">
            🔎
        </div>

        <h3>
            Aucun produit trouvé
        </h3>

        <p>
            Essayez une autre recherche ou une autre catégorie.
        </p>

    </div>


</main>


<!-- PANIER MOBILE -->

<a
    href="{{ route('cart.index') }}"
    class="mobile-cart"
>

    <span>
        🛒 Voir mon panier
    </span>

    <span class="mobile-cart-count">
        {{ $cartQuantity }}
    </span>

</a>


<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const searchInput =
                document.getElementById(
                    'product-search'
                );

            const products =
                Array.from(
                    document.querySelectorAll(
                        '.product'
                    )
                );

            const categoryButtons =
                Array.from(
                    document.querySelectorAll(
                        '.category-button'
                    )
                );

            const resultCount =
                document.getElementById(
                    'result-count'
                );

            const emptySearch =
                document.getElementById(
                    'empty-search'
                );


            let activeCategory =
                'all';


            /*
            |--------------------------------------------------------------------------
            | NORMALISER LE TEXTE
            |--------------------------------------------------------------------------
            */

            function normalizeText(text) {

                return text
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(
                        /[\u0300-\u036f]/g,
                        ''
                    )
                    .trim();
            }


            /*
            |--------------------------------------------------------------------------
            | FILTRER
            |--------------------------------------------------------------------------
            */

            function filterProducts() {

                const search =
                    normalizeText(
                        searchInput.value
                    );


                let visibleCount = 0;


                products.forEach(
                    function (product) {

                        const name =
                            normalizeText(
                                product.dataset.name
                                || ''
                            );

                        const description =
                            normalizeText(
                                product.dataset.description
                                || ''
                            );

                        const category =
                            product.dataset.category;


                        const matchesSearch =
                            search === ''
                            ||
                            name.includes(search)
                            ||
                            description.includes(search);


                        const matchesCategory =
                            activeCategory === 'all'
                            ||
                            category === activeCategory;


                        const visible =
                            matchesSearch
                            &&
                            matchesCategory;


                        product.classList.toggle(
                            'hidden',
                            !visible
                        );


                        if (visible) {
                            visibleCount++;
                        }

                    }
                );


                resultCount.textContent =
                    visibleCount +
                    ' produit(s)';


                emptySearch.classList.toggle(
                    'visible',
                    visibleCount === 0
                    &&
                    products.length > 0
                );
            }


            /*
            |--------------------------------------------------------------------------
            | RECHERCHE
            |--------------------------------------------------------------------------
            */

            searchInput.addEventListener(
                'input',
                filterProducts
            );


            /*
            |--------------------------------------------------------------------------
            | CATÉGORIES
            |--------------------------------------------------------------------------
            */

            categoryButtons.forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        function () {

                            activeCategory =
                                button.dataset.category;


                            categoryButtons.forEach(
                                function (item) {

                                    item.classList.remove(
                                        'active'
                                    );

                                }
                            );


                            button.classList.add(
                                'active'
                            );


                            filterProducts();

                        }
                    );

                }
            );

        }
    );

</script>


</body>

</html>