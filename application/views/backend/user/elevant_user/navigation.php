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
        :root {
            --primary: #000000;
            --secondary: #B59359;
            --tertiary: #ffffff;
        }
        .sidebar {
            width: 80px;
            background-color: var(--tertiary);
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
            transition: width 0.35s cubic-bezier(.77,0,.18,1), box-shadow 0.2s;
            overflow: hidden;
        }
        .sidebar.expanded {
            width: 222px; /* Antes 220px, ahora 2px más */
            box-shadow: 4px 0 18px #b5935915;
        }
        .sidebar .logo-btn-container {
            width: 40px;
            height: 40px;
            margin-bottom: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: width 0.35s, background 0.2s;
        }
        .sidebar .logo-btn-container .logo {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            transition: transform 0.25s, box-shadow 0.18s;
            box-shadow: none;
            z-index: 2;
        }
        .sidebar .logo-btn-container .expand-btn {
            display: none;
            position: absolute;
            left: 0; top: 0;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--tertiary);
            border: 2px solid var(--secondary);
            color: var(--secondary);
            font-size: 20px;
            font-weight: bold;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 3;
            transition: background 0.18s, color 0.18s, opacity 0.18s;
            opacity: 0;
        }
        .sidebar .logo-btn-container:hover .logo,
        .sidebar .logo-btn-container:focus-within .logo {
            transform: scale(0.92) rotate(-8deg);
            filter: blur(1px) brightness(0.95);
            box-shadow: 0 2px 12px #b5935955;
        }
        .sidebar .logo-btn-container:hover .expand-btn,
        .sidebar .logo-btn-container:focus-within .expand-btn {
            display: flex;
            opacity: 1;
            animation: fadeInScale 0.22s;
        }
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.7);}
            to { opacity: 1; transform: scale(1);}
        }
        .sidebar .expand-btn:hover {
            background: var(--secondary);
            color: var(--tertiary);
        }
        .sidebar .profile {
            width: 40px;
            height: 40px;
            background-color: var(--secondary);
            color: var(--tertiary);
            font-size: 20px;
            font-weight: bold;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 100px;
            transition: margin 0.35s;
        }
        .sidebar.expanded .profile {
            margin-bottom: 30px;
        }
        .sidebar .icon {
            width: 48px;
            height: 48px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            cursor: pointer;
            position: relative;
            color: var(--primary);
            font-size: 20px;
            transition: color 0.3s, background 0.3s, border-radius 0.3s, width 0.35s, height 0.35s;
            border-radius: 12px;
            background: transparent;
            border: 2px solid transparent; /* Por defecto sin borde visible */
        }
        .sidebar .icon,
        .sidebar .icon a,
        .sidebar .icon i {
            color: var(--primary) !important;
        }
        .sidebar .icon.active {
            /* Quitar el borde negro */
            background: rgba(181,147,89,0.18);
            border-radius: 12px;
            color: var(--secondary) !important;
        }
        .sidebar .icon.active a,
        .sidebar .icon.active i {
            color: var(--secondary) !important;
        }
        .sidebar.expanded .icon.active {
            border: 2px solid transparent !important;
        }
        .sidebar .icon.active a {
            color: var(--secondary);
        }
        .tooltip {
            display: none;
            position: absolute;
            left: 54px;
            background-color: var(--primary);
            color: var(--tertiary);
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 5px;
            white-space: nowrap;
            z-index: 10;
        }
        .tooltip::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -5px;
            transform: translateY(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: transparent var(--primary) transparent transparent;
        }
        .sidebar .icon:hover .tooltip {
            display: block;
        }
        /* Expanded sidebar styles */
        .sidebar.expanded .icon {
            width: 90%;
            height: 48px;
            border-radius: 10px;
            margin-left: 5%;
            justify-content: flex-start;
            padding-left: 12px;
            background: rgba(181,147,89,0.10); /* secundario muy suave */
            position: relative;
        }
        .sidebar.expanded .icon .icon-label {
            display: inline-block;
            margin-left: 18px;
            font-size: 1.05rem;
            color: var(--primary);
            font-weight: 500;
            letter-spacing: 0.2px;
            opacity: 1;
            transition: opacity 0.2s;
        }
        .sidebar .icon .icon-label {
            display: none;
            opacity: 0;
        }
        .sidebar.expanded .tooltip {
            display: none !important;
        }
        @media (max-width: 600px) {
            .sidebar, .sidebar.expanded { width: 60px; }
            .sidebar.expanded .icon .icon-label { display: none !important; }
        }
        /* Ajuste para la top-bar cuando sidebar expandida */
        .top-bar {
            left: 80px;
            transition: left 0.35s cubic-bezier(.77,0,.18,1);
        }
        .sidebar.expanded ~ .top-bar {
            left: 222px !important;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <!-- Logo + Expand Button -->
        <div class="logo-btn-container" tabindex="0">
            <img src="<?php echo base_url('uploads/elevant/elevant_icon.png'); ?>" alt="Logo" class="logo">
            <div class="expand-btn" id="expandBtn" title="Expandir menú">
                <i class="fas fa-angle-double-right" id="expandIcon"></i>
            </div>
        </div>
        <!-- Profile -->
        <div class="profile">
            <?php
            $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
            echo strtoupper(substr($user_details['first_name'], 0, 1));
            ?>
        </div>
        <!-- Icons -->
        <div class="icon <?php if (isset($active_page) && $active_page == 'elevant_user_home') echo 'active'; ?>">
            <a href="<?php echo site_url('user/elevant_user_home'); ?>">
                <i class="fas fa-home"></i>
                <span class="icon-label"><?php echo get_phrase('home'); ?></span>
                <span class="tooltip"><?php echo get_phrase('home'); ?></span>
            </a>
        </div>
        <div class="icon <?php if (isset($active_page) && ($active_page == 'courses' || $active_page == 'elevant_course_manager')) echo 'active'; ?>">
            <a href="<?php echo site_url('user/elevant/courses'); ?>">
                <i class="fas fa-chart-line"></i>
                <span class="icon-label"><?php echo get_phrase('courses'); ?></span>
                <span class="tooltip"><?php echo get_phrase('courses'); ?></span>
            </a>
        </div>
        <div class="icon">
            <a href="<?php echo site_url('user/community'); ?>">
                <i class="fas fa-users"></i>
                <span class="icon-label"><?php echo get_phrase('community'); ?></span>
                <span class="tooltip"><?php echo get_phrase('community'); ?></span>
            </a>
        </div>
        <div class="icon">
            <a href="<?php echo site_url('user/messages'); ?>">
                <i class="fas fa-envelope"></i>
                <span class="icon-label"><?php echo get_phrase('messages'); ?></span>
                <span class="tooltip"><?php echo get_phrase('messages'); ?></span>
            </a>
        </div>
        <div class="icon">
            <a href="<?php echo site_url('user/announcements'); ?>">
                <i class="fas fa-bullhorn"></i>
                <span class="icon-label"><?php echo get_phrase('announcements'); ?></span>
                <span class="tooltip"><?php echo get_phrase('announcements'); ?></span>
            </a>
        </div>
        <div class="icon">
            <a href="<?php echo site_url('user/settings'); ?>">
                <i class="fas fa-cog"></i>
                <span class="icon-label"><?php echo get_phrase('settings'); ?></span>
                <span class="tooltip"><?php echo get_phrase('settings'); ?></span>
            </a>
        </div>
        <div class="icon">
            <a href="<?php echo site_url('home/profile/user_profile'); ?>">
                <i class="fas fa-user"></i>
                <span class="icon-label"><?php echo get_phrase('profile'); ?></span>
                <span class="tooltip"><?php echo get_phrase('profile'); ?></span>
            </a>
        </div>
        <div class="icon">
            <a href="<?php echo site_url('user/payout_settings'); ?>">
                <i class="fas fa-wallet"></i>
                <span class="icon-label"><?php echo get_phrase('payout_settings'); ?></span>
                <span class="tooltip"><?php echo get_phrase('payout_settings'); ?></span>
            </a>
        </div>
    </div>
    <script>
        // Sidebar expand/collapse logic
        const sidebar = document.getElementById('sidebar');
        const expandBtn = document.getElementById('expandBtn');
        const expandIcon = document.getElementById('expandIcon');
        let expanded = false;

        function setSidebarState(state) {
            expanded = state;
            if (expanded) {
                sidebar.classList.add('expanded');
                expandIcon.classList.remove('fa-angle-double-right');
                expandIcon.classList.add('fa-angle-double-left');
                expandBtn.title = "Colapsar menú";
                // Ajustar top-bar si existe
                const topBar = document.querySelector('.top-bar');
                if (topBar) topBar.style.left = '222px';
            } else {
                sidebar.classList.remove('expanded');
                expandIcon.classList.remove('fa-angle-double-left');
                expandIcon.classList.add('fa-angle-double-right');
                expandBtn.title = "Expandir menú";
                // Ajustar top-bar si existe
                const topBar = document.querySelector('.top-bar');
                if (topBar) topBar.style.left = '80px';
            }
        }

        expandBtn.addEventListener('click', function(e) {
            setSidebarState(!expanded);
        });

        // Opcional: cerrar sidebar al hacer click fuera (solo si está expandida)
        document.addEventListener('click', function(e) {
            if (expanded && !sidebar.contains(e.target)) {
                setSidebarState(false);
            }
        });

        // Accesibilidad: expandir con teclado
        expandBtn.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                setSidebarState(!expanded);
            }
        });
    </script>
</body>
</html>