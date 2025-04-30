<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i class="mdi mdi-account-multiple-plus title_icon"></i> <?php echo get_phrase('register_affiliate_manually'); ?></h4>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('affiliate_registration_form'); ?></h4>
                <form class="required-form" action="<?php echo site_url('user/save_affiliate_manual'); ?>" method="post">
                    <input type="hidden" name="registered_manually" value="1">
                    <div id="progressbarwizard">
                        <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                            <li class="nav-item">
                                <a href="#basic_info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-face-profile mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('basic_info'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#payment_info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-currency-usd mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('payment_info'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#finish" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('finish'); ?></span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content b-0 mb-0">
                            <div id="bar" class="progress mb-3" style="height: 7px;">
                                <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                            </div>

                            <div class="tab-pane" id="basic_info">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="name"><?php echo get_phrase('full_name'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="name" name="name" required pattern="^[a-zA-Z\s]+$" title="<?php echo get_phrase('only_letters_and_spaces_allowed'); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="email"><?php echo get_phrase('email'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="course_id"><?php echo get_phrase('select_course'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="course_id" name="course_id" required>
                                                    <option value=""><?php echo get_phrase('select_a_course'); ?></option>
                                                    <?php foreach ($courses as $course): ?>
                                                        <option value="<?php echo $course['id']; ?>"><?php echo $course['title']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="payment_info">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="payment_method"><?php echo get_phrase('payment_method'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="payment_method" name="payment_method" required onchange="togglePaymentFields()">
                                                    <option value=""><?php echo get_phrase('select_payment_method'); ?></option>
                                                    <option value="paypal"><?php echo get_phrase('paypal'); ?></option>
                                                    <option value="bank"><?php echo get_phrase('bank_account'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="paypal_fields" style="display: none;">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="paypal_email"><?php echo get_phrase('paypal_email'); ?><span class="required">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="email" class="form-control" id="paypal_email" name="paypal_email">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="bank_fields" style="display: none;">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="bank_name"><?php echo get_phrase('bank_name'); ?><span class="required">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="bank_name" name="bank_name">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="account_number"><?php echo get_phrase('account_number'); ?><span class="required">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="account_number" name="account_number">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-3 col-form-label" for="swift_code"><?php echo get_phrase('swift_code'); ?></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="swift_code" name="swift_code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="custom_commission"><?php echo get_phrase('custom_commission'); ?></label>
                                            <div class="col-md-9">
                                                <input type="number" step="0.01" class="form-control" id="custom_commission" name="custom_commission" min="0" max="100" title="<?php echo get_phrase('value_must_be_between_0_and_100'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="finish">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                            <h3 class="mt-0"><?php echo get_phrase('thank_you'); ?>!</h3>
                                            <p class="w-75 mb-2 mx-auto"><?php echo get_phrase('you_are_just_one_click_away'); ?></p>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary"><?php echo get_phrase('submit'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-inline mb-0 wizard text-center">
                                <li class="previous list-inline-item">
                                    <a href="javascript:;" class="btn btn-info"> <i class="mdi mdi-arrow-left-bold"></i> </a>
                                </li>
                                <li class="next list-inline-item">
                                    <a href="javascript:;" class="btn btn-info"> <i class="mdi mdi-arrow-right-bold"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function togglePaymentFields() {
        const paymentMethod = document.getElementById('payment_method').value;
        document.getElementById('paypal_fields').style.display = paymentMethod === 'paypal' ? 'block' : 'none';
        document.getElementById('bank_fields').style.display = paymentMethod === 'bank' ? 'block' : 'none';
    }
</script>
