<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>StadiaTick — 404</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    body{font-family:'Plus Jakarta Sans',sans-serif}
    .brand{font-family:'Marcellus',serif}

    :root{
      --bg:#07070A;
      --border:rgba(255,255,255,.10);
      --muted:rgba(255,255,255,.70);
      --muted2:rgba(255,255,255,.55);
      --gold:#B08A3A;
      --red:#A11433;
    }

    .bg-app{
      background:
        radial-gradient(900px 500px at 15% 10%, rgba(161, 20, 51, .20), transparent 60%),
        radial-gradient(900px 500px at 90% 20%, rgba(176, 138, 58, .12), transparent 60%),
        radial-gradient(700px 420px at 50% 105%, rgba(161, 20, 51, .14), transparent 60%),
        var(--bg);
    }

    .card{
      background: rgba(15, 15, 22, .88);
      border: 1px solid var(--border);
    }

    .card-red{
      background: linear-gradient(180deg, rgba(161, 20, 51, .36), rgba(15, 15, 22, .92));
      border: 1px solid rgba(161, 20, 51, .35);
    }

    .muted{color:var(--muted)}
    .muted2{color:var(--muted2)}

    .btn{
      border:1px solid var(--border);
      background:rgba(255,255,255,.04);
      transition:.2s;
    }
    .btn:hover{background:rgba(255,255,255,.07);transform:translateY(-1px)}

    .btn-red{
      background:linear-gradient(180deg, rgba(161, 20, 51, .95), rgba(122, 15, 38, .95));
      border:1px solid rgba(176, 138, 58, .22);
      transition:.2s;
    }
    .btn-red:hover{filter:brightness(1.05);transform:translateY(-1px)}

    /* ===== 404 Animations ===== */
    .floaty{animation:floaty 5s ease-in-out infinite}
    @keyframes floaty{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}

    .scan{position:relative;overflow:hidden}
    .scan::after{
      content:"";
      position:absolute;
      left:-40%;
      top:-60%;
      width:40%;
      height:220%;
      background:linear-gradient(90deg,transparent,rgba(255,255,255,.08),transparent);
      transform:rotate(18deg);
      animation:scan 3.4s linear infinite;
      pointer-events:none;
    }
    @keyframes scan{0%{left:-40%}100%{left:120%}}

    .glow-dot{
      width:10px;height:10px;border-radius:999px;
      background:rgba(176,138,58,.9);
      box-shadow:0 0 24px rgba(176,138,58,.55);
      animation:blink 1.8s ease-in-out infinite;
    }
    @keyframes blink{0%,100%{opacity:.55;transform:scale(.95)}50%{opacity:1;transform:scale(1.12)}}

    .ring{
      position:absolute;inset:-14px;border-radius:26px;
      border:1px solid rgba(176,138,58,.20);
      animation:ring 2.6s ease-in-out infinite;
      pointer-events:none;
    }
    @keyframes ring{0%{transform:scale(.96);opacity:.55}50%{transform:scale(1.03);opacity:.25}100%{transform:scale(.96);opacity:.55}}

    .pop{animation:pop .55s ease-out both}
    @keyframes pop{0%{transform:translateY(10px);opacity:0}100%{transform:translateY(0);opacity:1}}

    @media (prefers-reduced-motion: reduce){
      .floaty,.scan::after,.glow-dot,.ring,.pop{animation:none!important}
      .btn:hover,.btn-red:hover{transform:none}
    }
  </style>
</head>

<body class="bg-app text-white min-h-screen">

  <main class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-2xl relative pop">
      <div class="ring"></div>

      <div class="card rounded-2xl p-7 sm:p-10 scan floaty">
        <!-- Header -->
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-xl card-red flex items-center justify-center">
            <i class="fa-solid fa-triangle-exclamation"></i>
          </div>
          <div>
            <div class="text-2xl brand leading-none">StadiaTick</div>
            <div class="text-xs muted2 -mt-0.5 flex items-center gap-2">
              <span class="glow-dot"></span>
              Erreur 404
            </div>
          </div>
        </div>

        <!-- Big 404 -->
        <div class="mt-8 text-center">
          <div class="text-[92px] sm:text-[120px] brand leading-none text-white/90">404</div>
          <div class="mt-2 text-xl sm:text-2xl font-semibold">Page introuvable</div>
          <p class="mt-3 muted leading-relaxed max-w-xl mx-auto">
            Le lien est peut-être incorrect ou la page a été déplacée.
            Retourne à l’accueil pour continuer.
          </p>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex flex-col sm:flex-row gap-3 sm:justify-center">
          <a href="index.html" class="btn-red px-5 py-3 rounded-xl text-sm font-semibold text-center">
            <i class="fa-solid fa-house mr-2"></i>Back to Home
          </a>
          <button onclick="history.back()" class="btn px-5 py-3 rounded-xl text-sm font-semibold">
            <i class="fa-solid fa-arrow-left mr-2"></i>Retour
          </button>
        </div>

        <!-- Small footer -->
        <div class="mt-8 pt-6 border-t border-white/10 flex items-center justify-between text-xs muted2">
          <span>Code: <span class="text-white/70 font-semibold">ERR-404</span></span>
          <span class="brand text-white/70">StadiaTick</span>
        </div>
      </div>
    </div>
  </main>

</body>
</html>
