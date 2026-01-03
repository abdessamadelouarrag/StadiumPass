<?php
require_once "../config/database.php";
require_once "../classes/Admin.php";


$all = new Admin();

$accounts = $all->showAllAccounts();

if (isset($_GET['Actv'])) {
    $idacc = $_GET['Actv'];

    $all->activeAccount($idacc);
}

if (isset($_GET['Destv'])) {
    $idacc = $_GET['Destv'];

    $all->desactiverAccount($idacc);
}

$allactvier = $all->accountActiver();
?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>StadiaTick — Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

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
    </style>
</head>

<body class="bg-app text-white min-h-screen">

    <nav class="sticky top-0 z-50 border-b border-white/10 bg-black/40 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <a href="index.html" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl card-red flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <div class="text-2xl brand">StadiaTick</div>
                    <div class="text-xs muted2 -mt-0.5">Admin</div>
                </div>
            </a>

            <div class="flex items-center gap-2">
                <a href="index.html" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i class="fa-solid fa-house mr-2"></i>Home</a>
                <a href="login.html" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i class="fa-solid fa-right-to-bracket mr-2"></i>Login</a>
                <button id="reset" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i class="fa-solid fa-rotate-left mr-2"></i>Reset</button>
            </div>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-4 py-12">
        <div class="max-w-3xl">
            <div class="text-xs uppercase tracking-[0.28em] text-white/60">Admin</div>
            <h1 class="mt-2 text-5xl brand">Supervision</h1>
            <p class="mt-4 muted">Gérer utilisateurs (activer/désactiver) + valider/refuser demandes d’organisateurs.</p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 pb-16">
        <div class="grid lg:grid-cols-3 gap-6">
            <section class="card-red rounded-2xl p-6">
                <div class="font-bold"><i class="fa-solid fa-chart-pie mr-2 text-white/70"></i>Stats</div>
                <div class="mt-5 space-y-3 text-sm">
                    <div class="flex justify-between"><span class="muted2">Users actifs</span><b id="sUsers"><?= count($allactvier) ?></b></div>
                    <div class="flex justify-between"><span class="muted2">Demandes pending</span><b id="sPend">—</b></div>
                    <div class="flex justify-between"><span class="muted2">Billets (demo)</span><b id="sTickets">—</b></div>
                    <div class="flex justify-between"><span class="muted2">Revenus (demo)</span><b id="sRev">—</b></div>
                </div>
            </section>

            <section class="card rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10 flex items-center justify-between">
                    <div class="font-bold"><i class="fa-solid fa-users mr-2 text-white/60"></i>Utilisateurs</div>
                    <div class="text-sm muted2">Activer / Désactiver</div>
                </div>

                <?php foreach ($accounts as $acc) : ?>
                    <div class="panel rounded-xl p-3 m-3 flex items-center justify-between text-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center overflow-hidden">
                                <img src="<?= $acc['image'] ?>" alt="" class="object-cover h-full w-full">
                            </div>
                            <div>
                                <div class="font-semibold leading-tight"><?= $acc['nom'] ?></div>
                                <div class="text-xs muted2 leading-tight"><?= $acc['email'] ?> · <?= $acc['role'] ?></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-2 py-1 rounded text-sm font-medium
                            <?= $acc['status'] === 'activer' ? 'bg-emerald-500/10 text-emerald-600' : 'bg-red-500/10 text-red-600' ?>">
                                <?= ucfirst($acc['status']) ?>
                            </span>

                            <a href="?Actv=<?= $acc['id_user'] ?>">
                                <button class="bg-green-600/60 px-3 py-1 rounded-lg text-xs font-semibold">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </a>
                            <a href="?Destv=<?= $acc['id_user'] ?>">
                                <button class="bg-red-700/80 px-3 py-1 rounded-lg text-xs font-semibold">
                                    <i class="fa-solid fa-eye-low-vision"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

            </section>

            <section class="card rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10 flex items-center justify-between">
                    <div class="font-bold"><i class="fa-solid fa-list-check mr-2 text-white/60"></i>Demandes</div>
                    <div class="text-sm muted2">Accepter / Refuser</div>
                </div>
                <div id="reqs" class="divide-y divide-white/10"></div>
            </section>
        </div>
    </main>
</body>

</html>