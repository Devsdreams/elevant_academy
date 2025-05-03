<?php
$user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
$this->load->model('Affiliate_model');
$affiliate_data = $this->Affiliate_model->get_affiliate_dashboard_data($user_details['email']);

// Obtener el ID del afiliado
$affiliate_id = $affiliate_data[0]['affiliate_id'] ?? null;
// Consultar las columnas payment_method y payment_identifier directamente desde la base de datos
$payment_info = $this->db->select('payment_method, payment_identifier')
                         ->from('affiliate')
                         ->where('affiliate_id', $affiliate_id)
                         ->get()
                         ->row_array();

$payment_method = $payment_info['payment_method'] ?? null;
$payment_identifier = json_decode($payment_info['payment_identifier'] ?? '{}', true);

// Calcula métricas generales
$total_clicks = array_sum(array_column($affiliate_data, 'total_clicks'));
$total_conversions = array_sum(array_column($affiliate_data, 'total_conversions'));

// Ajustar total_sales para reflejar la comisión del afiliado
$total_sales = 0;
foreach ($affiliate_data as $affiliate) {
    $commission_percentage = $affiliate['custom_commission'] ?? 0; // Usar la comisión personalizada si está definida
    $total_sales += ($affiliate['total_sales'] * $commission_percentage) / 100;
}
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
    <?php if (empty($payment_method) || empty($payment_identifier)): ?>
        <section class="affiliate-update-area" style="background-color: #f7f8fa; padding: 50px 0;">
            <div class="container-xl">
                <div class="row mb-4">
                    <div class="col text-center">
                        <h4 class="mb-3"><?php echo site_phrase('update_affiliate_information'); ?></h4>
                        <p class="text-muted"><?php echo site_phrase('please_update_your_affiliate_payment_details_to_continue'); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form id="updateAffiliateForm">
                            <input type="hidden" name="affiliate_id" value="<?php echo $affiliate_data[0]['affiliate_id']; ?>">
                            <div class="form-group">
                                <label for="full_name"><?php echo site_phrase('full_name'); ?></label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $affiliate_data[0]['full_name']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo site_phrase('email'); ?></label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $affiliate_data[0]['email']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="payment_method"><?php echo site_phrase('payment_method'); ?></label>
                                <select class="form-control" id="payment_method" name="payment_method" onchange="togglePaymentFields()" required>
                                    <option value=""><?php echo site_phrase('select_payment_method'); ?></option>
                                    <option value="paypal" <?php echo $payment_method === 'paypal' ? 'selected' : ''; ?>><?php echo site_phrase('paypal'); ?></option>
                                    <option value="bank" <?php echo $payment_method === 'bank' ? 'selected' : ''; ?>><?php echo site_phrase('bank_account'); ?></option>
                                </select>
                            </div>
                            <div id="paypal_fields" style="display: <?php echo $payment_method === 'paypal' ? 'block' : 'none'; ?>;">
                                <div class="form-group">
                                    <label for="paypal_email"><?php echo site_phrase('paypal_email'); ?></label>
                                    <input type="email" class="form-control" id="paypal_email" name="paypal_email" value="<?php echo $payment_identifier['paypal_email'] ?? ''; ?>">
                                </div>
                            </div>
                            <div id="bank_fields" style="display: <?php echo $payment_method === 'bank' ? 'block' : 'none'; ?>;">
                                <div class="form-group">
                                    <label for="bank_name"><?php echo site_phrase('bank_name'); ?></label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php echo $payment_identifier['bank_name'] ?? ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="account_number"><?php echo site_phrase('account_number'); ?></label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" value="<?php echo $payment_identifier['account_number'] ?? ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="swift_code"><?php echo site_phrase('swift_code'); ?></label>
                                    <input type="text" class="form-control" id="swift_code" name="swift_code" value="<?php echo $payment_identifier['swift_code'] ?? ''; ?>">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" onclick="updateAffiliate()">
                                    <?php echo site_phrase('update'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
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
    <?php endif; ?>

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

        function togglePaymentFields() {
            const paymentMethod = document.getElementById('payment_method').value;
            document.getElementById('paypal_fields').style.display = paymentMethod === 'paypal' ? 'block' : 'none';
            document.getElementById('bank_fields').style.display = paymentMethod === 'bank' ? 'block' : 'none';
        }

        function savePaymentInfo() {
            const formData = $('#paymentInfoForm').serialize();
            $.ajax({
                url: '<?php echo site_url('home/save_payment_info'); ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert('<?php echo site_phrase('payment_information_saved_successfully'); ?>');
                    location.reload(); // Recargar la página para reflejar los cambios
                },
                error: function() {
                    alert('<?php echo site_phrase('an_error_occurred'); ?>');
                }
            });
        }

        function updatePaymentInfo() {
            const formData = $('#updatePaymentInfoForm').serialize();
            $.ajax({
                url: '<?php echo site_url('home/update_affiliate_profile_ajax'); ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert('<?php echo site_phrase('payment_information_updated_successfully'); ?>');
                        location.reload(); // Recargar la página para reflejar los cambios
                    } else {
                        alert(result.message || '<?php echo site_phrase('an_error_occurred'); ?>');
                    }
                },
                error: function() {
                    alert('<?php echo site_phrase('an_error_occurred'); ?>');
                }
            });
        }

        function updateAffiliateDirectly() {
            $.ajax({
                url: '<?php echo site_url('home/update_affiliate_directly'); ?>',
                type: 'GET',
                success: function(response) {
                    alert(response); // Mostrar el mensaje de éxito o error
                    location.reload(); // Recargar la página para reflejar los cambios
                },
                error: function() {
                    alert('<?php echo site_phrase('an_error_occurred'); ?>');
                }
            });
        }

        function updateAffiliate() {
            const formData = $('#updateAffiliateForm').serialize();
            $.ajax({
                url: '<?php echo site_url('home/update_affiliate'); ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                const result = JSON.parse(response);
                if (result.status === 'success') {
                    alert(result.message);
                    location.reload(); // Recargar la página para reflejar los cambios
                } else {
                    alert(result.message);
                }
            },
            error: function() {
                alert('<?php echo site_phrase('an_error_occurred'); ?>');
            }
        });
    }
    </script>
</body>
</html>
