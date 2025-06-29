<?php $active_page = 'courses'; ?>
<?php include 'navigation.php'; ?>
<?php include 'top_bar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <style>
    :root {
        --primary: #000000; /* Negro */
        --secondary: #B59359; /* Dorado */
        --tertiary: #ffffff; /* Blanco */
    }

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
      margin: 16px auto 0 auto; /* Centrar el botón horizontalmente */
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
      background: #d4edda; /* Verde suave */
      color: #155724;
      font-size: 0.92rem;
      font-weight: 600;
      padding: 3px 12px;
      border-radius: 8px;
      margin-right: 7px;
      border: 1.2px solid #c3e6cb;
    }
    .seccion-nombre {
      font-size: 1.08rem;
      font-weight: bold;
      color: #222;
      margin-right: 10px;
    }
    .ver-lecciones-text {
      color: #000; /* Estilo similar al botón "Guardar Sección" */
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      text-decoration: underline;
      transition: color 0.2s;
    }
    .ver-lecciones-text:hover {
      color: #111; /* Hover similar al botón "Guardar Sección" */
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
    .icon-btn.eliminar-btn {
      background: #f8d7da; /* Rojo suave */
      color: #721c24;
      border: none;
      border-radius: 8px;
      padding: 4px 15px;
      font-size: 0.97rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.15s;
    }
    .icon-btn.eliminar-btn:hover {
      background: #f5c6cb; /* Rojo más oscuro */
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
    .lesson-form label {
      display: block;
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 10px;
      color: #444;
      letter-spacing: -1px;
    }
    .lesson-form .desc {
      font-size: 18px;
      color: #666;
      margin-bottom: 36px;
    }
    .lesson-form select, .lesson-form input[type="text"] {
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
    .lesson-form select:focus, .lesson-form input[type="text"]:focus {
      border: 1.7px solid #111;
    }
    .acciones-btn {
      background: transparent;
      border: 1.5px solid #000;
      color: #000;
      border-radius: 8px;
      padding: 8px 16px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      position: relative;
      transition: background 0.2s, color 0.2s;
    }
    .acciones-btn:hover {
      background: #000;
      color: #fff;
    }
    .acciones-dropdown {
      display: none;
      position: absolute;
      top: calc(100% + 8px); /* Justo debajo del botón */
      left: 50%;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      z-index: 10;
      width: 150px;
      opacity: 0;
      transform: translateY(-10px);
      transition: opacity 0.3s ease, transform 0.3s ease;
    }
    .acciones-dropdown.show {
      display: block;
      opacity: 1;
      transform: translateY(0);
    }
    .acciones-dropdown a {
      display: block;
      padding: 8px 12px;
      font-size: 0.95rem;
      color: #000;
      text-decoration: none;
      border-bottom: 1px solid #eee;
      cursor: pointer;
      transition: background 0.2s ease;
    }
    .acciones-dropdown a:last-child {
      border-bottom: none;
    }
    .acciones-dropdown a:hover {
      background: #f0f0f0;
    }
    .form-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
      width: 100%;
      max-width: 740px;
      padding: 20px;
      box-sizing: border-box;
    }
    /* Estilos para el modal de tipo de lección */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1050;
      align-items: center;
      justify-content: center;
    }
    .modal-content {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #ddd;
      padding-bottom: 10px;
    }
    .modal-header h4 {
      margin: 0;
      font-size: 1.5rem;
      font-weight: bold;
      color: #444;
    }
    .modal-header button {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: #888;
    }
    .modal-body {
      margin-top: 20px;
    }
    .form-label {
      font-size: 1.2rem;
      font-weight: bold;
      color: #444;
      margin-bottom: 8px;
    }
    .form-control {
      width: 100%;
      max-width: 600px;
      padding: 12px 16px;
      border-radius: 8px;
      border: 1.5px solid #ddd;
      font-size: 1rem;
      color: #333;
      outline: none;
      margin-bottom: 16px;
      background: #fff;
      transition: border 0.2s;
    }
    .form-control:focus {
      border: 1.5px solid #000;
    }
    .acciones-btn {
      background: transparent;
      border: 1.5px solid #000;
      color: #000;
      border-radius: 8px;
      padding: 8px 16px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
    }
    .acciones-btn:hover {
      background: #000;
      color: #fff;
    }
    .acciones-btn.selected {
      background: #000;
      color: #fff;
    }
    .form-label {
      font-size: 1rem;
      font-weight: 600;
      color: #444;
      margin-bottom: 6px;
    }
    .form-control {
      width: 100%;
      max-width: 600px;
      padding: 10px 14px;
      border-radius: 8px;
      border: 1.5px solid #ddd;
      font-size: 0.9rem;
      color: #333;
      outline: none;
      margin-bottom: 12px;
      background: #fff;
      transition: border 0.2s;
    }
    .form-control:focus {
      border: 1.5px solid #000;
    }
    .next-btn, .submit-btn {
      background: #000;
      color: #fff;
      border-radius: 8px;
      padding: 10px 20px;
      font-size: 0.9rem;
      font-weight: 600;
      cursor: pointer;
      border: none;
      transition: background 0.2s;
    }
    .next-btn:hover, .submit-btn:hover {
      background: #111;
    }
    .acciones-btn {
      background: transparent;
      border: 1.5px solid #000;
      color: #000;
      border-radius: 8px;
      padding: 8px 16px;
      font-size: 0.9rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
    }
    .acciones-btn:hover {
      background: #000;
      color: #fff;
    }
    .acciones-btn.selected {
      background: #000;
      color: #fff;
    }

    #add-lesson-btn {
        background-color: var(--primary);
        color: var(--tertiary);
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
    }

    #add-lesson-btn:hover {
        background-color: #333333; /* Negro más oscuro */
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: var(--tertiary);
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
        border: 1px solid var(--primary);
        padding: 12px;
        text-align: left;
        font-size: 14px;
    }

    .table th {
        background-color: var(--secondary);
        color: var(--tertiary);
        font-weight: bold;
        text-transform: uppercase;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9; /* Gris claro */
    }

    .table tbody tr:hover {
        background-color: #e0e0e0; /* Gris más oscuro */
    }

    .btn {
        padding: 8px 12px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .btn-warning {
        background-color: var(--secondary);
        color: var(--tertiary);
    }

    .btn-warning:hover {
        background-color: #9E7A4A; /* Dorado más oscuro */
    }

    .btn-info {
        background-color: var(--primary);
        color: var(--tertiary);
    }

    .btn-info:hover {
        background-color: #333333; /* Negro más oscuro */
    }

    .btn-danger {
        background-color: #DC3545; /* Rojo */
        color: var(--tertiary);
    }

    .btn-danger:hover {
        background-color: #C82333; /* Rojo más oscuro */
    }

    .main-list {
        max-width: 1200px !important;
        width: 100% !important;
        min-width: 900px !important;
    }
    .dataTables_wrapper {
        width: 100% !important;
        min-width: 900px !important;
        max-width: 1200px !important;
    }
    .leccion-card {
        background: #f6f6f6;
        border-radius: 24px;
        display: flex;
        align-items: center;
        padding: 0 24px 0 16px;
        gap: 18px;
        min-height: 64px;
        box-sizing: border-box;
        border: none;
        position: relative;
    }
    .leccion-card:not(:first-child) {
        background: #fff;
        border: 1.6px solid #ededed;
        min-height: 60px;
    }
    .img-icon {
        width: 45px;
        height: 45px;
        background: #eee;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        color: #444;
        margin-right: 8px;
    }
    .leccion-titulo {
        font-weight: bold;
        font-size: 17px;
        color: #444;
        margin-right: 18px;
    }
    .leccion-date {
        color: #888;
        font-size: 15px;
        margin-left: auto;
        margin-right: 20px;
        font-weight: 500;
    }
    .leccion-status {
        background: #eee;
        color: #222;
        border-radius: 12px;
        padding: 2px 14px;
        font-size: 15px;
        font-weight: bold;
        display: inline-block;
        margin-right: 18px;
    }
    .leccion-menu {
        background: #eee;
        border-radius: 50%;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-left: 0px;
        margin-right: 0px;
        cursor: pointer;
        border: 1px solid #e8e8e8;
        transition: background 0.15s;
    }
    .leccion-menu:hover {
        background: #ddd;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        background: #fff;
        border: 1.6px solid #ededed;
        border-radius: 50%;
        color: #222 !important;
        font-size: 18px;
        font-weight: bold;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 2px;
        transition: background 0.18s, color 0.18s;
        box-shadow: none;
        outline: none;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #000 !important;
        color: #fff !important;
        border-color: #000 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        background: #f6f6f6 !important;
        color: #ccc !important;
        border-color: #ededed !important;
        cursor: default !important;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        padding: 8px 15px;
        font-size: 14px;
        color: #666;
        background: #fff;
        margin-left: 10px;
        outline: none;
        transition: border 0.2s;
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 14px;
        color: #222;
        background: #fff;
        outline: none;
        margin-left: 5px;
    }
    .dataTables_wrapper .dataTables_info {
        color: #888;
        font-size: 15px;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    #datatable-lecciones thead {
        display: none;
    }
    #datatable-lecciones {
        background: transparent !important;
    }

    .lesson-type-selector {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 20px;
    }
    .lesson-type-selector button {
      padding: 10px 20px;
      font-size: 1rem;
      border: 1.5px solid #000;
      background: transparent;
      color: #000;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
    }
    .lesson-type-selector button:hover {
      background: #000;
      color: #fff;
    }
    .lesson-type-selector button.selected {
      background: #000;
      color: #fff;
    }
    .form-container {
      display: none;
    }
    .form-container.active {
      display: block;
    }
    .lesson-form-container {
      display: none;
      margin-top: 20px;
    }
    .lesson-form-container.active {
      display: block;
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Tabs funcionales para mostrar formularios según la pestaña activa
      document.querySelectorAll('.tabs .tab').forEach(function(tab, idx) {
        tab.addEventListener('click', function() {
          document.querySelectorAll('.tabs .tab').forEach(t => t.classList.remove('active'));
          tab.classList.add('active');
          
          // Ocultar todos los contenedores
          document.querySelectorAll('.main-left > .form-container').forEach(container => {
            container.style.display = 'none';
          });
          
          // Mostrar el contenedor correspondiente
          const containers = document.querySelectorAll('.main-left > .form-container');
          if (containers[idx]) {
            containers[idx].style.display = 'block';
          }
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
      document.querySelectorAll('.icon-btn.eliminar-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
          if (confirm('¿Seguro que deseas eliminar esta sección?')) {
            alert('Funcionalidad de eliminar sección próximamente.');
          }
        });
      });

      document.querySelectorAll('.acciones-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
          // Cerrar otros desplegables antes de abrir el actual
          document.querySelectorAll('.acciones-dropdown').forEach(function (dropdown) {
            dropdown.classList.remove('show');
          });
          const dropdown = btn.nextElementSibling;
          dropdown.classList.toggle('show');
        });
      });

      document.addEventListener('click', function (event) {
        if (!event.target.closest('.acciones-btn') && !event.target.closest('.acciones-dropdown')) {
          document.querySelectorAll('.acciones-dropdown').forEach(function (dropdown) {
            dropdown.classList.remove('show');
          });
        }
      });

      document.querySelectorAll('.acciones-dropdown .eliminar-btn').forEach(function(btn) {
        btn.addEventListener('click', function(event) {
          event.preventDefault();
          const sectionId = btn.getAttribute('data-section-id');
          const courseId = btn.getAttribute('data-course-id');
          if (confirm('¿Seguro que deseas eliminar esta sección?')) {
            window.location.href = `<?php echo site_url('user/elevant_section/'); ?>${courseId}/delete/${sectionId}`;
          }
        });
      });
    });
    function openLessonTypeModal() {
      document.getElementById('lesson-type-modal').style.display = 'flex';
    }

    function closeLessonTypeModal() {
      document.getElementById('lesson-type-modal').style.display = 'none';
    }

    function openIframeLessonModal() {
      alert('Abrir formulario para lección tipo iframe.');
      closeLessonTypeModal();
    }

    function openTextLessonModal() {
      alert('Abrir formulario para lección tipo texto.');
      closeLessonTypeModal();
    }

    function openVideoLessonModal() {
      alert('Abrir formulario para lección tipo video.');
      closeLessonTypeModal();
    }

    function showLessonForm(type) {
      // Remover selección previa
      document.querySelectorAll('.lesson-type-selector button').forEach(btn => {
        btn.classList.remove('selected');
      });
      
      // Seleccionar botón actual
      event.target.classList.add('selected');
      
      // Ocultar todos los formularios de lección
      document.querySelectorAll('.lesson-form-container').forEach(form => {
        form.classList.remove('active');
      });
      
      // Mostrar el formulario correspondiente
      const targetForm = document.getElementById(`lesson-form-${type}`);
      if (targetForm) {
        targetForm.classList.add('active');
      }
    }
  </script>
  <div id="modal-container"></div>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>
