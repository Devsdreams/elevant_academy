<?php if(get_frontend_settings('recaptcha_status')): ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<section class="category-course-list-area">
    <div class="container">
        <div class="row mb-5 mt-3">
            <div class="col-md-12 text-center">
                <h1 class="fw-700"><?php echo site_phrase('login'); ?></h1>
                <p class="text-14px"><?php echo site_phrase('choose_your_login_type'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block text-center">
                <img class="mt-4" width="60%" src="<?php echo base_url('uploads/system/sign_up.png'); ?>">
            </div>
            <div class="col-lg-6">
                <div class="sign-up-form">
                    <!-- Tabs for switching between User and Instructor -->
                    <ul class="nav nav-tabs" id="loginTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="user-tab" data-bs-toggle="tab" href="#user-login" role="tab" aria-controls="user-login" aria-selected="true">
                                <?php echo site_phrase('login_as_user'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="instructor-tab" data-bs-toggle="tab" href="#instructor-login" role="tab" aria-controls="instructor-login" aria-selected="false">
                                <?php echo site_phrase('login_as_instructor'); ?>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content mt-4" id="loginTabsContent">
                        <!-- User Login Form -->
                        <div class="tab-pane fade show active" id="user-login" role="tabpanel" aria-labelledby="user-tab">
                            <form action="<?php echo site_url('login/validate_login/user'); ?>" method="post" id="user_login_form">
                                <div class="form-group">
                                    <label for="user-email"><?php echo site_phrase('email'); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="email" class="form-control" placeholder="<?php echo site_phrase('email'); ?>" id="user-email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user-password"><?php echo site_phrase('password'); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="fas fa-key"></i></span>
                                        <input type="password" name="password" class="form-control" placeholder="<?php echo site_phrase('password'); ?>" id="user-password" required>
                                    </div>
                                    <a class="text-muted text-12px fw-500 float-end" href="<?php echo site_url('home/forgot_password'); ?>"><?php echo site_phrase('forgot_password'); ?>?</a>
                                </div>
                                <?php if(get_frontend_settings('recaptcha_status')): ?>
                                    <div class="form-group mt-4 mb-0">
                                        <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <button type="submit" class="btn red radius-5 mt-4 w-100"><?php echo site_phrase('login'); ?></button>
                                </div>
                            </form>

                            <div class="form-group mt-4 mb-0 text-center">
                        <?php echo site_phrase('do_not_have_an_account'); ?>?
                        <a class="text-15px fw-700" href="<?php echo site_url('sign_up') ?>"><?php echo site_phrase('sign_up'); ?></a>
                    </div>
                        </div>

                        <!-- Instructor Login Form -->
                        <div class="tab-pane fade" id="instructor-login" role="tabpanel" aria-labelledby="instructor-tab">
                            <form action="<?php echo site_url('login/validate_login'); ?>" method="post" id="instructor_login_form">
                                <input type="hidden" name="localStorageRef" id="localStorageRef">
                                <div class="form-group">
                                    <label for="instructor-email"><?php echo site_phrase('email'); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="email" class="form-control" placeholder="<?php echo site_phrase('email'); ?>" id="instructor-email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="instructor-password"><?php echo site_phrase('password'); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="fas fa-key"></i></span>
                                        <input type="password" name="password" class="form-control" placeholder="<?php echo site_phrase('password'); ?>" id="instructor-password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn red radius-5 mt-4 w-100"><?php echo site_phrase('login'); ?></button>
                                </div>
                            </form>
                            <div class="form-group mt-3 text-center">
                                <span><?php echo site_phrase('do_not_have_an_account'); ?>?</span>
                                <a class="text-15px fw-700" href="<?php echo site_url('sign_up_instructor'); ?>"><?php echo site_phrase('register_as_instructor'); ?></a>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Guardar el estado en localStorage al usar el formulario de instructor
    document.getElementById('instructor_login_form').addEventListener('submit', function () {
        localStorage.setItem('login_user_type', 'instructor');
        document.getElementById('localStorageRef').value = 'instructor';
    });

    // Guardar el estado en localStorage al usar el formulario de usuario
    document.getElementById('user_login_form').addEventListener('submit', function () {
        localStorage.setItem('login_user_type', 'user');
    });

    // Limpiar el estado de localStorage al cargar la página de inicio de sesión
    window.addEventListener('load', function () {
        if (window.location.pathname.includes('login')) {
            localStorage.removeItem('login_user_type');
        }
    });
</script>