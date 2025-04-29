<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3><?php echo get_phrase('campaigns'); ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table id="campaign-datatable" class="table table-striped dt-responsive nowrap" width="100%" data-page-length='25'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo get_phrase('campaign_name'); ?></th>
                                    <th><?php echo get_phrase('subject'); ?></th>
                                    <th><?php echo get_phrase('sender_email'); ?></th>
                                    <th><?php echo get_phrase('created_at'); ?></th>
                                    <th><?php echo get_phrase('actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter = 1; ?>
                                <?php foreach ($campaigns as $campaign): ?>
                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td><?php echo htmlspecialchars($campaign['name']); ?></td>
                                        <td><?php echo htmlspecialchars($campaign['subject']); ?></td>
                                        <td><?php echo htmlspecialchars($campaign['sender_email']); ?></td>
                                        <td><?php echo htmlspecialchars($campaign['created_at']); ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm view-campaign" 
                                                data-name="<?php echo htmlspecialchars($campaign['name']); ?>" 
                                                data-subject="<?php echo htmlspecialchars($campaign['subject']); ?>" 
                                                data-sender_email="<?php echo htmlspecialchars($campaign['sender_email']); ?>" 
                                                data-created_at="<?php echo htmlspecialchars($campaign['created_at']); ?>" 
                                                data-group_id="<?php echo htmlspecialchars($campaign['group_id'] ?? 'N/A'); ?>" 
                                                data-user_email="<?php echo htmlspecialchars($campaign['user_email'] ?? 'N/A'); ?>" 
                                                data-template="<?php echo htmlspecialchars($campaign['template']); ?>" 
                                                data-template_data='<?php echo htmlspecialchars($campaign['template_data'] ?? '{}'); ?>'>
                                                <?php echo get_phrase('view'); ?>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para mostrar detalles de la campaña -->
<div class="modal fade" id="campaignDetailsModal" tabindex="-1" role="dialog" aria-labelledby="campaignDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document"> <!-- Cambiado a modal-md para hacerlo más pequeño -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="campaignDetailsModalLabel"><?php echo get_phrase('campaign_details'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-striped">
                    <tbody>
                        <tr>
                            <th><?php echo get_phrase('campaign_name'); ?></th>
                            <td id="campaignName"></td>
                        </tr>
                        <tr>
                            <th><?php echo get_phrase('subject'); ?></th>
                            <td id="campaignSubject"></td>
                        </tr>
                        <tr>
                            <th><?php echo get_phrase('sender_email'); ?></th>
                            <td id="campaignSenderEmail"></td>
                        </tr>
                        <tr>
                            <th><?php echo get_phrase('schedule_date'); ?></th>
                            <td id="campaignScheduleDate"></td>
                        </tr>
                        <tr>
                            <th><?php echo get_phrase('created_at'); ?></th>
                            <td id="campaignCreatedAt"></td>
                        </tr>
                        <tr>
                            <th><?php echo get_phrase('group_id'); ?></th>
                            <td id="campaignGroupId"></td>
                        </tr>
                        <tr>
                            <th><?php echo get_phrase('user_email'); ?></th>
                            <td id="campaignUserEmail"></td>
                        </tr>
                        <tr>
                            <th><?php echo get_phrase('template'); ?></th>
                            <td id="campaignTemplate"></td>
                        </tr>
                    </tbody>
                </table>
                <h6 class="mt-3"><?php echo get_phrase('template_data'); ?>:</h6>
                <table class="table table-sm table-bordered">
                    <tbody id="templateDataTable">
                        <!-- Los datos de template_data se llenarán dinámicamente aquí -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?php echo get_phrase('close'); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#campaign-datatable').DataTable({
            pageLength: 10, // Cambiar a 10 registros por página
            lengthChange: true,
            searching: true,
            ordering: true,
            order: [[4, 'desc']], // Ordenar por la columna "created_at" en orden descendente
            info: true,
            responsive: true
        });

        // Mostrar detalles de la campaña en el modal
        $('.view-campaign').on('click', function () {
            $('#campaignName').text($(this).data('name'));
            $('#campaignSubject').text($(this).data('subject'));
            $('#campaignSenderEmail').text($(this).data('sender_email'));
            $('#campaignScheduleDate').text($(this).data('schedule_date'));
            $('#campaignCreatedAt').text($(this).data('created_at'));
            $('#campaignGroupId').text($(this).data('group_id'));
            $('#campaignUserEmail').text($(this).data('user_email'));
            $('#campaignTemplate').text($(this).data('template'));

            // Parsear y mostrar template_data en una tabla
            const templateData = $(this).data('template_data');
            const tableBody = $('#templateDataTable');
            tableBody.empty(); // Limpiar la tabla antes de llenarla

            if (templateData) {
                try {
                    const parsedData = typeof templateData === 'object' ? templateData : JSON.parse(templateData);
                    for (const [key, value] of Object.entries(parsedData)) {
                        tableBody.append(`
                            <tr>
                                <th>${key}</th>
                                <td>${value}</td>
                            </tr>
                        `);
                    }
                } catch (e) {
                    console.warn('Error parsing template data. Displaying raw data:', e.message);
                    tableBody.append(`
                        <tr>
                            <td colspan="2"><?php echo get_phrase("invalid_template_data"); ?></td>
                        </tr>
                    `);
                }
            } else {
                tableBody.append(`
                    <tr>
                        <td colspan="2"><?php echo get_phrase("no_template_data_available"); ?></td>
                    </tr>
                `);
            }

            $('#campaignDetailsModal').modal('show');
        });
    });
</script>
