<?php
$status_wise_courses = $this->crud_model->get_status_wise_courses();
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu left-side-menu-detached">
    <div class="leftbar-user">
        <a href="javascript: void(0);">
            <img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="user-image" height="42" class="rounded-circle shadow-sm">
            <?php
            $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
            ?>
            <span class="leftbar-user-name"><?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></span>
        </a>
    </div>

    <?php
    $instructor_id = $this->session->userdata('user_id');
    $number_of_courses = $this->crud_model->get_instructor_wise_courses($instructor_id)->num_rows();
    ?>

    <!--- Sidemenu -->
    <ul class="metismenu side-nav side-nav-light">

        <li class="side-nav-title side-nav-item"><?php echo get_phrase('navigation'); ?></li>
        <?php if (get_settings('allow_instructor') == 1) : ?>
            <?php if ($this->session->userdata('is_instructor')) : ?>
                <li class="side-nav-item">
                    <a href="<?php echo site_url('user/dashboard'); ?>" class="side-nav-link <?php if ($page_name == 'dashboard') echo 'active'; ?>">
                        <i class="dripicons-view-apps"></i>
                        <span><?php echo get_phrase('dashboard'); ?></span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="<?php echo site_url('user/courses'); ?>" class="side-nav-link <?php if ($page_name == 'courses' || $page_name == 'course_add' || $page_name == 'course_edit') echo 'active'; ?>">
                        <i class="dripicons-archive"></i>
                        <span>
                            <?php echo get_phrase('course_manager'); ?>
                            <?php if ($number_of_courses == 0 && !strpos(current_url(), 'user/courses') && !strpos(current_url(), 'course_form/add_course')): ?>
                                <span class="badge badge-primary ml-2" style="background-color: #727cf5; color: white;">¡Crea tu primer curso aquí!</span>
                            <?php endif; ?>
                        </span>
                    </a>
                </li>

                <!-- Payment Settings -->
                <li class="side-nav-item">
                    <a href="<?php echo site_url('user/payout_settings'); ?>" class="side-nav-link <?php if ($page_name == 'payment_settings') echo 'active'; ?>">
                        <i class="dripicons-gear"></i>
                        <span><?php echo get_phrase('payout_settings'); ?></span>
                    </a>
                </li>

                <!-- Reports Accordion -->
                <li class="side-nav-item">
                    <a href="javascript: void(0);" class="side-nav-link <?php echo $number_of_courses == 0 ? 'disabled-menu' : ''; ?>" <?php if ($number_of_courses == 0) echo 'data-tooltip="true" title="' . get_phrase('create_your_first_course_to_unlock_this_menu') . '"'; ?>>
                        <i class="dripicons-to-do"></i>
                        <span><?php echo get_phrase('reports'); ?></span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="side-nav-second-level" aria-expanded="false">
                        <li class="<?php if ($page_name == 'sales_report') echo 'active'; ?>">
                            <a href="<?php echo site_url('user/sales_report'); ?>"><?php echo get_phrase('sales_report'); ?></a>
                        </li>
                        <li class="<?php if ($page_name == 'payout_report') echo 'active'; ?>">
                            <a href="<?php echo site_url('user/payout_report'); ?>"><?php echo get_phrase('payout_report'); ?></a>
                        </li>
                    </ul>
                </li>

                <!-- Affiliates Accordion -->
                <li class="side-nav-item">
                    <a href="javascript: void(0);" class="side-nav-link <?php echo $number_of_courses == 0 ? 'disabled-menu' : ''; ?>" <?php if ($number_of_courses == 0) echo 'data-tooltip="true" title="' . get_phrase('create_your_first_course_to_unlock_this_menu') . '"'; ?>>
                        <i class="dripicons-network-1"></i>
                        <span><?php echo get_phrase('affiliates'); ?></span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="side-nav-second-level" aria-expanded="false">
                        <li class="<?php if ($page_name == 'affiliates') echo 'active'; ?>">
                            <a href="<?php echo site_url('user/affiliates'); ?>"><?php echo get_phrase('affiliates'); ?></a>
                        </li>
                        <li class="<?php if ($page_name == 'manage_affiliates') echo 'active'; ?>">
                            <a href="<?php echo site_url('user/manage_affiliates'); ?>"><?php echo get_phrase('manage_affiliates'); ?></a>
                        </li>
                    </ul>
                </li>

                <!-- Marketing Accordion -->
                <li class="side-nav-item">
                    <a href="javascript: void(0);" class="side-nav-link <?php echo $number_of_courses == 0 ? 'disabled-menu' : ''; ?>" <?php if ($number_of_courses == 0) echo 'data-tooltip="true" title="' . get_phrase('create_your_first_course_to_unlock_this_menu') . '"'; ?>>
                        <i class="mdi mdi-email"></i>
                        <span><?php echo get_phrase('marketing'); ?></span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="side-nav-second-level" aria-expanded="false">
                        <li class="<?php if ($page_name == 'campaigns') echo 'active'; ?>">
                            <a href="<?php echo site_url('user/campaigns'); ?>"><?php echo get_phrase('campaigns'); ?></a>
                        </li>
                        <li class="<?php if ($page_name == 'contact') echo 'active'; ?>">
                            <a href="<?php echo site_url('user/contact'); ?>"><?php echo get_phrase('contacts'); ?></a>
                        </li>
                        <li class="<?php if ($page_name == 'create_campaign') echo 'active'; ?>">
                            <a href="<?php echo site_url('user/create_campaign'); ?>"><?php echo get_phrase('create_campaign'); ?></a>
                        </li>
                        <li class="<?php if ($page_name == 'groups') echo 'active'; ?>">
                            <a href="<?php echo site_url('user/groups'); ?>"><?php echo get_phrase('create_contacts'); ?></a>
                        </li>
                        <li class="<?php if ($page_name == 'message') echo 'active'; ?>">
                            <a href="<?php echo site_url('home/my_messages'); ?>"><?php echo get_phrase('message'); ?></a>
                        </li>
                    </ul>
                </li>
            <?php else : ?>
                <li class="side-nav-item">
                    <a href="<?php echo site_url('user/become_an_instructor'); ?>" class="side-nav-link <?php if ($page_name == 'become_an_instructor') echo 'active'; ?>">
                        <i class="dripicons-archive"></i>
                        <span><?php echo get_phrase('become_an_instructor'); ?></span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>

        <li class="side-nav-item">
            <a href="<?php echo site_url('home/profile/user_profile'); ?>" class="side-nav-link">
                <i class="dripicons-user"></i>
                <span><?php echo get_phrase('manage_profile'); ?></span>
            </a>
        </li>
    </ul>
</div>

<style>
    /* Estilo para deshabilitar los menús */
    .disabled-menu {
        pointer-events: none;
        opacity: 0.6;
    }

    /* Tooltip para mostrar el mensaje */
    [data-tooltip="true"] {
        position: relative;
    }

    [data-tooltip="true"]::after {
        content: attr(title);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: #727cf5;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s, visibility 0.2s;
    }

    [data-tooltip="true"]:hover::after {
        opacity: 1;
        visibility: visible;
    }
</style>