<?php
session_start();

$idorg = $_SESSION['iduser'];
$roleuser = $_SESSION['role'];

require_once __DIR__ . "/../classes/Organisateur.php";
require_once __DIR__ . "/../classes/Avis.php";

//check session
if (!isset($idorg)) {
    header("Location: ../auth/login.php");
    exit();
}

//check role
if ($roleuser !== 'organisateur') {
    header("Location: ../pages/matchs.php");
    exit();
}

$all = new Organisateur();

$infos = $all->infoOrga($idorg);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $titre = trim($_POST['titre'] ?? '');
    $home = trim($_POST['equipe_home'] ?? '');
    $away = trim($_POST['equipe_away'] ?? '');
    $date_match = $_POST['date_match'] ?? '';
    $hour = $_POST['hour'] ?? '';
    $stade = trim($_POST['stade'] ?? '');
    $ville = trim($_POST['ville'] ?? '');
    $image_home = trim($_POST['image_home'] ?? '');
    $image_away = trim($_POST['image_away'] ?? '');
    $places = (int) ($_POST['places'] ?? 0);

    //categorie info
    $nomC1 = $_POST['categories1'];
    $nomC2 = $_POST['categories2'];
    $nomC3 = $_POST['categories3'];

    $prixC1 = $_POST['prixCategorie1'];
    $prixC2 = $_POST['prixCategorie2'];
    $prixC3 = $_POST['prixCategorie3'];

    $stockC1 = $_POST['stockCategorie1'];
    $stockC2 = $_POST['stockCategorie2'];
    $stockC3 = $_POST['stockCategorie3'];

    // $all->createMatch($titre, $home, $away, $date_match, $stade, $ville, $hour, $image_away, $image_home, $places, $idorg);

    $matchId = $all->createMatch($titre, $home, $away, $date_match, $stade, $ville, $hour, $image_away, $image_home, $places, $idorg);


    $all->addCategorie($matchId, $nomC1, $prixC1, $stockC1);

    $all->addCategorie($matchId, $nomC2, $prixC2, $stockC2);

    $all->addCategorie($matchId, $nomC3, $prixC3, $stockC3);

    header("Location: create_match.php");
    exit();
}

$seeMatches = $all->seeMatches($idorg);

$enattantMatches = $all->matchesW($idorg);

//parte all prix 

$allprix = $all->allPrix($idorg);

//part avis match
$avis = new Avis();

$allAvis = $avis->seeAvisById($idorg);

?>




<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>StadiumPass — Organisateur</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            scrollbar-width: none;
        }

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
            background:
                radial-gradient(900px 500px at 15% 10%, rgba(161, 20, 51, .18), transparent 60%),
                radial-gradient(900px 500px at 90% 20%, rgba(176, 138, 58, .10), transparent 60%),
                var(--bg);
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

        .hint {
            background: rgba(255, 255, 255, .04);
            border: 1px dashed rgba(255, 255, 255, .12)
        }
    </style>
</head>

