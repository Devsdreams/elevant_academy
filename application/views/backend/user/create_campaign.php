<!-- filepath: c:\xampp\htdocs\elevant_academy\application\views\backend\user\create_campaign.php -->
<div class="container">
    <h3><?php echo get_phrase('create_campaign'); ?></h3>
    <form action="<?php echo site_url('user/save_campaign'); ?>" method="post">
        <div id="progressbarwizard">
            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                <li class="nav-item">
                    <a href="#edit_template" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                        <i class="mdi mdi-pencil-outline mr-1"></i>
                        <span class="d-none d-sm-inline"><?php echo get_phrase('edit_template'); ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#configuration" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                        <i class="mdi mdi-cog-outline mr-1"></i>
                        <span class="d-none d-sm-inline"><?php echo get_phrase('configuration'); ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#send_or_schedule" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                        <i class="mdi mdi-calendar-clock-outline mr-1"></i>
                        <span class="d-none d-sm-inline"><?php echo get_phrase('send_or_schedule'); ?></span>
                    </a>
                </li>
            </ul>

            <div class="tab-content b-0 mb-0">
                <div id="bar" class="progress mb-3" style="height: 7px;">
                    <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                </div>

                <!-- Edit Template Section -->
                <div class="tab-pane" id="edit_template">
                    <div class="row">
                        <div class="col-12">
                            <h5><?php echo get_phrase('select_a_template'); ?></h5>
                            <div class="row">
                                <!-- Template 1 -->
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="https://placehold.org/300x200/808080/FFFFFF?text=Template+1" class="card-img-top" alt="Template 1">
                                        <div class="card-body text-center">
                                            <h6 class="card-title"><?php echo get_phrase('template_1'); ?></h6>
                                            <p class="card-text"><?php echo get_phrase('basic_email_template'); ?></p>
                                            <button type="button" class="btn btn-primary select-template" data-template="template1">
                                                <?php echo get_phrase('select'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Template 2 -->
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="https://placehold.org/300x200/808080/FFFFFF?text=Template+2" class="card-img-top" alt="Template 2">
                                        <div class="card-body text-center">
                                            <h6 class="card-title"><?php echo get_phrase('template_2'); ?></h6>
                                            <p class="card-text"><?php echo get_phrase('modern_email_template'); ?></p>
                                            <button type="button" class="btn btn-primary select-template" data-template="template_2">
                                                <?php echo get_phrase('select'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Template 3 -->
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="https://placehold.org/300x200/808080/FFFFFF?text=Template+3" class="card-img-top" alt="Template 3">
                                        <div class="card-body text-center">
                                            <h6 class="card-title"><?php echo get_phrase('template_3'); ?></h6>
                                            <p class="card-text"><?php echo get_phrase('professional_email_template'); ?></p>
                                            <button type="button" class="btn btn-primary select-template" data-template="template_3">
                                                <?php echo get_phrase('select'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Template 4 -->
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="https://placehold.org/300x200/808080/FFFFFF?text=Template+4" class="card-img-top" alt="Template 4">
                                        <div class="card-body text-center">
                                            <h6 class="card-title"><?php echo get_phrase('template_4'); ?></h6>
                                            <p class="card-text"><?php echo get_phrase('creative_email_template'); ?></p>
                                            <button type="button" class="btn btn-primary select-template" data-template="template_4">
                                                <?php echo get_phrase('select'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="selected_template" name="template" value="">
                </div>

                <!-- Configuration Section -->
                <div class="tab-pane" id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <!-- Nombre de la campaña -->
                            <div class="form-group">
                                <label for="campaign_name"><?php echo get_phrase('campaign_name'); ?></label>
                                <input type="text" class="form-control" id="campaign_name" name="campaign_name" placeholder="<?php echo get_phrase('enter_campaign_name'); ?>" required>
                            </div>

                            <!-- Sujeto del correo -->
                            <div class="form-group">
                                <label for="subject"><?php echo get_phrase('subject'); ?></label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="<?php echo get_phrase('enter_subject'); ?>" required>
                            </div>

                            <!-- Correo del remitente -->
                            <div class="form-group">
                                <label for="sender_email"><?php echo get_phrase('sender_email'); ?></label>
                                <input type="email" class="form-control" id="sender_email" name="sender_email" value="<?php echo $user_details['email']; ?>" readonly>
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="change_sender_email">
                                    <label class="form-check-label" for="change_sender_email"><?php echo get_phrase('use_another_email'); ?></label>
                                </div>
                            </div>

                            <!-- Selección de grupos -->
                            <div class="form-group">
                                <label for="group"><?php echo get_phrase('select_groups'); ?></label>
                                <select class="form-control select2" id="group" name="group_ids[]" multiple="multiple" required>
                                    <?php foreach ($groups as $group): ?>
                                        <option value="<?php echo $group['id']; ?>"><?php echo $group['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Send or Schedule Section -->
                <div class="tab-pane" id="send_or_schedule">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="schedule_date"><?php echo get_phrase('schedule_date'); ?></label>
                                <input type="datetime-local" class="form-control" id="schedule_date" name="schedule_date">
                                <small class="text-muted"><?php echo get_phrase('leave_blank_to_send_immediately'); ?></small>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="list-inline mb-0 wizard text-center">
                    <li class="previous list-inline-item">
                        <a href="javascript:;" class="btn btn-info"> <i class="mdi mdi-arrow-left-bold"></i> </a>
                    </li>
                    <li class="next list-inline-item">
                        <a href="javascript:;" class="btn btn-info"> <i class="mdi mdi-arrow-right-bold"></i> </a>
                    </li>
                    <li class="finish list-inline-item">
                        <button type="submit" class="btn btn-success"><?php echo get_phrase('finish'); ?></button>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>

<!-- Modal para editar la plantilla -->
<div class="modal fade" id="templateModal" tabindex="-1" role="dialog" aria-labelledby="templateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="templateModalLabel"><?php echo get_phrase('edit_template'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Formulario mejorado -->
                    <div class="col-md-4">
                        <form id="templateForm">
                            <div class="form-group">
                                <label for="email_title"><?php echo get_phrase('email_title'); ?></label>
                                <input type="text" class="form-control form-control-sm" id="email_title" name="email_title" placeholder="<?php echo get_phrase('enter_email_title'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="main_heading"><?php echo get_phrase('main_heading'); ?></label>
                                <input type="text" class="form-control form-control-sm" id="main_heading" name="main_heading" placeholder="<?php echo get_phrase('enter_main_heading'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="sub_heading"><?php echo get_phrase('sub_heading'); ?></label>
                                <input type="text" class="form-control form-control-sm" id="sub_heading" name="sub_heading" placeholder="<?php echo get_phrase('enter_sub_heading'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email_body"><?php echo get_phrase('email_body'); ?></label>
                                <textarea class="form-control form-control-sm" id="email_body" name="email_body" rows="3" placeholder="<?php echo get_phrase('enter_email_body'); ?>"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="promo_text"><?php echo get_phrase('promo_text'); ?></label>
                                <input type="text" class="form-control form-control-sm" id="promo_text" name="promo_text" placeholder="<?php echo get_phrase('enter_promo_text'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="promo_price"><?php echo get_phrase('promo_price'); ?></label>
                                <input type="text" class="form-control form-control-sm" id="promo_price" name="promo_price" placeholder="<?php echo get_phrase('enter_promo_price'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="button_text"><?php echo get_phrase('button_text'); ?></label>
                                <input type="text" class="form-control form-control-sm" id="button_text" name="button_text" placeholder="<?php echo get_phrase('enter_button_text'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="button_url"><?php echo get_phrase('button_url'); ?></label>
                                <input type="url" class="form-control form-control-sm" id="button_url" name="button_url" placeholder="<?php echo get_phrase('enter_button_url'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="footer_text"><?php echo get_phrase('footer_text'); ?></label>
                                <textarea class="form-control form-control-sm" id="footer_text" name="footer_text" rows="2" placeholder="<?php echo get_phrase('enter_footer_text'); ?>"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image_1"><?php echo get_phrase('logo_image'); ?></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image_1" name="image_1" accept="image/*" data-variable="image_1">
                                    <label class="custom-file-label" for="image_1"><?php echo get_phrase('choose_file'); ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image_2"><?php echo get_phrase('main_image'); ?></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image_2" name="image_2" accept="image/*" data-variable="image_2">
                                    <label class="custom-file-label" for="image_2"><?php echo get_phrase('choose_file'); ?></label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Vista previa -->
                    <div class="col-md-8">
                        <h5><?php echo get_phrase('template_preview'); ?></h5>
                        <iframe id="templateIframe" src="" frameborder="0" style="width: 100%; height: 800px; border: 1px solid #ddd; max-width: 1200px;"></iframe>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?php echo get_phrase('close'); ?></button>
                <button type="button" class="btn btn-primary btn-sm" id="saveTemplate"><?php echo get_phrase('save'); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Inicializar Select2
        $('.select2').select2({
            placeholder: "<?php echo get_phrase('select_groups'); ?>",
            allowClear: true
        });

        // Mostrar/ocultar campo de correo del remitente
        $('#change_sender_email').on('change', function () {
            const senderEmailField = $('#sender_email');
            if ($(this).is(':checked')) {
                senderEmailField.removeAttr('readonly').val('');
            } else {
                senderEmailField.attr('readonly', true).val('<?php echo $user_details['email']; ?>');
            }
        });

        // Manejar la selección de plantilla
        $('.select-template').on('click', function () {
            const template = $(this).data('template');
            $('#selected_template').val(template); // Guardar la plantilla seleccionada

            if (template === 'template1') {
                // Mostrar el modal
                $('#templateModal').modal('show');

                // Renderizar la vista previa inicial de la plantilla
                const iframe = document.getElementById('templateIframe');
                iframe.src = '<?php echo site_url("user/render_template"); ?>/' + template;

                // Establecer imágenes temporales si no hay imágenes seleccionadas
                const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                iframe.onload = function () {
                    const logoImage = iframeDoc.querySelector('img[data-variable="image_1"]');
                    const mainImage = iframeDoc.querySelector('img[data-variable="image_2"]');

                    if (logoImage && !logoImage.src) {
                        logoImage.src = 'https://placehold.org/150x50/808080/FFFFFF?text=Logo+Placeholder';
                    }
                    if (mainImage && !mainImage.src) {
                        mainImage.src = 'https://placehold.org/600x300/808080/FFFFFF?text=Main+Image+Placeholder';
                    }
                };
            } else {
                alert('<?php echo get_phrase("template_selected"); ?>: ' + template);
            }
        });

        // Actualizar la vista previa en tiempo real
        $('#templateForm input, #templateForm textarea').on('input', function () {
            const iframe = document.getElementById('templateIframe');
            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

            // Obtener el nombre del campo y su valor
            const fieldName = $(this).attr('name');
            const fieldValue = $(this).val();

            // Buscar el elemento con el atributo data-variable y actualizar su contenido
            const targetElement = iframeDoc.querySelector(`*[data-variable="${fieldName}"]`);
            if (targetElement) {
                if (targetElement.tagName === 'A') {
                    // Si es un enlace, actualizamos el texto y el atributo href
                    targetElement.textContent = fieldValue;
                    if (fieldName === 'button_url') {
                        targetElement.setAttribute('href', fieldValue);
                    }
                } else {
                    // Para otros elementos, solo actualizamos el texto
                    targetElement.textContent = fieldValue;
                }
            }
        });

        // Actualizar la vista previa en tiempo real para imágenes
        $('#image_1, #image_2').on('change', function (event) {
            const file = event.target.files[0];
            const fieldId = $(this).attr('id');

            // Crear un objeto FormData para enviar el archivo
            const formData = new FormData();
            formData.append('image_file', file);
            formData.append('image_id', fieldId); // Enviar el identificador de la imagen

            // Enviar la imagen al servidor
            $.ajax({
                url: '<?php echo site_url("user/upload_user_image"); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log('Imagen guardada en:', response);

                    // Actualizar la vista previa en el iframe
                    const iframe = document.getElementById('templateIframe');
                    const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                    const targetElement = iframeDoc.querySelector(`img[data-variable="${fieldId}"]`);

                    if (targetElement) {
                        targetElement.src = response; // Actualizar la vista previa con la URL de la imagen
                        if (fieldId === 'image_1') {
                            targetElement.style.width = '167px';
                            targetElement.style.height = '28px';
                        }
                    }

                    // Guardar la URL correcta en el localStorage
                    const templateData = JSON.parse(localStorage.getItem('template_data')) || {};
                    templateData[fieldId] = response; // Guardar la URL de la imagen
                    localStorage.setItem('template_data', JSON.stringify(templateData));
                    console.log('Template Data actualizado en localStorage:', templateData);
                },
                error: function () {
                    console.error('Error al guardar la imagen.');
                }
            });
        });

        // Guardar los valores ingresados en el formulario en localStorage
        $('#saveTemplate').on('click', function () {
            const templateData = JSON.parse(localStorage.getItem('template_data')) || {};

            // Procesar campos de texto y textarea
            $('#templateForm input, #templateForm textarea').each(function () {
                const fieldName = $(this).attr('name');
                const fieldValue = $(this).val();

                // Solo actualizar los campos que no sean imágenes
                if (!fieldName.startsWith('image_')) {
                    templateData[fieldName] = fieldValue;
                }
            });

            // Guardar los datos actualizados en localStorage
            localStorage.setItem('template_data', JSON.stringify(templateData));
            console.log('Template Data guardado en localStorage:', templateData);

            // Cerrar el modal
            $('#templateModal').modal('hide');
        });

        // Al enviar el formulario principal, incluir los datos de la plantilla
        $('form').on('submit', function () {
            const templateData = localStorage.getItem('template_data');
            if (templateData) {
                // Agregar los datos de la plantilla al formulario como un campo oculto
                $('<input>').attr({
                    type: 'hidden',
                    name: 'template_data',
                    value: templateData
                }).appendTo(this);
            }
        });

        // Mostrar nombre del archivo seleccionado
        $('.custom-file-input').on('change', function () {
            const fileName = $(this).val().split('\\').pop();
            $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        });
    });
</script>