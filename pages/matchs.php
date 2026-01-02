<?php 
session_start();

$iduser = $_SESSION['iduser'];
$nomuser = $_SESSION['nom'];

require_once "../classes/Acheteur.php";
require_once "../config/database.php";



?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>StadiaTick — Acheteur</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif
        }

        .brand {
            font-family: 'Marcellus', serif
        }

        :root {
            --bg: #07070A;
            --border: rgba(255, 255, 255, .10);
            --muted: rgba(255, 255, 255, .70);
            --muted2: rgba(255, 255, 255, .55);
            --gold: #B08A3A;
        }

        .bg-app {
            background: radial-gradient(900px 500px at 15% 10%, rgba(161, 20, 51, .18), transparent 60%), radial-gradient(900px 500px at 90% 20%, rgba(176, 138, 58, .10), transparent 60%), var(--bg);
        }

        .card {
            background: rgba(15, 15, 22, .88);
            border: 1px solid var(--border)
        }

        .panel {
            background: rgba(15, 15, 22, .70);
            border: 1px solid var(--border);
            backdrop-filter: blur(10px)
        }

        .card-red {
            background: linear-gradient(180deg, rgba(161, 20, 51, .35), rgba(15, 15, 22, .92));
            border: 1px solid rgba(161, 20, 51, .35)
        }

        .muted {
            color: var(--muted)
        }

        .muted2 {
            color: var(--muted2)
        }

        .btn {
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, .04);
            transition: .2s
        }

        .btn:hover {
            background: rgba(255, 255, 255, .07);
            transform: translateY(-1px)
        }

        .btn-red {
            background: linear-gradient(180deg, rgba(161, 20, 51, .95), rgba(122, 15, 38, .95));
            border: 1px solid rgba(176, 138, 58, .22);
            transition: .2s
        }

        .btn-red:hover {
            filter: brightness(1.05);
            transform: translateY(-1px)
        }

        .input {
            background: rgba(255, 255, 255, .03);
            border: 1px solid rgba(255, 255, 255, .10)
        }

        .input:focus {
            outline: none;
            border-color: rgba(176, 138, 58, .55)
        }

        .backdrop {
            background: rgba(0, 0, 0, .60)
        }
    </style>
</head>

<body class="bg-app text-white min-h-screen">

    <nav class="sticky top-0 z-50 border-b border-white/10 bg-black/40 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <a href="index.html" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl card-red flex items-center justify-center">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div>
                    <div class="text-2xl brand">StadiaTick</div>
                    <div class="text-xs muted2 -mt-0.5">Buyer</div>
                </div>
            </a>

            <div class="flex items-center gap-2">
                <a href="index.html" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i
                        class="fa-solid fa-house mr-2"></i>Home</a>
                <a href="organizer.html" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i
                        class="fa-solid fa-clipboard-list mr-2"></i>Organizer</a>
                <a href="admin.html" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i
                        class="fa-solid fa-shield-halved mr-2"></i>Admin</a>
                <button id="logout" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i
                        class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Logout</button>
            </div>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
            <div>
                <div class="text-xs uppercase tracking-[0.28em] text-white/60">Acheteur</div>
                <h1 class="mt-2 text-5xl brand">Achat de billets</h1>
                <p class="mt-4 muted max-w-2xl">Max 4 billets par match. Choix catégorie + place. Historique disponible.
                </p>
            </div>

            <div class="panel rounded-2xl p-4 min-w-[280px]">
                <div class="text-xs muted2">Session</div>
                <div id="uName" class="mt-1 font-bold">—</div>
                <div id="uEmail" class="text-sm muted2">—</div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 pb-16">
        <div class="grid lg:grid-cols-3 gap-6">
            <section class="lg:col-span-2 card rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10 flex items-center justify-between">
                    <div class="font-bold"><i class="fa-solid fa-calendar-days mr-2 text-white/60"></i>Matchs
                        disponibles</div>
                    <div class="text-sm muted2">Acheter (demo)</div>
                </div>
                <div id="list" class="flex justify-center p-6">
                    <article class="card rounded-2xl p-6 hover:border-white/20 transition w-full max-w-xl">

                        <!-- TOP -->
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl card-red flex items-center justify-center">
                                    <i class="fa-solid fa-futbol text-white/85"></i>
                                </div>

                                <div>
                                    <h3 class="font-bold text-xl leading-tight">
                                        Wydad AC <span class="text-white/45">vs</span> Raja CA
                                    </h3>

                                    <div class="text-xs muted2 mt-2">
                                        <i class="fa-solid fa-calendar-day mr-2 text-white/50"></i>
                                        15 Décembre 2025 — 20:00
                                    </div>

                                    <div class="text-xs muted2 mt-1">
                                        <i class="fa-solid fa-location-dot mr-2 text-white/50"></i>
                                        Complexe Mohammed V, Casablanca
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="text-xs muted2">À partir de</div>
                                <div class="text-2xl font-extrabold">
                                    200 <span class="text-sm muted2">MAD</span>
                                </div>
                            </div>
                        </div>

                        <!-- BOTTOM -->
                        <div class="mt-6 flex items-center justify-between">
                            <span class="text-xs muted2 px-3 py-1 rounded-full border border-white/10 bg-white/5">
                                <i class="fa-solid fa-trophy mr-2 text-white/50"></i>
                                Ligue Pro
                            </span>

                            <div class="flex gap-3">
                                <a href="match_details.php?id=1"
                                    class="btn px-4 py-2 rounded-xl text-sm font-semibold">
                                    <i class="fa-solid fa-circle-info mr-2"></i>
                                    Voir détails
                                </a>

                                <a href="reserve.php?match=1"
                                    class="btn-red px-4 py-2 rounded-xl text-sm font-bold">
                                    <i class="fa-solid fa-ticket mr-2"></i>
                                    Réserver
                                </a>
                            </div>
                        </div>

                    </article>

                </div>

            </section>

            <aside class="card rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10">
                    <div class="font-bold"><i class="fa-solid fa-receipt mr-2 text-white/60"></i>Historique</div>
                    <div class="text-sm muted2 mt-1">Billets achetés</div>
                </div>
                <div id="history" class="p-6 space-y-4"></div>
                <div class="px-6 pb-6">
                    <button id="clear" class="btn w-full px-4 py-3 rounded-xl text-sm font-semibold">
                        <i class="fa-solid fa-trash mr-2"></i>Vider
                    </button>
                </div>
            </aside>
        </div>
    </main>

</body>

</html>