<body>
  <!-- Top Bar y Sidebar ya importados arriba -->
  <div class="main-content">
    <div class="main-left">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h4 style="margin: 0; font-size: 2rem; font-weight: bold; color: #444;">Ahora vamos a crear el contenido del curso</h4>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo site_url('user/elevant/course_config/' . $course['id']); ?>'">
            Volver al curso
        </button>
      </div>
      <div class="tabs">
        <button class="tab active" type="button">Secciones</button>
        <button class="tab" type="button">Lecciones</button>
      </div>
      <div class="form-container" style="display: block;">
        <!-- Formulario para agregar secciones -->
        <form class="section-form" autocomplete="off" method="post" action="<?php echo site_url('user/elevant_section/' . $course['id'] . '/add'); ?>">
          <label for="section-title">Titulo de la Sección</label>
          <div class="desc">Aqui agregas el titulo para la sección y el estudiante se guie...</div>
          <div id="section_area">
            <div class="d-flex section-field">
              <input type="text" id="section-title" name="title" placeholder="Titulo de la sección" required>
            </div>
          </div>
          <button class="agregar-btn" type="submit">Guardar Sección</button>
        </form>
      </div>
      <div class="form-container" style="display: none;">
        <!-- Título para el selector de tipo de lección -->
        <div style="text-align: center; margin-bottom: 20px;">
          <h3 style="font-size: 1.5rem; font-weight: bold; color: #444; margin: 0;">Elige el tipo de lección</h3>
          <p style="font-size: 1rem; color: #666; margin: 8px 0 0 0;">Selecciona el formato que mejor se adapte a tu contenido</p>
        </div>
        <!-- Selector de tipo de lección -->
        <div class="lesson-type-selector">
          <button type="button" onclick="showLessonForm('video')">Video</button>
          <button type="button" onclick="showLessonForm('document')">Documento</button>
          <button type="button" onclick="showLessonForm('text')">Texto</button>
        </div>
        <!-- Formularios de lección -->
        <div id="lesson-form-video" class="lesson-form-container">
          <div style="background: #fafafa; max-width: 600px; margin: 0 auto; border-radius: 12px; border: 1.5px solid #ededed; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 24px;">
            <div style="font-size: 1.8rem; font-weight: bold; margin-bottom: 18px; color: #111;">Agregar nueva lección - Video</div>
            <form method="post" action="<?php echo site_url('user/elevant_lessons/' . $course['id'] . '/add'); ?>" enctype="multipart/form-data">
              <!-- Campos ocultos con valores exactos del formulario que funciona -->
              <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
              <input type="hidden" name="lesson_type" value="system-video">
              <input type="hidden" name="lesson_provider" value="system_video">
              
              <div style="background: #e8f5e9; color: #0b875b; border-radius: 8px; padding: 12px; font-size: 1rem; display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                Tipo de lección: <strong>Video</strong>
              </div>
              
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Título</label>
              <input type="text" name="title" placeholder="Escribe el título de la lección" required style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; margin-bottom: 16px;">
              
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Sección</label>
              <select name="section_id" required style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; margin-bottom: 16px;">
                <option value="">Selecciona una sección</option>
                <?php foreach ($sections as $section): ?>
                  <option value="<?php echo $section['id']; ?>"><?php echo htmlspecialchars($section['title']); ?></option>
                <?php endforeach; ?>
              </select>
              
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Subir archivo de video</label>
              <input type="file" name="system_video_file" accept="video/*" required style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; margin-bottom: 8px;">
              <div style="font-size: 0.9rem; color: #666; margin-bottom: 16px;">Tamaño máximo: 256MB</div>
              
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Duración</label>
              <input type="text" name="system_video_file_duration" placeholder="00:00:00" required style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; margin-bottom: 16px;">
              
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Resumen</label>
              <textarea name="summary" placeholder="Escribe un resumen de la lección" style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; resize: vertical; min-height: 80px; margin-bottom: 16px;"></textarea>
              
              <div style="font-size: 1rem; margin-top: 12px; margin-bottom: 16px;">
                <label><input type="checkbox" name="free_lesson" value="1" style="margin-right: 8px;"> Marcar como lección gratuita</label>
              </div>
              <button type="submit" style="background: #00c48c; color: #fff; border: none; border-radius: 8px; font-size: 1.2rem; padding: 12px; font-weight: bold; cursor: pointer; transition: background 0.2s; width: 100%;">Agregar lección</button>
            </form>
          </div>
        </div>
        <div id="lesson-form-document" class="lesson-form-container">
          <div style="background: #fafafa; max-width: 600px; margin: 0 auto; border-radius: 12px; border: 1.5px solid #ededed; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 24px;">
            <div style="font-size: 1.8rem; font-weight: bold; margin-bottom: 18px; color: #111;">Agregar nueva lección - Documento</div>
            <form method="post" action="<?php echo site_url('user/elevant_lesson/' . $course['id'] . '/add'); ?>" enctype="multipart/form-data">
              <input type="hidden" name="lesson_type" value="document">
              <div style="background: #e3f2fd; padding: 12px; border-radius: 8px; font-size: 1rem; color: #1976d2; margin-bottom: 16px;">
                Tipo de lección: <strong>Documento.</strong>
              </div>
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Título</label>
              <input type="text" name="title" placeholder="Escribe el título de la lección" required style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; margin-bottom: 16px;">
              
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Sección</label>
              <select name="section_id" required style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; margin-bottom: 16px;">
                <option value="">Selecciona una sección</option>
                <?php foreach ($sections as $section): ?>
                  <option value="<?php echo $section['id']; ?>"><?php echo htmlspecialchars($section['title']); ?></option>
                <?php endforeach; ?>
              </select>
              
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Archivo adjunto</label>
              <input type="file" name="attachment" accept=".pdf,.doc,.docx,.xls,.xlsx" style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; margin-bottom: 16px;">
              
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Resumen</label>
              <textarea name="summary" placeholder="Escribe el contenido de la lección" style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; resize: vertical; min-height: 80px; margin-bottom: 16px;"></textarea>
              
              <div style="font-size: 1rem; margin-top: 12px; margin-bottom: 16px;">
                <label><input type="checkbox" name="is_free" value="1" style="margin-right: 8px;"> Marcar como lección gratuita</label>
              </div>
              <button type="submit" style="background: #00c48c; color: #fff; border: none; border-radius: 8px; font-size: 1.2rem; padding: 12px; font-weight: bold; cursor: pointer; transition: background 0.2s; width: 100%;">Agregar lección</button>
            </form>
          </div>
        </div>
        <div id="lesson-form-text" class="lesson-form-container">
          <div style="background: #fafafa; max-width: 600px; margin: 0 auto; border-radius: 12px; border: 1.5px solid #ededed; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 24px;">
            <div style="font-size: 1.8rem; font-weight: bold; margin-bottom: 18px; color: #111;">Agregar nueva lección - Texto</div>
            <form method="post" action="<?php echo site_url('user/elevant_lesson/' . $course['id'] . '/add'); ?>" enctype="multipart/form-data">
              <input type="hidden" name="lesson_type" value="text">
              <div style="background: #e3f2fd; padding: 12px; border-radius: 8px; font-size: 1rem; color: #1976d2; margin-bottom: 16px;">
                Tipo de lección: <strong>Texto.</strong>
              </div>
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Título</label>
              <input type="text" name="title" placeholder="Escribe el título de la lección" required style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; margin-bottom: 16px;">
              
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Sección</label>
              <select name="section_id" required style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; margin-bottom: 16px;">
                <option value="">Selecciona una sección</option>
                <?php foreach ($sections as $section): ?>
                  <option value="<?php echo $section['id']; ?>"><?php echo htmlspecialchars($section['title']); ?></option>
                <?php endforeach; ?>
              </select>
              
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Contenido de texto</label>
              <textarea name="attachment" placeholder="Escribe el contenido de la lección" required style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; resize: vertical; min-height: 120px; margin-bottom: 16px;"></textarea>
              
              <label style="font-size: 1rem; font-weight: 600; margin-bottom: 6px; color: #333; display: block;">Resumen</label>
              <textarea name="summary" placeholder="Escribe un resumen de la lección" style="width: 100%; padding: 12px; border: 1.5px solid #ededed; border-radius: 8px; font-size: 1rem; background: #f9f9f9; color: #222; box-sizing: border-box; resize: vertical; min-height: 80px; margin-bottom: 16px;"></textarea>
              
              <div style="font-size: 1rem; margin-top: 12px; margin-bottom: 16px;">
                <label><input type="checkbox" name="is_free" value="1" style="margin-right: 8px;"> Marcar como lección gratuita</label>
              </div>
              <button type="submit" style="background: #00c48c; color: #fff; border: none; border-radius: 8px; font-size: 1.2rem; padding: 12px; font-weight: bold; cursor: pointer; transition: background 0.2s; width: 100%;">Agregar lección</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="main-right">
      <div class="panel-tabs">
        <button class="panel-tab active" type="button" onclick="showSections()">Secciones</button>
        <button class="panel-tab" type="button" onclick="showLessons()">Lecciones</button>
        <button class="panel-tab" type="button">Archivos</button>
      </div>
      <div class="panel-title">Contenido agregado</div>

      <script>
          function showSections() {
              const content = document.getElementById('content');
              content.innerHTML = ''; // Limpiar contenido
              <?php foreach ($sections as $section): ?>
                  content.innerHTML += `
                      <div class="seccion-card">
                          <span class="badge-agregado">Agregado</span>
                          <span class="seccion-nombre"><?php echo htmlspecialchars($section['title']); ?></span>
                          <button class="acciones-btn">Acciones</button>
                          <div class="acciones-dropdown">
                              <a href="#" title="Eliminar sección" class="eliminar-btn" data-section-id="<?php echo $section['id']; ?>" data-course-id="<?php echo $course['id']; ?>">Eliminar</a>
                          </div>
                          <div class="lecciones-container">
                              <?php 
                              $lessons = $this->crud_model->get_lessons('section', $section['id'])->result_array();
                              foreach ($lessons as $lesson): ?>
                                  <div class="seccion-card">
                                      <span class="badge-agregado">Lección</span>
                                      <span class="seccion-nombre"><?php echo htmlspecialchars($lesson['title']); ?></span>
                                      <button class="acciones-btn">Acciones</button>
                                      <div class="acciones-dropdown">
                                          <a href="#" title="Editar lección" class="editar-btn" data-lesson-id="<?php echo $lesson['id']; ?>">Editar</a>
                                          <a href="#" title="Eliminar lección" class="eliminar-btn" data-lesson-id="<?php echo $lesson['id']; ?>">Eliminar</a>
                                      </div>
                                  </div>
                              <?php endforeach; ?>
                          </div>
                      </div>
                  `;
              <?php endforeach; ?>
          }

          function showLessons() {
              const content = document.getElementById('content');
              content.innerHTML = ''; // Limpiar contenido
              <?php foreach ($sections as $section): ?>
                  content.innerHTML += `
                      <div class="seccion-card">
                          <span class="seccion-nombre"><?php echo htmlspecialchars($section['title']); ?></span>
                          <div class="lecciones-container">
                              <?php 
                              $lessons = $this->crud_model->get_lessons('section', $section['id'])->result_array();
                              if (count($lessons) > 0): ?>
                                  <ul>
                                      <?php foreach ($lessons as $lesson): ?>
                                          <li class="leccion-item">
                                              <span class="leccion-nombre"><?php echo htmlspecialchars($lesson['title']); ?></span>
                                          </li>
                                      <?php endforeach; ?>
                                  </ul>
                              <?php else: ?>
                                  <p style="color: #888;">No hay lecciones agregadas aún.</p>
                              <?php endif; ?>
                          </div>
                      </div>
                  `;
              <?php endforeach; ?>
          }
      </script>

      <div id="content">
          <!-- Contenido dinámico aquí -->
          <?php if (isset($sections) && count($sections) > 0): ?>
              <?php foreach ($sections as $section): ?>
                  <div class="seccion-card">
                    <span class="badge-agregado">Agregado</span>
                    <span class="seccion-nombre"><?php echo htmlspecialchars($section['title']); ?></span>
                    <button class="acciones-btn">Acciones</button>
                    <div class="acciones-dropdown">
                        <a href="#" title="Ver Lecciones">Ver Lecciones</a>
                        <a href="#" title="Eliminar sección" class="eliminar-btn" data-section-id="<?php echo $section['id']; ?>" data-course-id="<?php echo $course['id']; ?>">Eliminar</a>
                    </div>
                  </div>
              <?php endforeach; ?>
          <?php else: ?>
              <div style="color:#888; margin-top:10px;">No hay secciones agregadas aún.</div>
          <?php endif; ?>
      </div>
    </div>
  </div>
  <div id="lesson-type-modal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1050; align-items: center; justify-content: center;">
    <div class="modal-content" style="background: #fff; border-radius: 12px; padding: 20px; width: 90%; max-width: 600px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    ">
      <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
        <h4 style="margin: 0; font-size: 1.5rem; font-weight: bold; color: #444;">Seleccionar tipo de lección</h4>
        <button type="button" onclick="closeLessonTypeModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #888;">&times;</button>
      </div>
      <div class="modal-body" style="margin-top: 20px;">
        <button class="agregar-btn" style="margin-bottom: 10px;" onclick="openIframeLessonModal()">Iframe</button>
        <button class="agregar-btn" style="margin-bottom: 10px;" onclick="openTextLessonModal()">Texto</button>
        <button class="agregar-btn" style="margin-bottom: 10px;" onclick="openVideoLessonModal()">Video</button>
      </div>
    </div>
  </div>
  <script>
    function showLessonTypes() {
      const sectionId = document.getElementById('section-select').value;
      if (sectionId) {
        document.getElementById('lesson-types-container').style.display = 'block';
      } else {
        document.getElementById('lesson-types-container').style.display = 'none';
        document.getElementById('lesson-form-container').style.display = 'none';
      }
    }

    function goToStep(step) {
      document.querySelectorAll('.form-step').forEach(stepDiv => stepDiv.style.display = 'none');
      document.getElementById(`step-${step}`).style.display = 'block';
    }

    function selectLessonType(button, type) {
      const buttons = document.querySelectorAll('#step-3 .acciones-btn');
      buttons.forEach(btn => btn.classList.remove('selected'));
      button.classList.add('selected');
      button.style.background = '#000';
      button.style.color = '#fff';

      const lessonFormContainer = document.getElementById('lesson-form-container');
      let formContent = '';
      if (type === 'video') {
        formContent = `
          <label class="form-label">URL del video (para aplicación web)</label>
          <input type="text" id="video_url" name="video_url" class="form-control" placeholder="Este video se mostrará en la aplicación web" required>
          <label class="form-label">Duración (para aplicación web)</label>
          <input type="text" name="duration" id="duration" class="form-control" placeholder="HH:MM:SS" required>
        `;
      } else if (type === 'text') {
        formContent = `
          <label class="form-label">Contenido de texto</label>
          <textarea name="text_description" class="form-control" rows="5" placeholder="Escribe el contenido de la lección aquí" required></textarea>
        `;
      }
      lessonFormContainer.innerHTML = formContent;
    }

    function handleLessonSave(event) {
      event.preventDefault(); // Evitar el comportamiento predeterminado del formulario
      const form = document.querySelector('#lessonForm'); // Seleccionar el formulario
      const formData = new FormData(form); // Crear un objeto FormData con los datos del formulario

      fetch(form.action, {
        method: 'POST', // Usar el método POST
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          const courseId = <?php echo $course['id']; ?>;
          window.location.href = `http://localhost/elevant_academy/user/elevant/section_add/${courseId}?ref=lesson`;
        } else {
          alert(data.message || 'Error al guardar la lección.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Error al guardar la lección.');
      });
    }

    $(document).ready(function () {
        $('#datatable-lecciones').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
            },
            pageLength: 10,
            responsive: true
        });
    });

    function toggleLessonForm() {
        const table = document.getElementById('lesson-table');
        const form = document.getElementById('lesson-form');
        const button = document.getElementById('add-lesson-btn');

        if (form.style.display === 'none') {
            form.style.display = 'block';
            table.style.display = 'none';
            button.style.display = 'none';
        } else {
            form.style.display = 'none';
            table.style.display = 'block';
            button.style.display = 'block';
        }
    }

    function editLesson(lessonId) {
        alert('Editar lección: ' + lessonId);
    }

    function copyLesson(lessonId) {
        alert('Copiar lección: ' + lessonId);
    }

    function deleteLesson(lessonId) {
        alert('Borrar lección: ' + lessonId);
    }

    function toggleActionsMenu(svgElem) {
        document.querySelectorAll('.actions-dropdown').forEach(function(menu) {
            if (menu !== svgElem.parentNode.querySelector('.actions-dropdown')) {
                menu.style.display = 'none';
            }
        });
        var dropdown = svgElem.parentNode.querySelector('.actions-dropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        document.addEventListener('click', function handler(e) {
            if (!svgElem.parentNode.contains(e.target)) {
                dropdown.style.display = 'none';
                document.removeEventListener('click', handler);
            }
        });
    }
  </script>
  <?php
  $ref = $this->input->get('ref'); // Detectar el parámetro 'ref'
  if ($ref === 'lesson') {
      echo '<script>document.addEventListener("DOMContentLoaded", function() { goToStep(2); });</script>';
  }
  ?>
  <div class="form-container">
    <button type="button" class="btn btn-secondary" onclick="window.location.href='http://localhost/elevant_academy/user/elevant/course_config/7'">
        Volver al curso
    </button>
  </div>
</body>
</html>