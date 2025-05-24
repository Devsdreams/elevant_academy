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
      height: 220px;
      object-fit: cover;
      background: #eee;
      display: block;
      flex-shrink: 0;
      border-radius: 12px 12px 0 0;
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

    /* NUEVO: Estilos para el buscador y filtros de cursos */
    .courses-search-bar {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      align-items: center;
      margin: 38px auto 28px auto;
      max-width: 1100px;
      justify-content: flex-start;
    }
    .courses-search-bar input[type="text"] {
      padding: 11px 18px;
      border-radius: 10px;
      border: 1.2px solid #ccc;
      font-size: 1.08rem;
      min-width: 220px;
      outline: none;
    }
    .courses-search-bar select {
      padding: 10px 18px;
      border-radius: 10px;
      border: 1.2px solid #ccc;
      font-size: 1.08rem;
      min-width: 150px;
      outline: none;
      background: #fff;
    }
    .courses-search-bar button {
      background: var(--yellow);
      color: #181818;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      font-size: 1rem;
      padding: 10px 24px;
      cursor: pointer;
      transition: background 0.18s, color 0.18s;
    }
    .courses-search-bar button:hover {
      background: var(--black);
      color: #fff;
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
        <a href="<?php echo base_url('elevant/home_courses'); ?>">Elevant</a>
        <a href="#" class="active" style="color: var(--yellow);">Cursos</a>
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
      <!-- ...existing code... -->
    </div>
  </section>

  <!-- COURSES Section -->
  <section class="courses-section">
    <div class="top-choice-header">
      <h2 style="font-size:65px; font-weight:bold; margin-bottom:8px; letter-spacing:-1px; color:var(--black);">Explora nuestros cursos</h2>
      <!-- <button class="get-started-btn">Ver todos</button> -->
    </div>
    <section class="courses-search-bar">
      <input type="text" id="searchInput" placeholder="Buscar cursos..." />
      <select id="categoryFilter">
        <option value="">Todas las categorías</option>
        <option value="marketing">Marketing</option>
        <option value="programacion">Programación</option>
        <option value="negocios">Negocios</option>
        <!-- Agrega más categorías según tu base de datos -->
      </select>
      <select id="levelFilter">
        <option value="">Todos los niveles</option>
        <option value="basico">Básico</option>
        <option value="intermedio">Intermedio</option>
        <option value="avanzado">Avanzado</option>
      </select>
      <select id="priceFilter">
        <option value="">Todos los precios</option>
        <option value="gratis">Gratis</option>
        <option value="pago">De pago</option>
      </select>
      <button onclick="filterCourses()">Buscar</button>
    </section>
    <div class="courses-grid" id="coursesGrid">
      <!-- Aquí se mostrarán los cursos filtrados -->
    </div>
  </section>

  <!-- Modal de detalles de curso -->
  <div id="courseModal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.32); align-items:center; justify-content:center;">
    <div id="courseModalContent" style="max-height:90vh;width:100%;overflow:auto;box-sizing:border-box;"></div>
  </div>
  <style>
    body.modal-open {
      overflow: hidden !important;
    }
    #courseModal {
      overflow: auto !important;
    }
    #courseModalContent {
      /* El modal nunca debe exceder el viewport */
      max-height: 90vh;
      width: 100%;
      overflow: auto;
      box-sizing: border-box;
    }
    @media (max-width: 800px) {
      #courseModalContent {
        max-width: 98vw !important;
        padding: 10px !important;
      }
    }
  </style>
  <script>
    // Simulación de cursos (en producción, esto vendría de PHP o AJAX)
    const allCourses = [
      {
        title: "Curso de Marketing Digital",
        category: "marketing",
        level: "basico",
        price: "gratis",
        img: "<?php echo base_url('uploads/elevant/Frame 17.png'); ?>"
      },
      {
        title: "Introducción a la Programación",
        category: "programacion",
        level: "basico",
        price: "gratis",
        img: "<?php echo base_url('uploads/elevant/Frame 18.png'); ?>"
      },
      {
        title: "Negocios para Emprendedores",
        category: "negocios",
        level: "intermedio",
        price: "pago",
        img: "<?php echo base_url('uploads/elevant/Frame 19.png'); ?>"
      },
      {
        title: "Programación Avanzada",
        category: "programacion",
        level: "avanzado",
        price: "pago",
        img: "<?php echo base_url('uploads/elevant/Frame 20.png'); ?>"
      }
      // ...agrega más cursos según tu necesidad...
    ];

    // Modal HTML (ajustado para scroll y responsividad)
    const modalTemplate = `
<div style="background: #fff; border-radius: 16px; max-width: 700px; width: 95vw; box-shadow: 0 8px 32px #2222; padding: 32px 24px 28px 24px; margin: 40px auto; font-family: 'Arial Rounded MT Bold', Arial, Helvetica, sans-serif; position:relative; max-height:85vh; overflow-y:auto;">
  <button onclick="closeCourseModal()" style="position:absolute;top:18px;right:18px;background:none;border:none;font-size:1.7rem;cursor:pointer;color:#888;z-index:2;">&times;</button>
  <div style="font-size: 2rem; font-weight: bold; margin-bottom: 16px; letter-spacing: -1.2px;" id="modalCourseTitle">Details of Course</div>
  <div style="display: flex; flex-wrap: wrap; gap: 28px;">
    <!-- Left: Tabs and content -->
    <div style="flex: 2.5; min-width: 220px;">
      <!-- Tabs -->
      <div style="display: flex; gap: 22px; border-bottom: 2px solid #e5e5e5; margin-bottom: 18px; flex-wrap:wrap;">
        <button class="modal-tab-btn" data-tab="details" style="background: none; border: none; font-size: 1.1rem; font-weight: bold; color: #222; border-bottom: 3px solid #222; padding: 9px 16px 5px 0; cursor: pointer;">Detalles</button>
        <button class="modal-tab-btn" data-tab="contenido" style="background: none; border: none; font-size: 1.1rem; font-weight: bold; color: #888; border-bottom: 3px solid transparent; padding: 9px 16px 5px 0; cursor: pointer;">Contenido</button>
        <button class="modal-tab-btn" data-tab="requisitos" style="background: none; border: none; font-size: 1.1rem; font-weight: bold; color: #888; border-bottom: 3px solid transparent; padding: 9px 16px 5px 0; cursor: pointer;">Requisitos</button>
      </div>
      <!-- Content -->
      <div id="modalTabContent-details" class="modal-tab-content" style="font-size: 1rem; color: #222; line-height: 1.7; margin-bottom: 10px;">
        Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No solo sobrevivió 500 años, sino que también ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenían pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
        <br><br>
        <b>¿De dónde viene?</b><br>
        Al contrario del pensamiento popular, el texto de Lorem Ipsum no es simplemente texto aleatorio. Tiene sus raíces en una pieza clásica de la literatura del Latin, que data del año 45 antes de Cristo, haciendo que este adquiera mas de 2000 años de antigüedad. Richard McClintock, un profesor de Latin de la Universidad de Hampden-Sydney en Virginia, encontró una de las palabras más oscuras del latín, "consectetur", en un pasaje de Lorem Ipsum, y tras seguir la pista a través de la literatura clásica, descubrió la fuente indudable. Lorem Ipsum proviene de las secciones 1.10.32 y 1.10.33 de "de Finibus Bonorum et Malorum" (Los Extremos del Bien y el Mal) por Cicerón, escrito en el año 45 antes de Cristo. Este libro es un tratado sobre la teoría de la ética, muy popular durante el Renacimiento. La primera línea del Lorem Ipsum, "Lorem ipsum dolor sit amet..", proviene de una línea en la sección 1.10.32
      </div>
      <div id="modalTabContent-contenido" class="modal-tab-content" style="display:none;font-size: 1rem; color: #222; line-height: 1.7; margin-bottom: 10px;">
        <ul style="padding-left:18px;">
          <li>Lección 1: Introducción</li>
          <li>Lección 2: Conceptos básicos</li>
          <li>Lección 3: Ejercicios prácticos</li>
        </ul>
      </div>
      <div id="modalTabContent-requisitos" class="modal-tab-content" style="display:none;font-size: 1rem; color: #222; line-height: 1.7; margin-bottom: 10px;">
        <ul style="padding-left:18px;">
          <li>Ganas de aprender</li>
          <li>Computador o dispositivo móvil</li>
          <li>Conexión a internet</li>
        </ul>
      </div>
    </div>
    <!-- Right: Profile -->
    <aside style="flex: 1.2; min-width: 210px;">
      <div style="background: #fafafa; border-radius: 15px; border: 1.5px solid #e5e5e5; box-shadow: 0 1px 8px #eaeaea60; padding: 20px 16px;">
        <div style="font-weight: 600; font-size: 1.08rem; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
          <svg width="18" height="18" fill="none" style="vertical-align: middle; margin-bottom: -3px;"><circle cx="9" cy="9" r="8" stroke="#a58bed" stroke-width="2"/><path d="M6 13c0-1.67 4-1.67 4 0" stroke="#a58bed" stroke-width="2" stroke-linecap="round"/><circle cx="9" cy="8" r="2" stroke="#a58bed" stroke-width="2"/></svg>
          Detalle del instructor
        </div>
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
          <img src="https://placehold.org/70x70?text=Foto" alt="Instructor" style="border-radius: 14px; width: 70px; height: 70px; object-fit: cover; border: 2px solid #eee;">
          <div>
            <div style="font-weight: bold; font-size: 1.09rem;">Cesar Gomez</div>
            <div style="font-size: .92rem; color: #444;">@cesargomez</div>
            <div style="font-size: .9rem; color: #888;">2 años</div>
            <div style="font-size: .9rem; color: #888;">6 cursos</div>
          </div>
        </div>
        <div style="font-size: 1.03rem; font-weight: bold; margin-bottom: 6px;">Perfil profesional</div>
        <div style="font-size: .95rem; color: #181818; margin-bottom: 10px; line-height: 1.4;">
          Cesar tiene más de dos años de experiencia enseñando a estudiantes de todas las edades. Ha participado en la creación de cursos de contenido digital y ha sido conferencista en diferentes eventos de su área. Actualmente se destaca como líder en la creación de cursos de la hoja de vida y habilidades.
        </div>
        <div style="margin-bottom: 7px;">
          <a href="mailto:cesargomez@elevant.com" style="color: #222; font-size: 0.98rem; text-decoration: none; word-break: break-all;">
            <svg width="15" height="15" style="vertical-align: middle; margin-bottom: -2px;" fill="none"><rect x="1.5" y="3" width="12" height="9" rx="2" stroke="#a58bed" stroke-width="1.5"/><path d="M2.5 4.5 7.5 8.5l5-4" stroke="#a58bed" stroke-width="1.2"/></svg>
            cesargomez@elevant.com
          </a>
        </div>
        <div style="margin-bottom: 7px;">
          <svg width="16" height="16" fill="none" style="vertical-align: middle; margin-bottom: -2px;"><circle cx="8" cy="8" r="7" stroke="#a58bed" stroke-width="1.5"/><path d="M4.5 12c.5-1.5 3.5-1.5 4 0" stroke="#a58bed" stroke-width="1.5" stroke-linecap="round"/><circle cx="8" cy="7" r="2" stroke="#a58bed" stroke-width="1.5"/></svg>
          +57 301 287 55 44
        </div>
        <div style="display: flex; gap: 8px; margin-top: 4px;">
          <a href="#" style="color: #181818; font-size: 1.17rem;" title="Instagram"><svg width="18" height="18" fill="none"><rect x="2" y="2" width="14" height="14" rx="4" stroke="#a58bed" stroke-width="2"/><circle cx="9" cy="9" r="3" stroke="#a58bed" stroke-width="2"/><circle cx="13" cy="5" r="1" fill="#a58bed"/></svg></a>
          <a href="#" style="color: #181818; font-size: 1.17rem;" title="Facebook"><svg width="18" height="18" fill="none"><rect x="2" y="2" width="14" height="14" rx="4" stroke="#a58bed" stroke-width="2"/><path d="M10 6.5h1.5V5.25A.75.75 0 0 1 12.25 4.5h.5A.75.75 0 0 1 13.5 5.25V6.5h1.25a.75.75 0 0 1 0 1.5H13.5v4.75a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75V8H10A.75.75 0 0 1 9.25 7.25v-.5A.75.75 0 0 1 10 6.5Z" fill="#a58bed"/></svg></a>
          <a href="#" style="color: #181818; font-size: 1.17rem;" title="LinkedIn"><svg width="18" height="18" fill="none"><rect x="2" y="2" width="14" height="14" rx="4" stroke="#a58bed" stroke-width="2"/><rect x="6" y="7" width="2" height="5" fill="#a58bed"/><ellipse cx="7" cy="5.5" rx="1" ry="1" fill="#a58bed"/><rect x="10" y="9" width="2" height="3" fill="#a58bed"/></svg></a>
        </div>
      </div>
    </aside>
  </div>
  <!-- Payment Methods -->
  <div style="margin-top: 38px;">
    <div style="font-size: 1.5rem; font-weight: bold; margin-bottom: 8px; letter-spacing: -1px;">Métodos<br>de Pago</div>
    <div style="display: flex; gap: 24px; margin-top: 18px; flex-wrap:wrap;">
      <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="Visa" style="height: 38px;">
      <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" alt="Mastercard" style="height: 38px;">
      <img src="https://upload.wikimedia.org/wikipedia/commons/3/30/American_Express_logo_%282018%29.svg" alt="Amex" style="height: 38px;">
      <img src="https://upload.wikimedia.org/wikipedia/commons/4/43/Paypal.png" alt="PayPal" style="height: 38px;">
    </div>
  </div>
</div>
`;

    // Permitir cerrar el modal haciendo clic fuera del contenido
    document.addEventListener('DOMContentLoaded', function() {
      var modal = document.getElementById('courseModal');
      modal.addEventListener('click', function(e) {
        if (e.target === modal) {
          closeCourseModal();
        }
      });
    });

    function openCourseModal(course) {
      document.getElementById('courseModalContent').innerHTML = modalTemplate.replace('Details of Course', course.title);
      document.getElementById('courseModal').style.display = 'flex';
      document.body.classList.add('modal-open');
      document.documentElement.style.overflow = 'hidden';

      // Tabs funcionalidad
      var tabBtns = document.querySelectorAll('.modal-tab-btn');
      var tabContents = document.querySelectorAll('.modal-tab-content');
      tabBtns.forEach(function(btn) {
        btn.onclick = function() {
          tabBtns.forEach(b => {
            b.style.color = '#888';
            b.style.borderBottom = '3px solid transparent';
          });
          btn.style.color = '#222';
          btn.style.borderBottom = '3px solid #222';
          tabContents.forEach(tc => tc.style.display = 'none');
          document.getElementById('modalTabContent-' + btn.getAttribute('data-tab')).style.display = 'block';
        };
      });
    }
    function closeCourseModal() {
      document.getElementById('courseModal').style.display = 'none';
      document.body.classList.remove('modal-open');
      document.documentElement.style.overflow = '';
    }

    function renderCourses(courses) {
      const grid = document.getElementById('coursesGrid');
      grid.innerHTML = '';
      if (courses.length === 0) {
        grid.innerHTML = '<div style="padding:30px;">No se encontraron cursos.</div>';
        return;
      }
      courses.forEach(course => {
        grid.innerHTML += `
          <div class="course-card" style="cursor:pointer;" onclick='openCourseModal(${JSON.stringify(course)})'>
            <img src="${course.img}" alt="${course.title}" style="width:100%;height:220px;object-fit:cover;display:block;border-radius:12px 12px 0 0;">
            <div class="course-card-content" style="padding:18px;">
              <div style="font-weight:bold;font-size:1.1rem;margin-bottom:7px;">${course.title}</div>
              <div style="font-size:0.98rem;color:#888;margin-bottom:4px;">Categoría: ${course.category.charAt(0).toUpperCase() + course.category.slice(1)}</div>
              <div style="font-size:0.98rem;color:#888;margin-bottom:4px;">Nivel: ${course.level.charAt(0).toUpperCase() + course.level.slice(1)}</div>
              <div style="font-size:0.98rem;color:#888;">${course.price === 'gratis' ? 'Gratis' : 'De pago'}</div>
            </div>
          </div>
        `;
      });
    }

    function filterCourses() {
      const search = document.getElementById('searchInput').value.toLowerCase();
      const category = document.getElementById('categoryFilter').value;
      const level = document.getElementById('levelFilter').value;
      const price = document.getElementById('priceFilter').value;
      const filtered = allCourses.filter(course => {
        return (
          (search === '' || course.title.toLowerCase().includes(search)) &&
          (category === '' || course.category === category) &&
          (level === '' || course.level === level) &&
          (price === '' || course.price === price)
        );
      });
      renderCourses(filtered);
    }

    // Inicializar con todos los cursos
    document.addEventListener('DOMContentLoaded', function() {
      renderCourses(allCourses);
    });
  </script>
</body>
</html>