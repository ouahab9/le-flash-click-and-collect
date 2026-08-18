<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Créneaux de retrait — Le Flash</title>

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

        /*
        |--------------------------------------------------------------------------
        | ALERTES
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | TOOLBAR
        |--------------------------------------------------------------------------
        */

        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 20px;
        }

        .count {
            color: #71717a;
            font-size: 13px;
        }

        .add-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
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

        /*
        |--------------------------------------------------------------------------
        | RÉSUMÉ
        |--------------------------------------------------------------------------
        */

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 20px;
        }

        .summary-card {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 12px;
            padding: 16px;
        }

        .summary-label {
            color: #71717a;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .summary-value {
            margin-top: 6px;
            font-size: 22px;
            font-weight: 900;
        }

        /*
        |--------------------------------------------------------------------------
        | PANEL
        |--------------------------------------------------------------------------
        */

        .panel {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 14px;
            overflow: hidden;
        }

        .slots-head,
        .slot-row {
            display: grid;

            grid-template-columns:
                1.1fr
                1fr
                1.4fr
                1fr
                1.2fr
                170px;

            gap: 18px;
            align-items: center;
        }

        .slots-head {
            padding: 13px 22px;
            background: #fafafa;
            border-bottom: 1px solid #e7e7e7;
            color: #71717a;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .slot-row {
            padding: 18px 22px;
            border-bottom: 1px solid #f0f0f0;
            transition: .15s;
        }

        .slot-row:hover {
            background: #fafafa;
        }

        .slot-row:last-child {
            border-bottom: 0;
        }

        .slot-row.past {
            background: #fafafa;
            opacity: .7;
        }

        /*
        |--------------------------------------------------------------------------
        | DATE / HEURE
        |--------------------------------------------------------------------------
        */

        .date-main {
            font-size: 13px;
            font-weight: 900;
        }

        .date-small {
            color: #71717a;
            font-size: 11px;
            margin-top: 4px;
            text-transform: capitalize;
        }

        .time {
            font-size: 13px;
            font-weight: 800;
        }

        /*
        |--------------------------------------------------------------------------
        | CAPACITÉ
        |--------------------------------------------------------------------------
        */

        .capacity-main {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .capacity-number {
            font-size: 12px;
            font-weight: 900;
        }

        .capacity-percent {
            color: #71717a;
            font-size: 10px;
            font-weight: 700;
        }

        .capacity-bar {
            width: 100%;
            height: 6px;
            margin-top: 8px;
            border-radius: 999px;
            background: #f4f4f5;
            overflow: hidden;
        }

        .capacity-progress {
            height: 100%;
            border-radius: 999px;
            background: #111;
        }

        .capacity-progress.warning {
            background: #f97316;
        }

        .capacity-progress.full {
            background: #dc2626;
        }

        /*
        |--------------------------------------------------------------------------
        | COMMANDES
        |--------------------------------------------------------------------------
        */

        .orders-count {
            font-size: 12px;
            font-weight: 900;
        }

        .orders-help {
            color: #a1a1aa;
            font-size: 10px;
            margin-top: 4px;
        }

        /*
        |--------------------------------------------------------------------------
        | BADGES
        |--------------------------------------------------------------------------
        */

        .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .status {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 900;
            white-space: nowrap;
        }

        .status.active {
            background: #f0fdf4;
            color: #15803d;
        }

        .status.inactive {
            background: #f4f4f5;
            color: #71717a;
        }

        .status.full {
            background: #fef2f2;
            color: #b91c1c;
        }

        .status.past {
            background: #f4f4f5;
            color: #52525b;
        }

        .status.available {
            background: #eff6ff;
            color: #1d4ed8;
        }

        /*
        |--------------------------------------------------------------------------
        | ACTIONS
        |--------------------------------------------------------------------------
        */

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 7px;
        }

        .action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 10px;
            border: 1px solid #e4e4e7;
            background: white;
            color: #111;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .action:hover {
            background: #111;
            border-color: #111;
            color: white;
        }

        .action.delete {
            color: #b91c1c;
        }

        .action.delete:hover {
            background: #b91c1c;
            border-color: #b91c1c;
            color: white;
        }

        /*
        |--------------------------------------------------------------------------
        | EMPTY
        |--------------------------------------------------------------------------
        */

        .empty {
            padding: 70px 20px;
            text-align: center;
            color: #71717a;
        }

        .pagination {
            padding: 18px 22px;
            border-top: 1px solid #eee;
        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1200px) {

            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .slots-head {
                display: none;
            }

            .slot-row {
                grid-template-columns: repeat(2, 1fr);
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
                padding: 20px;
            }

            .content {
                padding: 25px 15px;
            }
        }

        @media (max-width: 550px) {

            .summary-grid,
            .slot-row {
                grid-template-columns: 1fr;
            }

            .toolbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .add-button {
                width: 100%;
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
                class="nav-item active"
            >
                <span class="nav-icon">◷</span>
                <span class="nav-text">Créneaux</span>
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
                    Créneaux de retrait
                </h1>

                <div class="subtitle">
                    Gérez les disponibilités pour le Click & Collect.
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


            @php

                $totalSlots = $pickupSlots->total();

                $visibleSlots = $pickupSlots->getCollection();

                $activeSlots = $visibleSlots
                    ->where('active', true)
                    ->count();

                $pastSlots = $visibleSlots
                    ->filter(function ($slot) {

                        $start = \Carbon\Carbon::parse(
                            $slot->date->format('Y-m-d') .
                            ' ' .
                            $slot->start_time
                        );

                        return $start->isPast();

                    })
                    ->count();

                $fullSlots = $visibleSlots
                    ->filter(function ($slot) {

                        return
                            $slot->active_orders_count
                            >=
                            $slot->max_orders;

                    })
                    ->count();

            @endphp


            <!-- RÉSUMÉ -->

            <div class="summary-grid">

                <div class="summary-card">

                    <div class="summary-label">
                        Total
                    </div>

                    <div class="summary-value">
                        {{ $totalSlots }}
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-label">
                        Actifs sur cette page
                    </div>

                    <div class="summary-value">
                        {{ $activeSlots }}
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-label">
                        Complets sur cette page
                    </div>

                    <div class="summary-value">
                        {{ $fullSlots }}
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-label">
                        Passés sur cette page
                    </div>

                    <div class="summary-value">
                        {{ $pastSlots }}
                    </div>

                </div>

            </div>


            <!-- TOOLBAR -->

            <div class="toolbar">

                <div class="count">

                    {{ $pickupSlots->total() }}
                    créneau(x)

                </div>

                <a
                    href="{{ route(
                        'admin.pickup-slots.create'
                    ) }}"
                    class="add-button"
                >
                    + Ajouter un créneau
                </a>

            </div>


            <!-- LISTE -->

            <div class="panel">


                @if($pickupSlots->count())


                    <div class="slots-head">

                        <div>Date</div>

                        <div>Horaire</div>

                        <div>Remplissage</div>

                        <div>Commandes</div>

                        <div>État</div>

                        <div></div>

                    </div>


                    @foreach($pickupSlots as $pickupSlot)


                        @php

                            $slotStart = \Carbon\Carbon::parse(
                                $pickupSlot->date->format('Y-m-d') .
                                ' ' .
                                $pickupSlot->start_time
                            );

                            $isPast =
                                $slotStart->isPast();

                            $activeOrders =
                                (int)
                                $pickupSlot->active_orders_count;

                            $maxOrders =
                                max(
                                    1,
                                    (int)
                                    $pickupSlot->max_orders
                                );

                            $isFull =
                                $activeOrders
                                >=
                                $maxOrders;

                            $percentage = min(
                                100,
                                round(
                                    (
                                        $activeOrders
                                        /
                                        $maxOrders
                                    )
                                    * 100
                                )
                            );

                        @endphp


                        <div
                            class="
                                slot-row
                                {{ $isPast ? 'past' : '' }}
                            "
                        >


                            <!-- DATE -->

                            <div>

                                <div class="date-main">

                                    {{ $pickupSlot->date
                                        ->format('d/m/Y') }}

                                </div>

                                <div class="date-small">

                                    {{ $pickupSlot->date
                                        ->locale('fr')
                                        ->translatedFormat('l') }}

                                </div>

                            </div>


                            <!-- HORAIRE -->

                            <div class="time">

                                {{ substr(
                                    $pickupSlot->start_time,
                                    0,
                                    5
                                ) }}

                                —

                                {{ substr(
                                    $pickupSlot->end_time,
                                    0,
                                    5
                                ) }}

                            </div>


                            <!-- CAPACITÉ -->

                            <div>

                                <div class="capacity-main">

                                    <div class="capacity-number">

                                        {{ $activeOrders }}
                                        /
                                        {{ $maxOrders }}

                                    </div>

                                    <div class="capacity-percent">

                                        {{ $percentage }} %

                                    </div>

                                </div>


                                <div class="capacity-bar">

                                    <div
                                        class="
                                            capacity-progress

                                            @if($isFull)
                                                full
                                            @elseif($percentage >= 70)
                                                warning
                                            @endif
                                        "
                                        style="
                                            width:
                                            {{ $percentage }}%;
                                        "
                                    ></div>

                                </div>

                            </div>


                            <!-- COMMANDES -->

                            <div>

                                <div class="orders-count">

                                    {{ $activeOrders }}
                                    commande(s)

                                </div>

                                <div class="orders-help">

                                    {{ max(
                                        0,
                                        $maxOrders
                                        -
                                        $activeOrders
                                    ) }}
                                    place(s) restante(s)

                                </div>

                            </div>


                            <!-- ETAT -->

                            <div class="badges">


                                @if($isPast)

                                    <span class="status past">
                                        Passé
                                    </span>

                                @elseif($isFull)

                                    <span class="status full">
                                        Complet
                                    </span>

                                @else

                                    <span class="status available">
                                        Disponible
                                    </span>

                                @endif


                                @if($pickupSlot->active)

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
                                        'admin.pickup-slots.edit',
                                        [
                                            'pickupSlot' =>
                                                $pickupSlot->id
                                        ]
                                    ) }}"
                                    class="action"
                                >
                                    Modifier
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route(
                                        'admin.pickup-slots.destroy',
                                        [
                                            'pickupSlot' =>
                                                $pickupSlot->id
                                        ]
                                    ) }}"
                                    onsubmit="
                                        return confirm(
                                            'Supprimer définitivement ce créneau ?'
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


                    @if($pickupSlots->hasPages())

                        <div class="pagination">

                            {{ $pickupSlots->links() }}

                        </div>

                    @endif


                @else


                    <div class="empty">

                        <div
                            style="
                                font-size:36px;
                                margin-bottom:15px;
                            "
                        >
                            ◷
                        </div>


                        <strong>
                            Aucun créneau
                        </strong>

                        <div style="margin-top:5px;">

                            Ajoutez vos premiers créneaux
                            de retrait.

                        </div>

                        <div style="margin-top:20px;">

                            <a
                                href="{{ route(
                                    'admin.pickup-slots.create'
                                ) }}"
                                class="add-button"
                            >
                                + Ajouter un créneau
                            </a>

                        </div>

                    </div>


                @endif


            </div>


        </div>


    </main>

</div>

</body>

</html>