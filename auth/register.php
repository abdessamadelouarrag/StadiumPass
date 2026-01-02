<?php 

require_once "../config/database.php";
require_once "../classes/Auth.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $image = $_POST["image"];
    $role = $_POST["role"];

    $account = new Auth();

    $account->signup($nom, $email, $password, $image, $role);
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>StadiumPass — Signup</title>

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
            --gold: #B08A3A;
        }

        .bg-app {
            background: radial-gradient(900px 500px at 15% 10%, rgba(161, 20, 51, .18), transparent 60%), radial-gradient(900px 500px at 90% 20%, rgba(176, 138, 58, .10), transparent 60%), var(--bg);
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
    </style>
</head>

<body class="bg-app text-white min-h-screen">

    <nav class="border-b border-white/10 bg-black/40 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <a href="index.html" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl card-red flex items-center justify-center">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div>
                    <div class="text-2xl brand">StadiumPass</div>
                    <div class="text-xs muted2 -mt-0.5">Signup</div>
                </div>
            </a>

            <div class="flex items-center gap-2">
                <a href="index.html" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i class="fa-solid fa-house mr-2"></i>Home</a>
                <a href="login.html" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i class="fa-solid fa-right-to-bracket mr-2"></i>Login</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-14">
        <div class="max-w-2xl">
            <div class="text-xs uppercase tracking-[0.28em] text-white/60">Inscription</div>
            <h1 class="mt-2 text-5xl brand">Créer un compte</h1>
            <p class="mt-4 muted">Choisissez votre rôle : Acheteur ou Organisateur.</p>
        </div>

        <div class="mt-10 grid lg:grid-cols-2 gap-6">
            <section class="card rounded-2xl p-6">
                <div class="font-bold text-lg"><i class="fa-solid fa-id-card mr-2 text-white/70"></i>Informations</div>

                <form action="" method="POST">
                    <div class="mt-6 grid md:grid-cols-2 gap-4">
                        <div>
                            <div class="text-xs muted2 mb-1">Nom</div>
                            <div class="input rounded-xl px-4 py-3 flex items-center gap-3">
                                <i class="fa-solid fa-user text-white/45"></i>
                                <input name="nom" class="w-full bg-transparent outline-none text-white placeholder:text-white/35" placeholder="Votre nom" />
                            </div>
                        </div>
                        <div>
                            <div class="text-xs muted2 mb-1">Email</div>
                            <div class="input rounded-xl px-4 py-3 flex items-center gap-3">
                                <i class="fa-solid fa-envelope text-white/45"></i>
                                <input name="email" type="email" class="w-full bg-transparent outline-none text-white placeholder:text-white/35" placeholder="you@mail.com" />
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="text-xs muted2 mb-1">Mot de passe</div>
                            <div class="input rounded-xl px-4 py-3 flex items-center gap-3">
                                <i class="fa-solid fa-key text-white/45"></i>
                                <input name="password" type="password" class="w-full bg-transparent outline-none text-white placeholder:text-white/35" placeholder="••••••••" />
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="text-xs muted2 mb-1">Image</div>
                            <div class="input rounded-xl px-4 py-3 flex items-center gap-3">
                                <i class="fa-solid fa-image text-white/45"></i>
                                <input name="image" type="text" class="w-full bg-transparent outline-none text-white placeholder:text-white/35" placeholder="Image Url" />
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="text-xs muted2 mb-1">Rôle</div>
                            <div class="input rounded-xl px-4 py-3 flex items-center gap-3">
                                <i class="fa-solid fa-user-tag text-white/45"></i>
                                <select name="role" class="w-full bg-transparent outline-none text-white">
                                    <option value="acheteur">Acheteur</option>
                                    <option value="organisateur">Organisateur</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button id="create" class="mt-6 btn-red w-full px-5 py-3 rounded-xl text-sm font-bold">
                        <i class="fa-solid fa-circle-check mr-2"></i>Créer le compte
                    </button>
                </form>


                <div class="mt-4 text-sm muted2">
                    Après création : vous pouvez vous connecter via Login.
                </div>
            </section>

            <aside class="card-red rounded-2xl p-6">
                <div class="text-xs uppercase tracking-[0.28em] text-white/60">Règles</div>
                <h2 class="mt-2 text-3xl brand">Accès par rôle</h2>

                <div class="mt-6 space-y-3">
                    <div class="card rounded-2xl p-4">
                        <div class="font-bold"><i class="fa-solid fa-bag-shopping mr-2 text-white/70"></i>Acheteur</div>
                        <div class="text-sm muted2 mt-1">Acheter billets, historique, avis.</div>
                    </div>
                    <div class="card rounded-2xl p-4">
                        <div class="font-bold"><i class="fa-solid fa-clipboard-list mr-2 text-white/70"></i>Organisateur</div>
                        <div class="text-sm muted2 mt-1">Créer demandes de matchs, statistiques.</div>
                    </div>
                    <div class="card rounded-2xl p-4">
                        <div class="font-bold"><i class="fa-solid fa-shield-halved mr-2 text-white/70"></i>Admin</div>
                        <div class="text-sm muted2 mt-1">Validation demandes + gestion users.</div>
                    </div>
                </div>

                <a href="/auth/login.php" class="mt-6 inline-flex btn w-full px-5 py-3 rounded-xl text-sm font-semibold justify-center">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i>Aller au Login
                </a>
            </aside>
        </div>
    </main>

    <script>
        const $ = (s) => document.querySelector(s);

        const getUsers = () => JSON.parse(localStorage.getItem("st_users") || "[]");
        const setUsers = (arr) => localStorage.setItem("st_users", JSON.stringify(arr));

        // init admin user (only in "DB", no login UI)
        (function init() {
            const users = getUsers();
            const hasAdmin = users.some(u => u.role === "admin");
            if (!hasAdmin) {
                users.unshift({
                    id: 1,
                    name: "Admin",
                    email: "admin@stadiatick.local",
                    pass: "admin",
                    role: "admin",
                    active: true
                });
                setUsers(users);
            }
        })();

        $("#create").addEventListener("click", () => {
            const name = $("#name").value.trim();
            const email = $("#email").value.trim().toLowerCase();
            const pass = $("#pass").value.trim();
            const role = $("#role").value;

            if (!name || !email || !pass) return alert("Remplissez tous les champs.");

            const users = getUsers();
            if (users.some(u => u.email === email)) return alert("Email déjà utilisé.");

            users.unshift({
                id: Date.now(),
                name,
                email,
                pass,
                role,
                active: true
            });
            setUsers(users);

            alert("Compte créé. Connectez-vous via Login.");
            window.location.href = "login.html";
        });
    </script>
</body>

</html>