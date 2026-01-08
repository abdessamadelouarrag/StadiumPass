<?php
session_start();


require_once __DIR__ . "/../classes/Acheteur.php";
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../classes/Matchs.php";

$iduser   = $_SESSION['iduser'] ?? null;
$roleuser = $_SESSION['role'] ?? null;

// check session
if (!$iduser) {
    header("Location: ../auth/login.php");
    exit();
}

// check role
if ($roleuser !== 'acheteur') {
    header("Location: ../organiser/create_match.php");
    exit();
}

$errorMsg = $_SESSION['error'] ?? null;
unset($_SESSION['error']);

$newAcheteur = new Acheteur();
$allinfos = $newAcheteur->infoAcheteur($iduser);

$matches = new Matchs();
$allMatches = $matches->allMatches();

//part historique ticket reserv

$allOldTicket = $newAcheteur->meTicket($iduser);
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>StadiumPass — Acheteur</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">

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

    <?php if (!empty($errorMsg)): ?>
        <div id="flashError"
            class="fixed top-24 left-1/2 -translate-x-1/2 z-[200]card-red border border-red-500/30
            px-5 py-4 rounded-2xl shadow-2xl backdrop-blur flex items-center gap-4 animate-slideDown">

            <div class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center">
                <i class="fa-solid fa-circle-exclamation text-red-400 text-lg"></i>
            </div>

            <div class="text-sm font-semibold text-red-100">
                <?= htmlspecialchars($errorMsg) ?>
            </div>

        </div>


        <script>
            setTimeout(() => {
                const el = document.getElementById("flashError");
                if (el) el.remove();
            }, 3000);
        </script>
    <?php endif; ?>


    <nav class="sticky top-0 z-50 border-b border-white/10 bg-black/40 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <a href="index.html" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl card-red flex items-center justify-center">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div>
                    <div class="text-2xl brand">StadiumPass</div>
                    <div class="text-xs muted2 -mt-0.5">Acheteur</div>
                </div>
            </a>

            <div class="flex items-center gap-2">
                <a href="../auth/logout.php">
                    <button id="logout" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i
                            class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Logout</button>
                </a>
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
                <div class="text-xs flex items-center justify-between mb-3">
                    <h3 class="border-b">Mon Profil</h3>
                    <a href="profile.php">
                        <button class="btn px-3 py-2 rounded-xl text-sm font-semibold">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </a>
                </div>

                <div class="flex gap-7">
                    <div class="w-14 h-14 rounded-[10px] overflow-hidden">
                        <img src="<?= $allinfos['image'] ?>" alt="" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 id="uName" class="mt-1 font-bold">Nom : <?= $allinfos['nom'] ?></h3>
                        <h3 id="uEmail" class="text-sm muted2">Email : <?= $allinfos['email'] ?></h3>
                        <h4 class="flex items-center font-bold text-green-600 gap-2 text-sm"><?= $allinfos['status'] ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 pb-16">
        <div class="grid lg:grid-cols-3 gap-6">
            <section class="lg:col-span-2 card rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10 flex items-center">
                    <div class="font-bold">
                        <i class="fa-solid fa-calendar-days mr-2 text-white/60"></i>Matchs disponibles
                    </div>
                    <div class="text-sm muted2">Acheter</div>
                </div>

                <div id="list" class="p-6">
                    <div class="max-w-5xl mx-auto">
                        <?php foreach ($allMatches as $match) : ?>
                            <article class="relative rounded-2xl border border-white/10 bg-blue-600/5 shadow-3xl overflow-hidden mb-3">
                                <!-- CONTENT (responsive) -->
                                <div class="flex flex-col md:flex-row items-center justify-between gap-6 md:gap-10 px-6 md:px-10 py-8 md:py-12">
                                    <!-- TEAM A -->
                                    <div class="w-28 h-28 md:w-40 md:h-40 rounded-3xl bg-red-800/90 flex items-center justify-center shrink-0 overflow-hidden">
                                        <img src="<?= $match['image_home'] ?>" alt="" class="w-full h-full object-cover">
                                    </div>

                                    <!-- CENTER INFO -->
                                    <div class="text-center">
                                        <h1 class="text-2xl font-bold mb-3 text-blue-700 border-b-[6px] border-blue-700/30"><?= $match['titre'] ?></h1>
                                        <h2 class="text-xl md:text-2xl font-extrabold">
                                            <?= $match['equipe_home'] ?> <span class="text-white/40">vs</span> <?= $match['equipe_away'] ?>
                                        </h2>

                                        <div class="mt-3 md:mt-4 space-y-1 text-xs md:text-sm text-white/70">
                                            <div>Ville: <?= $match['ville'] ?></div>
                                            <div>Date Match: <?= $match['date_match'] ?></div>
                                            <div>Heure : <?= $match['hour'] ?></div>
                                        </div>
                                    </div>

                                    <!-- TEAM B -->
                                    <div class="w-28 h-28 md:w-40 md:h-40 rounded-3xl bg-red-800/90 flex items-center justify-center shrink-0 overflow-hidden">
                                        <img src="<?= $match['image_away'] ?>" alt="" class="w-full h-full object-cover">
                                    </div>
                                </div>

                                <!-- DIVIDER -->
                                <div class="border-t border-white/10"></div>

                                <!-- ACTIONS (responsive) -->
                                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 sm:gap-4 px-6 py-5">
                                    <a href="match_details.php?id=<?= $match['id_match'] ?>"
                                        class="w-full sm:flex-1 text-center px-5 py-3 rounded-xl border border-white/15 bg-white/5 text-sm font-bold hover:bg-white/10 transition">
                                        <i class="fa-solid fa-circle-info mr-2"></i>
                                        Voir détails
                                    </a>

                                    <a href="buy_ticket.php?id=<?= $match['id_match'] ?>"
                                        class="w-full sm:flex-1 text-center btn-red px-5 py-3 rounded-xl text-sm font-bold">
                                        <i class="fa-solid fa-ticket mr-2"></i>
                                        Réserver
                                    </a>
                                </div>

                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>

            </section>

            <aside class="card rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10">
                    <div class="font-bold"><i class="fa-solid fa-receipt mr-2 text-white/60"></i>Historique</div>
                    <div class="text-sm muted2 mt-1">Billets achetés</div>
                </div>
                <div id="history" class="p-6 space-y-4">
                    <?php foreach($allOldTicket as $oldMatch):?>
                        <div class="flex items-center justify-between gap-4 p-4 rounded-xl border border-white/10 bg-white/5 backdrop-blur opacity-50">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="h-10 w-10 rounded-xl border border-white/10 bg-white/5 flex items-center justify-center overflow-hidden">
                                    <img src="<?= $oldMatch['image_home'] ?>" alt="" class="h-full w-full object-cover grayscale">
                                </div>
                                
                                <div class="min-w-0 justify-center grid">
                                    <div class="text-sm font-semibold text-white truncate">
                                        <?= $oldMatch['equipe_home'] ?> <span class="text-white/60">vs</span> <?= $oldMatch['equipe_away'] ?>
                                    </div>
                                    <div class="text-[10px] text-white/60">
                                        Date Achat : <?= $oldMatch['date_achat'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="h-10 w-10 rounded-xl border border-white/10 bg-white/5 flex items-center justify-center overflow-hidden">
                                <img src="<?= $oldMatch['image_away'] ?>" alt="logoequipe2" class="h-full w-full object-cover grayscale">
                            </div>
                            <h3 class="flex justify-end text-[13px] text-white/30 font-bold">x<?= $oldMatch['quantite'] ?></h3>
                    </div>
                    <?php endforeach;?>
                </div>
            </aside>
        </div>
    </main>

    <!-- PROFILE EDIT MODAL -->
    <div id="profileModal" class="fixed inset-0 hidden items-center justify-center z-[200]">
        <div id="profileBackdrop" class="absolute inset-0 backdrop"></div>

        <div class="relative w-[94%] max-w-lg card rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-white/10 flex items-center justify-between">
                <div>
                    <div class="text-xs uppercase tracking-[0.28em] muted2">Profil</div>
                    <div class="text-2xl brand mt-1">Modifier mes infos</div>
                </div>

                <button id="closeProfileEdit" class="btn px-3 py-2 rounded-xl">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- FORM -->
            <form action="update_profile.php" method="POST" class="p-6 space-y-5">

                <!-- Image URL -->
                <div class="panel rounded-2xl p-5">
                    <div class="text-xs muted2 mb-2">Photo (URL)</div>

                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-xl overflow-hidden border border-white/10 bg-white/5">
                            <img id="previewImg" src="<?= $allinfos['image'] ?>" class="w-full h-full object-cover">
                        </div>

                        <input id="imageInput"
                            name="image"
                            value="<?= htmlspecialchars($allinfos['image']) ?>"
                            class="input w-full rounded-xl px-4 py-3 text-white bg-transparent"
                            placeholder="https://example.com/photo.jpg">
                    </div>
                </div>

                <!-- Name -->
                <div>
                    <div class="text-xs muted2 mb-1">Nom</div>
                    <input name="nom"
                        value="<?= htmlspecialchars($allinfos['nom']) ?>"
                        class="input w-full rounded-xl px-4 py-3 text-white bg-transparent">
                </div>

                <!-- Email -->
                <div>
                    <div class="text-xs muted2 mb-1">Email</div>
                    <input type="email"
                        name="email"
                        value="<?= htmlspecialchars($allinfos['email']) ?>"
                        class="input w-full rounded-xl px-4 py-3 text-white bg-transparent">
                </div>

                <input type="hidden" name="user_id" value="">

                <div class="flex gap-3">
                    <button type="submit" class="btn-red w-full px-5 py-3 rounded-xl text-sm font-bold">
                        <i class="fa-solid fa-floppy-disk mr-2"></i>Enregistrer
                    </button>

                    <button type="button" id="cancelProfileEdit"
                        class="btn w-full px-5 py-3 rounded-xl text-sm font-semibold">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        const $ = s => document.querySelector(s);

        const modal = $("#profileModal");
        const openBtn = $("#openProfileEdit");
        const closeBtn = $("#closeProfileEdit");
        const cancelBtn = $("#cancelProfileEdit");
        const backdrop = $("#profileBackdrop");

        const imageInput = $("#imageInput");
        const previewImg = $("#previewImg");

        const openModal = () => {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        };

        const closeModal = () => {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        };

        openBtn.onclick = openModal;
        closeBtn.onclick = closeModal;
        cancelBtn.onclick = closeModal;
        backdrop.onclick = closeModal;

        // live preview from URL
        imageInput.addEventListener("input", () => {
            previewImg.src = imageInput.value;
        });
    </script>


</body>

</html>