<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Elevant - Plataforma de Creadores</title>
  <style>
    :root {
      --violet: #000000;      /* principal */
      --yellow: #B59359;      /* secundario */
      --black: #000000;       /* principal */
      --gray: #f6f6f6;
      --border: #e6e6e6;
      --white: #FFFFFF;       /* blanco */
    }
    body {
      margin: 0;
      font-family: "Arial Rounded MT Bold", Arial, Helvetica, sans-serif;
      background: var(--white);
      color: var(--black);
    }
    a {
      text-decoration: none;
      color: inherit;
    }
    /* HEADER */
    header {
      background: var(--white);
      box-shadow: 0 1px 10px #ececec;
      position: sticky;
      top: 0;
      z-index: 40;
    }
    .nav {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 20px 18px 16px;
      max-width: 1200px;
      margin: 0 auto;
    }
    .logo {
      font-weight: bold;
      font-size: 1.7rem;
      letter-spacing: 1.2px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .logo img {
      height: 34px;
      margin-right: 8px;
    }
    .nav-links {
      display: flex;
      align-items: center;
      gap: 26px;
      font-size: 1rem;
    }
    .nav-links a {
      color: var(--black);
      padding: 2px 8px;
      border-radius: 6px;
      transition: background .13s;
    }
    .nav-links a.active, .nav-links a:hover {
      background: #f8f8f8;
      color: var(--yellow);
    }
    .nav-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .nav-actions .login {
      background: var(--white);
      color: var(--black);
      border: 1.3px solid var(--yellow);
      padding: 7px 18px;
      border-radius: 12px;
      font-weight: 600;
      margin-right: 4px;
      cursor: pointer;
      font-size: 0.98rem;
    }
    .nav-actions .get-started {
      background: var(--black);
      color: var(--white);
      border: none;
      padding: 8px 21px;
      border-radius: 13px;
      font-weight: 600;
      cursor: pointer;
      font-size: 0.98rem;
      box-shadow: 0 2px 8px #b5935918;
    }
    .nav-links .inicio {
      color: var(--yellow);
    }
    /* HERO */
    .hero {
      width: 100vw;
      max-width: 100%;
      background: linear-gradient(90deg, var(--black) 0%, #fff8e1 100%);
      min-height: 300px;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: flex-end;
      justify-content: center;
    }
    .hero-img-bg {
      position: absolute;
      left: 0; top: 0;
      width: 100vw;
      height: 900px;
      max-width: 1500px;
      min-width: 100%;
      min-height: 100%;
      object-fit: cover;
      object-position: center center;
      filter: brightness(.86);
      z-index: 1;
    }
    .hero-content {
      z-index: 2;
      position: relative;
      max-width: 1500px;
      width: 100%;
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      padding: 28px 22px 0 22px;
      min-height: 900px;
      box-sizing: border-box;
    }
    .hero-main-left {
      color: var(--white);
      max-width: 600px;
      margin-bottom: 32px;
      position: relative;
      top: -50px;
    }
    .hero-main-left h1 {
      font-size: 65px;
      font-weight: bold;
      line-height: 1.1;
      margin: 0 0 22px 0;
      letter-spacing: -1px;
      text-shadow: 0 2px 20px #2225;
    }
    .hero-main-left p {
      font-size: 28px;
      color: #f8f8f8;
      margin: 0 0 32px 0;
      line-height: 1.5;
      text-shadow: 0 2px 20px #2225;
    }
    .hero-main-left .hero-buttons {
      display: flex;
      gap: 14px;
    }
    .hero-main-left .hero-btn {
      background: var(--black);
      color: var(--white);
      border: none;
      padding: 10px 60px;
      border-radius: 18px;
      font-weight: 500;
      font-size: 2rem;
      cursor: pointer;
      margin-right: 8px;
      box-shadow: 0 2px 8px #00000044;
      transition: background 0.18s;
    }
    .hero-main-left .hero-btn.secondary {
      background: var(--white);
      color: var(--black);
      font-weight: bold;
      border: 2px solid var(--black);
      box-shadow: none;
    }
    .hero-main-left .hero-btn:hover {
      background: var(--yellow);
      color: var(--white);
    }
    .hero-card {
      background: var(--white);
      color: var(--black);
      border-radius: 16px;
      box-shadow: 0 4px 25px #b5935918;
      padding: 18px 24px;
      min-width: 250px;
      margin-left: 40px;
      margin-bottom: 42px;
      display: flex;
      flex-direction: column;
      gap: 8px;
      align-items: flex-start;
      position: relative;
    }
    .hero-card .hero-card-title {
      font-size: 1.1rem;
      font-weight: bold;
      margin-bottom: 6px;
    }
    .hero-img-person {
      position: absolute;
      right: 90px;
      top: 50px;
      width: 200px;
      height: 240px;
      border-radius: 18px;
      object-fit: cover;
      border: 4px solid var(--white);
      z-index: 3;
      box-shadow: 0 8px 24px #b5935944;
    }
    /* ICON ROW */
    .icon-row {
      background: var(--white);
      border-bottom: 1.7px solid #ededed;
      display: flex;
      justify-content: center;
      gap: 22px;
      padding: 19px 0 15px 0;
      font-size: 1.09rem;
    }
    .icon-row .icon-feature {
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: 500;
      color: var(--black);
    }
    .icon-row .icon-feature svg {
      color: var(--yellow);
    }
    /* TOP CHOICE CARDS */
    .top-choice-section {
      max-width: 1100px;
      margin: 34px auto 0 auto;
      padding: 0 12px;
    }
    .top-choice-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 32px;
      gap: 18px;
    }
    .top-choice-header h2 {
      font-size: 2rem;
      font-weight: bold;
      margin: 0;
      letter-spacing: -1px;
      color: var(--black);
    }
    .top-choice-header .get-started-btn {
      background: var(--black);
      color: var(--white);
      border: none;
      padding: 10px 25px;
      border-radius: 14px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      box-shadow: 0 2px 8px #18181818;
    }
    .creators-cards {
      display: flex;
      gap: 18px;
      margin-bottom: 50px;
      flex-wrap: wrap;
    }
    .creator-card {
      flex: 1 1 180px;
      min-width: 180px;
      max-width: 230px;
      background: var(--black);
      border-radius: 15px;
      position: relative;
      overflow: hidden;
      color: var(--white);
      box-shadow: 0 4px 22px #b5935918;
      margin-right: 0;
      margin-bottom: 14px;
    }
    .creator-card .creator-bg {
      width: 100%;
      height: 155px;
      object-fit: cover;
      opacity: 0.6;
      filter: grayscale(0.1) blur(0.2px);
      display: block;
    }
    .creator-card .creator-info {
      position: absolute;
      left: 0; bottom: 0;
      width: 100%;
      padding: 12px 18px 10px 18px;
      background: linear-gradient(0deg,rgba(0,0,0,.65) 70%,rgba(0,0,0,0) 100%);
    }
    .creator-card .creator-name {
      font-weight: bold;
      font-size: 1.05rem;
      margin-bottom: 4px;
      color: var(--white);
    }
    .creator-card .creator-desc {
      font-size: 0.93rem;
      color: #e0e0e0;
    }
    .creator-card .read-more {
      background: var(--white);
      color: var(--yellow);
      border-radius: 8px;
      display: inline-block;
      padding: 4px 19px;
      font-size: 0.97rem;
      font-weight: 600;
      margin-top: 10px;
      text-align: left;
      border: none;
      cursor: pointer;
    }
    /* COURSES */
    .courses-section {
      max-width: 1100px;
      margin: 30px auto 0 auto;
      padding: 0 12px;
    }
    .courses-section h2 {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 24px;
      margin-top: 0;
      letter-spacing: -1px;
      color: var(--black);
    }
    .courses-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: flex-start;
    }
    .course-card {
      background: var(--white);
      border-radius: 12px;
      box-shadow: 0 2px 8px #b5935918;
      width: 320px;
      min-width: 260px;
      max-width: 380px;
      margin-bottom: 18px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: box-shadow 0.15s;
      height: 440px;
      justify-content: flex-start;
    }
    .course-card:hover {
      box-shadow: 0 6px 24px #b5935922;
    }
    .course-card img {
      width: 100%;
      height: 100%;
      max-height: 440px;
      object-fit: contain;
      background: #eee;
      display: block;
      flex: 1;
    }
    .course-card-content {
      padding: 0;
      display: flex;
      flex-direction: column;
      gap: 4px;
      width: 100%;
    }
    @media (max-width: 900px) {
      .courses-grid {
        justify-content: center;
      }
      .course-card {
        width: 90vw;
        max-width: 340px;
        min-width: 0;
        height: 280px;
      }
      .course-card img {
        max-height: 280px;
      }
    }
    /* TOP CATEGORIES GRID */
    .top-categories-section {
      background: var(--black);
      color: var(--white);
      padding: 55px 0 50px 0;
    }
    .categories-header {
      text-align: center;
      margin-bottom: 35px;
    }
    .categories-header h2 {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 8px;
      letter-spacing: -1px;
      color: var(--white);
    }
    .categories-header p {
      font-size: 1.16rem;
      color: #e6e6e6;
      font-weight: 400;
      margin: 0 0 11px 0;
    }
    .categories-grid {
      display: flex;
      gap: 20px;
      justify-content: center;
      max-width: 1100px;
      margin: 0 auto 0 auto;
      margin-bottom: 40px;
    }
    .category-card {
      flex: 1 1 200px;
      min-width: 160px;
      max-width: 300px;
      border-radius: 15px;
      overflow: hidden;
      position: relative;
      background: var(--white);
      box-shadow: 0 4px 18px #b5935915;
      margin-bottom: 0;
    }
    .category-card .cat-img-bg {
      width: 100%;
      height: 180px;
      object-fit: cover;
      opacity: 0.7;
      filter: grayscale(0.1) blur(0.2px);
      display: block;
      position: relative;
      z-index: 1;
    }
    .category-card .cat-info {
      position: absolute;
      left: 0; top: 0;
      width: 100%;
      height: 100%;
      z-index: 2;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 18px 18px 15px 20px;
      background: linear-gradient(0deg,rgba(0,0,0,.62) 70%,rgba(0,0,0,0) 100%);
    }
    .category-card .cat-title {
      font-weight: bold;
      font-size: 1.05rem;
      margin-bottom: 4px;
      color: var(--white);
    }
    .category-card .cat-desc {
      font-size: 0.93rem;
      color: #e0e0e0;
    }
    .category-card .cat-read-more {
      background: var(--white);
      color: var(--yellow);
      border-radius: 8px;
      display: inline-block;
      padding: 4px 19px;
      font-size: 0.97rem;
      font-weight: 600;
      margin-top: 10px;
      text-align: left;
      border: none;
      cursor: pointer;
      box-shadow: none;
    }
    /* MID SECTION */
    .mid-section {
      background: var(--white);
      padding: 56px 0 24px 0;
      max-width: 1100px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      gap: 48px;
      align-items: flex-start;
      flex-wrap: wrap;
    }
    .mid-section .mid-left {
      flex: 1.6;
      min-width: 300px;
    }
    .mid-section .mid-title {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 18px;
      letter-spacing: -1px;
      color: var(--black);
    }
    .mid-section .mid-desc {
      font-size: 1.16rem;
      color: #666;
      margin-bottom: 14px;
      font-weight: 400;
    }
    .mid-section .get-started-btn {
      background: var(--black);
      color: var(--white);
      border: none;
      padding: 10px 25px;
      border-radius: 14px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      margin-bottom: 28px;
      margin-top: 8px;
    }
    .mid-section .no-rev-list {
      display: flex;
      gap: 16px;
      margin-top: 32px;
    }
    .no-rev-card {
      background: var(--white);
      color: var(--black);
      border-radius: 12px;
      border: 1.5px solid #ececec;
      padding: 22px 14px;
      font-size: 1.04rem;
      font-weight: 600;
      box-shadow: 0 1px 7px #b5935911;
      flex: 1 1 130px;
      min-width: 130px;
      margin-bottom: 8px;
    }
    .mid-section .mid-right {
      flex: 1;
      min-width: 250px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .mid-right .mid-img {
      width: 96%;
      max-width: 370px;
      border-radius: 18px;
      object-fit: cover;
      margin-top: 19px;
      box-shadow: 0 4px 25px #b5935922;
    }
    /* NEWSLETTER & FOOTER */
    .newsletter-section {
      background: var(--black);
      color: var(--white);
      padding: 46px 0 12px 0;
    }
    .newsletter-content {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 18px;
    }
    .newsletter-title {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 18px;
      letter-spacing: -1px;
      color: var(--white);
    }
    .newsletter-desc {
      font-size: 1.08rem;
      color: #e6e6e6;
      font-weight: 400;
      margin-bottom: 28px;
    }
    .newsletter-form {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 40px;
    }
    .newsletter-form input[type="text"] {
      background: var(--black);
      color: var(--white);
      border: 1.3px solid #444;
      border-radius: 13px;
      padding: 13px 20px;
      font-size: 1.1rem;
      width: 290px;
      outline: none;
    }
    .newsletter-form .get-started-btn {
      background: var(--yellow);
      color: var(--black);
      border: none;
      padding: 11px 26px;
      border-radius: 14px;
      font-weight: bold;
      font-size: 1rem;
      cursor: pointer;
    }
    .footer-main {
      display: flex;
      gap: 28px;
      justify-content: space-between;
      flex-wrap: wrap;
      margin-top: 28px;
      margin-bottom: 18px;
      max-width: 1100px;
      margin-left: auto;
      margin-right: auto;
      padding: 0 18px;
      color: var(--white);
    }
    .footer-main .footer-logo {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 8px;
      letter-spacing: 1px;
    }
    .footer-main .footer-desc {
      color: #e6e6e6;
      font-size: 1rem;
      margin-bottom: 16px;
      max-width: 220px;
    }
    .footer-block {
      min-width: 120px;
      flex: 1 1 120px;
      margin-right: 28px;
    }
    .footer-block h4 {
      color: var(--white);
      font-size: 1.1rem;
      font-weight: bold;
      margin-bottom: 9px;
      letter-spacing: -0.5px;
    }
    .footer-block ul {
      list-style: none;
      margin: 0;
      padding: 0;
      color: #e6e6e6;
    }
    .footer-block ul li {
      margin-bottom: 7px;
      font-size: 1rem;
    }
    .footer-bottom {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 18px;
      color: #bdbdbd;
      font-size: .97rem;
      margin-bottom: 12px;
      text-align: left;
    }
    @media (max-width: 950px) {
      .top-choice-section, .courses-section, .mid-section { max-width: 99vw; }
      .creators-cards, .categories-grid { flex-wrap: wrap; }
      .mid-section { flex-direction: column; gap: 18px; }
    }
    @media (max-width: 600px) {
      .nav { flex-direction: column; }
      .hero-content { flex-direction: column; padding: 18px 4vw 0 4vw; }
      .hero-main-left { margin-bottom: 20px;}
      .icon-row { flex-direction: column; gap: 8px; padding: 12px 0;}
      .top-choice-section, .courses-section, .mid-section, .newsletter-content, .footer-main { padding: 0 8px; }
    }

    /* Botón Get Started general */
    .get-started-btn,
    .nav-actions .get-started,
    .hero-main-left .hero-btn,
    .mid-section .get-started-btn,
    .newsletter-form .get-started-btn {
      transition: background 0.18s, color 0.18s;
    }

    /* Get Started en fondo blanco (header, mid-section, newsletter) */
    .nav-actions .get-started,
    .mid-section .get-started-btn,
    .newsletter-form .get-started-btn {
      background: var(--black);
      color: var(--white);
    }
    .nav-actions .get-started:hover,
    .mid-section .get-started-btn:hover,
    .newsletter-form .get-started-btn:hover {
      background: var(--yellow);
      color: var(--white);
    }

    /* Get Started en fondo negro (hero, top-choice-section) */
    .hero-main-left .hero-btn,
    .top-choice-header .get-started-btn {
      background: var(--yellow);
      color: var(--black);
    }
    .hero-main-left .hero-btn.secondary {
      background: var(--white);
      color: var(--black);
      border: 2px solid var(--black);
    }
    .hero-main-left .hero-btn:hover,
    .top-choice-header .get-started-btn:hover {
      background: var(--black);
      color: var(--white);
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <nav class="nav">
      <a href="#" class="logo">
        <img src="<?php echo base_url('uploads/elevant/elevant.png'); ?>" alt="Elevant Logo">
      </a>
      <div class="nav-links">
        <a href="#" class="inicio active">Inicio</a>
        <a href="#">Elevant</a>
        <a href="#">Cursos</a>
        <a href="#">Afiliados</a>
        <a href="#">Instructor</a>
        <a href="#">Contacto</a>
      </div>
      <div class="nav-actions">
        <button class="login">login</button>
        <button class="get-started">Get Started</button>
      </div>
    </nav>
  </header>

  <!-- HERO Section -->
  <section class="hero">
    <img src="<?php echo base_url('uploads/elevant/banner-1 1.png'); ?>" alt="Hero" class="hero-img-bg">
    <div class="hero-content">
      <div class="hero-main-left">
        <h1>Dream it. BUILD it.<br>Monetize it.</h1>
        <p>From digital products to marketing tools, Elevant has everything creators need to build the businesses of their dreams – and make a profit – all in one place.</p>
        <div class="hero-buttons">
          <button class="hero-btn" style="background: var(--black); color: var(--white);">Get Started</button> <!-- negro -->
        </div>
      </div>
      <!-- <img class="hero-img-person" src="https://placehold.org/200x240?text=Creator+Photo" alt="Creator">
      <div class="hero-card">
        <div class="hero-card-title">Suscríbete por 600/mens</div>
        <img src="https://placehold.org/160x60?text=App+Screenshot" alt="App" style="width:100%;border-radius:7px;">
        <div style="font-size:0.98rem;color:#666;margin-top:7px;">Karin Staff <span style="font-size:0.92rem;background:#eee;padding:2px 9px;border-radius:5px;margin-left:8px;">+info</span></div>
      </div> -->
    </div>
  </section>

  <!-- ICON ROW -->
  <div style="width:100%;text-align:center;margin:30px 0;">
    <img src="<?php echo base_url('uploads/elevant/Frame 26.png'); ?>" alt="Banner" style="max-width:100%;height:auto;">
  </div>
  <!-- Top Choice Section -->
  <section class="top-choice-section">
    <div class="top-choice-header">
      <h2>The top choice for creators of all sizes.</h2>
      <button class="get-started-btn" style="background: var(--black); color: var(--white);">Get Started</button> <!-- negro -->
    </div>
    <!-- ...existing code... -->
  </section>

  <!-- COURSES Section -->
  <section class="courses-section">
    <div class="courses-grid">
      <div class="course-card">
        <img src="<?php echo base_url('uploads/elevant/Frame 6.png'); ?>" alt="Curso 2">
        <div class="course-card-content">
          <!-- La imagen ya contiene el texto, así que no mostramos título ni descripción -->
        </div>
      </div>
      <div class="course-card">
        <img src="<?php echo base_url('uploads/elevant/Frame 13.png'); ?>" alt="Curso 3">
        <div class="course-card-content">
          <!-- La imagen ya contiene el texto, así que no mostramos título ni descripción -->
        </div>
      </div>
      <div class="course-card">
        <img src="<?php echo base_url('uploads/elevant/Frame 14.png'); ?>" alt="Curso 4">
        <div class="course-card-content">
          <!-- La imagen ya contiene el texto, así que no mostramos título ni descripción -->
        </div>
      </div>
    </div>
  </section>

  <!-- TOP CATEGORIES Section -->
  <section class="top-categories-section">
    <div class="categories-header">
      <h2>Top Categories</h2>
      <p>From digital products to marketing tools, Kajabi has everything creators need to build.</p>
      <div style="margin:14px 0 0 0;">
        <span style="margin-right:18px;">Farmacia</span>
        <span style="margin-right:18px;">Podcast</span>
        <span style="margin-right:18px;">Multimedia</span>
        <span style="margin-right:18px;">Sistema</span>
        <span>Odontología</span>
      </div>
    </div>
    <div class="categories-grid">
      <div class="category-card">
        <img src="https://placehold.org/280x180?text=Farmacia" class="cat-img-bg" alt="Farmacia">
        <div class="cat-info">
          <div class="cat-title">FARMACIA</div>
          <div class="cat-desc">Te ayudamos a crear el curso ideal para tu comunidad...</div>
          <button class="cat-read-more">Leer más</button>
        </div>
      </div>
      <div class="category-card">
        <img src="https://placehold.org/280x180?text=Podcast" class="cat-img-bg" alt="Podcast">
        <div class="cat-info">
          <div class="cat-title">PODCAST</div>
          <div class="cat-desc">Te ayudamos a crear el curso ideal para tu comunidad...</div>
          <button class="cat-read-more">Leer más</button>
        </div>
      </div>
      <div class="category-card">
        <img src="https://placehold.org/280x180?text=Multimedia" class="cat-img-bg" alt="Multimedia">
        <div class="cat-info">
          <div class="cat-title">MULTIMEDIA</div>
          <div class="cat-desc">Te ayudamos a crear el curso ideal para tu comunidad...</div>
          <button class="cat-read-more">Leer más</button>
        </div>
      </div>
    </div>
  </section>

  <!-- MID SECTION: THE TOP CHOICE ... -->
  <section class="mid-section">
    <div class="mid-left">
      <div class="mid-title">The top choice for creators of all sizes.</div>
      <div class="mid-desc">From digital products to marketing tools, Kajabi has everything creators need to build.</div>
      <button class="get-started-btn" style="background: var(--black); color: var(--white);">Get Started</button> <!-- negro -->
      <div class="no-rev-list">
        <div class="no-rev-card">
          No revenue sharing. Ever.<br>
          You make the content, you reap the rewards.
        </div>
        <div class="no-rev-card">
          No revenue sharing. Ever.<br>
          You make the content, you reap the rewards.
        </div>
        <div class="no-rev-card">
          No revenue sharing. Ever.<br>
          You make the content, you reap the rewards.
        </div>
      </div>
    </div>
    <div class="mid-right">
      <img src="https://placehold.org/340x210?text=Hero+Course+Image" alt="Mid Section" class="mid-img">
    </div>
  </section>

  <!-- NEWSLETTER & FOOTER -->
  <footer class="newsletter-section">
    <div class="newsletter-content">
      <div class="newsletter-title">NewsLetter</div>
      <div class="newsletter-desc">Regístrate con nosotros y te enviaremos los boletines al día sobre que necesitas</div>
      <form class="newsletter-form" autocomplete="off" onsubmit="return false;">
        <input type="text" placeholder="Ingresa tu correo o número celular" />
        <button class="get-started-btn" style="background: var(--yellow); color: var(--black);">Get Started</button><!--  dorado -->
      </form>
    </div>
    <div class="footer-main">
      <div class="footer-logo">
        <span>ELEVANT</span>
        <div class="footer-desc" style="margin-top:8px;">Study any topic, anytime, explore thousands of courses for the lowest price ever!</div>
      </div>
      <div class="footer-block">
        <h4>Top Category</h4>
        <ul>
          <li>Farmacia</li>
          <li>Multimedia</li>
          <li>Podcast</li>
        </ul>
      </div>
      <div class="footer-block">
        <h4>Use Link</h4>
        <ul>
          <li>Courses</li>
          <li>Instructor</li>
          <li>Afiliado</li>
        </ul>
      </div>
      <div class="footer-block">
        <h4>Help</h4>
        <ul>
          <li>About Us</li>
          <li>Contact</li>
          <li>Term and condition</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      © 2024 Elevant Academy. todos los derechos reservados
    </div>
  </footer>
</body>
</html>