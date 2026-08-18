<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Commandes — Le Flash</title>

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

        button,
        input {
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

        /* MAIN */

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
            padding: 20px 40px;
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

        /* MESSAGES */

        .message {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 12px;
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

        /* FILTERS */

        .filters {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-input {
            flex: 1;
            min-width: 0;
            border: 1px solid #d4d4d8;
            border-radius: 9px;
            padding: 11px 13px;
            outline: none;
            font-size: 13px;
        }

        .search-input:focus {
            border-color: #111;
        }

        .search-button {
            border: 0;
            background: #111;
            color: white;
            border-radius: 9px;
            padding: 0 20px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 800;
        }

        .search-button:hover {
            background: #292929;
        }

        .reset-button {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f4f4f5;
            color: #52525b;
            border-radius: 9px;
            padding: 0 17px;
            font-size: 12px;
            font-weight: 800;
        }

        .status-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #eee;
        }

        .filter {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 11px;
            border: 1px solid #e4e4e7;
            border-radius: 8px;
            background: white;
            font-size: 11px;
            font-weight: 700;
        }

        .filter:hover {
            background: #f4f4f5;
        }

        .filter.active {
            background: #111;
            border-color: #111;
            color: white;
        }

        .filter-count {
            display: inline-flex;
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: #f4f4f5;
            color: #52525b;
            font-size: 9px;
        }

        .filter.active .filter-count {
            background: #333;
            color: white;
        }

        /* PANEL */

        .panel {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 14px;
            overflow: hidden;
        }

        .panel-header {
            padding: 22px;
            border-bottom: 1px solid #e7e7e7;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .panel-header h2 {
            margin: 0;
            font-size: 17px;
        }

        .count {
            color: #71717a;
            font-size: 12px;
            margin-top: 4px;
        }

        /* ORDERS */

        .orders-head,
        .order-row {
            display: grid;
            grid-template-columns:
                1.2fr
                1.4fr
                .7fr
                1fr
                1fr
                .5fr;

            gap: 15px;
            align-items: center;
        }

        .orders-head {
            padding: 13px 22px;
            background: #fafafa;
            border-bottom: 1px solid #e7e7e7;
            color: #71717a;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .order-row {
            padding: 18px 22px;
            border-bottom: 1px solid #f0f0f0;
        }

        .order-row:hover {
            background: #fafafa;
        }

        .order-row:last-child {
            border-bottom: 0;
        }

        .order-number {
            font-weight: 800;
            font-size: 13px;
        }

        .date {
            color: #71717a;
            font-size: 11px;
            margin-top: 4px;
        }

        .customer {
            font-weight: 700;
            font-size: 13px;
        }

        .phone {
            color: #71717a;
            font-size: 11px;
            margin-top: 4px;
        }

        .total {
            font-weight: 800;
            font-size: 13px;
        }

        /* STATUS */

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 800;
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

        .show {
            display: inline-block;
            border: 1px solid #e4e4e7;
            background: white;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
        }

        .show:hover {
            background: #111;
            color: white;
            border-color: #111;
        }

        /* EMPTY */

        .empty {
            padding: 70px 20px;
            text-align: center;
            color: #71717a;
        }

        /* PAGINATION */

        .pagination-container {
            padding: 18px 22px;
            border-top: 1px solid #e7e7e7;
        }

        /* RESPONSIVE */

        @media (max-width: 1100px) {

            .orders-head {
                display: none;
            }

            .order-row {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
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
                padding: 25px 15px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-button,
            .reset-button {
                padding: 11px;
            }
        }

        @media (max-width: 550px) {

            .order-row {
                grid-template-columns: 1fr;
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
                class="nav-item active"
            >
                <span class="nav-icon">▣</span>
                <span class="nav-text">Commandes</span>
            </a>


            <a
                href="{{ route('admin.products.index') }}"
                class="nav-item"
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
                    Commandes
                </h1>

                <div class="subtitle">
                    Recherchez, filtrez et gérez les commandes.
                </div>

            </div>

        </header>


        <div class="content">


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


            <!-- RECHERCHE + FILTRES -->

            <section class="filters">


                <form
                    method="GET"
                    action="{{ route('admin.orders.index') }}"
                    class="search-form"
                >

                    @if($status)

                        <input
                            type="hidden"
                            name="status"
                            value="{{ $status }}"
                        >

                    @endif


                    <input
                        type="search"
                        name="search"
                        class="search-input"
                        value="{{ $search }}"
                        placeholder="Numéro de commande, nom ou téléphone..."
                    >


                    <button
                        type="submit"
                        class="search-button"
                    >
                        Rechercher
                    </button>


                    @if($search || $status)

                        <a
                            href="{{ route('admin.orders.index') }}"
                            class="reset-button"
                        >
                            Réinitialiser
                        </a>

                    @endif

                </form>


                <div class="status-filters">


                    <a
                        href="{{ route('admin.orders.index', array_filter([
                            'search' => $search,
                        ])) }}"
                        class="filter {{ !$status ? 'active' : '' }}"
                    >
                        Toutes

                        <span class="filter-count">
                            {{ $counts['all'] }}
                        </span>
                    </a>


                    <a
                        href="{{ route('admin.orders.index', array_filter([
                            'status' => 'pending',
                            'search' => $search,
                        ])) }}"
                        class="filter {{ $status === 'pending' ? 'active' : '' }}"
                    >
                        En attente

                        <span class="filter-count">
                            {{ $counts['pending'] }}
                        </span>
                    </a>


                    <a
                        href="{{ route('admin.orders.index', array_filter([
                            'status' => 'accepted',
                            'search' => $search,
                        ])) }}"
                        class="filter {{ $status === 'accepted' ? 'active' : '' }}"
                    >
                        Acceptées

                        <span class="filter-count">
                            {{ $counts['accepted'] }}
                        </span>
                    </a>


                    <a
                        href="{{ route('admin.orders.index', array_filter([
                            'status' => 'preparing',
                            'search' => $search,
                        ])) }}"
                        class="filter {{ $status === 'preparing' ? 'active' : '' }}"
                    >
                        En préparation

                        <span class="filter-count">
                            {{ $counts['preparing'] }}
                        </span>
                    </a>


                    <a
                        href="{{ route('admin.orders.index', array_filter([
                            'status' => 'ready',
                            'search' => $search,
                        ])) }}"
                        class="filter {{ $status === 'ready' ? 'active' : '' }}"
                    >
                        Prêtes

                        <span class="filter-count">
                            {{ $counts['ready'] }}
                        </span>
                    </a>


                    <a
                        href="{{ route('admin.orders.index', array_filter([
                            'status' => 'picked_up',
                            'search' => $search,
                        ])) }}"
                        class="filter {{ $status === 'picked_up' ? 'active' : '' }}"
                    >
                        Retirées

                        <span class="filter-count">
                            {{ $counts['picked_up'] }}
                        </span>
                    </a>


                    <a
                        href="{{ route('admin.orders.index', array_filter([
                            'status' => 'cancelled',
                            'search' => $search,
                        ])) }}"
                        class="filter {{ $status === 'cancelled' ? 'active' : '' }}"
                    >
                        Annulées

                        <span class="filter-count">
                            {{ $counts['cancelled'] }}
                        </span>
                    </a>


                </div>

            </section>


            <!-- LISTE -->

            <div class="panel">


                <div class="panel-header">

                    <div>

                        <h2>

                            @switch($status)

                                @case('pending')
                                    Commandes en attente
                                    @break

                                @case('accepted')
                                    Commandes acceptées
                                    @break

                                @case('preparing')
                                    Commandes en préparation
                                    @break

                                @case('ready')
                                    Commandes prêtes
                                    @break

                                @case('picked_up')
                                    Commandes retirées
                                    @break

                                @case('cancelled')
                                    Commandes annulées
                                    @break

                                @default
                                    Toutes les commandes

                            @endswitch

                        </h2>


                        <div class="count">

                            {{ $orders->total() }}
                            commande(s) trouvée(s)

                        </div>

                    </div>

                </div>


                @if($orders->count())


                    <div class="orders-head">

                        <div>Commande</div>
                        <div>Client</div>
                        <div>Total</div>
                        <div>Retrait</div>
                        <div>Statut</div>
                        <div></div>

                    </div>


                    @foreach($orders as $order)


                        <div class="order-row">


                            <div>

                                <div class="order-number">
                                    {{ $order->order_number }}
                                </div>

                                <div class="date">

                                    Créée le

                                    {{ $order->created_at
                                        ->format('d/m/Y H:i') }}

                                </div>

                            </div>


                            <div>

                                <div class="customer">
                                    {{ $order->customer_name }}
                                </div>

                                <div class="phone">
                                    {{ $order->customer_phone }}
                                </div>

                            </div>


                            <div class="total">

                                {{ number_format(
                                    $order->total,
                                    2,
                                    ',',
                                    ' '
                                ) }} €

                            </div>


                            <div>

                                <div
                                    style="
                                        font-size:12px;
                                        font-weight:700;
                                    "
                                >

                                    @if($order->pickup_date)

                                        {{ $order->pickup_date
                                            ->format('d/m/Y') }}

                                    @else

                                        —

                                    @endif

                                </div>


                                <div class="date">

                                    @if($order->pickup_time)

                                        {{ substr(
                                            $order->pickup_time,
                                            0,
                                            5
                                        ) }}

                                    @else

                                        —

                                    @endif

                                </div>

                            </div>


                            <div>


                                @switch($order->status)


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
                                            En préparation
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
                                        ['order' => $order]
                                    ) }}"
                                    class="show"
                                >
                                    Voir
                                </a>

                            </div>


                        </div>


                    @endforeach


                    @if($orders->hasPages())

                        <div class="pagination-container">
                            {{ $orders->links() }}
                        </div>

                    @endif


                @else


                    <div class="empty">

                        <div
                            style="
                                font-size:35px;
                                margin-bottom:15px;
                            "
                        >
                            ▣
                        </div>


                        <strong>
                            Aucune commande trouvée
                        </strong>


                        <div style="margin-top:5px;">

                            @if($search)

                                Aucun résultat pour
                                « {{ $search }} ».

                            @elseif($status)

                                Aucune commande avec ce statut.

                            @else

                                Les nouvelles commandes apparaîtront ici.

                            @endif

                        </div>


                        @if($search || $status)

                            <div style="margin-top:20px;">

                                <a
                                    href="{{ route('admin.orders.index') }}"
                                    class="show"
                                >
                                    Afficher toutes les commandes
                                </a>

                            </div>

                        @endif

                    </div>


                @endif


            </div>

        </div>

    </main>

</div>

</body>

</html>