<body class="bg-app text-white min-h-screen">

    <!-- NAV -->
    <nav class="sticky top-0 z-50 border-b border-white/10 bg-black/40 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <a href="index.html" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl card-red flex items-center justify-center">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>
                <div>
                    <div class="text-2xl brand">StadiumPass</div>
                    <div class="text-xs muted2 -mt-0.5">Organisateur</div>
                </div>
            </a>

            <div class="flex items-center gap-2">
                <a href="../auth/logout.php">
                    <button class="btn px-4 py-2 rounded-xl text-sm font-semibold">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Logout
                    </button>
                </a>
            </div>
        </div>
    </nav>

    <!-- HEADER -->
    <header class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
            <div>
                <div class="text-xs uppercase tracking-[0.28em] text-white/60">Organisateur</div>
                <h1 class="mt-2 text-5xl brand">Gestion des événements</h1>
                <p class="mt-4 muted max-w-2xl">
                    Créez une demande de match (validation admin), définissez catégories & prix, suivez ventes et avis.
                </p>
            </div>

            <div class="panel rounded-2xl p-4 min-w-[300px]">
                <div class="flex justify-between items-center mb-3">
                    <div class="text-xs muted2">Session</div>
                    <div class="mt-3 flex gap-2">
                        <a href="../pages/profile.php" class="btn px-3 py-2 rounded-xl text-xs font-semibold">
                            <i class="fa-solid fa-user-gear mr-2"></i>Profil
                        </a>
                    </div>
                </div>
                <div class="flex gap-7">
                    <div class="w-12 h-12 rounded-[10px] overflow-hidden">
                        <img src="<?= $infos['image'] ?>" alt="" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="mt-1 font-bold">— Nom : <?= $infos['nom'] ?></h3>
                        <h3 class="text-sm muted2">— <?= $infos['email'] ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 pb-16">

        <!-- KPIs -->
        <section id="stats" class="grid md:grid-cols-3 gap-4">
            <?php foreach ($allprix as $prix): ?>
                <div class="card rounded-2xl p-5">
                    <div class="text-xs muted2">Billets vendus</div>
                    <div class="mt-2 text-3xl font-extrabold"><?= $prix['total_billets_vendus'] ?></div>
                    <div class="mt-2 text-xs muted2"><i class="fa-solid fa-circle-info mr-2"></i>Total tous matchs</div>
                </div>
                <div class="card rounded-2xl p-5">
                    <div class="text-xs muted2">Chiffre d’affaires</div>
                    <div class="mt-2 text-3xl font-extrabold text-green-600"><?= $prix['total_prix'] ?><span class="text-base muted2">MAD</span></div>
                    <div class="mt-2 text-xs muted2"><i class="fa-solid fa-circle-info mr-2"></i>Total validé</div>
                </div>
            <?php endforeach; ?>
            <div class="card rounded-2xl p-5">
                <div class="text-xs muted2">Matchs en attente</div>
                <div class="mt-2 text-3xl font-extrabold"><?= count($enattantMatches) ?></div>
                <div class="mt-2 text-xs muted2"><i class="fa-solid fa-shield-check mr-2"></i>Validation admin</div>
            </div>
        </section>

        <div class="grid lg:grid-cols-3 gap-6 mt-6">

            <!-- CREATE MATCH -->
            <section class="lg:col-span-2 card rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10 flex items-center justify-between">
                    <div class="font-bold">
                        <i class="fa-solid fa-plus mr-2 text-white/60"></i>Créer une demande d’événement sportif
                    </div>
                    <div class="text-sm muted2">Max 2000 places • 3 catégories</div>
                </div>

                <form class="p-6 space-y-6" action="" method="POST" enctype="multipart/form-data">

                    <!-- Match title -->
                    <div class="panel rounded-2xl p-5">
                        <label class="text-xs muted2 block mb-1">Titre du match</label>
                        <input name="titre" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent"
                            placeholder="Ex: Wydad vs Raja" />
                    </div>

                    <!-- Teams -->
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="panel rounded-2xl p-5">
                            <div class="font-bold mb-4">Équipe domicile</div>
                            <label class="text-xs muted2 block mb-1">Nom</label>
                            <input name="equipe_home" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="Ex: Wydad AC" />

                            <label class="text-xs muted2 block mt-4 mb-1">Logo (URL)</label>
                            <input name="image_home" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="https://..." />
                        </div>

                        <div class="panel rounded-2xl p-5">
                            <div class="font-bold mb-4">Équipe extérieur</div>
                            <label class="text-xs muted2 block mb-1">Nom</label>
                            <input name="equipe_away" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="Ex: Raja CA" />

                            <label class="text-xs muted2 block mt-4 mb-1">Logo (URL)</label>
                            <input name="image_away" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="https://..." />
                        </div>
                    </div>

                    <!-- Date & hour -->
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="panel rounded-2xl p-5">
                            <label class="text-xs muted2 block mb-1">Date du match</label>
                            <input name="date_match" type="date"
                                class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" />
                        </div>

                        <div class="panel rounded-2xl p-5">
                            <label class="text-xs muted2 block mb-1">Heure</label>
                            <input name="hour" type="time"
                                class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" />
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="panel rounded-2xl p-5">
                            <label class="text-xs muted2 block mb-1">Stade</label>
                            <input name="stade" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="Ex: Complexe Mohammed V" />
                        </div>

                        <div class="panel rounded-2xl p-5">
                            <label class="text-xs muted2 block mb-1">Ville</label>
                            <input name="ville" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="Ex: Casablanca" />
                        </div>
                    </div>

                    <!-- Places -->
                    <div class="panel rounded-2xl p-5">
                        <label class="text-xs muted2 block mb-1">Nombre de places</label>
                        <input name="places" type="number" min="1"
                            class="input w-full rounded-xl px-4 py-3 text-white bg-transparent"
                            placeholder="Ex: 2000" />
                    </div>

                    <!-- Categories -->
                    <div class="panel rounded-2xl p-5">
                        <div class="font-bold mb-4">Catégories</div>

                        <div class="grid md:grid-cols-3 gap-4">
                            <input name="categories1" class="input rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="VIP" />
                            <input name="categories2" class="input rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="Standard" />
                            <input name="categories3" class="input rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="Premium" />
                        </div>
                        <div class="grid md:grid-cols-3 gap-4 mt-3">
                            <input name="prixCategorie1" class="input rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="100 DH" />
                            <input name="prixCategorie2" class="input rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="180 DH" />
                            <input name="prixCategorie3" class="input rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="250 DH" />
                        </div>
                        <div class="grid md:grid-cols-3 gap-4 mt-3">
                            <input name="stockCategorie1" class="input rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="100 place" />
                            <input name="stockCategorie2" class="input rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="700 place" />
                            <input name="stockCategorie3" class="input rounded-xl px-4 py-3 text-white bg-transparent"
                                placeholder="1200 place" />
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <button type="submit" class="btn-red px-5 py-3 rounded-xl text-sm font-bold">
                            Créer le match
                        </button>
                        <button type="reset" class="btn px-5 py-3 rounded-xl text-sm font-semibold">
                            Réinitialiser
                        </button>
                    </div>

                </form>

            </section>

            <!-- RIGHT COLUMN -->
            <aside class="space-y-6">

                <!-- MY EVENTS -->
                <section class="card rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/10 flex items-center justify-between">
                        <div class="font-bold"><i class="fa-solid fa-list-check mr-2 text-white/60"></i>Mes demandes</div>
                        <div class="text-sm muted2">Statut</div>
                    </div>

                    <div class="p-6 space-y-4">
                        <?php foreach ($seeMatches as $match) : ?>
                            <div class="panel rounded-2xl p-4">
                                <div class="flex items-center justify-between">
                                    <div class="font-bold"><?= $match['equipe_home'] ?> Vs <?= $match['equipe_away'] ?></div>
                                    <span class="text-xs px-3 py-1 rounded-full border border-white/10 bg-white/5 muted2">
                                        <i class="fa-solid fa-clock mr-2"></i><?= $match['status'] ?>
                                    </span>
                                </div>
                                <div class="mt-2 text-xs muted2">
                                    <i class="fa-solid fa-calendar-day mr-2"></i><?= $match['date_match'] ?> — <?= $match['hour'] ?>
                                    <span class="mx-2 text-white/20">•</span>
                                    <i class="fa-solid fa-location-dot mr-2"></i><?= $match['ville'] ?>
                                </div>
                                <div class="mt-3 flex gap-2">
                                    <a href="#" class="btn px-3 py-2 rounded-xl text-xs font-semibold">
                                        <i class="fa-solid fa-eye mr-2"></i>Détails
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- item -->
                        <!-- <div class="panel rounded-2xl p-4">
                            <div class="flex items-center justify-between">
                                <div class="font-bold">FUS Rabat vs AS FAR</div>
                                <span class="text-xs px-3 py-1 rounded-full border border-white/10 bg-white/5 muted2">
                                    <i class="fa-solid fa-check mr-2"></i>Approuvé
                                </span>
                            </div>
                            <div class="mt-2 text-xs muted2">
                                <i class="fa-solid fa-calendar-day mr-2"></i>22/12/2025 — 19:30
                                <span class="mx-2 text-white/20">•</span>
                                <i class="fa-solid fa-location-dot mr-2"></i>Rabat
                            </div>
                            <div class="mt-3 flex gap-2">
                                <a href="#" class="btn px-3 py-2 rounded-xl text-xs font-semibold">
                                    <i class="fa-solid fa-eye mr-2"></i>Détails
                                </a>
                                <a href="#" class="btn px-3 py-2 rounded-xl text-xs font-semibold">
                                    <i class="fa-solid fa-chart-line mr-2"></i>Stats
                                </a>
                            </div>
                        </div> -->
                    </div>
                </section>

                <!-- REVIEWS -->
                <section id="reviews" class="card rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/10">
                        <div class="font-bold"><i class="fa-solid fa-star mr-2 text-white/60"></i>Commentaires & avis</div>
                        <div class="text-sm muted2 mt-1">Après fin du match</div>
                    </div>
                    <?php foreach ($allAvis as $avis): ?>
                        <div class="p-3 space-y-4">
                            <div class="panel rounded-2xl p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h1 class="font-bold"><?= $avis["equipe_home"] ?> vs <?= $avis['equipe_away'] ?></h1>
                                        <h3 class="text-sm text-blue-600"><i class="fas fa-futbol"></i> <?= $avis['match_title'] ?></h3>
                                    </div>
                                    <div class="text-xs muted2">
                                        <i class="fa-solid fa-star text-white/70"></i>
                                        <i class="fa-solid fa-star text-white/70"></i>
                                        <i class="fa-solid fa-star text-white/70"></i>
                                        <i class="fa-solid fa-star text-white/70"></i>
                                        <i class="fa-solid fa-star text-white/70"></i>
                                    </div>
                                </div>
                                <div class="mt-2 text-xs muted2">
                                    <i class="fa-solid fa-user mr-2"></i>Utilisateur: <?= $avis['user_name'] ?>
                                </div>
                                <p class="mt-2 text-sm muted">
                                    <i class="fas fa-comment-dots"></i> <?= $avis['contenu'] ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </section>

            </aside>
        </div>
    </main>

</body>

</html>