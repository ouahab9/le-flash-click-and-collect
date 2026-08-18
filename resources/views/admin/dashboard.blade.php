<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Dashboard — Le Flash</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f6f6f6;
            color: #111;

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        .layout {
            min-height: 100vh;
            display: flex;
        }


        /*
        |--------------------------------------------------------------------------
        | SIDEBAR
        |--------------------------------------------------------------------------
        */

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
            color: black;

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

        .logout:hover {
            background: #222;
            color: white;
        }


        /*
        |--------------------------------------------------------------------------
        | MAIN
        |--------------------------------------------------------------------------
        */

        .main {
            margin-left: 250px;

            width: calc(100% - 250px);

            min-height: 100vh;
        }

        .topbar {
            min-height: 90px;

            background: white;

            border-bottom: 1px solid #e7e7e7;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding: 20px 40px;
        }

        .title {
            margin: 0;

            font-size: 22px;
            font-weight: 900;
        }

        .subtitle {
            color: #71717a;

            font-size: 13px;

            margin-top: 4px;
        }

        .topbar-actions {
            display: flex;
            gap: 8px;
        }

        .top-button {
            padding: 10px 14px;

            border-radius: 9px;

            font-size: 11px;
            font-weight: 800;
        }

        .top-button.primary {
            background: #111;
            color: white;
        }

        .top-button.secondary {
            background: #f4f4f5;
            color: #52525b;
        }

        .content {
            padding: 35px 40px 60px;
        }


        /*
        |--------------------------------------------------------------------------
        | ALERTES
        |--------------------------------------------------------------------------
        */

        .alert {
            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 20px;

            padding: 16px 18px;

            border-radius: 12px;

            margin-bottom: 22px;
        }

        .alert.stock {
            background: #fff7ed;

            border: 1px solid #fed7aa;
        }

        .alert.orders {
            background: #eff6ff;

            border: 1px solid #bfdbfe;
        }

        .alert-title {
            font-size: 13px;
            font-weight: 900;
        }

        .alert.stock .alert-title {
            color: #9a3412;
        }

        .alert.orders .alert-title {
            color: #1d4ed8;
        }

        .alert-text {
            font-size: 11px;

            margin-top: 3px;
        }

        .alert.stock .alert-text {
            color: #c2410c;
        }

        .alert.orders .alert-text {
            color: #2563eb;
        }

        .alert-link {
            padding: 9px 13px;

            border-radius: 8px;

            color: white;

            font-size: 10px;
            font-weight: 900;

            white-space: nowrap;
        }

        .alert.stock .alert-link {
            background: #f97316;
        }

        .alert.orders .alert-link {
            background: #2563eb;
        }


        /*
        |--------------------------------------------------------------------------
        | STATS PRINCIPALES
        |--------------------------------------------------------------------------
        */

        .stats {
            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 16px;

            margin-bottom: 18px;
        }

        .stat-card {
            background: white;

            border: 1px solid #e7e7e7;

            border-radius: 14px;

            padding: 20px;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 10px;
        }

        .stat-title {
            color: #71717a;

            font-size: 10px;
            font-weight: 800;

            text-transform: uppercase;
        }

        .stat-icon {
            width: 35px;
            height: 35px;

            border-radius: 9px;

            background: #f4f4f5;

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: 900;
        }

        .stat-value {
            margin-top: 14px;

            font-size: 28px;
            font-weight: 900;
        }

        .stat-description {
            color: #a1a1aa;

            font-size: 10px;

            margin-top: 5px;
        }


        /*
        |--------------------------------------------------------------------------
        | MINI STATS
        |--------------------------------------------------------------------------
        */

        .secondary-stats {
            display: grid;

            grid-template-columns: repeat(5, 1fr);

            gap: 12px;

            margin-bottom: 25px;
        }

        .mini-stat {
            background: white;

            border: 1px solid #e7e7e7;

            border-radius: 11px;

            padding: 15px 17px;
        }

        .mini-label {
            color: #71717a;

            font-size: 9px;
            font-weight: 800;

            text-transform: uppercase;
        }

        .mini-value {
            margin-top: 6px;

            font-size: 18px;
            font-weight: 900;
        }


        /*
        |--------------------------------------------------------------------------
        | GRID PRINCIPAL
        |--------------------------------------------------------------------------
        */

        .dashboard-grid {
            display: grid;

            grid-template-columns:
                minmax(0, 2fr)
                minmax(300px, .9fr);

            gap: 20px;

            align-items: start;

            margin-bottom: 20px;
        }


        /*
        |--------------------------------------------------------------------------
        | PANELS
        |--------------------------------------------------------------------------
        */

        .panel {
            background: white;

            border: 1px solid #e7e7e7;

            border-radius: 14px;

            overflow: hidden;
        }

        .panel-header {
            min-height: 70px;

            padding: 18px 20px;

            border-bottom: 1px solid #e7e7e7;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;
        }

        .panel-title {
            margin: 0;

            font-size: 15px;
            font-weight: 900;
        }

        .panel-description {
            color: #a1a1aa;

            font-size: 10px;

            margin-top: 4px;
        }

        .panel-link {
            color: #52525b;

            font-size: 10px;
            font-weight: 900;

            white-space: nowrap;
        }

        .panel-link:hover {
            color: #111;
        }


        /*
        |--------------------------------------------------------------------------
        | COMMANDES
        |--------------------------------------------------------------------------
        */

        .order {
            display: grid;

            grid-template-columns:
                minmax(120px, 1.1fr)
                minmax(120px, 1fr)
                .7fr
                .9fr
                auto;

            gap: 15px;

            align-items: center;

            padding: 16px 20px;

            border-bottom: 1px solid #f0f0f0;
        }

        .order:last-child {
            border-bottom: 0;
        }

        .order:hover {
            background: #fafafa;
        }

        .order-number {
            font-size: 12px;
            font-weight: 900;
        }

        .customer {
            font-size: 12px;
            font-weight: 700;
        }

        .muted {
            color: #a1a1aa;

            font-size: 9px;

            margin-top: 4px;
        }

        .amount {
            font-size: 12px;
            font-weight: 900;
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        .status {
            display: inline-flex;

            padding: 6px 9px;

            border-radius: 999px;

            font-size: 8px;
            font-weight: 900;

            white-space: nowrap;
        }

        .pending {
            background: #fff7ed;
            color: #c2410c;
        }

        .accepted {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .preparing {
            background: #f5f3ff;
            color: #6d28d9;
        }

        .ready {
            background: #f0fdf4;
            color: #15803d;
        }

        .picked_up {
            background: #f4f4f5;
            color: #52525b;
        }

        .cancelled {
            background: #fef2f2;
            color: #b91c1c;
        }

        .view {
            display: inline-flex;

            border: 1px solid #e4e4e7;

            background: white;

            padding: 7px 9px;

            border-radius: 7px;

            font-size: 9px;
            font-weight: 900;
        }

        .view:hover {
            background: #111;
            border-color: #111;
            color: white;
        }


        /*
        |--------------------------------------------------------------------------
        | STOCK
        |--------------------------------------------------------------------------
        */

        .stock-item {
            padding: 15px 18px;

            border-bottom: 1px solid #f0f0f0;
        }

        .stock-item:last-child {
            border-bottom: 0;
        }

        .stock-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 10px;
        }

        .stock-name {
            font-size: 12px;
            font-weight: 900;
        }

        .stock-category {
            color: #a1a1aa;

            font-size: 9px;

            margin-top: 4px;
        }

        .stock-number {
            min-width: 34px;

            text-align: center;

            padding: 6px 8px;

            border-radius: 7px;

            background: #fff7ed;
            color: #c2410c;

            font-size: 10px;
            font-weight: 900;
        }

        .stock-bar {
            height: 4px;

            background: #f4f4f5;

            border-radius: 99px;

            margin-top: 10px;

            overflow: hidden;
        }

        .stock-progress {
            height: 100%;

            background: #f97316;

            border-radius: 99px;
        }


        /*
        |--------------------------------------------------------------------------
        | COMMANDES URGENTES
        |--------------------------------------------------------------------------
        */

        .urgent-item {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            padding: 15px 18px;

            border-bottom: 1px solid #f0f0f0;
        }

        .urgent-item:last-child {
            border-bottom: 0;
        }

        .urgent-title {
            font-size: 11px;
            font-weight: 900;
        }

        .urgent-customer {
            color: #71717a;

            font-size: 9px;

            margin-top: 3px;
        }

        .urgent-pickup {
            margin-top: 5px;

            color: #52525b;

            font-size: 9px;
            font-weight: 700;
        }


        /*
        |--------------------------------------------------------------------------
        | EMPTY
        |--------------------------------------------------------------------------
        */

        .empty {
            padding: 35px 20px;

            text-align: center;

            color: #71717a;

            font-size: 11px;
        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1200px) {

            .stats {
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .secondary-stats {
                grid-template-columns:
                    repeat(3, 1fr);
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {

            .order {
                grid-template-columns:
                    repeat(2, 1fr);
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
                padding: 20px;
            }

            .content {
                padding: 25px 15px 40px;
            }
        }

        @media (max-width: 600px) {

            .stats,
            .secondary-stats {
                grid-template-columns: 1fr;
            }

            .order {
                grid-template-columns: 1fr;
            }

            .topbar-actions {
                display: none;
            }

            .alert {
                flex-direction: column;
                align-items: flex-start;
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
                class="nav-item active"
            >
                <span class="nav-icon">
                    ⌂
                </span>

                <span class="nav-text">
                    Dashboard
                </span>
            </a>


            <a
                href="{{ route('admin.orders.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">
                    ▣
                </span>

                <span class="nav-text">
                    Commandes
                </span>
            </a>


            <a
                href="{{ route('admin.products.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">
                    ◉
                </span>

                <span class="nav-text">
                    Produits
                </span>
            </a>


            <a
                href="{{ route('admin.categories.index') }}"
                class="nav-item"
            >
                <span class="nav-icon">
                    ▤
                </span>

                <span class="nav-text">
                    Catégories
                </span>
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
                <span class="nav-icon">
                    ◷
                </span>

                <span class="nav-text">
                    Créneaux
                </span>
            </a>

        </nav>


        <div class="sidebar-bottom">

            <div class="admin-user">

                <div class="avatar">

                    {{ strtoupper(
                        substr(
                            auth()->user()->name,
                            0,
                            1
                        )
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
                    Tableau de bord
                </h1>

                <div class="subtitle">
                    Vue d'ensemble de votre activité.
                </div>

            </div>


            <div class="topbar-actions">

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="top-button secondary"
                >
                    Commandes
                </a>


                <a
                    href="{{ route('catalog.index') }}"
                    target="_blank"
                    class="top-button primary"
                >
                    Voir la boutique ↗
                </a>

            </div>

        </header>


        <div class="content">


            <!-- ALERTES COMMANDES -->

            @if($ordersToProcess > 0)

                <div class="alert orders">

                    <div>

                        <div class="alert-title">
                            📦 Commandes à traiter
                        </div>

                        <div class="alert-text">

                            {{ $ordersToProcess }}

                            commande(s) sont actuellement
                            en attente, acceptées ou en préparation.

                        </div>

                    </div>


                    <a
                        href="{{ route(
                            'admin.orders.index'
                        ) }}"
                        class="alert-link"
                    >
                        Gérer les commandes
                    </a>

                </div>

            @endif


            <!-- ALERTE STOCK -->

            @if(
                $lowStockCount > 0
                ||
                $outOfStockProducts > 0
            )

                <div class="alert stock">

                    <div>

                        <div class="alert-title">
                            ⚠ Attention au stock
                        </div>

                        <div class="alert-text">

                            @if(
                                $outOfStockProducts > 0
                            )

                                {{ $outOfStockProducts }}
                                produit(s) en rupture.

                            @endif


                            @if(
                                $lowStockCount > 0
                            )

                                {{ $lowStockCount }}
                                produit(s) ont 5 unités
                                ou moins.

                            @endif

                        </div>

                    </div>


                    <a
                        href="{{ route(
                            'admin.products.index'
                        ) }}"
                        class="alert-link"
                    >
                        Voir les produits
                    </a>

                </div>

            @endif


            <!-- STATS PRINCIPALES -->

            <div class="stats">


                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-title">
                            CA aujourd'hui
                        </div>

                        <div class="stat-icon">
                            €
                        </div>

                    </div>


                    <div class="stat-value">

                        {{ number_format(
                            $revenueToday,
                            2,
                            ',',
                            ' '
                        ) }}
                        €

                    </div>


                    <div class="stat-description">
                        Hors commandes annulées
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-title">
                            Commandes aujourd'hui
                        </div>

                        <div class="stat-icon">
                            ▣
                        </div>

                    </div>


                    <div class="stat-value">
                        {{ $ordersToday }}
                    </div>


                    <div class="stat-description">
                        Nouvelles commandes du jour
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-title">
                            À traiter
                        </div>

                        <div class="stat-icon">
                            ◷
                        </div>

                    </div>


                    <div class="stat-value">
                        {{ $ordersToProcess }}
                    </div>


                    <div class="stat-description">

                        {{ $pendingOrders }}
                        en attente

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-title">
                            Prêtes
                        </div>

                        <div class="stat-icon">
                            ✓
                        </div>

                    </div>


                    <div class="stat-value">
                        {{ $readyOrders }}
                    </div>


                    <div class="stat-description">
                        En attente de retrait
                    </div>

                </div>


            </div>


            <!-- STATS SECONDAIRES -->

            <div class="secondary-stats">


                <div class="mini-stat">

                    <div class="mini-label">
                        Retraits aujourd'hui
                    </div>

                    <div class="mini-value">
                        {{ $pickupsToday }}
                    </div>

                </div>


                <div class="mini-stat">

                    <div class="mini-label">
                        En préparation
                    </div>

                    <div class="mini-value">
                        {{ $preparingOrders }}
                    </div>

                </div>


                <div class="mini-stat">

                    <div class="mini-label">
                        Produits actifs
                    </div>

                    <div class="mini-value">
                        {{ $activeProducts }}
                    </div>

                </div>


                <div class="mini-stat">

                    <div class="mini-label">
                        Panier moyen
                    </div>

                    <div class="mini-value">

                        {{ number_format(
                            $averageOrderValue,
                            2,
                            ',',
                            ' '
                        ) }}
                        €

                    </div>

                </div>


                <div class="mini-stat">

                    <div class="mini-label">
                        CA total
                    </div>

                    <div class="mini-value">

                        {{ number_format(
                            $totalRevenue,
                            2,
                            ',',
                            ' '
                        ) }}
                        €

                    </div>

                </div>


            </div>


            <!-- GRID 1 -->

            <div class="dashboard-grid">


                <!-- DERNIERES COMMANDES -->

                <section class="panel">

                    <div class="panel-header">

                        <div>

                            <h2 class="panel-title">
                                Dernières commandes
                            </h2>

                            <div class="panel-description">
                                Les 8 dernières commandes reçues.
                            </div>

                        </div>


                        <a
                            href="{{ route(
                                'admin.orders.index'
                            ) }}"
                            class="panel-link"
                        >
                            Toutes →
                        </a>

                    </div>


                    @forelse(
                        $latestOrders as $order
                    )


                        <div class="order">


                            <div>

                                <div class="order-number">
                                    {{ $order->order_number }}
                                </div>

                                <div class="muted">

                                    {{ $order->created_at
                                        ->format(
                                            'd/m/Y H:i'
                                        ) }}

                                </div>

                            </div>


                            <div>

                                <div class="customer">
                                    {{ $order->customer_name }}
                                </div>

                                <div class="muted">
                                    {{ $order->customer_phone }}
                                </div>

                            </div>


                            <div class="amount">

                                {{ number_format(
                                    $order->total,
                                    2,
                                    ',',
                                    ' '
                                ) }}
                                €

                            </div>


                            <div>

                                @switch(
                                    $order->status
                                )

                                    @case('pending')

                                        <span class="status pending">
                                            En attente
                                        </span>

                                        @break


                                    @case('accepted')

                                        <span class="status accepted">
                                            Acceptée
                                        </span>

                                        @break


                                    @case('preparing')

                                        <span class="status preparing">
                                            Préparation
                                        </span>

                                        @break


                                    @case('ready')

                                        <span class="status ready">
                                            Prête
                                        </span>

                                        @break


                                    @case('picked_up')

                                        <span class="status picked_up">
                                            Retirée
                                        </span>

                                        @break


                                    @case('cancelled')

                                        <span class="status cancelled">
                                            Annulée
                                        </span>

                                        @break


                                    @default

                                        <span class="status">
                                            {{ $order->status }}
                                        </span>

                                @endswitch

                            </div>


                            <div>

                                <a
                                    href="{{ route(
                                        'admin.orders.show',
                                        [
                                            'order' =>
                                                $order
                                        ]
                                    ) }}"
                                    class="view"
                                >
                                    Voir
                                </a>

                            </div>


                        </div>


                    @empty


                        <div class="empty">

                            Aucune commande pour le moment.

                        </div>


                    @endforelse


                </section>


                <!-- STOCK FAIBLE -->

                <section class="panel">

                    <div class="panel-header">

                        <div>

                            <h2 class="panel-title">
                                Stock faible
                            </h2>

                            <div class="panel-description">

                                {{ $lowStockCount }}
                                produit(s) à surveiller.

                            </div>

                        </div>


                        <a
                            href="{{ route(
                                'admin.products.index'
                            ) }}"
                            class="panel-link"
                        >
                            Produits →
                        </a>

                    </div>


                    @forelse(
                        $lowStockProducts as $product
                    )


                        <div class="stock-item">


                            <div class="stock-top">

                                <div>

                                    <div class="stock-name">
                                        {{ $product->name }}
                                    </div>

                                    <div class="stock-category">

                                        {{ $product
                                            ->category?->name
                                            ??
                                            'Sans catégorie' }}

                                    </div>

                                </div>


                                <div class="stock-number">
                                    {{ $product->stock }}
                                </div>

                            </div>


                            <div class="stock-bar">

                                <div
                                    class="stock-progress"
                                    style="
                                        width:
                                        {{ min(
                                            100,
                                            max(
                                                8,
                                                (
                                                    $product->stock
                                                    /
                                                    5
                                                )
                                                *
                                                100
                                            )
                                        ) }}%;
                                    "
                                ></div>

                            </div>


                        </div>


                    @empty


                        <div class="empty">

                            ✓ Aucun produit en stock faible.

                        </div>


                    @endforelse


                </section>


            </div>


            <!-- GRID 2 -->

            <div class="dashboard-grid">


                <!-- COMMANDES PRIORITAIRES -->

                <section class="panel">

                    <div class="panel-header">

                        <div>

                            <h2 class="panel-title">
                                Commandes prioritaires
                            </h2>

                            <div class="panel-description">
                                Commandes à traiter prochainement.
                            </div>

                        </div>

                    </div>


                    @forelse(
                        $urgentOrders as $order
                    )


                        <div class="urgent-item">


                            <div>

                                <div class="urgent-title">
                                    {{ $order->order_number }}
                                </div>

                                <div class="urgent-customer">
                                    {{ $order->customer_name }}
                                </div>


                                <div class="urgent-pickup">

                                    Retrait :

                                    @if($order->pickup_date)

                                        {{ $order
                                            ->pickup_date
                                            ->format(
                                                'd/m/Y'
                                            ) }}

                                    @endif


                                    @if($order->pickup_time)

                                        à

                                        {{ substr(
                                            $order->pickup_time,
                                            0,
                                            5
                                        ) }}

                                    @endif

                                </div>

                            </div>


                            <div>

                                <a
                                    href="{{ route(
                                        'admin.orders.show',
                                        [
                                            'order' =>
                                                $order
                                        ]
                                    ) }}"
                                    class="view"
                                >
                                    Traiter
                                </a>

                            </div>


                        </div>


                    @empty


                        <div class="empty">

                            ✓ Aucune commande urgente.

                        </div>


                    @endforelse


                </section>


                <!-- RÉSUMÉ BOUTIQUE -->

                <section class="panel">

                    <div class="panel-header">

                        <div>

                            <h2 class="panel-title">
                                Résumé boutique
                            </h2>

                            <div class="panel-description">
                                Indicateurs généraux.
                            </div>

                        </div>

                    </div>


                    <div class="stock-item">

                        <div class="stock-top">

                            <div class="stock-name">
                                Commandes totales
                            </div>

                            <div class="stock-number">
                                {{ $totalOrders }}
                            </div>

                        </div>

                    </div>


                    <div class="stock-item">

                        <div class="stock-top">

                            <div class="stock-name">
                                En attente
                            </div>

                            <div class="stock-number">
                                {{ $pendingOrders }}
                            </div>

                        </div>

                    </div>


                    <div class="stock-item">

                        <div class="stock-top">

                            <div class="stock-name">
                                Acceptées
                            </div>

                            <div class="stock-number">
                                {{ $acceptedOrders }}
                            </div>

                        </div>

                    </div>


                    <div class="stock-item">

                        <div class="stock-top">

                            <div class="stock-name">
                                Ruptures de stock
                            </div>

                            <div class="stock-number">
                                {{ $outOfStockProducts }}
                            </div>

                        </div>

                    </div>


                </section>


            </div>


        </div>


    </main>


</div>

</body>

</html>