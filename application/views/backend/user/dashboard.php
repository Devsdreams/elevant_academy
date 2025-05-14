<?php
    $instructor_id = $this->session->userdata('user_id');
    $number_of_courses = $this->crud_model->get_instructor_wise_courses($instructor_id)->num_rows();
    $number_of_enrolment_result = $this->crud_model->instructor_wise_enrolment($instructor_id);
    if ($number_of_enrolment_result) {
        $number_of_enrolment = $number_of_enrolment_result->num_rows();
    } else {
        $number_of_enrolment = 0;
    }
    $total_pending_amount = $this->crud_model->get_total_pending_amount($instructor_id);
    $requested_withdrawal_amount = $this->crud_model->get_requested_withdrawal_amount($instructor_id);
?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('dashboard'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4"><?php echo get_phrase('instructor_revenue'); ?></h4>
                <div class="mt-3 chartjs-chart" style="height: 320px;">
                    <canvas id="task-area-chart"></canvas>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-12">
        <div class="card widget-inline">
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 col-xl-3">
                        <a href="<?php echo site_url('user/courses'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="dripicons-archive text-muted" style="font-size: 24px;"></i>
                                    <h3><span><?php echo $number_of_courses; ?></span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('number_of_courses'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card shadow-none m-0 border-left">
                            <div class="card-body text-center">
                                <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                <h3><span><?php echo $number_of_enrolment; ?></span></h3>
                                <p class="text-muted font-15 mb-0"><?php echo get_phrase('number_of_enrolment'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <a href="<?php echo site_url('user/payout_report'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-inbox text-muted" style="font-size: 24px;"></i>
                                    <h3><span><?php echo $total_pending_amount > 0 ? currency($total_pending_amount) : currency_code_and_symbol().''.$total_pending_amount; ?></span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('pending_balance'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <a href="<?php echo site_url('user/payout_report'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-pin text-muted" style="font-size: 24px;"></i>
                                    <h3><span><?php echo $requested_withdrawal_amount > 0 ? currency($requested_withdrawal_amount) : currency_code_and_symbol().''.$requested_withdrawal_amount; ?></span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('requested_withdrawal_amount'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                </div> <!-- end row -->
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col-->
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4"><?php echo get_phrase('course_overview'); ?></h4>
                <div class="my-4 chartjs-chart" style="height: 202px;">
                    <canvas id="project-status-chart"></canvas>
                </div>
                <div class="row text-center mt-2 py-2">
                    <div class="col-6">
                        <i class="mdi mdi-trending-up text-success mt-3 h3"></i>
                        <h3 class="font-weight-normal">
                            <span><?php echo $this->crud_model->get_status_wise_courses_for_instructor('active')->num_rows(); ?></span>
                        </h3>
                        <p class="text-muted mb-0"><?php echo get_phrase('active_courses'); ?></p>
                    </div>
                    <div class="col-6">
                        <i class="mdi mdi-trending-down text-warning mt-3 h3"></i>
                        <h3 class="font-weight-normal">
                            <span><?php echo $this->crud_model->get_status_wise_courses_for_instructor('pending')->num_rows(); ?></span>
                        </h3>
                        <p class="text-muted mb-0"> <?php echo get_phrase('pending_courses'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="firstCoursePopup" class="popup-overlay" style="display: none;">
    <div class="popup-content">
        <h5 class="popup-title">¡Bienvenido a Elevant!</h5>
        <p>¡Es genial tenerte aquí! Elevant está diseñado para ayudarte a compartir tu conocimiento y transformar vidas. Comencemos creando tu primer curso de forma rápida y sencilla.</p>
        <div class="popup-buttons">
            <a href="<?php echo site_url('user/course_form/add_course'); ?>" class="btn btn-primary">Crear curso</a>
            <button id="closePopup" class="btn btn-secondary">Más tarde</button>
        </div>
    </div>
</div>

<style>
    /* Estilos para el popup */
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: flex-start; /* Alinea el popup en la parte superior */
        z-index: 9999;
        padding-top: 20px; /* Espaciado desde la parte superior */
    }

    .popup-content {
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        width: 90%;
        position: relative;
    }

    .popup-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .popup-buttons {
        position: absolute;
        bottom: 10px; /* Espaciado desde la parte inferior */
        right: 10px; /* Espaciado desde la parte derecha */
        display: flex;
        gap: 10px; /* Espaciado entre los botones */
    }

    .popup-buttons .btn {
        margin: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mostrar el popup si el número de cursos es 0
        var numberOfCourses = <?php echo $number_of_courses; ?>;
        if (numberOfCourses === 0) {
            var popup = document.getElementById('firstCoursePopup');
            popup.style.display = 'flex';

            // Cerrar el popup al hacer clic en "Más tarde"
            document.getElementById('closePopup').addEventListener('click', function () {
                popup.style.display = 'none';
            });
        }
    });
</script>
