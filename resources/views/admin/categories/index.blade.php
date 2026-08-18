<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catégories — Le Flash</title>

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
        }

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

        .panel {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 14px;
            overflow: hidden;
        }

        .categories-head,
        .category-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 150px;
            gap: 20px;
            align-items: center;
        }

        .categories-head {
            padding: 13px 22px;
            background: #fafafa;
            border-bottom: 1px solid #e7e7e7;
            color: #71717a;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .category-row {
            padding: 18px 22px;
            border-bottom: 1px solid #f0f0f0;
        }

        .category-row:last-child {
            border-bottom: 0;
        }

        .category-info {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .category-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 10px;
            background: #f4f4f5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .category-name {
            font-size: 13px;
            font-weight: 800;
        }

        .category-description {
            color: #71717a;
            font-size: 11px;
            margin-top: 4px;
            max-width: 350px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .products-count {
            font-size: 12px;
            font-weight: 700;
        }

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
            background: #f4f4f5;
        }

        .action.delete {
            color: #b91c1c;
        }

        .empty {
            padding: 70px 20px;
            text-align: center;
            color: #71717a;
        }

        .empty-icon {
            font-size: 36px;
            margin-bottom: 15px;
        }

        .pagination {
            padding: 18px 22px;
            border-top: 1px solid #eee;
        }

        @media (max-width: 1000px) {
            .categories-head {
                display: none;
            }

            .category-row {
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
            .category-row {
                grid-template-columns: 1fr;
            }

            .toolbar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

<div class="layout">

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

            <a href="{{ route('admin.orders.index') }}" class="nav-item">
                <span class="nav-icon">▣</span>
                <span class="nav-text">Commandes</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="nav-item">
                <span class="nav-icon">◉</span>
                <span class="nav-text">Produits</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="nav-item active">
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


    <main class="main">

        <header class="topbar">

            <div>

                <h1 class="title">
                    Catégories
                </h1>

                <div class="subtitle">
                    Organisez les produits de votre catalogue.
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


            <div class="toolbar">

                <div class="count">
                    {{ $categories->total() }} catégorie(s)
                </div>

                <a
                    href="{{ route('admin.categories.create') }}"
                    class="add-button"
                >
                    + Ajouter une catégorie
                </a>

            </div>


            <div class="panel">

                @if($categories->count())

                    <div class="categories-head">

                        <div>Catégorie</div>
                        <div>Produits</div>
                        <div>Statut</div>
                        <div></div>

                    </div>


                    @foreach($categories as $category)

                        <div class="category-row">

                            <div class="category-info">

                                <div class="category-icon">
                                    {{ $category->icon ?: '▤' }}
                                </div>

                                <div>

                                    <div class="category-name">
                                        {{ $category->name }}
                                    </div>

                                    @if($category->description)

                                        <div class="category-description">
                                            {{ $category->description }}
                                        </div>

                                    @endif

                                </div>

                            </div>


                            <div class="products-count">

                                {{ $category->products_count }}

                                @if($category->products_count > 1)
                                    produits
                                @else
                                    produit
                                @endif

                            </div>


                            <div>

                                @if($category->active)

                                    <span class="status active">
                                        Active
                                    </span>

                                @else

                                    <span class="status inactive">
                                        Inactive
                                    </span>

                                @endif

                            </div>


                            <div class="actions">

                                <a
                                    href="{{ route(
                                        'admin.categories.edit',
                                        ['category' => $category->id]
                                    ) }}"
                                    class="action"
                                >
                                    Modifier
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route(
                                        'admin.categories.destroy',
                                        ['category' => $category->id]
                                    ) }}"
                                    onsubmit="return confirm(
                                        'Supprimer définitivement cette catégorie ?'
                                    );"
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


                    @if($categories->hasPages())

                        <div class="pagination">
                            {{ $categories->links() }}
                        </div>

                    @endif


                @else

                    <div class="empty">

                        <div class="empty-icon">
                            ▤
                        </div>

                        <strong>
                            Aucune catégorie
                        </strong>

                        <div style="margin-top:5px;">
                            Créez votre première catégorie pour organiser vos produits.
                        </div>

                        <div style="margin-top:20px;">

                            <a
                                href="{{ route('admin.categories.create') }}"
                                class="add-button"
                            >
                                + Ajouter une catégorie
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