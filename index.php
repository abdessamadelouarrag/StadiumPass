<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>StadiaTick — Visiteur</title>

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
            --card: #0F0F16;
            --panel: #0B0B10;
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

        .input {
            background: rgba(255, 255, 255, .03);
            border: 1px solid rgba(255, 255, 255, .10)
        }

        .input:focus {
            outline: none;
            border-color: rgba(176, 138, 58, .55)
        }

        .pill {
            border: 1px solid rgba(176, 138, 58, .28);
            background: rgba(176, 138, 58, .08)
        }

        .backdrop {
            background: rgba(0, 0, 0, .60)
        }
    </style>
</head>

<body class="bg-app text-white min-h-screen">

    <!-- NAV -->
    <nav class="sticky top-0 z-50 border-b border-white/10 bg-black/40 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <a href="index.html" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl card-red flex items-center justify-center">
                    <i class="fa-solid fa-ticket"></i>
                </div>
                <div>
                    <div class="text-2xl brand tracking-wide">StadiaTick</div>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-2">
                <a href="/auth/login.php" class="btn px-4 py-2 rounded-xl text-sm font-semibold">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i>Login
                </a>
                <a href="/auth/register.php" class="btn-red px-5 py-2.5 rounded-xl text-sm font-bold">
                    <i class="fa-solid fa-user-plus mr-2"></i>Signup
                </a>
            </div>

            <button id="mBtn" class="md:hidden btn px-3 py-2 rounded-xl">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
        <div id="mMenu" class="md:hidden hidden px-4 pb-4">
            <div class="panel rounded-2xl p-3 flex flex-col gap-2">
                <a href="/auth/login.php" class="btn px-4 py-3 rounded-xl text-sm font-semibold">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i>Login
                </a>
                <a href="/auth/login.php" class="btn-red px-4 py-3 rounded-xl text-sm font-bold">
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
                    Vous pouvez consulter la liste des matchs publiés et voir les détails.
                    Pour acheter un billet, inscription obligatoire.
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
                            <input id="q" class="w-full bg-transparent outline-none text-white placeholder:text-white/35" placeholder="Equipe, stade, ville..." />
                        </div>
                    </div>
                    <div>
                        <div class="text-xs muted2 mb-1">Ville</div>
                        <select id="city" class="w-full input rounded-xl px-4 py-3 text-white bg-transparent outline-none">
                            <option value="">Toutes</option>
                            <option>Casablanca</option>
                            <option>Rabat</option>
                            <option>Marrakech</option>
                            <option>Tanger</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="text-xs muted2 mb-1">Compétition</div>
                        <select id="comp" class="w-full input rounded-xl px-4 py-3 text-white bg-transparent outline-none">
                            <option value="">Toutes</option>
                            <option>Ligue Pro</option>
                            <option>Coupe Nationale</option>
                            <option>Super Cup</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex flex-col sm:flex-row gap-3">
                    <button id="apply" class="btn-red px-5 py-3 rounded-xl text-sm font-bold w-full sm:w-auto">
                        <i class="fa-solid fa-check mr-2"></i>Appliquer
                    </button>
                    <a href="signup.html" class="btn px-5 py-3 rounded-xl text-sm font-semibold w-full sm:w-auto text-center">
                        <i class="fa-solid fa-ticket mr-2"></i>Réserver (Signup)
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- MATCHES -->
    <main class="max-w-7xl mx-auto px-4 pb-16">
        <div class="flex items-end justify-between gap-4">
            <div>
                <div class="text-xs uppercase tracking-[0.28em] text-white/60">Matches</div>
                <h2 class="mt-2 text-4xl brand">Matchs publiés</h2>
                <p class="mt-3 muted max-w-2xl">Détails accessibles. Achat → Signup.</p>
            </div>
            <div class="hidden md:flex items-center gap-2 panel rounded-2xl px-4 py-3">
                <i class="fa-solid fa-lock text-white/60"></i>
                <div class="text-sm muted2">Réserver nécessite un compte</div>
            </div>
        </div>

        <div id="grid" class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    </main>

    <!-- FOOTER -->
    <footer class="border-t border-white/10 bg-black/30">
        <div class="max-w-7xl mx-auto px-4 py-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <div class="brand text-2xl">StadiaTick</div>
            </div>
            <div class="flex items-center gap-2">
                <a href="/auth/login.php" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i class="fa-solid fa-right-to-bracket mr-2"></i>Login</a>
                <a href="/auth/register.php" class="btn-red px-4 py-2 rounded-xl text-sm font-bold"><i class="fa-solid fa-user-plus mr-2"></i>Signup</a>
            </div>
        </div>
        <p class="brand text-[12px] m-1 text-white/30 flex justify-center">By Abdessamad El ouarrag</p>
    </footer>

    <!-- DETAILS MODAL -->
    <div id="modal" class="fixed inset-0 hidden items-center justify-center z-[100]">
        <div class="absolute inset-0 backdrop"></div>
        <div class="relative w-[94%] max-w-3xl card rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-white/10 flex items-center justify-between">
                <div>
                    <div class="text-xs uppercase tracking-[0.28em] muted2">Détails du match</div>
                    <div id="dTitle" class="text-2xl brand mt-1">—</div>
                </div>
                <button id="close" class="btn px-3 py-2 rounded-xl"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="p-6 grid lg:grid-cols-2 gap-6">
                <div class="card-red rounded-2xl p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-bold"><i class="fa-solid fa-trophy mr-2 text-white/70"></i><span id="dComp">—</span></div>
                        <span class="pill px-3 py-1 rounded-full text-xs font-semibold"><i class="fa-solid fa-circle-check mr-2"></i>Published</span>
                    </div>

                    <div class="mt-6 grid grid-cols-3 gap-3 items-center">
                        <div class="card rounded-2xl p-4 text-center">
                            <i class="fa-solid fa-shield text-white/70 text-2xl"></i>
                            <div id="dHome" class="mt-2 font-bold">—</div>
                            <div class="text-xs muted2">Home</div>
                        </div>
                        <div class="text-center">
                            <div class="brand text-3xl text-white/80">VS</div>
                            <div class="text-xs muted2 mt-1">Match</div>
                        </div>
                        <div class="card rounded-2xl p-4 text-center">
                            <i class="fa-solid fa-shield text-white/70 text-2xl"></i>
                            <div id="dAway" class="mt-2 font-bold">—</div>
                            <div class="text-xs muted2">Away</div>
                        </div>
                    </div>

                    <div class="mt-6 space-y-2 text-sm muted2">
                        <div><i class="fa-solid fa-calendar-day w-5 mr-2 text-white/60"></i><span id="dWhen">—</span></div>
                        <div><i class="fa-solid fa-location-dot w-5 mr-2 text-white/60"></i><span id="dWhere">—</span></div>
                        <div><i class="fa-solid fa-chair w-5 mr-2 text-white/60"></i><span id="dSeats">—</span></div>
                    </div>
                </div>

                <div class="panel rounded-2xl p-5">
                    <div class="text-sm font-bold"><i class="fa-solid fa-tags mr-2 text-white/70"></i>Catégories & prix</div>
                    <div id="dCats" class="mt-4 space-y-3"></div>

                    <div class="mt-6 card rounded-2xl p-4 flex items-start gap-3">
                        <i class="fa-solid fa-lock text-white/60 mt-0.5"></i>
                        <div class="text-sm muted2">
                            Pour réserver un billet : inscription obligatoire.
                        </div>
                    </div>

                    <a href="signup.html" class="mt-4 btn-red w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold">
                        <i class="fa-solid fa-user-plus"></i>Aller au Signup
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const $ = (s) => document.querySelector(s);
        const $$ = (s) => document.querySelectorAll(s);

        $("#mBtn").addEventListener("click", () => $("#mMenu").classList.toggle("hidden"));

        // "DB" demo matches
        const matches = [{
                id: 1,
                home: "Wydad AC",
                away: "Raja CA",
                city: "Casablanca",
                stadium: "Complexe Mohammed V",
                date: "15 Décembre 2025",
                time: "20:00",
                comp: "Ligue Pro",
                seats: 2000,
                categories: [{
                    name: "VIP",
                    price: 600
                }, {
                    name: "Cat 1",
                    price: 350
                }, {
                    name: "Cat 2",
                    price: 200
                }]
            },
            {
                id: 2,
                home: "FUS Rabat",
                away: "AS FAR",
                city: "Rabat",
                stadium: "Stade Moulay Abdellah",
                date: "22 Décembre 2025",
                time: "19:30",
                comp: "Coupe Nationale",
                seats: 1800,
                categories: [{
                    name: "VIP",
                    price: 500
                }, {
                    name: "Cat 1",
                    price: 300
                }, {
                    name: "Cat 2",
                    price: 180
                }]
            },
            {
                id: 3,
                home: "Kawkab Marrakech",
                away: "IRT Tanger",
                city: "Marrakech",
                stadium: "Stade de Marrakech",
                date: "29 Décembre 2025",
                time: "18:00",
                comp: "Super Cup",
                seats: 1600,
                categories: [{
                    name: "VIP",
                    price: 450
                }, {
                    name: "Cat 1",
                    price: 260
                }, {
                    name: "Cat 2",
                    price: 150
                }]
            },
            {
                id: 4,
                home: "Moghreb Tétouan",
                away: "Olympic Safi",
                city: "Tanger",
                stadium: "Grand Stade de Tanger",
                date: "05 Janvier 2026",
                time: "21:00",
                comp: "Ligue Pro",
                seats: 2000,
                categories: [{
                    name: "VIP",
                    price: 520
                }, {
                    name: "Cat 1",
                    price: 310
                }, {
                    name: "Cat 2",
                    price: 190
                }]
            }
        ];

        function matchCard(m) {
            const min = Math.min(...m.categories.map(c => c.price));
            return `
        <div class="card rounded-2xl p-5">
          <div class="flex items-center justify-between">
            <div class="pill px-3 py-1 rounded-full text-xs font-semibold">
              <i class="fa-solid fa-trophy mr-2"></i>${m.comp}
            </div>
            <div class="text-xs muted2"><i class="fa-solid fa-tag mr-2"></i>From <b class="text-white">${min} MAD</b></div>
          </div>

          <div class="mt-5 flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl card-red flex items-center justify-center">
              <i class="fa-solid fa-shield text-white/80"></i>
            </div>
            <div class="flex-1">
              <div class="font-bold text-lg">${m.home} <span class="text-white/45">vs</span> ${m.away}</div>
              <div class="text-sm muted2 mt-1">
                <i class="fa-solid fa-calendar-day mr-2 text-white/50"></i>${m.date} — ${m.time}
              </div>
              <div class="text-sm muted2 mt-1">
                <i class="fa-solid fa-location-dot mr-2 text-white/50"></i>${m.stadium}, ${m.city}
              </div>
            </div>
          </div>

          <div class="mt-5 grid grid-cols-2 gap-3">
            <button class="btn px-4 py-3 rounded-xl text-sm font-semibold details" data-id="${m.id}">
              <i class="fa-solid fa-circle-info mr-2"></i>Détails
            </button>
            <a href="signup.html" class="btn-red px-4 py-3 rounded-xl text-sm font-bold text-center">
              <i class="fa-solid fa-ticket mr-2"></i>Réserver
            </a>
          </div>
        </div>
      `;
        }

        function render(list) {
            $("#grid").innerHTML = list.map(matchCard).join("");
            $$(".details").forEach(b => b.addEventListener("click", () => openDetails(Number(b.dataset.id))));
        }

        function apply() {
            const q = ($("#q").value || "").trim().toLowerCase();
            const city = $("#city").value;
            const comp = $("#comp").value;

            const filtered = matches.filter(m => {
                const hay = `${m.home} ${m.away} ${m.city} ${m.stadium} ${m.comp}`.toLowerCase();
                return (!q || hay.includes(q)) && (!city || m.city === city) && (!comp || m.comp === comp);
            });
            render(filtered);
        }

        $("#apply").addEventListener("click", apply);
        $("#q").addEventListener("input", apply);
        $("#city").addEventListener("change", apply);
        $("#comp").addEventListener("change", apply);

        // modal
        function openModal() {
            $("#modal").classList.remove("hidden");
            $("#modal").classList.add("flex");
            document.body.classList.add("overflow-hidden");
        }

        function closeModal() {
            $("#modal").classList.add("hidden");
            $("#modal").classList.remove("flex");
            document.body.classList.remove("overflow-hidden");
        }
        $("#close").addEventListener("click", closeModal);

        function openDetails(id) {
            const m = matches.find(x => x.id === id);
            if (!m) return;

            $("#dTitle").textContent = `${m.home} vs ${m.away}`;
            $("#dComp").textContent = m.comp;
            $("#dHome").textContent = m.home;
            $("#dAway").textContent = m.away;
            $("#dWhen").textContent = `${m.date} — ${m.time}`;
            $("#dWhere").textContent = `${m.stadium}, ${m.city}`;
            $("#dSeats").textContent = `${m.seats} places`;

            $("#dCats").innerHTML = m.categories.map(c => `
        <div class="card rounded-xl p-4 flex items-center justify-between">
          <div class="font-semibold"><i class="fa-solid fa-ticket mr-2 text-white/60"></i>${c.name}</div>
          <div class="font-bold">${c.price} MAD</div>
        </div>
      `).join("");

            openModal();
        }

        apply();
    </script>
</body>

</html>