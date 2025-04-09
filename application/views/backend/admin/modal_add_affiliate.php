<div class="modal-body">
    <form action="<?php echo site_url('admin/affiliates/add'); ?>" method="post">
        <div class="form-group">
            <label for="name"><?php echo get_phrase('full_name'); ?></label>
            <input type="text" class="form-control" id="name" name="name" required pattern="^[a-zA-Z\s]+$" title="<?php echo get_phrase('only_letters_and_spaces_allowed'); ?>">
        </div>
        <div class="form-group">
            <label for="email"><?php echo get_phrase('email'); ?></label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="payment_method"><?php echo get_phrase('payment_method'); ?></label>
            <input type="text" class="form-control" id="payment_method" name="payment_method" pattern="^[a-zA-Z\s]+$" title="<?php echo get_phrase('only_letters_and_spaces_allowed'); ?>">
        </div>
        <div class="form-group">
            <label for="payment_identifier"><?php echo get_phrase('payment_identifier'); ?></label>
            <input type="text" class="form-control" id="payment_identifier" name="payment_identifier" maxlength="255">
        </div>
        <div class="form-group">
            <label for="custom_commission"><?php echo get_phrase('custom_commission'); ?></label>
            <input type="number" step="0.01" class="form-control" id="custom_commission" name="custom_commission" min="0" max="100" title="<?php echo get_phrase('value_must_be_between_0_and_100'); ?>">
        </div>
        <button type="submit" class="btn btn-primary"><?php echo get_phrase('submit'); ?></button>
    </form>
</div>
