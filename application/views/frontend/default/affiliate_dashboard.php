<?php
$user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
$this->load->model('Affiliate_model');
$affiliate_data = $this->Affiliate_model->get_affiliate_dashboard_data($user_details['email']);

// Calcula métricas generales
$total_clicks = array_sum(array_column($affiliate_data, 'total_clicks'));
$total_conversions = array_sum(array_column($affiliate_data, 'total_conversions'));
$total_sales = array_sum(array_column($affiliate_data, 'total_sales'));
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
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
                <div class="col">
                    <h5 class="mb-3 text-center"><?php echo site_phrase('your_affiliate_links'); ?></h5>
                    <?php if (!empty($affiliate_data)): ?>
                        <div class="table-responsive">
                            <table id="affiliateLinksTable" class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th><?php echo site_phrase('course'); ?></th>
                                        <th><?php echo site_phrase('affiliate_link'); ?></th>
                                        <th><?php echo site_phrase('clicks'); ?></th>
                                        <th><?php echo site_phrase('conversions'); ?></th>
                                        <th><?php echo site_phrase('sales'); ?></th>
                                        <th><?php echo site_phrase('actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($affiliate_data as $affiliate): ?>
                                        <tr>
                                            <td><input type="checkbox" class="link-checkbox" value="<?php echo $affiliate['generated_url']; ?>"></td>
                                            <td><?php echo $affiliate['course_title']; ?></td>
                                            <td>
                                                <input type="text" class="form-control" value="<?php echo $affiliate['generated_url']; ?>" readonly>
                                            </td>
                                            <td><?php echo $affiliate['total_clicks']; ?></td>
                                            <td><?php echo $affiliate['total_conversions']; ?></td>
                                            <td><?php echo currency($affiliate['total_sales']); ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" onclick="navigator.clipboard.writeText('<?php echo $affiliate['generated_url']; ?>')">
                                                    <?php echo site_phrase('copy_link'); ?>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 text-center">
                            <button class="btn btn-success" id="shareSelectedLinks"><?php echo site_phrase('share_selected_links'); ?></button>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center"><?php echo site_phrase('no_affiliate_links_found'); ?></p>
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
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#affiliateLinksTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json"
                }
            });

            // Seleccionar/Deseleccionar todos los enlaces
            $('#selectAll').on('click', function() {
                $('.link-checkbox').prop('checked', this.checked);
            });

            // Compartir enlaces seleccionados
            $('#shareSelectedLinks').on('click', function() {
                const selectedLinks = [];
                $('.link-checkbox:checked').each(function() {
                    selectedLinks.push($(this).val());
                });

                if (selectedLinks.length > 0) {
                    const linksText = selectedLinks.join('\n');
                    navigator.clipboard.writeText(linksText).then(() => {
                        alert('<?php echo site_phrase('links_copied_to_clipboard'); ?>');
                    });
                } else {
                    alert('<?php echo site_phrase('no_links_selected'); ?>');
                }
            });
        });

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
