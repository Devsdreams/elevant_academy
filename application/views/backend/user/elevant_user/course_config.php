<?php $active_page = 'courses'; ?>
<?php include 'navigation.php'; ?>
<?php include 'top_bar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
      background: #fff;
      color: #222;
      box-sizing: border-box;
    }
    .container {
      display: flex;
      flex-direction: row;
      justify-content: flex-start;
      align-items: flex-start;
      width: 100%;
      min-height: 100vh;
      padding: 24px 0 0 0;
      box-sizing: border-box;
      gap: 32px;
    }
    .main {
      flex: 2;
      min-width: 500px;
      max-width: 780px;
      padding: 0 0 0 40px;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }
    .course-info-right {
      flex: 0 0 320px;
      min-width: 270px;
      max-width: 340px;
      padding: 0 24px 0 0;
      display: flex;
      flex-direction: column;
      gap: 18px;
      margin-top: 0;
      align-self: flex-start;
    }
    .top-bar {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-bottom: 8px;
    }
    .btn {
      font-size: 15px;
      font-weight: 600;
      border-radius: 16px;
      padding: 8px 26px;
      border: none;
      cursor: pointer;
      outline: none;
      margin-top: 0;
    }
    .guardar {
      background: #e0e0e0;
      color: #111;
    }
    .publicar {
      background: #000;
      color: #fff;
    }
    h1 {
      font-size: 2.2rem;
      font-weight: bold;
      margin: 0 0 18px 0;
      letter-spacing: -1px;
    }
    .main input[type="text"] {
      font-size: 1.10rem;
      width: 100%;
      border: 1.5px solid #ededed;
      border-radius: 10px;
      padding: 12px 16px;
      margin-bottom: 15px;
      background: #f9f9f9;
      color: #333;
      outline: none;
      box-sizing: border-box;
    }
    .main textarea {
      width: 100%;
      min-height: 100px;
      max-height: 160px;
      border: 1.5px solid #ededed;
      border-radius: 12px;
      padding: 14px 16px;
      font-size: 1rem;
      background: #f9f9f9;
      color: #222;
      resize: vertical;
      margin-bottom: 16px;
      box-sizing: border-box;
    }
    .card {
      background: #fafafa;
      border-radius: 13px;
      border: 1.5px solid #ededed;
      padding: 18px 22px;
      margin-bottom: 20px;
    }
    .card h5 {
      color: #bdbdbd;
      font-weight: 500;
      font-size: 14px;
      margin: 0 0 9px 0;
      letter-spacing: 0;
    }
    .section-tabs, .detalle-tabs {
      display: flex;
      align-items: center;
      border-bottom: 2px solid #ededed;
      gap: 0;
      margin-bottom: 14px;
      overflow-x: auto;
    }
    .tab, .detalle-tab {
      background: none;
      border: none;
      font-size: 16px;
      color: #222;
      padding: 0 16px 9px 16px;
      font-weight: 500;
      cursor: pointer;
      border-bottom: 3px solid transparent;
      transition: border 0.2s, color 0.2s;
      outline: none;
    }
    .tab.active, .detalle-tab.active {
      border-bottom: 3px solid #111;
      color: #111;
      font-weight: bold;
    }
    .agregar-seccion-btn {
      margin: 18px auto 0 auto;
      display: block;
      padding: 11px 38px;
      border-radius: 20px;
      border: none;
      background: #bdbdbd;
      color: #222;
      font-size: 16px;
      cursor: pointer;
      font-weight: 600;
      letter-spacing: 0.2px;
      transition: background 0.2s;
    }
    .agregar-seccion-btn:hover {
      background: #222;
      color: #fff;
    }
    /* Sidebar cards */
    .sidebar-box {
      background: #fafafa;
      border-radius: 13px;
      border: 1.5px solid #ededed;
      padding: 13px 18px 16px 18px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .sidebar-box label {
      font-size: 14px;
      color: #bdbdbd;
      margin-bottom: 4px;
      font-weight: 500;
    }
    .foto-curso {
      width: 100%;
      min-height: 80px;
      max-height: 120px;
      border-radius: 10px;
      border: 1.2px solid #ededed;
      background: #f9f9f9;
      font-size: 14px;
      padding: 10px 11px;
      margin-bottom: 0;
      resize: vertical;
      font-family: inherit;
      color: #333;
    }
    .cat-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 5px;
    }
    .cat-btn {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: #000;
      color: #fff;
      border-radius: 23px;
      padding: 6px 18px 6px 8px;
      font-size: 14px;
      font-weight: 500;
      border: none;
    }
    .cat-btn .arrow {
      background: #fff;
      color: #000;
      border-radius: 50%;
      width: 22px;
      height: 22px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      font-weight: bold;
    }
    .cat-add-row {
      display: flex;
      align-items: center;
      gap: 7px;
      margin-top: 6px;
      margin-bottom: 0;
    }
    .cat-add-row select {
      border-radius: 7px;
      border: 1.2px solid #ccc;
      font-size: 14px;
      background: #fff;
      padding: 4px 10px;
      outline: none;
    }
    .add-btn {
      background: #111;
      color: #fff;
      border-radius: 8px;
      border: none;
      font-size: 13px;
      padding: 4px 15px;
      cursor: pointer;
      font-weight: 500;
    }
    .dif-row {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .dif-btn {
      display: flex;
      align-items: center;
      gap: 7px;
      background: #ededed;
      color: #111;
      border-radius: 23px;
      padding: 6px 18px 6px 8px;
      font-size: 14px;
      font-weight: 500;
      border: none;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
    }
    .dif-btn.selected, .dif-btn:hover {
      background: #000;
      color: #fff;
    }
    .dif-btn .arrow {
      background: #fff;
      color: #000;
      border-radius: 50%;
      width: 22px;
      height: 22px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      font-weight: bold;
    }
    .dif-btn.selected .arrow, .dif-btn:hover .arrow {
      background: #000;
      color: #fff;
    }
    .section-list {
      list-style: none;
      padding: 0;
      margin: 0 auto;
      text-align: center;
      max-width: 600px;
    }
    .section-list li {
      font-size: 16px;
      padding: 12px 15px;
      border-bottom: 1px solid #ededed;
      background: #f9f9f9;
      border-radius: 8px;
      margin-bottom: 8px;
      transition: background 0.2s, box-shadow 0.2s;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .section-list li:hover {
      background: #e0e0e0;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    /* Estilos para el contenido de cada pestaña */
    .tab-content {
      display: none;
      padding: 15px;
      background: #f9f9f9;
      border-radius: 8px;
      margin-top: 10px;
    }
    
    .tab-content.active {
      display: block;
    }
    
    /* Estilos para lecciones agrupadas por sección */
    .section-lessons {
      margin-bottom: 24px;
      border-left: 3px solid #ededed;
      padding-left: 15px;
    }
    
    .section-lessons h3 {
      font-size: 1.1rem;
      margin-bottom: 10px;
      color: #555;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .lesson-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      background: #fff;
      border-radius: 6px;
      margin-bottom: 8px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .lesson-item .lesson-type {
      display: inline-block;
      padding: 3px 8px;
      border-radius: 4px;
      font-size: 0.8rem;
      margin-right: 10px;
      background: #e0e0e0;
    }
    
    .lesson-item .lesson-type.video {
      background: #e3f2fd;
      color: #1976d2;
    }
    
    .lesson-item .lesson-type.document {
      background: #e8f5e9;
      color: #0b875b;
    }
    
    .lesson-item .lesson-type.text {
      background: #fff3e0;
      color: #e65100;
    }
    
    .lesson-actions {
      display: flex;
      gap: 10px;
    }
    
    .delete-btn {
      background: #bdbdbd;
      color: #222;
      border: none;
      padding: 8px 20px;
      border-radius: 20px;
      font-size: 14px;
      cursor: pointer;
      font-weight: 600;
      letter-spacing: 0.2px;
      transition: background 0.2s, color 0.2s;
      text-decoration: none;
      display: inline-block;
    }
    
    .delete-btn:hover {
      background: #222;
      color: #fff;
    }
    
    .add-lesson-btn {
      display: inline-block;
      background: #bdbdbd;
      color: #222;
      padding: 8px 25px;
      border-radius: 20px;
      margin-top: 10px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      letter-spacing: 0.2px;
      transition: background 0.2s, color 0.2s;
    }
    
    .add-lesson-btn:hover {
      background: #222;
      color: #fff;
    }
    
    /* Estilos para quiz/examen */
    .quiz-list, .exam-list {
      list-style: none;
      padding: 0;
    }
    
    .quiz-item, .exam-item {
      background: #fff;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 10px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    /* Estilos para configuración */
    .config-form {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
    }
    
    .config-form label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }
    
    .config-form input, .config-form select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 4px;
      border: 1px solid #ddd;
    }
    
    .config-form button {
      background: #00c48c;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
    }
    @media (max-width: 1100px) {
      .container {
        flex-direction: column;
        align-items: stretch;
        gap: 0;
      }
      .main {
        max-width: 100vw;
        min-width: unset;
        padding: 0 10px;
      }
      .course-info-right {
        max-width: 100vw;
        min-width: unset;
        padding: 0 10px;
        margin-top: 18px;
        flex-direction: row;
        gap: 18px;
        align-self: stretch;
      }
      .sidebar-box {
        width: 100%;
      }
    }
    @media (max-width: 750px) {
      .main, .course-info-right {
        padding: 0 4vw;
      }
      .course-info-right {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="main-content" style="margin-left:80px; margin-top:60px;">
    <div class="container" style="margin: 0 auto; max-width: 1600px; min-width: 1200px; justify-content: center; align-items: flex-start;">
      <!-- MAIN SECTION -->
      <form action="<?php echo site_url('user/elevant/course_config/' . $course['id']); ?>" method="post" enctype="multipart/form-data" style="display:contents;">
      <div class="main" style="margin: 0 auto; min-width: 700px; max-width: 1000px;">
        <input type="text" name="title" value="<?php echo isset($course['title']) ? htmlspecialchars($course['title']) : ''; ?>" placeholder="Título del curso" style="font-size:2rem;font-weight:bold;margin-bottom:18px;letter-spacing:-1px;width:100%;border:none;background:transparent;color:#222;">
        <input type="text" name="slug_url" value="<?php echo isset($course['id']) ? base_url('course/' . slugify($course['title']) . '/' . $course['id']) : ''; ?>" readonly>
        <textarea name="description" style="min-height:120px;max-height:220px;"><?php echo isset($course['description']) ? htmlspecialchars($course['description']) : ''; ?></textarea>

        <div class="card">
          <h5>Detalle del curso</h5>
          <div class="section-tabs">
            <button class="tab active" type="button" data-tab="sections">Secciones</button>
            <button class="tab" type="button" data-tab="lessons">Lecciones</button>
            <button class="tab" type="button" data-tab="files">Archivos</button>
            <button class="tab" type="button" data-tab="quiz">Quiz</button>
            <button class="tab" type="button" data-tab="exam">Examen</button>
            <button class="tab" type="button" data-tab="config">Configuración</button>
          </div>
          
          <?php
          // Obtener las secciones del curso
          $sections = $this->crud_model->get_elevant_section('course', $course['id'])->result_array();
          
          // Obtener todas las lecciones del curso
          $course_lessons = $this->crud_model->get_lessons('course', $course['id'])->result_array();
          
          // Agrupar lecciones por sección
          $lessons_by_section = [];
          foreach ($course_lessons as $lesson) {
            $section_id = $lesson['section_id'];
            if (!isset($lessons_by_section[$section_id])) {
              $lessons_by_section[$section_id] = [];
            }
            $lessons_by_section[$section_id][] = $lesson;
          }
          ?>
          
          <!-- Tab Content: Secciones -->
          <div id="sections-content" class="tab-content active">
            <ul class="section-list">
              <?php foreach ($sections as $section): ?>
                <li>
                  <?php echo htmlspecialchars($section['title']); ?>
                  <a href="javascript:void(0);" 
                     class="delete-btn" 
                     onclick="deleteItem('section', <?php echo $section['id']; ?>, <?php echo $course['id']; ?>)">
                    Eliminar
                  </a>
                </li>
              <?php endforeach; ?>
              
              <?php if (count($sections) == 0): ?>
                <div style="text-align: center; padding: 20px;">
                  <p>No hay secciones creadas para este curso.</p>
                </div>
              <?php endif; ?>
            </ul>
            
            <button class="agregar-seccion-btn" type="button" onclick="window.location.href='<?php echo site_url('user/elevant/section_add/' . $course['id']); ?>'">Agregar Secciones</button>
          </div>
          
          <!-- Tab Content: Lecciones -->
          <div id="lessons-content" class="tab-content">
            <?php if (count($sections) == 0): ?>
              <div style="text-align: center; padding: 20px;">
                <p>Debes crear al menos una sección antes de añadir lecciones.</p>
                <button class="agregar-seccion-btn" type="button" onclick="window.location.href='<?php echo site_url('user/elevant/section_add/' . $course['id']); ?>'">Agregar Secciones</button>
              </div>
            <?php else: ?>
              <?php foreach ($sections as $section): ?>
                <div class="section-lessons">
                  <h3>
                    <?php echo htmlspecialchars($section['title']); ?>
                    <a href="javascript:void(0);" 
                       class="delete-btn" 
                       onclick="deleteItem('section', <?php echo $section['id']; ?>, <?php echo $course['id']; ?>)">
                      Eliminar
                    </a>
                  </h3>
                  
                  <?php if (isset($lessons_by_section[$section['id']])): ?>
                    <?php foreach ($lessons_by_section[$section['id']] as $lesson): ?>
                      <div class="lesson-item">
                        <div>
                          <span class="lesson-type <?php echo $lesson['lesson_type']; ?>">
                            <?php 
                              if ($lesson['lesson_type'] == 'video') echo 'Video';
                              elseif ($lesson['lesson_type'] == 'document') echo 'Documento';
                              else echo 'Texto';
                            ?>
                          </span>
                          <?php echo htmlspecialchars($lesson['title']); ?>
                        </div>
                        <div class="lesson-actions">
                          <a href="javascript:void(0);" 
                             class="delete-btn" 
                             onclick="deleteItem('lesson', <?php echo $lesson['id']; ?>, <?php echo $course['id']; ?>)">
                            Eliminar
                          </a>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <p>No hay lecciones en esta sección.</p>
                  <?php endif; ?>
                  
                  <a href="<?php echo site_url('user/elevant/section_add/' . $course['id']); ?>" class="add-lesson-btn">Añadir lección</a>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
          
          <!-- Tab Content: Archivos -->
          <div id="files-content" class="tab-content">
            <div class="file-list">
              <?php 
              // Mostrar archivos relacionados con el curso (documentos, recursos, etc.)
              $course_files = []; // Aquí cargarías los archivos desde tu base de datos
              
              if (count($course_files) == 0): 
              ?>
                <div style="text-align: center; padding: 20px; width: 100%;">
                  <p>No hay archivos asociados a este curso.</p>
                </div>
              <?php else: ?>
                <?php foreach ($course_files as $file): ?>
                  <div class="file-item">
                    <div class="file-icon"><i class="fa fa-file"></i></div>
                    <div class="file-name"><?php echo $file['name']; ?></div>
                    <div class="file-size"><?php echo $file['size']; ?></div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
            
            <button class="agregar-seccion-btn" type="button" style="margin-top: 20px;">Añadir archivos</button>
          </div>
          
          <!-- Tab Content: Quiz -->
          <div id="quiz-content" class="tab-content">
            <ul class="quiz-list">
              <?php 
              // Obtener quizzes del curso
              $quizzes = []; // Aquí cargarías los quizzes desde tu base de datos
              
              if (count($quizzes) == 0): 
              ?>
                <div style="text-align: center; padding: 20px;">
                  <p>No hay quizzes creados para este curso.</p>
                </div>
              <?php else: ?>
                <?php foreach ($quizzes as $quiz): ?>
                  <li class="quiz-item">
                    <div class="quiz-title"><?php echo $quiz['title']; ?></div>
                    <div class="quiz-details">Preguntas: <?php echo $quiz['questions_count']; ?> | Duración: <?php echo $quiz['duration']; ?></div>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
            
            <button class="agregar-seccion-btn" type="button" style="margin-top: 20px;">Crear quiz</button>
          </div>
          
          <!-- Tab Content: Examen -->
          <div id="exam-content" class="tab-content">
            <ul class="exam-list">
              <?php 
              // Obtener exámenes del curso
              $exams = []; // Aquí cargarías los exámenes desde tu base de datos
              
              if (count($exams) == 0): 
              ?>
                <div style="text-align: center; padding: 20px;">
                  <p>No hay exámenes creados para este curso.</p>
                </div>
              <?php else: ?>
                <?php foreach ($exams as $exam): ?>
                  <li class="exam-item">
                    <div class="exam-title"><?php echo $exam['title']; ?></div>
                    <div class="exam-details">Preguntas: <?php echo $exam['questions_count']; ?> | Duración: <?php echo $exam['duration']; ?></div>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
            
            <button class="agregar-seccion-btn" type="button" style="margin-top: 20px;">Crear examen</button>
          </div>
          
          <!-- Tab Content: Configuración -->
          <div id="config-content" class="tab-content">
            <div class="config-form">
              <label>Acceso al curso</label>
              <select name="is_free_course">
                <option value="0" <?php if (isset($course['is_free_course']) && $course['is_free_course'] == 0) echo 'selected'; ?>>De pago</option>
                <option value="1" <?php if (isset($course['is_free_course']) && $course['is_free_course'] == 1) echo 'selected'; ?>>Gratuito</option>
              </select>
              
              <label>Precio (si el curso es de pago)</label>
              <input type="number" name="price" value="<?php echo isset($course['price']) ? $course['price'] : ''; ?>" step="0.01" min="0">
              
              <label>Estado del curso</label>
              <select name="status">
                <option value="draft" <?php if (isset($course['status']) && $course['status'] == 'draft') echo 'selected'; ?>>Borrador</option>
                <option value="pending" <?php if (isset($course['status']) && $course['status'] == 'pending') echo 'selected'; ?>>Pendiente</option>
                <option value="active" <?php if (isset($course['status']) && $course['status'] == 'active') echo 'selected'; ?>>Activo</option>
              </select>
              
              <label>Visibilidad</label>
              <select name="visibility">
                <option value="public" <?php if (isset($course['visibility']) && $course['visibility'] == 'public') echo 'selected'; ?>>Público</option>
                <option value="private" <?php if (isset($course['visibility']) && $course['visibility'] == 'private') echo 'selected'; ?>>Privado</option>
              </select>
              
              <button type="submit" name="save_config">Guardar configuración</button>
            </div>
          </div>
        </div>

        <div class="card">
          <h5>Detalle del curso</h5>
          <div class="detalle-tabs">
            <button class="detalle-tab active" type="button">Detalle</button>
            <button class="detalle-tab" type="button">Requisitos</button>
            <button class="detalle-tab" type="button">Precio</button>
            <button class="detalle-tab" type="button">Afiliados</button>
            <button class="detalle-tab" type="button">Pago</button>
            <button class="detalle-tab" type="button">Configuración</button>
          </div>
        </div>
      </div>
      <!-- INFO DERECHA (NO SIDEBAR) -->
      <div class="course-info-right" style="margin: 0 auto; min-width: 350px; max-width: 500px;">
        <!-- Botones de acción arriba de la imagen -->
        <div style="display:flex; gap:10px; margin-bottom:18px;">
          <button class="btn guardar" type="submit" name="save">Guardar</button>
          <button class="btn publicar" type="submit" name="publish">Publicar</button>
        </div>
        <div class="sidebar-box">
          <label>Foto principal del curso</label>
          <div style="width:100%;margin-bottom:10px;">
            <label for="thumbnail-input" style="display:block;cursor:pointer;">
              <?php if (!empty($course['thumbnail'])): ?>
                <img id="thumbnail-preview" src="<?php echo base_url('uploads/course_images/' . $course['thumbnail']); ?>" alt="Imagen del curso" style="width:100%;border-radius:10px;max-height:120px;object-fit:cover;">
              <?php else: ?>
                <div id="thumbnail-preview" style="width:100%;height:120px;background:#f3f3f3;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#bbb;font-size:18px;">Sin imagen</div>
              <?php endif; ?>
              <div style="margin-top:8px;text-align:center;">
                <span style="background:#000;color:#fff;padding:6px 18px;border-radius:8px;font-size:14px;display:inline-block;">Seleccionar imagen</span>
              </div>
            </label>
            <input id="thumbnail-input" type="file" name="thumbnail" accept="image/*" style="display:none;" onchange="previewThumbnail(event)">
          </div>
        </div>
        <script>
        function previewThumbnail(event) {
          const input = event.target;
          const preview = document.getElementById('thumbnail-preview');
          if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
              if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
              } else {
                preview.innerHTML = '';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100%';
                img.style.borderRadius = '10px';
                img.style.maxHeight = '120px';
                img.style.objectFit = 'cover';
                preview.appendChild(img);
              }
            };
            reader.readAsDataURL(input.files[0]);
          }
        }
        </script>
        <div class="sidebar-box">
          <label>Categoría y subcategoría del curso</label>
          <div class="cat-row">
            <?php
              // Mostrar la subcategoría seleccionada y su categoría principal
              $subcat = [];
              $cat = [];
              if (!empty($course['sub_category_id'])) {
                $subcat = $this->db->get_where('category', ['id' => $course['sub_category_id']])->row_array();
                if ($subcat && $subcat['parent']) {
                  $cat = $this->db->get_where('category', ['id' => $subcat['parent']])->row_array();
                }
                echo '<button class="cat-btn" type="button"><span class="arrow">&rarr;</span>' .
                  ($cat ? '<span style="font-weight:normal;color:#bbb;">' . htmlspecialchars($cat['name']) . ' / </span>' : '') .
                  '<span style="font-weight:bold;">' . htmlspecialchars($subcat['name']) . '</span></button>';
              } else {
                echo '<button class="cat-btn" type="button"><span class="arrow">&rarr;</span>Sin subcategoría</button>';
              }
            ?>
          </div>
          <div class="cat-add-row" style="width:100%;">
            <select name="sub_category_id" required style="width:100%;padding:10px;border-radius:8px;border:1.5px solid #bbb;font-size:15px;">
              <option value="">Selecciona una subcategoría</option>
              <?php
                // Mostrar subcategorías agrupadas por categoría principal
                $categories = $this->db->get_where('category', ['parent' => 0])->result_array();
                foreach ($categories as $parent_cat) {
                  $subcategories = $this->db->get_where('category', ['parent' => $parent_cat['id']])->result_array();
                  if (count($subcategories)) {
                    echo '<optgroup label="' . htmlspecialchars($parent_cat['name']) . '">';
                    foreach ($subcategories as $subcategory) {
                      $selected = ($course['sub_category_id'] == $subcategory['id']) ? 'selected' : '';
                      echo '<option value="' . $subcategory['id'] . '" ' . $selected . '>' . htmlspecialchars($subcategory['name']) . '</option>';
                    }
                    echo '</optgroup>';
                  }
                }
              ?>
            </select>
          </div>
        </div>
        <div class="sidebar-box">
          <label>Nivel de dificultad del curso</label>
          <div class="dif-row">
            <label style="width:100%;">
              <input type="radio" name="level" value="beginner" style="display:inline-block;width:auto;" <?php if(isset($course['level']) && $course['level']=='beginner') echo 'checked'; ?>>
              <span class="dif-btn<?php echo (isset($course['level']) && $course['level']=='beginner') ? ' selected' : ''; ?>"><span class="arrow">&rarr;</span>Principiante</span>
            </label>
            <label style="width:100%;">
              <input type="radio" name="level" value="intermediate" style="display:inline-block;width:auto;" <?php if(isset($course['level']) && $course['level']=='intermediate') echo 'checked'; ?>>
              <span class="dif-btn<?php echo (isset($course['level']) && $course['level']=='intermediate') ? ' selected' : ''; ?>"><span class="arrow">&rarr;</span>Intermedio</span>
            </label>
            <label style="width:100%;">
              <input type="radio" name="level" value="advanced" style="display:inline-block;width:auto;" <?php if(isset($course['level']) && $course['level']=='advanced') echo 'checked'; ?>>
              <span class="dif-btn<?php echo (isset($course['level']) && $course['level']=='advanced') ? ' selected' : ''; ?>"><span class="arrow">&rarr;</span>Experto</span>
            </label>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
  
  <script>
    // Funcionalidad para las pestañas
    document.addEventListener('DOMContentLoaded', function() {
      const tabs = document.querySelectorAll('.section-tabs .tab');
      const tabContents = document.querySelectorAll('.tab-content');
      
      tabs.forEach(tab => {
        tab.addEventListener('click', function() {
          // Remover clase activa de todas las pestañas
          tabs.forEach(t => t.classList.remove('active'));
          
          // Agregar clase activa a la pestaña clickeada
          tab.classList.add('active');
          
          // Ocultar todos los contenidos
          tabContents.forEach(content => {
            content.classList.remove('active');
          });
          
          // Mostrar el contenido correspondiente
          const tabId = tab.getAttribute('data-tab');
          document.getElementById(tabId + '-content').classList.add('active');
        });
      });
      
      // Funcionalidad para eliminar elementos mediante AJAX
      window.deleteItem = function(itemType, itemId, courseId) {
        if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
          // Mostrar indicador de carga
          const loadingOverlay = document.createElement('div');
          loadingOverlay.style.position = 'fixed';
          loadingOverlay.style.top = '0';
          loadingOverlay.style.left = '0';
          loadingOverlay.style.width = '100%';
          loadingOverlay.style.height = '100%';
          loadingOverlay.style.background = 'rgba(255, 255, 255, 0.7)';
          loadingOverlay.style.display = 'flex';
          loadingOverlay.style.justifyContent = 'center';
          loadingOverlay.style.alignItems = 'center';
          loadingOverlay.style.zIndex = '9999';
          loadingOverlay.innerHTML = '<div style="background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">Eliminando...</div>';
          document.body.appendChild(loadingOverlay);
          
          // Realizar petición AJAX
          const xhr = new XMLHttpRequest();
          xhr.open('POST', '<?php echo site_url(); ?>/user/elevant_' + itemType + '/' + courseId + '/delete/' + itemId, true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
          
          xhr.onload = function() {
            if (xhr.status === 200) {
              // Eliminar overlay de carga
              document.body.removeChild(loadingOverlay);
              
              // Mostrar mensaje de éxito
              const successMessage = document.createElement('div');
              successMessage.style.position = 'fixed';
              successMessage.style.top = '20px';
              successMessage.style.left = '50%';
              successMessage.style.transform = 'translateX(-50%)';
              successMessage.style.background = '#4CAF50';
              successMessage.style.color = 'white';
              successMessage.style.padding = '15px 30px';
              successMessage.style.borderRadius = '10px';
              successMessage.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
              successMessage.style.zIndex = '10000';
              successMessage.textContent = 'Elemento eliminado correctamente';
              document.body.appendChild(successMessage);
              
              // Eliminar mensaje después de 3 segundos
              setTimeout(function() {
                document.body.removeChild(successMessage);
              }, 3000);
              
              // Recargar la página para reflejar los cambios
              location.reload();
            } else {
              // Manejar error
              alert('Ha ocurrido un error al eliminar. Por favor, inténtalo de nuevo.');
              document.body.removeChild(loadingOverlay);
            }
          };
          
          xhr.onerror = function() {
            alert('Ha ocurrido un error de conexión. Por favor, verifica tu conexión a internet.');
            document.body.removeChild(loadingOverlay);
          };
          
          xhr.send();
        }
      }
    });
  </script>
</body>
</html>