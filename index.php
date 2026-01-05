<?php 
require_once __DIR__ . "/classes/Matchs.php";

$allMatches = new Matchs();

$matches = $allMatches->allMatches();

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>StadiumPass</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif }
    .brand { font-family: 'Marcellus', serif }

    :root{
      --bg:#07070A;
      --border:rgba(255,255,255,.10);
      --muted:rgba(255,255,255,.70);
      --muted2:rgba(255,255,255,.55);
      --red:#7A0F26;
      --gold:#B08A3A;
    }

    .bg-app{
      background:
        radial-gradient(900px 500px at 15% 10%, rgba(161, 20, 51, .18), transparent 60%),
        radial-gradient(900px 500px at 90% 20%, rgba(176, 138, 58, .10), transparent 60%),
        var(--bg);
    }

    .card{ background:rgba(15,15,22,.88); border:1px solid var(--border) }
    .panel{ background:rgba(15,15,22,.70); border:1px solid var(--border); backdrop-filter: blur(10px) }
    .card-red{ background:linear-gradient(180deg, rgba(161,20,51,.35), rgba(15,15,22,.92)); border:1px solid rgba(161,20,51,.35) }
    .muted{ color:var(--muted) }
    .muted2{ color:var(--muted2) }

    .btn{ border:1px solid var(--border); background:rgba(255,255,255,.04); transition:.2s }
    .btn:hover{ background:rgba(255,255,255,.07); transform: translateY(-1px) }

    .btn-red{
      background:linear-gradient(180deg, rgba(161,20,51,.95), rgba(122,15,38,.95));
      border:1px solid rgba(176,138,58,.22);
      transition:.2s
    }
    .btn-red:hover{ filter:brightness(1.05); transform: translateY(-1px) }

    .input{ background:rgba(255,255,255,.03); border:1px solid rgba(255,255,255,.10) }
    .input:focus{ outline:none; border-color: rgba(176,138,58,.55) }

    .pill{ border:1px solid rgba(176,138,58,.28); background: rgba(176,138,58,.08) }
    .backdrop{ background: rgba(0,0,0,.60) }

    /* Logos (icons) */
    .logo{
      width:52px; height:52px;
      border-radius: 16px;
      border:1px solid rgba(255,255,255,.10);
      background: rgba(255,255,255,.04);
      display:flex; align-items:center; justify-content:center;
    }

    /* ✅ Popup without JS using :target */
    .modal{
      position: fixed;
      inset: 0;
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 100;
    }
    .modal:target{ display:flex; }
  </style>
</head>

