<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Erreur serveur — Le Flash</title>

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

        .button {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 16px;
            border-radius: 10px;
            background: #111;
            color: white;
            font-size: 12px;
            font-weight: 800;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="card">

    <div class="code">
        500
    </div>

    <h1>
        Une erreur est survenue
    </h1>

    <p>
        Le serveur a rencontré un problème.
        Réessayez dans quelques instants.
    </p>

    <a
        href="{{ route('catalog.index') }}"
        class="button"
    >
        Retour à la boutique
    </a>

</div>

</body>
</html>