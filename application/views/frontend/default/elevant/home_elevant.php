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
      --gold: #FFD600;
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
      color: var(--black);
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
      font-size: 65px;
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
      width: 385px;
      height: 569px;
      max-width: 100%;
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
      padding: 38px 28px 38px 28px;
      /* Gradientes personalizados para cada tarjeta */
    }
    .category-card:nth-child(1) .cat-info {
      background: linear-gradient(0deg, rgba(0, 60, 255, 0.82) 30%, rgba(255,255,255,0) 85%);
    }
    .category-card:nth-child(2) .cat-info {
      background: linear-gradient(0deg, rgba(220, 0, 120, 0.82) 30%, rgba(255,255,255,0) 85%);
    }
    .category-card:nth-child(3) .cat-info {
      background: linear-gradient(0deg, rgba(0, 80, 120, 0.82) 30%, rgba(255,255,255,0) 85%);
    }
    .category-card .cat-title {
      font-weight: bold;
      font-size: 2.1rem;
      margin-bottom: 12px;
      color: #000;
      letter-spacing: 1px;
      text-transform: uppercase;
      text-shadow: none;
    }
    .category-card .cat-desc {
      font-size: 1.18rem;
      color: #222;
      margin-bottom: 18px;
      text-shadow: none;
    }
    .category-card .cat-read-more {
      background: transparent;
      color: #000;
      border-radius: 8px;
      display: inline-block;
      padding: 8px 28px;
      font-size: 1.1rem;
      font-weight: 700;
      margin-top: 10px;
      text-align: left;
      border: none;
      cursor: pointer;
      box-shadow: none;
      text-shadow: none;
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
      font-size: 65px;
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
      flex-direction: column;
      align-items: flex-start;
      gap: 0;
      margin-top: 32px;
    }
    .no-rev-card {
      background: var(--white);
      color: var(--black);
      border-radius: 12px;
      border: 2.5px solid #444; /* Gris oscuro */
      padding: 22px 14px;
      font-size: 1.04rem;
      font-weight: bold; /* Solo el primer texto será bold, el resto normal */
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

    /* ...agrega aquí el CSS que estaba en los atributos style de la sección Courses... */
    .custom-courses-section {
      padding: 0 0 50px 0;
    }
    .custom-courses-title {
      font-size: 2.7rem;
      font-weight: bold;
      margin: 32px auto 32px auto;
      letter-spacing: -1.5px;
      text-align: center;
      max-width: 1100px;
    }
    .custom-courses-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 36px 34px;
      max-width: 1100px;
      margin: 0 auto;
    }
    .custom-course-card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 2px 10px #e0e0e0;
      width: 330px;
      min-width: 300px;
      max-width: 350px;
      margin-bottom: 32px;
      display: flex;
      flex-direction: column;
    }
    .custom-course-card .custom-card-img-container {
      position: relative;
    }
    .custom-course-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 16px 16px 0 0;
    }
    .custom-course-card .custom-card-badge {
      position: absolute;
      top: 13px;
      left: 15px;
      background: #fff;
      color: #222;
      font-size: 11px;
      padding: 3px 12px;
      border-radius: 9px;
      font-weight: 600;
      letter-spacing: 0.3px;
      border: 1px solid #eaeaea;
    }
    .custom-course-card .custom-card-content {
      padding: 18px 18px 0 18px;
    }
    .custom-course-card .custom-card-level {
      font-size: 13px;
      color: #181818;
      margin-bottom: 3px;
    }
    .custom-course-card .custom-card-desc {
      font-size: 13.2px;
      color: #888;
      margin-bottom: 12px;
    }
    .custom-course-card .custom-card-link {
      font-weight: bold;
      font-size: 13.5px;
      color: #181818;
      display: inline-block;
    }

    /* Reseña Historica Section */
    .resena-section {
      background: #fff;
      padding: 48px 0 20px 0;
      text-align: center;
    }
    .resena-section h2 {
      font-size: 65px;
      font-weight: bold;
      margin: 0 0 10px 0;
    }
    .resena-section .resena-sub {
      color: #222;
      font-size: 30px;
      margin-bottom: 32px;
    }
    .resena-section .resena-desc {
      max-width: 860px;
      margin: 0 auto 32px auto;
      color: #222;
      font-size: 1rem;
      line-height: 1.6;
      text-align: left;
    }
    .resena-section .resena-btn {
      background: #111;
      color: #fff;
      border: none;
      border-radius: 13px;
      padding: 13px 38px;
      font-size: 1.04rem;
      font-weight: bold;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: background 0.18s, color 0.18s;
    }
    .resena-section .resena-btn:hover {
      background: var(--yellow);
      color: #fff;
    }

    /* Top Choice for Creators Section */
    .top-choice-black-section {
      background: #000;
      color: #fff;
      padding: 52px 0 58px 0;
    }
    .top-choice-black-section .top-choice-container {
      max-width: 1050px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
      gap: 36px 0;
    }
    .top-choice-black-section .top-choice-title {
      font-size: 65px;
      font-weight: bold;
      margin: 0 0 20px 0;
      letter-spacing: -1.3px;
    }
    .top-choice-black-section .top-choice-desc {
      color: #e0e0e0;
      font-size: 1.09rem;
      margin-bottom: 8px;
    }
    .top-choice-black-section .top-choice-btn {
      margin-top: 10px;
      background: var(--yellow); /* dorado base */
      color: #181818;
      border: none;
      border-radius: 14px;
      font-weight: 600;
      font-size: 1rem;
      padding: 8px 22px;
      cursor: pointer;
      transition: background 0.18s, color 0.18s;
    }
    .top-choice-black-section .top-choice-btn:hover {
      background: #fff;
      color: #181818;
    }
    .top-choice-black-section .top-choice-grid {
      max-width: 1050px;
      margin: 40px auto 0 auto;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-template-rows: repeat(2, 1fr);
      gap: 22px;
    }
    .top-choice-black-section .top-choice-card {
      background: #fff;
      color: #181818;
      border-radius: 12px;
      box-shadow: 0 2px 8px #18181810;
      padding: 24px 22px 20px 22px;
      min-width: 200px;
    }
    .top-choice-black-section .top-choice-card-icon {
      background: #000;
      color: #fff;
      width: 33px;
      height: 33px;
      border-radius: 9px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 8px;
    }
    .top-choice-black-section .top-choice-card-title {
      font-weight: bold;
      font-size: 1.08rem;
      margin-bottom: 3px;
    }
    .top-choice-black-section .top-choice-card-desc {
      font-size: 0.98rem;
      color: #222;
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
        <a href="<?php echo base_url('elevant/home'); ?>" class="inicio">Inicio</a>
        <a href="#" class="active" style="color: var(--yellow);">Elevant</a>
        <a href="<?php echo base_url('elevant/home_courses'); ?>">Cursos</a>
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
  
  
  <section class="mid-section" style="padding-top: 56px; padding-bottom: 24px; max-width: 1100px; margin: 0 auto;">
    <div style="width: 100%; display: flex; flex-direction: column;">
      <!-- Título, descripción y botón en una sola fila -->
      <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 32px; gap: 24px;">
        <div>
          <div class="mid-title" style="font-size:65px;">The top choice for creators of all sizes.</div>
          <div class="mid-desc" style="margin-bottom: 0;">From digital products to marketing tools, Kajabi has everything creators need to build.</div>
        </div>
        <button class="get-started-btn" style="background: var(--black); color: var(--white); min-width: 180px; align-self: flex-start;">Get Started</button>
      </div>
      <!-- Contenido en dos columnas: izquierda (4) y derecha (8) -->
      <div style="display: flex; width: 100%; gap: 32px;">
        <!-- Columna izquierda: tarjetas (4 columnas) -->
        <div style="flex: 0 0 33.3333%; max-width: 33.3333%; display: flex; flex-direction: column; gap: 18px;">
          <div class="no-rev-card">
            <span style="font-weight:bold;">No revenue sharing. Ever.</span><br>
            <span style="font-weight:normal;">You make the content, you reap the rewards.</span>
          </div>
          <div class="no-rev-card">
            <span style="font-weight:bold;">No revenue sharing. Ever.</span><br>
            <span style="font-weight:normal;">You make the content, you reap the rewards.</span>
          </div>
          <div class="no-rev-card">
            <span style="font-weight:bold;">No revenue sharing. Ever.</span><br>
            <span style="font-weight:normal;">You make the content, you reap the rewards.</span>
          </div>
        </div>
        <!-- Columna derecha: imagen (8 columnas) -->
        <div style="flex: 0 0 66.6666%; max-width: 66.6666%; display: flex; align-items: center; justify-content: center;">
          <img src="<?php echo base_url('uploads/elevant/banner-3.png'); ?>" alt="Mid Section" style="width: 100%; max-width: 911px; height: auto; aspect-ratio: 911/607; border-radius: 18px; object-fit: cover;">
        </div>
      </div>
    </div>
  </section>
  <!-- ICON ROW -->
  <div style="width:100%;text-align:center;margin:30px 0;">
    <img src="<?php echo base_url('uploads/elevant/Frame 26.png'); ?>" alt="Banner" style="max-width:100%;height:auto;">
  </div>
  
  <!-- Nueva sección personalizada debajo de courses-section -->
  <section class="custom-courses-section">
    <h2 class="custom-courses-title">Courses</h2>
    <div class="custom-courses-grid">
      <!-- Card 1 -->
      <div class="custom-course-card">
        <div class="custom-card-img-container">
          <img src="<?php echo base_url('uploads/elevant/Frame 17.png'); ?>" alt="Creacion de Contenido">
          <span class="custom-card-badge">Intermedio</span>
        </div>
        <div class="custom-card-content">
          <div class="custom-card-level">
            <span style="font-weight: bold;">Intermedio</span> • 00:00:30 • 2 lesson
          </div>
          <div class="custom-card-desc">Te ayudamos a crear el curso ideal para tu audiencia, sin importar el tema o tu experiencia. Aprende a identificar qué quieren...</div>
          <a href="#" class="custom-card-link">Start Course &rarr;</a>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="custom-course-card">
        <div class="custom-card-img-container">
          <img src="<?php echo base_url('uploads/elevant/Frame 18.png'); ?>" alt="Master en desarrollo">
          <span class="custom-card-badge">Intermedio</span>
        </div>
        <div class="custom-card-content">
          <div class="custom-card-level">
            <span style="font-weight: bold;">Intermedio</span> • 00:00:30 • 2 lesson
          </div>
          <div class="custom-card-desc">Te ayudamos a crear el curso ideal para tu audiencia, sin importar el tema o tu experiencia...</div>
          <a href="#" class="custom-card-link">Start Course &rarr;</a>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="custom-course-card">
        <div class="custom-card-img-container">
          <img src="<?php echo base_url('uploads/elevant/Frame 19.png'); ?>" alt="Staff in bold">
          <span class="custom-card-badge">Intermedio</span>
        </div>
        <div class="custom-card-content">
          <div class="custom-card-level">
            <span style="font-weight: bold;">Intermedio</span> • 00:00:30 • 2 lesson
          </div>
          <div class="custom-card-desc">Te ayudamos a crear el curso ideal para tu audiencia, sin importar el tema o tu experiencia. Aprende a identificar qué quieren, tal cual por tu forma de ser...</div>
          <a href="#" class="custom-card-link">Start Course &rarr;</a>
        </div>
      </div>
      <!-- Card 4 -->
      <div class="custom-course-card">
        <div class="custom-card-img-container">
          <img src="<?php echo base_url('uploads/elevant/Frame 20.png'); ?>" alt="Seguimiento de SST">
          <span class="custom-card-badge">Intermedio</span>
        </div>
        <div class="custom-card-content">
          <div class="custom-card-level">
            <span style="font-weight: bold;">Intermedio</span> • 00:00:30 • 2 lesson
          </div>
          <div class="custom-card-desc">Te ayudamos a crear el curso ideal para tu audiencia, sin importar el tema o tu experiencia...</div>
          <a href="#" class="custom-card-link">Start Course &rarr;</a>
        </div>
      </div>
    </div>
  </section>

  <!-- NEWSLETTER & FOOTER -->
  
  <!-- Reseña Historica Section -->
  <section class="resena-section">
    <h2>Reseña Historica</h2>
    <div class="resena-sub">
      From digital products to marketing tools, Kajabi<br>
      has everything creators need to build.
    </div>
    <div class="resena-desc" style="font-size:26px;">
      Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que también ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenían pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
    </div>
    <button class="resena-btn">
      Leer más
      <svg width="18" height="16" viewBox="0 0 18 16" style="margin-left: 6px;"><path d="M4 8h10m0 0-4-4m4 4-4 4" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
    </button>
  </section>

  <!-- Top Choice for Creators Section -->
  <section class="top-choice-black-section">
    <div class="top-choice-container">
      <div style="flex: 2;">
        <h2 class="top-choice-title">The top choice for<br>creators of all sizes.</h2>
      </div>
      <div style="flex: 1; min-width: 290px;">
        <div class="top-choice-desc">
          From digital products to marketing tools, Kajabi<br>
          has everything creators need to build.
        </div>
        <button class="top-choice-btn">Get Started</button>
      </div>
    </div>
    <div class="top-choice-grid">
      <!-- Card -->
      <div class="top-choice-card">
        <div class="top-choice-card-icon">
          <svg height="20" width="20" viewBox="0 0 20 20"><path d="M6 10h8m0 0-4-4m4 4-4 4" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
        </div>
        <div class="top-choice-card-title">
          No revenue sharing. Ever.
        </div>
        <div class="top-choice-card-desc">
          You make the content, you reap the rewards.
        </div>
      </div>
      <div class="top-choice-card">
        <div class="top-choice-card-icon">
          <svg height="20" width="20" viewBox="0 0 20 20"><path d="M6 10h8m0 0-4-4m4 4-4 4" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
        </div>
        <div class="top-choice-card-title">
          No revenue sharing. Ever.
        </div>
        <div class="top-choice-card-desc">
          You make the content, you reap the rewards.
        </div>
      </div>
      <div class="top-choice-card">
        <div class="top-choice-card-icon">
          <svg height="20" width="20" viewBox="0 0 20 20"><path d="M6 10h8m0 0-4-4m4 4-4 4" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
        </div>
        <div class="top-choice-card-title">
          No revenue sharing. Ever.
        </div>
        <div class="top-choice-card-desc">
          You make the content, you reap the rewards.
        </div>
      </div>
      <div class="top-choice-card">
        <div class="top-choice-card-icon">
          <svg height="20" width="20" viewBox="0 0 20 20"><path d="M6 10h8m0 0-4-4m4 4-4 4" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
        </div>
        <div class="top-choice-card-title">
          No revenue sharing. Ever.
        </div>
        <div class="top-choice-card-desc">
          You make the content, you reap the rewards.
        </div>
      </div>
      <div class="top-choice-card">
        <div class="top-choice-card-icon">
          <svg height="20" width="20" viewBox="0 0 20 20"><path d="M6 10h8m0 0-4-4m4 4-4 4" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
        </div>
        <div class="top-choice-card-title">
          No revenue sharing. Ever.
        </div>
        <div class="top-choice-card-desc">
          You make the content, you reap the rewards.
        </div>
      </div>
      <div class="top-choice-card">
        <div class="top-choice-card-icon">
          <svg height="20" width="20" viewBox="0 0 20 20"><path d="M6 10h8m0 0-4-4m4 4-4 4" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>
        </div>
        <div class="top-choice-card-title">
          No revenue sharing. Ever.
        </div>
        <div class="top-choice-card-desc">
          You make the content, you reap the rewards.
        </div>
      </div>
    </div>
  </section>
  <!-- COURSES Section -->
  <section class="courses-section">
    <div class="top-choice-header">
      <h2 style="font-size:65px; font-weight:bold; margin-bottom:8px; letter-spacing:-1px; color:var(--black);">Nuestro equipo de trabajo.</h2>
      <button class="get-started-btn" style="background: var(--black); color: var(--white);">Get Started</button> <!-- negro -->
    </div>
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
  
  <footer class="newsletter-section">
    <div class="newsletter-content">
      <div class="newsletter-title">NewsLetter</div>
      <div class="newsletter-desc">Regístrate con nosotros y te enviaremos los boletines al día sobre que necesitas</div>
      <form class="newsletter-form" autocomplete="off" onsubmit="return false;">
        <input type="text" placeholder="Ingresa tu correo o número celular" />
        <button class="get-started-btn" style="background: var(--yellow); color: var(--black);">Get Started</button>
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