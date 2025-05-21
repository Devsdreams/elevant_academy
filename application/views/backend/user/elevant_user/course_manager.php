<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cursos - Dashboard</title>
  <style>
    body {
      font-family: 'Arial Rounded MT Bold', Arial, Helvetica, sans-serif;
      margin: 0;
      background: #fff;
      color: #222;
    }
    .header {
      padding: 36px 0 0 60px;
    }
    .header .crumb {
      color: #888;
      font-size: 16px;
      font-weight: 400;
      margin-bottom: 2px;
      display: block;
    }
    .header .title {
      font-size: 28px;
      font-weight: bold;
      letter-spacing: -1px;
      color: #444;
      margin: 0 0 0 0;
    }
    .sub-header {
      margin: 32px 0 0 0;
      text-align: center;
    }
    .sub-header h2 {
      font-size: 25px;
      font-weight: bold;
      color: #444;
      margin: 0 0 7px 0;
      letter-spacing: -0.5px;
    }
    .sub-header p {
      font-size: 17px;
      color: #777;
      margin: 0;
      font-weight: 400;
    }
    .nuevo-btn {
      position: absolute;
      right: 70px;
      top: 90px;
      background: #000;
      color: #fff;
      border: none;
      border-radius: 14px;
      padding: 12px 28px;
      font-size: 15px;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.2s;
    }
    .nuevo-btn:hover {
      background: #222;
    }
    .main-list {
      margin: 56px auto 0 auto;
      max-width: 92vw;
      width: 900px;
      display: flex;
      flex-direction: column;
      gap: 24px;
      position: relative;
    }
    .curso-card {
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
    .curso-card:not(:first-child) {
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
    .curso-titulo {
      font-weight: bold;
      font-size: 17px;
      color: #444;
      margin-right: 18px;
    }
    .curso-date {
      color: #888;
      font-size: 15px;
      margin-left: auto;
      margin-right: 20px;
      font-weight: 500;
    }
    .curso-status {
      background: #eee;
      color: #222;
      border-radius: 12px;
      padding: 2px 14px;
      font-size: 15px;
      font-weight: bold;
      display: inline-block;
      margin-right: 18px;
    }
    .curso-status.draft {
      background: #222;
      color: #fff;
      font-weight: bold;
    }
    .curso-menu {
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
    .curso-menu:hover {
      background: #ddd;
    }
    .empty-card {
      background: #fff;
      border: 1.6px solid #ededed;
      min-height: 60px;
      border-radius: 24px;
    }
    /* Pagination and footer */
    .pagination-bar {
      margin: 50px 0 0 0;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      gap: 30px;
      max-width: 900px;
      width: 92vw;
      margin-left: auto;
      margin-right: auto;
    }
    .pagina-box {
      background: #f6f6f6;
      color: #222;
      font-size: 19px;
      font-weight: bold;
      border-radius: 13px;
      padding: 8px 26px;
      display: flex;
      align-items: center;
      gap: 10px;
      border: none;
      margin-right: 8px;
    }
    .pagina-box select {
      border: none;
      background: transparent;
      font-size: 18px;
      color: #222;
      font-weight: bold;
      appearance: none;
      outline: none;
      margin-right: 8px;
    }
    .mostrar {
      color: #aaa;
      font-size: 17px;
      margin-right: 30px;
      font-weight: 400;
    }
    .page-controls {
      margin-left: auto;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .pag-arrow {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: none;
      border: none;
      color: #111;
      font-size: 22px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background 0.18s;
    }
    .pag-arrow:disabled {
      color: #ccc;
      cursor: default;
      background: none;
    }
    .page-btn {
      background: #000;
      color: #fff;
      width: 38px;
      height: 38px;
      border-radius: 50%;
      border: none;
      font-size: 18px;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    @media (max-width: 700px) {
      .main-list, .pagination-bar {
        width: 98vw;
        max-width: 98vw;
        padding: 0 8px;
      }
      .nuevo-btn {
        right: 20px;
      }
      .header {
        padding-left: 16px;
      }
    }
  </style>
</head>
<body>
  <?php $active_page = 'courses'; ?>
  <?php include 'navigation.php'; ?>
  <?php include 'top_bar.php'; ?>
  <div class="main-content" style="margin-left:80px; margin-top:60px;">
    <div class="header">
      <span class="crumb">Home</span>
      <span class="title">Cursos</span>
    </div>
    <div class="sub-header">
      <h2>revisa tus cursos creados o comienza uno nuevo fácilmente.</h2>
      <p>Permitenos saber que podemos hacer para ti en tu creación de este curso</p>
      <button class="nuevo-btn" onclick="window.location.href='<?php echo site_url('user/elevant/course_add'); ?>'">Nuevo Curso</button>
    </div>

    <div class="main-list" style="max-width: 1200px; width: 100%; min-width: 900px;">
      <table id="datatable-cursos" style="width:100%; background:transparent; border:none;">
        <thead style="display:none;">
          <tr>
            <th>Título</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        <?php
        // Obtener los cursos del usuario autenticado usando el método del modelo
        $user_id = $this->session->userdata('user_id');
        $cursos = $this->crud_model->get_instructor_wise_courses($user_id)->result_array();
        foreach ($cursos as $curso):
        ?>
        <tr>
          <td style="padding:0; border:none;">
            <div class="curso-card">
              <div class="img-icon" title="Imagen del curso">
                <?php if (!empty($curso['thumbnail'])): ?>
                  <img src="<?php echo base_url('uploads/course_images/' . $curso['thumbnail']); ?>" alt="img" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                <?php else: ?>
                  <!-- Simple image icon -->
                  <svg width="27" height="27" viewBox="0 0 27 27" fill="none">
                    <rect x="2" y="6" width="23" height="15" rx="4" fill="#fff" stroke="#bbb" stroke-width="2" />
                    <circle cx="8.5" cy="10.5" r="2.5" fill="#e1e1e1"/>
                    <path d="M3 20L10.5 12.5L15 17L18.5 13.5L24 20" stroke="#bbb" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                <?php endif; ?>
              </div>
              <span class="curso-titulo"><?php echo $curso['title']; ?></span>
              <span class="curso-date">
                <?php
                  echo isset($curso['date_added']) && $curso['date_added'] ? date('d/m/Y', $curso['date_added']) : '';
                ?>
              </span>
              <?php
                $status = $curso['status'];
                if ($status == 'active'):
              ?>
                <span class="curso-status" style="background:#d4edda;color:#155724;">Activo</span>
              <?php elseif ($status == 'pending'): ?>
                <span class="curso-status" style="background:#fff3cd;color:#856404;">Pendiente</span>
              <?php else: ?>
                <span class="curso-status draft">Borrador</span>
              <?php endif; ?>
              <!-- Botón de acciones desplegable -->
              <div class="curso-menu" title="Opciones" style="position: relative;">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" onclick="toggleActionsMenu(this)">
                  <circle cx="11" cy="5.5" r="1.5" fill="#444"/>
                  <circle cx="11" cy="11" r="1.5" fill="#444"/>
                  <circle cx="11" cy="16.5" r="1.5" fill="#444"/>
                </svg>
                <div class="actions-dropdown" style="display:none; position:absolute; top:40px; right:0; background:#fff; border:1px solid #eee; border-radius:12px; box-shadow:0 4px 16px rgba(0,0,0,0.10); min-width:160px; z-index:10; overflow:hidden;">
                  <a href="<?php echo site_url('user/elevant/course_config/'.$curso['id']); ?>" class="action-item" style="display:flex; align-items:center; gap:10px; padding:14px 22px; color:#222; text-decoration:none; border-bottom:1px solid #f0f0f0; font-size:16px; transition:background 0.15s;" onmouseover="this.style.background='#f6f6f6'" onmouseout="this.style.background='transparent'">
                    <span style="background:#f3f3f3; border-radius:50%; width:28px; height:28px; display:flex; align-items:center; justify-content:center;">
                      <i class="fas fa-cog"></i>
                    </span>
                    <span>Configurar</span>
                  </a>
                  <a href="#" class="action-item" style="display:flex; align-items:center; gap:10px; padding:14px 22px; color:#222; text-decoration:none; font-size:16px; transition:background 0.15s;" onmouseover="this.style.background='#f6f6f6'" onmouseout="this.style.background='transparent'" onclick="if(confirm('¿Seguro que deseas eliminar este curso?')){ window.location.href='<?php echo site_url('user/course_actions/delete/'.$curso['id']); ?>'; }">
                    <span style="background:#f3f3f3; border-radius:50%; width:28px; height:28px; display:flex; align-items:center; justify-content:center;">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span>Eliminar</span>
                  </a>
                </div>
              </div>
            </div>
          </td>
          <td style="display:none;"><?php echo isset($curso['date_added']) && $curso['date_added'] ? date('d/m/Y', $curso['date_added']) : ''; ?></td>
          <td style="display:none;"><?php echo $curso['status']; ?></td>
          <td style="display:none;">Opciones</td>
        </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <?php if (empty($cursos)): ?>
        <div class="empty-card"></div>
        <div class="empty-card"></div>
        <div class="empty-card"></div>
      <?php endif; ?>
    </div>
    <!-- Eliminamos la paginación hardcodeada -->
  </div>
  <!-- Agrega DataTables JS y CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"/>
  <style>
    /* Personalización de DataTables para que combine con el diseño */
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
    .curso-card {
      min-height: 80px;
      font-size: 18px;
    }
    .curso-titulo {
      font-size: 20px;
    }
    .img-icon {
      width: 55px;
      height: 55px;
      font-size: 32px;
    }
    .curso-date {
      font-size: 17px;
    }
    .curso-status {
      font-size: 17px;
      padding: 4px 18px;
    }
    .curso-menu {
      width: 40px;
      height: 40px;
      font-size: 22px;
    }
    .dataTables_wrapper .dataTables_paginate {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      margin-top: 30px;
      margin-bottom: 10px;
      gap: 10px;
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
    .dataTables_wrapper .dataTables_filter {
      text-align: left;
      margin-bottom: 20px;
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
    .dataTables_wrapper .dataTables_length {
      margin-bottom: 20px;
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
    /* Oculta los encabezados de tabla */
    #datatable-cursos thead {
      display: none;
    }
    /* Elimina el fondo gris de la tabla de DataTables */
    #datatable-cursos {
      background: transparent !important;
    }
    /* Ajusta el ancho de la tabla para que no sobresalga */
    .dataTables_wrapper {
      width: 100%;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready(function() {
    $('#datatable-cursos').DataTable({
      paging: true,
      searching: true,
      info: true,
      ordering: false,
      pageLength: 5,
      lengthMenu: [5, 10, 20, 50],
      language: {
        search: "Buscar:",
        lengthMenu: "Mostrar _MENU_ cursos",
        zeroRecords: "No se encontraron cursos",
        info: "Mostrando _START_ a _END_ de _TOTAL_ cursos",
        infoEmpty: "No hay cursos para mostrar",
        infoFiltered: "(filtrado de _MAX_ cursos en total)",
        paginate: {
          first: "Primero",
          last: "Último",
          next: "›",
          previous: "‹"
        }
      },
      // Oculta los encabezados de tabla, ya que el diseño es tipo card
      headerCallback: function(thead, data, start, end, display) {
        $(thead).hide();
      },
      // Evita que el layout de DataTables rompa el diseño de las cards
      drawCallback: function(settings) {
        // Opcional: puedes agregar lógica aquí si necesitas ajustar algo tras el render
      }
    });
  });

  // Dropdown de acciones
  function toggleActionsMenu(svgElem) {
    // Cierra otros menús abiertos
    document.querySelectorAll('.actions-dropdown').forEach(function(menu) {
      if (menu !== svgElem.parentNode.querySelector('.actions-dropdown')) {
        menu.style.display = 'none';
      }
    });
    var dropdown = svgElem.parentNode.querySelector('.actions-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    // Cerrar al hacer click fuera
    document.addEventListener('click', function handler(e) {
      if (!svgElem.parentNode.contains(e.target)) {
        dropdown.style.display = 'none';
        document.removeEventListener('click', handler);
      }
    });
  }
  </script>
</body>
</html>