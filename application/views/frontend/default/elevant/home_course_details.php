<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detalles del Curso</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --black: #000000;
      --yellow: #B59359;
      --gray: #f6f6f6;
      --white: #FFFFFF;
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
    .page-container {
      max-width: 1100px;
      margin: 30px auto;
      padding: 20px;
    }
    .course-header {
      margin-bottom: 30px;
      position: relative; /* Asegurar que el contenido no se superponga */
      z-index: 1; /* Elevar el contenido sobre el fondo amarillo */
    }
    .course-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      font-size: 1.5rem; /* Tamaño de tipografía más grande */
      color: var(--black); /* Color negro */
      margin-bottom: 20px;
    }
    .course-meta i {
      margin-right: 0.4em;
      color: var(--black); /* Color negro */
      font-size: 2rem; /* Íconos más grandes */
    }
    .course-interest {
      background: #EEB845; /* Fondo amarillo */
      border-radius: 12px;
      padding: 20px;
      display: flex;
      flex-direction: column; /* Cambiar a columna para organizar texto y botones */
      align-items: center;
      gap: 20px;
    }
    .course-interest-content {
      display: flex;
      justify-content: space-between; /* Texto y botones en línea horizontal */
      width: 100%;
      align-items: center;
    }
    .course-interest h2 {
      margin: 0;
      font-size: 3rem; /* Aumentar tamaño para ocupar dos líneas */
      font-weight: bold;
      color: var(--black);
      line-height: 1.2; /* Reducir separación entre líneas */
    }
    .course-interest p {
      margin-top: 10px; /* Reducir separación con el texto descriptivo */
      font-size: 1.1rem;
      color: var(--black);
      max-width: 400px;
    }
    .course-interest-buttons {
      display: flex;
      gap: 15px; /* Espaciado entre botones */
    }
    .apply-btn, .cart-btn {
      font-size: 1rem;
      padding: 10px 40px; /* Expandir horizontalmente */
      border: none; /* Quitar el borde negro del botón blanco */
      border-radius: 8px;
      cursor: pointer;
      transition: background .2s;
    }
    .cart-btn {
      background: var(--white);
      color: var(--black);
    }
    .cart-btn:hover {
      background: var(--yellow);
      color: var(--white);
    }
    .apply-btn {
      background: var(--black);
      color: var(--white);
    }
    .apply-btn:hover {
      background: #444;
    }
    .course-main {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
      margin-top: 20px; /* Agregar espacio para evitar superposición */
      position: relative; /* Asegurar que el contenido no se superponga */
      z-index: 1; /* Elevar el contenido sobre el fondo amarillo */
    }
    .course-details {
      flex: 2 1 400px;
      min-width: 300px;
    }
    .course-details h1 {
      font-size: 2.7rem;
      font-weight: bold;
      margin-bottom: 20px;
      color: var(--black);
    }
    .tabs {
      display: flex;
      gap: 15px;
      margin-bottom: 20px;
    }
    .tab {
      background: none;
      border: none;
      border-bottom: 2px solid transparent;
      padding: 10px 15px;
      cursor: pointer;
      font-size: 1.2rem;
      font-weight: bold;
      color: var(--black);
      transition: border 0.2s, color 0.2s;
    }
    .tab.active {
      border-bottom: 2.5px solid var(--black);
    }
    .tab-content {
      font-size: 1.1rem;
      color: #333;
    }
    .instructor-card {
      flex: 1 1 250px;
      min-width: 250px;
      background: var(--gray);
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      margin-top: 20px; /* Agregar espacio para evitar superposición */
      border: 2px solid #d3d3d3; /* Borde gris */
      position: relative; /* Asegurar que el contenido no se superponga */
      z-index: 1; /* Elevar el contenido sobre el fondo amarillo */
    }
    .instructor-card h3 {
      margin-top: 0;
      margin-bottom: 20px;
      font-size: 1.5rem;
      font-weight: bold;
      color: var(--black);
    }
    .instructor-img {
      width: 180px;
      height: 200px;
      border-radius: 12px;
      object-fit: cover;
      background: #eee;
    }
    .instructor-profile {
      display: flex;
      gap: 15px;
      align-items: center;
    }
    .instructor-info {
      display: flex;
      flex-direction: column;
      gap: 8px;
      font-size: 1rem;
      color: var(--black);
    }
    .instructor-info div {
      font-weight: normal;
      text-decoration: none;
    }
    .instructor-info div span {
      font-weight: bold;
      text-decoration: underline;
    }
    .instructor-description {
      margin-top: 20px;
      font-size: 1rem;
      color: #555;
    }
    .course-meta img {
      width: 100%;
      border-radius: 12px;
      margin-top: 80px; /* Ajustar el margen superior para evitar superposición */
    }
    @media (max-width: 900px) {
      .course-main {
        flex-direction: column;
        gap: 20px;
      }
      .instructor-card {
        margin-top: 20px;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
  <header>
    <nav class="nav">
      <a href="<?php echo base_url('elevant/home'); ?>" class="logo">
        <img src="<?php echo base_url('uploads/elevant/elevant.png'); ?>" alt="Elevant Logo">
      </a>
      <div class="nav-links">
        <a href="<?php echo base_url('elevant/home'); ?>" class="inicio">Inicio</a>
        <a href="<?php echo base_url('elevant/home_elevant'); ?>">Elevant</a>
        <a href="<?php echo base_url('elevant/home_courses'); ?>" class="active" style="color: var(--yellow);">Cursos</a>
        <a href="<?php echo base_url('elevant/affiliates'); ?>">Afiliados</a>
        <a href="<?php echo base_url('elevant/instructor'); ?>">Instructor</a>
        <a href="<?php echo base_url('elevant/contact'); ?>">Contacto</a>
      </div>
      <div class="nav-actions">
        <button class="login" onclick="window.location.href='<?php echo site_url('elevant/login'); ?>'">login</button>
        <button class="get-started" onclick="window.location.href='<?php echo site_url('elevant/login'); ?>'">Get Started</button>
      </div>
    </nav>
  </header>

  <div class="page-container">
    <header class="course-header">
      <div class="course-meta">
        <img src="<?php echo base_url('uploads/elevant/curso_details_temp.png'); ?>" alt="Detalles del Curso" style="width: 100%; border-radius: 12px;">
      </div>
      <div class="course-interest">
        <div class="course-interest-content">
          <h2>¿Estás interesado?</h2>
          <p>No te pierdas este curso que es de interés para ti, ven inicia el proceso para que te certifiques y seas un master en el tema...</p>
        </div>
        <div class="course-interest-buttons">
          <button class="apply-btn">Aplicar ahora</button>
          <button class="cart-btn">Añadir al carrito</button>
        </div>
      </div>
    </header>

    <main class="course-main">
      <section class="course-details">
        <h1><?php echo $course['title']; ?></h1>
        <div class="tabs">
          <button class="tab active" data-tab="details">Detalles</button>
          <button class="tab" data-tab="contenido">Contenido</button>
          <button class="tab" data-tab="requisitos">Requisitos</button>
        </div>
        <div class="tab-content" id="details">
          <p>
            Este curso de desarrollo web está diseñado para proporcionar una comprensión profunda de las tecnologías modernas utilizadas en la creación de sitios web. Aprenderás desde los fundamentos de HTML y CSS hasta el uso avanzado de JavaScript y frameworks como React y Vue.js. Además, exploraremos conceptos de diseño responsivo, optimización de rendimiento y accesibilidad para garantizar que tus proyectos sean funcionales y atractivos para todos los usuarios.
          </p>
          <p>
            También se incluye una introducción a las bases de datos y cómo integrarlas con aplicaciones web utilizando tecnologías como Node.js y MongoDB. Al finalizar el curso, tendrás la capacidad de desarrollar aplicaciones web completas y escalables, listas para ser implementadas en entornos de producción.
          </p>
        </div>
        <div class="tab-content" id="contenido" style="display:none;">
          <p>
            <strong>Módulo 1: Introducción</strong><br>
            - Historia del desarrollo web<br>
            - Herramientas esenciales para desarrolladores<br>
            - Configuración del entorno de trabajo
          </p>
          <p>
            <strong>Módulo 2: HTML y CSS</strong><br>
            - Estructura básica de HTML<br>
            - Estilos con CSS: selectores, propiedades y valores<br>
            - Diseño responsivo con Flexbox y Grid
          </p>
          <p>
            <strong>Módulo 3: JavaScript</strong><br>
            - Fundamentos de programación<br>
            - Manipulación del DOM<br>
            - Introducción a ES6 y más allá
          </p>
          <p>
            <strong>Módulo 4: Frameworks y Librerías</strong><br>
            - React: Componentes y estado<br>
            - Vue.js: Directivas y reactividad<br>
            - Comparación entre frameworks populares
          </p>
          <p>
            <strong>Módulo 5: Backend y Bases de Datos</strong><br>
            - Introducción a Node.js<br>
            - Creación de APIs RESTful<br>
            - Uso de MongoDB para almacenamiento de datos
          </p>
        </div>
        <div class="tab-content" id="requisitos" style="display:none;">
          <p>
            <strong>Conocimientos previos:</strong><br>
            - Familiaridad básica con computadoras y navegación web<br>
            - Deseable, pero no obligatorio: experiencia previa con algún lenguaje de programación
          </p>
          <p>
            <strong>Material necesario:</strong><br>
            - Computadora con acceso a internet<br>
            - Editor de código (recomendado: Visual Studio Code)<br>
            - Navegador web moderno (Chrome, Firefox, Edge)
          </p>
          <p>
            <strong>Otros requisitos:</strong><br>
            - Ganas de aprender y explorar nuevas tecnologías<br>
            - Capacidad para resolver problemas y trabajar en equipo<br>
            - Tiempo dedicado para practicar y completar los ejercicios
          </p>
        </div>
      </section>

      <aside class="instructor-card">
        <h3>Detalle del instructor</h3>
        <div class="instructor-profile">
          <img src="<?php echo $instructor['image']; ?>" alt="Instructor" class="instructor-img">
          <div class="instructor-info">
            <div><span><?php echo $instructor['name']; ?></span></div>
            <div>Nombre Completo</div>
            <div><span>Hombre</span></div>
            <div>Sexo</div>
            <div><span>29 Años</span></div>
            <div>Edad</div>
            <div><span>5 Años</span></div>
            <div>Experiencia</div>
          </div>
        </div>
        <div class="instructor-description">
          <p>
            <?php echo $instructor['name']; ?> es un desarrollador web senior con más de 10 años de experiencia en la industria tecnológica. Ha trabajado en proyectos de alto impacto para empresas internacionales, liderando equipos de desarrollo y diseñando soluciones innovadoras. Su enfoque está en la creación de aplicaciones web escalables y accesibles, utilizando las últimas tecnologías disponibles.
          </p>
          <p>
            Además de su experiencia profesional, <?php echo $instructor['name']; ?> es un apasionado de la enseñanza y ha impartido talleres y cursos en diversas instituciones educativas. Su objetivo es ayudar a los estudiantes a alcanzar su máximo potencial y prepararlos para enfrentar los desafíos del mundo laboral.
          </p>
        </div>
      </aside>
    </main>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const tabs = document.querySelectorAll(".tab");
      const tabContents = {
        details: document.getElementById("details"),
        contenido: document.getElementById("contenido"),
        requisitos: document.getElementById("requisitos")
      };
      tabs.forEach(tab => {
        tab.addEventListener("click", function() {
          tabs.forEach(t => t.classList.remove("active"));
          tab.classList.add("active");
          Object.values(tabContents).forEach(tc => tc.style.display = "none");
          tabContents[tab.dataset.tab].style.display = "block";
        });
      });
    });
  </script>
  <?php include 'footer.php'; ?>
</html>
</html>
