<?php $active_page = 'courses'; ?>
<?php include 'navigation.php'; ?>
<?php include 'top_bar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      background: #fafafa;
    }
    body {
      min-height: 100vh;
      width: 100vw;
      overflow-x: hidden;
    }
    /* Asegura que la sidebar y topbar estén por encima */
    .left-side-menu {
      z-index: 1030 !important;
      position: fixed !important;
      left: 0;
      top: 0;
      height: 100vh;
    }
    .top-bar {
      z-index: 1020 !important;
      position: fixed !important;
      left: 80px;
      right: 0;
      top: 0;
      width: calc(100vw - 80px);
      max-width: calc(100vw - 80px); /* Evita que se salga de la pantalla */
      min-width: 0;
      box-sizing: border-box;
      background: #f9f9f9;
    }
    .main-content {
      margin-left: 80px !important;
      margin-top: 60px !important;
      padding: 0;
      min-height: calc(100vh - 60px);
      background: #fafafa;
      display: flex;
      flex-direction: row;
      z-index: 1;
      position: relative;
      width: calc(100vw - 80px);
      box-sizing: border-box;
    }
    .main-left {
      flex: 3;
      padding: 0 0 0 42px;
      border-right: 2px solid #f3f3f3;
      min-height: 100%;
      background: #fafafa;
    }
    .main-right {
      flex: 1.1;
      min-width: 320px;
      max-width: 380px;
      background: #fff;
      padding: 24px 24px 0 24px;
      min-height: 100%;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }
    .main-title {
      font-size: 2rem;
      font-weight: bold;
      margin: 40px 0 16px 0;
      color: #444;
      letter-spacing: -1.2px;
    }
    .tabs {
      display: flex;
      gap: 36px;
      border-bottom: 2px solid #eaeaea;
      margin-bottom: 0;
      margin-top: 18px;
    }
    .tab {
      background: none;
      border: none;
      font-size: 1.35rem;
      font-weight: 600;
      color: #888;
      cursor: pointer;
      padding: 8px 0 10px 0;
      border-bottom: 3px solid transparent;
      outline: none;
      margin-bottom: -2px;
      transition: color 0.18s;
    }
    .tab.active {
      color: #222;
      border-bottom: 3px solid #222;
    }
    .section-form {
      margin-top: 64px;
      max-width: 740px;
    }
    .section-form label {
      display: block;
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 10px;
      color: #444;
      letter-spacing: -1px;
    }
    .section-form .desc {
      font-size: 18px;
      color: #666;
      margin-bottom: 36px;
    }
    .section-form input[type="text"] {
      width: 92%;
      max-width: 600px;
      padding: 16px 22px;
      border-radius: 12px;
      border: 1.7px solid #ececec;
      font-size: 1.13rem;
      color: #333;
      outline: none;
      margin-bottom: 28px;
      background: #fff;
      margin-top: 7px;
      transition: border 0.18s;
    }
    .section-form input[type="text"]:focus {
      border: 1.7px solid #111;
    }
    .agregar-btn {
      margin: 0;
      margin-top: 16px;
      padding: 12px 38px;
      background: #000;
      color: #fff;
      border-radius: 14px;
      border: none;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
      display: block;
    }
    .agregar-btn:hover {
      background: #111;
    }
    .panel-tabs {
      display: flex;
      flex-direction: column;
      gap: 0;
      border-bottom: none;
      width: 100%;
      margin-bottom: 24px;
      font-size: 17px;
      font-weight: 600;
    }
    .panel-tab {
      background: none;
      border: none;
      color: #888;
      font-size: 1rem;
      font-weight: 600;
      padding: 14px 0 14px 0;
      border-left: 4px solid transparent;
      cursor: pointer;
      outline: none;
      width: 100%;
      text-align: left;
      transition: color 0.18s, border 0.18s;
    }
    .panel-tab.active {
      color: #222;
      border-left: 4px solid #222;
      background: #f6f6f6;
    }
    .panel-title {
      font-size: 1.12rem;
      font-weight: 700;
      margin: 24px 0 16px 0;
      color: #444;
    }
    .seccion-card {
      background: #fafafa;
      border-radius: 13px;
      border: 1.5px solid #ededed;
      padding: 10px 14px 10px 15px;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 12px;
      position: relative;
    }
    .badge-agregado {
      background: #efefef;
      color: #444;
      font-size: 0.92rem;
      font-weight: 600;
      padding: 3px 12px;
      border-radius: 8px;
      margin-right: 7px;
      border: 1.2px solid #e0e0e0;
    }
    .seccion-nombre {
      font-size: 1.08rem;
      font-weight: bold;
      color: #222;
      margin-right: 10px;
    }
    .ver-lecciones-btn {
      background: #eaeaea;
      color: #444;
      border: none;
      border-radius: 8px;
      padding: 4px 15px;
      font-size: 0.97rem;
      font-weight: 600;
      cursor: pointer;
      margin-right: 8px;
      transition: background 0.15s;
    }
    .ver-lecciones-btn:hover {
      background: #ccc;
    }
    .icon-btn {
      background: transparent;
      border: none;
      font-size: 1.12rem;
      color: #888;
      cursor: pointer;
      margin: 0 3px;
      padding: 3px;
      border-radius: 6px;
      transition: background 0.13s;
    }
    .icon-btn:hover {
      background: #111;
      color: #fff;
    }
    /* Añade un efecto visual a los tabs y panel-tabs */
    .tab, .panel-tab {
      cursor: pointer;
      user-select: none;
      transition: background 0.18s, color 0.18s;
    }
    .tab:hover, .panel-tab:hover {
      background: #f0f0f0;
      color: #000;
    }
    .panel-tab.active, .tab.active {
      background: #f6f6f6;
      color: #222;
    }
    @media (max-width: 1000px) {
      .top-bar {
        left: 0;
        width: 100vw;
        max-width: 100vw;
      }
      .main-content {
        margin-left: 0 !important;
        margin-top: 60px !important;
        width: 100vw;
        flex-direction: column;
      }
      .main-left, .main-right {
        padding: 18px 4vw;
        min-width: unset;
        max-width: unset;
      }
      .main-right {
        border-left: none;
        border-top: 2px solid #f3f3f3;
        margin-top: 38px;
        width: 100%;
        max-width: unset;
        min-width: unset;
        flex-direction: row;
      }
      .panel-tabs {
        flex-direction: row;
        border-bottom: 2px solid #eaeaea;
        border-left: none;
        margin-bottom: 14px;
      }
      .panel-tab {
        border-left: none;
        border-bottom: 3px solid transparent;
        padding: 8px 0 10px 0;
        width: auto;
        text-align: center;
      }
      .panel-tab.active {
        border-bottom: 3px solid #222;
        background: none;
      }
    }
  </style>
  <script>
    // Tabs funcionales para la izquierda
    document.addEventListener('DOMContentLoaded', function() {
      // Tabs de la izquierda
      document.querySelectorAll('.tabs .tab').forEach(function(tab, idx) {
        tab.addEventListener('click', function() {
          document.querySelectorAll('.tabs .tab').forEach(t => t.classList.remove('active'));
          tab.classList.add('active');
          // Aquí puedes mostrar/ocultar contenido según el tab si lo deseas
        });
      });

      // Tabs de la derecha (panel-tabs)
      document.querySelectorAll('.panel-tabs .panel-tab').forEach(function(tab, idx) {
        tab.addEventListener('click', function() {
          document.querySelectorAll('.panel-tabs .panel-tab').forEach(t => t.classList.remove('active'));
          tab.classList.add('active');
          // Aquí puedes mostrar/ocultar contenido según el tab si lo deseas
        });
      });

      // Botón "Ver Lecciones"
      document.querySelectorAll('.ver-lecciones-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
          alert('Aquí se mostrarán las lecciones de la sección (funcionalidad pendiente).');
        });
      });

      // Botón editar sección
      document.querySelectorAll('.icon-btn[title="Editar nombre sección"]').forEach(function(btn) {
        btn.addEventListener('click', function() {
          alert('Funcionalidad de editar sección próximamente.');
        });
      });

      // Botón eliminar sección
      document.querySelectorAll('.icon-btn[title="Eliminar sección"]').forEach(function(btn) {
        btn.addEventListener('click', function() {
          if (confirm('¿Seguro que deseas eliminar esta sección?')) {
            alert('Funcionalidad de eliminar sección próximamente.');
          }
        });
      });
    });
  </script>
