<!-- filepath: c:\xampp\htdocs\elevant_academy\application\views\frontend\default\sign_up_instructor.php -->
<?php if(get_frontend_settings('recaptcha_status')): ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<section class="category-course-list-area">
    <div class="container">
        <div class="row mb-5 mt-3">
            <div class="col-md-12 text-center">
                <h1 class="fw-700"><?php echo site_phrase('register_as_instructor'); ?></h1>
                <p class="text-14px"><?php echo site_phrase('sign_up_and_start_teaching'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block text-center">
                <img class="mt-5" width="80%" src="<?php echo base_url('uploads/system/sign_up.png'); ?>">
            </div>
            <div class="col-lg-6">
                <div class="sign-up-form">
                    <form action="<?php echo site_url('home/register_instructor'); ?>" method="post" id="register_instructor">
                        <div class="form-group">
                            <label for="first_name"><?php echo site_phrase('first_name'); ?></label>
                            <input type="text" name="first_name" class="form-control" placeholder="<?php echo site_phrase('first_name'); ?>" id="first_name" required>
                        </div>

                        <div class="form-group">
                            <label for="last_name"><?php echo site_phrase('last_name'); ?></label>
                            <input type="text" name="last_name" class="form-control" placeholder="<?php echo site_phrase('last_name'); ?>" id="last_name" required>
                        </div>

                        <div class="form-group">
                            <label for="email"><?php echo site_phrase('email'); ?></label>
                            <input type="email" name="email" class="form-control" placeholder="<?php echo site_phrase('email'); ?>" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password"><?php echo site_phrase('password'); ?></label>
                            <input type="password" name="password" class="form-control" placeholder="<?php echo site_phrase('password'); ?>" id="password" required>
                        </div>

                        <div class="form-group">
                            <label for="address"><?php echo site_phrase('address'); ?></label>
                            <input type="text" name="address" class="form-control" placeholder="<?php echo site_phrase('address'); ?>" id="address" required>
                        </div>

                        <div class="form-group">
                            <label for="phone"><?php echo site_phrase('phone'); ?></label>
                            <input type="text" name="phone" class="form-control" placeholder="<?php echo site_phrase('phone'); ?>" id="phone" required>
                        </div>

                        <div class="form-group">
                            <label for="message"><?php echo site_phrase('message'); ?></label>
                            <textarea name="message" class="form-control" placeholder="<?php echo site_phrase('message'); ?>" id="message" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn red radius-5 mt-4 w-100"><?php echo site_phrase('register'); ?></button>
                        </div>

                        <div class="form-group mt-4 mb-0 text-center">
                            <?php echo site_phrase('already_have_an_account'); ?>?
                            <a class="text-15px fw-700" href="<?php echo site_url('login') ?>"><?php echo site_phrase('login'); ?></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>