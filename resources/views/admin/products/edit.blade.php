<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modifier {{ $product->name }} — Le Flash</title>

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
            max-width: 900px;
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

        .card {
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 14px;
            padding: 28px;
        }

        .product-title {
            font-size: 18px;
            font-weight: 800;
            margin: 0;
        }

        .product-id {
            color: #a1a1aa;
            font-size: 11px;
            margin-top: 4px;
            margin-bottom: 25px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 12px;
            font-weight: 800;
        }

        input,
        textarea,
        select {
            width: 100%;
            border: 1px solid #d4d4d8;
            border-radius: 9px;
            padding: 11px 12px;
            background: white;
            color: #111;
            font: inherit;
            font-size: 13px;
            outline: none;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #111;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .hint {
            color: #a1a1aa;
            font-size: 11px;
            margin-top: 5px;
        }

        .image-current,
        .image-preview {
            margin-top: 12px;
        }

        .image-current img,
        .image-preview img {
            max-width: 180px;
            max-height: 180px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #e4e4e7;
        }

        .image-preview {
            display: none;
        }

        .checkboxes {
            display: flex;
            gap: 25px;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .checkbox input {
            width: auto;
        }

        .error {
            color: #b91c1c;
            font-size: 11px;
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eeeeee;
            margin-top: 28px;
            padding-top: 22px;
        }

        .left-actions,
        .right-actions {
            display: flex;
            gap: 10px;
        }

        .button {
            border: 0;
            border-radius: 9px;
            padding: 11px 17px;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            display: inline-block;
        }

        .button.cancel {
            background: #f4f4f5;
            color: #52525b;
        }

        .button.save {
            background: #111;
            color: white;
        }

        .button.delete {
            background: #fef2f2;
            color: #b91c1c;
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

        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .field.full {
                grid-column: auto;
            }

            .card {
                padding: 20px;
            }

            .checkboxes {
                flex-direction: column;
                gap: 12px;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .left-actions,
            .right-actions {
                width: 100%;
            }

            .right-actions {
                flex-direction: column;
            }

            .button {
                width: 100%;
                text-align: center;
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

            <div style="margin-top:28px;" class="nav-label">Gestion</div>

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
                    Modifier le produit
                </div>

                <div class="topbar-subtitle">
                    Modifiez les informations de votre produit.
                </div>
            </div>
        </header>


        <div class="content">

            <a href="{{ route('admin.products.index') }}" class="back">
                ← Retour aux produits
            </a>


            @if($errors->any())

                <div style="
                    background:#fef2f2;
                    border:1px solid #fecaca;
                    color:#991b1b;
                    padding:15px;
                    border-radius:10px;
                    margin-bottom:20px;
                    font-size:12px;
                ">
                    <strong>Vérifie les informations suivantes :</strong>

                    <ul style="margin:8px 0 0 18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif


            <div class="card">

                <h2 class="product-title">
                    {{ $product->name }}
                </h2>

                <div class="product-id">
                    Produit #{{ $product->id }}
                </div>


                <form
                    method="POST"
                    action="{{ route('admin.products.update', ['product' => $product->id]) }}"
                    enctype="multipart/form-data"
                >

                    @csrf
                    @method('PUT')


                    <div class="form-grid">

                        <div class="field full">

                            <label for="name">
                                Nom du produit *
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name', $product->name) }}"
                                required
                            >

                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="field">

                            <label for="category_id">
                                Catégorie
                            </label>

                            <select
                                id="category_id"
                                name="category_id"
                            >

                                <option value="">
                                    Sans catégorie
                                </option>

                                @foreach($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        @selected(
                                            old(
                                                'category_id',
                                                $product->category_id
                                            ) == $category->id
                                        )
                                    >
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('category_id')
                                <div class="error">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="field">

                            <label for="price">
                                Prix *
                            </label>

                            <input
                                id="price"
                                name="price"
                                type="number"
                                step="0.01"
                                min="0"
                                value="{{ old('price', $product->price) }}"
                                required
                            >

                            @error('price')
                                <div class="error">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="field">

                            <label for="stock">
                                Stock *
                            </label>

                            <input
                                id="stock"
                                name="stock"
                                type="number"
                                min="0"
                                value="{{ old('stock', $product->stock) }}"
                                required
                            >

                            @error('stock')
                                <div class="error">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="field">

                            <label for="image">
                                Nouvelle image
                            </label>

                            <input
                                id="image"
                                name="image"
                                type="file"
                                accept=".jpg,.jpeg,.png,.webp"
                                onchange="previewImage(event)"
                            >

                            <div class="hint">
                                Laissez vide pour conserver l'image actuelle.
                            </div>

                            @error('image')
                                <div class="error">{{ $message }}</div>
                            @enderror


                            @if($product->image)

                                <div
                                    id="current-image"
                                    class="image-current"
                                >
                                    <div class="hint">
                                        Image actuelle :
                                    </div>

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                    >
                                </div>

                            @endif


                            <div
                                id="new-image-preview"
                                class="image-preview"
                            >
                                <div class="hint">
                                    Nouvelle image :
                                </div>

                                <img
                                    id="preview-img"
                                    src=""
                                    alt="Aperçu"
                                >
                            </div>

                        </div>


                        <div class="field full">

                            <label for="description">
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                            >{{ old('description', $product->description) }}</textarea>

                            @error('description')
                                <div class="error">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="field full">

                            <label>
                                Options
                            </label>

                            <div class="checkboxes">

                                <label class="checkbox">
                                    <input
                                        type="checkbox"
                                        name="active"
                                        value="1"
                                        @checked(old('active', $product->active))
                                    >

                                    Produit actif
                                </label>


                                <label class="checkbox">
                                    <input
                                        type="checkbox"
                                        name="age_restricted"
                                        value="1"
                                        @checked(
                                            old(
                                                'age_restricted',
                                                $product->age_restricted
                                            )
                                        )
                                    >

                                    Produit soumis à restriction d'âge
                                </label>

                            </div>

                        </div>

                    </div>


                    <div class="form-actions">

                        <div class="left-actions">

                            <button
                                type="submit"
                                form="delete-product-form"
                                class="button delete"
                                onclick="return confirm(
                                    'Supprimer définitivement ce produit ?'
                                )"
                            >
                                Supprimer
                            </button>

                        </div>


                        <div class="right-actions">

                            <a
                                href="{{ route('admin.products.index') }}"
                                class="button cancel"
                            >
                                Annuler
                            </a>

                            <button
                                type="submit"
                                class="button save"
                            >
                                Enregistrer les modifications
                            </button>

                        </div>

                    </div>

                </form>


                <form
                    id="delete-product-form"
                    method="POST"
                    action="{{ route(
                        'admin.products.destroy',
                        ['product' => $product->id]
                    ) }}"
                    style="display:none;"
                >
                    @csrf
                    @method('DELETE')
                </form>

            </div>

        </div>

    </main>

</div>


<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('new-image-preview');
        const image = document.getElementById('preview-img');

        if (!input.files || !input.files[0]) {
            preview.style.display = 'none';
            image.src = '';
            return;
        }

        image.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'block';
    }
</script>

</body>

</html>