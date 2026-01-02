<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>StadiaTick — Organisateur</title>

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
                    <div class="text-2xl brand">StadiaTick</div>
                    <div class="text-xs muted2 -mt-0.5">Organisateur</div>
                </div>
            </a>

            <div class="flex items-center gap-2">
                <a href="index.html" class="btn px-4 py-2 rounded-xl text-sm font-semibold">
                    <i class="fa-solid fa-house mr-2"></i>Home
                </a>
                <a href="matchs.php" class="btn px-4 py-2 rounded-xl text-sm font-semibold">
                    <i class="fa-solid fa-bag-shopping mr-2"></i>Acheteur
                </a>
                <a href="admin.html" class="btn px-4 py-2 rounded-xl text-sm font-semibold">
                    <i class="fa-solid fa-shield-halved mr-2"></i>Admin
                </a>
                <button class="btn px-4 py-2 rounded-xl text-sm font-semibold">
                    <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Logout
                </button>
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
                <div class="text-xs muted2">Session</div>
                <div class="mt-1 font-bold">— Nom Organisateur</div>
                <div class="text-sm muted2">— email@stadiatick.local</div>
                <div class="mt-3 flex gap-2">
                    <a href="#profile" class="btn px-3 py-2 rounded-xl text-xs font-semibold">
                        <i class="fa-solid fa-user-gear mr-2"></i>Profil
                    </a>
                    <a href="#stats" class="btn px-3 py-2 rounded-xl text-xs font-semibold">
                        <i class="fa-solid fa-chart-line mr-2"></i>Stats
                    </a>
                    <a href="#reviews" class="btn px-3 py-2 rounded-xl text-xs font-semibold">
                        <i class="fa-solid fa-star mr-2"></i>Avis
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 pb-16">

        <!-- KPIs -->
        <section id="stats" class="grid md:grid-cols-3 gap-4">
            <div class="card rounded-2xl p-5">
                <div class="text-xs muted2">Billets vendus</div>
                <div class="mt-2 text-3xl font-extrabold">—</div>
                <div class="mt-2 text-xs muted2"><i class="fa-solid fa-circle-info mr-2"></i>Total tous matchs</div>
            </div>
            <div class="card rounded-2xl p-5">
                <div class="text-xs muted2">Chiffre d’affaires</div>
                <div class="mt-2 text-3xl font-extrabold">— <span class="text-base muted2">MAD</span></div>
                <div class="mt-2 text-xs muted2"><i class="fa-solid fa-circle-info mr-2"></i>Total validé</div>
            </div>
            <div class="card rounded-2xl p-5">
                <div class="text-xs muted2">Matchs en attente</div>
                <div class="mt-2 text-3xl font-extrabold">—</div>
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

                <form class="p-6 space-y-6" action="#" method="POST" enctype="multipart/form-data">

                    <!-- Teams -->
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="panel rounded-2xl p-5">
                            <div class="font-bold mb-4"><i class="fa-solid fa-people-group mr-2 text-white/60"></i>Équipe A</div>
                            <label class="text-xs muted2 block mb-1">Nom</label>
                            <input name="teamA_name" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="Ex: Wydad AC" />
                            <label class="text-xs muted2 block mt-4 mb-1">Logo (PNG/JPG)</label>
                            <input name="teamA_logo" type="file" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" />
                            <div class="mt-3 text-xs muted2 hint rounded-xl px-4 py-3">
                                <i class="fa-solid fa-circle-info mr-2"></i>Le logo sera affiché sur la page match (plus tard via PHP).
                            </div>
                        </div>

                        <div class="panel rounded-2xl p-5">
                            <div class="font-bold mb-4"><i class="fa-solid fa-people-group mr-2 text-white/60"></i>Équipe B</div>
                            <label class="text-xs muted2 block mb-1">Nom</label>
                            <input name="teamB_name" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="Ex: Raja CA" />
                            <label class="text-xs muted2 block mt-4 mb-1">Logo (PNG/JPG)</label>
                            <input name="teamB_logo" type="file" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" />
                            <div class="mt-3 text-xs muted2 hint rounded-xl px-4 py-3">
                                <i class="fa-solid fa-circle-info mr-2"></i>Validation admin obligatoire avant publication.
                            </div>
                        </div>
                    </div>

                    <!-- Match info -->
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="panel rounded-2xl p-5">
                            <div class="font-bold mb-4"><i class="fa-solid fa-calendar-days mr-2 text-white/60"></i>Date & heure</div>
                            <label class="text-xs muted2 block mb-1">Date</label>
                            <input name="date" type="date" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" />
                            <label class="text-xs muted2 block mt-4 mb-1">Heure</label>
                            <input name="time" type="time" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" />
                            <label class="text-xs muted2 block mt-4 mb-1">Durée (min)</label>
                            <input name="duration" type="number" value="90" min="1" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" />
                        </div>

                        <div class="panel rounded-2xl p-5">
                            <div class="font-bold mb-4"><i class="fa-solid fa-location-dot mr-2 text-white/60"></i>Lieu</div>
                            <label class="text-xs muted2 block mb-1">Stade</label>
                            <input name="stadium" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="Ex: Complexe Mohammed V" />
                            <label class="text-xs muted2 block mt-4 mb-1">Ville</label>
                            <input name="city" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="Ex: Casablanca" />
                            <label class="text-xs muted2 block mt-4 mb-1">Nombre de places (max 2000)</label>
                            <input name="capacity" type="number" value="2000" min="1" max="2000" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" />
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="panel rounded-2xl p-5">
                        <div class="flex items-center justify-between gap-4">
                            <div class="font-bold"><i class="fa-solid fa-tags mr-2 text-white/60"></i>Catégories (max 3)</div>
                            <div class="text-xs muted2">Ex: VIP / Cat 1 / Cat 2</div>
                        </div>

                        <div class="mt-4 grid md:grid-cols-3 gap-4">
                            <!-- Cat 1 -->
                            <div class="card rounded-2xl p-4">
                                <div class="text-xs muted2 mb-2">Catégorie 1</div>
                                <input name="cat1_name" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="VIP" />
                                <div class="mt-3 text-xs muted2 mb-2">Prix (MAD)</div>
                                <input name="cat1_price" type="number" min="0" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="600" />
                            </div>

                            <!-- Cat 2 -->
                            <div class="card rounded-2xl p-4">
                                <div class="text-xs muted2 mb-2">Catégorie 2</div>
                                <input name="cat2_name" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="Cat 1" />
                                <div class="mt-3 text-xs muted2 mb-2">Prix (MAD)</div>
                                <input name="cat2_price" type="number" min="0" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="350" />
                            </div>

                            <!-- Cat 3 -->
                            <div class="card rounded-2xl p-4">
                                <div class="text-xs muted2 mb-2">Catégorie 3</div>
                                <input name="cat3_name" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="Cat 2" />
                                <div class="mt-3 text-xs muted2 mb-2">Prix (MAD)</div>
                                <input name="cat3_price" type="number" min="0" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="200" />
                            </div>
                        </div>

                        <div class="mt-4 hint rounded-xl px-4 py-3 text-xs muted2">
                            <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                            Astuce: côté PHP tu valides que max 3 catégories + prix > 0, puis status = <b class="text-white">pending</b>.
                        </div>

                        <div class="mt-4 flex flex-col sm:flex-row gap-3">
                            <button type="submit" class="btn-red px-5 py-3 rounded-xl text-sm font-bold">
                                <i class="fa-solid fa-paper-plane mr-2"></i>Envoyer la demande
                            </button>
                            <button type="reset" class="btn px-5 py-3 rounded-xl text-sm font-semibold">
                                <i class="fa-solid fa-rotate-left mr-2"></i>Réinitialiser
                            </button>
                        </div>
                    </div>

                </form>
            </section>

            <!-- RIGHT COLUMN -->
            <aside class="space-y-6">

                <!-- PROFILE -->
                <section id="profile" class="card rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/10">
                        <div class="font-bold"><i class="fa-solid fa-user-gear mr-2 text-white/60"></i>Gérer mon profil</div>
                        <div class="text-sm muted2 mt-1">Mettre à jour les infos</div>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <div class="text-xs muted2 mb-1">Nom</div>
                            <input class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="Votre nom" />
                        </div>
                        <div>
                            <div class="text-xs muted2 mb-1">Email</div>
                            <input type="email" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="you@mail.com" />
                        </div>
                        <div>
                            <div class="text-xs muted2 mb-1">Mot de passe (optionnel)</div>
                            <input type="password" class="input w-full rounded-xl px-4 py-3 text-white bg-transparent" placeholder="••••••••" />
                        </div>
                        <button class="btn-red w-full px-5 py-3 rounded-xl text-sm font-bold">
                            <i class="fa-solid fa-floppy-disk mr-2"></i>Enregistrer
                        </button>
                    </div>
                </section>

                <!-- MY EVENTS -->
                <section class="card rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/10 flex items-center justify-between">
                        <div class="font-bold"><i class="fa-solid fa-list-check mr-2 text-white/60"></i>Mes demandes</div>
                        <div class="text-sm muted2">Statut</div>
                    </div>

                    <div class="p-6 space-y-4">
                        <!-- item -->
                        <div class="panel rounded-2xl p-4">
                            <div class="flex items-center justify-between">
                                <div class="font-bold">Wydad AC vs Raja CA</div>
                                <span class="text-xs px-3 py-1 rounded-full border border-white/10 bg-white/5 muted2">
                                    <i class="fa-solid fa-clock mr-2"></i>En attente
                                </span>
                            </div>
                            <div class="mt-2 text-xs muted2">
                                <i class="fa-solid fa-calendar-day mr-2"></i>15/12/2025 — 20:00
                                <span class="mx-2 text-white/20">•</span>
                                <i class="fa-solid fa-location-dot mr-2"></i>Casablanca
                            </div>
                            <div class="mt-3 flex gap-2">
                                <a href="#" class="btn px-3 py-2 rounded-xl text-xs font-semibold">
                                    <i class="fa-solid fa-eye mr-2"></i>Détails
                                </a>
                                <a href="#" class="btn px-3 py-2 rounded-xl text-xs font-semibold">
                                    <i class="fa-solid fa-pen mr-2"></i>Modifier
                                </a>
                            </div>
                        </div>

                        <!-- item -->
                        <div class="panel rounded-2xl p-4">
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
                        </div>
                    </div>
                </section>

                <!-- REVIEWS -->
                <section id="reviews" class="card rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/10">
                        <div class="font-bold"><i class="fa-solid fa-star mr-2 text-white/60"></i>Commentaires & avis</div>
                        <div class="text-sm muted2 mt-1">Après fin du match</div>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="panel rounded-2xl p-4">
                            <div class="flex items-center justify-between">
                                <div class="font-bold">Wydad AC vs Raja CA</div>
                                <div class="text-xs muted2">
                                    <i class="fa-solid fa-star text-white/70"></i>
                                    <i class="fa-solid fa-star text-white/70"></i>
                                    <i class="fa-solid fa-star text-white/70"></i>
                                    <i class="fa-solid fa-star text-white/30"></i>
                                    <i class="fa-solid fa-star text-white/30"></i>
                                </div>
                            </div>
                            <div class="mt-2 text-xs muted2">
                                <i class="fa-solid fa-user mr-2"></i>Utilisateur: acheteur@test.com
                            </div>
                            <p class="mt-2 text-sm muted">
                                Organisation correcte, accès rapide. Les places VIP valent le coup.
                            </p>
                        </div>

                        <div class="panel rounded-2xl p-4">
                            <div class="flex items-center justify-between">
                                <div class="font-bold">FUS Rabat vs AS FAR</div>
                                <div class="text-xs muted2">
                                    <i class="fa-solid fa-star text-white/70"></i>
                                    <i class="fa-solid fa-star text-white/70"></i>
                                    <i class="fa-solid fa-star text-white/70"></i>
                                    <i class="fa-solid fa-star text-white/70"></i>
                                    <i class="fa-solid fa-star text-white/30"></i>
                                </div>
                            </div>
                            <div class="mt-2 text-xs muted2">
                                <i class="fa-solid fa-user mr-2"></i>Utilisateur: buyer2@test.com
                            </div>
                            <p class="mt-2 text-sm muted">
                                Très bon match, mais j’aurais aimé plus de contrôle à l’entrée.
                            </p>
                        </div>

                        <a href="#" class="btn w-full px-4 py-3 rounded-xl text-sm font-semibold text-center">
                            <i class="fa-solid fa-comments mr-2"></i>Voir tout
                        </a>
                    </div>
                </section>

            </aside>
        </div>
    </main>

</body>

</html>