<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3><?php echo get_phrase('contacts'); ?></h3>
        </div>
        <div class="col-md-6 text-right">
            <!-- Botón Crear Campaña -->
            <a href="<?php echo site_url('user/create_campaign'); ?>" class="btn btn-primary">
                <?php echo get_phrase('create_campaign'); ?>
            </a>
            <!-- Botón Crear Grupo -->
            <a href="<?php echo site_url('user/groups'); ?>" class="btn btn-success">
                <?php echo get_phrase('create_group'); ?>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="group_filter"><?php echo get_phrase('filter_by_group'); ?></label>
                                <select id="group_filter" class="form-control">
                                    <option value=""><?php echo get_phrase('all_groups'); ?></option>
                                    <?php foreach ($groups as $group): ?>
                                        <option value="<?php echo htmlspecialchars($group['name']); ?>"><?php echo htmlspecialchars($group['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <!-- Botón para cambiar grupo -->
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="openChangeGroupModal">
                            <?php echo get_phrase('change_group'); ?>
                        </button>
                    </div>
                    <div class="table-responsive-sm">
                        <table id="contact-datatable" class="table table-striped dt-responsive nowrap" width="100%" data-page-length='25'>
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select_all_contacts"></th>
                                    <th><?php echo get_phrase('group_name'); ?></th>
                                    <th><?php echo get_phrase('name'); ?></th>
                                    <th><?php echo get_phrase('email'); ?></th>
                                    <th><?php echo get_phrase('number'); ?></th>
                                    <th><?php echo get_phrase('company'); ?></th>
                                    <th><?php echo get_phrase('actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter = 1; ?>
                                <?php foreach ($groups as $group): ?>
                                    <?php 
                                    $mails = json_decode($group['mails'], true);
                                    if (!empty($mails)):
                                        foreach ($mails as $mail): ?>
                                            <tr data-group="<?php echo htmlspecialchars($group['name']); ?>">
                                                <td><input type="checkbox" class="select-contact" data-email="<?php echo htmlspecialchars($mail['email']); ?>"></td>
                                                <td><?php echo htmlspecialchars($group['name']); ?></td>
                                                <td><?php echo htmlspecialchars($mail['name']); ?></td>
                                                <td><?php echo htmlspecialchars($mail['email']); ?></td>
                                                <td><?php echo htmlspecialchars($mail['number']); ?></td>
                                                <td><?php echo htmlspecialchars($mail['company']); ?></td>
                                                <td>
                                                    <div class="dropright dropright">
                                                        <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item edit-contact" href="javascript:;" 
                                                                   data-name="<?php echo htmlspecialchars($mail['name']); ?>" 
                                                                   data-email="<?php echo htmlspecialchars($mail['email']); ?>" 
                                                                   data-number="<?php echo htmlspecialchars($mail['number']); ?>" 
                                                                   data-company="<?php echo htmlspecialchars($mail['company']); ?>">
                                                                    <?php echo get_phrase('edit'); ?>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item delete-contact" href="javascript:;" data-email="<?php echo htmlspecialchars($mail['email']); ?>">
                                                                    <?php echo get_phrase('delete'); ?>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center"><?php echo get_phrase('no_contacts_found_in_group'); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar contacto -->
<div class="modal fade" id="editContactModal" tabindex="-1" role="dialog" aria-labelledby="editContactModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContactModalLabel"><?php echo get_phrase('edit_contact'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editContactForm">
                    <div class="form-group">
                        <label for="edit_name"><?php echo get_phrase('name'); ?></label>
                        <input type="text" class="form-control" id="edit_name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="edit_email"><?php echo get_phrase('email'); ?></label>
                        <input type="email" class="form-control" id="edit_email" name="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_number"><?php echo get_phrase('number'); ?></label>
                        <input type="text" class="form-control" id="edit_number" name="number">
                    </div>
                    <div class="form-group">
                        <label for="edit_company"><?php echo get_phrase('company'); ?></label>
                        <input type="text" class="form-control" id="edit_company" name="company">
                    </div>
                    <div class="form-group">
                        <label for="edit_group"><?php echo get_phrase('group'); ?></label>
                        <select id="edit_group" name="group" class="form-control">
                            <option value=""><?php echo get_phrase('select_group'); ?></option>
                            <?php foreach ($groups as $group): ?>
                                <option value="<?php echo htmlspecialchars($group['name']); ?>"><?php echo htmlspecialchars($group['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" id="saveContactChanges"><?php echo get_phrase('save_changes'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para cambiar grupo -->
<div class="modal fade" id="changeGroupModal" tabindex="-1" role="dialog" aria-labelledby="changeGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeGroupModalLabel"><?php echo get_phrase('change_group'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="changeGroupForm">
                    <div class="form-group">
                        <label for="target_group"><?php echo get_phrase('select_group'); ?></label>
                        <select id="target_group" class="form-control" name="group">
                            <option value=""><?php echo get_phrase('select_group'); ?></option>
                            <?php foreach ($groups as $group): ?>
                                <option value="<?php echo htmlspecialchars($group['name']); ?>"><?php echo htmlspecialchars($group['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo get_phrase('close'); ?></button>
                <button type="button" class="btn btn-primary" id="saveGroupChange"><?php echo get_phrase('save_changes'); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Inicializar DataTable con paginación de 10 registros por página
        const table = $('#contact-datatable').DataTable({
            pageLength: 10,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true
        });

        // Filtro por nombre de grupo
        $('#group_filter').on('change', function () {
            const groupName = $(this).val();
            if (groupName) {
                table.columns(1).search(groupName).draw();
            } else {
                table.columns(1).search('').draw();
            }
        });

        // Abrir modal para editar contacto
        $('.edit-contact').on('click', function () {
            const name = $(this).data('name');
            const email = $(this).data('email');
            const number = $(this).data('number');
            const company = $(this).data('company');
            const group = $(this).closest('tr').data('group');

            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_number').val(number);
            $('#edit_company').val(company);
            $('#edit_group').val(group);

            $('#editContactModal').modal('show');
        });

        // Guardar cambios del contacto
        $('#saveContactChanges').on('click', function () {
            const email = $('#edit_email').val();
            const name = $('#edit_name').val();
            const number = $('#edit_number').val();
            const company = $('#edit_company').val();
            const group = $('#edit_group').val();

            $.ajax({
                url: '<?php echo site_url('user/update_contact'); ?>',
                method: 'POST',
                data: { email, name, number, company, group },
                success: function (response) {
                    alert('<?php echo get_phrase('contact_updated_successfully'); ?>');
                    location.reload();
                },
                error: function () {
                    alert('<?php echo get_phrase('error_updating_contact'); ?>');
                }
            });
        });

        // Seleccionar todos los contactos
        $('#select_all_contacts').on('change', function () {
            $('.select-contact').prop('checked', $(this).prop('checked'));
        });

        // Abrir modal para cambiar grupo
        $('#openChangeGroupModal').on('click', function () {
            $('#changeGroupModal').modal('show');
        });

        // Guardar cambios de grupo
        $('#saveGroupChange').on('click', function () {
            const selectedContacts = [];
            $('.select-contact:checked').each(function () {
                selectedContacts.push($(this).data('email'));
            });

            const group = $('#target_group').val();

            if (selectedContacts.length > 0 && group) {
                $.ajax({
                    url: '<?php echo site_url('user/update_contact_group'); ?>',
                    method: 'POST',
                    data: { contacts: selectedContacts, group },
                    success: function (response) {
                        alert('<?php echo get_phrase('group_updated_successfully'); ?>');
                        location.reload();
                    },
                    error: function () {
                        alert('<?php echo get_phrase('error_updating_group'); ?>');
                    }
                });
            } else {
                alert('<?php echo get_phrase('please_select_contacts_and_group'); ?>');
            }
        });
    });
</script>