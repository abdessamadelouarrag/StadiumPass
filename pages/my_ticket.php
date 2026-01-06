<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>StadiaTick — My Ticket</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            scrollbar-width: none;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .brand {
            font-family: 'Marcellus', serif;
        }

        :root {
            --bg: #07070A;
            --border: rgba(255, 255, 255, .10);
            --muted: rgba(255, 255, 255, .65);
            --muted2: rgba(255, 255, 255, .55);
            --card: rgba(255, 255, 255, .04);
            --red: #ef4444;
            --red2: #dc2626;
        }

        body {
            background:
                radial-gradient(900px 500px at 10% 0%, rgba(239, 68, 68, .18), transparent 55%),
                radial-gradient(900px 600px at 90% 0%, rgba(220, 38, 38, .12), transparent 55%),
                var(--bg);
            color: #fff;
        }

        .panel {
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, .03);
            backdrop-filter: blur(10px);
        }

        .card {
            border: 1px solid var(--border);
            background: var(--card);
            backdrop-filter: blur(10px);
        }

        .pill {
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, .04);
        }

        .muted2 {
            color: var(--muted2);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: .35rem .7rem;
            border-radius: 999px;
            font-weight: 800;
            font-size: .75rem;
            border: 1px solid rgba(239, 68, 68, .35);
            background: rgba(239, 68, 68, .12);
            color: #fff;
        }

        .btn {
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, .06);
            transition: .2s;
        }

        .btn:hover {
            background: rgba(255, 255, 255, .10);
        }

        .btn-red {
            background: linear-gradient(135deg, var(--red), var(--red2));
            box-shadow: 0 10px 30px rgba(239, 68, 68, .18);
            transition: .2s;
        }

        .btn-red:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
        }

        .label {
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .22em;
            color: var(--muted2);
        }

        .value {
            margin-top: .25rem;
            font-weight: 800;
        }

        .mini {
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, .03);
            padding: .75rem .85rem;
            border-radius: 14px;
        }

        /* Ticket */
        .ticket {
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, .02);
            border-radius: 26px;
            overflow: hidden;
        }

        .ticket-grid {
            display: grid;
            grid-template-columns: 260px 1fr 280px;
        }

        @media(max-width: 1024px) {
            .ticket-grid {
                grid-template-columns: 1fr;
            }
        }

        .ticket-left,
        .ticket-mid,
        .ticket-right {
            padding: 22px;
            position: relative;
        }

        .ticket-left {
            background: rgba(255, 255, 255, .03);
            border-right: 1px dashed rgba(255, 255, 255, .15);
        }

        .ticket-right {
            background: rgba(255, 255, 255, .03);
            border-left: 1px dashed rgba(255, 255, 255, .15);
        }

        @media(max-width: 1024px) {
            .ticket-left {
                border-right: none;
                border-bottom: 1px dashed rgba(255, 255, 255, .15);
            }

            .ticket-right {
                border-left: none;
                border-top: 1px dashed rgba(255, 255, 255, .15);
            }
        }

        /* Notches */
        .notch {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: var(--bg);
            border: 1px solid rgba(255, 255, 255, .10);
        }

        .notch.l {
            right: -17px;
        }

        .notch.r {
            left: -17px;
        }

        /* QR demo */
        .qr {
            width: 160px;
            height: 160px;
            border-radius: 18px;
            border: 1px solid rgba(255, 255, 255, .16);
            background:
                linear-gradient(90deg, rgba(255, 255, 255, .08) 1px, transparent 1px) 0 0/14px 14px,
                linear-gradient(0deg, rgba(255, 255, 255, .08) 1px, transparent 1px) 0 0/14px 14px,
                radial-gradient(circle at 30% 30%, rgba(239, 68, 68, .35), transparent 45%),
                rgba(255, 255, 255, .02);
        }

        .card-red {
            border: 1px solid rgba(239, 68, 68, .35);
            background: rgba(239, 68, 68, .14);
            box-shadow: 0 12px 30px rgba(239, 68, 68, .14);
        }
    </style>
</head>

<body>
    <div class="max-w-6xl mx-auto px-4 py-10">

        <!-- Header -->
        <header class="flex items-center justify-between gap-4">

            <a href="/" class="btn px-4 py-2 rounded-xl text-sm font-semibold inline-flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
        </header>

        <!-- Ticket area -->
        <div id="ticket" class="mt-3">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <div class="inline-flex items-center gap-2 pill px-3 py-1.5 rounded-full text-xs font-semibold">
                        <i class="fa-solid fa-qrcode"></i> Ticket
                    </div>
                </div>
            </div>

            <div class="mt-5 ticket">
                <div class="ticket-grid">

                    <!-- LEFT STUB -->
                    <div class="ticket-left">
                        <div class="notch l"></div>

                        <div class="text-xs uppercase tracking-[0.28em] muted2">Welcome</div>
                        <div class="mt-2 brand text-2xl">StadiumPass</div>

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
                            <i class="fa-solid fa-right-to-bracket"></i> Confirmer (login)
                        </a>
                        <a href="/auth/register.php" class="mt-3 btn-red w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold">
                            <i class="fa-solid fa-user-plus"></i> Créer un compte
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <footer class="mt-10 text-center text-xs muted2">
            © StadiaTick — MyTicket (template)
        </footer>
    </div>
</body>

</html>