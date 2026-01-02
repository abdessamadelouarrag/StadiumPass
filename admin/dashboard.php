<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>StadiaTick — Admin</title>

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
    </style>
</head>

<body class="bg-app text-white min-h-screen">

    <nav class="sticky top-0 z-50 border-b border-white/10 bg-black/40 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <a href="index.html" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl card-red flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <div class="text-2xl brand">StadiaTick</div>
                    <div class="text-xs muted2 -mt-0.5">Admin</div>
                </div>
            </a>

            <div class="flex items-center gap-2">
                <a href="index.html" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i class="fa-solid fa-house mr-2"></i>Home</a>
                <a href="login.html" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i class="fa-solid fa-right-to-bracket mr-2"></i>Login</a>
                <button id="reset" class="btn px-4 py-2 rounded-xl text-sm font-semibold"><i class="fa-solid fa-rotate-left mr-2"></i>Reset</button>
            </div>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-4 py-12">
        <div class="max-w-3xl">
            <div class="text-xs uppercase tracking-[0.28em] text-white/60">Admin</div>
            <h1 class="mt-2 text-5xl brand">Supervision</h1>
            <p class="mt-4 muted">Gérer utilisateurs (activer/désactiver) + valider/refuser demandes d’organisateurs.</p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 pb-16">
        <div class="grid lg:grid-cols-3 gap-6">
            <section class="card-red rounded-2xl p-6">
                <div class="font-bold"><i class="fa-solid fa-chart-pie mr-2 text-white/70"></i>Stats</div>
                <div class="mt-5 space-y-3 text-sm">
                    <div class="flex justify-between"><span class="muted2">Users actifs</span><b id="sUsers">—</b></div>
                    <div class="flex justify-between"><span class="muted2">Demandes pending</span><b id="sPend">—</b></div>
                    <div class="flex justify-between"><span class="muted2">Billets (demo)</span><b id="sTickets">—</b></div>
                    <div class="flex justify-between"><span class="muted2">Revenus (demo)</span><b id="sRev">—</b></div>
                </div>
            </section>

            <section class="card rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10 flex items-center justify-between">
                    <div class="font-bold"><i class="fa-solid fa-users mr-2 text-white/60"></i>Utilisateurs</div>
                    <div class="text-sm muted2">Activer / Désactiver</div>
                </div>
                <div id="users" class="divide-y divide-white/10"></div>
            </section>

            <section class="card rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-white/10 flex items-center justify-between">
                    <div class="font-bold"><i class="fa-solid fa-list-check mr-2 text-white/60"></i>Demandes</div>
                    <div class="text-sm muted2">Accepter / Refuser</div>
                </div>
                <div id="reqs" class="divide-y divide-white/10"></div>
            </section>
        </div>
    </main>

    <!-- <script>
    const $ = (s)=>document.querySelector(s);
    const getUsers = ()=>JSON.parse(localStorage.getItem("st_users")||"[]");
    const setUsers = (a)=>localStorage.setItem("st_users", JSON.stringify(a));
    const getReq = ()=>JSON.parse(localStorage.getItem("st_requests")||"[]");
    const setReq = (a)=>localStorage.setItem("st_requests", JSON.stringify(a));

    // init fallback
    (function init(){
      const users = getUsers();
      const hasAdmin = users.some(u=>u.role==="admin");
      if(!hasAdmin){
        users.unshift({id:1, name:"Admin", email:"admin@stadiatick.local", pass:"admin", role:"admin", active:true});
        setUsers(users);
      }
      if(getReq().length===0){
        setReq([{id:101, home:"Hassania Agadir", away:"MAS Fès", when:"2026-01-12 20:00", stadium:"Stade d’Agadir", seats:2000, comp:"Ligue Pro", status:"Pending"}]);
      }
    })();

    function badge(s){
      if(s==="Accepted") return "bg-green-500/15 text-green-200 border border-green-500/25";
      if(s==="Rejected") return "bg-red-500/15 text-red-200 border border-red-500/25";
      return "bg-yellow-500/15 text-yellow-200 border border-yellow-500/25";
    }

    function renderUsers(){
      const users = getUsers();
      $("#users").innerHTML = users.map(u=>`
        <div class="p-5 flex items-center justify-between gap-4">
          <div>
            <div class="font-bold">${u.name}</div>
            <div class="text-sm text-white/60">${u.email} • ${u.role}</div>
          </div>
          <button class="toggle btn px-4 py-2 rounded-xl text-sm font-semibold" data-id="${u.id}">
            <i class="fa-solid ${u.active ? "fa-user-slash" : "fa-user-check"} mr-2"></i>${u.active ? "Désactiver" : "Activer"}
          </button>
        </div>
      `).join("");

      document.querySelectorAll(".toggle").forEach(b=>{
        b.addEventListener("click", ()=>{
          const id = Number(b.dataset.id);
          const users = getUsers();
          const u = users.find(x=>x.id===id);
          if(u.role==="admin") return alert("Admin ne peut pas être désactivé (demo).");
          u.active = !u.active;
          setUsers(users);
          renderAll();
        });
      });
    }

    function renderReq(){
      const req = getReq();
      $("#reqs").innerHTML = req.map(r=>`
        <div class="p-5 flex items-start justify-between gap-4">
          <div>
            <div class="font-bold">${r.home} <span class="text-white/45">vs</span> ${r.away}</div>
            <div class="mt-2 text-sm text-white/60">
              <i class="fa-solid fa-calendar-day mr-2"></i>${r.when}
              <span class="mx-2 text-white/20">•</span>
              <i class="fa-solid fa-location-dot mr-2"></i>${r.stadium}
            </div>
            <div class="mt-2 text-sm text-white/60"><i class="fa-solid fa-trophy mr-2"></i>${r.comp}</div>
          </div>

          <div class="flex flex-col items-end gap-2">
            <span class="px-3 py-1 rounded-full text-xs font-bold ${badge(r.status)}">${r.status}</span>
            <div class="flex gap-2">
              <button class="acc btn-red px-3 py-2 rounded-xl text-xs font-bold" data-id="${r.id}">
                <i class="fa-solid fa-check mr-2"></i>Accepter
              </button>
              <button class="rej btn px-3 py-2 rounded-xl text-xs font-bold" data-id="${r.id}">
                <i class="fa-solid fa-xmark mr-2"></i>Refuser
              </button>
            </div>
          </div>
        </div>
      `).join("");

      document.querySelectorAll(".acc").forEach(b=>b.addEventListener("click", ()=>setStatus(Number(b.dataset.id),"Accepted")));
      document.querySelectorAll(".rej").forEach(b=>b.addEventListener("click", ()=>setStatus(Number(b.dataset.id),"Rejected")));
    }

    function setStatus(id, status){
      const req = getReq();
      const r = req.find(x=>x.id===id);
      r.status = status;
      setReq(req);
      renderAll();
    }

    function renderStats(){
      const users = getUsers();
      const req = getReq();
      const pending = req.filter(r=>r.status==="Pending").length;

      // demo stats
      const tickets = 1290;
      const revenue = tickets * 240;

      $("#sUsers").textContent = users.filter(u=>u.active).length;
      $("#sPend").textContent = pending;
      $("#sTickets").textContent = tickets;
      $("#sRev").textContent = `${revenue.toLocaleString()} MAD`;
    }

    function renderAll(){
      renderStats();
      renderUsers();
      renderReq();
    }

    $("#reset").addEventListener("click", ()=>{
      localStorage.removeItem("st_users");
      localStorage.removeItem("st_requests");
      localStorage.removeItem("st_history");
      localStorage.removeItem("st_session");
      alert("Reset OK. Recharge la page.");
    });

    renderAll();
  </script> -->
</body>

</html>