</head>
<body>
  <!-- Top Bar y Sidebar ya importados arriba -->
  <div class="main-content">
    <div class="main-left">
      <div class="main-title" style="margin-top:38px; margin-bottom:26px;">
        Ahora vamos a crear el contenido del curso
      </div>
      <div class="tabs">
        <button class="tab active" type="button">Secciones</button>
        <button class="tab" type="button">Lecciones</button>
      </div>
      <form class="section-form" autocomplete="off" method="post" action="<?php echo site_url('user/elevant/section_add/' . $course['id']); ?>">
        <label for="section-title">Titulo de la Sección</label>
        <div class="desc">Aqui agregas el titulo para la sección y el estudiante se guie...</div>
        <div id="section_area">
          <div class="d-flex section-field">
            <input type="text" id="section-title" name="section-title" placeholder="Titulo de la sección" required style="width:92%;max-width:600px;padding:16px 22px;border-radius:12px;border:1.7px solid #ececec;font-size:1.13rem;color:#333;outline:none;margin-bottom:28px;background:#fff;margin-top:7px;transition:border 0.18s;">
          </div>
        </div>
        <button class="agregar-btn" type="submit">Guardar Sección</button>
      </form>
    </div>
    <div class="main-right">
      <div class="panel-tabs">
        <button class="panel-tab active" type="button">Secciones</button>
        <button class="panel-tab" type="button">Lecciones</button>
        <button class="panel-tab" type="button">Archivos</button>
      </div>
      <div class="panel-title">Contenido agregado</div>
      <?php if (isset($sections) && count($sections) > 0): ?>
        <?php foreach ($sections as $section): ?>
          <div class="seccion-card">
            <span class="badge-agregado">Agregado</span>
            <span class="seccion-nombre"><?php echo htmlspecialchars($section['title']); ?></span>
            <button class="ver-lecciones-btn" type="button">Ver Lecciones</button>
            <button class="icon-btn" type="button" title="Editar nombre sección">
              <!-- ...icono editar... -->
            </button>
            <button class="icon-btn" type="button" title="Eliminar sección">
              <!-- ...icono eliminar... -->
            </button>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div style="color:#888; margin-top:10px;">No hay secciones agregadas aún.</div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>