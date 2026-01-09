<?php
session_start();

$iduser = $_SESSION['iduser'];
$roleuser = $_SESSION['role'];

require_once __DIR__ . "/../classes/Acheteur.php";
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../classes/Update.php";

if (!isset($iduser)) {
    header("Location: ../auth/login.php");
    exit();
}

$acheteur = new Acheteur();

$allinfos = $acheteur->infoAcheteur($iduser);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName  = trim($_POST['name'] ?? '');
    $newEmail = trim($_POST['email'] ?? '');
    $newImage = trim($_POST['image'] ?? '');

    $newInfos = new Update();
    $newInfos->updateinfo($newName, $newEmail, $newImage, $iduser);

    header("Location: profile.php");
    exit();
}

if ($roleuser == 'acheteur') {
    $backUrl = "../pages/matchs.php";
} else if ($roleuser == 'organisateur') {
    $backUrl = "../organiser/create_match.php";
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>StadiumPass — Edit Profile</title>
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
            border: 1px solid var(--border)
        }

        .muted {
            color: var(--muted)
        }

        .muted2 {
            color: var(--muted2)
        }

        .btn {
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, .04)
        }

        .btn:hover {
            background: rgba(255, 255, 255, .07)
        }

        .btn-red {
            background: linear-gradient(180deg, #a11433, #7a0f26);
        }

        .input {
            background: rgba(255, 255, 255, .03);
            border: 1px solid rgba(255, 255, 255, .10)
        }
    </style>
</head>

<body class="bg-app text-white min-h-screen">

    <!-- NAV -->
    <nav class="border-b border-white/10 bg-black/40 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-red-900 flex items-center justify-center">
                    <i class="fa-solid fa-user-gear"></i>
                </div>
                <div>
                    <div class="text-2xl brand">StadiumPass</div>
                    <div class="text-xs muted2">Modifier le profil</div>
                </div>
            </div>

            <a href="<?= $backUrl ?>" class="btn px-4 py-2 rounded-xl text-sm font-semibold">
                <i class="fa-solid fa-arrow-left mr-2"></i>Page Précédente
            </a>
        </div>
    </nav>

    <!-- HEADER -->
    <header class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
            <div>
                <div class="text-xs uppercase tracking-[0.28em] text-white/60">Profile</div>
                <h1 class="mt-2 text-5xl brand">Modifier mon profil</h1>
                <p class="mt-4 muted max-w-2xl">
                    Modifiez votre nom, votre adresse e-mail et l'URL de votre image de profil.
                </p>
            </div>

            <!-- Preview -->
            <div class="panel rounded-2xl p-4 min-w-[300px]">
                <div class="text-xs muted2">Aperçu</div>
                <div class="mt-3 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl overflow-hidden border border-white/10 bg-white/5">
                        <img id="previewImg" src="<?= $allinfos['image'] ?>" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div id="previewName" class="font-bold">Nom : <?= $allinfos['nom'] ?></div>
                        <div id="previewEmail" class="text-sm muted2">Email : <?= $allinfos['email'] ?></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- CONTENT -->
    <main class="max-w-7xl mx-auto px-4 pb-16">
        <div class="grid lg:grid-cols-3 gap-6">

            <!-- FORM -->
            <section class="lg:col-span-2 card rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10">
                    <div class="font-bold">
                        <i class="fa-solid fa-pen-to-square mr-2 text-white/60"></i>
                        Modifier information
                    </div>
                </div>

                <form class="p-6 space-y-5" action="" method="POST">
                    <div>
                        <div class="text-xs muted2 mb-1">Nom</div>
                        <input name="name"
                            value="<?= $allinfos['nom'] ?>"
                            class="input w-full rounded-xl px-4 py-3 text-white bg-transparent">
                    </div>

                    <div>
                        <div class="text-xs muted2 mb-1">Email</div>
                        <input name="email"
                            type="email"
                            value="<?= $allinfos['email'] ?>"
                            class="input w-full rounded-xl px-4 py-3 text-white bg-transparent">
                    </div>

                    <div>
                        <div class="text-xs muted2 mb-1">Image de profil (URL)</div>
                        <input name="image"
                            value="<?= $allinfos['image'] ?>"
                            class="input w-full rounded-xl px-4 py-3 text-white bg-transparent">
                    </div>

                    <button type="submit"
                        class="btn-red w-full px-5 py-3 rounded-xl text-sm font-bold">
                        <i class="fa-solid fa-floppy-disk mr-2"></i>
                        Sauvegarder
                    </button>

                    <!-- <a href="#"
                            class="btn w-full px-5 py-3 rounded-xl text-sm font-semibold text-center">
                            Cancel
                        </a> -->

                </form>
            </section>

            <!-- INFO -->
            <aside class="card rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10">
                    <div class="font-bold">
                        <i class="fa-solid fa-circle-info mr-2 text-white/60"></i>
                        Notes
                    </div>
                </div>

                <div class="p-6 space-y-4 text-sm muted2">
                    <div class="panel rounded-2xl p-4">
                        Utilisez une URL d'image directe (jpg / png).
                    </div>
                    <div class="panel rounded-2xl p-4">
                        L'adresse électronique doit être valide.
                    </div>
                    <div class="panel rounded-2xl p-4">
                        La modification du mot de passe devrait se faire sur une autre page.
                    </div>
                </div>
            </aside>

        </div>
    </main>

</body>

</html>