<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-account-multiple title_icon"></i> <?php echo get_phrase('manage_affiliates'); ?>
                    <a href="<?php echo site_url('user/affiliates_manual'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle">
                        <i class="mdi mdi-account-plus"></i> <?php echo get_phrase('add_affiliate'); ?>
                    </a>
                </h4>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title"><?php echo get_phrase('affiliates_list'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('full_name'); ?></th>
                                <th><?php echo get_phrase('email'); ?></th>
                                <th><?php echo get_phrase('course'); ?></th>
                                <th><?php echo get_phrase('affiliate_link'); ?></th>
                                <th><?php echo get_phrase('unique_code'); ?></th>
                                <th><?php echo get_phrase('status'); ?></th>
                                <th><?php echo get_phrase('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($affiliates as $key => $affiliate): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $affiliate['full_name']; ?></td>
                                    <td><?php echo $affiliate['email']; ?></td>
                                    <td><?php echo $affiliate['course_name'] ? $affiliate['course_name'] : get_phrase('no_course_assigned'); ?></td>
                                    <td>
                                        <?php 
                                        $link = $this->db->get_where('affiliate_link', ['affiliate_id' => $affiliate['affiliate_id']])->row_array();
                                        if ($link) {
                                            echo $link['referral_code'];
                                        } else {
                                            echo get_phrase('no_referral_code');
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $affiliate['unique_code']; ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo $affiliate['status'] == 'active' ? 'success' : 'warning'; ?>">
                                            <?php echo ucfirst($affiliate['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropright dropright">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="javascript:;" onclick="viewAffiliateLinks(<?php echo $affiliate['affiliate_id']; ?>);">
                                                        <?php echo get_phrase('show'); ?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:;" onclick="confirm_modal('<?php echo site_url('user/affiliates/delete/' . $affiliate['affiliate_id']); ?>');">
                                                        <?php echo get_phrase('delete'); ?>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div><!-- end col-->
</div>

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel"><?php echo get_phrase('confirm_action'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo get_phrase('are_you_sure_you_want_to_delete_this_affiliate'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo get_phrase('cancel'); ?></button>
                <a href="#" id="deleteLink" class="btn btn-danger"><?php echo get_phrase('delete'); ?></a>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver enlaces de afiliados -->
<div class="modal fade" id="viewAffiliateLinksModal" tabindex="-1" role="dialog" aria-labelledby="viewAffiliateLinksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewAffiliateLinksModalLabel"><?php echo get_phrase('affiliate_links'); ?></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="affiliateLinksContent" class="list-group">
                    <!-- Aquí se cargarán dinámicamente los enlaces de afiliados -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo get_phrase('close'); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
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

    function viewAffiliateLinks(affiliateId) {
        $.ajax({
            url: '<?php echo site_url('user/get_affiliate_links'); ?>',
            type: 'POST',
            data: { affiliate_id: affiliateId },
            success: function(response) {
                $('#affiliateLinksContent').html(response);
                $('#viewAffiliateLinksModal').modal('show');
            },
            error: function() {
                alert('<?php echo get_phrase('error_loading_affiliate_links'); ?>');
            }
        });
    }
</script>
