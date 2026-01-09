<?php
session_start();
require_once __DIR__ . "/../classes/Matchs.php";
require_once __DIR__ . "/../classes/Ticket.php";
require_once __DIR__ . "/../classes/Avis.php";

$role = $_SESSION['role'] ?? null;


// if (!isset($_SESSION['iduser'])) {
//   die("Utilisateur non connecté");
// }

$iduser = isset($_SESSION['iduser']) ? $_SESSION['iduser'] : null;

$myMatch = new Matchs();

if (isset($_GET['id'])) {
  $idmatch = $_GET['id'];

  // echo $idmatch;

  $theMatch = $myMatch->matchesById($idmatch);
}
$categorieMatch = $myMatch->categorieMatch($idmatch);

$myMatch->checkDateStartMatch($idmatch);

$ticket = new Ticket();

$hasTicket = $ticket->userHasTicket($iduser, $idmatch);

//part avis

$avis = new Avis();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // if (!isset($iduser)) {
    
  // }

    $avisText = trim($_POST['avis']);

    if (!empty($avisText)) {
        $avis->addAvis($idmatch, $iduser, $avisText);
    }
}

//part all avis bu match
$avisMatch = $avis->allAvicMAtch($idmatch);

?>



<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>StadiumPass — Détails Match</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>

    *{
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
      --red: #7A0F26;
      --red2: #A11433;
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

    .pill {
      border: 1px solid rgba(176, 138, 58, .28);
      background: rgba(176, 138, 58, .08)
    }

    .backdrop {
      background: rgba(0, 0, 0, .60)
    }

    .logo {
      width: 52px;
      height: 52px;
      border-radius: 16px;
      border: 1px solid rgba(255, 255, 255, .10);
      background: rgba(255, 255, 255, .04);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Popup without JS */
    .modal {
      position: fixed;
      inset: 0;
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 100;
    }

    .modal:target {
      display: flex;
    }
  </style>
</head>

<body class="bg-app text-white min-h-screen">

  <!-- NAV -->
  <nav class="sticky top-0 z-50 border-b border-white/10 bg-black/40 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
      <a href="home.php" class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl card-red flex items-center justify-center">
          <i class="fa-solid fa-ticket"></i>
        </div>
        <div class="text-2xl brand tracking-wide">StadiumPass</div>
      </a>

      <?php if ($role == null): ?>
        <div class="hidden md:flex items-center gap-2">
          <a href="/auth/login.php" class="btn px-4 py-2 rounded-xl text-sm font-semibold">
            <i class="fa-solid fa-right-to-bracket mr-2"></i>Login
          </a>
          <a href="/auth/register.php" class="btn-red px-5 py-2.5 rounded-xl text-sm font-bold">
            <i class="fa-solid fa-user-plus mr-2"></i>Signup
          </a>
        </div>
      <?php else: ?>
        <div class="hidden md:flex items-center gap-2">
          <a href="../index.php" class="btn px-4 py-2 rounded-xl text-sm font-semibold">
            <i class="fa-solid fa-right-to-bracket mr-2"></i>Home
          </a>
        </div>
      <?php endif; ?>
    </div>
  </nav>

  <!-- CONTENT -->
  <main class="max-w-7xl mx-auto px-4 py-12">
    <?php foreach ($theMatch as $match) : ?>
      <div>
        <div class="flex items-start justify-between gap-4 flex-col md:flex-row">
          <div>
            <div class="inline-flex items-center gap-2 pill px-3 py-1.5 rounded-full text-xs font-semibold">
              <i class="fa-solid fa-circle-info"></i>
              Détails du match
            </div>
            <h1 class="mt-5 text-4xl md:text-5xl brand leading-tight">
              <?= $match['equipe_home'] ?> <span class="text-white/45">vs</span> <?= $match['equipe_away'] ?>
            </h1>
            <p class="mt-3 muted text-lg">Consultez les infos et réservez votre billet.</p>
          </div>

          <a href="../index.php" class="btn px-5 py-3 rounded-xl text-sm font-semibold">
            <i class="fa-solid fa-arrow-left mr-2"></i>Retour
          </a>
        </div>

        <div class="mt-10 grid lg:grid-cols-3 gap-6">
          <!-- Left: main details -->
          <section class="lg:col-span-2 card rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-white/10 flex items-center justify-between">
              <div>
                <div class="text-xs uppercase tracking-[0.28em] muted2">Match</div>
                <div class="text-2xl brand mt-1"><?= $match['titre'] ?></div>
              </div>
              <span class="pill px-3 py-1 rounded-full text-xs font-semibold">
                <i class="fa-solid fa-circle-check mr-2"></i><?= $match['status_match'] ?>
              </span>
            </div>

            <div class="p-6">
              <!-- teams row -->
              <div class="grid grid-cols-3 gap-[75px] items-center ">
                <div class="w-52 h-52 rounded-2xl overflow-hidden">
                  <img src="<?= $match['image_home'] ?>" alt="" class="w-full h-full object-cover">
                </div>

                <div class="text-center">
                  <div class="brand text-4xl text-white/80">VS</div>
                  <div class="text-xs muted2 mt-1">Match</div>
                </div>

                <div class="w-52 h-52 rounded-2xl overflow-hidden">
                  <img src="<?= $match['image_away'] ?>" alt="" class="w-full h-full object-cover">
                </div>
              </div>

              <!-- info -->
              <div class="mt-6 grid md:grid-cols-2 gap-4">
                <div class="panel rounded-2xl p-5">
                  <div class="text-sm font-bold">
                    <i class="fa-solid fa-calendar-day mr-2 text-white/70"></i>Date & Heure
                  </div>
                  <div class="mt-3 text-sm muted2">
                    <?= $match['date_match'] ?> — <?= $match['hour'] ?>
                  </div>
                </div>

                <div class="panel rounded-2xl p-5">
                  <div class="text-sm font-bold">
                    <i class="fa-solid fa-location-dot mr-2 text-white/70"></i>Lieu
                  </div>
                  <div class="mt-3 text-sm muted2">
                    <?= $match['stade'] ?>, <?= $match['ville'] ?>
                  </div>
                </div>

                <div class="  panel rounded-2xl p-5">
                  <div class="text-sm font-bold">
                    <i class="fa-solid fa-chair mr-2 text-white/70"></i>Places
                  </div>
                  <div class="mt-3 text-sm muted2">
                    <?= $match['places'] ?> places disponibles
                  </div>
                </div>

                <div class="panel rounded-2xl p-5">
                  <div class="text-sm font-bold">
                    <i class="fa-solid fa-stopwatch mr-2 text-white/70"></i>Durée
                  </div>
                  <div class="mt-3 text-sm muted2">
                    90 minutes
                  </div>
                </div>
              </div>

              <!-- notes -->
              <div class="mt-6 card-red rounded-2xl p-5">
                <div class="text-sm font-bold"><i class="fa-solid fa-circle-exclamation mr-2 text-white/70"></i>Info</div>
                <p class="mt-2 text-sm muted2 leading-relaxed">
                  Pour réserver un billet, vous devez être connecté. (Ceci est une page exemple statique.)
                </p>
              </div>
            </div>
          </section>

          <!-- Right: reservation -->
          <aside class="panel rounded-2xl p-6">
            <div class="text-sm font-bold">
              <i class="fa-solid fa-ticket mr-2 text-white/70"></i>Réservation
            </div>
            <p class="mt-2 text-sm muted2">Choisissez une catégorie puis cliquez sur réserver.</p>
            <?php foreach ($categorieMatch as $categorie): ?>
              <div class="mt-5 space-y-3">
                <div class="card rounded-xl p-4 flex items-center justify-between">
                  <div class="font-semibold"><i class="fa-solid fa-crown mr-2 text-white/60"></i><?= $categorie['nom'] ?></div>
                  <div class="font-bold border-b-[6px] border-blue-600/30"><?= $categorie['prix'] ?> DH</div>
                </div>
              </div>
            <?php endforeach; ?>

            <?php if ($match['status_match'] !== "terminer"): ?>
              <a href="../pages/buy_ticket.php?id=<?= $match['id_match'] ?>" class="mt-5 btn-red w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold">
                <i class="fa-solid fa-bag-shopping"></i>Réserver maintenant
              </a>
            <?php elseif($hasTicket): ?>
              <div class="mt-5 w-full bg-white/10 text-white/20 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold">
                <i class="fa-solid fas fa-ban"></i>Match et terminer
              </div>
              <form action="" method="POST" class="mt-6">
                <div class="relative">

                  <label class="block mb-2 text-sm font-semibold text-white/80">
                    Voter avis
                  </label>

                  <textarea name="avis" rows="4" placeholder="Votre avis ici..."class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></textarea>

                  <button type="submit" class="mt-4 w-full py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition">
                    Envoyer mon avis
                  </button>

                </div>
              </form>

            <?php endif; ?>

            <div class="mt-4 card rounded-2xl p-4 flex items-start gap-3">
              <i class="fa-solid fa-lock text-white/60 mt-0.5"></i>
              <div class="text-sm muted2">
                Réservation réelle → rediriger vers <b>/auth/login.php</b> ou <b>/auth/register.php</b>.
              </div>
            </div>
          </aside>
        </div>
      </div>
    <?php endforeach; ?>

    <!-- ===== AVIS DES SUPPORTERS ===== -->
<div class="mt-8">
  <div class="text-sm font-bold mb-3">
    <i class="fa-solid fa-comments mr-2 text-white/70"></i>Avis des supporters
  </div>

  <?php if (empty($avisMatch)): ?>
    <div class="card rounded-2xl p-4 text-sm muted2">
      Aucun avis pour le moment.
    </div>
  <?php else: ?>
    <div class="space-y-4">
      <?php foreach ($avisMatch as $avis): ?>
        <div class="card rounded-2xl p-4">
          <div class="flex items-center justify-between mb-2">
            <div class="font-semibold text-sm text-blue-600">
              <i class="fa-solid fa-user mr-2 text-blue-600/60"></i>
              <?= htmlspecialchars($avis['user_name']) ?>
            </div>
            <div class="text-xs muted2">
              <?= date('d/m/Y', strtotime($avis['created_at'])) ?>
            </div>
          </div>

          <p class="text-sm muted leading-relaxed">
            <i class="fas fa-comments text-[10px]"></i> <?= $avis['contenu'] ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

  </main>

</body>

</html>