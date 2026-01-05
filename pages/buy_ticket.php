<?php 
session_start();

$iduser = $_SESSION['iduser'];
$roleuser = $_SESSION['role'];

require_once "../classes/Matchs.php";

if(!isset($iduser)){
    header("Location: ../auth/login.php");
    exit();
}

if($roleuser == 'organisateur'){
    header("Location: ../create_match.php");
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // echo $idmatch;

    $match = new Matchs();

    $myMatch = $match->matchesById($id);
}

$categorieMatch = $match->categorieMatch($id);

?>


<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>StadiaTick — Réserver</title>

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
      --red2:#A11433;
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

    .pill{ border:1px solid rgba(176,138,58,.28); background: rgba(176,138,58,.08) }

    /* inputs */
    .in{
      width:100%;
      border:1px solid rgba(255,255,255,.12);
      background:rgba(255,255,255,.04);
      border-radius: 14px;
      padding: 12px 12px;
      outline: none;
    }
    .in:focus{
      border-color: rgba(176,138,58,.45);
      box-shadow: 0 0 0 4px rgba(176,138,58,.12);
    }

    /* ===== Ticket like image ===== */
    .ticket{
      position: relative;
      overflow: hidden;
      border-radius: 22px;
      border: 1px solid rgba(176,138,58,.24);
      background:
        radial-gradient(900px 360px at 10% 0%, rgba(176,138,58,.11), transparent 60%),
        radial-gradient(900px 360px at 90% 35%, rgba(161,20,51,.22), transparent 60%),
        rgba(15,15,22,.82);
    }
    .ticket:before{
      content:"";
      position:absolute;
      inset:0;
      background:
        linear-gradient(180deg, rgba(255,255,255,.08), transparent 35%),
        linear-gradient(90deg, rgba(176,138,58,.10), transparent 35%, rgba(161,20,51,.10));
      opacity:.55;
      pointer-events:none;
    }

    .ticket-grid{
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: 170px 1fr 180px; /* like the image: left stub / center / right badge */
    }

    .ticket-left{
      border-right: 1px dashed rgba(255,255,255,.16);
      padding: 18px;
      background: rgba(255,255,255,.02);
      position: relative;
    }
    .ticket-mid{
      padding: 18px 18px 16px;
    }
    .ticket-right{
      border-left: 1px dashed rgba(255,255,255,.16);
      padding: 18px;
      background:
        linear-gradient(180deg, rgba(161,20,51,.28), rgba(15,15,22,.30));
      position: relative;
    }

    /* notches */
    .notch{
      position:absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 22px; height: 22px;
      border-radius: 999px;
      background: var(--bg);
      border: 1px solid rgba(255,255,255,.10);
    }
    .notch.l{ right: -11px; }
    .notch.r{ left: -11px; }

    .label{
      font-size: 11px;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: var(--muted2);
    }
    .value{
      font-weight: 800;
      margin-top: 4px;
    }

    .mini{
      border:1px solid rgba(255,255,255,.10);
      background: rgba(255,255,255,.03);
      border-radius: 16px;
      padding: 12px;
    }

    .qr{
      width: 92px; height: 92px;
      border-radius: 18px;
      border: 1px solid rgba(255,255,255,.14);
      background:
        linear-gradient(90deg, rgba(255,255,255,.12) 1px, transparent 1px),
        linear-gradient(rgba(255,255,255,.12) 1px, transparent 1px);
      background-size: 10px 10px;
      opacity:.90;
    }

    .badge{
      border:1px solid rgba(176,138,58,.28);
      background: rgba(176,138,58,.09);
      border-radius: 999px;
      padding: 8px 10px;
      font-weight: 800;
      letter-spacing:.16em;
      text-transform: uppercase;
      font-size: 12px;
    }

    /* responsive ticket */
    @media (max-width: 980px){
      .ticket-grid{ grid-template-columns: 1fr; }
      .ticket-left{ border-right: none; border-bottom: 1px dashed rgba(255,255,255,.16); }
      .ticket-right{ border-left: none; border-top: 1px dashed rgba(255,255,255,.16); }
      .notch{ display:none; }
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

  <main class="max-w-7xl mx-auto px-4 py-12">

    <!-- Header -->
    <div class="flex items-start justify-between gap-4 flex-col md:flex-row">
      <div>
        <div class="inline-flex items-center gap-2 pill px-3 py-1.5 rounded-full text-xs font-semibold">
          <i class="fa-solid fa-cart-shopping"></i>
          Réservation
        </div>
        <h1 class="mt-5 text-4xl md:text-5xl brand leading-tight">
          Wydad AC <span class="text-white/45">vs</span> Raja CA
        </h1>
        <p class="mt-3 muted text-lg">Choisis catégorie + place, puis ton ticket s’affiche en bas.</p>
      </div>

      <a href="home.php" class="btn px-5 py-3 rounded-xl text-sm font-semibold">
        <i class="fa-solid fa-arrow-left mr-2"></i>Retour
      </a>
    </div>

    <!-- Top: choices -->
    <div class="mt-10 grid lg:grid-cols-3 gap-6">
      <section class="lg:col-span-2 card rounded-2xl overflow-hidden">
        <div class="p-6 border-b border-white/10 flex items-center justify-between">
          <div>
            <div class="text-xs uppercase tracking-[0.28em] muted2">Choix</div>
            <div class="text-2xl brand mt-1">Détails de réservation</div>
          </div>
          <span class="pill px-3 py-1 rounded-full text-xs font-semibold">
            <i class="fa-solid fa-circle-check mr-2"></i>Disponible
          </span>
        </div>

        <div class="p-6">
          <!-- Match mini info -->
          <?php foreach($myMatch as $match):?>
          <div class="grid md:grid-cols-3 gap-4">
            <div class="panel rounded-2xl p-5">
              <div class="text-sm font-bold"><i class="fa-solid fa-calendar-day mr-2 text-white/70"></i>Date</div>
              <div class="mt-2 text-sm muted2"><?= $match['date_match'] ?></div>
            </div>
            <div class="panel rounded-2xl p-5">
              <div class="text-sm font-bold"><i class="fa-solid fa-clock mr-2 text-white/70"></i>Heure</div>
              <div class="mt-2 text-sm muted2"><?= $match['hour'] ?></div>
            </div>
            <div class="panel rounded-2xl p-5">
              <div class="text-sm font-bold"><i class="fa-solid fa-location-dot mr-2 text-white/70"></i>Lieu</div>
              <div class="mt-2 text-sm muted2"><?= $match['stade'] ?>, <?= $match['ville'] ?></div>
            </div>
          </div>
          <?php endforeach;?>
          <!-- Category -->
          <div class="mt-6">
            <div class="text-sm font-bold mb-3">
              <i class="fa-solid fa-layer-group mr-2 text-white/70"></i>Choisir une catégorie
            </div>
            
            <div class="grid md:grid-cols-3 gap-3">
              <?php foreach($categorieMatch as $categorie):?>
              <label class="card rounded-2xl p-4 cursor-pointer hover:bg-white/[0.04] transition block">
                <div class="flex items-center justify-between">
                  <div class="font-bold"><i class="fa-solid fa-crown mr-2 text-white/60"></i><?= $categorie['nom'] ?></div>
                  <input type="radio" name="cat" checked />
                </div>
                <div class="mt-3 text-2xl font-extrabold"><?= $categorie['prix'] ?> <span class="text-sm font-semibold muted2">MAD</span></div>
                <div class="mt-2 text-xs muted2">Meilleure vue • Accès premium</div>
              </label>
              <?php endforeach;?>
            </div>
          </div>

          <!-- Seat -->
          <div class="mt-6">
            <div class="text-sm font-bold mb-3">
              <i class="fa-solid fa-chair mr-2 text-white/70"></i>Choisir ta place
            </div>

            <div class="grid md:grid-cols-4 gap-3">
              <div>
                <div class="text-xs muted2 mb-2">Gate</div>
                <input class="in w-full" value="24"/>
              </div>
            </div>

            <div class="mt-4 flex flex-col md:flex-row gap-3">
              <a href="/auth/login.php" class="btn w-full md:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold">
                <i class="fa-solid fa-right-to-bracket"></i>Se connecter
              </a>
              <a href="/auth/register.php" class="btn-red w-full md:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold">
                <i class="fa-solid fa-user-plus"></i>Créer un compte
              </a>
            </div>
          </div>
        </div>
      </section>

      <!-- Right: summary -->
      <aside class="panel rounded-2xl p-6">
        <div class="text-sm font-bold">
          <i class="fa-solid fa-receipt mr-2 text-white/70"></i>Résumé
        </div>

        <div class="mt-4 space-y-3">
          <div class="mini flex items-center justify-between">
            <div class="muted2 text-sm">Catégorie</div>
            <div class="font-bold">VIP</div>
          </div>
          <div class="mini flex items-center justify-between">
            <div class="muted2 text-sm">Place</div>
            <div class="font-bold">24 • B • D • 17</div>
          </div>
          <div class="mini flex items-center justify-between">
            <div class="muted2 text-sm">Prix</div>
            <div class="font-extrabold">600 MAD</div>
          </div>
        </div>

        <div class="mt-4 card rounded-2xl p-4 flex items-start gap-3">
          <i class="fa-solid fa-lock text-white/60 mt-0.5"></i>
          <div class="text-sm muted2">
            En vrai: ici tu vas enregistrer la réservation dans la DB.
          </div>
        </div>

        <a href="#ticket" class="mt-4 btn-red w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold">
          <i class="fa-solid fa-ticket"></i>Voir le ticket en bas
        </a>
      </aside>
    </div>

    <!-- Ticket area -->
    <div id="ticket" class="mt-10">
      <div class="flex items-center justify-between gap-3">
        <div>
          <div class="inline-flex items-center gap-2 pill px-3 py-1.5 rounded-full text-xs font-semibold">
            <i class="fa-solid fa-qrcode"></i> Ticket
          </div>
          <h2 class="mt-3 text-3xl brand">Ticket</h2>
        </div>
      </div>

      <div class="mt-5 ticket">
        <div class="ticket-grid">

          <!-- LEFT STUB -->
          <div class="ticket-left">
            <div class="notch l"></div>

            <div class="text-xs uppercase tracking-[0.28em] muted2">Welcome</div>
            <div class="mt-2 brand text-2xl">StadiaTick</div>

            <div class="mt-5 mini">
              <div class="label">Match ID</div>
              <div class="value">ST-057</div>
            </div>

            <div class="mt-3 mini">
              <div class="label">Entry</div>
              <div class="value">Gate 24</div>
            </div>

            <div class="mt-5 text-xs muted2">
              <i class="fa-solid fa-circle-info mr-2"></i>
              Billet nominatif (demo).
            </div>
          </div>

          <!-- MIDDLE INFO -->
          <div class="ticket-mid">
            <div class="flex items-start justify-between gap-3">
              <div>
                <div class="label">Fixture</div>
                <div class="mt-2 text-2xl md:text-3xl font-extrabold">
                  Wydad AC <span class="text-white/45">vs</span> Raja CA
                </div>
                <div class="mt-2 muted2 text-sm">Complexe Mohammed V — Casablanca</div>
              </div>
              <span class="badge">VIP</span>
            </div>

            <div class="mt-5 grid md:grid-cols-3 gap-3">
              <div class="mini">
                <div class="label">Date</div>
                <div class="value">15/12/2025</div>
              </div>
              <div class="mini">
                <div class="label">Gates open</div>
                <div class="value">19:00</div>
              </div>
              <div class="mini">
                <div class="label">Kick-off</div>
                <div class="value">20:00</div>
              </div>
            </div>

            <div class="mt-3 grid md:grid-cols-4 gap-3">
              <div class="mini">
                <div class="label">Gate</div>
                <div class="value">24</div>
              </div>
              <div class="mini">
                <div class="label">Block</div>
                <div class="value">B</div>
              </div>
              <div class="mini">
                <div class="label">Row</div>
                <div class="value">D</div>
              </div>
              <div class="mini">
                <div class="label">Seat</div>
                <div class="value">17</div>
              </div>
            </div>

            <div class="mt-4 mini flex items-center justify-between">
              <div>
                <div class="label">Price</div>
                <div class="value">600 MAD</div>
              </div>
              <div class="text-right">
                <div class="label">Ref</div>
                <div class="value">ST-2025-0001</div>
              </div>
            </div>
          </div>

          <!-- RIGHT BADGE -->
          <div class="ticket-right">
            <div class="notch r"></div>

            <div class="flex items-start justify-between">
              <div>
                <div class="label">Access</div>
                <div class="mt-2 font-extrabold text-xl">Stadium Pass</div>
                <div class="mt-1 muted2 text-sm">Scan at entry</div>
              </div>
              <div class="w-10 h-10 rounded-xl card-red flex items-center justify-center">
                <i class="fa-solid fa-ticket"></i>
              </div>
            </div>

            <div class="mt-5 flex items-center justify-center">
              <div class="qr" aria-label="QR demo"></div>
            </div>

            <div class="mt-5 text-xs muted2 leading-relaxed">
              <i class="fa-solid fa-shield-halved mr-2"></i>
              Demo ticket. En vrai tu vas générer QR depuis DB.
            </div>

            <a href="/auth/login.php" class="mt-4 btn w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold">
              <i class="fa-solid fa-right-to-bracket"></i>Confirmer (login)
            </a>
            <a href="/auth/register.php" class="mt-3 btn-red w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold">
              <i class="fa-solid fa-user-plus"></i>Créer un compte
            </a>
          </div>

        </div>
      </div>
    </div>

  </main>

</body>
</html>