<body class="bg-app text-white min-h-screen">

  <!-- NAV -->
  <nav class="sticky top-0 z-50 border-b border-white/10 bg-black/40 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
      <a href="#" class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl card-red flex items-center justify-center">
          <i class="fa-solid fa-ticket"></i>
        </div>
        <div class="text-2xl brand tracking-wide">StadiumPass</div>
      </a>

      <div class="hidden md:flex items-center gap-2">
        <a href="/auth/login.php" class="btn px-4 py-2 rounded-xl text-sm font-semibold">
          <i class="fa-solid fa-right-to-bracket mr-2"></i>Login
        </a>
        <a href="/auth/register.php" class="btn-red px-5 py-2.5 rounded-xl text-sm font-bold">
          <i class="fa-solid fa-user-plus mr-2"></i>Signup
        </a>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header class="max-w-7xl mx-auto px-4 py-14">
    <div class="grid lg:grid-cols-2 gap-8 items-start">
      <div>
        <div class="inline-flex items-center gap-2 pill px-3 py-1.5 rounded-full text-xs font-semibold">
          <i class="fa-solid fa-eye"></i>
          Visiteur : consulter matchs et détails
        </div>
        <h1 class="mt-6 text-5xl md:text-6xl brand leading-tight">
          Billetterie sportive.<br />Simple. Premium.
        </h1>
        <p class="mt-4 muted text-lg leading-relaxed">
          Exemple statique : 1 seul match. Cliquez sur “Réserver” pour ouvrir le popup (sans JS).
        </p>
      </div>

      <div class="panel rounded-2xl p-5">
        <div class="text-sm font-bold">
          <i class="fa-solid fa-filter mr-2 text-white/70"></i>Filtres
        </div>
        <div class="mt-4 grid sm:grid-cols-2 gap-3">
          <div>
            <div class="text-xs muted2 mb-1">Recherche</div>
            <div class="input rounded-xl px-4 py-3 flex items-center gap-3">
              <i class="fa-solid fa-magnifying-glass text-white/45"></i>
              <input class="w-full bg-transparent outline-none text-white placeholder:text-white/35" placeholder="Equipe, stade, ville..." />
            </div>
          </div>
          <div>
            <div class="text-xs muted2 mb-1">Ville</div>
            <select class="w-full input rounded-xl px-4 py-3 text-white bg-transparent outline-none">
              <option>Toutes</option>
              <option>Casablanca</option>
              <option>Rabat</option>
              <option>Marrakech</option>
              <option>Tanger</option>
            </select>
          </div>
          <div class="sm:col-span-2">
            <div class="text-xs muted2 mb-1">Compétition</div>
            <select class="w-full input rounded-xl px-4 py-3 text-white bg-transparent outline-none">
              <option>Toutes</option>
              <option>Ligue Pro</option>
              <option>Coupe Nationale</option>
              <option>Super Cup</option>
            </select>
          </div>
        </div>
        <div class="mt-4 flex gap-3">
          <button class="btn-red px-5 py-3 rounded-xl text-sm font-bold w-full">
            <i class="fa-solid fa-check mr-2"></i>Appliquer
          </button>
        </div>
      </div>
    </div>
  </header>

  <!-- ✅ ONLY ONE MATCH CARD -->
  <main class="max-w-7xl mx-auto px-4 pb-16">
    <div class="flex items-end justify-between gap-4">
      <div>
        <div class="text-xs uppercase tracking-[0.28em] text-white/60">Matches</div>
        <h2 class="mt-2 text-4xl brand">Match publié</h2>
        <p class="mt-3 muted max-w-2xl">Un seul card (statique) pour l’exemple.</p>
      </div>
      <div class="hidden md:flex items-center gap-2 panel rounded-2xl px-4 py-3">
        <i class="fa-solid fa-lock text-white/60"></i>
        <div class="text-sm muted2">Réserver nécessite un compte</div>
      </div>
    </div>

    <div class="mt-10 grid grid-cols-2 gap-3">
        <?php foreach($matches as $match): ?>
      <div class="card rounded-2xl p-6">
        <div class="flex items-center justify-between">
          <div class="pill px-3 py-1 rounded-full text-xs font-semibold">
            <i class="fa-solid fa-trophy mr-2"></i><?= $match['titre'] ?>
          </div>
          <div class="text-xs muted2">
            <i class="fa-solid fa-tag mr-2"></i>Meilleur <b class="text-white">Prix</b>
          </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-4">
          <div class="flex items-center gap-3">
            <div class="logo overflow-hidden" title="equipe-home">
              <img src="<?= $match['image_home'] ?>" alt="" class="w-full h-full object-cover">
            </div>
            <div>
              <div class="font-bold text-lg"><?= $match['equipe_home'] ?></div>
              <div class="text-xs muted2">Home</div>
            </div>
          </div>

          <div class="text-center">
            <div class="brand text-3xl text-white/80">VS</div>
            <div class="text-xs muted2 -mt-1">Match</div>
          </div>

          <div class="flex items-center gap-3">
            <div>
              <div class="font-bold text-lg text-right"><?= $match['equipe_away'] ?></div>
              <div class="text-xs muted2 text-right">Away</div>
            </div>
            <div class="logo overflow-hidden" title="image-away">
              <img src="<?= $match['image_away'] ?>" alt="" class="w-full h-full object-cover">
            </div>
          </div>
        </div>

        <div class="mt-6 grid sm:grid-cols-2 gap-3 text-sm muted2">
          <div class="card rounded-xl p-4">
            <i class="fa-solid fa-calendar-day mr-2 text-white/60"></i>
            <?= $match['date_match'] ?> — <?= $match['hour'] ?>
          </div>
          <div class="card rounded-xl p-4">
            <i class="fa-solid fa-location-dot mr-2 text-white/60"></i>
            <?= $match['stade'] ?>, <?= $match['ville'] ?>
          </div>
        </div>

        <div class="mt-6 grid grid-cols-2 gap-3">
          <a href="/pages/match_details.php?id=<?= $match['id_match'] ?>" class="btn px-4 py-3 rounded-xl text-sm font-semibold text-center">
            <i class="fa-solid fa-circle-info mr-2"></i>Détails
          </a>
          <a href="/pages/buy_ticket.php" class="btn-red px-4 py-3 rounded-xl text-sm font-bold text-center">
            <i class="fa-solid fa-ticket mr-2"></i>Réserver
          </a>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </main>

  <!-- FOOTER -->
  <footer class="border-t border-white/10 bg-black/30">
    <div class="max-w-7xl mx-auto px-4 py-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
      <div class="brand text-2xl">StadiaTick</div>
      <div class="flex items-center gap-2">
        <a href="/auth/login.php" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i class="fa-solid fa-right-to-bracket mr-2"></i>Login</a>
        <a href="/auth/register.php" class="btn-red px-4 py-2 rounded-xl text-sm font-bold"><i class="fa-solid fa-user-plus mr-2"></i>Signup</a>
      </div>
    </div>
    <p class="brand text-[12px] m-1 text-white/30 flex justify-center">By Abdessamad El ouarrag</p>
  </footer>

  <!-- ✅ DETAILS POPUP (NO JS) -->
  <!-- <div id="details" class="modal">
    <div class="absolute inset-0 backdrop"></div>

    <div class="relative w-[94%] max-w-2xl card rounded-2xl overflow-hidden">
      <div class="p-6 border-b border-white/10 flex items-center justify-between">
        <div>
          <div class="text-xs uppercase tracking-[0.28em] muted2">Détails du match</div>
          <div class="text-2xl brand mt-1">Wydad AC vs Raja CA</div>
        </div>
        <a href="#" class="btn px-3 py-2 rounded-xl"><i class="fa-solid fa-xmark"></i></a>
      </div>

      <div class="p-6 grid lg:grid-cols-2 gap-6">
        <div class="card-red rounded-2xl p-5">
          <div class="flex items-center justify-between">
            <div class="text-sm font-bold">
              <i class="fa-solid fa-trophy mr-2 text-white/70"></i>Ligue Pro
            </div>
            <span class="pill px-3 py-1 rounded-full text-xs font-semibold">
              <i class="fa-solid fa-circle-check mr-2"></i>Published
            </span>
          </div>

          <div class="mt-6 space-y-2 text-sm muted2">
            <div><i class="fa-solid fa-calendar-day w-5 mr-2 text-white/60"></i>15 Décembre 2025 — 20:00</div>
            <div><i class="fa-solid fa-location-dot w-5 mr-2 text-white/60"></i>Complexe Mohammed V, Casablanca</div>
            <div><i class="fa-solid fa-chair w-5 mr-2 text-white/60"></i>2000 places</div>
          </div>
        </div>

        <div class="panel rounded-2xl p-5">
          <div class="text-sm font-bold"><i class="fa-solid fa-tags mr-2 text-white/70"></i>Catégories & prix</div>

          <div class="mt-4 space-y-3">
            <div class="card rounded-xl p-4 flex items-center justify-between">
              <div class="font-semibold"><i class="fa-solid fa-ticket mr-2 text-white/60"></i>VIP</div>
              <div class="font-bold">600 MAD</div>
            </div>
            <div class="card rounded-xl p-4 flex items-center justify-between">
              <div class="font-semibold"><i class="fa-solid fa-ticket mr-2 text-white/60"></i>Cat 1</div>
              <div class="font-bold">350 MAD</div>
            </div>
            <div class="card rounded-xl p-4 flex items-center justify-between">
              <div class="font-semibold"><i class="fa-solid fa-ticket mr-2 text-white/60"></i>Cat 2</div>
              <div class="font-bold">200 MAD</div>
            </div>
          </div>

          <a href="#reserve" class="mt-4 btn-red w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold">
            <i class="fa-solid fa-ticket"></i>Réserver
          </a>
        </div>
      </div>
    </div>
  </div> -->

  <!-- ✅ RESERVE POPUP (NO JS) -->
 <!-- <div id="reserve" class="modal">
    <div class="absolute inset-0 backdrop"></div>

    <div class="relative w-[94%] max-w-lg card rounded-2xl overflow-hidden">
      <div class="p-6 border-b border-white/10 flex items-center justify-between">
        <div>
          <div class="text-xs uppercase tracking-[0.28em] muted2">Réservation</div>
          <div class="text-2xl brand mt-1">Choisir une catégorie</div>
        </div>
        <a href="#" class="btn px-3 py-2 rounded-xl"><i class="fa-solid fa-xmark"></i></a>
      </div>

      <div class="p-6">
        <div class="card rounded-2xl p-4">
          <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
              <div class="logo"><i class="fa-solid fa-shield text-white/80 text-xl"></i></div>
              <div>
                <div class="font-bold">Wydad AC</div>
                <div class="text-xs muted2">Home</div>
              </div>
            </div>

            <div class="text-center">
              <div class="brand text-2xl text-white/80">VS</div>
              <div class="text-xs muted2 -mt-1">Match</div>
            </div>

            <div class="flex items-center gap-3">
              <div>
                <div class="font-bold text-right">Raja CA</div>
                <div class="text-xs muted2 text-right">Away</div>
              </div>
              <div class="logo"><i class="fa-solid fa-shield text-white/80 text-xl"></i></div>
            </div>
          </div>
        </div>

        <div class="mt-5 space-y-3">
          <div class="btn w-full rounded-xl px-4 py-3 flex items-center justify-between">
            <div class="font-semibold"><i class="fa-solid fa-ticket mr-2 text-white/60"></i>VIP</div>
            <div class="font-bold">600 MAD</div>
          </div>
          <div class="btn w-full rounded-xl px-4 py-3 flex items-center justify-between">
            <div class="font-semibold"><i class="fa-solid fa-ticket mr-2 text-white/60"></i>Cat 1</div>
            <div class="font-bold">350 MAD</div>
          </div>
          <div class="btn w-full rounded-xl px-4 py-3 flex items-center justify-between">
            <div class="font-semibold"><i class="fa-solid fa-ticket mr-2 text-white/60"></i>Cat 2</div>
            <div class="font-bold">200 MAD</div>
          </div>
        </div>

        <div class="mt-4 card rounded-2xl p-4 flex items-start gap-3">
          <i class="fa-solid fa-lock text-white/60 mt-0.5"></i>
          <div class="text-sm muted2">
            Ici tu peux rediriger vers <b>/auth/register.php</b> ou <b>/auth/login.php</b>.
          </div>
        </div>

        <a href="/auth/register.php"
           class="mt-4 btn-red w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold">
          <i class="fa-solid fa-user-plus"></i>Créer un compte pour réserver
        </a>
      </div>
    </div>
  </div> -->

</body>
</html>
