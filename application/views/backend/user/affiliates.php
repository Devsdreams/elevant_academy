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
                                                    <a class="dropdown-item" href="javascript:;" onclick="openEditAffiliateModal(<?php echo $affiliate['affiliate_id']; ?>);">
                                                        <?php echo get_phrase('edit'); ?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:;" onclick="approveAffiliate(<?php echo $affiliate['affiliate_id']; ?>);">
                                                        <?php echo get_phrase('approve'); ?>
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

<!-- Modal para editar afiliado -->
<div class="modal fade" id="editAffiliateModal" tabindex="-1" role="dialog" aria-labelledby="editAffiliateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editAffiliateModalLabel"><?php echo get_phrase('edit_affiliate'); ?></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editAffiliateForm">
                    <input type="hidden" name="affiliate_id" id="edit_affiliate_id">
                    <div class="form-group">
                        <label for="edit_full_name"><?php echo get_phrase('full_name'); ?></label>
                        <input type="text" class="form-control" id="edit_full_name" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_email"><?php echo get_phrase('email'); ?></label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_payment_method"><?php echo get_phrase('payment_method'); ?></label>
                        <select class="form-control" id="edit_payment_method" name="payment_method" onchange="toggleEditPaymentFields()" required>
                            <option value=""><?php echo get_phrase('select_payment_method'); ?></option>
                            <option value="paypal"><?php echo get_phrase('paypal'); ?></option>
                            <option value="bank"><?php echo get_phrase('bank_account'); ?></option>
                        </select>
                    </div>
                    <div id="edit_paypal_fields" style="display: none;">
                        <div class="form-group">
                            <label for="edit_paypal_email"><?php echo get_phrase('paypal_email'); ?></label>
                            <input type="email" class="form-control" id="edit_paypal_email" name="paypal_email">
                        </div>
                    </div>
                    <div id="edit_bank_fields" style="display: none;">
                        <div class="form-group">
                            <label for="edit_bank_name"><?php echo get_phrase('bank_name'); ?></label>
                            <input type="text" class="form-control" id="edit_bank_name" name="bank_name">
                        </div>
                        <div class="form-group">
                            <label for="edit_account_number"><?php echo get_phrase('account_number'); ?></label>
                            <input type="text" class="form-control" id="edit_account_number" name="account_number">
                        </div>
                        <div class="form-group">
                            <label for="edit_swift_code"><?php echo get_phrase('swift_code'); ?></label>
                            <input type="text" class="form-control" id="edit_swift_code" name="swift_code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_custom_commission"><?php echo get_phrase('custom_commission'); ?></label>
                        <input type="number" class="form-control" id="edit_custom_commission" name="custom_commission" min="0" max="100">
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" onclick="saveAffiliateChanges()">
                            <?php echo get_phrase('save_changes'); ?>
                        </button>
                    </div>
                </form>
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

    function trackClick(referralCode) {
        $.ajax({
            url: '<?php echo site_url('user/track_affiliate_click'); ?>',
            type: 'GET',
            data: { ref: referralCode },
            success: function() {
                alert('<?php echo get_phrase('click_registered_successfully'); ?>');
            },
            error: function() {
                alert('<?php echo get_phrase('error_registering_click'); ?>');
            }
        });
    }

    function toggleEditPaymentFields() {
        const paymentMethod = document.getElementById('edit_payment_method').value;
        document.getElementById('edit_paypal_fields').style.display = paymentMethod === 'paypal' ? 'block' : 'none';
        document.getElementById('edit_bank_fields').style.display = paymentMethod === 'bank' ? 'block' : 'none';
    }

    function openEditAffiliateModal(affiliateId) {
        $.ajax({
            url: '<?php echo site_url('user/get_affiliate_details'); ?>',
            type: 'POST',
            data: { affiliate_id: affiliateId },
            success: function(response) {
                try {
                    const affiliate = JSON.parse(response);
                    $('#edit_affiliate_id').val(affiliate.affiliate_id);
                    $('#edit_full_name').val(affiliate.full_name);
                    $('#edit_email').val(affiliate.email);
                    $('#edit_payment_method').val(affiliate.payment_method).change();
                    if (affiliate.payment_method === 'paypal') {
                        $('#edit_paypal_email').val(affiliate.payment_identifier.paypal_email);
                        $('#edit_paypal_fields').show();
                        $('#edit_bank_fields').hide();
                    } else if (affiliate.payment_method === 'bank') {
                        $('#edit_bank_name').val(affiliate.payment_identifier.bank_name);
                        $('#edit_account_number').val(affiliate.payment_identifier.account_number);
                        $('#edit_swift_code').val(affiliate.payment_identifier.swift_code);
                        $('#edit_bank_fields').show();
                        $('#edit_paypal_fields').hide();
                    } else {
                        $('#edit_paypal_fields').hide();
                        $('#edit_bank_fields').hide();
                    }
                    $('#edit_custom_commission').val(affiliate.custom_commission);
                    $('#editAffiliateModal').modal('show');
                } catch (error) {
                    alert('<?php echo get_phrase('error_parsing_affiliate_details'); ?>');
                }
            },
            error: function() {
                alert('<?php echo get_phrase('error_loading_affiliate_details'); ?>');
            }
        });
    }

    function saveAffiliateChanges() {
        const formData = $('#editAffiliateForm').serialize();
        $.ajax({
            url: '<?php echo site_url('user/update_affiliate'); ?>',
            type: 'POST',
            data: formData,
            success: function(response) {
                const result = JSON.parse(response);
                if (result.status === 'success') {
                    alert(result.message);
                    $('#editAffiliateModal').modal('hide'); // Cerrar el modal
                    location.reload(); // Recargar la página para reflejar los cambios
                } else {
                    alert(result.message);
                }
            },
            error: function() {
                alert('<?php echo get_phrase('an_error_occurred'); ?>');
            }
        });
    }

    function approveAffiliate(affiliateId) {
        if (confirm('<?php echo get_phrase('are_you_sure_you_want_to_approve_this_affiliate'); ?>')) {
            $.ajax({
                url: '<?php echo site_url('user/approve_affiliate'); ?>',
                type: 'POST',
                data: { affiliate_id: affiliateId },
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
                    alert('<?php echo get_phrase('an_error_occurred'); ?>');
                }
            });
        }
    }
</script>
