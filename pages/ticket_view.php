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

  <!-- NAV -->
  <nav class="sticky top-0 z-50 border-b border-white/10 bg-black/40 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
      <a href="home.php" class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl card flex items-center justify-center">
          <i class="fa-solid fa-ticket"></i>
        </div>
        <div class="text-2xl brand tracking-wide">StadiumPass</div>
      </a>
    </div>
  </nav>

  <main class="max-w-4xl mx-auto px-4 py-12">
    
    <!-- Success Message -->
    <div class="mb-8 bg-green-500/10 border border-green-500/30 rounded-2xl p-6 text-center">
      <i class="fa-solid fa-circle-check text-green-400 text-4xl mb-3"></i>
      <h2 class="text-2xl brand mb-2">Réservation confirmée !</h2>
      <p class="text-white/70">Votre ticket a été généré avec succès.</p>
    </div>

    <!-- Ticket Preview -->
    <div class="card rounded-2xl p-8 mb-6">
      
      <!-- Header -->
      <div class="text-center mb-8">
        <div class="inline-block badge rounded-full px-4 py-2 text-xs font-bold mb-4">
          Ticket #<?= str_pad($ticketDetails['id_ticket'], 6, '0', STR_PAD_LEFT) ?>
        </div>
        
        <h1 class="text-3xl md:text-4xl brand mb-2">
          <?= htmlspecialchars($ticketDetails['equipe_home']) ?>
          <span class="text-white/40">vs</span>
          <?= htmlspecialchars($ticketDetails['equipe_away']) ?>
        </h1>
        
        <div class="inline-block mt-3 bg-yellow-500/10 border border-yellow-500/30 rounded-full px-4 py-1.5">
          <span class="text-yellow-400 font-bold text-sm">
            <?= htmlspecialchars($ticketDetails['nom_categorie']) ?>
          </span>
        </div>
      </div>

      <!-- Info Grid -->
      <div class="grid md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
          <div class="text-xs text-white/50 uppercase tracking-wider mb-1">Date</div>
          <div class="font-bold"><?= date('d/m/Y', strtotime($ticketDetails['date_match'])) ?></div>
        </div>
        
        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
          <div class="text-xs text-white/50 uppercase tracking-wider mb-1">Heure</div>
          <div class="font-bold"><?= date('H:i', strtotime($ticketDetails['hour'])) ?></div>
        </div>
        
        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
          <div class="text-xs text-white/50 uppercase tracking-wider mb-1">Stade</div>
          <div class="font-bold text-sm"><?= htmlspecialchars($ticketDetails['stade']) ?></div>
        </div>
      </div>

      <div class="grid md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
          <div class="text-xs text-white/50 uppercase tracking-wider mb-1">Place</div>
          <div class="font-bold text-xl"><?= htmlspecialchars($ticketDetails['place_stade']) ?></div>
        </div>
        
        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
          <div class="text-xs text-white/50 uppercase tracking-wider mb-1">Quantité</div>
          <div class="font-bold text-xl"><?= $ticketDetails['quantite'] ?></div>
        </div>
        
        <div class="bg-white/5 rounded-xl p-4 border border-white/10">
          <div class="text-xs text-white/50 uppercase tracking-wider mb-1">Prix Total</div>
          <div class="font-bold text-xl text-green-400"><?= number_format($totalPrice, 2) ?> MAD</div>
        </div>
      </div>

      <!-- Location -->
      <div class="text-center mb-6 p-4 bg-white/5 rounded-xl border border-white/10">
        <i class="fa-solid fa-location-dot text-white/50 mr-2"></i>
        <span class="text-white/70"><?= htmlspecialchars($ticketDetails['ville']) ?></span>
      </div>

      <!-- Verification Code -->
      <div class="bg-gradient-to-r from-yellow-500/10 to-red-500/10 border border-white/20 rounded-xl p-6 text-center">
        <div class="text-xs text-white/50 uppercase tracking-wider mb-2">Code de Vérification</div>
        <div class="font-mono font-bold text-xl mb-2"><?= $qrCode ?></div>
        <div class="text-xs text-white/50">Présentez ce code à l'entrée du stade</div>
      </div>

      <!-- Important Info -->
      <div class="mt-6 bg-red-500/10 border border-red-500/30 rounded-xl p-4">
        <div class="text-sm text-white/70 space-y-1">
          <div><i class="fa-solid fa-info-circle text-red-400 mr-2"></i>Arrivez 30 minutes avant le début</div>
          <div><i class="fa-solid fa-shield text-red-400 mr-2"></i>Ce ticket est personnel et non remboursable</div>
          <div><i class="fa-solid fa-calendar text-red-400 mr-2"></i>Réservé le <?= date('d/m/Y', strtotime($ticketDetails['date_reservation'])) ?></div>
        </div>
      </div>
    </div>

    <!-- Actions -->
    <div class="flex flex-col md:flex-row gap-4">
      <a href="ticket_pdf.php?id=<?= $ticketId ?>" class="btn-red flex-1 px-6 py-4 rounded-xl text-center font-bold">
        <i class="fa-solid fa-download mr-2"></i>Télécharger le PDF
      </a>
      
      <a href="home.php" class="btn flex-1 px-6 py-4 rounded-xl text-center font-bold">
        <i class="fa-solid fa-home mr-2"></i>Retour à l'accueil
      </a>
    </div>

  </main>

</body>
</html>