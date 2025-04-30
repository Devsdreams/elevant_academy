<?php
$user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
$this->load->model('Affiliate_model');
$affiliate_data = $this->Affiliate_model->get_affiliate_dashboard_data($user_details['email']);

// Calcula métricas generales
$total_clicks = array_sum(array_column($affiliate_data, 'total_clicks'));
$total_conversions = array_sum(array_column($affiliate_data, 'total_conversions'));
$total_sales = array_sum(array_column($affiliate_data, 'total_sales'));

// Obtén el enlace principal del afiliado
$main_affiliate_link = !empty($affiliate_data) ? $affiliate_data[0]['generated_url'] : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <!-- Archivos CSS comunes -->
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/default/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/default/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/default/css/responsive.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/default/css/fontawesome-all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/default/css/custom.css'); ?>"> <!-- Si existe -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Librería para gráficos -->
</head>
<body>
    <section class="affiliate-dashboard-area" style="background-color: #f7f8fa; padding: 50px 0;">
        <div class="container-xl">
            <div class="row mb-4">
                <div class="col text-center">
                    <h4 class="mb-3"><?php echo site_phrase('affiliate_dashboard'); ?></h4>
                    <p>
                        <strong><?php echo site_phrase('Hi'); ?>, <?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></strong><br>
                        <?php echo $user_details['email']; ?><br>
                        <span class="text-muted"><?php echo site_phrase('welcome_back'); ?></span>
                    </p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col text-center">
                    <h5 class="mb-3"><?php echo site_phrase('your_affiliate_link'); ?></h5>
                    <?php if ($main_affiliate_link): ?>
                        <div class="input-group">
                            <input type="text" class="form-control text-center" value="<?php echo $main_affiliate_link; ?>" readonly>
                            <button class="btn btn-primary" onclick="navigator.clipboard.writeText('<?php echo $main_affiliate_link; ?>')">
                                <?php echo site_phrase('copy_link'); ?>
                            </button>
                        </div>
                    <?php else: ?>
                        <p class="text-muted"><?php echo site_phrase('no_affiliate_link_found'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <!-- Tarjeta: Total de clics -->
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo site_phrase('total_clicks'); ?></h5>
                            <p class="card-text display-6"><?php echo $total_clicks; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Tarjeta: Total de conversiones -->
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo site_phrase('total_conversions'); ?></h5>
                            <p class="card-text display-6"><?php echo $total_conversions; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Tarjeta: Ventas totales -->
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo site_phrase('total_sales'); ?></h5>
                            <p class="card-text display-6"><?php echo currency($total_sales); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <!-- Gráfico de clics y conversiones -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo site_phrase('clicks_vs_conversions'); ?></h5>
                            <canvas id="clicksConversionsChart" style="max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Gráfico de ventas por curso -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo site_phrase('sales_by_course'); ?></h5>
                            <canvas id="salesByCourseChart" style="max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <!-- Archivos JS comunes -->
    <script src="<?php echo base_url('assets/frontend/default/js/jquery-3.6.0.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/frontend/default/js/bootstrap.bundle.min.js'); ?>"></script>
    <script>
        // Datos para el gráfico de clics vs conversiones
        const clicksConversionsData = {
            labels: ['<?php echo site_phrase('clicks'); ?>', '<?php echo site_phrase('conversions'); ?>'],
            datasets: [{
                label: '<?php echo site_phrase('clicks_vs_conversions'); ?>',
                data: [<?php echo $total_clicks; ?>, <?php echo $total_conversions; ?>],
                backgroundColor: ['#007bff', '#28a745']
            }]
        };

        // Configuración del gráfico de clics vs conversiones
        const clicksConversionsConfig = {
            type: 'doughnut',
            data: clicksConversionsData
        };

        // Renderizar el gráfico de clics vs conversiones
        new Chart(document.getElementById('clicksConversionsChart'), clicksConversionsConfig);

        // Datos para el gráfico de ventas por curso
        const salesByCourseData = {
            labels: <?php echo json_encode(array_column($affiliate_data, 'course_title')); ?>,
            datasets: [{
                label: '<?php echo site_phrase('total_sales'); ?>',
                data: <?php echo json_encode(array_column($affiliate_data, 'total_sales')); ?>,
                backgroundColor: '#ffc107'
            }]
        };

        // Configuración del gráfico de ventas por curso
        const salesByCourseConfig = {
            type: 'bar',
            data: salesByCourseData
        };

        // Renderizar el gráfico de ventas por curso
        new Chart(document.getElementById('salesByCourseChart'), salesByCourseConfig);
    </script>
</body>
</html>
