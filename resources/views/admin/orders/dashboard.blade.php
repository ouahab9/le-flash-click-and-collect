<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard — Le Flash</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f5;
            color: #18181b;
        }

        header {
            background: #111;
            color: white;
            padding: 18px 30px;
        }

        .header-inner {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: 800;
        }

        .logout {
            background: #27272a;
            border: 0;
            color: white;
            padding: 9px 14px;
            border-radius: 8px;
            cursor: pointer;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 35px 20px;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h1 {
            margin-bottom: 5px;
        }

        .welcome p {
            color: #71717a;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
        }

        .card-title {
            color: #71717a;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .card-value {
            font-size: 30px;
            font-weight: 800;
        }

        .orders-card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
        }

        .orders-header {
            padding: 22px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .orders-header h2 {
            margin: 0;
        }

        .orders-link {
            background: #111;
            color: white;
            padding: 9px 14px;
            border-radius: 8px;
            text-decoration: none;
        }

        .order {
            padding: 18px 22px;
            border-bottom: 1px solid #eee;
            display: grid;
            grid-template-columns: 1.2fr 1fr 1fr 1fr auto;
            gap: 20px;
            align-items: center;
        }

        .order:last-child {
            border-bottom: 0;
        }

        .number {
            font-weight: 800;
        }

        .muted {
            color: #71717a;
            font-size: 13px;
            margin-top: 4px;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .accepted {
            background: #dbeafe;
            color: #1e40af;
        }

        .preparing {
            background: #ede9fe;
            color: #6d28d9;
        }

        .ready {
            background: #dcfce7;
            color: #166534;
        }

        .picked_up {
            background: #e4e4e7;
            color: #3f3f46;
        }

        .cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .view {
            background: #111;
            color: white;
            padding: 8px 12px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .order {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 600px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .order {
                grid-template-columns: 1fr;
            }

            .header-inner {
                padding: 0;
            }
        }
    </style>
</head>

<body>

<header>

    <div class="header-inner">

        <div class="logo">
            LE FLASH — ADMIN
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button class="logout" type="submit">
                Déconnexion
            </button>
        </form>

    </div>

</header>

<main class="container">

    <div class="welcome">

        <h1>
            Tableau de bord
        </h1>

        <p>
            Vue d'ensemble de votre activité.
        </p>

    </div>


    <div class="stats">

        <div class="card">

            <div class="card-title">
                💰 Chiffre d'affaires aujourd'hui
            </div>

            <div class="card-value">
                {{ number_format($revenueToday, 2, ',', ' ') }} €
            </div>

        </div>


        <div class="card">

            <div class="card-title">
                📦 Commandes aujourd'hui
            </div>

            <div class="card-value">
                {{ $ordersToday }}
            </div>

        </div>


        <div class="card">

            <div class="card-title">
                ⏳ En attente
            </div>

            <div class="card-value">
                {{ $pendingOrders }}
            </div>

        </div>


        <div class="card">

            <div class="card-title">
                ✅ Prêtes
            </div>

            <div class="card-value">
                {{ $readyOrders }}
            </div>

        </div>

    </div>


    <div class="orders-card">

        <div class="orders-header">

            <h2>
                Dernières commandes
            </h2>

            <a
                href="{{ route('admin.orders.index') }}"
                class="orders-link"
            >
                Toutes les commandes
            </a>

        </div>


        @forelse ($latestOrders as $order)

            <div class="order">

                <div>

                    <div class="number">
                        {{ $order->order_number }}
                    </div>

                    <div class="muted">
                        {{ $order->created_at->format('d/m/Y H:i') }}
                    </div>

                </div>


                <div>

                    <strong>
                        {{ $order->customer_name }}
                    </strong>

                    <div class="muted">
                        {{ $order->customer_phone }}
                    </div>

                </div>


                <div>

                    <strong>
                        {{ number_format($order->total, 2, ',', ' ') }} €
                    </strong>

                </div>


                <div>

                    <span class="status {{ $order->status }}">

                        @switch($order->status)

                            @case('pending')
                                En attente
                                @break

                            @case('accepted')
                                Acceptée
                                @break

                            @case('preparing')
                                En préparation
                                @break

                            @case('ready')
                                Prête
                                @break

                            @case('picked_up')
                                Retirée
                                @break

                            @case('cancelled')
                                Annulée
                                @break

                            @default
                                {{ $order->status }}

                        @endswitch

                    </span>

                </div>


                <div>

                    <a
                        href="{{ route('admin.orders.show', $order) }}"
                        class="view"
                    >
                        Voir
                    </a>

                </div>

            </div>

        @empty

            <div style="padding:40px;text-align:center;color:#71717a;">
                Aucune commande pour le moment.
            </div>

        @endforelse

    </div>

</main>

</body>

</html>