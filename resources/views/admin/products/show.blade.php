<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->name }} — Le Flash</title>

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
            color: inherit;
            text-decoration: none;
        }

        .layout {
            min-height: 100vh;
            display: flex;
        }

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

        .topbar-title {
            font-size: 22px;
            font-weight: 800;
        }

        .topbar-subtitle {
            color: #71717a;
            font-size: 13px;
            margin-top: 4px;
        }

        .content {
            max-width: 1100px;
            padding: 35px 40px 60px;
        }

        .back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #52525b;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 22px;
        }

        .card {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 14px;
            overflow: hidden;
        }

        .image-box {
            min-height: 360px;
            background: #f4f4f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-box img {
            width: 100%;
            height: 360px;
            object-fit: cover;
        }

        .placeholder {
            color: #a1a1aa;
            font-size: 60px;
        }

        .card-body {
            padding: 26px;
        }

        .product-name {
            margin: 0;
            font-size: 27px;
            font-weight: 900;
        }

        .product-id {
            color: #a1a1aa;
            font-size: 11px;
            margin-top: 5px;
        }

        .badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 17px;
        }

        .badge {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 800;
        }

        .badge.active {
            background: #f0fdf4;
            color: #15803d;
        }

        .badge.inactive {
            background: #f4f4f5;
            color: #71717a;
        }

        .badge.age {
            background: #fff7ed;
            color: #c2410c;
        }

        .section {
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #eee;
        }

        .section-title {
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #71717a;
            margin-bottom: 12px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .info {
            padding: 15px;
            border-radius: 10px;
            background: #fafafa;
            border: 1px solid #eee;
        }

        .info-label {
            color: #71717a;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 800;
        }

        .price {
            font-size: 28px;
            font-weight: 900;
        }

        .description {
            color: #52525b;
            font-size: 13px;
            line-height: 1.7;
            white-space: pre-line;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 26px;
        }

        .button {
            border: 0;
            border-radius: 9px;
            padding: 11px 16px;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            display: inline-block;
        }

        .button.edit {
            background: #111;
            color: white;
        }

        .button.back-btn {
            background: #f4f4f5;
            color: #52525b;
        }

        .button.delete {
            background: #fef2f2;
            color: #b91c1c;
        }

        @media (max-width: 900px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .image-box img {
                height: 420px;
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
                padding: 25px 15px 40px;
            }
        }

        @media (max-width: 550px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
            }

            .button {
                width: 100%;
                text-align: center;
            }

            .image-box img {
                height: 300px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="brand">
            <div>
                <div class="brand-logo">LE FLASH</div>
                <span class="brand-subtitle">ESPACE ADMINISTRATION</span>
            </div>
        </div>

        <nav class="navigation">

            <div class="nav-label">Menu</div>

            <a href="{{ route('dashboard') }}" class="nav-item">
                <span class="nav-icon">⌂</span>
                <span class="nav-text">Dashboard</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="nav-item">
                <span class="nav-icon">▣</span>
                <span class="nav-text">Commandes</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="nav-item active">
                <span class="nav-icon">◉</span>
                <span class="nav-text">Produits</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="nav-item">
                <span class="nav-icon">▤</span>
                <span class="nav-text">Catégories</span>
            </a>

            <div style="margin-top:28px;" class="nav-label">
                Gestion
            </div>

            <a href="{{ route('admin.pickup-slots.index') }}" class="nav-item">
                <span class="nav-icon">◷</span>
                <span class="nav-text">Créneaux</span>
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


    <main class="main">

        <header class="topbar">
            <div>
                <div class="topbar-title">
                    Détail du produit
                </div>

                <div class="topbar-subtitle">
                    Consultez les informations complètes du produit.
                </div>
            </div>
        </header>


        <div class="content">

            <a
                href="{{ route('admin.products.index') }}"
                class="back"
            >
                ← Retour aux produits
            </a>


            <div class="grid">

                <div class="card">

                    <div class="image-box">

                        @if($product->image)

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                            >

                        @else

                            <div class="placeholder">
                                ◉
                            </div>

                        @endif

                    </div>

                </div>


                <div class="card">

                    <div class="card-body">

                        <h1 class="product-name">
                            {{ $product->name }}
                        </h1>

                        <div class="product-id">
                            Produit #{{ $product->id }}
                            · {{ $product->slug }}
                        </div>


                        <div class="badges">

                            @if($product->active)

                                <span class="badge active">
                                    Produit actif
                                </span>

                            @else

                                <span class="badge inactive">
                                    Produit inactif
                                </span>

                            @endif


                            @if($product->age_restricted)

                                <span class="badge age">
                                    Restriction d'âge
                                </span>

                            @endif

                        </div>


                        <div class="section">

                            <div class="section-title">
                                Prix
                            </div>

                            <div class="price">
                                {{ number_format($product->price, 2, ',', ' ') }} €
                            </div>

                        </div>


                        <div class="section">

                            <div class="section-title">
                                Informations
                            </div>

                            <div class="info-grid">

                                <div class="info">

                                    <div class="info-label">
                                        Catégorie
                                    </div>

                                    <div class="info-value">
                                        {{ $product->category?->name ?? 'Sans catégorie' }}
                                    </div>

                                </div>


                                <div class="info">

                                    <div class="info-label">
                                        Stock
                                    </div>

                                    <div class="info-value">
                                        {{ $product->stock }}
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="section">

                            <div class="section-title">
                                Description
                            </div>

                            <div class="description">
                                {{ $product->description ?: 'Aucune description.' }}
                            </div>

                        </div>


                        <div class="actions">

                            <a
                                href="{{ route(
                                    'admin.products.edit',
                                    ['product' => $product->id]
                                ) }}"
                                class="button edit"
                            >
                                Modifier
                            </a>


                            <a
                                href="{{ route('admin.products.index') }}"
                                class="button back-btn"
                            >
                                Retour
                            </a>


                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.products.destroy',
                                    ['product' => $product->id]
                                ) }}"
                                onsubmit="return confirm(
                                    'Supprimer définitivement ce produit ?'
                                );"
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

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

</body>

</html>