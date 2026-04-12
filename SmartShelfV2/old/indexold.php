<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>SmartShelf — Tu Biblioteca Digital Inteligente</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,700;1,9..144,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<style>
:root{
  --bg:#070d09;--bg2:#0c1610;--bg3:#101d13;
  --accent:#3ddc84;--accent2:#2ab36a;--acglow:rgba(61,220,132,.13);
  --gold:#f0b429;
  --t1:#e2f0e8;--t2:#8aaa96;--t3:#4a6655;
  --b1:rgba(61,220,132,.11);--b2:rgba(61,220,132,.24);
  --r:14px;--nav:68px;
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--t1);overflow-x:hidden;line-height:1.65}

/* ─── NAV ─── */
nav{
  position:fixed;top:0;left:0;right:0;height:var(--nav);
  display:flex;align-items:center;justify-content:space-between;
  padding:0 6%;
  background:rgba(7,13,9,.88);backdrop-filter:blur(18px);
  border-bottom:1px solid var(--b1);z-index:200;
}
.nav-logo{display:flex;align-items:center;gap:10px;text-decoration:none}
.logo-mark{
  width:34px;height:34px;border-radius:9px;
  background:var(--accent);display:flex;align-items:center;justify-content:center;
  font-family:'Fraunces',serif;font-weight:700;font-size:1.1rem;color:#070d09;
}
.logo-text{font-family:'Fraunces',serif;font-size:1.25rem;font-weight:600;color:var(--t1)}
.logo-text span{color:var(--accent)}
.nav-links{display:flex;gap:28px;list-style:none}
.nav-links a{color:var(--t2);text-decoration:none;font-size:.875rem;font-weight:500;transition:color .2s}
.nav-links a:hover{color:var(--accent)}
.nav-right{display:flex;align-items:center;gap:12px}

