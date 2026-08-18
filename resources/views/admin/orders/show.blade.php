<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>{{ $order->order_number }} — Le Flash</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background: #f6f6f6;
        color: #111;
        font-family: Inter, ui-sans-serif, system-ui, -apple-system,
            BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    a {
        text-decoration: none;
        color: inherit;
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
        height: 90px;
        background: white;
        border-bottom: 1px solid #e7e7e7;
        display: flex;
        align-items: center;
        justify-content: space-between;
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
        max-width: 1250px;
    }

    .back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #52525b;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .back:hover {
        color: #111;
    }

    .grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 330px;
        gap: 20px;
    }

    .box {
        background: white;
        border: 1px solid #e7e7e7;
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .box-header {
        padding: 20px 22px;
        border-bottom: 1px solid #e7e7e7;
    }

    .box-header h2 {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
    }

    .box-header p {
        margin: 5px 0 0;
        color: #71717a;
        font-size: 12px;
    }

    .box-body {
        padding: 22px;
    }

    /* ORDER HEADER */

    .order-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .order-number {
        font-size: 25px;
        font-weight: 900;
        letter-spacing: -.7px;
    }

    .order-date {
        color: #71717a;
        font-size: 12px;
        margin-top: 5px;
    }

    /* INFO */

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .info {
        padding: 16px;
        background: #fafafa;
        border: 1px solid #eeeeee;
        border-radius: 10px;
    }

    .info-label {
        color: #71717a;
        font-size: 10px;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: .7px;
        margin-bottom: 7px;
    }

    .info-value {
        font-size: 14px;
        font-weight: 700;
    }

    .info-small {
        color: #71717a;
        font-size: 11px;
        margin-top: 4px;
    }

    /* PRODUCTS */

    .product {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 17px 0;
        border-bottom: 1px solid #eeeeee;
    }

    .product:last-child {
        border-bottom: 0;
    }

    .product-name {
        font-size: 14px;
        font-weight: 700;
    }

    .product-quantity {
        color: #71717a;
        font-size: 12px;
        margin-top: 4px;
    }

    .product-price {
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
    }

    .total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        margin-top: 5px;
        border-top: 2px solid #111;
    }

    .total-label {
        font-size: 14px;
        font-weight: 700;
    }

    .total-price {
        font-size: 24px;
        font-weight: 900;
    }

    /* STATUS */

    .status-box {
        position: sticky;
        top: 20px;
    }

    .current-status {
        text-align: center;
        padding: 20px;
        border-radius: 12px;
        background: #fafafa;
        border: 1px solid #eeeeee;
        margin-bottom: 20px;
    }

    .current-label {
        color: #71717a;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .8px;
        margin-bottom: 10px;
    }

    .status {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
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

    .form-label {
        display: block;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    select {
        width: 100%;
        padding: 12px;
        border-radius: 9px;
        border: 1px solid #d4d4d8;
        background: white;
        font-size: 13px;
        outline: none;
    }

    select:focus {
        border-color: #111;
    }

    .update {
        width: 100%;
        margin-top: 12px;
        padding: 12px;
        border: 0;
        border-radius: 9px;
        background: #111;
        color: white;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
    }

    .update:hover {
        background: #292929;
    }

    /* RESPONSIVE */

    @media (max-width: 1050px) {
        .grid {
            grid-template-columns: 1fr;
        }

        .status-box {
            position: static;
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
        .info-grid {
            grid-template-columns: 1fr;
        }

        .order-heading {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
```

</head>

<body>

<div class="layout">

```
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

        <a href="{{ route('dashboard') }}" class="nav-item">
            <span class="nav-icon">⌂</span>
            <span class="nav-text">Dashboard</span>
        </a>

        <a href="{{ route('admin.orders.index') }}" class="nav-item active">
            <span class="nav-icon">▣</span>
            <span class="nav-text">Commandes</span>
        </a>

        <a href="#" class="nav-item">
            <span class="nav-icon">◉</span>
            <span class="nav-text">Produits</span>
        </a>

        <a href="#" class="nav-item">
            <span class="nav-icon">▤</span>
            <span class="nav-text">Catégories</span>
        </a>

        <div style="margin-top:28px;" class="nav-label">
            Gestion
        </div>

        <a href="#" class="nav-item">
            <span class="nav-icon">◷</span>
            <span class="nav-text">Créneaux</span>
        </a>

        <a href="#" class="nav-item">
            <span class="nav-icon">⚙</span>
            <span class="nav-text">Paramètres</span>
        </a>

    </nav>


    <div class="sidebar-bottom">

        <div class="admin-user">

            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
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


        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button type="submit" class="logout">
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
                Détail de la commande
            </h1>

            <div class="subtitle">
                Consultez et gérez cette commande.
            </div>

        </div>

    </header>


    <div class="content">

        <a
            href="{{ route('admin.orders.index') }}"
            class="back"
        >
            ← Retour aux commandes
        </a>


        <div class="grid">

            <!-- COLONNE PRINCIPALE -->

            <div>

                <!-- COMMANDE -->

                <div class="box">

                    <div class="box-body">

                        <div class="order-heading">

                            <div>

                                <div class="order-number">
                                    #{{ $order->order_number }}
                                </div>

                                <div class="order-date">
                                    Commande passée le
                                    {{ $order->created_at->format('d/m/Y à H:i') }}
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

                                @endswitch

                            </div>

                        </div>

                    </div>

                </div>


                <!-- CLIENT -->

                <div class="box">

                    <div class="box-header">

                        <h2>
                            Informations client
                        </h2>

                        <p>
                            Coordonnées associées à la commande.
                        </p>

                    </div>


                    <div class="box-body">

                        <div class="info-grid">

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

                        </div>

                    </div>

                </div>


                <!-- RETRAIT -->

                <div class="box">

                    <div class="box-header">

                        <h2>
                            Retrait
                        </h2>

                        <p>
                            Informations concernant le retrait de la commande.
                        </p>

                    </div>


                    <div class="box-body">

                        @if($order->pickupSlot)

                            <div class="info-grid">

                                <div class="info">

                                    <div class="info-label">
                                        Date
                                    </div>

                                    <div class="info-value">
                                        {{ $order->pickupSlot->date->format('d/m/Y') }}
                                    </div>

                                </div>


                                <div class="info">

                                    <div class="info-label">
                                        Créneau
                                    </div>

                                    <div class="info-value">

                                        {{ substr($order->pickupSlot->start_time, 0, 5) }}

                                        —

                                        {{ substr($order->pickupSlot->end_time, 0, 5) }}

                                    </div>

                                </div>

                            </div>

                        @else

                            <div style="color:#71717a;font-size:13px;">
                                Aucun créneau de retrait associé.
                            </div>

                        @endif

                    </div>

                </div>


                <!-- PRODUITS -->

                <div class="box">

                    <div class="box-header">

                        <h2>
                            Produits commandés
                        </h2>

                        <p>
                            Détail des articles de la commande.
                        </p>

                    </div>


                    <div class="box-body">

                        @forelse($order->items as $item)

                            <div class="product">

                                <div>

                                    <div class="product-name">
                                        {{ $item->product_name }}
                                    </div>

                                    <div class="product-quantity">
                                        Quantité : {{ $item->quantity }}
                                    </div>

                                </div>


                                <div class="product-price">

                                    {{ number_format($item->total_price, 2, ',', ' ') }}
                                    €

                                </div>

                            </div>

                        @empty

                            <div style="color:#71717a;font-size:13px;">
                                Aucun produit dans cette commande.
                            </div>

                        @endforelse


                        <div class="total">

                            <span class="total-label">
                                Total de la commande
                            </span>

                            <span class="total-price">
                                {{ number_format($order->total, 2, ',', ' ') }} €
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            <!-- COLONNE DROITE -->

            <aside>

                <div class="box status-box">

                    <div class="box-header">

                        <h2>
                            Gestion du statut
                        </h2>

                        <p>
                            Mettez à jour l'avancement de la commande.
                        </p>

                    </div>


                    <div class="box-body">

                        <div class="current-status">

                            <div class="current-label">
                                Statut actuel
                            </div>


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

                            @endswitch

                        </div>


                        <form
                            method="POST"
                            action="{{ route('admin.orders.status', $order) }}"
                        >

                            @csrf
                            @method('PATCH')


                            <label
                                for="status"
                                class="form-label"
                            >
                                Nouveau statut
                            </label>


                            <select
                                id="status"
                                name="status"
                            >

                                <option
                                    value="pending"
                                    @selected($order->status === 'pending')
                                >
                                    En attente
                                </option>

                                <option
                                    value="accepted"
                                    @selected($order->status === 'accepted')
                                >
                                    Acceptée
                                </option>

                                <option
                                    value="preparing"
                                    @selected($order->status === 'preparing')
                                >
                                    En préparation
                                </option>

                                <option
                                    value="ready"
                                    @selected($order->status === 'ready')
                                >
                                    Prête
                                </option>

                                <option
                                    value="picked_up"
                                    @selected($order->status === 'picked_up')
                                >
                                    Retirée
                                </option>

                                <option
                                    value="cancelled"
                                    @selected($order->status === 'cancelled')
                                >
                                    Annulée
                                </option>

                            </select>


                            <button
                                type="submit"
                                class="update"
                            >
                                Mettre à jour le statut
                            </button>

                        </form>

                    </div>

                </div>

            </aside>

        </div>

    </div>

</main>
```

</div>

</body>

</html>
