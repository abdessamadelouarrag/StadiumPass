<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>StadiumPass — Votre Ticket</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .brand { font-family: 'Marcellus', serif; }
    
    .bg-app {
      background:
        radial-gradient(900px 500px at 15% 10%, rgba(161, 20, 51, .18), transparent 60%),
        radial-gradient(900px 500px at 90% 20%, rgba(176, 138, 58, .10), transparent 60%),
        #07070A;
    }
    
    .card {
      background: rgba(15, 15, 22, .88);
      border: 1px solid rgba(255, 255, 255, .10);
    }
    
    .btn-red {
      background: linear-gradient(180deg, rgba(161, 20, 51, .95), rgba(122, 15, 38, .95));
      border: 1px solid rgba(176, 138, 58, .22);
      transition: .2s;
    }
    
    .btn-red:hover {
      filter: brightness(1.05);
      transform: translateY(-1px);
    }
    
    .btn {
      border: 1px solid rgba(255, 255, 255, .10);
      background: rgba(255, 255, 255, .04);
      transition: .2s;
    }
    
    .btn:hover {
      background: rgba(255, 255, 255, .07);
      transform: translateY(-1px);
    }
    
    .badge {
      border: 1px solid rgba(176, 138, 58, .28);
      background: rgba(176, 138, 58, .09);
    }
  </style>
</head>

<body class="bg-app text-white min-h-screen">

  <main class="max-w-4xl mx-auto px-4 py-12">
    
    <!-- Success Message -->
    <div class="mb-8 bg-green-500/10 border border-green-500/30 rounded-2xl p-6 text-center">
      <i class="fa-solid fa-circle-check text-green-400 text-4xl mb-3"></i>
      <h2 class="text-2xl brand mb-2">Réservation confirmée !</h2>
      <p class="text-white/70">Votre ticket a été généré avec succès.</p>
      <br>
      <p class="text-green-600/70 font-bold">" Voir ton email "</p>

    </div>
  </main>

</body>
</html>