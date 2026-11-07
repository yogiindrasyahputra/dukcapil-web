<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f3f7fc">
    <title>@yield('title', 'Layanan Administrasi Kependudukan') · Dukcapil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{color-scheme:light;--paper:#f3f7fc;--paper-strong:#e8f0fa;--paper-soft:#fff;--white:#fff;--ink:#172b43;--ink-strong:#0e1e33;--muted:#66788e;--line:#dce6f1;--card:#fff;--card-alt:#f2f7fc;--green:#1d5fa8;--green-dark:#17477d;--green-soft:#e6f0fb;--lime:#c8dcf5;--orange:#e49c6d;--violet:#7569e9;--shadow:0 22px 60px rgba(24,56,95,.09);font-family:"DM Sans",sans-serif}
        :root[data-theme="dark"]{color-scheme:dark;--paper:#091726;--paper-strong:#10243a;--paper-soft:#122b45;--white:#0f2033;--ink:#edf5ff;--ink-strong:#f5f9ff;--muted:#a9bbd0;--line:#23384e;--card:#12263a;--card-alt:#10243a;--green:#83bdff;--green-dark:#a8d1ff;--green-soft:rgba(131,189,255,.13);--lime:#c6e0ff;--orange:#f0b07a;--violet:#9ea4ff;--shadow:0 22px 60px rgba(2,6,8,.55)}
        *{box-sizing:border-box}
        html{scroll-behavior:smooth;scroll-padding-top:100px}
        body{margin:0;background:var(--paper);color:var(--ink);font-size:15px;line-height:1.65;overflow-x:hidden}
        body:before{position:fixed;inset:0;z-index:-1;pointer-events:none;content:"";background:radial-gradient(ellipse at 82% 10%,rgba(159,199,244,.22),transparent 30%),radial-gradient(ellipse at 4% 54%,rgba(190,213,244,.18),transparent 35%)}
        :root[data-theme="dark"] body:before{background:radial-gradient(ellipse at 82% 10%,rgba(72,137,205,.16),transparent 28%),radial-gradient(ellipse at 14% 46%,rgba(89,112,214,.14),transparent 32%)}
        a{color:inherit}
        :focus-visible{outline:3px solid #efa16f;outline-offset:4px}
        .wrap{width:min(1160px,calc(100% - 56px));margin-inline:auto}
        .site-header{position:sticky;top:0;z-index:20;background:rgba(250,251,248,.84);border-bottom:1px solid rgba(226,232,224,.8);backdrop-filter:blur(18px)}
        .header-inner{min-height:78px;display:flex;align-items:center;justify-content:space-between;gap:24px}
        .brand{display:flex;align-items:center;gap:12px;text-decoration:none;font-family:Manrope,sans-serif;font-size:13px;font-weight:800;letter-spacing:-.025em;line-height:1.25}
        .brand small{display:block;margin-top:4px;color:var(--muted);font:500 11px "DM Sans",sans-serif;letter-spacing:.015em}
        .brand-mark{width:42px;height:42px;display:grid;place-items:center;border-radius:14px;color:#fff;background:linear-gradient(145deg,#347dc5,#17477d);box-shadow:0 8px 18px rgba(29,95,168,.22);transform:rotate(-5deg)}
        .brand-mark img{display:block;width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 2px 2px rgba(24,48,35,.12))}
        .brand-mark:before{content:none}
        .main-nav{display:flex;align-items:center;gap:7px}
        .main-nav a{padding:10px 13px;color:#64736c;text-decoration:none;font-size:13px;font-weight:700;border-radius:999px;transition:color .2s,background .2s,transform .2s}
        .main-nav a:hover{background:#e8f1fc;color:var(--green);transform:translateY(-1px)}
        .main-nav .nav-cta{padding:10px 16px;color:white;background:var(--green)}
        .main-nav .nav-cta:hover{color:white;background:var(--green-dark)}
        .theme-toggle{display:inline-flex;align-items:center;gap:8px;min-height:42px;padding:0 14px;border:1px solid var(--line);border-radius:999px;background:var(--card);color:var(--ink);font:700 12px/1 "DM Sans",sans-serif;cursor:pointer;transition:transform .2s ease,border-color .2s ease,background .2s ease}
        .theme-toggle:hover{transform:translateY(-1px);border-color:#bfd5bf}
        .theme-toggle__icon{display:grid;place-items:center;width:22px;height:22px;border-radius:50%;background:var(--green-soft);color:var(--green);font-size:12px}
        .home-hero{min-height:565px;display:grid;grid-template-columns:1fr 1fr;align-items:center;gap:42px;padding-block:52px 63px}
        .theme-toggle__text{letter-spacing:.02em}
        .hero-copy{position:relative;z-index:2;animation:rise .7s both}
        .eyebrow{display:flex;align-items:center;gap:9px;margin:0 0 17px;color:var(--green);font-size:11px;font-weight:800;letter-spacing:.13em;text-transform:uppercase}
        .eyebrow-mark{width:21px;height:3px;border-radius:4px;background:#e49364}
        h1,h2,h3{font-family:Manrope,"DM Sans",sans-serif}
        h1{max-width:650px;margin:0 0 20px;font-size:clamp(42px,5.4vw,68px);font-weight:800;letter-spacing:-.075em;line-height:1.06}
        h1 span{color:var(--green)}
        .lead{max-width:470px;margin:0;color:var(--muted);font-size:17px;line-height:1.8}
        .hero-actions{display:flex;align-items:center;gap:23px;margin-top:27px}
        .reveal{opacity:0;transform:translateY(18px);transition:opacity .6s ease,transform .6s ease}
        .reveal.is-visible{opacity:1;transform:none}
        .service-card,.step-card,.feature-card,.contact-panel,.info-card,.application-card,.track-card,.tracking-hero,.tracking-panel,.tracking-step,.office-address-card{transform:translateZ(0);will-change:transform,box-shadow,opacity}
        .button{min-height:49px;display:inline-flex;align-items:center;justify-content:center;gap:16px;padding:0 19px;border-radius:13px;text-decoration:none;font-size:13px;font-weight:800;transition:transform .2s,box-shadow .2s}
        .button:hover{transform:translateY(-3px)}
        .button-primary{color:white;background:linear-gradient(135deg,#2876bd,#17477d);box-shadow:0 12px 22px rgba(29,95,168,.19)}
        .button-primary:hover{box-shadow:0 15px 26px rgba(29,95,168,.28)}
        .text-link{color:var(--ink);text-decoration:none;font-size:13px;font-weight:800}
        .text-link span{margin-left:7px;color:var(--green)}
        .hero-proof{display:flex;align-items:center;gap:9px;margin-top:34px;color:#78857e;font-size:12px;font-weight:600}
        .hero-proof span{color:var(--green);font-size:17px}
        .hero-art{height:425px;position:relative;display:grid;place-items:center;perspective:1000px;isolation:isolate}
        .hero-art:before{position:absolute;inset:10% 12% auto 12%;height:76%;border-radius:28px;background:linear-gradient(135deg,rgba(255,255,255,.22),transparent 60%);transform:rotate(-8deg);content:"";pointer-events:none;filter:blur(4px)}
        .hero-glow{position:absolute;width:350px;height:320px;border-radius:50%;background:radial-gradient(ellipse,rgba(184,230,151,.54),rgba(199,214,255,.27) 50%,transparent 72%);filter:blur(13px);animation:breathe 5s ease-in-out infinite}
        .art-orbit{position:absolute;width:390px;height:218px;border:1px solid rgba(41,120,89,.17);border-radius:50%;transform:rotateX(66deg) rotateZ(-26deg);animation:orbit 12s ease-in-out infinite}
        .art-orbit-two{width:345px;height:235px;border-color:rgba(218,136,98,.2);transform:rotateX(66deg) rotateZ(45deg)}
        .hero-document{width:min(360px,76%);height:245px;position:relative;z-index:2;overflow:hidden;padding:22px 25px;border:1px solid rgba(255,255,255,.65);border-radius:24px;color:#fff;background:linear-gradient(140deg,#277d5d 0%,#17654d 57%,#104b3d 100%);box-shadow:0 38px 70px rgba(29,83,62,.3),inset 0 1px 0 rgba(255,255,255,.45);transform:rotateY(-14deg) rotateX(9deg) rotateZ(-6deg);animation:float-card 6s ease-in-out infinite}
        .hero-document:before,.hero-document:after{position:absolute;content:"";border:1px solid rgba(255,255,255,.15);border-radius:50%}
        .hero-document:before{width:265px;height:265px;top:-137px;right:-90px;box-shadow:0 0 0 21px rgba(255,255,255,.035),0 0 0 44px rgba(255,255,255,.025)}
        .hero-document:after{width:155px;height:155px;right:-48px;bottom:-112px;background:rgba(200,240,120,.12)}
        .hero-document-top,.hero-document-bottom{position:relative;z-index:1;display:flex;align-items:center;justify-content:space-between;font-size:8px;font-weight:800;letter-spacing:.13em}
        .hero-document-top i{width:27px;height:21px;border:1px solid rgba(255,255,255,.76);border-radius:6px;background:linear-gradient(145deg,#d7f8ba,#ffe4a3)}
        .hero-document-seal{position:absolute;left:25px;bottom:40px;width:67px;height:80px;display:grid;place-items:center;border-radius:18px 18px 15px 15px;color:#236c4d;font-size:30px;background:linear-gradient(150deg,#e5ffd4,#9bd8ae);box-shadow:inset 0 -8px 0 rgba(31,97,70,.12);transform:rotate(-3deg)}
        .hero-document-lines{position:absolute;left:113px;bottom:66px;display:grid;gap:10px;width:137px}
        .hero-document-lines i{height:7px;border-radius:8px;background:rgba(255,255,255,.76)}
        .hero-document-lines i:nth-child(2){width:76%;height:5px;background:rgba(255,255,255,.47)}
        .hero-document-lines i:nth-child(3){width:54%;height:5px;background:rgba(255,255,255,.34)}
        .hero-document-bottom{position:absolute;right:24px;bottom:17px;left:24px;font-size:7px;color:rgba(255,255,255,.76)}
        .hero-document-bottom b{color:var(--lime);font-size:7px}
        .art-chip{position:absolute;z-index:3;display:flex;align-items:center;gap:10px;padding:11px 14px;border:1px solid rgba(255,255,255,.8);border-radius:14px;background:rgba(255,255,255,.94);box-shadow:0 15px 35px rgba(28,55,44,.12);font-size:10px;line-height:1.5;color:#718078;animation:float-chip 5s ease-in-out infinite}
        .art-chip b{color:var(--ink);font-size:11px}
        .chip-top{top:44px;right:0}
        .chip-top>span:first-child{width:30px;height:30px;display:grid;place-items:center;border-radius:10px;color:var(--green);background:#e4f4e7;font-size:16px}
        .chip-bottom{bottom:46px;left:0;animation-delay:-2s}
        .chip-dot{width:10px;height:10px;border:3px solid #c8f078;border-radius:50%;box-shadow:0 0 0 5px rgba(200,240,120,.18)}
        .art-spark{position:absolute;width:12px;height:12px;border-radius:3px;background:#c8f078;transform:rotate(45deg);box-shadow:0 4px 14px rgba(86,133,56,.25)}
        .spark-one{top:83px;left:13%}.spark-two{right:9%;bottom:89px;width:8px;height:8px;background:#e9986f}
        .section-pad{padding-block:78px}
        .services-section{background:rgba(255,255,255,.53);border-top:1px solid rgba(229,234,227,.76);border-bottom:1px solid rgba(229,234,227,.76)}
        .section-heading{display:flex;align-items:end;justify-content:space-between;gap:28px;margin-bottom:30px}
        .section-heading .eyebrow{margin-bottom:10px}
        .section-heading h2,.contact-panel h2{margin:0;font-size:clamp(29px,3.5vw,42px);font-weight:800;letter-spacing:-.065em;line-height:1.15}
        .section-heading>p{max-width:390px;margin:0 0 2px;color:var(--muted);font-size:13px}
        .service-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}
        .service-card{min-width:0;overflow:hidden;border:1px solid var(--line);border-radius:19px;background:var(--white);text-decoration:none;box-shadow:0 8px 25px rgba(29,55,44,.035);transition:transform .25s,box-shadow .25s,border-color .25s}
        .service-card:hover{transform:translateY(-6px);border-color:#cbdcc9;box-shadow:0 21px 44px rgba(29,55,44,.1)}
        .service-card-art{height:149px;position:relative;display:grid;place-items:center;overflow:hidden;background:linear-gradient(145deg,color-mix(in srgb,var(--accent) 11%,white),color-mix(in srgb,var(--accent) 5%,#edf3eb))}
        .service-card-art:before{position:absolute;width:140px;height:140px;border:1px solid color-mix(in srgb,var(--accent) 19%,transparent);border-radius:50%;content:"";box-shadow:0 0 0 17px color-mix(in srgb,var(--accent) 4%,transparent),0 0 0 35px color-mix(in srgb,var(--accent) 3%,transparent)}
        .service-art-orbit{position:absolute;width:225px;height:100px;border:1px solid color-mix(in srgb,var(--accent) 20%,transparent);border-radius:50%;transform:rotate(-22deg)}
        .service-art-sheet{width:113px;height:110px;position:relative;z-index:1;display:block;padding:14px;border:1px solid rgba(255,255,255,.85);border-radius:15px;background:linear-gradient(150deg,#fff,color-mix(in srgb,var(--accent) 7%,#fff));box-shadow:0 15px 26px color-mix(in srgb,var(--accent) 20%,transparent),inset 0 1px 0 white;transform:rotateY(-14deg) rotateX(9deg) rotateZ(-6deg);transition:transform .3s}
        .service-card:hover .service-art-sheet{transform:rotateY(-20deg) rotateX(12deg) rotateZ(-3deg) translateY(-3px)}
        .service-art-icon{width:32px;height:32px;display:grid;place-items:center;margin-bottom:12px;border-radius:10px;color:white;background:var(--accent);font:800 9px Manrope,sans-serif;box-shadow:0 5px 12px color-mix(in srgb,var(--accent) 25%,transparent)}
        .service-art-line{height:5px;display:block;margin-top:7px;border-radius:5px;background:color-mix(in srgb,var(--accent) 18%,#edf0ea)}
        .line-long{width:68px}.line-short{width:43px}
        .service-art-stamp{position:absolute;right:11px;bottom:13px;width:21px;height:21px;display:grid;place-items:center;border:1px solid color-mix(in srgb,var(--accent) 30%,white);border-radius:50%;color:var(--accent);font-size:11px}
        .service-art-spark{position:absolute;top:28px;right:24%;color:var(--accent);font-size:16px}
        .service-card-copy{padding:18px 19px 20px}
        .service-card-kicker{color:#819087;font-size:9px;font-weight:800;letter-spacing:.13em}
        .service-card h3{margin:5px 0 7px;font-size:18px;letter-spacing:-.045em;line-height:1.35}
        .service-card p{min-height:46px;margin:0;color:var(--muted);font-size:12px;line-height:1.7}
        .card-link{display:flex;justify-content:space-between;align-items:center;margin-top:14px;padding-top:12px;border-top:1px solid #edf0eb;color:var(--green);font-size:11px;font-weight:800}
        .steps-section{padding-top:76px;padding-bottom:83px}
        .steps-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:15px}
        .step-card{padding:21px 22px;border:1px solid var(--line);border-radius:17px;background:rgba(255,255,255,.72)}
        .step-number{width:34px;height:34px;display:grid;place-items:center;border-radius:11px;color:var(--green);background:#e6f0fb;font-size:11px;font-weight:800}
        .step-card h3{margin:17px 0 5px;font-size:16px;letter-spacing:-.035em}
        .step-card p{margin:0;color:var(--muted);font-size:12px}
        .contact-section{padding-top:12px;padding-bottom:76px}
        .contact-panel{display:grid;grid-template-columns:1.3fr .7fr;gap:45px;align-items:center;padding:33px 37px;border:1px solid #dfe9dc;border-radius:23px;background:linear-gradient(120deg,#eef5e9,#f7f8f1 63%,#eef3eb);box-shadow:var(--shadow)}
        .contact-panel h2{font-size:32px}
        .contact-panel>div:first-child>p:last-child{max-width:570px;margin:12px 0 0;color:#68766d;font-size:13px}
        .contact-side{display:grid;gap:10px;padding-left:26px;border-left:1px solid #d9e3d6}
        .contact-side>span{color:#758279;font-size:11px;font-weight:700}
        .contact-side a{display:flex;flex-wrap:wrap;justify-content:space-between;gap:6px;color:var(--ink);text-decoration:none;font-size:11px}
        .contact-side strong{color:var(--green)}
        .site-footer{padding:22px 0 26px;border-top:1px solid var(--line);color:#758179;font-size:10px}
        .site-footer .wrap{display:flex;justify-content:space-between;gap:20px}
        .site-footer a{color:var(--green);font-weight:700;text-decoration:none}
        .service-hero{position:relative;min-height:360px;display:grid;grid-template-columns:1.18fr .82fr;align-items:center;gap:24px;margin-top:34px;padding:39px 44px;overflow:hidden;border:1px solid #dfe8dc;border-radius:27px;background:linear-gradient(115deg,#fff 0%,#f8faf5 57%,#edf4e9 100%);box-shadow:var(--shadow);isolation:isolate}
        .service-hero:after{position:absolute;z-index:-1;top:-145px;right:-125px;width:440px;height:440px;border-radius:50%;background:radial-gradient(circle,rgba(194,230,166,.4),rgba(194,230,166,0) 68%);content:""}
        .service-hero-copy{position:relative;z-index:2}
        .breadcrumb{display:flex;gap:8px;margin-bottom:23px;color:#849087;font-size:11px;font-weight:700}
        .breadcrumb a{color:var(--green);text-decoration:none}
        .service-hero h1{max-width:540px;margin-bottom:13px;font-size:clamp(39px,5vw,58px)}
        .service-hero-copy>.lead{font-size:15px}
        .service-meta{display:flex;gap:10px;flex-wrap:wrap;margin-top:23px}
        .meta-pill{display:flex;align-items:center;gap:8px;padding:8px 11px;border:1px solid #e7ece5;border-radius:10px;background:rgba(255,255,255,.76);color:#64736a;font-size:10px;font-weight:700}
        .meta-pill b{color:var(--green)}
        .service-scene{height:250px;position:relative;display:grid;place-items:center;perspective:900px}
        .service-scene-glow{position:absolute;width:260px;height:200px;border-radius:50%;background:radial-gradient(ellipse,rgba(181,223,150,.43),transparent 72%);filter:blur(8px)}
        .service-scene-orbit{position:absolute;width:300px;height:160px;border:1px solid rgba(54,125,87,.18);border-radius:50%;transform:rotateX(64deg) rotateZ(-25deg)}
        .service-document{width:202px;height:161px;position:relative;z-index:1;display:block;padding:17px;border:1px solid rgba(255,255,255,.9);border-radius:19px;background:linear-gradient(145deg,#fff,color-mix(in srgb,var(--service-accent) 9%,white));box-shadow:0 27px 42px color-mix(in srgb,var(--service-accent) 21%,transparent),inset 0 1px 0 white;transform:rotateY(-17deg) rotateX(9deg) rotateZ(-8deg);animation:float-card 6s ease-in-out infinite}
        .service-document-top{display:flex;align-items:center;justify-content:space-between;color:#75847a;font-size:8px;font-weight:800;letter-spacing:.11em}
        .service-document-top i{width:22px;height:17px;border-radius:5px;background:linear-gradient(135deg,#d8f1c2,#ffe4a3)}
        .service-document-icon{width:48px;height:48px;display:grid;place-items:center;margin-top:20px;border-radius:14px;color:white;background:linear-gradient(145deg,color-mix(in srgb,var(--service-accent) 85%,white),var(--service-accent));box-shadow:0 7px 15px color-mix(in srgb,var(--service-accent) 28%,transparent);font:800 12px Manrope,sans-serif}
        .service-document-lines{position:absolute;top:69px;left:77px;display:grid;gap:7px;width:90px}
        .service-document-lines i{height:5px;border-radius:5px;background:color-mix(in srgb,var(--service-accent) 17%,#edf0ea)}
        .service-document-lines i:nth-child(2){width:72%}.service-document-lines i:nth-child(3){width:51%}
        .service-document-stamp{position:absolute;right:16px;bottom:14px;width:26px;height:26px;display:grid;place-items:center;border:1px solid color-mix(in srgb,var(--service-accent) 33%,white);border-radius:50%;color:var(--service-accent);font-size:13px}
        .scene-float{position:absolute;z-index:2;right:1%;bottom:16px;padding:9px 12px;border:1px solid white;border-radius:12px;background:rgba(255,255,255,.9);box-shadow:0 12px 24px rgba(28,55,44,.1);color:#627269;font-size:9px;font-weight:700}
        .service-content{display:grid;grid-template-columns:minmax(0,1fr) minmax(350px,390px);align-items:start;gap:22px;margin-top:25px;margin-bottom:80px}
        .content-main{display:grid;gap:18px}
        .info-card,.application-card{border:1px solid var(--line);border-radius:20px;background:rgba(255,255,255,.87);box-shadow:0 10px 30px rgba(28,55,44,.045)}
        .info-card{padding:24px}
        .info-card h2,.application-card h2{margin:0 0 6px;font-size:21px;letter-spacing:-.045em}
        .card-intro{margin:0 0 17px;color:var(--muted);font-size:12px}
        .requirement-list{display:grid;gap:9px;margin:0;padding:0;list-style:none}
        .requirement-list li{display:flex;gap:10px;align-items:flex-start;color:#4e5c54;font-size:12px}
        .requirement-list li:before{width:19px;height:19px;flex:0 0 19px;display:grid;place-items:center;margin-top:1px;border-radius:7px;color:var(--green);background:#e8f3e7;content:"✓";font-size:10px;font-weight:800}
        .process-note{padding:18px 19px;border:1px solid #e7ebdf;border-radius:16px;background:linear-gradient(125deg,#eef5e7,#f8f8f1)}
        .process-note strong{display:block;margin-bottom:4px;font-family:Manrope,sans-serif;font-size:14px}
        .process-note p{margin:0;color:#69766e;font-size:11px}
        .application-card{position:sticky;top:96px;padding:22px}
        .application-card h2{font-size:20px}
        .application-card>p{margin:0 0 16px;color:var(--muted);font-size:11px}
        .form-section-title{display:flex;align-items:center;gap:9px;margin:19px 0 10px;color:#35463c;font-size:11px;font-weight:800}
        .form-section-title span{width:22px;height:22px;display:grid;place-items:center;border-radius:7px;color:var(--green);background:#e8f3e7;font-size:10px}
        .form-stack{display:grid;gap:10px}
        .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}
        .form-field{min-width:0}
        .form-field.full{grid-column:1/-1}
        .form-field label,.consent{display:block;color:#4c5b52;font-size:10px;font-weight:700}
        .form-field label>span{color:#a0aaa2;font-weight:500}
        .form-field{position:relative;transition:transform .2s ease}
        .form-field input,.form-field select,.form-field textarea{width:100%;min-height:40px;margin-top:5px;padding:9px 10px;border:1px solid #dfe6dc;border-radius:9px;background:#fbfcfa;color:var(--ink);font:500 11px "DM Sans",sans-serif;transition:all .2s ease}
        .form-field textarea{min-height:68px;resize:vertical}
        .form-field input[type=file]{min-height:39px;padding:7px;font-size:9px}
        .form-field input:hover,.form-field select:hover,.form-field textarea:hover{border-color:#c7d6c9}
        .form-field.is-focused{transform:translateY(-1px)}
        .form-field.is-focused input,.form-field.is-focused select,.form-field.is-focused textarea{outline:2px solid rgba(23,107,82,.2);border-color:#70a68e;transform:translateY(-1px);box-shadow:0 10px 18px rgba(23,107,82,.07)}
        .form-field input:focus,.form-field select:focus,.form-field textarea:focus{outline:2px solid rgba(23,107,82,.2);border-color:#70a68e;transform:translateY(-1px);box-shadow:0 10px 18px rgba(23,107,82,.07)}
        .form-field.is-invalid input,.form-field.is-invalid select,.form-field.is-invalid textarea{border-color:#d45d4d;background:#fff6f4;box-shadow:0 0 0 4px rgba(212,93,77,.08)}
        .form-field.is-valid input,.form-field.is-valid select,.form-field.is-valid textarea{border-color:#3f9275;background:#f5fff9;box-shadow:0 0 0 4px rgba(63,146,117,.06)}
        .form-field.is-conditional{transition:opacity .2s ease,transform .2s ease}
        .wizard-form{display:grid;gap:18px}
        .wizard-steps{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:8px;margin-bottom:8px}
        .wizard-step-pill{display:flex;align-items:center;justify-content:center;gap:8px;padding:10px 12px;border:1px solid #dfe8df;border-radius:12px;background:#f7faf7;color:#53635b;font:700 11px/1.2 "DM Sans",sans-serif;cursor:pointer;transition:all .2s ease;position:relative;overflow:hidden}
        .wizard-step-pill:before{content:"";position:absolute;inset:auto 0 0 0;height:2px;background:linear-gradient(90deg,rgba(23,107,82,0),rgba(35,111,160,.7),rgba(23,107,82,0));opacity:0;transform:scaleX(.3);transition:opacity .2s ease,transform .2s ease}
        .wizard-step-pill span{display:inline-grid;place-items:center;width:21px;height:21px;border-radius:50%;background:#edf4ee;color:var(--green);font-weight:800}
        .wizard-step-pill.is-current{background:linear-gradient(135deg,#eafaf2,#edf3ff);border-color:#b8d4c3;color:var(--green);box-shadow:0 12px 20px rgba(23,107,82,.08)}
        .wizard-step-pill.is-current:before,.wizard-step-pill:hover:before{opacity:1;transform:scaleX(1)}
        .wizard-step-pill.is-complete{background:linear-gradient(135deg,#edf9f2,#eaf5ff);border-color:#c9e8d8;color:#1b6a55}
        .wizard-step{display:none;animation:stepReveal .35s ease}
        .wizard-step.is-active{display:block}
        .wizard-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:18px}
        .wizard-actions.split{justify-content:space-between}
        .wizard-actions .button{min-width:154px}
        .wizard-step[hidden]{display:none!important}
        @keyframes stepReveal{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .wizard-branch-note{display:flex;align-items:flex-start;gap:10px;margin-top:16px;padding:12px 14px;border:1px solid rgba(34,116,88,.16);border-radius:13px;background:linear-gradient(120deg,rgba(232,247,238,.9),rgba(238,244,255,.86));color:#52645a;font-size:11px;line-height:1.55;animation:stepReveal .25s ease}
        .wizard-branch-note__icon{flex:0 0 20px;display:grid;place-items:center;width:20px;height:20px;border-radius:50%;background:var(--green);color:#fff;font-size:11px;font-weight:800}
        .wizard-review{margin-top:18px;padding:16px;border:1px solid rgba(33,123,93,.16);border-radius:16px;background:linear-gradient(135deg,#f3faf5,#f2f5fc)}
        .wizard-review__heading{display:flex;align-items:center;gap:10px;padding-bottom:12px;border-bottom:1px solid rgba(33,123,93,.12)}
        .wizard-review__icon{display:grid;place-items:center;width:32px;height:32px;border-radius:11px;background:var(--green);color:#fff;font-weight:900}
        .wizard-review__heading strong,.wizard-review__heading small{display:block}
        .wizard-review__heading strong{font:800 12px Manrope,sans-serif;color:#203b2e}
        .wizard-review__heading small{margin-top:2px;color:#728077;font-size:10px}
        .wizard-review dl{display:grid;gap:9px;margin:12px 0 0}
        .wizard-review dl div{display:grid;grid-template-columns:110px minmax(0,1fr);gap:10px;font-size:10px}
        .wizard-review dt{color:#78867e}
        .wizard-review dd{margin:0;color:#294c3c;font-weight:800;overflow-wrap:anywhere}
        :root[data-theme="dark"] .wizard-step-pill{border-color:var(--line);background:var(--card-alt);color:var(--muted)}
        :root[data-theme="dark"] .wizard-step-pill.is-current,:root[data-theme="dark"] .wizard-step-pill.is-complete{background:linear-gradient(135deg,rgba(34,116,88,.2),rgba(77,102,180,.16));color:var(--green-dark)}
        :root[data-theme="dark"] .wizard-branch-note,:root[data-theme="dark"] .wizard-review{background:linear-gradient(135deg,rgba(23,107,82,.12),rgba(67,83,138,.12));border-color:var(--line);color:var(--muted)}
        :root[data-theme="dark"] .wizard-review__heading strong,:root[data-theme="dark"] .wizard-review dd{color:var(--ink)}
        @media(max-width:560px){.wizard-steps{grid-template-columns:repeat(2,minmax(0,1fr))}.wizard-step-pill{justify-content:flex-start;padding:9px;font-size:10px}.wizard-actions .button{min-width:0;flex:1}.wizard-review dl div{grid-template-columns:95px minmax(0,1fr)}}
        .form-progress-panel{margin:18px 0 20px;padding:14px 15px;border:1px solid rgba(33,123,93,.14);border-radius:16px;background:linear-gradient(135deg,#f4fbf6,#eef5ff);box-shadow:0 10px 24px rgba(28,55,44,.05)}
        .form-progress-meta{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:10px;font-size:10px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:#6d7b75}
        .form-progress-meta strong{font-size:12px;color:var(--green)}
        .form-progress-track{position:relative;height:10px;overflow:hidden;border-radius:999px;background:rgba(23,107,82,.08)}
        .form-progress-track span{display:block;height:100%;width:0;border-radius:inherit;background:linear-gradient(90deg,#1ea978,#4b7df1 72%,#9b7ae6);transition:width .3s ease}
        .field-meta{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-top:6px}
        .field-counter{font-size:10px;font-weight:800;color:#5c6c63}
        .upload-box{position:relative;display:flex;align-items:center;justify-content:space-between;gap:12px;padding:10px 12px;margin-top:5px;border:1px dashed #bfd0bd;border-radius:12px;background:linear-gradient(135deg,#f9fff9,#edf7f5);transition:all .2s ease}
        .upload-box input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer}
        .upload-box__label{position:relative;z-index:1;display:inline-flex;align-items:center;gap:8px;padding:8px 12px;border-radius:10px;background:#fff;color:var(--green);font-weight:800;font-size:11px;border:1px solid rgba(23,107,82,.12)}
        .upload-box.is-drag-over,.upload-box.has-file{border-color:#7aa880;background:linear-gradient(135deg,#ebf9f1,#edf5ff);box-shadow:0 8px 18px rgba(34,104,80,.08)}
        .file-meta{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-top:7px;padding:0 2px}
        .file-meta__text{font-size:10px;font-weight:700;color:#687a72}
        .tracking-insight-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px;margin-bottom:14px}
        .insight-card{padding:14px 12px;border:1px solid var(--line);border-radius:16px;background:linear-gradient(135deg,var(--card),var(--card-alt));box-shadow:0 8px 18px rgba(33,58,46,.05)}
        .insight-card span{display:block;color:var(--muted);font-size:11px;font-weight:700;letter-spacing:.06em;text-transform:uppercase}
        .insight-card strong{display:block;margin-top:8px;color:var(--ink);font-size:15px;line-height:1.3}
        .insight-card small{display:block;margin-top:4px;color:var(--muted);font-size:11px}
        .field-hint{display:block;margin-top:4px;color:#7d8a81;font-size:9px;font-weight:500}
        .field-error{display:block;margin-top:4px;color:#b33e39;font-size:10px}
        .has-error input,.has-error select,.has-error textarea{border-color:#cc7771}
        .form-notice{margin:15px 0;padding:11px;border-radius:10px;color:#735c38;background:#fbf4e5;font-size:10px}
        .consent{display:flex;gap:8px;align-items:flex-start;margin:14px 0}
        .consent input{margin-top:3px;accent-color:var(--green)}
        .button-submit{width:100%;border:0;cursor:pointer;font-family:"DM Sans",sans-serif}
        .back-link{display:inline-block;margin-bottom:13px;color:var(--green);font-size:11px;font-weight:800;text-decoration:none}
        .track-card{padding:20px;border:1px solid var(--line);border-radius:18px;background:#fff}
        .track-card strong{display:block;margin-bottom:5px}
        .track-card p{margin:0;color:var(--muted);font-size:11px}
        .tracking-page{max-width:810px;padding-block:54px 78px}
        .tracking-hero{position:relative;overflow:hidden;padding:33px;border:1px solid #dfe8dc;border-radius:24px;background:linear-gradient(120deg,#fff,#f0f6ec);box-shadow:var(--shadow)}
        .tracking-hero:after{position:absolute;top:-90px;right:-70px;width:250px;height:250px;border:1px solid rgba(39,125,90,.11);border-radius:50%;box-shadow:0 0 0 18px rgba(39,125,90,.03),0 0 0 38px rgba(39,125,90,.025);content:""}
        .tracking-hero>*{position:relative;z-index:1}
        .tracking-hero h1{margin:0 0 7px;font-size:clamp(32px,5vw,45px)}
        .tracking-hero>p:last-child{margin:0;color:var(--muted);font-size:13px}
        .tracking-status{display:inline-flex;align-items:center;gap:8px;margin-bottom:16px;padding:7px 11px;border:1px solid #dbe9d3;border-radius:999px;color:#316d49;background:#f4f9ed;font-size:10px;font-weight:800}
        .tracking-status:before{width:8px;height:8px;border-radius:50%;background:#85b957;box-shadow:0 0 0 4px rgba(133,185,87,.15);content:""}
        .tracking-code{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-top:19px;padding:14px 16px;border:1px solid #e3e9df;border-radius:13px;background:rgba(255,255,255,.83)}
        .tracking-code span{display:block;color:#7a877f;font-size:9px;font-weight:700}
        .tracking-code strong{font-family:ui-monospace,SFMono-Regular,Consolas,monospace;font-size:clamp(11px,2vw,15px);letter-spacing:.02em;overflow-wrap:anywhere}
        .tracking-details{display:grid;grid-template-columns:1fr 1fr;gap:13px;margin-top:16px}
        .tracking-detail{padding:17px 18px;border:1px solid var(--line);border-radius:15px;background:rgba(255,255,255,.84)}
        .tracking-detail span{display:block;margin-bottom:5px;color:#78867d;font-size:10px;font-weight:700}
        .tracking-detail strong{font-size:13px}
        .tracking-next{margin-top:16px;padding:20px;border:1px solid #e6eade;border-radius:16px;background:#f4f7ef}
        .tracking-next h2{margin:0 0 5px;font-size:16px}
        .tracking-next p{margin:0;color:#68766e;font-size:12px}
        .tracking-actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:20px}
        .button-secondary{border:1px solid var(--line);color:var(--ink);background:#fff}
        @keyframes rise{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
        @keyframes float-card{0%,100%{translate:0 0;transform:rotateY(-14deg) rotateX(9deg) rotateZ(-6deg)}50%{translate:0 -9px;transform:rotateY(-10deg) rotateX(11deg) rotateZ(-4deg)}}
        @keyframes float-chip{0%,100%{translate:0 0}50%{translate:0 -7px}}
        @keyframes breathe{0%,100%{opacity:.75;scale:1}50%{opacity:1;scale:1.05}}
        @keyframes orbit{0%,100%{transform:rotateX(66deg) rotateZ(-26deg) scale(1)}50%{transform:rotateX(66deg) rotateZ(18deg) scale(1.03)}}
        @media(max-width:900px){.service-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.service-content{grid-template-columns:minmax(0,1fr) 310px}.service-hero{padding-inline:31px}.home-hero{gap:14px}.hero-art{height:370px}.art-orbit{width:340px}}
        @media(max-width:720px){.wrap{width:min(100% - 36px,560px)}.header-inner{min-height:70px;gap:10px}.brand{font-size:11px}.brand-mark{width:37px;height:37px}.main-nav{gap:1px}.main-nav a{padding:8px;font-size:10px}.main-nav .nav-cta{padding:8px 10px}.home-hero{min-height:auto;grid-template-columns:1fr;gap:0;padding-block:58px 36px}.hero-copy{padding-top:4px}.hero-art{height:330px;margin-top:6px}.hero-document{width:300px;height:207px;padding:19px}.hero-document-seal{bottom:35px;width:55px;height:64px}.hero-document-lines{left:96px;bottom:55px;width:115px}.hero-document-bottom{font-size:6px}.chip-top{top:20px;right:1%}.chip-bottom{bottom:25px;left:1%}.art-orbit{width:310px;height:190px}.section-pad{padding-block:57px}.section-heading{align-items:flex-start;flex-direction:column;gap:10px;margin-bottom:21px}.section-heading>p{font-size:12px}.service-card-art{height:130px}.service-card-copy{padding:15px}.service-card h3{font-size:16px}.service-card p{font-size:11px}.steps-grid{grid-template-columns:1fr;gap:10px}.step-card{padding:17px}.step-card h3{margin-top:10px}.contact-panel{grid-template-columns:1fr;gap:22px;padding:24px}.contact-panel h2{font-size:28px}.contact-side{padding:18px 0 0;border-left:0;border-top:1px solid #d9e3d6}.site-footer .wrap{flex-direction:column;gap:5px}.service-hero{min-height:0;grid-template-columns:1fr;padding:25px 23px 10px;margin-top:20px}.service-hero h1{font-size:43px}.service-hero-copy>.lead{font-size:14px}.service-scene{height:205px}.service-document{width:190px;height:147px}.service-meta{margin-top:17px}.scene-float{right:4%;bottom:7px}.service-content{grid-template-columns:1fr;margin-top:17px}.application-card{position:static;grid-row:1}.content-main{grid-row:2}.tracking-page{padding-block:37px 55px}.tracking-hero{padding:23px}.tracking-details{gap:9px}.tracking-detail{padding:14px}}
        @media(max-width:440px){.wrap{width:calc(100% - 28px)}.brand{gap:8px;font-size:10px}.brand small{font-size:9px}.brand-mark{width:33px;height:33px;border-radius:11px}.main-nav a{padding:7px 6px;font-size:9px}.main-nav .nav-cta{padding:7px 9px}.home-hero{padding-top:44px}h1{font-size:43px}.lead{font-size:15px}.hero-actions{gap:14px}.button{padding-inline:14px}.hero-art{height:292px}.hero-document{width:265px;height:190px}.chip-top{right:-4px}.chip-bottom{left:-3px}.art-chip{padding:8px 10px;font-size:9px}.art-chip b{font-size:10px}.service-grid{gap:10px}.service-card-art{height:105px}.service-art-sheet{width:91px;height:89px;padding:11px}.service-art-icon{width:27px;height:27px;margin-bottom:8px}.line-long{width:55px}.line-short{width:35px}.service-art-line{height:4px;margin-top:6px}.service-art-stamp{right:8px;bottom:9px;width:18px;height:18px}.service-card-copy{padding:12px}.service-card-kicker{font-size:8px}.service-card h3{font-size:14px}.service-card p{min-height:57px;font-size:10px}.card-link{font-size:10px}.service-hero{padding-inline:18px}.service-hero h1{font-size:37px}.breadcrumb{margin-bottom:15px}.info-card{padding:18px}.application-card{padding:17px}.form-grid{gap:8px}.form-field input,.form-field select,.form-field textarea{padding-inline:8px;font-size:10px}.tracking-hero{padding:19px}.tracking-code{padding:11px}.tracking-details{grid-template-columns:1fr}.tracking-detail{padding:12px 14px}}
        @media(prefers-reduced-motion:reduce){*,*::before,*::after{scroll-behavior:auto!important;animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.01ms!important}}
        body:before{background:radial-gradient(ellipse at 84% 12%,rgba(188,220,255,.33),transparent 31%),radial-gradient(ellipse at 7% 45%,rgba(255,208,183,.22),transparent 32%),radial-gradient(ellipse at 75% 74%,rgba(216,199,255,.2),transparent 34%),radial-gradient(ellipse at 38% 100%,rgba(197,239,172,.2),transparent 35%)}
        .site-header{background:rgba(250,251,248,.88)}
        .brand-mark{width:50px;height:56px;flex:none;border-radius:0;background:transparent;box-shadow:none;transform:none}
        .main-nav .nav-cta{background:linear-gradient(115deg,#167c61,#2863ae 65%,#664ec0);box-shadow:0 8px 18px rgba(44,102,149,.2)}
        .main-nav .nav-cta:hover{background:linear-gradient(115deg,#12644e,#214f8a 65%,#5641a3)}
        .button-primary{background:linear-gradient(115deg,#167c61 0%,#2865b2 64%,#654cc0);box-shadow:0 12px 24px rgba(56,97,170,.24)}
        .button-primary:hover{box-shadow:0 15px 29px rgba(83,88,178,.32)}
        .eyebrow{color:#346aa0}
        .eyebrow-mark{background:linear-gradient(90deg,#ee966d,#e4bf58)}
        .hero-copy h1 span{color:#267d68}
        .home-hero{position:relative}
        .home-hero:before{position:absolute;top:7%;right:11%;width:320px;height:320px;border-radius:50%;background:radial-gradient(circle,rgba(255,211,161,.23),rgba(255,211,161,0) 70%);content:"";pointer-events:none}
        .hero-glow{background:radial-gradient(ellipse,rgba(180,230,167,.62),rgba(178,208,255,.34) 43%,rgba(240,194,255,.25) 62%,transparent 76%)}
        .hero-document{background:linear-gradient(140deg,#218c77 0%,#2866a8 55%,#5648a7 100%);box-shadow:0 38px 70px rgba(61,80,158,.3),inset 0 1px 0 rgba(255,255,255,.5)}
        .hero-document-seal{color:#315da2;background:linear-gradient(150deg,#ffe3b4,#ffc5ae 52%,#d9c9ff);box-shadow:inset 0 -8px 0 rgba(73,75,139,.12)}
        .hero-document-bottom b{color:#ffe394}
        .art-orbit{border-color:rgba(53,111,190,.24)}
        .art-orbit-two{border-color:rgba(231,145,111,.3)}
        .art-spark{background:#ffd477;box-shadow:0 4px 14px rgba(201,140,61,.3)}
        .spark-two{background:#e78fbd}
        .chip-top>span:first-child{color:#4367bb;background:linear-gradient(145deg,#e0ebff,#e8ddff)}
        .chip-dot{border-color:#90d58e;box-shadow:0 0 0 5px rgba(112,195,124,.19)}
        .services-section{background:linear-gradient(180deg,rgba(239,245,255,.72),rgba(255,248,241,.75) 48%,rgba(249,245,255,.75));border-color:rgba(219,225,238,.85)}
        .service-card{border-color:#e4e5ed;background:linear-gradient(155deg,#fff 55%,#fcfbff);box-shadow:0 11px 28px rgba(45,64,112,.075)}
        .service-card:hover{border-color:#c8cce4;box-shadow:0 22px 44px rgba(55,74,136,.15)}
        .service-card-kicker{color:#687eb1}
        .card-link{border-color:#eaebf2}
        .step-card{border-color:#e1e5ec;background:linear-gradient(145deg,rgba(255,255,255,.95),rgba(245,248,255,.85))}
        .step-card:nth-child(1) .step-number{color:#237d68;background:#dcf4e8}
        .step-card:nth-child(2) .step-number{color:#466bb8;background:#e3eaff}
        .step-card:nth-child(3) .step-number{color:#a65780;background:#f7e3f0}
        .contact-panel{border-color:#e6dfd3;background:linear-gradient(115deg,#fff0df 0%,#f2f2ff 54%,#e8f6eb 100%)}
        .contact-side{border-color:#e2dce2}
        .service-hero{border-color:color-mix(in srgb,var(--service-accent) 23%,white);background:linear-gradient(112deg,#fff 0%,color-mix(in srgb,var(--service-accent) 8%,white) 52%,color-mix(in srgb,var(--service-accent) 17%,#fff6e9) 100%);box-shadow:0 25px 65px color-mix(in srgb,var(--service-accent) 12%,transparent)}
        .service-hero:after{background:radial-gradient(circle,color-mix(in srgb,var(--service-accent) 30%,transparent),transparent 69%)}
        .service-hero .eyebrow,.service-hero h1,.service-hero .breadcrumb a,.service-hero .meta-pill b,.service-hero .text-link span{color:var(--service-accent)}
        .service-hero .eyebrow-mark{background:linear-gradient(90deg,var(--service-accent),#efb96c)}
        .service-document{background:linear-gradient(145deg,#fff,color-mix(in srgb,var(--service-accent) 13%,white));box-shadow:0 27px 42px color-mix(in srgb,var(--service-accent) 26%,transparent),inset 0 1px 0 white}
        .service-document-icon{background:linear-gradient(145deg,color-mix(in srgb,var(--service-accent) 72%,#f4b96d),var(--service-accent))}
        .service-scene-glow{background:radial-gradient(ellipse,color-mix(in srgb,var(--service-accent) 31%,transparent),rgba(255,205,148,.27) 52%,transparent 74%)}
        .service-scene-orbit{border-color:color-mix(in srgb,var(--service-accent) 28%,transparent)}
        .meta-pill{border-color:color-mix(in srgb,var(--service-accent) 15%,white);background:color-mix(in srgb,var(--service-accent) 5%,white)}
        .service-content{--form-accent:var(--service-accent,#296d9b)}
        .info-card,.application-card{border-color:color-mix(in srgb,var(--form-accent) 16%,white);background:linear-gradient(150deg,#fff 58%,color-mix(in srgb,var(--form-accent) 4%,white));box-shadow:0 13px 34px color-mix(in srgb,var(--form-accent) 8%,transparent)}
        .info-card h2,.application-card h2{color:color-mix(in srgb,var(--form-accent) 76%,#172923)}
        .requirement-list li:before{color:var(--form-accent);background:color-mix(in srgb,var(--form-accent) 12%,white)}
        .process-note{border-color:#f0dfc8;background:linear-gradient(120deg,#fff1df,#f5efff 56%,#edf7e9)}
        .form-section-title{color:color-mix(in srgb,var(--form-accent) 74%,#172923)}
        .form-section-title span{color:var(--form-accent);background:color-mix(in srgb,var(--form-accent) 12%,white)}
        .form-field input,.form-field select,.form-field textarea{border-color:color-mix(in srgb,var(--form-accent) 19%,#e7e8ec);background:linear-gradient(135deg,#fbfdff,color-mix(in srgb,var(--form-accent) 4%,white));accent-color:var(--form-accent)}
        .form-field input:focus,.form-field select:focus,.form-field textarea:focus{outline-color:color-mix(in srgb,var(--form-accent) 24%,transparent);border-color:color-mix(in srgb,var(--form-accent) 55%,white)}
        .back-link{color:var(--service-accent,#28705a)}
        .form-notice{border:1px solid #f1dfb9;background:linear-gradient(110deg,#fff4d9,#fff0eb);color:#76552f}
        .tracking-hero{border-color:#d9e3fb;background:linear-gradient(115deg,#f1f6ff 0%,#f8f2ff 55%,#fff4e8 100%)}
        .tracking-hero h1{color:#315fa2}
        .tracking-hero .eyebrow{color:#8a5ab1}
        .tracking-hero .eyebrow-mark{background:linear-gradient(90deg,#9b67d2,#edaa6f)}
        .tracking-status{border-color:#cfe7d1;color:#286848;background:linear-gradient(110deg,#e7f8e7,#eff8db)}
        .tracking-code{border-color:#d9def2;background:linear-gradient(110deg,#fff,#f5f0ff)}
        .tracking-code strong{color:#4d50a6}
        .tracking-detail:nth-child(4n+1){background:linear-gradient(130deg,#edfaf2,#fff)}
        .tracking-detail:nth-child(4n+2){background:linear-gradient(130deg,#eff4ff,#fff)}
        .tracking-detail:nth-child(4n+3){background:linear-gradient(130deg,#fff4e9,#fff)}
        .tracking-detail:nth-child(4n){background:linear-gradient(130deg,#f8efff,#fff)}
        .tracking-next{border-color:#e7dfc9;background:linear-gradient(115deg,#fff5df,#f4f0ff 62%,#eaf6e9)}
        .button-secondary{border-color:#d9def2;background:linear-gradient(110deg,#fff,#f3f0ff)}
        @media(max-width:720px){.brand-mark{width:38px;height:44px}}
        @media(max-width:440px){.brand-mark{width:34px;height:40px}}
        @media(max-width:720px){
            html{scroll-padding-top:116px}
            .wrap{width:calc(100% - 32px)}
            .header-inner{min-height:0;display:grid;grid-template-columns:minmax(0,1fr);gap:7px;padding-block:8px}
            .brand{min-width:0;gap:9px;font-size:11px;line-height:1.3}
            .brand>span:last-child{min-width:0}
            .brand small{font-size:10px}
            .brand-mark{width:36px;height:42px}
            .main-nav{width:100%;display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:4px}
            .main-nav a,.main-nav .nav-cta{min-width:0;min-height:37px;display:flex;align-items:center;justify-content:center;gap:3px;padding:7px 3px;border-radius:10px;font-size:10px;line-height:1.2;text-align:center;white-space:nowrap}
            .main-nav a:not(.nav-cta){background:#f1f3f8}
            .main-nav .nav-cta{box-shadow:0 5px 12px rgba(56,97,170,.16)}
            .main-nav .nav-cta .nav-label{font-size:0}
            .main-nav .nav-cta .nav-label:before{content:"Ajukan";font-size:10px}
            .home-hero{min-height:0;grid-template-columns:minmax(0,1fr);gap:0;padding-block:32px 27px}
            .hero-copy{padding:0}
            .eyebrow{gap:7px;margin-bottom:12px;font-size:9px;letter-spacing:.11em}
            h1{max-width:100%;margin-bottom:13px;font-size:clamp(35px,9vw,43px);line-height:1.08;letter-spacing:-.065em}
            .home-hero h1 br{display:none}
            .lead{font-size:14px;line-height:1.65}
            .hero-actions{display:grid;grid-template-columns:minmax(0,1fr);gap:10px;margin-top:19px}
            .hero-actions .button{width:100%;min-height:47px}
            .hero-actions .text-link{padding:5px;text-align:center}
            .hero-proof{margin-top:15px;font-size:11px}
            .hero-art{height:222px;margin-top:3px}
            .hero-document{width:min(255px,72%);height:174px;padding:16px 19px;border-radius:20px}
            .hero-document-seal{left:19px;bottom:30px;width:49px;height:56px;font-size:23px}
            .hero-document-lines{left:83px;bottom:48px;width:105px;gap:8px}
            .hero-document-lines i{height:6px}
            .hero-document-bottom{right:18px;bottom:13px;left:18px}
            .art-orbit{width:min(290px,90%);height:155px}
            .art-orbit-two{width:min(260px,84%);height:165px}
            .hero-glow{width:265px;height:205px}
            .chip-top{top:9px;right:0}
            .chip-bottom{bottom:7px;left:0}
            .art-chip{gap:7px;padding:8px 10px;font-size:9px}
            .art-chip b{font-size:9px}
            .art-chip>span:first-child{width:25px;height:25px}
            .section-pad{padding-block:43px}
            .section-heading{gap:7px;margin-bottom:17px}
            .section-heading .eyebrow{margin-bottom:8px}
            .section-heading h2{font-size:29px}
            .section-heading>p{font-size:12px;line-height:1.6}
            .service-grid{grid-template-columns:minmax(0,1fr);gap:11px}
            .service-card{display:grid;grid-template-columns:96px minmax(0,1fr);min-height:137px;border-radius:15px}
            .service-card-art{height:100%;min-height:137px}
            .service-card-art:before{width:84px;height:84px;box-shadow:0 0 0 11px color-mix(in srgb,var(--accent) 4%,transparent),0 0 0 22px color-mix(in srgb,var(--accent) 3%,transparent)}
            .service-art-orbit{width:132px;height:68px}
            .service-art-sheet{width:63px;height:72px;padding:8px;border-radius:10px}
            .service-art-icon{width:23px;height:23px;margin-bottom:7px;border-radius:7px;font-size:7px}
            .service-art-line{height:3px;margin-top:5px}
            .line-long{width:38px}.line-short{width:27px}
            .service-art-stamp{right:6px;bottom:7px;width:15px;height:15px;font-size:8px}
            .service-art-spark{top:17px;right:13%;font-size:12px}
            .service-card-copy{min-width:0;align-self:center;padding:12px 13px}
            .service-card-kicker{font-size:8px}
            .service-card h3{margin:3px 0 4px;font-size:15px;line-height:1.3}
            .service-card p{min-height:0;display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:2;font-size:10px;line-height:1.5}
            .card-link{margin-top:8px;padding-top:7px;font-size:10px}
            .steps-section{padding-block:43px}
            .steps-grid{gap:9px}
            .step-card{display:grid;grid-template-columns:34px minmax(0,1fr);column-gap:10px;align-items:center;padding:13px}
            .step-number{grid-row:span 2}
            .step-card h3{margin:0;font-size:14px}
            .step-card p{font-size:11px;line-height:1.5}
            .contact-section{padding-top:0;padding-bottom:42px}
            .contact-panel{gap:17px;padding:21px 18px;border-radius:18px}
            .contact-panel h2{font-size:25px}
            .contact-panel>div:first-child>p:last-child{font-size:12px;line-height:1.6}
            .contact-side{gap:9px;padding-top:14px}
            .contact-side a{display:grid;gap:2px;font-size:11px}
            .site-footer{padding-block:17px;font-size:10px;line-height:1.55}
            .site-footer .wrap{gap:9px}
            .service-hero{grid-template-columns:minmax(0,1fr);gap:0;margin-top:14px;padding:19px 17px 5px;border-radius:20px}
            .breadcrumb{flex-wrap:wrap;gap:6px;margin-bottom:15px;font-size:10px}
            .service-hero .eyebrow{font-size:9px}
            .service-hero h1{margin-bottom:9px;font-size:clamp(34px,9vw,41px);line-height:1.08}
            .service-hero-copy>.lead{font-size:13px;line-height:1.6}
            .service-meta{display:grid;grid-template-columns:minmax(0,1fr);gap:7px;margin-top:13px}
            .meta-pill{padding:8px 9px;font-size:10px;line-height:1.4}
            .service-hero .hero-actions{grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:8px;margin-top:14px}
            .service-hero .hero-actions .button{min-height:43px;padding-inline:8px;font-size:11px}
            .service-hero .hero-actions .text-link{font-size:10px}
            .service-scene{height:158px}
            .service-document{width:160px;height:127px;padding:13px;border-radius:15px}
            .service-document-icon{width:39px;height:39px;margin-top:14px;border-radius:11px;font-size:10px}
            .service-document-lines{top:58px;left:65px;width:72px;gap:6px}
            .service-document-lines i{height:4px}
            .service-document-stamp{right:11px;bottom:10px;width:21px;height:21px;font-size:11px}
            .service-scene-orbit{width:240px;height:125px}
            .scene-float{right:1%;bottom:2px;padding:7px 9px;font-size:8px}
            .service-content{grid-template-columns:minmax(0,1fr);gap:12px;margin-top:13px;margin-bottom:45px}
            .content-main{gap:11px}
            .application-card{position:static;grid-row:auto;padding:18px 15px}
            .content-main{grid-row:auto}
            .info-card{padding:17px 15px;border-radius:16px}
            .info-card h2,.application-card h2{font-size:19px}
            .card-intro{margin-bottom:13px;font-size:11px;line-height:1.55}
            .requirement-list{gap:8px}
            .requirement-list li{gap:8px;font-size:11px;line-height:1.5}
            .requirement-list li:before{width:18px;height:18px;flex-basis:18px}
            .process-note{padding:15px;border-radius:14px}
            .process-note p{font-size:11px;line-height:1.55}
            .track-card{padding:15px;border-radius:14px}
            .application-card>p{font-size:12px}
            .form-section-title{margin:17px 0 9px;font-size:12px}
            .form-stack{gap:12px}
            .form-grid{grid-template-columns:minmax(0,1fr);gap:12px}
            .form-field label,.consent{font-size:12px}
            .form-field input,.form-field select,.form-field textarea{min-height:46px;margin-top:6px;padding:11px 12px;border-radius:11px;font-size:16px}
            .form-field input[type=file]{min-height:46px;padding:10px;font-size:12px}
            .form-field textarea{min-height:84px}
            .field-hint{font-size:10px;line-height:1.45}
            .field-error{font-size:11px}
            .form-notice{padding:12px;font-size:11px;line-height:1.55}
            .consent{gap:9px;line-height:1.5}
            .consent input{width:18px;height:18px;flex:none}
            .button-submit{min-height:49px;font-size:13px}
            .tracking-page{padding-block:24px 44px}
            .tracking-hero{padding:20px 16px;border-radius:19px}
            .tracking-hero h1{font-size:34px}
            .tracking-hero>p:last-child{font-size:12px;line-height:1.6}
            .tracking-code{margin-top:14px;padding:11px}
            .tracking-code strong{font-size:11px}
            .tracking-details{grid-template-columns:minmax(0,1fr);gap:8px;margin-top:10px}
            .tracking-detail{padding:12px 14px}
            .tracking-next{padding:16px;margin-top:11px}
            .tracking-next p{font-size:11px;line-height:1.55}
            .tracking-actions{display:grid;grid-template-columns:minmax(0,1fr);gap:9px;margin-top:14px}
            .tracking-actions .button{width:100%;min-height:45px}
        }
        @media(max-width:380px){
            .wrap{width:calc(100% - 26px)}
            .header-inner{gap:5px}
            .brand{font-size:10px}
            .brand-mark{width:32px;height:38px}
            .brand small{font-size:9px}
            .main-nav{gap:3px}
            .main-nav a,.main-nav .nav-cta{font-size:9px}
            .main-nav .nav-cta .nav-label:before{font-size:9px}
            .home-hero{padding-top:25px}
            .hero-art{height:204px}
            .art-chip{padding:7px 8px}
            .service-card{grid-template-columns:83px minmax(0,1fr);min-height:130px}
            .service-card-art{min-height:130px}
            .service-card-copy{padding:10px}
            .service-card h3{font-size:14px}
            .service-card p{font-size:9px}
            .service-hero .hero-actions{grid-template-columns:minmax(0,1fr)}
        }
        @media(max-width:720px){
            body{font-size:15px}
            .brand{font-size:12px}
            .brand small{font-size:11px}
            .main-nav a,.main-nav .nav-cta{font-size:11px}
            .main-nav .nav-cta .nav-label:before{font-size:11px}
            .eyebrow{font-size:10px;line-height:1.45;letter-spacing:.09em}
            .home-hero h1{font-size:clamp(36px,9.8vw,41px);line-height:1.1}
            .home-hero .lead{font-size:15px;line-height:1.65}
            .hero-actions .text-link{font-size:13px}
            .hero-proof{font-size:12px;line-height:1.5}
            .section-heading h2{font-size:30px;line-height:1.2}
            .section-heading>p{font-size:13px;line-height:1.65}
            .service-card-kicker{font-size:9px}
            .service-card h3{font-size:16px;line-height:1.35}
            .service-card p{font-size:12px;line-height:1.5}
            .card-link{font-size:11px}
            .step-card h3{font-size:15px}
            .step-card p{font-size:12px;line-height:1.55}
            .contact-panel h2{font-size:27px}
            .contact-panel>div:first-child>p:last-child{font-size:13px;line-height:1.65}
            .contact-side>span,.contact-side a{font-size:12px}
            .site-footer{font-size:11px;line-height:1.6}
            .service-hero .eyebrow{font-size:10px}
            .service-hero h1{font-size:clamp(36px,9.8vw,42px);line-height:1.1}
            .service-hero-copy>.lead{font-size:14px;line-height:1.65}
            .meta-pill{font-size:11px;line-height:1.5}
            .service-hero .hero-actions .button,.service-hero .hero-actions .text-link{font-size:12px}
            .info-card h2,.application-card h2{font-size:21px;line-height:1.3}
            .card-intro{font-size:13px;line-height:1.6}
            .requirement-list li{font-size:13px;line-height:1.55}
            .process-note strong{font-size:15px}
            .process-note p,.track-card p{font-size:12px;line-height:1.6}
            .application-card>p{font-size:13px;line-height:1.6}
            .form-section-title{font-size:13px}
            .form-field label,.consent{font-size:13px}
            .form-field input[type=file]{font-size:13px}
            .field-hint{font-size:11px;line-height:1.5}
            .field-error,.form-notice{font-size:12px;line-height:1.55}
            .button-submit{font-size:14px}
            .tracking-hero h1{font-size:clamp(35px,9vw,39px);line-height:1.12}
            .tracking-hero>p:last-child,.tracking-next p{font-size:13px;line-height:1.65}
            .tracking-code span,.tracking-detail span{font-size:11px}
            .tracking-code strong{font-size:12px}
            .tracking-detail strong{font-size:14px;line-height:1.45}
            .tracking-next h2{font-size:17px}
            .tracking-actions .button{font-size:13px}
        }
        @media(max-width:380px){
            .brand{font-size:11px}
            .brand small{font-size:10px}
            .main-nav a,.main-nav .nav-cta{font-size:10px}
            .main-nav .nav-cta .nav-label:before{font-size:10px}
            .home-hero h1,.service-hero h1{font-size:34px}
            .service-card h3{font-size:15px}
            .service-card p{font-size:11px}
        }
        .home-hero{margin-block:28px 38px;padding-inline:clamp(22px,4vw,48px);overflow:hidden;border:1px solid #e3e3f3;border-radius:30px;background:linear-gradient(118deg,#ffebca 0%,#e1efff 38%,#f1e3ff 70%,#def5e8 100%);box-shadow:0 22px 55px rgba(89,75,157,.14)}
        .home-hero:before{background:radial-gradient(circle,rgba(255,162,91,.4),rgba(255,175,112,0) 70%)}
        .home-hero:after{position:absolute;bottom:-140px;left:-105px;width:290px;height:290px;border-radius:50%;background:radial-gradient(circle,rgba(71,190,151,.28),transparent 70%);content:"";pointer-events:none}
        .home-hero .hero-copy,.home-hero .hero-art{z-index:1}
        .home-hero h1{font-size:clamp(40px,4.4vw,56px);line-height:1.1;letter-spacing:-.065em}
        .home-hero h1 span{color:#267d68}
        .home-hero .eyebrow{width:fit-content;padding:7px 11px;border:1px solid rgba(221,147,74,.2);border-radius:999px;background:rgba(255,255,255,.66)}
        .hero-proof{width:fit-content;padding:8px 12px;border:1px solid rgba(74,153,132,.18);border-radius:999px;background:rgba(255,255,255,.72);color:#47665c}
        .services-section{background:linear-gradient(135deg,#e4f0ff 0%,#fff0d8 38%,#f0e4ff 72%,#e1f6ec 100%);border-color:#e2e0ef}
        .service-card{border:1px solid color-mix(in srgb,var(--accent) 29%,white);border-top:4px solid var(--accent);background:linear-gradient(150deg,#fff 60%,color-mix(in srgb,var(--accent) 8%,white));box-shadow:0 12px 30px color-mix(in srgb,var(--accent) 17%,transparent)}
        .service-card:hover{border-color:color-mix(in srgb,var(--accent) 56%,white);box-shadow:0 22px 42px color-mix(in srgb,var(--accent) 26%,transparent)}
        .service-card-art{background:linear-gradient(145deg,color-mix(in srgb,var(--accent) 33%,white),color-mix(in srgb,var(--accent) 15%,#fff1d8))}
        .service-card-art:before{border-color:color-mix(in srgb,var(--accent) 39%,transparent);box-shadow:0 0 0 17px color-mix(in srgb,var(--accent) 9%,transparent),0 0 0 35px color-mix(in srgb,var(--accent) 6%,transparent)}
        .service-art-icon{background:linear-gradient(145deg,color-mix(in srgb,var(--accent) 72%,white),var(--accent))}
        .service-card-kicker{display:inline-block;padding:4px 7px;border-radius:999px;color:color-mix(in srgb,var(--accent) 78%,#172923);background:color-mix(in srgb,var(--accent) 12%,white)}
        .card-link{border-color:color-mix(in srgb,var(--accent) 19%,white);color:color-mix(in srgb,var(--accent) 78%,#172923)}
        .step-card{border-color:#e3e0f0;box-shadow:0 12px 30px rgba(65,78,125,.11)}
        .step-card:nth-child(1){border-top:4px solid #35a979;background:linear-gradient(145deg,#d5f4e2,#f5fff7 78%)}
        .step-card:nth-child(2){border-top:4px solid #5b7de0;background:linear-gradient(145deg,#dfe8ff,#f7f8ff 78%)}
        .step-card:nth-child(3){border-top:4px solid #d36c9b;background:linear-gradient(145deg,#ffe0ed,#fff7fa 78%)}
        .step-card:nth-child(1) .step-number{color:#fff;background:linear-gradient(145deg,#46b985,#21805f)}
        .step-card:nth-child(2) .step-number{color:#fff;background:linear-gradient(145deg,#7196ed,#4967bd)}
        .step-card:nth-child(3) .step-number{color:#fff;background:linear-gradient(145deg,#e58bb2,#b95683)}
        .contact-panel{border-color:#e7d8f1;background:linear-gradient(115deg,#ffe8c8 0%,#f0e3ff 48%,#dcf5e9 100%);box-shadow:0 22px 55px rgba(91,75,146,.13)}
        .contact-panel .eyebrow{color:#8652a4}
        .contact-panel .eyebrow-mark{background:linear-gradient(90deg,#e58c54,#b375dc)}
        .contact-side{border-color:rgba(126,95,154,.25)}
        .contact-side>span{width:fit-content;padding:5px 9px;border-radius:999px;color:#795197;background:rgba(255,255,255,.66)}
        .contact-side a:first-of-type strong{color:#247d5e}
        .contact-side a:last-of-type strong{color:#6955ba}
        .hero-document-image{display:block;width:min(390px,88%);height:auto;aspect-ratio:738/415;padding:0;border:1px solid rgba(255,255,255,.8);background:transparent;object-fit:cover}
        .service-card-ktp,.service-card-family,.service-card-birth,.service-card-death,.service-card-move,.service-card-kia{position:relative;isolation:isolate;background:#78b6e8}
        .service-card-background{position:absolute;inset:0;z-index:-1;width:100%;height:100%;object-fit:cover;object-position:center;filter:saturate(1.55) contrast(1.06) brightness(1.04);transition:filter .25s ease}
        .service-card:hover .service-card-background{filter:saturate(1.72) contrast(1.08) brightness(1.06)}
        .service-card-ktp .service-card-art,.service-card-family .service-card-art,.service-card-birth .service-card-art,.service-card-death .service-card-art,.service-card-move .service-card-art,.service-card-kia .service-card-art{display:none}
        .service-card-ktp .service-card-copy,.service-card-family .service-card-copy,.service-card-birth .service-card-copy,.service-card-death .service-card-copy,.service-card-move .service-card-copy,.service-card-kia .service-card-copy{position:relative;z-index:1;background:linear-gradient(135deg,color-mix(in srgb,var(--accent) 18%,rgba(255,255,255,.38)),rgba(255,255,255,.32));text-shadow:0 1px 3px rgba(255,255,255,.98),0 0 10px rgba(255,255,255,.9)}
        @media(max-width:720px){
            .home-hero{margin-block:14px 27px;padding-inline:22px;border-radius:23px}
            .home-hero h1{font-size:clamp(31px,8.6vw,36px);line-height:1.13;letter-spacing:-.06em}
            .hero-copy{min-width:0}
            .hero-art{width:100%;height:clamp(205px,58vw,245px);margin-top:8px}
            .hero-document-image{width:min(300px,86%);height:auto}
            .art-chip{max-width:48%;font-size:9px}
            .services-section .wrap,.steps-section .wrap{min-width:0}
            .service-card{grid-template-columns:84px minmax(0,1fr);min-height:132px;transform:translateY(0);transition:transform .25s ease,box-shadow .25s ease}
            .service-card:hover{transform:translateY(-4px)}
            .service-card-art{min-height:132px}
            .service-card-copy{min-width:0;padding:12px}
            .service-card-ktp,.service-card-family,.service-card-birth,.service-card-death,.service-card-move,.service-card-kia{display:block;min-height:180px}
            .service-card-ktp .service-card-copy,.service-card-family .service-card-copy,.service-card-birth .service-card-copy,.service-card-death .service-card-copy,.service-card-move .service-card-copy,.service-card-kia .service-card-copy{min-height:180px;display:flex;flex-direction:column;justify-content:flex-end;background:linear-gradient(0deg,rgba(255,255,255,.72) 0%,rgba(255,255,255,.48) 48%,rgba(255,255,255,.08) 100%)}
            .service-card h3,.service-card p{overflow-wrap:anywhere}
            .step-card{grid-template-columns:38px minmax(0,1fr);align-items:start}
            .step-number{grid-row:1 / span 2;align-self:center}
            .step-card p{min-width:0}
            .contact-side a{min-width:0;overflow-wrap:anywhere}
            .contact-side strong{overflow-wrap:anywhere}
        }
        @media(max-width:440px){
            .home-hero{padding-inline:17px}
            .home-hero h1{font-size:clamp(30px,8.4vw,34px)}
            .service-card{grid-template-columns:76px minmax(0,1fr);min-height:126px}
            .service-card-art{min-height:126px}
            .service-card-copy{padding:10px}
            .service-card-ktp,.service-card-ktp .service-card-copy,.service-card-family,.service-card-family .service-card-copy,.service-card-birth,.service-card-birth .service-card-copy,.service-card-death,.service-card-death .service-card-copy,.service-card-move,.service-card-move .service-card-copy,.service-card-kia,.service-card-kia .service-card-copy{min-height:170px}
            .service-card h3{font-size:14px}
            .service-card p{font-size:11px;line-height:1.45}
            .art-chip{max-width:50%;padding:7px 8px}
        }
        @media(max-width:360px){.home-hero h1{font-size:30px}}
        :root{--muted:#53635b}
        .brand small,.main-nav a,.hero-proof,.section-heading>p,.service-card p,.step-card p,.contact-panel>div:first-child>p:last-child,.contact-side>span,.contact-side a,.site-footer,.breadcrumb,.meta-pill,.scene-float,.card-intro,.requirement-list li,.process-note p,.application-card>p,.form-field label,.consent,.field-hint,.tracking-hero>p:last-child,.tracking-code span,.tracking-detail span,.tracking-next p,.track-card p{color:#4b5a52}
        .main-nav a,.button,.text-link,.contact-side a,.contact-panel>div:first-child>p:last-child,.section-heading>p,.service-card p,.step-card p,.lead,.service-hero-copy>.lead,.card-intro,.requirement-list li,.process-note p,.application-card>p,.consent,.tracking-hero>p:last-child,.tracking-next p,.track-card p{font-size:14px}
        .eyebrow{font-size:12px}
        .hero-proof{font-size:13px}
        .service-card-kicker{font-size:11px}
        .card-link{font-size:13px}
        .step-card h3{font-size:17px}
        .contact-side>span,.contact-side a{font-size:13px}
        .site-footer{font-size:12px}
        .breadcrumb,.meta-pill{font-size:12px}
        .scene-float{font-size:12px}
        .form-section-title,.form-field label,.consent{font-size:13px}
        .form-field label>span,.field-hint{color:#53635b;font-size:12px}
        .field-error,.form-notice{font-size:13px}
        .tracking-status,.tracking-code span,.tracking-detail span{font-size:12px}
        .tracking-code strong,.tracking-detail strong{font-size:14px}
        .tracking-next h2{font-size:18px}
        .service-card-ktp .service-card-copy,.service-card-family .service-card-copy,.service-card-birth .service-card-copy,.service-card-death .service-card-copy,.service-card-move .service-card-copy,.service-card-kia .service-card-copy{background:linear-gradient(135deg,color-mix(in srgb,var(--accent) 18%,rgba(255,255,255,.38)),rgba(255,255,255,.32))}
        @media(max-width:720px){
            .main-nav a,.button,.text-link{font-size:13px}
            .brand small,.eyebrow{font-size:12px}
            .service-card h3{font-size:16px}
            .service-card p,.step-card p,.section-heading>p,.contact-panel>div:first-child>p:last-child{font-size:14px;line-height:1.55}
            .service-card-kicker{font-size:11px}
            .card-link{font-size:13px}
            .site-footer{font-size:12px}
            .service-card-ktp .service-card-copy,.service-card-family .service-card-copy,.service-card-birth .service-card-copy,.service-card-death .service-card-copy,.service-card-move .service-card-copy,.service-card-kia .service-card-copy{background:linear-gradient(0deg,rgba(255,255,255,.76) 0%,color-mix(in srgb,var(--accent) 18%,rgba(255,255,255,.46)) 58%,rgba(255,255,255,.1) 100%)}
            .form-field input,.form-field select,.form-field textarea{font-size:16px}
        }
        .service-scene-ktp{min-height:280px;overflow:hidden}
        .service-document-image{position:relative;z-index:1;display:block;width:min(100%,370px);height:auto;aspect-ratio:564/354;border:5px solid rgba(255,255,255,.9);border-radius:22px;object-fit:cover;box-shadow:0 25px 48px rgba(42,76,128,.24);transform:rotate(-3deg)}
        .service-scene-ktp .service-scene-glow{width:320px;height:245px;background:radial-gradient(ellipse,rgba(89,164,231,.42),rgba(221,195,255,.24) 55%,transparent 76%)}
        .service-scene-ktp .service-scene-orbit{border-color:rgba(55,113,190,.26)}
        .service-scene-ktp .scene-float{bottom:2px}
        @media(max-width:720px){
            .service-scene-ktp{height:auto;min-height:225px;margin-top:8px}
            .service-document-image{width:min(100%,340px);border-width:4px;border-radius:17px}
            .service-scene-ktp .service-scene-glow{width:260px;height:180px}
            .service-scene-ktp .scene-float{right:0;bottom:-2px}
            .service-content{grid-template-columns:minmax(0,1fr)}
            .service-hero{gap:8px}
            .service-hero-copy .breadcrumb{margin-bottom:16px}
            .service-meta{gap:8px}
            .meta-pill{line-height:1.5}
            .info-card h2,.application-card h2{line-height:1.25}
            .application-card{padding:20px 17px}
            .form-section-title{margin-top:20px}
        }
        @media(max-width:380px){
            .service-scene-ktp{min-height:190px}
            .service-document-image{width:94%}
        }
        .service-page-ktp{--service-accent:#2869b4}
        .service-page-ktp .service-hero{border-color:#bdd9f5;background:linear-gradient(120deg,#e4f4ff 0%,#f0edff 55%,#fff1df 100%);box-shadow:0 24px 60px rgba(51,94,157,.15)}
        .service-page-ktp .service-hero:after{background:radial-gradient(circle,rgba(89,169,234,.34),rgba(170,139,239,.18) 48%,transparent 70%)}
        .service-page-ktp .breadcrumb{color:#435a76;font-size:13px}
        .service-page-ktp .breadcrumb a,.service-page-ktp .service-hero .eyebrow{color:#245fa5}
        .service-page-ktp .service-hero .eyebrow{font-size:13px}
        .service-page-ktp .service-hero h1{color:#163e70;font-size:clamp(44px,5vw,60px);letter-spacing:-.06em}
        .service-page-ktp .service-hero-copy>.lead{color:#3f536c;font-size:17px;line-height:1.7}
        .service-page-ktp .meta-pill{border-color:#c8dcf3;background:linear-gradient(120deg,rgba(255,255,255,.96),rgba(226,241,255,.92));color:#304d6c;font-size:13px;box-shadow:0 5px 14px rgba(57,103,163,.08)}
        .service-page-ktp .meta-pill b{color:#256ab7}
        .service-page-ktp .service-hero .button-primary{background:linear-gradient(120deg,#187f9e,#2865bc 58%,#6653c7);box-shadow:0 12px 23px rgba(47,94,170,.24)}
        .service-page-ktp .service-hero .text-link,.service-page-ktp .service-hero .text-link span{color:#285fa7}
        .service-page-ktp .service-scene-ktp{perspective:1100px}
        .service-page-ktp .service-document-image{border:6px solid rgba(255,255,255,.95);box-shadow:0 35px 55px rgba(32,75,134,.28),0 12px 24px rgba(101,78,186,.18),inset 0 1px 0 white;transform:rotateY(-13deg) rotateX(7deg) rotateZ(-4deg);animation:ktp-float 5s ease-in-out infinite;transition:transform .35s,box-shadow .35s}
        .service-page-ktp .service-document-image:hover{transform:rotateY(-5deg) rotateX(3deg) rotateZ(-1deg) translateY(-5px);box-shadow:0 42px 62px rgba(32,75,134,.32),0 16px 27px rgba(101,78,186,.22)}
        .service-page-ktp .service-scene-ktp:before,.service-page-ktp .service-scene-ktp:after{position:absolute;z-index:0;content:"";border-radius:50%;pointer-events:none}
        .service-page-ktp .service-scene-ktp:before{width:min(88%,330px);height:160px;border:1px solid rgba(47,117,191,.28);box-shadow:0 0 0 14px rgba(90,151,219,.08),0 0 0 29px rgba(127,105,209,.06);transform:rotateX(68deg) rotateZ(-22deg)}
        .service-page-ktp .service-scene-ktp:after{top:13%;right:9%;width:16px;height:16px;background:linear-gradient(145deg,#ffd16e,#ed8d8c);box-shadow:0 7px 16px rgba(197,124,89,.28);transform:rotate(45deg)}
        .service-page-ktp .service-scene-ktp .scene-float{border-color:#d7e5f8;color:#244d7d;background:linear-gradient(115deg,#fff,#e9f4ff);font-size:13px;box-shadow:0 12px 26px rgba(38,85,146,.16)}
        .service-page-ktp .info-card,.service-page-ktp .application-card{border-color:#d2e2f3;background:linear-gradient(150deg,#fff 58%,#f1f7ff);box-shadow:0 14px 34px rgba(43,82,139,.09)}
        .service-page-ktp .info-card h2,.service-page-ktp .application-card h2{color:#1c4778;font-size:24px}
        .service-page-ktp .card-intro,.service-page-ktp .application-card>p{color:#435971;font-size:15px;line-height:1.6}
        .service-page-ktp .requirement-list li{color:#2f4359;font-size:15px;line-height:1.55}
        .service-page-ktp .requirement-list li:before{color:#fff;background:linear-gradient(145deg,#38a5aa,#386ec0);box-shadow:0 3px 8px rgba(56,110,192,.2)}
        .service-page-ktp .process-note{border-color:#c8def2;background:linear-gradient(120deg,#e3f5ff,#eee9ff 58%,#fff1df)}
        .service-page-ktp .process-note strong,.service-page-ktp .track-card strong{color:#1d4f83;font-size:17px}
        .service-page-ktp .process-note p,.service-page-ktp .track-card p{color:#3d536b;font-size:14px;line-height:1.65}
        .service-page-ktp .track-card{border-color:#d3e2f2;background:linear-gradient(135deg,#fff,#eef6ff);box-shadow:0 10px 26px rgba(43,82,139,.08)}
        .service-page-ktp .back-link{color:#285fa7;font-size:13px}
        .service-page-ktp .form-section-title{color:#264d7a;font-size:14px}
        .service-page-ktp .form-section-title span{color:#fff;background:linear-gradient(145deg,#34a1a6,#4f64c2);box-shadow:0 4px 10px rgba(67,105,185,.2)}
        .service-page-ktp .form-field label,.service-page-ktp .consent{color:#30465e;font-size:14px}
        .service-page-ktp .form-field label>span,.service-page-ktp .field-hint{color:#50647b;font-size:13px}
        .service-page-ktp .form-field input,.service-page-ktp .form-field select,.service-page-ktp .form-field textarea{border-color:#c9d9ed;background:linear-gradient(135deg,#fff,#f3f8ff);color:#203852;font-size:14px}
        .service-page-ktp .form-field input:focus,.service-page-ktp .form-field select:focus,.service-page-ktp .form-field textarea:focus{outline:3px solid rgba(57,119,194,.18);border-color:#528bc8}
        .service-page-ktp .consent input{accent-color:#2869b4}
        .service-page-ktp .form-notice{border:1px solid #efc58d;background:linear-gradient(110deg,#fff3d9,#ffebe6);color:#68461f;font-size:14px}
        .service-page-ktp .button-submit{background:linear-gradient(115deg,#168b91,#2865bc 60%,#6653c7);box-shadow:0 10px 22px rgba(46,99,174,.22)}
        @keyframes ktp-float{0%,100%{translate:0 0}50%{translate:0 -9px}}
        @media(max-width:720px){
            .service-page-ktp .service-hero h1{font-size:clamp(36px,9vw,43px)}
            .service-page-ktp .service-hero-copy>.lead{font-size:16px}
            .service-page-ktp .service-hero .eyebrow{font-size:12px}
            .service-page-ktp .meta-pill{font-size:13px}
            .service-page-ktp .service-document-image{border-width:4px}
            .service-page-ktp .info-card h2,.service-page-ktp .application-card h2{font-size:22px}
            .service-page-ktp .card-intro,.service-page-ktp .application-card>p,.service-page-ktp .requirement-list li{font-size:14px}
            .service-page-ktp .form-field input,.service-page-ktp .form-field select,.service-page-ktp .form-field textarea{font-size:16px}
        }
        @media(prefers-reduced-motion:reduce){.service-page-ktp .service-document-image{animation:none}}
        .service-document-image-secondary{width:min(100%,390px);max-height:245px;aspect-ratio:auto;border:0;border-radius:12px;object-fit:contain;filter:drop-shadow(0 18px 22px rgba(35,62,94,.2));transform:none}
        @media(max-width:720px){.service-document-image-secondary{width:min(100%,340px);max-height:205px}}
        @media(max-width:720px){
            .tracking-page{width:min(calc(100% - 32px),560px);padding-block:28px 42px}
            .tracking-page .back-link{min-height:40px;display:inline-flex;align-items:center;font-size:13px}
            .tracking-hero{padding:clamp(18px,5vw,24px);border-radius:20px}
            .tracking-hero h1{font-size:clamp(30px,8.5vw,37px);line-height:1.12;letter-spacing:-.065em}
            .tracking-hero>p:last-child{font-size:14px;line-height:1.65}
            .tracking-status{margin-bottom:13px;font-size:12px}
            .tracking-code{align-items:flex-start;gap:8px;padding:12px}
            .tracking-code>div{min-width:0}
            .tracking-code span{font-size:11px;line-height:1.4}
            .tracking-code strong{font-size:clamp(12px,3.7vw,15px);line-height:1.5;overflow-wrap:anywhere}
            .tracking-details{gap:9px;margin-top:12px}
            .tracking-detail{min-width:0;padding:14px}
            .tracking-detail span{font-size:12px;line-height:1.4}
            .tracking-detail strong{font-size:15px;line-height:1.5;overflow-wrap:anywhere}
            .tracking-next{margin-top:12px;padding:17px}
            .tracking-next h2{font-size:19px;line-height:1.3}
            .tracking-next p{font-size:14px;line-height:1.65}
            .tracking-actions{display:grid;grid-template-columns:minmax(0,1fr);gap:10px;margin-top:16px}
            .tracking-actions .button{width:100%;min-height:48px;padding-inline:16px;font-size:14px}
        }
        @media(min-width:521px) and (max-width:720px){
            .tracking-details{grid-template-columns:repeat(2,minmax(0,1fr))}
        }
        @media(max-width:380px){
            .tracking-page{width:calc(100% - 28px)}
            .tracking-hero{padding:17px}
            .tracking-hero h1{font-size:clamp(28px,9vw,33px)}
            .tracking-detail{padding:13px}
        }
        .tracking-page .back-link{font-size:14px;line-height:1.5}
        .tracking-hero{border-color:#bfd7ed;background:linear-gradient(125deg,#dff2fb 0%,#e7e5fb 52%,#ffedda 100%);box-shadow:0 18px 42px rgba(55,88,145,.13)}
        .tracking-hero:after{border-color:rgba(69,111,175,.2);box-shadow:0 0 0 18px rgba(69,111,175,.055),0 0 0 38px rgba(142,94,177,.045)}
        .tracking-hero .eyebrow{color:#405d8d;font-size:13px}
        .tracking-hero h1{color:#203d68;font-size:clamp(34px,4.5vw,42px);line-height:1.15}
        .tracking-hero>p:last-child{color:#3f536d;font-size:16px;line-height:1.65}
        .tracking-status{border-color:#c8c6ee;color:#433c91;background:linear-gradient(110deg,#e7e5ff,#dff3fa);font-size:13px}
        .tracking-status:before{background:#318d70;box-shadow:0 0 0 4px rgba(49,141,112,.16)}
        .tracking-code{border-color:#bdd6ed;background:linear-gradient(110deg,#dceffc,#e9e5fb)}
        .tracking-code span{color:#405c83;font-size:13px;letter-spacing:.06em}
        .tracking-code strong{color:#1f477b;font-size:clamp(15px,2vw,18px);line-height:1.5}
        .tracking-details{gap:14px}
        .tracking-detail{border-color:#d3dfef;background:linear-gradient(145deg,#e7f3fb,#edf0fb);box-shadow:0 7px 18px rgba(55,88,145,.07)}
        .tracking-detail:nth-child(2n){border-color:#e7d6c4;background:linear-gradient(145deg,#fff0df,#f8eafa)}
        .tracking-detail span{color:#425a78;font-size:13px;line-height:1.45}
        .tracking-detail strong{color:#233e62;font-size:16px;line-height:1.55;overflow-wrap:anywhere}
        .tracking-detail:nth-child(2n) strong{color:#63446c}
        .tracking-next{border-color:#dbcdf0;background:linear-gradient(115deg,#e6f2fc,#efe6fb 58%,#fff0dd)}
        .tracking-next h2{color:#354b7c;font-size:21px;line-height:1.3}
        .tracking-next p{color:#3f536d;font-size:15px;line-height:1.7}
        .tracking-actions .button{font-size:14px}
        .tracking-actions .button-secondary{border-color:#bbcde8;color:#294d78;background:linear-gradient(120deg,#e0f1fb,#e9e5fb);box-shadow:0 7px 18px rgba(55,88,145,.1)}
        @media(max-width:720px){
            .tracking-page .back-link{font-size:14px}
            .tracking-hero h1{font-size:clamp(30px,8.5vw,37px)}
            .tracking-hero>p:last-child{font-size:15px}
            .tracking-code span{font-size:12px}
            .tracking-code strong{font-size:clamp(14px,3.7vw,17px)}
            .tracking-detail span{font-size:12px}
            .tracking-detail strong{font-size:15px}
            .tracking-next h2{font-size:20px}
            .tracking-next p{font-size:14px}
        }
        @media(max-width:380px){
            .tracking-hero h1{font-size:clamp(29px,8.5vw,33px)}
            .tracking-detail strong{font-size:14px}
        }
        @media(max-width:720px){
            .main-nav{grid-template-columns:repeat(4,minmax(0,1fr))}
        }
        .tracking-code{flex-wrap:wrap}
        .tracking-code>div{min-width:0}
        .tracking-copy{flex:0 0 auto;padding:9px 12px;border:1px solid #a9c4e4;border-radius:10px;color:#294d78;background:linear-gradient(120deg,#fff,#dceefa);font:700 13px "DM Sans",sans-serif;cursor:pointer}
        .tracking-copy:hover,.tracking-copy:focus-visible{border-color:#718fc6;outline:3px solid rgba(81,119,187,.18)}
        .tracking-copy-feedback{flex-basis:100%;min-height:1.3em;color:#285c4d;font-size:13px}
        .tracking-timeline{margin-top:16px;padding:21px 23px;border:1px solid #cbd8ef;border-radius:17px;background:linear-gradient(120deg,#eaf4fb,#f1eafa 62%,#fff1df)}
        .tracking-timeline h2{margin:0 0 16px;color:#354b7c;font-size:21px;line-height:1.3}
        .tracking-timeline ol{display:grid;gap:0;margin:0;padding:0;list-style:none}
        .tracking-step{position:relative;display:grid;grid-template-columns:32px minmax(0,1fr);gap:12px;min-height:64px}
        .tracking-step:not(:last-child):before{position:absolute;top:30px;bottom:-1px;left:15px;width:2px;background:#a7bddd;content:""}
        .tracking-step-marker{position:relative;z-index:1;width:32px;height:32px;display:grid;place-items:center;border:2px solid #8eacd2;border-radius:50%;color:#fff;background:#527db4;font-size:14px;font-weight:800}
        .tracking-step.is-complete .tracking-step-marker{border-color:#3a9876;background:#3a9876}
        .tracking-step h3{margin:2px 0 3px;color:#29496f;font-size:15px;line-height:1.4}
        .tracking-step p{margin:0;color:#465a72;font-size:14px;line-height:1.55}
        .tracking-step p strong{color:#4d438e}
        .tracking-print{cursor:pointer;font-family:"DM Sans",sans-serif}
        @media(max-width:720px){
            .tracking-timeline{margin-top:12px;padding:17px}
            .tracking-timeline h2{font-size:19px}
            .tracking-step h3{font-size:15px}
            .tracking-step p{font-size:14px}
            .tracking-copy{font-size:12px}
        }
        @media print{
            body:has(.tracking-page){background:#fff!important}
            body:has(.tracking-page) .site-header,
            body:has(.tracking-page) .site-footer,
            .tracking-page>.back-link,
            .tracking-actions{display:none!important}
            body:has(.tracking-page) .tracking-page{width:100%;max-width:none;padding:0;color:#172923}
            .tracking-page .tracking-hero,
            .tracking-page .tracking-timeline,
            .tracking-page .tracking-detail,
            .tracking-page .tracking-next{break-inside:avoid;box-shadow:none;-webkit-print-color-adjust:exact;print-color-adjust:exact}
            .tracking-copy{display:none}
            .tracking-page .tracking-details{grid-template-columns:1fr 1fr}
        }

        :root {
            --paper: #f3f7fc;
            --ink: #172b43;
            --muted: #66788e;
            --line: #dce6f1;
            --green: #1d5fa8;
            --green-dark: #17477d;
            --lime: #c8dcf5;
            --shadow: 0 18px 48px rgba(24, 56, 95, 0.08);
        }

        body {
            background: var(--paper);
            color: var(--ink);
        }

        body:before {
            background:
                radial-gradient(ellipse at 84% 8%, rgba(190, 216, 246, 0.3), transparent 31%),
                radial-gradient(ellipse at 7% 48%, rgba(213, 227, 246, 0.32), transparent 34%),
                radial-gradient(ellipse at 78% 88%, rgba(216, 229, 244, 0.22), transparent 32%);
        }

        .site-header {
            background: rgba(255, 255, 255, 0.9);
            border-bottom-color: rgba(214, 226, 240, 0.9);
            box-shadow: 0 5px 20px rgba(31, 57, 85, 0.035);
        }

        .brand {
            color: #183654;
        }

        .brand small {
            color: #65788e;
        }

        .main-nav a {
            color: #53677f;
        }

        .main-nav a:hover {
            background: #eaf2fc;
            color: #17477d;
        }

        .main-nav .nav-cta,
        .main-nav .nav-cta:hover {
            color: #fff;
            background: linear-gradient(135deg, #1d5fa8, #17477d);
            box-shadow: 0 9px 20px rgba(29, 95, 168, 0.18);
        }

        .button-primary {
            color: #fff;
            background: linear-gradient(135deg, #1d5fa8, #17477d);
            box-shadow: 0 11px 24px rgba(29, 95, 168, 0.19);
        }

        .button-primary:hover {
            box-shadow: 0 15px 30px rgba(29, 95, 168, 0.24);
        }

        .home-hero {
            min-height: 500px;
            margin-top: 24px;
            padding: 48px 48px 42px;
            overflow: hidden;
            border: 1px solid #e1e9df;
            border-radius: 30px;
            background: linear-gradient(112deg, #fff 0%, #f0f6fd 66%, #e8f1fa 100%);
            box-shadow: 0 24px 60px rgba(24, 56, 95, 0.08);
        }

        .home-hero:before {
            top: -18%;
            right: 17%;
            width: 430px;
            height: 430px;
            background: radial-gradient(circle, rgba(169, 202, 240, 0.25), transparent 70%);
        }

        .hero-copy h1 {
            color: #1c3551;
        }

        .hero-copy h1 span {
            color: #1d5fa8;
        }

        .hero-copy .eyebrow,
        .service-hero .eyebrow {
            color: #1d5fa8;
        }

        .hero-document {
            background: linear-gradient(145deg, #347dc5 0%, #1d5fa8 60%, #17477d 100%);
            box-shadow: 0 32px 60px rgba(25, 75, 130, 0.24), inset 0 1px 0 rgba(255,255,255,.5);
        }

        .hero-glow {
            background: radial-gradient(ellipse, rgba(168, 205, 245, 0.62), rgba(200, 220, 242, 0.3) 48%, transparent 74%);
        }

        .services-section {
            border-top: 1px solid #e0e9f4;
            border-bottom: 1px solid #e0e9f4;
            background: linear-gradient(180deg, rgba(235, 243, 252, 0.92), rgba(248, 250, 253, 0.94));
        }

        .service-card {
            border-color: #dce6f1;
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 12px 28px rgba(24, 56, 95, 0.06);
            transition: transform .24s ease, border-color .24s ease, box-shadow .24s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            border-color: color-mix(in srgb, var(--accent) 38%, white);
            box-shadow: 0 22px 42px rgba(24, 56, 95, 0.12);
        }

        .service-card-kicker {
            color: color-mix(in srgb, var(--accent) 72%, #1c3551);
        }

        .card-link {
            color: #1d5fa8;
        }

        .steps-section {
            background: rgba(235,243,252,.58);
        }

        .step-card {
            border-color: #dce6f1;
            border-radius: 20px;
            background: linear-gradient(145deg, #fff, #f3f7fc);
            box-shadow: 0 10px 28px rgba(24, 56, 95, 0.045);
            transition: transform .22s ease, box-shadow .22s ease;
        }

        .step-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 34px rgba(24, 56, 95, 0.09);
        }

        .step-number {
            color: #1d5fa8;
            background: #e6f0fb;
        }

        .contact-panel {
            border-color: #dce6f1;
            border-radius: 26px;
            background: linear-gradient(115deg, #eaf3fc 0%, #f7f9fc 58%, #eaf1f9 100%);
            box-shadow: 0 20px 48px rgba(24, 56, 95, 0.07);
        }

        .contact-panel h2,
        .section-heading h2 {
            color: #172b43;
        }

        .site-footer {
            background: rgba(235,243,252,.48);
            color: #65788e;
        }

        .service-hero {
            border-color: color-mix(in srgb, var(--service-accent) 22%, white);
            border-radius: 30px;
            background: linear-gradient(115deg, #fff 0%, color-mix(in srgb, var(--service-accent) 7%, white) 62%, #f4f5eb 100%);
            box-shadow: 0 22px 55px rgba(32, 58, 43, 0.08);
        }

        .service-hero h1 {
            color: #1b352a;
        }

        .service-hero-copy > .lead {
            color: #5b6d63;
        }

        .meta-pill {
            border-color: #e1e8e1;
            color: #52645a;
            background: rgba(255,255,255,.88);
        }

        .info-card,
        .application-card {
            border-color: #e1e8e1;
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 14px 36px rgba(31, 57, 43, 0.06);
        }

        .application-card {
            box-shadow: 0 18px 42px rgba(31, 57, 43, 0.09);
        }

        .form-field input,
        .form-field select,
        .form-field textarea {
            border-color: #dce5dd;
            border-radius: 11px;
            background: #fbfcfa;
        }

        .tracking-actions .button-secondary {
            border-color: #dfe6df;
            color: #30483c;
            background: #fff;
            box-shadow: 0 6px 16px rgba(28, 55, 44, 0.05);
        }

        @media (max-width: 720px) {
            .home-hero {
                margin-top: 16px;
                padding: 28px 22px 20px;
                border-radius: 24px;
            }

            .site-header {
                background: rgba(255, 255, 255, 0.96);
            }
        }

        @media print {
            .home-hero {
                margin-top: 0;
                box-shadow: none;
            }
        }

        :root {
            --paper: #f3f7fc;
            --ink: #172b43;
            --muted: #66788e;
            --line: #dce6f1;
            --green: #1d5fa8;
            --green-dark: #17477d;
            --shadow: 0 20px 48px rgba(24, 56, 95, 0.075);
        }

        body:before {
            background:
                radial-gradient(ellipse at 88% 4%, rgba(190, 216, 246, 0.24), transparent 30%),
                radial-gradient(ellipse at 3% 48%, rgba(213, 227, 246, 0.24), transparent 32%),
                radial-gradient(ellipse at 82% 90%, rgba(190, 216, 246, 0.16), transparent 30%);
        }

        .site-header {
            background: rgba(248, 251, 255, 0.92);
            border-bottom-color: rgba(214, 226, 240, 0.88);
            box-shadow: 0 6px 22px rgba(31, 57, 88, 0.035);
        }

        .brand {
            color: #183654;
        }

        .brand small {
            color: #65788e;
        }

        .main-nav a {
            color: #53645a;
        }

        .main-nav a:hover {
            color: #174d39;
            background: #eaf0e8;
        }

        .main-nav .nav-cta,
        .main-nav .nav-cta:hover,
        .button-primary {
            color: #fff;
            background: linear-gradient(135deg, #245f49, #174b39);
            box-shadow: 0 10px 22px rgba(27, 83, 59, 0.18);
        }

        .main-nav .nav-cta:hover,
        .button-primary:hover {
            box-shadow: 0 14px 28px rgba(27, 83, 59, 0.24);
        }

        .home-hero {
            border-color: #e4e5dc;
            background:
                radial-gradient(ellipse at 87% 9%, rgba(221, 208, 174, 0.2), transparent 32%),
                linear-gradient(115deg, #fff 0%, #f5f6ef 70%, #eef3ec 100%);
            box-shadow: 0 26px 64px rgba(35, 54, 42, 0.09);
        }

        .home-hero:before {
            background: radial-gradient(circle, rgba(207, 222, 189, 0.28), transparent 70%);
        }

        .home-hero:after {
            background: radial-gradient(circle, rgba(205, 174, 116, 0.14), transparent 70%);
        }

        .home-hero .eyebrow {
            border-color: rgba(152, 125, 72, 0.2);
            color: #526a55;
            background: rgba(255, 255, 255, 0.78);
        }

        .eyebrow-mark {
            background: linear-gradient(90deg, #a4864f, #d3bd8c);
        }

        .home-hero h1 {
            color: #1c3529;
        }

        .home-hero h1 span {
            color: #28664c;
        }

        .home-hero .lead {
            color: #5e6d63;
        }

        .hero-proof {
            border-color: rgba(46, 97, 69, 0.14);
            color: #536a5a;
            background: rgba(255, 255, 255, 0.78);
        }

        .hero-document {
            background: linear-gradient(145deg, #357356 0%, #205b43 62%, #174532 100%);
            box-shadow: 0 34px 62px rgba(28, 77, 52, 0.23), inset 0 1px 0 rgba(255,255,255,.5);
        }

        .hero-document-seal {
            color: #315c43;
            background: linear-gradient(145deg, #f4e8c8, #d7e6cd);
        }

        .hero-glow {
            background: radial-gradient(ellipse, rgba(202, 223, 184, 0.58), rgba(234, 225, 198, 0.24) 48%, transparent 74%);
        }

        .art-orbit {
            border-color: rgba(74, 111, 79, 0.2);
        }

        .art-orbit-two {
            border-color: rgba(169, 137, 78, 0.2);
        }

        .art-spark {
            background: #c4a76b;
            box-shadow: 0 4px 14px rgba(147, 115, 57, 0.2);
        }

        .spark-two {
            background: #88a187;
        }

        .services-section {
            border-color: #e3e7df;
            background: linear-gradient(180deg, rgba(239, 243, 236, 0.86), rgba(248, 248, 244, 0.92));
        }

        .section-heading h2,
        .contact-panel h2 {
            color: #1e352a;
        }

        .service-card {
            border-color: color-mix(in srgb, var(--accent) 22%, #e4e7df);
            border-top-color: var(--accent);
            background: linear-gradient(155deg, #fff 62%, color-mix(in srgb, var(--accent) 5%, #fff));
            box-shadow: 0 12px 28px rgba(35, 54, 42, 0.065);
        }

        .service-card:hover {
            border-color: color-mix(in srgb, var(--accent) 42%, white);
            box-shadow: 0 21px 40px rgba(35, 54, 42, 0.12);
        }

        .service-card-art {
            background: linear-gradient(145deg, color-mix(in srgb, var(--accent) 15%, white), #f7f6ef);
        }

        .service-card-kicker {
            color: color-mix(in srgb, var(--accent) 75%, #273b2e);
        }

        .card-link {
            color: color-mix(in srgb, var(--accent) 78%, #1c3027);
        }

        .steps-section {
            background: rgba(255, 255, 255, 0.48);
        }

        .step-card,
        .feature-card {
            border-color: #e2e7df;
            background: linear-gradient(150deg, #fff, #f6f7f2);
            box-shadow: 0 12px 28px rgba(35, 54, 42, 0.055);
        }

        .step-card:nth-child(1) {
            border-top-color: #4b8061;
            background: linear-gradient(145deg, #edf4ec, #fff 78%);
        }

        .step-card:nth-child(2) {
            border-top-color: #738795;
            background: linear-gradient(145deg, #edf2f4, #fff 78%);
        }

        .step-card:nth-child(3) {
            border-top-color: #b0935e;
            background: linear-gradient(145deg, #f7f1e5, #fff 78%);
        }

        .step-card:nth-child(1) .step-number {
            background: #dceadd;
            color: #285b40;
        }

        .step-card:nth-child(2) .step-number {
            background: #e0e9eb;
            color: #456777;
        }

        .step-card:nth-child(3) .step-number {
            background: #f1e8d6;
            color: #856b3f;
        }

        .contact-panel {
            border-color: #e4dfd2;
            background: linear-gradient(115deg, #f2f4eb 0%, #f8f7f1 58%, #f3eee3 100%);
            box-shadow: 0 20px 48px rgba(35, 54, 42, 0.075);
        }

        .contact-panel .eyebrow {
            color: #5b704f;
        }

        .contact-panel .eyebrow-mark {
            background: linear-gradient(90deg, #a4864f, #d3bd8c);
        }

        .contact-side {
            border-color: #dfdfd3;
        }

        .contact-side > span {
            color: #65705e;
            background: #e8ede3;
        }

        .contact-side a:first-of-type strong {
            color: #28664c;
        }

        .contact-side a:last-of-type strong {
            color: #74613e;
        }

        .site-footer {
            border-color: #e2e6df;
            background: rgba(255, 255, 255, 0.42);
        }

        .service-hero {
            border-color: color-mix(in srgb, var(--service-accent) 20%, #e2e7df);
            background: linear-gradient(115deg, #fff 0%, color-mix(in srgb, var(--service-accent) 6%, white) 66%, #f5f4ec 100%);
            box-shadow: 0 23px 54px rgba(35, 54, 42, 0.075);
        }

        .service-hero h1 {
            color: #1d352a;
        }

        .service-hero .eyebrow {
            color: color-mix(in srgb, var(--service-accent) 84%, #19352a);
            background: rgba(255, 255, 255, 0.72);
        }

        .info-card,
        .application-card {
            border-color: color-mix(in srgb, var(--form-accent) 15%, #e3e7df);
            background: linear-gradient(155deg, #fff 55%, color-mix(in srgb, var(--form-accent) 3%, white));
            box-shadow: 0 14px 34px rgba(35, 54, 42, 0.06);
        }

        .application-card {
            box-shadow: 0 18px 42px rgba(35, 54, 42, 0.085);
        }

        .process-note {
            border-color: #e9e2d1;
            background: linear-gradient(120deg, #f5f2e7, #f6f5ef 65%, #edf3eb);
        }

        .form-field input,
        .form-field select,
        .form-field textarea {
            border-color: #dce4dc;
            background: #fcfdfa;
        }

        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus {
            outline-color: rgba(41, 105, 76, 0.18);
            border-color: #6e9b7d;
        }

        .service-page-ktp .service-hero {
            border-color: #d9e4d5;
            background:
                radial-gradient(ellipse at 92% 12%, rgba(201, 215, 180, 0.24), transparent 35%),
                linear-gradient(115deg, #fff 0%, #f3f6ef 68%, #f3efe4 100%);
            box-shadow: 0 23px 54px rgba(35, 54, 42, 0.075);
        }

        .service-page-ktp .service-hero:after {
            background: radial-gradient(circle, rgba(192, 211, 175, 0.24), rgba(219, 205, 170, 0.12) 48%, transparent 70%);
        }

        .service-page-ktp .breadcrumb a,
        .service-page-ktp .service-hero .eyebrow,
        .service-page-ktp .service-hero .text-link,
        .service-page-ktp .service-hero .text-link span {
            color: #526c55;
        }

        .service-page-ktp .service-hero h1 {
            color: #1d352a;
        }

        .service-page-ktp .service-hero-copy > .lead {
            color: #5e6d63;
        }

        .service-page .service-hero .eyebrow {
            border: 1px solid #e2e7df;
            border-radius: 12px;
            padding: 8px 12px;
            line-height: 1.35;
            background: rgba(255, 255, 255, 0.78);
        }

        .service-page-ktp .service-hero .button-primary {
            background: linear-gradient(135deg, #245f49, #174b39);
            box-shadow: 0 10px 22px rgba(27, 83, 59, 0.18);
        }

        .hero-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 24px;
        }

        .hero-tags a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 36px;
            padding: 0 14px;
            border: 1px solid rgba(23, 98, 73, 0.12);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.54);
            color: #1a4f41;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .hero-tags a:hover {
            transform: translateY(-2px);
            border-color: rgba(23, 98, 73, 0.18);
            box-shadow: 0 10px 20px rgba(23, 98, 73, 0.08);
        }

        .main-nav .nav-cta {
            box-shadow: 0 10px 20px rgba(23, 107, 82, 0.12);
        }

        .service-card,
        .feature-card,
        .contact-panel,
        .tracking-panel,
        .tracking-details,
        .info-card,
        .application-card,
        .track-card,
        .process-note {
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .service-card:hover,
        .feature-card:hover,
        .contact-panel:hover,
        .tracking-panel:hover,
        .tracking-details:hover,
        .info-card:hover,
        .application-card:hover,
        .track-card:hover,
        .process-note:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 38px rgba(35, 54, 42, 0.08);
        }

        .form-field input,
        .form-field select,
        .form-field textarea {
            transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        }

        .form-field input:hover,
        .form-field select:hover,
        .form-field textarea:hover {
            border-color: #bfd0bf;
        }

        @media (max-width: 960px) {
            .header-inner {
                flex-wrap: wrap;
                justify-content: center;
                padding: 12px 0;
            }

            .brand {
                text-align: center;
            }

            .main-nav {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            .home-hero {
                grid-template-columns: 1fr;
                padding-top: 36px;
            }

            .hero-copy,
            .hero-art {
                text-align: center;
            }

            .lead,
            .hero-proof,
            .hero-actions {
                justify-content: center;
            }
        }

        @media (max-width: 720px) {
            .main-nav {
                gap: 8px;
            }

            .main-nav a {
                flex: 1 1 calc(33.333% - 8px);
                min-width: 110px;
                text-align: center;
            }

            .main-nav a:not(.nav-cta) {
                background: #f0f3ed;
            }

            .home-hero {
                background:
                    radial-gradient(ellipse at 92% 8%, rgba(221, 208, 174, 0.18), transparent 34%),
                    linear-gradient(135deg, #fff 0%, #f3f6ef 100%);
            }

            .hero-tags,
            .hero-actions {
                justify-content: center;
            }

            .hero-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .hero-actions .button,
            .hero-actions .text-link {
                width: 100%;
                justify-content: center;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html{scroll-behavior:auto}
            .reveal{opacity:1;transform:none;transition:none}
        }

        :root[data-theme="dark"] .main-nav a:not(.nav-cta){background:rgba(255,255,255,.04);color:var(--ink)}
        :root[data-theme="dark"] .main-nav a:not(.nav-cta):hover{background:rgba(255,255,255,.08);color:var(--green-dark)}
        :root[data-theme="dark"] .site-header,
        :root[data-theme="dark"] .site-footer,
        :root[data-theme="dark"] .service-card,
        :root[data-theme="dark"] .feature-card,
        :root[data-theme="dark"] .info-card,
        :root[data-theme="dark"] .application-card,
        :root[data-theme="dark"] .track-card,
        :root[data-theme="dark"] .process-note,
        :root[data-theme="dark"] .tracking-panel,
        :root[data-theme="dark"] .tracking-details,
        :root[data-theme="dark"] .tracking-timeline,
        :root[data-theme="dark"] .step-card,
        :root[data-theme="dark"] .contact-panel,
        :root[data-theme="dark"] .contact-side{background:var(--card);border-color:var(--line);box-shadow:none}
        :root[data-theme="dark"] .service-hero,
        :root[data-theme="dark"] .steps-section,
        :root[data-theme="dark"] .service-page .service-hero,
        :root[data-theme="dark"] .service-page-ktp .service-hero{background:linear-gradient(135deg,var(--card) 0%,var(--paper-strong) 100%);border-color:var(--line)}
        :root[data-theme="dark"] .theme-toggle{background:var(--card);border-color:var(--line)}
        :root[data-theme="dark"] .status-list li.is-current span,
        :root[data-theme="dark"] .tracking-step.is-current .tracking-step-marker{background:var(--green);border-color:var(--green)}
        :root[data-theme="dark"] .panel-progress .progress-bar span{background:linear-gradient(90deg,var(--green),var(--green-dark))}
        :root[data-theme="dark"] .brand small,
        :root[data-theme="dark"] .hero-proof,
        :root[data-theme="dark"] .lead,
        :root[data-theme="dark"] .feature-card p,
        :root[data-theme="dark"] .service-card p,
        :root[data-theme="dark"] .process-note p,
        :root[data-theme="dark"] .tracking-intro,
        :root[data-theme="dark"] .tracking-detail span,
        :root[data-theme="dark"] .tracking-step p,
        :root[data-theme="dark"] .field-hint,
        :root[data-theme="dark"] .card-intro,
        :root[data-theme="dark"] .status-list li{color:var(--muted)}
        @media(max-width:440px){
            .main-nav{gap:4px}
            .main-nav a{flex:0 1 auto;min-width:0;padding:7px 6px;font-size:9px}
            .theme-toggle{min-height:34px;gap:5px;padding:0 8px;font-size:10px}
            .theme-toggle__icon{width:18px;height:18px}
        }
        .home-page .service-card{
            overflow:hidden;
            border:1px solid color-mix(in srgb,var(--accent) 58%,white);
            border-top:5px solid var(--accent);
            border-radius:20px;
            background:color-mix(in srgb,var(--accent) 9%,white);
            box-shadow:0 12px 30px color-mix(in srgb,var(--accent) 24%,transparent);
        }
        .home-page .service-card:hover{
            border-color:var(--accent);
            box-shadow:0 20px 38px color-mix(in srgb,var(--accent) 32%,transparent);
        }
        .home-page .service-card-background{
            inset:0 0 auto;
            height:185px;
            object-position:center 35%;
            filter:none;
        }
        .home-page .service-card-copy{
            margin-top:165px;
            padding:16px 19px 18px;
            border-top:3px solid var(--accent);
            background:linear-gradient(135deg,color-mix(in srgb,var(--accent) 17%,white),color-mix(in srgb,var(--accent) 5%,white) 74%);
            text-shadow:none;
        }
        .home-page .service-card-kicker{
            color:color-mix(in srgb,var(--accent) 82%,#172923);
            background:color-mix(in srgb,var(--accent) 17%,white);
            font-size:10px;
        }
        .home-page .service-card h3{color:#172923;font-size:19px}
        .home-page .service-card p{color:#35473e;font-size:14px;line-height:1.55}
        .home-page .service-card .card-link{
            border-color:color-mix(in srgb,var(--accent) 25%,white);
            color:color-mix(in srgb,var(--accent) 85%,#172923);
            font-size:13px;
        }
        @media(max-width:720px){
            .home-page .service-card-background{
                inset:0;
                height:100%;
                object-position:center 35%;
                filter:none;
            }
            .home-page .service-card-copy{
                min-height:180px;
                margin-top:0;
                padding:14px 15px;
                border-top:0;
                background:linear-gradient(0deg,color-mix(in srgb,var(--accent) 17%,rgba(255,255,255,.97)) 0%,rgba(255,255,255,.96) 58%,rgba(255,255,255,.7) 100%);
            }
        }
        @media(max-width:440px){
            .home-page .service-card-copy{min-height:170px;padding:12px}
            .home-page .service-card h3{font-size:17px}
            .home-page .service-card p{font-size:13px;line-height:1.5}
        }
    </style>
</head>
<body class="@yield('page_class')">
    <header class="site-header">
        <div class="wrap header-inner">
            <div class="brand">
                <span class="brand-mark" aria-hidden="true">
                    <img src="{{ asset('images/logo-salumpat-saindege.png') }}" alt="">
                </span>
                <span>Dinas Kependudukan dan Pencatatan Sipil<small>Kota Padangsidimpuan</small></span>
            </div>
            <nav class="main-nav" aria-label="Menu utama">
                <button class="theme-toggle" type="button" aria-label="Pindah tema" aria-pressed="false">
                    <span class="theme-toggle__icon" aria-hidden="true">☀</span>
                    <span class="theme-toggle__text">Tema</span>
                </button>
                <a class="nav-home" href="{{ route('home') }}" aria-label="Kembali ke beranda">Beranda</a>
                <a href="{{ route('home') }}#daftar-layanan">Layanan</a>
                <a href="{{ route('home') }}#alur-layanan">Alur</a>
                <a href="{{ route('home') }}#kontak">Kontak</a>
                @hasSection('service_slug')
                    <a class="nav-cta" href="#formulir" aria-label="Ajukan sekarang"><span class="nav-label">Ajukan sekarang</span><span aria-hidden="true">↗</span></a>
                @else
                    <a class="nav-cta" href="{{ route('home') }}#daftar-layanan" aria-label="Mulai pengajuan"><span class="nav-label">Mulai pengajuan</span><span aria-hidden="true">↗</span></a>
                @endif
            </nav>
        </div>
    </header>
    @yield('content')
    <footer class="site-footer">
        <div class="wrap">
            <span>Demonstrasi layanan administrasi kependudukan. Untuk layanan resmi, gunakan kanal terverifikasi Pemerintah Kota Padangsidimpuan.</span>
            <a href="{{ route('home') }}#daftar-layanan">Kembali ke layanan ↑</a>
        </div>
    </footer>
    <script>
        (() => {
            const root = document.documentElement;
            const toggle = document.querySelector('.theme-toggle');
            const key = 'dukcapil-theme';
            const setTheme = (dark) => {
                root.setAttribute('data-theme', dark ? 'dark' : 'light');
                const icon = toggle?.querySelector('.theme-toggle__icon');
                const text = toggle?.querySelector('.theme-toggle__text');
                if (toggle) {
                    toggle.setAttribute('aria-pressed', String(dark));
                    toggle.setAttribute('aria-label', dark ? 'Pindah ke tema terang' : 'Pindah ke tema gelap');
                }
                if (icon) icon.textContent = dark ? '☾' : '☀';
                if (text) text.textContent = dark ? 'Gelap' : 'Tema';
                localStorage.setItem(key, dark ? 'dark' : 'light');
            };

            const saved = localStorage.getItem(key);
            const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            setTheme(saved ? saved === 'dark' : prefersDark);

            toggle?.addEventListener('click', () => {
                const nextDark = root.getAttribute('data-theme') !== 'dark';
                setTheme(nextDark);
            });

            if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                const revealElements = document.querySelectorAll('.reveal');
                const revealObserver = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            revealObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12 });

                revealElements.forEach((element) => revealObserver.observe(element));
            } else {
                document.querySelectorAll('.reveal').forEach((element) => element.classList.add('is-visible'));
            }
        })();
    </script>
</body>
</html>