/* lang switcher */
.lang-sw{display:flex;gap:3px;background:var(--bg3);border:1px solid var(--b1);border-radius:8px;padding:3px}
.lb{background:none;border:none;color:var(--t3);font-size:.72rem;font-weight:600;padding:4px 8px;border-radius:6px;cursor:pointer;transition:all .2s;font-family:'DM Sans',sans-serif;letter-spacing:.06em}
.lb.on{background:var(--accent);color:#070d09}
.lb:hover:not(.on){color:var(--t1)}

/* buttons */
.btn{display:inline-flex;align-items:center;gap:7px;padding:9px 20px;border-radius:10px;font-weight:600;font-size:.875rem;cursor:pointer;text-decoration:none;transition:all .22s;border:none;font-family:'DM Sans',sans-serif}
.btn-ghost{background:transparent;color:var(--t1);border:1px solid var(--b2)}
.btn-ghost:hover{border-color:var(--accent);color:var(--accent)}
.btn-primary{background:var(--accent);color:#070d09}
.btn-primary:hover{background:#52e898;transform:translateY(-2px);box-shadow:0 8px 22px rgba(61,220,132,.28)}
.btn-lg{padding:14px 30px;font-size:.95rem;border-radius:12px}
.btn-outline-lg{padding:13px 30px;font-size:.95rem;border-radius:12px;background:transparent;color:var(--t1);border:1px solid var(--b2)}
.btn-outline-lg:hover{border-color:var(--accent);color:var(--accent)}

/* ham */
.ham{display:none;flex-direction:column;gap:5px;background:none;border:none;cursor:pointer;padding:6px}
.ham span{display:block;width:22px;height:2px;background:var(--t1);border-radius:2px;transition:all .3s}
.mob-nav{display:none;position:fixed;top:var(--nav);left:0;right:0;background:rgba(7,13,9,.97);padding:20px 6%;border-bottom:1px solid var(--b1);z-index:199;flex-direction:column;gap:16px}
.mob-nav a{color:var(--t2);text-decoration:none;font-size:1rem;padding:8px 0;border-bottom:1px solid var(--b1)}
.mob-nav a:hover{color:var(--accent)}
.mob-nav.open{display:flex}
.mob-lang{display:flex;gap:6px;padding-top:8px}

/* ─── HERO ─── */
#hero{
  min-height:100vh;padding:calc(var(--nav) + 90px) 6% 90px;
  display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;
  position:relative;overflow:hidden;
}
.hero-orb{
  position:absolute;width:700px;height:700px;border-radius:50%;
  background:radial-gradient(circle,rgba(61,220,132,.07) 0%,transparent 65%);
  top:50%;left:35%;transform:translate(-50%,-50%);pointer-events:none;
}
.hero-grid-bg{
  position:absolute;inset:0;pointer-events:none;
  background-image:linear-gradient(var(--b1) 1px,transparent 1px),linear-gradient(90deg,var(--b1) 1px,transparent 1px);
  background-size:60px 60px;mask-image:radial-gradient(ellipse 70% 70% at 50% 50%,#000 0%,transparent 100%);
}
.hero-badge{
  display:inline-flex;align-items:center;gap:8px;
  background:var(--acglow);border:1px solid var(--b2);border-radius:100px;
  padding:5px 14px;font-size:.75rem;color:var(--accent);font-weight:500;margin-bottom:22px;
}
.hero-badge::before{content:'';width:6px;height:6px;border-radius:50%;background:var(--accent);animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(1.4)}}
.hero-title{
  font-family:'Fraunces',serif;font-size:clamp(2.3rem,3.8vw,3.8rem);
  font-weight:700;line-height:1.08;margin-bottom:22px;letter-spacing:-.025em;
}
.hero-title .ac{color:var(--accent)}
.hero-title em{font-style:italic;font-weight:300}
.hero-sub{font-size:1.05rem;color:var(--t2);margin-bottom:36px;max-width:480px;line-height:1.72}
.hero-ctas{display:flex;gap:14px;flex-wrap:wrap;margin-bottom:44px}
.hero-stats{display:flex;gap:30px;flex-wrap:wrap}
.stat-num{font-family:'Fraunces',serif;font-size:1.7rem;font-weight:700;color:var(--accent)}
.stat-lbl{font-size:.78rem;color:var(--t2)}

/* app mockup */
.mockup-wrap{position:relative}
.mockup-glow{
  position:absolute;inset:-20px;border-radius:24px;
  background:radial-gradient(ellipse at 50% 50%,rgba(61,220,132,.1) 0%,transparent 70%);
  pointer-events:none;
}
.browser{
  background:#0a1510;border:1px solid var(--b2);border-radius:16px;
  overflow:hidden;
  box-shadow:0 30px 80px rgba(0,0,0,.55),0 0 0 1px var(--b1);
  transform:perspective(1200px) rotateY(-6deg) rotateX(3deg);
  transition:transform .5s ease;
}
.browser:hover{transform:perspective(1200px) rotateY(-2deg) rotateX(1deg)}
.b-bar{
  background:#0d1a10;padding:11px 14px;display:flex;align-items:center;
  gap:10px;border-bottom:1px solid var(--b1);
}
.b-dots{display:flex;gap:5px}
.b-dot{width:10px;height:10px;border-radius:50%}
.b-dot:nth-child(1){background:#ff5f57}
.b-dot:nth-child(2){background:#ffbd2e}
.b-dot:nth-child(3){background:#28ca41}
.b-url{flex:1;background:#060c08;border:1px solid var(--b1);border-radius:6px;padding:5px 10px;font-size:.72rem;color:var(--t3);font-family:monospace}
.b-body{display:flex;height:320px}

/* app sidebar */
.a-side{width:140px;flex-shrink:0;background:#080f0a;border-right:1px solid var(--b1);padding:14px 10px}
.a-logo-sm{font-family:'Fraunces',serif;font-size:.85rem;font-weight:700;color:var(--accent);margin-bottom:16px;padding:0 4px}
.a-cat-lbl{font-size:.6rem;text-transform:uppercase;letter-spacing:.1em;color:var(--t3);padding:0 4px;margin-bottom:6px}
.a-cat{padding:7px 8px;border-radius:7px;font-size:.7rem;color:var(--t2);margin-bottom:3px;display:flex;align-items:center;gap:6px;cursor:pointer}
.a-cat.on{background:var(--acglow);color:var(--accent);border:1px solid var(--b1)}
.a-dot{width:5px;height:5px;border-radius:50%;background:currentColor;flex-shrink:0}
.a-divider{height:1px;background:var(--b1);margin:10px 0}

/* app main */
.a-main{flex:1;padding:14px;display:flex;flex-direction:column;gap:9px;overflow:hidden}
.a-search{
  background:#060c08;border:1px solid var(--b1);border-radius:8px;
  padding:7px 10px;font-size:.7rem;color:var(--t3);display:flex;align-items:center;gap:7px;
}
.a-search-icon{font-size:11px}
.a-card{
  background:#060c08;border:1px solid var(--b1);border-radius:9px;
  padding:9px 11px;display:flex;flex-direction:column;gap:4px;flex-shrink:0;
}
.a-tag{font-size:.58rem;background:var(--acglow);color:var(--accent);border-radius:4px;padding:2px 6px;display:inline-block;width:fit-content}
.a-ttl{font-size:.68rem;color:var(--t1);font-weight:500}
.a-url{font-size:.6rem;color:var(--t3)}
.a-row{display:flex;align-items:center;justify-content:space-between}
.a-tag-yt{background:rgba(255,80,80,.12);color:#ff8080}
.a-tag-li{background:rgba(80,140,255,.12);color:#80b4ff}
.a-tag-gd{background:rgba(80,200,255,.12);color:#80d8ff}

/* ─── SECTIONS ─── */
section{padding:90px 6%}
.s-tag{display:inline-block;font-size:.72rem;text-transform:uppercase;letter-spacing:.15em;color:var(--accent);font-weight:600;margin-bottom:14px}
.s-title{font-family:'Fraunces',serif;font-size:clamp(1.8rem,3vw,2.9rem);font-weight:700;line-height:1.15;margin-bottom:14px;letter-spacing:-.022em}
.s-sub{font-size:.97rem;color:var(--t2);max-width:540px;line-height:1.72;margin-bottom:52px}
.tc{text-align:center}.tc .s-sub{margin:0 auto 52px}

/* ─── PROBLEM ─── */
#problem{background:linear-gradient(180deg,var(--bg) 0%,var(--bg2) 100%)}
.prob-grid{display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:center}
.pain-list{list-style:none;display:flex;flex-direction:column;gap:13px}
.pain-item{
  display:flex;align-items:flex-start;gap:14px;
  padding:14px 18px;background:var(--bg3);border:1px solid var(--b1);
  border-radius:12px;font-size:.9rem;color:var(--t2);
}
.pain-ico{font-size:1.2rem;flex-shrink:0;margin-top:1px}
.sol-card{
  background:var(--bg3);border:1px solid var(--b2);border-radius:var(--r);
  padding:36px;position:relative;overflow:hidden;
}
.sol-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:2px;
  background:linear-gradient(90deg,transparent,var(--accent),transparent);
}
.sol-title{font-family:'Fraunces',serif;font-size:1.4rem;font-weight:700;margin-bottom:14px}
.sol-desc{font-size:.9rem;color:var(--t2);line-height:1.72;margin-bottom:20px}
.sol-feature{display:flex;align-items:center;gap:10px;padding:8px 0;font-size:.88rem;color:var(--t2);border-bottom:1px solid var(--b1)}
.sol-feature:last-child{border-bottom:none}
.sol-check{color:var(--accent);font-size:1rem;flex-shrink:0}

/* ─── FEATURES ─── */
.feat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.feat-card{
  background:var(--bg2);border:1px solid var(--b1);border-radius:var(--r);
  padding:28px;transition:all .3s;position:relative;overflow:hidden;cursor:default;
}
.feat-card:hover{border-color:var(--b2);transform:translateY(-4px);background:var(--bg3)}
.feat-ico{
  width:46px;height:46px;background:var(--acglow);border:1px solid var(--b2);
  border-radius:11px;display:flex;align-items:center;justify-content:center;
  font-size:1.3rem;margin-bottom:18px;
}
.feat-title{font-size:1rem;font-weight:600;margin-bottom:9px}
.feat-desc{font-size:.85rem;color:var(--t2);line-height:1.65}

/* ─── HOW ─── */
#how{background:var(--bg2)}
.steps{display:grid;grid-template-columns:repeat(3,1fr);gap:0;position:relative}
.steps::before{
  content:'';position:absolute;top:38px;left:16.6%;right:16.6%;height:1px;
  background:linear-gradient(90deg,transparent,var(--b2),var(--b2),transparent);
}
.step{padding:0 28px;text-align:center}
.step-num{
  width:52px;height:52px;border-radius:50%;background:var(--accent);color:#070d09;
  font-family:'Fraunces',serif;font-size:1.25rem;font-weight:700;
  display:flex;align-items:center;justify-content:center;margin:0 auto 20px;position:relative;z-index:1;
}
.step-title{font-size:1rem;font-weight:600;margin-bottom:10px}
.step-desc{font-size:.85rem;color:var(--t2);line-height:1.65}

/* ─── PRICING ─── */
.price-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;max-width:880px;margin:0 auto}
.p-card{
  background:var(--bg2);border:1px solid var(--b1);border-radius:var(--r);
  padding:32px;position:relative;transition:all .3s;
}
.p-card.feat{
  border-color:var(--accent);
  background:linear-gradient(135deg,#0c1d11,#0f2416);
}
.p-card.feat::before{
  content:'';position:absolute;top:0;left:0;right:0;height:2px;
  background:var(--accent);border-radius:2px 2px 0 0;
}
.p-badge{
  position:absolute;top:-11px;left:50%;transform:translateX(-50%);
  background:var(--accent);color:#070d09;font-size:.67rem;font-weight:700;
  padding:3px 11px;border-radius:100px;text-transform:uppercase;letter-spacing:.08em;white-space:nowrap;
}
.p-plan{font-size:.75rem;text-transform:uppercase;letter-spacing:.12em;color:var(--accent);font-weight:600;margin-bottom:14px}
.p-amount{font-family:'Fraunces',serif;font-size:2.6rem;font-weight:700;line-height:1;margin-bottom:3px}
.p-currency{font-size:1.1rem;vertical-align:super;font-family:'DM Sans',sans-serif;font-weight:600}
.p-period{font-size:.78rem;color:var(--t2);margin-bottom:6px}
.p-usd{font-size:.75rem;color:var(--t3);margin-bottom:22px}
.p-feats{list-style:none;margin-bottom:28px}
.p-feat{
  padding:7px 0;font-size:.85rem;color:var(--t2);
  display:flex;align-items:center;gap:9px;border-bottom:1px solid var(--b1);
}
.p-feat:last-child{border-bottom:none}
.p-chk{color:var(--accent);font-size:.9rem;flex-shrink:0}

/* ─── TESTIMONIALS ─── */
#testi{background:var(--bg2)}
.testi-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:22px}
.t-card{
  background:var(--bg3);border:1px solid var(--b1);border-radius:var(--r);
  padding:28px;position:relative;transition:border-color .3s;
}
.t-card:hover{border-color:var(--b2)}
.t-q{
  font-family:'Fraunces',serif;font-size:3.5rem;color:var(--accent);opacity:.25;
  position:absolute;top:12px;right:20px;line-height:1;
}
.t-stars{color:var(--gold);font-size:.82rem;margin-bottom:14px;letter-spacing:2px}
.t-text{font-size:.9rem;color:var(--t2);line-height:1.72;margin-bottom:22px;font-style:italic}
.t-author{display:flex;align-items:center;gap:11px}
.t-avatar{
  width:38px;height:38px;border-radius:50%;background:var(--acglow);
  border:1px solid var(--b2);display:flex;align-items:center;justify-content:center;
  font-size:.95rem;color:var(--accent);font-weight:700;font-family:'Fraunces',serif;flex-shrink:0;
}
.t-name{font-weight:600;font-size:.88rem}
.t-handle{font-size:.73rem;color:var(--t2)}

/* ─── CTA BANNER ─── */
#cta{
  text-align:center;
  background:linear-gradient(135deg,var(--bg),#0a1f10);
  border-top:1px solid var(--b1);border-bottom:1px solid var(--b1);
  position:relative;overflow:hidden;
}
#cta::before{
  content:'';position:absolute;width:700px;height:400px;border-radius:50%;
  background:radial-gradient(circle,rgba(61,220,132,.07) 0%,transparent 70%);
  top:50%;left:50%;transform:translate(-50%,-50%);pointer-events:none;
}
.cta-title{font-family:'Fraunces',serif;font-size:clamp(1.9rem,3.5vw,3rem);font-weight:700;margin-bottom:14px;letter-spacing:-.02em}
.cta-sub{font-size:.97rem;color:var(--t2);margin-bottom:36px}
.cta-btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap}
.trial-badge{
  display:inline-flex;align-items:center;gap:7px;
  background:var(--acglow);border:1px solid var(--b2);border-radius:100px;
  padding:5px 14px;font-size:.75rem;color:var(--accent);font-weight:500;margin-bottom:18px;
}

/* ─── FOOTER ─── */
footer{background:var(--bg2);border-top:1px solid var(--b1);padding:56px 6% 28px}
.f-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:44px;margin-bottom:44px}
.f-brand{font-family:'Fraunces',serif;font-size:1.2rem;color:var(--accent);margin-bottom:10px}
.f-tag{font-size:.82rem;color:var(--t2);margin-bottom:18px;max-width:240px;line-height:1.6}
.socials{display:flex;gap:9px;flex-wrap:wrap}
.soc{
  width:34px;height:34px;border-radius:8px;background:var(--bg3);border:1px solid var(--b1);
  display:flex;align-items:center;justify-content:center;font-size:.85rem;
  text-decoration:none;color:var(--t2);transition:all .2s;
}
.soc:hover{border-color:var(--accent);color:var(--accent)}
.f-col-title{font-weight:600;font-size:.83rem;margin-bottom:14px;color:var(--t1)}
.f-links{list-style:none;display:flex;flex-direction:column;gap:9px}
.f-links a{font-size:.8rem;color:var(--t2);text-decoration:none;transition:color .2s}
.f-links a:hover{color:var(--accent)}
.f-bottom{
  border-top:1px solid var(--b1);padding-top:22px;
  display:flex;justify-content:space-between;align-items:center;flex-wrap:gap;gap:12px;
}
.f-copy{font-size:.77rem;color:var(--t3)}
.f-lang-mini{display:flex;gap:6px}

/* ─── ANIMATIONS ─── */
@keyframes fadeUp{from{opacity:0;transform:translateY(28px)}to{opacity:1;transform:translateY(0)}}
.fu{opacity:0;animation:fadeUp .7s ease forwards}
.fu1{animation-delay:.08s}.fu2{animation-delay:.2s}.fu3{animation-delay:.33s}.fu4{animation-delay:.46s}

/* ─── RESPONSIVE ─── */
@media(max-width:960px){
  .nav-links{display:none}
  .ham{display:flex}
  #hero{grid-template-columns:1fr;padding-top:calc(var(--nav) + 50px)}
  .mockup-wrap{display:none}
  .prob-grid{grid-template-columns:1fr}
  .feat-grid{grid-template-columns:1fr 1fr}
  .steps{grid-template-columns:1fr;gap:36px}
  .steps::before{display:none}
  .price-grid{grid-template-columns:1fr}
  .testi-grid{grid-template-columns:1fr}
  .f-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:580px){
  section{padding:64px 5%}
  .feat-grid{grid-template-columns:1fr}
  .f-grid{grid-template-columns:1fr}
  .nav-right .btn{display:none}
  .hero-stats{gap:18px}
}
</style>
</head>
<body>

<!-- NAV -->
<nav>
  <a href="#" class="nav-logo">
    <div class="logo-mark">S</div>
    <span class="logo-text">Smart<span>Shelf</span></span>
  </a>
  <ul class="nav-links">
    <li><a href="#features" data-i18n="nav_features">Características</a></li>
    <li><a href="#how" data-i18n="nav_how">Cómo Funciona</a></li>
    <li><a href="#pricing" data-i18n="nav_pricing">Precios</a></li>
    <li><a href="#testi" data-i18n="nav_reviews">Testimonios</a></li>
  </ul>
  <div class="nav-right">
    <div class="lang-sw">
      <button class="lb on" onclick="setLang('es')">ES</button>
      <button class="lb" onclick="setLang('en')">EN</button>
      <button class="lb" onclick="setLang('pt')">PT</button>
    </div>
    <a href="https://solicionespro.com/SmartShelf/videotrackerauth.php" class="btn btn-ghost" data-i18n="nav_login">Ingresar</a>
    <a href="https://solicionespro.com/SmartShelf/requestaccessfinal.php" class="btn btn-primary" data-i18n="nav_cta">Prueba Gratis</a>
  </div>
  <button class="ham" onclick="toggleMenu()" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- MOBILE NAV -->
<div class="mob-nav" id="mobNav">
  <a href="#features" onclick="toggleMenu()" data-i18n="nav_features">Características</a>
  <a href="#how" onclick="toggleMenu()" data-i18n="nav_how">Cómo Funciona</a>
  <a href="#pricing" onclick="toggleMenu()" data-i18n="nav_pricing">Precios</a>
  <a href="#testi" onclick="toggleMenu()" data-i18n="nav_reviews">Testimonios</a>
  <a href="https://solicionespro.com/SmartShelf/videotrackerauth.php" data-i18n="nav_login">Ingresar</a>
  <a href="https://solicionespro.com/SmartShelf/requestaccessfinal.php" class="btn btn-primary" style="text-align:center;" data-i18n="nav_cta_free">Comenzar Gratis — 30 días</a>
  <div class="mob-lang">
    <button class="lb on" onclick="setLang('es');toggleMenu()">ES</button>
    <button class="lb" onclick="setLang('en');toggleMenu()">EN</button>
    <button class="lb" onclick="setLang('pt');toggleMenu()">PT</button>
  </div>
</div>

<!-- HERO -->
<section id="hero">
  <div class="hero-grid-bg"></div>
  <div class="hero-orb"></div>
  <div class="hero-content">
    <div class="hero-badge fu fu1" data-i18n="hero_badge">✦ Tu biblioteca digital personal</div>
    <h1 class="hero-title fu fu2">
      <span data-i18n="hero_title_1">Guarda, Organiza</span><br>
      <em data-i18n="hero_title_2">y Encuentra</em> <span class="ac" data-i18n="hero_title_3">cualquier<br>enlace</span> <span data-i18n="hero_title_4">al instante</span>
    </h1>
    <p class="hero-sub fu fu3" data-i18n="hero_sub">¿Cuántos links perdidos tienes hoy? SmartShelf centraliza todos tus contenidos favoritos de internet en un solo lugar, con búsqueda instantánea y acceso desde cualquier dispositivo.</p>
    <div class="hero-ctas fu fu4">
      <a href="https://solicionespro.com/SmartShelf/requestaccessfinal.php" class="btn btn-primary btn-lg" data-i18n="hero_cta1">Comenzar Gratis — 30 días ›</a>
      <a href="https://solicionespro.com/SmartShelf/videotrackerauth.php" class="btn-outline-lg btn" data-i18n="hero_cta2">Ver Demo</a>
    </div>
    <div class="hero-stats fu fu4">
      <div class="stat">
        <span class="stat-num">30</span>
        <span class="stat-lbl" data-i18n="stat1">días gratis</span>
      </div>
      <div class="stat">
        <span class="stat-num">∞</span>
        <span class="stat-lbl" data-i18n="stat2">links guardados</span>
      </div>
      <div class="stat">
        <span class="stat-num">3s</span>
        <span class="stat-lbl" data-i18n="stat3">para encontrar algo</span>
      </div>
    </div>
  </div>

  <!-- APP MOCKUP -->
  <div class="mockup-wrap fu fu3">
    <div class="mockup-glow"></div>
    <div class="browser">
      <div class="b-bar">
        <div class="b-dots"><div class="b-dot"></div><div class="b-dot"></div><div class="b-dot"></div></div>
        <div class="b-url">smartshelf.app/biblioteca</div>
      </div>
      <div class="b-body">
        <div class="a-side">
          <div class="a-logo-sm">SmartShelf</div>
          <div class="a-cat-lbl" data-i18n="mock_cats">Categorías</div>
          <div class="a-cat on"><span class="a-dot"></span><span data-i18n="mock_all">Todo</span></div>
          <div class="a-cat"><span class="a-dot"></span>YouTube</div>
          <div class="a-cat"><span class="a-dot"></span>LinkedIn</div>
          <div class="a-cat"><span class="a-dot"></span>Google Drive</div>
          <div class="a-divider"></div>
          <div class="a-cat"><span class="a-dot"></span><span data-i18n="mock_tech">Tecnología</span></div>
          <div class="a-cat"><span class="a-dot"></span><span data-i18n="mock_design">Diseño</span></div>
          <div class="a-cat"><span class="a-dot"></span><span data-i18n="mock_courses">Cursos</span></div>
        </div>
        <div class="a-main">
          <div class="a-search">
            <span class="a-search-icon">⌕</span>
            <span data-i18n="mock_search">Buscar en mis links...</span>
          </div>
          <div class="a-card">
            <div class="a-row">
              <span class="a-tag a-tag-yt">YouTube</span>
            </div>
            <div class="a-ttl" data-i18n="mock_link1">Tutorial completo de React 2024 — Traversy Media</div>
            <div class="a-url">youtube.com/watch?v=w7ejDZ8...</div>
          </div>
          <div class="a-card">
            <div class="a-row">
              <span class="a-tag a-tag-li">LinkedIn</span>
            </div>
            <div class="a-ttl" data-i18n="mock_link2">10 habilidades más demandadas en 2025</div>
            <div class="a-url">linkedin.com/pulse/habilidades...</div>
          </div>
          <div class="a-card">
            <div class="a-row">
              <span class="a-tag a-tag-gd">Drive</span>
            </div>
            <div class="a-ttl" data-i18n="mock_link3">Plantilla de plan de proyecto</div>
            <div class="a-url">docs.google.com/spreadsheets/d/...</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PROBLEM -->
<section id="problem">
  <div class="prob-grid">
    <div>
      <div class="s-tag" data-i18n="prob_tag">El problema</div>
      <h2 class="s-title" data-i18n="prob_title">¿Cuántos links tienes perdidos ahora mismo?</h2>
      <p class="s-sub" data-i18n="prob_sub">La información valiosa está en todas partes: favoritos del navegador, chats de WhatsApp, correos, notas... y cuando la necesitas, no la encuentras.</p>
      <ul class="pain-list">
        <li class="pain-item"><span class="pain-ico">📌</span><span data-i18n="pain1">Links guardados en favoritos que nunca vuelves a encontrar</span></li>
        <li class="pain-item"><span class="pain-ico">💬</span><span data-i18n="pain2">Videos enviados por WhatsApp que se pierden entre miles de mensajes</span></li>
        <li class="pain-item"><span class="pain-ico">🕵️</span><span data-i18n="pain3">Horas buscando un artículo que leíste hace meses</span></li>
        <li class="pain-item"><span class="pain-ico">📂</span><span data-i18n="pain4">Carpetas de Drive, notas, emails y pestañas abiertas sin orden</span></li>
      </ul>
    </div>
    <div class="sol-card">
      <h3 class="sol-title" data-i18n="sol_title">SmartShelf lo resuelve todo</h3>
      <p class="sol-desc" data-i18n="sol_desc">Un solo lugar para guardar cualquier enlace de internet. Categorizado, buscable y accesible desde cualquier dispositivo.</p>
      <div class="sol-feature"><span class="sol-check">✓</span><span data-i18n="sol_f1">Guarda links de YouTube, LinkedIn, Drive, o cualquier URL pública</span></div>
      <div class="sol-feature"><span class="sol-check">✓</span><span data-i18n="sol_f2">Categorías y subcategorías personalizadas por ti</span></div>
      <div class="sol-feature"><span class="sol-check">✓</span><span data-i18n="sol_f3">Buscador inteligente con palabras clave incompletas</span></div>
      <div class="sol-feature"><span class="sol-check">✓</span><span data-i18n="sol_f4">Links privados y públicos, todo en un mismo lugar</span></div>
      <div class="sol-feature"><span class="sol-check">✓</span><span data-i18n="sol_f5">Acceso rápido desde cualquier dispositivo</span></div>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section id="features">
  <div class="tc">
    <div class="s-tag" data-i18n="feat_tag">Características</div>
    <h2 class="s-title" data-i18n="feat_title">Todo lo que necesitas para organizar tu conocimiento</h2>
    <p class="s-sub" data-i18n="feat_sub">SmartShelf fue diseñado para que guardar y encontrar contenido sea simple, rápido y sin fricción.</p>
  </div>
  <div class="feat-grid">
    <div class="feat-card">
      <div class="feat-ico">🗂️</div>
      <div class="feat-title" data-i18n="f1_title">Organización Inteligente</div>
      <div class="feat-desc" data-i18n="f1_desc">Crea categorías y subcategorías completamente personalizadas para clasificar tus contenidos exactamente como tú lo necesitas.</div>
    </div>
    <div class="feat-card">
      <div class="feat-ico">⚡</div>
      <div class="feat-title" data-i18n="f2_title">Búsqueda Instantánea</div>
      <div class="feat-desc" data-i18n="f2_desc">Encuentra cualquier link con solo escribir palabras clave. Funciona incluso si no recuerdas el título exacto o la plataforma.</div>
    </div>
    <div class="feat-card">
      <div class="feat-ico">🌐</div>
      <div class="feat-title" data-i18n="f3_title">Multiplataforma</div>
      <div class="feat-desc" data-i18n="f3_desc">Compatible con YouTube, LinkedIn, Google Drive, sitios web, blogs, repositorios y cualquier URL pública o privada.</div>
    </div>
    <div class="feat-card">
      <div class="feat-ico">🔒</div>
      <div class="feat-title" data-i18n="f4_title">Links Privados</div>
      <div class="feat-desc" data-i18n="f4_desc">Guarda también contenido privado o interno de forma segura. Tu biblioteca es tuya y solo tú decides qué guardar.</div>
    </div>
    <div class="feat-card">
      <div class="feat-ico">📱</div>
      <div class="feat-title" data-i18n="f5_title">Acceso Desde Cualquier Lugar</div>
      <div class="feat-desc" data-i18n="f5_desc">Accede a tus links desde el computador, tablet o celular. Tu biblioteca siempre disponible donde estés.</div>
    </div>
    <div class="feat-card">
      <div class="feat-ico">🚀</div>
      <div class="feat-title" data-i18n="f6_title">Acceso Directo al Contenido</div>
      <div class="feat-desc" data-i18n="f6_desc">Un clic y llegas directo al contenido. Sin pasos intermedios, sin perder tiempo navegando entre carpetas.</div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section id="how">
  <div class="tc">
    <div class="s-tag" data-i18n="how_tag">Cómo Funciona</div>
    <h2 class="s-title" data-i18n="how_title">En 3 pasos simples</h2>
    <p class="s-sub" data-i18n="how_sub">Empezar a organizar tu vida digital es más fácil de lo que crees.</p>
  </div>
  <div class="steps">
    <div class="step">
      <div class="step-num">1</div>
      <div class="step-title" data-i18n="step1_title">Regístrate Gratis</div>
      <div class="step-desc" data-i18n="step1_desc">Crea tu cuenta en segundos y comienza tu período de prueba gratuito de 30 días. Sin tarjeta de crédito, sin compromisos.</div>
    </div>
    <div class="step">
      <div class="step-num">2</div>
      <div class="step-title" data-i18n="step2_title">Crea tus Categorías</div>
      <div class="step-desc" data-i18n="step2_desc">Define las categorías que mejor se adapten a tu vida: trabajo, estudio, entretenimiento, recetas... lo que necesites.</div>
    </div>
    <div class="step">
      <div class="step-num">3</div>
      <div class="step-title" data-i18n="step3_title">Guarda y Encuentra</div>
      <div class="step-desc" data-i18n="step3_desc">Pega tus links, asígnalos a una categoría y úsalos cuando los necesites con el buscador inteligente.</div>
    </div>
  </div>
</section>

<!-- PRICING -->
<section id="pricing">
  <div class="tc">
    <div class="s-tag" data-i18n="price_tag">Precios</div>
    <h2 class="s-title" data-i18n="price_title">Simple, transparente, accesible</h2>
    <p class="s-sub" data-i18n="price_sub">Comienza gratis por 30 días. Luego elige el plan que más te convenga.</p>
  </div>
  <div class="price-grid">
    <div class="p-card">
      <div class="p-plan" data-i18n="plan1_name">Trimestral</div>
      <div class="p-amount"><span class="p-currency">$</span>20.000</div>
      <div class="p-period" data-i18n="plan1_per">COP · cada 3 meses</div>
      <div class="p-usd" data-i18n="plan1_usd">≈ USD $5 / trimestre</div>
      <ul class="p-feats">
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat1">Links ilimitados</span></li>
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat2">Categorías personalizadas</span></li>
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat3">Buscador inteligente</span></li>
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat4">Acceso desde cualquier dispositivo</span></li>
      </ul>
      <a href="https://solicionespro.com/SmartShelf/requestaccessfinal.php" class="btn btn-ghost" style="width:100%;justify-content:center;" data-i18n="plan_btn">Comenzar ›</a>
    </div>
    <div class="p-card feat">
      <div class="p-badge" data-i18n="plan2_badge">Más popular</div>
      <div class="p-plan" data-i18n="plan2_name">Semestral</div>
      <div class="p-amount"><span class="p-currency">$</span>40.000</div>
      <div class="p-period" data-i18n="plan2_per">COP · cada 6 meses</div>
      <div class="p-usd" data-i18n="plan2_usd">≈ USD $10 / semestre · Ahorra 17%</div>
      <ul class="p-feats">
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat1">Links ilimitados</span></li>
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat2">Categorías personalizadas</span></li>
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat3">Buscador inteligente</span></li>
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat4">Acceso desde cualquier dispositivo</span></li>
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat5">Tutoriales y soporte prioritario</span></li>
      </ul>
      <a href="https://solicionespro.com/SmartShelf/requestaccessfinal.php" class="btn btn-primary" style="width:100%;justify-content:center;" data-i18n="plan_btn">Comenzar ›</a>
    </div>
    <div class="p-card">
      <div class="p-plan" data-i18n="plan3_name">Anual</div>
      <div class="p-amount"><span class="p-currency">$</span>60.000</div>
      <div class="p-period" data-i18n="plan3_per">COP · por año completo</div>
      <div class="p-usd" data-i18n="plan3_usd">≈ USD $15 / año · El mejor valor</div>
      <ul class="p-feats">
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat1">Links ilimitados</span></li>
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat2">Categorías personalizadas</span></li>
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat3">Buscador inteligente</span></li>
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat4">Acceso desde cualquier dispositivo</span></li>
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat5">Tutoriales y soporte prioritario</span></li>
        <li class="p-feat"><span class="p-chk">✓</span><span data-i18n="pfeat6">Acceso anticipado a nuevas funciones</span></li>
      </ul>
      <a href="https://solicionespro.com/SmartShelf/requestaccessfinal.php" class="btn btn-ghost" style="width:100%;justify-content:center;" data-i18n="plan_btn">Comenzar ›</a>
    </div>
  </div>
  <p style="text-align:center;margin-top:28px;font-size:.83rem;color:var(--t3);" data-i18n="price_note">Todos los planes incluyen 30 días de prueba gratuita. Sin tarjeta de crédito.</p>
</section>

<!-- TESTIMONIALS -->
<section id="testi">
  <div class="tc">
    <div class="s-tag" data-i18n="testi_tag">Testimonios</div>
    <h2 class="s-title" data-i18n="testi_title">Lo que dicen quienes ya la usan</h2>
    <p class="s-sub" data-i18n="testi_sub">Personas reales que transformaron cómo gestionan su contenido digital.</p>
  </div>
  <div class="testi-grid">
    <div class="t-card">
      <div class="t-q">"</div>
      <div class="t-stars">★★★★★</div>
      <p class="t-text" data-i18n="t1_text">Si no quieres enloquecer con tantos links de tu interés guardados por todos lados, esta app te ayuda a organizarlos y encontrarlos cuando los necesites. Su buscador es increíble.</p>
      <div class="t-author">
        <div class="t-avatar">SO</div>
        <div>
          <div class="t-name">Sandra Ojeda</div>
          <div class="t-handle" data-i18n="t_user">Usuaria SmartShelf</div>
        </div>
      </div>
    </div>
    <div class="t-card">
      <div class="t-q">"</div>
      <div class="t-stars">★★★★★</div>
      <p class="t-text" data-i18n="t2_text">Permite guardar de forma ordenada y segura los links de acceso de las páginas importantes. Una herramienta que uso todos los días.</p>
      <div class="t-author">
        <div class="t-avatar">MJ</div>
        <div>
          <div class="t-name">María José Ospino</div>
          <div class="t-handle" data-i18n="t_user">Usuaria SmartShelf</div>
        </div>
      </div>
    </div>
    <div class="t-card">
      <div class="t-q">"</div>
      <div class="t-stars">★★★★★</div>
      <p class="t-text" data-i18n="t3_text">Una biblioteca digital personal y fácil de usar. La función de búsqueda es imprescindible para cualquier persona que maneje un volumen considerable de contenidos digitales.</p>
      <div class="t-author">
        <div class="t-avatar">CZ</div>
        <div>
          <div class="t-name">Carol Zambrano</div>
          <div class="t-handle" data-i18n="t_user">Usuaria SmartShelf</div>
        </div>
      </div>
    </div>
    <div class="t-card">
      <div class="t-q">"</div>
      <div class="t-stars">★★★★★</div>
      <p class="t-text" data-i18n="t4_text">Muy práctica para organizar tantos enlaces de internet, especialmente para buscarlos de una manera ágil y personalizada. La recomiendo ampliamente.</p>
      <div class="t-author">
        <div class="t-avatar">OA</div>
        <div>
          <div class="t-name">Oscar Ariza</div>
          <div class="t-handle" data-i18n="t_user2">Usuario SmartShelf</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA BANNER -->
<section id="cta">
  <div class="trial-badge" data-i18n="cta_badge">✦ Sin tarjeta de crédito · Sin compromisos</div>
  <h2 class="cta-title" data-i18n="cta_title">Deja de perder links.<br>Empieza hoy, gratis.</h2>
  <p class="cta-sub" data-i18n="cta_sub">30 días para explorar todo SmartShelf sin restricciones. Tu conocimiento merece un mejor hogar.</p>
  <div class="cta-btns">
    <a href="https://solicionespro.com/SmartShelf/requestaccessfinal.php" class="btn btn-primary btn-lg" data-i18n="cta_btn1">Crear mi cuenta gratis ›</a>
    <a href="https://wa.me/573054293185" class="btn-outline-lg btn" data-i18n="cta_btn2">Hablar con soporte</a>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="f-grid">
    <div>
      <div class="f-brand">SmartShelf</div>
      <div class="f-tag" data-i18n="f_tag">Tu biblioteca digital inteligente. Centraliza, organiza y accede a todos tus contenidos en un solo lugar.</div>
      <div class="socials">
        <a href="https://www.instagram.com/smartshelfcol/" class="soc" title="Instagram">📸</a>
        <a href="https://www.facebook.com/profile.php?id=61575835265080" class="soc" title="Facebook">👤</a>
        <a href="https://www.youtube.com/watch?v=rzKkmjfY7nk" class="soc" title="YouTube">▶️</a>
        <a href="https://www.tiktok.com/@smartshelfcol" class="soc" title="TikTok">♪</a>
        <a href="https://wa.me/573054293185" class="soc" title="WhatsApp">💬</a>
      </div>
    </div>
    <div>
      <div class="f-col-title" data-i18n="f_product">Producto</div>
      <ul class="f-links">
        <li><a href="#features" data-i18n="nav_features">Características</a></li>
        <li><a href="#how" data-i18n="nav_how">Cómo Funciona</a></li>
        <li><a href="#pricing" data-i18n="nav_pricing">Precios</a></li>
        <li><a href="https://solicionespro.com/SmartShelf/requestaccessfinal.php" data-i18n="f_trial">Prueba Gratis</a></li>
      </ul>
    </div>
    <div>
      <div class="f-col-title" data-i18n="f_support">Soporte</div>
      <ul class="f-links">
        <li><a href="https://www.youtube.com/watch?v=rzKkmjfY7nk" data-i18n="f_tutorials">Tutoriales</a></li>
        <li><a href="https://wa.me/573054293185" data-i18n="f_whatsapp">WhatsApp</a></li>
        <li><a href="https://solicionespro.com/SmartShelf/TermsConditions.php" data-i18n="f_terms">Términos y Condiciones</a></li>
      </ul>
    </div>
    <div>
      <div class="f-col-title" data-i18n="f_follow">Síguenos</div>
      <ul class="f-links">
        <li><a href="https://www.instagram.com/smartshelfcol/">Instagram</a></li>
        <li><a href="https://www.facebook.com/profile.php?id=61575835265080">Facebook</a></li>
        <li><a href="https://www.tiktok.com/@smartshelfcol">TikTok</a></li>
        <li><a href="https://www.youtube.com/watch?v=rzKkmjfY7nk">YouTube</a></li>
      </ul>
    </div>
  </div>
  <div class="f-bottom">
    <div class="f-copy">© 2025 SmartShelf. <span data-i18n="f_rights">Todos los derechos reservados.</span></div>
    <div class="f-lang-mini">
      <button class="lb on" onclick="setLang('es')">ES</button>
      <button class="lb" onclick="setLang('en')">EN</button>
      <button class="lb" onclick="setLang('pt')">PT</button>
    </div>
  </div>
</footer>

<script>
/* ─── TRANSLATIONS ─── */
const T = {
  es: {
    nav_features:"Características", nav_how:"Cómo Funciona", nav_pricing:"Precios",
    nav_reviews:"Testimonios", nav_login:"Ingresar", nav_cta:"Prueba Gratis",
    nav_cta_free:"Comenzar Gratis — 30 días",
    hero_badge:"✦ Tu biblioteca digital personal",
    hero_title_1:"Guarda, Organiza",
    hero_title_2:"y Encuentra",
    hero_title_3:"cualquier enlace",
    hero_title_4:"al instante",
    hero_sub:"¿Cuántos links perdidos tienes hoy? SmartShelf centraliza todos tus contenidos favoritos de internet en un solo lugar, con búsqueda instantánea y acceso desde cualquier dispositivo.",
    hero_cta1:"Comenzar Gratis — 30 días ›",
    hero_cta2:"Ver Demo",
    stat1:"días gratis", stat2:"links guardados", stat3:"para encontrar algo",
    mock_cats:"Categorías", mock_all:"Todo", mock_tech:"Tecnología", mock_design:"Diseño",
    mock_courses:"Cursos", mock_search:"Buscar en mis links...",
    mock_link1:"Tutorial completo de React 2024 — Traversy Media",
    mock_link2:"10 habilidades más demandadas en 2025",
    mock_link3:"Plantilla de plan de proyecto",
    prob_tag:"El problema",
    prob_title:"¿Cuántos links tienes perdidos ahora mismo?",
    prob_sub:"La información valiosa está en todas partes: favoritos del navegador, chats de WhatsApp, correos, notas... y cuando la necesitas, no la encuentras.",
    pain1:"Links guardados en favoritos que nunca vuelves a encontrar",
    pain2:"Videos enviados por WhatsApp que se pierden entre miles de mensajes",
    pain3:"Horas buscando un artículo que leíste hace meses",
    pain4:"Carpetas de Drive, notas, emails y pestañas abiertas sin orden",
    sol_title:"SmartShelf lo resuelve todo",
    sol_desc:"Un solo lugar para guardar cualquier enlace de internet. Categorizado, buscable y accesible desde cualquier dispositivo.",
    sol_f1:"Guarda links de YouTube, LinkedIn, Drive, o cualquier URL pública",
    sol_f2:"Categorías y subcategorías personalizadas por ti",
    sol_f3:"Buscador inteligente con palabras clave incompletas",
    sol_f4:"Links privados y públicos, todo en un mismo lugar",
    sol_f5:"Acceso rápido desde cualquier dispositivo",
    feat_tag:"Características",
    feat_title:"Todo lo que necesitas para organizar tu conocimiento",
    feat_sub:"SmartShelf fue diseñado para que guardar y encontrar contenido sea simple, rápido y sin fricción.",
    f1_title:"Organización Inteligente", f1_desc:"Crea categorías y subcategorías completamente personalizadas para clasificar tus contenidos exactamente como tú lo necesitas.",
    f2_title:"Búsqueda Instantánea", f2_desc:"Encuentra cualquier link con solo escribir palabras clave. Funciona incluso si no recuerdas el título exacto o la plataforma.",
    f3_title:"Multiplataforma", f3_desc:"Compatible con YouTube, LinkedIn, Google Drive, sitios web, blogs, repositorios y cualquier URL pública o privada.",
    f4_title:"Links Privados", f4_desc:"Guarda también contenido privado o interno de forma segura. Tu biblioteca es tuya y solo tú decides qué guardar.",
    f5_title:"Acceso Desde Cualquier Lugar", f5_desc:"Accede a tus links desde el computador, tablet o celular. Tu biblioteca siempre disponible donde estés.",
    f6_title:"Acceso Directo al Contenido", f6_desc:"Un clic y llegas directo al contenido. Sin pasos intermedios, sin perder tiempo navegando entre carpetas.",
    how_tag:"Cómo Funciona", how_title:"En 3 pasos simples",
    how_sub:"Empezar a organizar tu vida digital es más fácil de lo que crees.",
    step1_title:"Regístrate Gratis", step1_desc:"Crea tu cuenta en segundos y comienza tu período de prueba gratuito de 30 días. Sin tarjeta de crédito, sin compromisos.",
    step2_title:"Crea tus Categorías", step2_desc:"Define las categorías que mejor se adapten a tu vida: trabajo, estudio, entretenimiento, recetas... lo que necesites.",
    step3_title:"Guarda y Encuentra", step3_desc:"Pega tus links, asígnalos a una categoría y úsalos cuando los necesites con el buscador inteligente.",
    price_tag:"Precios", price_title:"Simple, transparente, accesible",
    price_sub:"Comienza gratis por 30 días. Luego elige el plan que más te convenga.",
    plan1_name:"Trimestral", plan1_per:"COP · cada 3 meses", plan1_usd:"≈ USD $5 / trimestre",
    plan2_name:"Semestral", plan2_per:"COP · cada 6 meses", plan2_usd:"≈ USD $10 / semestre · Ahorra 17%", plan2_badge:"Más popular",
    plan3_name:"Anual", plan3_per:"COP · por año completo", plan3_usd:"≈ USD $15 / año · El mejor valor",
    pfeat1:"Links ilimitados", pfeat2:"Categorías personalizadas", pfeat3:"Buscador inteligente",
    pfeat4:"Acceso desde cualquier dispositivo", pfeat5:"Tutoriales y soporte prioritario",
    pfeat6:"Acceso anticipado a nuevas funciones",
    plan_btn:"Comenzar ›",
    price_note:"Todos los planes incluyen 30 días de prueba gratuita. Sin tarjeta de crédito.",
    testi_tag:"Testimonios", testi_title:"Lo que dicen quienes ya la usan",
    testi_sub:"Personas reales que transformaron cómo gestionan su contenido digital.",
    t1_text:"Si no quieres enloquecer con tantos links de tu interés guardados por todos lados, esta app te ayuda a organizarlos y encontrarlos cuando los necesites. Su buscador es increíble.",
    t2_text:"Permite guardar de forma ordenada y segura los links de acceso de las páginas importantes. Una herramienta que uso todos los días.",
    t3_text:"Una biblioteca digital personal y fácil de usar. La función de búsqueda es imprescindible para cualquier persona que maneje un volumen considerable de contenidos digitales.",
    t4_text:"Muy práctica para organizar tantos enlaces de internet, especialmente para buscarlos de una manera ágil y personalizada. La recomiendo ampliamente.",
    t_user:"Usuaria SmartShelf", t_user2:"Usuario SmartShelf",
    cta_badge:"✦ Sin tarjeta de crédito · Sin compromisos",
    cta_title:"Deja de perder links.\nEmpieza hoy, gratis.",
    cta_sub:"30 días para explorar todo SmartShelf sin restricciones. Tu conocimiento merece un mejor hogar.",
    cta_btn1:"Crear mi cuenta gratis ›", cta_btn2:"Hablar con soporte",
    f_tag:"Tu biblioteca digital inteligente. Centraliza, organiza y accede a todos tus contenidos en un solo lugar.",
    f_product:"Producto", f_support:"Soporte", f_follow:"Síguenos",
    f_trial:"Prueba Gratis", f_tutorials:"Tutoriales", f_whatsapp:"WhatsApp",
    f_terms:"Términos y Condiciones", f_rights:"Todos los derechos reservados."
  },
  en: {
    nav_features:"Features", nav_how:"How It Works", nav_pricing:"Pricing",
    nav_reviews:"Reviews", nav_login:"Log In", nav_cta:"Free Trial",
    nav_cta_free:"Start Free — 30 days",
    hero_badge:"✦ Your personal digital library",
    hero_title_1:"Save, Organize",
    hero_title_2:"and Find",
    hero_title_3:"any link",
    hero_title_4:"instantly",
    hero_sub:"How many lost links do you have right now? SmartShelf centralizes all your favorite internet content in one place, with instant search and access from any device.",
    hero_cta1:"Start Free — 30 days ›",
    hero_cta2:"Watch Demo",
    stat1:"days free", stat2:"links saved", stat3:"to find anything",
    mock_cats:"Categories", mock_all:"All", mock_tech:"Technology", mock_design:"Design",
    mock_courses:"Courses", mock_search:"Search my links...",
    mock_link1:"Complete React 2024 Tutorial — Traversy Media",
    mock_link2:"10 most in-demand skills in 2025",
    mock_link3:"Project plan template",
    prob_tag:"The problem",
    prob_title:"How many links have you lost right now?",
    prob_sub:"Valuable information is everywhere: browser bookmarks, WhatsApp chats, emails, notes... and when you need it, you can't find it.",
    pain1:"Bookmarks saved in folders you never find again",
    pain2:"Videos shared on WhatsApp lost among thousands of messages",
    pain3:"Hours searching for an article you read months ago",
    pain4:"Drive folders, notes, emails and open tabs — all a mess",
    sol_title:"SmartShelf solves it all",
    sol_desc:"One place to save any internet link. Categorized, searchable and accessible from any device.",
    sol_f1:"Save links from YouTube, LinkedIn, Drive, or any public URL",
    sol_f2:"Custom categories and subcategories created by you",
    sol_f3:"Smart search with partial or incomplete keywords",
    sol_f4:"Private and public links, all in one place",
    sol_f5:"Quick access from any device",
    feat_tag:"Features",
    feat_title:"Everything you need to organize your knowledge",
    feat_sub:"SmartShelf was designed to make saving and finding content simple, fast and frictionless.",
    f1_title:"Smart Organization", f1_desc:"Create fully custom categories and subcategories to classify your content exactly the way you need it.",
    f2_title:"Instant Search", f2_desc:"Find any link by just typing keywords. Works even if you don't remember the exact title or platform.",
    f3_title:"Multi-platform", f3_desc:"Compatible with YouTube, LinkedIn, Google Drive, websites, blogs, repos and any public or private URL.",
    f4_title:"Private Links", f4_desc:"Securely save private or internal content too. Your library is yours — only you decide what to store.",
    f5_title:"Access From Anywhere", f5_desc:"Access your links from your computer, tablet or phone. Your library always available wherever you are.",
    f6_title:"Direct Content Access", f6_desc:"One click and you go straight to the content. No extra steps, no time wasted navigating folders.",
    how_tag:"How It Works", how_title:"In 3 simple steps",
    how_sub:"Starting to organize your digital life is easier than you think.",
    step1_title:"Sign Up Free", step1_desc:"Create your account in seconds and start your 30-day free trial. No credit card, no commitments.",
    step2_title:"Create Your Categories", step2_desc:"Define categories that fit your life: work, study, entertainment, recipes... whatever you need.",
    step3_title:"Save and Find", step3_desc:"Paste your links, assign them a category, and find them instantly with the smart search.",
    price_tag:"Pricing", price_title:"Simple, transparent, affordable",
    price_sub:"Start free for 30 days. Then choose the plan that works best for you.",
    plan1_name:"Quarterly", plan1_per:"COP · every 3 months", plan1_usd:"≈ USD $5 / quarter",
    plan2_name:"Biannual", plan2_per:"COP · every 6 months", plan2_usd:"≈ USD $10 / 6 months · Save 17%", plan2_badge:"Most popular",
    plan3_name:"Annual", plan3_per:"COP · full year", plan3_usd:"≈ USD $15 / year · Best value",
    pfeat1:"Unlimited links", pfeat2:"Custom categories", pfeat3:"Smart search",
    pfeat4:"Access from any device", pfeat5:"Tutorials & priority support",
    pfeat6:"Early access to new features",
    plan_btn:"Get started ›",
    price_note:"All plans include a 30-day free trial. No credit card required.",
    testi_tag:"Testimonials", testi_title:"What our users say",
    testi_sub:"Real people who transformed how they manage their digital content.",
    t1_text:"If you don't want to go crazy with so many links saved everywhere, this app helps you organize them and find them when you need them. Its search is incredible.",
    t2_text:"It lets you save the links to important pages in an orderly and secure way. A tool I use every day.",
    t3_text:"A personal digital library that's easy to use. The search function is essential for anyone who handles a considerable volume of digital content.",
    t4_text:"Very practical for organizing so many internet links, especially for finding them in an agile and personalized way. I highly recommend it.",
    t_user:"SmartShelf User", t_user2:"SmartShelf User",
    cta_badge:"✦ No credit card · No commitments",
    cta_title:"Stop losing links.\nStart today, free.",
    cta_sub:"30 days to explore all of SmartShelf without restrictions. Your knowledge deserves a better home.",
    cta_btn1:"Create my free account ›", cta_btn2:"Chat with support",
    f_tag:"Your intelligent digital library. Centralize, organize and access all your content in one place.",
    f_product:"Product", f_support:"Support", f_follow:"Follow Us",
    f_trial:"Free Trial", f_tutorials:"Tutorials", f_whatsapp:"WhatsApp",
    f_terms:"Terms & Conditions", f_rights:"All rights reserved."
  },
  pt: {
    nav_features:"Recursos", nav_how:"Como Funciona", nav_pricing:"Preços",
    nav_reviews:"Depoimentos", nav_login:"Entrar", nav_cta:"Teste Grátis",
    nav_cta_free:"Começar Grátis — 30 dias",
    hero_badge:"✦ Sua biblioteca digital pessoal",
    hero_title_1:"Salve, Organize",
    hero_title_2:"e Encontre",
    hero_title_3:"qualquer link",
    hero_title_4:"instantaneamente",
    hero_sub:"Quantos links perdidos você tem agora? SmartShelf centraliza todos os seus conteúdos favoritos da internet em um só lugar, com busca instantânea e acesso de qualquer dispositivo.",
    hero_cta1:"Começar Grátis — 30 dias ›",
    hero_cta2:"Ver Demo",
    stat1:"dias grátis", stat2:"links salvos", stat3:"para encontrar algo",
    mock_cats:"Categorias", mock_all:"Todos", mock_tech:"Tecnologia", mock_design:"Design",
    mock_courses:"Cursos", mock_search:"Buscar nos meus links...",
    mock_link1:"Tutorial completo de React 2024 — Traversy Media",
    mock_link2:"10 habilidades mais demandadas em 2025",
    mock_link3:"Modelo de plano de projeto",
    prob_tag:"O problema",
    prob_title:"Quantos links você perdeu até agora?",
    prob_sub:"Informações valiosas estão em todo lugar: favoritos do navegador, chats do WhatsApp, e-mails, notas... e quando você precisa, não encontra.",
    pain1:"Links salvos em favoritos que você nunca mais encontra",
    pain2:"Vídeos enviados no WhatsApp perdidos entre milhares de mensagens",
    pain3:"Horas procurando um artigo que você leu há meses",
    pain4:"Pastas do Drive, notas, e-mails e abas abertas sem ordem",
    sol_title:"SmartShelf resolve tudo",
    sol_desc:"Um único lugar para salvar qualquer link da internet. Categorizado, pesquisável e acessível de qualquer dispositivo.",
    sol_f1:"Salve links do YouTube, LinkedIn, Drive ou qualquer URL pública",
    sol_f2:"Categorias e subcategorias personalizadas por você",
    sol_f3:"Busca inteligente com palavras-chave incompletas",
    sol_f4:"Links privados e públicos, tudo em um só lugar",
    sol_f5:"Acesso rápido de qualquer dispositivo",
    feat_tag:"Recursos",
    feat_title:"Tudo que você precisa para organizar seu conhecimento",
    feat_sub:"SmartShelf foi desenvolvido para que salvar e encontrar conteúdo seja simples, rápido e sem fricção.",
    f1_title:"Organização Inteligente", f1_desc:"Crie categorias e subcategorias totalmente personalizadas para classificar seus conteúdos exatamente como você precisa.",
    f2_title:"Busca Instantânea", f2_desc:"Encontre qualquer link simplesmente digitando palavras-chave. Funciona mesmo que você não lembre o título exato.",
    f3_title:"Multiplataforma", f3_desc:"Compatível com YouTube, LinkedIn, Google Drive, sites, blogs, repositórios e qualquer URL pública ou privada.",
    f4_title:"Links Privados", f4_desc:"Salve também conteúdo privado ou interno com segurança. Sua biblioteca é sua — só você decide o que guardar.",
    f5_title:"Acesso De Qualquer Lugar", f5_desc:"Acesse seus links do computador, tablet ou celular. Sua biblioteca sempre disponível onde você estiver.",
    f6_title:"Acesso Direto ao Conteúdo", f6_desc:"Um clique e você vai direto ao conteúdo. Sem etapas intermediárias, sem perder tempo navegando por pastas.",
    how_tag:"Como Funciona", how_title:"Em 3 passos simples",
    how_sub:"Começar a organizar sua vida digital é mais fácil do que você imagina.",
    step1_title:"Cadastre-se Grátis", step1_desc:"Crie sua conta em segundos e comece seu período de avaliação gratuita de 30 dias. Sem cartão de crédito.",
    step2_title:"Crie suas Categorias", step2_desc:"Defina as categorias que melhor se adaptam à sua vida: trabalho, estudo, entretenimento, receitas... o que precisar.",
    step3_title:"Salve e Encontre", step3_desc:"Cole seus links, atribua uma categoria e use-os quando precisar com a busca inteligente.",
    price_tag:"Preços", price_title:"Simples, transparente, acessível",
    price_sub:"Comece grátis por 30 dias. Depois escolha o plano que mais te convém.",
    plan1_name:"Trimestral", plan1_per:"COP · a cada 3 meses", plan1_usd:"≈ USD $5 / trimestre",
    plan2_name:"Semestral", plan2_per:"COP · a cada 6 meses", plan2_usd:"≈ USD $10 / semestre · Economize 17%", plan2_badge:"Mais popular",
    plan3_name:"Anual", plan3_per:"COP · por ano completo", plan3_usd:"≈ USD $15 / ano · Melhor custo-benefício",
    pfeat1:"Links ilimitados", pfeat2:"Categorias personalizadas", pfeat3:"Busca inteligente",
    pfeat4:"Acesso de qualquer dispositivo", pfeat5:"Tutoriais e suporte prioritário",
    pfeat6:"Acesso antecipado a novos recursos",
    plan_btn:"Começar ›",
    price_note:"Todos os planos incluem 30 dias de avaliação gratuita. Sem cartão de crédito.",
    testi_tag:"Depoimentos", testi_title:"O que nossos usuários dizem",
    testi_sub:"Pessoas reais que transformaram como gerenciam seu conteúdo digital.",
    t1_text:"Se você não quer enlouquecer com tantos links salvos por todo lado, este app ajuda a organizá-los e encontrá-los quando precisar. O buscador é incrível.",
    t2_text:"Permite salvar os links das páginas importantes de forma organizada e segura. Uma ferramenta que uso todos os dias.",
    t3_text:"Uma biblioteca digital pessoal e fácil de usar. A função de busca é essencial para qualquer pessoa que lidia com grande volume de conteúdo digital.",
    t4_text:"Muito prático para organizar tantos links da internet, especialmente para encontrá-los de forma ágil e personalizada. Recomendo muito.",
    t_user:"Usuária SmartShelf", t_user2:"Usuário SmartShelf",
    cta_badge:"✦ Sem cartão de crédito · Sem compromisso",
    cta_title:"Pare de perder links.\nComece hoje, grátis.",
    cta_sub:"30 dias para explorar todo o SmartShelf sem restrições. Seu conhecimento merece um lar melhor.",
    cta_btn1:"Criar minha conta grátis ›", cta_btn2:"Falar com suporte",
    f_tag:"Sua biblioteca digital inteligente. Centralize, organize e acesse todos os seus conteúdos em um só lugar.",
    f_product:"Produto", f_support:"Suporte", f_follow:"Siga-nos",
    f_trial:"Teste Grátis", f_tutorials:"Tutoriais", f_whatsapp:"WhatsApp",
    f_terms:"Termos e Condições", f_rights:"Todos os direitos reservados."
  }
};

let currentLang = 'es';

function setLang(lang) {
  currentLang = lang;
  const d = T[lang];
  document.querySelectorAll('[data-i18n]').forEach(el => {
    const key = el.getAttribute('data-i18n');
    if (d[key] !== undefined) {
      if (key === 'cta_title') {
        el.innerHTML = d[key].replace(/\n/g, '<br>');
      } else {
        el.textContent = d[key];
      }
    }
  });
  document.querySelectorAll('.lb').forEach(b => {
    b.classList.toggle('on', b.textContent === lang.toUpperCase());
  });
  document.documentElement.lang = lang;
}

function toggleMenu() {
  document.getElementById('mobNav').classList.toggle('open');
}

/* smooth reveal on scroll */
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.style.opacity = '1';
      e.target.style.transform = 'translateY(0)';
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.feat-card, .p-card, .t-card, .pain-item, .step').forEach(el => {
  el.style.transition = 'opacity .6s ease, transform .6s ease';
  el.style.opacity = '0';
  el.style.transform = 'translateY(20px)';
  observer.observe(el);
});
</script>
</body>
</html>