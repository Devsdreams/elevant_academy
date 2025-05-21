<?php $active_page = 'course_add'; ?>
<?php include 'navigation.php'; ?>
<?php include 'top_bar.php'; ?>

<?php
// Obtener categorías y subcategorías de la base de datos
$categories = $this->crud_model->get_categories()->result_array();
$subcategories = [];
foreach ($categories as $cat) {
    $subcategories[$cat['id']] = $this->crud_model->get_sub_categories($cat['id']);
}
?>

<div class="main-content">
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de Curso - Pasos</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');
            body {
                margin: 0;
                padding: 0;
                font-family: 'Nunito', Arial, sans-serif;
                background-color: #fff;
                color: #333;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
            }

            .main-content {
                margin-left: 80px;
                margin-top: 60px;
                padding: 20px;
            }

            .back-button {
                position: absolute;
                top: 20px;
                left: 20px;
                background-color: #000;
                color: #fff;
                border: none;
                border-radius: 20px;
                padding: 8px 16px;
                font-size: 14px;
                cursor: pointer;
                text-decoration: none;
            }

            .back-button:hover {
                background-color: #333;
            }

            h1 {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 10px;
                text-align: center;
            }

            p {
                font-size: 16px;
                color: #666;
                margin-bottom: 30px;
                text-align: center;
            }

            .form-container {
                width: 100%;
                max-width: 600px;
                text-align: center;
                margin: 0 auto;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .form-container input[type="text"],
            .form-container textarea,
            .form-container select {
                width: 100%;
                max-width: 400px;
                padding: 15px 20px;
                font-size: 16px;
                border: 1px solid #ddd;
                border-radius: 30px;
                outline: none;
                margin-bottom: 20px;
                text-align: center;
                font-family: Arial, sans-serif;
                margin-left: auto;
                margin-right: auto;
                display: block;
            }

            .form-container input[type="text"]::placeholder,
            .form-container textarea::placeholder {
                color: #aaa;
            }

            .form-container textarea {
                height: 150px;
                border-radius: 20px;
                resize: none;
                text-align: left;
                padding: 15px 20px;
                max-width: 400px;
                margin-left: auto;
                margin-right: auto;
                display: block;
            }

            .form-container .button-group {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
                width: 100%;
                max-width: 400px;
                margin-left: auto;
                margin-right: auto;
            }

            .form-container .button-group button {
                background-color: #000;
                color: #fff;
                border: none;
                border-radius: 12px;
                width: 100px;
                height: 40px;
                font-size: 14px;
                cursor: pointer;
            }

            .form-container .button-group button:hover {
                background-color: #333;
            }

            .categories-container,
            .difficulty-container,
            .release-container,
            .language-container,
            .price-config-container,
            .split-container {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
                justify-content: center;
                align-items: center;
            }

            .category-button,
            .difficulty-button,
            .release-button {
                display: flex;
                align-items: center;
                gap: 10px;
                background-color: #f5f5f5;
                border: 1px solid #ddd;
                border-radius: 30px;
                padding: 10px 20px;
                cursor: pointer;
                font-size: 14px;
                font-family: Arial, sans-serif;
                transition: background 0.2s, border 0.2s, color 0.2s;
            }

            .category-button.selected,
            .difficulty-button.selected,
            .release-button.selected {
                background-color: #B59359;
                color: #fff;
                border: 2px solid #B59359;
                font-weight: bold;
                box-shadow: 0 2px 8px rgba(181,147,89,0.08);
            }

            .category-button.selected .arrow,
            .difficulty-button.selected .arrow,
            .release-button.selected .arrow {
                background-color: #fff;
                color: #B59359;
            }

            .category-button .arrow,
            .difficulty-button .arrow,
            .release-button .arrow {
                background-color: #000;
                color: #fff;
                border-radius: 50%;
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background 0.2s, color 0.2s;
            }

            .step {
                display: none;
            }

            .step.active {
                display: block;
            }

            .split-container {
                width: 100%;
                max-width: 800px;
                justify-content: center;
                align-items: flex-start;
                gap: 20px;
            }

            .split-container textarea {
                width: 48%;
                min-width: 180px;
                max-width: 350px;
                margin: 0;
            }

            /* Paso extra: Imagen y video */
            .media-upload-container {
                width: 100%;
                max-width: 400px;
                background: #fafafa;
                border-radius: 18px;
                padding: 18px 0 10px 0;
                box-shadow: 0 2px 8px rgba(0,0,0,0.04);
                margin-bottom: 20px;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 18px;
            }
            .media-upload-container label {
                font-weight: bold;
                margin-bottom: 6px;
                width: 100%;
                text-align: left;
                padding-left: 24px;
            }
            /* Estilo bonito para input file */
            .media-upload-container input[type="file"] {
                display: none;
            }
            .custom-file-label {
                display: inline-block;
                padding: 10px 18px;
                background: #000;
                color: #fff;
                border-radius: 20px;
                cursor: pointer;
                font-size: 15px;
                margin-bottom: 10px;
                transition: background 0.2s;
                text-align: center;
                width: 90%;
                max-width: 320px;
            }
            .custom-file-label:hover {
                background: #B59359;
                color: #fff;
            }
            .media-upload-container input[type="text"] {
                width: 90%;
                max-width: 320px;
                padding: 12px 18px;
                font-size: 15px;
                border: 1px solid #ddd;
                border-radius: 20px;
                margin-bottom: 0;
                text-align: center;
                font-family: Arial, sans-serif;
                background: #fff;
                box-sizing: border-box;
                transition: border-color 0.2s;
            }
            .media-preview {
                width: 90%;
                max-width: 320px;
                margin-bottom: 10px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .media-preview img,
            .media-preview video {
                max-width: 100%;
                border-radius: 10px;
                margin-top: 8px;
            }

            .price-config-container {
                width: 100%;
                max-width: 400px;
                display: flex;
                flex-direction: column;
                gap: 12px;
                justify-content: center;
                align-items: center;
                margin-bottom: 20px;
                background: #fafafa;
                border-radius: 18px;
                padding: 18px 0 10px 0;
                box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            }

            .price-config-container input,
            .price-config-container select {
                width: 90%;
                max-width: 320px;
                padding: 12px 18px;
                font-size: 15px;
                border: 1px solid #ddd;
                border-radius: 20px;
                margin-bottom: 0;
                text-align: center;
                font-family: Arial, sans-serif;
                background: #fff;
                box-sizing: border-box;
                transition: border-color 0.2s;
            }

            .price-config-container input:focus,
            .price-config-container select:focus {
                border-color: #B59359;
                outline: none;
            }

            .release-container {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-bottom: 20px;
            }
            .release-container p {
                margin-bottom: 10px;
            }
            .release-options {
                display: flex;
                gap: 15px;
                justify-content: center;
                width: 100%;
            }

            /* Barra de progreso global en negro */
            .progress-indicator-global {
                width: 100%;
                max-width: 600px;
                margin: 40px auto 0 auto;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .progress-bar-bg {
                width: 100%;
                height: 10px;
                background: #f0f0f0;
                border-radius: 5px;
                overflow: hidden;
                margin-bottom: 8px;
            }
            .progress-bar-fg {
                height: 100%;
                background: #000;
                width: 0;
                transition: width 0.3s;
            }
            .progress-label {
                font-size: 14px;
                color: #222;
                margin-top: 2px;
            }

            .modal-summary {
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                display: none;
                align-items: center;
                justify-content: center;
                z-index: 2000;
            }
            .modal-content-summary {
                background: #fff;
                border-radius: 12px;
                padding: 32px 24px;
                box-shadow: 0 8px 32px rgba(0,0,0,0.18);
                max-width: 400px;
                width: 90%;
                text-align: left;
                position: relative;
                z-index: 2001;
            }
            .modal-content-summary h2 {
                margin-top: 0;
                margin-bottom: 18px;
                font-size: 22px;
                text-align: center;
            }
            .modal-actions {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                margin-top: 24px;
            }
            .modal-actions button {
                background: #000;
                color: #fff;
                border: none;
                border-radius: 5px;
                padding: 8px 18px;
                font-size: 14px;
                cursor: pointer;
            }
            .modal-actions button:first-child {
                background: #bbb;
                color: #222;
            }
            .modal-backdrop {
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(0,0,0,0.25);
                z-index: 2000;
            }
        </style>
    </head>
    <body>
        <!-- Botón Volver -->
        <a href="<?php echo site_url('user/elevant/courses'); ?>" class="back-button">Volver a cursos</a>

        <form id="elevant-course-form" action="<?php echo site_url('user/elevant/course_add_submit'); ?>" method="post" enctype="multipart/form-data">
            <!-- Paso 1 -->
            <div class="step step-1 active">
                <h1>¿Cómo se llama tu curso?</h1>
                <p>Escribe un nombre claro y atractivo que describa de qué trata tu curso. ¡Haz que despierte curiosidad!</p>
                <div class="form-container">
                    <input type="text" id="course-name" name="title" placeholder="Nombre o título del curso" required>
                    <div class="button-group">
                        <button onclick="goToStep(1)" disabled type="button">Atrás</button>
                        <button onclick="goToStep(2)" type="button">Siguiente</button>
                    </div>
                </div>
                <div class="progress-indicator"></div>
            </div>

            <!-- Paso 2 -->
            <div class="step step-2">
                <h1>Un resumen que enganche</h1>
                <p>Explica brevemente de qué trata tu curso en 1 o 2 frases. Ideal para que las personas se animen a saber más.</p>
                <div class="form-container">
                    <input type="text" id="short-description" name="short_description" placeholder="Descripción corta del curso" required>
                    <textarea id="full-description" name="description" placeholder="Descripción completa"></textarea>
                    <div class="button-group">
                        <button onclick="goToStep(1)" type="button">Atrás</button>
                        <button onclick="goToStep(3)" type="button">Siguiente</button>
                    </div>
                </div>
                <div class="progress-indicator"></div>
            </div>

            <!-- Paso 3 -->
            <div class="step step-3">
                <h1>¿A qué tema pertenece tu curso?</h1>
                <p>Elige una o varias categorías que representen el contenido: cocina, tecnología, arte, educación, etc.</p>
                <div class="form-container">
                    <div class="categories-container">
                        <?php foreach ($categories as $cat): ?>
                            <?php if (count($subcategories[$cat['id']]) > 0): ?>
                                <?php foreach ($subcategories[$cat['id']] as $subcat): ?>
                                    <div class="category-button" data-value="<?php echo $subcat['id']; ?>">
                                        <div class="arrow">&rarr;</div>
                                        <?php echo htmlspecialchars($subcat['name']); ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="category-button" data-value="<?php echo $cat['id']; ?>">
                                    <div class="arrow">&rarr;</div>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <input type="hidden" name="category" id="category-input" required>
                    <div class="button-group">
                        <button onclick="goToStep(2)" type="button">Atrás</button>
                        <button onclick="goToStep(4)" type="button">Siguiente</button>
                    </div>
                </div>
                <div class="progress-indicator"></div>
            </div>

            <!-- Paso 4 -->
            <div class="step step-4">
                <h1>¿Para quién es este curso?</h1>
                <p>Indica si el curso es para principiantes, intermedios o avanzados, según la dificultad del contenido.</p>
                <div class="form-container">
                    <div class="difficulty-container">
                        <div class="difficulty-button" data-value="principiante">
                            <div class="arrow">&rarr;</div>
                            Principiante
                        </div>
                        <div class="difficulty-button" data-value="intermedio">
                            <div class="arrow">&rarr;</div>
                            Intermedio
                        </div>
                        <div class="difficulty-button" data-value="experto">
                            <div class="arrow">&rarr;</div>
                            Experto
                        </div>
                    </div>
                    <input type="hidden" name="level" id="level-input" required>
                    <div class="release-container">
                        <p>¿Quieres liberar las clases poco a poco?</p>
                        <div class="release-options">
                            <div class="release-button" data-value="no">
                                <div class="arrow">&rarr;</div>
                                No
                            </div>
                            <div class="release-button" data-value="si">
                                <div class="arrow">&rarr;</div>
                                Sí
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="enable_drip_content" id="drip-content-input" value="0">
                    <div class="language-container">
                        <p>¿En qué idioma das tu curso?</p>
                        <select id="course-language" name="language_made_in">
                            <option value="es">Español</option>
                            <option value="en">Inglés</option>
                            <option value="fr">Francés</option>
                            <option value="de">Alemán</option>
                            <option value="it">Italiano</option>
                            <option value="pt">Portugués</option>
                        </select>
                    </div>
                    <div class="button-group">
                        <button onclick="goToStep(3)" type="button">Atrás</button>
                        <button onclick="goToStep(5)" type="button">Siguiente</button>
                    </div>
                </div>
                <div class="progress-indicator"></div>
            </div>

            <!-- Paso 5 -->
            <div class="step step-5">
                <h1>¿Qué necesita saber o tener el estudiante antes de empezar?</h1>
                <p>Indica si hay conocimientos previos o herramientas necesarias para aprovechar bien el curso.</p>
                <div class="form-container">
                    <div class="split-container">
                        <textarea id="course-requirements" name="requirements" placeholder="Requisitos del curso"></textarea>
                        <textarea id="student-outcomes" name="outcomes" placeholder="¿Qué aprenderá o logrará el estudiante al finalizar?"></textarea>
                    </div>
                    <div class="button-group">
                        <button onclick="goToStep(4)" type="button">Atrás</button>
                        <button onclick="goToStep(6)" type="button">Siguiente</button>
                    </div>
                </div>
                <div class="progress-indicator"></div>
            </div>

            <!-- Paso 6 -->
            <div class="step step-6">
                <h1>Imagen y video de presentación</h1>
                <p>Sube una imagen de portada para tu curso y, si lo deseas, un video de presentación.</p>
                <div class="form-container">
                    <div class="media-upload-container">
                        <label for="course-image">Imagen del curso <span style="color:#d42ad8">*</span></label>
                        <label class="custom-file-label" id="label-course-image" for="course-image">Seleccionar imagen</label>
                        <input type="file" id="course-image" name="course_image" accept="image/*" required onchange="previewCourseImage(event)">
                        <div class="media-preview" id="image-preview"></div>

                        <label for="course-video">Video de presentación (opcional)</label>
                        <label class="custom-file-label" id="label-course-video" for="course-video">Seleccionar video</label>
                        <input type="file" id="course-video" name="course_video" accept="video/*" onchange="previewCourseVideo(event)">
                        <div class="media-preview" id="video-preview"></div>

                        <label for="video-url">O pega un enlace de video (YouTube, Vimeo, etc.)</label>
                        <input type="text" id="video-url" name="video_url" placeholder="https://...">
                    </div>
                    <div class="button-group">
                        <button onclick="goToStep(5)" type="button">Atrás</button>
                        <button onclick="goToStep(7)" type="button">Siguiente</button>
                    </div>
                </div>
                <div class="progress-indicator"></div>
            </div>

            <!-- Paso 7 -->
            <div class="step step-7">
                <h1>¿Tu curso es gratis o tiene un costo?</h1>
                <p>Puedes elegir si será gratuito, tendrá un precio fijo o incluir un descuento. ¡Tú decides!</p>
                <div class="form-container">
                    <div class="free-course-container" style="width:100%;max-width:400px;text-align:left;margin-bottom:20px;">
                        <label style="display:flex;align-items:center;gap:10px;font-size:16px;">
                            <input type="checkbox" id="is-free-course" name="is_free_course" value="1" onchange="togglePriceFields()" style="width:18px;height:18px;">
                            Este curso es gratis
                        </label>
                    </div>
                    <div class="price-config-container" id="price-config-container">
                        <input type="number" id="course-price" name="price" placeholder="Valor del curso" min="0" step="any" />
                        <select id="discount-type" name="discount_type">
                            <option value="">Tipo de descuento</option>
                            <option value="percentage">Porcentaje</option>
                            <option value="fixed">Fijo</option>
                        </select>
                        <input type="number" id="discount-value" name="discount_value" placeholder="Valor de descuento" min="0" step="any" />
                    </div>
                    <div class="button-group">
                        <button onclick="goToStep(6)" type="button">Atrás</button>
                        <button type="button" onclick="showSummaryModal()">Enviar</button>
                    </div>
                </div>
                <div class="progress-indicator"></div>
            </div>
        </form>

        <!-- Modal de resumen -->
        <div id="summary-modal" class="modal-summary" style="display:none;">
            <div class="modal-content-summary">
                <h2>Resumen del curso</h2>
                <div id="summary-content"></div>
                <div class="modal-actions">
                    <button onclick="closeSummaryModal()">Cancelar</button>
                    <button onclick="document.getElementById('elevant-course-form').submit()">Confirmar y Enviar</button>
                </div>
            </div>
            <div class="modal-backdrop" onclick="closeSummaryModal()"></div>
        </div>

        <div class="progress-indicator-global">
            <div class="progress-bar-bg">
                <div class="progress-bar-fg" id="progress-bar-fg"></div>
            </div>
            <div class="progress-label" id="progress-label">Paso 1 de 7</div>
        </div>

        <script>
            let currentStep = 1;
            const totalSteps = 7;

            function goToStep(step) {
                const steps = document.querySelectorAll('.step');
                steps.forEach(s => s.classList.remove('active'));
                document.querySelector('.step-' + step).classList.add('active');
                currentStep = step;
                updateGlobalProgress();
            }

            function updateGlobalProgress() {
                const percent = ((currentStep - 1) / (totalSteps - 1)) * 100;
                document.getElementById('progress-bar-fg').style.width = percent + '%';
                document.getElementById('progress-label').textContent = 'Paso ' + currentStep + ' de ' + totalSteps;
            }

            // Previsualización de imagen
            function previewCourseImage(event) {
                const preview = document.getElementById('image-preview');
                preview.innerHTML = '';
                const file = event.target.files[0];
                if (file) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.onload = () => URL.revokeObjectURL(img.src);
                    img.style.maxHeight = '120px';
                    preview.appendChild(img);
                }
            }

            // Previsualización de video
            function previewCourseVideo(event) {
                const preview = document.getElementById('video-preview');
                preview.innerHTML = '';
                const file = event.target.files[0];
                if (file) {
                    const video = document.createElement('video');
                    video.src = URL.createObjectURL(file);
                    video.controls = true;
                    video.style.maxHeight = '160px';
                    preview.appendChild(video);
                }
            }

            function showSummaryModal() {
                const resumen = `
                    <strong>Nombre del curso:</strong> ${document.getElementById('course-name').value}<br>
                    <strong>Descripción corta:</strong> ${document.getElementById('short-description').value}<br>
                    <strong>Descripción completa:</strong> ${document.getElementById('full-description').value}<br>
                    <strong>Categoría:</strong> ${getSelectedCategory()}<br>
                    <strong>Dificultad:</strong> ${getSelectedDifficulty()}<br>
                    <strong>Liberar clases poco a poco:</strong> ${getReleaseOption()}<br>
                    <strong>Idioma:</strong> ${document.getElementById('course-language').options[document.getElementById('course-language').selectedIndex].text}<br>
                    <strong>Requisitos:</strong> ${document.getElementById('course-requirements').value}<br>
                    <strong>Resultados:</strong> ${document.getElementById('student-outcomes').value}<br>
                    <strong>¿Gratis?:</strong> ${document.getElementById('is-free-course').checked ? 'Sí' : 'No'}<br>
                    ${!document.getElementById('is-free-course').checked ? `
                        <strong>Precio:</strong> ${document.getElementById('course-price').value}<br>
                        <strong>Tipo de descuento:</strong> ${document.getElementById('discount-type').options[document.getElementById('discount-type').selectedIndex].text}<br>
                        <strong>Valor de descuento:</strong> ${document.getElementById('discount-value').value}<br>
                    ` : ''}
                `;
                document.getElementById('summary-content').innerHTML = resumen;
                document.getElementById('summary-modal').style.display = 'flex';
            }

            function closeSummaryModal() {
                document.getElementById('summary-modal').style.display = 'none';
            }

            function togglePriceFields() {
                const isFree = document.getElementById('is-free-course').checked;
                const priceConfig = document.getElementById('price-config-container');
                if (isFree) {
                    priceConfig.style.display = 'none';
                } else {
                    priceConfig.style.display = 'flex';
                }
            }

            function getSelectedCategory() {
                const cats = document.querySelectorAll('.step-3 .category-button');
                for (let cat of cats) {
                    if (cat.classList.contains('selected')) return cat.textContent.trim();
                }
                return '';
            }

            function getSelectedDifficulty() {
                const diffs = document.querySelectorAll('.step-4 .difficulty-button');
                for (let d of diffs) {
                    if (d.classList.contains('selected')) return d.textContent.trim();
                }
                return '';
            }

            function getReleaseOption() {
                const opts = document.querySelectorAll('.step-4 .release-button');
                for (let o of opts) {
                    if (o.classList.contains('selected')) return o.textContent.trim();
                }
                return '';
            }

            document.addEventListener('DOMContentLoaded', function() {
                updateGlobalProgress();
                togglePriceFields();

                document.querySelectorAll('.category-button').forEach(btn => {
                    btn.onclick = function() {
                        document.querySelectorAll('.category-button').forEach(b => b.classList.remove('selected'));
                        btn.classList.add('selected');
                        document.getElementById('category-input').value = btn.getAttribute('data-value');
                    };
                });
                document.querySelectorAll('.difficulty-button').forEach(btn => {
                    btn.onclick = function() {
                        document.querySelectorAll('.difficulty-button').forEach(b => b.classList.remove('selected'));
                        btn.classList.add('selected');
                        document.getElementById('level-input').value = btn.getAttribute('data-value');
                    };
                });
                document.querySelectorAll('.release-button').forEach(btn => {
                    btn.onclick = function() {
                        document.querySelectorAll('.release-button').forEach(b => b.classList.remove('selected'));
                        btn.classList.add('selected');
                        document.getElementById('drip-content-input').value = btn.getAttribute('data-value') === 'si' ? 1 : 0;
                    };
                });

                document.getElementById('course-image').addEventListener('change', function(e) {
                    const label = document.getElementById('label-course-image');
                    if (this.files.length > 0) {
                        label.textContent = this.files[0].name;
                    } else {
                        label.textContent = 'Seleccionar imagen';
                    }
                });
                document.getElementById('label-course-image').addEventListener('click', function() {
                    document.getElementById('course-image').click();
                });

                document.getElementById('course-video').addEventListener('change', function(e) {
                    const label = document.getElementById('label-course-video');
                    if (this.files.length > 0) {
                        label.textContent = this.files[0].name;
                    } else {
                        label.textContent = 'Seleccionar video';
                    }
                });
                document.getElementById('label-course-video').addEventListener('click', function() {
                    document.getElementById('course-video').click();
                });
            });
        </script>
    </body>
    </html>
</div>