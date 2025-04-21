<?php
try {
    $instructor_id = $this->session->userdata('user_id');
    $number_of_affiliates = $this->db->count_all('affiliate'); // Ejemplo de consulta simple
} catch (Exception $e) {
    echo "Error en la consulta: " . $e->getMessage();
    $number_of_affiliates = 0; // Valor por defecto en caso de error
}

$number_of_affiliate_sales = 25;
$total_affiliate_earnings = 500.00;
$pending_affiliate_earnings = 150.00;
$months = array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december');
$translated_month = array(get_phrase('january'), get_phrase('february'), get_phrase('march'), get_phrase('april'), get_phrase('may'), get_phrase('june'), get_phrase('july'), get_phrase('august'), get_phrase('september'), get_phrase('october'), get_phrase('november'), get_phrase('december'));
$month_wise_affiliate_earnings = array_fill(0, 12, rand(50, 200)); // Datos ficticios para los gráficos
?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-network title_icon"></i> <?php echo get_phrase('manage_affiliates'); ?></h4>
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
                        <a href="javascript:void(0);" class="text-secondary">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                    <h3><span><?php echo $number_of_affiliates; ?></span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('number_of_affiliates'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <a href="javascript:void(0);" class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-cart text-muted" style="font-size: 24px;"></i>
                                    <h3><span><?php echo $number_of_affiliate_sales; ?></span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('affiliate_sales'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <a href="javascript:void(0);" class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-wallet text-muted" style="font-size: 24px;"></i>
                                    <h3><span><?php echo currency($total_affiliate_earnings); ?></span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('total_earnings'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <a href="javascript:void(0);" class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-clock text-muted" style="font-size: 24px;"></i>
                                    <h3><span><?php echo currency($pending_affiliate_earnings); ?></span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('pending_earnings'); ?></p>
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
                <h4 class="header-title"><?php echo get_phrase('manage_affiliates'); ?></h4>
                <button id="download-csv" class="btn btn-outline-primary btn-rounded mb-3">
                    <?php echo get_phrase('download_csv'); ?>
                </button>
                <button id="download-xlsx" class="btn btn-outline-success btn-rounded mb-3">
                    <?php echo get_phrase('download_xlsx'); ?>
                </button>
                <div class="table-responsive-sm mt-4">
                    <table id="manage-affiliates-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('full_name'); ?></th>
                                <th><?php echo get_phrase('email'); ?></th>
                                <th><?php echo get_phrase('course'); ?></th>
                                <th><?php echo get_phrase('affiliate_link'); ?></th>
                                <th><?php echo get_phrase('access_count'); ?></th>
                                <th><?php echo get_phrase('commission'); ?></th>
                                <th><?php echo get_phrase('status'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Consulta para obtener los afiliados, sus enlaces, cursos asociados y conteo de accesos
                            $this->db->select('a.affiliate_id, a.full_name, a.email, a.custom_commission, c.title as course_title, al.generated_url, COUNT(cl.click_id) as access_count, a.status');
                            $this->db->from('affiliate a');
                            $this->db->join('affiliate_link al', 'a.affiliate_id = al.affiliate_id', 'left');
                            $this->db->join('course c', 'al.course_id = c.id', 'left');
                            $this->db->join('click cl', 'al.link_id = cl.link_id', 'left');
                            $this->db->group_by(['a.affiliate_id', 'c.id']);
                            $affiliates = $this->db->get()->result_array();
                            
                            foreach ($affiliates as $key => $affiliate): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $affiliate['full_name']; ?></td>
                                    <td><?php echo $affiliate['email']; ?></td>
                                    <td><?php echo !empty($affiliate['course_title']) ? $affiliate['course_title'] : get_phrase('no_course_assigned'); ?></td>
                                    <td><?php echo !empty($affiliate['generated_url']) ? $affiliate['generated_url'] : get_phrase('no_link'); ?></td>
                                    <td><?php echo $affiliate['access_count']; ?></td>
                                    <td><?php echo currency($affiliate['custom_commission'] ?? 0); ?></td>
                                    <td><?php echo ucfirst($affiliate['status']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($affiliates)): ?>
                                <tr>
                                    <td colspan="8" class="text-center"><?php echo get_phrase('no_affiliates_found'); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div><!-- end col-->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    $(document).ready(function() {
        $('#manage-affiliates-datatable').DataTable({
            "language": {
                "url": "<?php echo base_url('assets/backend/js/datatables/' . $this->session->userdata('language') . '.json'); ?>"
            },
            "pageLength": 10,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        $('#download-csv').on('click', function() {
            const rows = [];
            const headers = [];
            $('#manage-affiliates-datatable thead tr th').each(function() {
                headers.push($(this).text().trim());
            });
            rows.push(headers);

            $('#manage-affiliates-datatable tbody tr').each(function() {
                const row = [];
                $(this).find('td').each(function() {
                    row.push($(this).text().trim());
                });
                rows.push(row);
            });

            let csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "affiliates.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });

        $('#download-xlsx').on('click', function() {
            const rows = [];
            const headers = [];
            $('#manage-affiliates-datatable thead tr th').each(function() {
                headers.push($(this).text().trim());
            });
            rows.push(headers);

            $('#manage-affiliates-datatable tbody tr').each(function() {
                const row = [];
                $(this).find('td').each(function() {
                    row.push($(this).text().trim());
                });
                rows.push(row);
            });

            const worksheet = XLSX.utils.aoa_to_sheet(rows);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Affiliates");
            XLSX.writeFile(workbook, "affiliates.xlsx");
        });
    });

    function confirm_modal(delete_url) {
        $('#deleteLink').attr('href', delete_url);
        $('#confirmModal').modal('show');
    }

    function copyToClipboard(text) {
        const tempInput = document.createElement('input');
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert('<?php echo get_phrase('link_copied_to_clipboard'); ?>');
    }
</script>
