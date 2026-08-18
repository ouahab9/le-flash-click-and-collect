<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Accès interdit — Le Flash</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f5f5f5;
            color: #111;
            font-family: Inter, Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 560px;
            background: white;
            border: 1px solid #e7e7e7;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
        }

        .code {
            font-size: 72px;
            font-weight: 900;
            line-height: 1;
        }

        h1 {
            margin: 18px 0 0;
            font-size: 26px;
        }

        p {
            color: #71717a;
            line-height: 1.6;
            font-size: 14px;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .button {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 800;
            text-decoration: none;
        }

        .primary {
            background: #111;
            color: white;
        }

        .secondary {
            background: #f4f4f5;
            color: #111;
        }
    </style>
</head>

<body>

<div class="card">

    <div class="code">
        403
    </div>

    <h1>
        Accès interdit
    </h1>

    <p>
        Vous n'avez pas l'autorisation d'accéder à cette page.
    </p>

    <div class="actions">

        <a
            href="{{ route('catalog.index') }}"
            class="button primary"
        >
            Retour à la boutique
        </a>

        @auth
            <a
                href="{{ route('dashboard') }}"
                class="button secondary"
            >
                Dashboard
            </a>
        @endauth

    </div>

</div>

</body>
</html>