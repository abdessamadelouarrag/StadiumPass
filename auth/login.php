<?php
session_start();

require_once "../classes/User.php";
require_once "../classes/Auth.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $checkaccount = new Auth();

    $user = $checkaccount->login($email, $password);

    if ($user == false) {
        echo "makayn ta user b had info !!!";
        exit();
    }

    else{

        $_SESSION['iduser'] = $user['id_user'];
        $_SESSION['nom'] = $user['nom'];

        if ($user["role"] == 'acheteur') {
            header("Location: ../pages/matchs.php");
            exit();
        }
        if ($user["role"] == 'organisateur') {
            header("Location: ../organiser/create_match.php");
            exit();
        }
    }
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>StadiumPass— Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
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
            --gold: #B08A3A;
        }

        .bg-app {
            background: radial-gradient(900px 500px at 15% 10%, rgba(161, 20, 51, .18), transparent 60%), radial-gradient(900px 500px at 90% 20%, rgba(176, 138, 58, .10), transparent 60%), var(--bg);
        }

        .card {
            background: rgba(15, 15, 22, .88);
            border: 1px solid var(--border)
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
                    <i class="fa-solid fa-right-to-bracket"></i>
                </div>
                <div>
                    <div class="text-2xl brand">StadiumPass</div>
                    <div class="text-xs muted2 -mt-0.5">Login</div>
                </div>
            </a>
            <div class="flex items-center gap-2">
                <a href="index.html" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i class="fa-solid fa-house mr-2"></i>Home</a>
                <a href="register.php" class="btn-red px-4 py-2 rounded-xl text-sm font-bold"><i class="fa-solid fa-user-plus mr-2"></i>Signup</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-14">
        <div class="max-w-xl mx-auto card rounded-2xl p-6">
            <h1 class="text-4xl brand">Connexion</h1>
            <p class="mt-3 muted">Login (démo). Redirection selon le rôle.</p>

            <form action="" method="POST">
                <div class="mt-6 space-y-4">
                    <div>
                        <div class="text-xs muted2 mb-1">Email</div>
                        <div class="input rounded-xl px-4 py-3 flex items-center gap-3">
                            <i class="fa-solid fa-envelope text-white/45"></i>
                            <input name="email" type="text" class="w-full bg-transparent outline-none text-white placeholder:text-white/35" placeholder="you@mail.com" />
                        </div>
                    </div>
                    <div>
                        <div class="text-xs muted2 mb-1">Mot de passe</div>
                        <div class="input rounded-xl px-4 py-3 flex items-center gap-3">
                            <i class="fa-solid fa-key text-white/45"></i>
                            <input name="password" type="password" class="w-full bg-transparent outline-none text-white placeholder:text-white/35" placeholder="••••••••" />
                        </div>
                    </div>


                    <div class="card-red rounded-2xl p-4 text-sm muted2">
                        <div class="mt-1">Email: <b class="text-white">admin@stadiatick.local</b></div>
                        <div>Pass: <b class="text-white">admin</b></div>
                    </div>
                </div>
                <button id="login" class="btn-red w-full px-5 py-3 rounded-xl text-sm font-bold mt-3">
                    <i class="fa-solid fa-circle-check mr-2"></i>Se connecter
                </button>
            </form>
        </div>
    </main>

    <script>
        const $ = (s) => document.querySelector(s);
        const getUsers = () => JSON.parse(localStorage.getItem("st_users") || "[]");
        const setSession = (u) => localStorage.setItem("st_session", JSON.stringify({
            id: u.id,
            name: u.name,
            email: u.email,
            role: u.role
        }));

        // safety init (in case user opens login first)
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
                localStorage.setItem("st_users", JSON.stringify(users));
            }
        })();

        $("#login").addEventListener("click", () => {
            const email = ($("#email").value || "").trim().toLowerCase();
            const pass = ($("#pass").value || "").trim();
            if (!email || !pass) return alert("Remplissez email et mot de passe.");

            const user = getUsers().find(u => u.email === email && u.pass === pass);
            if (!user) return alert("Identifiants incorrects.");
            if (user.active === false) return alert("Compte désactivé par l’admin.");

            setSession(user);

            if (user.role === "buyer") window.location.href = "buyer.html";
            else if (user.role === "organizer") window.location.href = "organizer.html";
            else window.location.href = "admin.html";
        });
    </script>
</body>

</html>