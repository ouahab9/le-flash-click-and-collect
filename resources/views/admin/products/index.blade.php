<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Produits — Le Flash</title>

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
            text-decoration: none;
            color: inherit;
        }

        button {
            font: inherit;
        }

        .layout {
            min-height: 100vh;
            display: flex;
        }


        /* SIDEBAR */

        .sidebar {
            width: 250px;
            background: #111;
            color: white;
            position: fixed;
            inset: 0 auto 0 0;
            display: flex;
            flex-direction: column;
        }

        .brand {
            height: 90px;
            display: flex;
            align-items: center;
            padding: 0 28px;
            border-bottom: 1px solid #252525;
        }

        .brand-logo {
            font-size: 25px;
            font-weight: 900;
        }

        .brand-subtitle {
            display: block;
            color: #777;
            font-size: 10px;
            margin-top: 3px;
            letter-spacing: 1px;
        }

        .navigation {
            padding: 25px 14px;
            flex: 1;
        }

        .nav-label {
            color: #666;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 0 14px 10px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            margin-bottom: 5px;
            border-radius: 10px;
            color: #aaa;
            font-size: 14px;
            font-weight: 600;
        }

        .nav-item:hover {
            background: #222;
            color: white;
        }

        .nav-item.active {
            background: white;
            color: #111;
        }

        .nav-icon {
            width: 22px;
            text-align: center;
        }

        .sidebar-bottom {
            padding: 18px;
            border-top: 1px solid #252525;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px;
            margin-bottom: 12px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: white;
            color: #111;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .admin-name {
            font-size: 13px;
            font-weight: 700;
        }

        .admin-role {
            font-size: 11px;
            color: #777;
            margin-top: 2px;
        }

        .logout {
            width: 100%;
            border: 1px solid #333;
            background: transparent;
            color: #aaa;
            border-radius: 9px;
            padding: 10px;
            cursor: pointer;
        }


        /* MAIN */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .topbar {
            height: 90px;
            background: white;
            border-bottom: 1px solid #e7e7e7;
            display: flex;
            align-items: center;
            padding: 0 40px;
        }

        .title {
            font-size: 22px;
            font-weight: 800;
            margin: 0;
        }

        .subtitle {
            color: #71717a;
            font-size: 13px;
            margin-top: 4px;
        }

        .content {
            padding: 35px 40px 50px;
        }


        /* ALERT */

        .alert {
            padding: 13px 16px;
            border-radius: 10px;
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


        /* TOOLBAR */

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .count {
            color: #71717a;
            font-size: 13px;
        }

        .add-button {
            background: #111;
            color: white;
            padding: 11px 16px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 800;
        }

        .add-button:hover {
            background: #292929;
        }


        /* PANEL */

        .panel {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 14px;
            overflow: hidden;
        }

        .products-head,
        .product-row {
            display: grid;

            grid-template-columns:
                2fr
                1fr
                .7fr
                1.4fr
                .7fr
                190px;

            gap: 16px;
            align-items: center;
        }

        .products-head {
            padding: 13px 22px;
            background: #fafafa;
            border-bottom: 1px solid #e7e7e7;
            color: #71717a;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .product-row {
            padding: 16px 22px;
            border-bottom: 1px solid #f0f0f0;
        }

        .product-row:hover {
            background: #fafafa;
        }

        .product-row:last-child {
            border-bottom: 0;
        }


        /* PRODUCT */

        .product-info {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .product-image {
            width: 58px;
            height: 58px;
            border-radius: 10px;
            border: 1px solid #e4e4e7;
            background: #f4f4f5;
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-placeholder {
            color: #a1a1aa;
            font-size: 22px;
        }

        .product-name {
            font-size: 13px;
            font-weight: 800;
        }

        .product-description {
            color: #71717a;
            font-size: 11px;
            margin-top: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 280px;
        }

        .category {
            font-size: 12px;
            color: #52525b;
        }

        .price {
            font-size: 13px;
            font-weight: 800;
        }


        /* STOCK */

        .stock-manager {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stock-button {
            min-width: 31px;
            height: 31px;
            border: 1px solid #e4e4e7;
            background: white;
            border-radius: 7px;
            cursor: pointer;
            font-size: 10px;
            font-weight: 900;
        }

        .stock-button:hover {
            background: #111;
            border-color: #111;
            color: white;
        }

        .stock-button.minus:hover {
            background: #dc2626;
            border-color: #dc2626;
        }

        .stock-button.plus:hover {
            background: #16a34a;
            border-color: #16a34a;
        }

        .stock-value {
            min-width: 42px;
            text-align: center;
            padding: 7px 5px;
            border-radius: 7px;
            background: #f4f4f5;
            font-size: 12px;
            font-weight: 900;
        }

        .stock-value.low {
            background: #fff7ed;
            color: #c2410c;
        }

        .stock-value.empty {
            background: #fef2f2;
            color: #b91c1c;
        }


        /* STATUS */

        .status {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 800;
        }

        .status.active {
            background: #f0fdf4;
            color: #15803d;
        }

        .status.inactive {
            background: #f4f4f5;
            color: #71717a;
        }


        /* ACTIONS */

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 6px;
        }

        .action {
            border: 1px solid #e4e4e7;
            background: white;
            color: #111;
            padding: 7px 9px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .action:hover {
            background: #f4f4f5;
        }

        .action.delete {
            color: #b91c1c;
        }

        .action.delete:hover {
            background: #fef2f2;
        }


        /* EMPTY */

        .empty-list {
            padding: 70px 20px;
            text-align: center;
            color: #71717a;
        }

        .pagination {
            padding: 18px 22px;
            border-top: 1px solid #eee;
        }


        /* RESPONSIVE */

        @media (max-width: 1200px) {

            .products-head {
                display: none;
            }

            .product-row {
                grid-template-columns: 1fr 1fr;
            }

            .actions {
                justify-content: flex-start;
            }
        }

        @media (max-width: 800px) {

            .sidebar {
                width: 70px;
            }

            .brand {
                justify-content: center;
                padding: 0;
            }

            .brand-logo {
                font-size: 13px;
            }

            .brand-subtitle,
            .nav-label,
            .nav-text,
            .admin-info,
            .logout {
                display: none;
            }

            .nav-item {
                justify-content: center;
                padding: 14px 0;
            }

            .main {
                margin-left: 70px;
                width: calc(100% - 70px);
            }

            .topbar {
                padding: 0 20px;
            }

            .content {
                padding: 25px 15px;
            }
        }

        @media (max-width: 550px) {

            .product-row {
                grid-template-columns: 1fr;
            }

            .toolbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .stock-manager {
                flex-wrap: wrap;
            }
        }

    </style>

</head>

<body>


<div class="layout">


    <!-- SIDEBAR -->

    <aside class="sidebar">


        <div class="brand">

            <div>

                <div class="brand-logo">
                    LE FLASH
                </div>

                <span class="brand-subtitle">
                    ESPACE ADMINISTRATION
                </span>

            </div>

        </div>


        <nav class="navigation">


            <div class="nav-label">
                Menu
            </div>


            <a
                href="{{ route('dashboard') }}"
                class="nav-item"
            >
                <span class="nav-icon">⌂</span>
                <span class="nav-text">Dashboard</span>
            </a>


            <a
                href="{{ route('admin.orders.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">▣</span>
                <span class="nav-text">Commandes</span>
            </a>


            <a
                href="{{ route('admin.products.index') }}"
                class="nav-item active"
            >
                <span class="nav-icon">◉</span>
                <span class="nav-text">Produits</span>
            </a>


            <a
                href="{{ route('admin.categories.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">▤</span>
                <span class="nav-text">Catégories</span>
            </a>


            <div
                style="margin-top:28px;"
                class="nav-label"
            >
                Gestion
            </div>


            <a
                href="{{ route('admin.pickup-slots.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">◷</span>
                <span class="nav-text">Créneaux</span>
            </a>


        </nav>


        <div class="sidebar-bottom">


            <div class="admin-user">


                <div class="avatar">

                    {{ strtoupper(
                        substr(auth()->user()->name, 0, 1)
                    ) }}

                </div>


                <div class="admin-info">

                    <div class="admin-name">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="admin-role">
                        Administrateur
                    </div>

                </div>


            </div>


            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="logout"
                >
                    Déconnexion
                </button>

            </form>


        </div>


    </aside>


    <!-- MAIN -->

    <main class="main">


        <header class="topbar">

            <div>

                <h1 class="title">
                    Produits
                </h1>

                <div class="subtitle">
                    Gérez le catalogue et les stocks de votre boutique.
                </div>

            </div>

        </header>


        <div class="content">


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


            <div class="toolbar">


                <div class="count">

                    {{ $products->total() }}
                    produit(s)

                </div>


                <a
                    href="{{ route('admin.products.create') }}"
                    class="add-button"
                >
                    + Ajouter un produit
                </a>


            </div>


            <div class="panel">


                @if($products->count())


                    <div class="products-head">

                        <div>Produit</div>
                        <div>Catégorie</div>
                        <div>Prix</div>
                        <div>Stock rapide</div>
                        <div>Statut</div>
                        <div></div>

                    </div>


                    @foreach($products as $product)


                        <div class="product-row">


                            <!-- PRODUIT -->

                            <div class="product-info">


                                <div class="product-image">


                                    @if($product->image)

                                        <img
                                            src="{{ asset(
                                                'storage/' .
                                                $product->image
                                            ) }}"
                                            alt="{{ $product->name }}"
                                        >

                                    @else

                                        <span class="product-placeholder">
                                            ◉
                                        </span>

                                    @endif


                                </div>


                                <div style="min-width:0;">


                                    <div class="product-name">
                                        {{ $product->name }}
                                    </div>


                                    @if($product->description)

                                        <div class="product-description">

                                            {{ $product->description }}

                                        </div>

                                    @endif


                                </div>


                            </div>


                            <!-- CATÉGORIE -->

                            <div class="category">

                                {{ $product->category?->name
                                    ?? 'Sans catégorie' }}

                            </div>


                            <!-- PRIX -->

                            <div class="price">

                                {{ number_format(
                                    $product->price,
                                    2,
                                    ',',
                                    ' '
                                ) }} €

                            </div>


                            <!-- STOCK RAPIDE -->

                            <div class="stock-manager">


                                <form
                                    method="POST"
                                    action="{{ route(
                                        'admin.products.stock',
                                        ['product' => $product]
                                    ) }}"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <input
                                        type="hidden"
                                        name="change"
                                        value="-5"
                                    >

                                    <button
                                        type="submit"
                                        class="stock-button minus"
                                        title="Retirer 5"
                                    >
                                        -5
                                    </button>

                                </form>


                                <form
                                    method="POST"
                                    action="{{ route(
                                        'admin.products.stock',
                                        ['product' => $product]
                                    ) }}"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <input
                                        type="hidden"
                                        name="change"
                                        value="-1"
                                    >

                                    <button
                                        type="submit"
                                        class="stock-button minus"
                                        title="Retirer 1"
                                    >
                                        −
                                    </button>

                                </form>


                                <div
                                    class="
                                        stock-value

                                        @if($product->stock <= 0)
                                            empty
                                        @elseif($product->stock <= 5)
                                            low
                                        @endif
                                    "
                                >

                                    {{ $product->stock }}

                                </div>


                                <form
                                    method="POST"
                                    action="{{ route(
                                        'admin.products.stock',
                                        ['product' => $product]
                                    ) }}"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <input
                                        type="hidden"
                                        name="change"
                                        value="1"
                                    >

                                    <button
                                        type="submit"
                                        class="stock-button plus"
                                        title="Ajouter 1"
                                    >
                                        +
                                    </button>

                                </form>


                                <form
                                    method="POST"
                                    action="{{ route(
                                        'admin.products.stock',
                                        ['product' => $product]
                                    ) }}"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <input
                                        type="hidden"
                                        name="change"
                                        value="5"
                                    >

                                    <button
                                        type="submit"
                                        class="stock-button plus"
                                        title="Ajouter 5"
                                    >
                                        +5
                                    </button>

                                </form>


                            </div>


                            <!-- STATUT -->

                            <div>


                                @if($product->active)

                                    <span class="status active">
                                        Actif
                                    </span>

                                @else

                                    <span class="status inactive">
                                        Inactif
                                    </span>

                                @endif


                            </div>


                            <!-- ACTIONS -->

                            <div class="actions">


                                <a
                                    href="{{ route(
                                        'admin.products.show',
                                        ['product' => $product]
                                    ) }}"
                                    class="action"
                                >
                                    Voir
                                </a>


                                <a
                                    href="{{ route(
                                        'admin.products.edit',
                                        ['product' => $product]
                                    ) }}"
                                    class="action"
                                >
                                    Modifier
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route(
                                        'admin.products.destroy',
                                        ['product' => $product]
                                    ) }}"
                                    onsubmit="
                                        return confirm(
                                            'Supprimer définitivement ce produit ?'
                                        );
                                    "
                                >

                                    @csrf
                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="action delete"
                                    >
                                        Supprimer
                                    </button>


                                </form>


                            </div>


                        </div>


                    @endforeach


                    @if($products->hasPages())

                        <div class="pagination">

                            {{ $products->links() }}

                        </div>

                    @endif


                @else


                    <div class="empty-list">


                        <div
                            style="
                                font-size:35px;
                                margin-bottom:15px;
                            "
                        >
                            ◉
                        </div>


                        <strong>
                            Aucun produit
                        </strong>


                        <div style="margin-top:5px;">

                            Commencez par ajouter votre premier produit.

                        </div>


                    </div>


                @endif


            </div>


        </div>


    </main>


</div>


</body>

</html>