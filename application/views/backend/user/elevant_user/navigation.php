<?php
$status_wise_courses = $this->crud_model->get_status_wise_courses();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Sidebar styles */
        .sidebar {
            width: 80px;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            height: 100%;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
        }

        .sidebar img.logo {
            width: 40px;
            margin-bottom: 80px;
        }

        .sidebar .profile {
            width: 40px;
            height: 40px;
            background-color: #d42ad8;
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 100px;
        }

        .sidebar .icon {
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            cursor: pointer;
            position: relative;
            color: #000;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .sidebar .icon a {
            text-decoration: none;
            color: inherit;
        }

        .sidebar .icon.active {
            border: 2px solid rgb(0, 0, 0); /* Borde para el ícono activo */
            border-radius: 0%;
        }

        .tooltip {
            display: none;
            position: absolute;
            left: 50px;
            background-color: #000;
            color: #fff;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 5px;
            white-space: nowrap;
        }

        .tooltip::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -5px;
            transform: translateY(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: transparent #000 transparent transparent;
        }

        .sidebar .icon:hover .tooltip {
            display: block;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- Logo -->
        <img src="<?php echo base_url('uploads/elevant/elevant_icon.png'); ?>" alt="Logo" class="logo">

        <!-- Profile -->
        <div class="profile">
            <?php
            $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
            echo strtoupper(substr($user_details['first_name'], 0, 1));
            ?>
        </div>

        <!-- Icons -->
        <div class="icon">
            <a href="<?php echo site_url('user/dashboard'); ?>">
                <i class="fas fa-home"></i>
                <span class="tooltip"><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </div>
        <div class="icon <?php if ($active_page == 'courses' | $active_page == 'elevant_course_manager') echo 'active'; ?>">
            <a href="<?php echo site_url('user/elevant/courses'); ?>">
                <i class="fas fa-chart-line"></i>
                <span class="tooltip"><?php echo get_phrase('courses'); ?></span>
            </a>
        </div>
        <div class="icon">
            <a href="<?php echo site_url('user/community'); ?>">
                <i class="fas fa-users"></i>
                <span class="tooltip"><?php echo get_phrase('community'); ?></span>
            </a>
        </div>
        <div class="icon">
            <a href="<?php echo site_url('user/messages'); ?>">
                <i class="fas fa-envelope"></i>
                <span class="tooltip"><?php echo get_phrase('messages'); ?></span>
            </a>
        </div>
        <div class="icon">
            <a href="<?php echo site_url('user/announcements'); ?>">
                <i class="fas fa-bullhorn"></i>
                <span class="tooltip"><?php echo get_phrase('announcements'); ?></span>
            </a>
        </div>
        <div class="icon">
            <a href="<?php echo site_url('user/settings'); ?>">
                <i class="fas fa-cog"></i>
                <span class="tooltip"><?php echo get_phrase('settings'); ?></span>
            </a>
        </div>
        <div class="icon">
            <a href="<?php echo site_url('home/profile/user_profile'); ?>">
                <i class="fas fa-user"></i>
                <span class="tooltip"><?php echo get_phrase('profile'); ?></span>
            </a>
        </div>
        <div class="icon">
            <a href="<?php echo site_url('user/payout_settings'); ?>">
                <i class="fas fa-wallet"></i>
                <span class="tooltip"><?php echo get_phrase('payout_settings'); ?></span>
            </a>
        </div>
    </div>
</body>
</html>