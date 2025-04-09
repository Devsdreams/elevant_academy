<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-account-multiple title_icon"></i> <?php echo get_phrase('manage_affiliates'); ?>
                    <a href="<?php echo site_url('admin/affiliates_manual'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle">
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
                                            echo '<button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard(\'' . $link['generated_url'] . '\')">' . get_phrase('copy_link') . '</button>';
                                        } else {
                                            echo get_phrase('no_link');
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
                                                <?php if ($affiliate['status'] == 'inactive'): ?>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo site_url('admin/approve_affiliate/' . $affiliate['affiliate_id']); ?>">
                                                            <?php echo get_phrase('approve'); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if ($affiliate['status'] == 'active'): ?>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo site_url('admin/reject_affiliate/' . $affiliate['affiliate_id']); ?>">
                                                            <?php echo get_phrase('disapprove'); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:;" onclick="confirm_modal('<?php echo site_url('admin/affiliates/delete/' . $affiliate['affiliate_id']); ?>');">
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
</script>
