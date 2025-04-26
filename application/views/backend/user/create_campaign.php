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
                                            <button type="button" class="btn btn-primary select-template" data-template="template_1">
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
                    <input type="hidden" id="selected_template" name="selected_template" value="">
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

<!-- Librerías necesarias -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

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
    });
</script>