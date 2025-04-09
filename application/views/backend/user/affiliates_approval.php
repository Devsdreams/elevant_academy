<script>
    function openCourseSelectionModal(affiliateId) {
        $('#affiliate_id').val(affiliateId); // Asignar el ID del afiliado al campo oculto
        $('#courseSelectionModal').modal('show'); // Mostrar el modal
    }
</script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title"><?php echo get_phrase('register_affiliates_for_approval'); ?></h4>
                <p><?php echo get_phrase('list_of_all_affiliates'); ?></p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('full_name'); ?></th>
                            <th><?php echo get_phrase('email'); ?></th>
                            <th><?php echo get_phrase('status'); ?></th>
                            <th><?php echo get_phrase('action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($affiliates as $affiliate): ?>
                            <tr>
                                <td><?php echo $affiliate['full_name']; ?></td>
                                <td><?php echo $affiliate['email']; ?></td>
                                <td><?php echo ucfirst($affiliate['status']); ?></td>
                                <td>
                                    <?php if ($affiliate['status'] == 'inactive'): ?>
                                        <button class="btn btn-success" onclick="openCourseSelectionModal(<?php echo $affiliate['affiliate_id']; ?>)">
                                            <?php echo get_phrase('approve'); ?>
                                        </button>
                                    <?php else: ?>
                                        <a href="<?php echo site_url('admin/reject_affiliate/' . $affiliate['affiliate_id']); ?>" class="btn btn-danger"><?php echo get_phrase('disapprove'); ?></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para seleccionar un curso -->
<div class="modal fade" id="courseSelectionModal" tabindex="-1" role="dialog" aria-labelledby="courseSelectionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="approveAffiliateForm" action="<?php echo site_url('admin/approve_affiliate_with_course'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="courseSelectionModalLabel"><?php echo get_phrase('select_course_for_affiliate'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="affiliate_id" id="affiliate_id">
                    <div class="form-group">
                        <label for="course_id"><?php echo get_phrase('select_course'); ?></label>
                        <select class="form-control select2" name="course_id" id="course_id" required>
                            <option value=""><?php echo get_phrase('select_a_course'); ?></option>
                            <?php foreach ($courses as $course): ?>
                                <option value="<?php echo $course['id']; ?>"><?php echo $course['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo get_phrase('cancel'); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo get_phrase('approve'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
