<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            position: fixed;
            top: 0;
            left: 80px;
            right: 0;
            z-index: 1000;
            box-shadow: none;
            transition: left 0.35s cubic-bezier(.77,0,.18,1);
        }
        /* Ajuste cuando sidebar expandida */
        .sidebar.expanded ~ .top-bar,
        .top-bar[style*="left: 220px"] {
            left: 220px !important;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            padding: 8px 15px;
            width: 50%;
        }

        .search-bar input {
            flex: 1;
            border: none;
            background: none;
            outline: none;
            font-size: 14px;
            color: #666;
        }

        .search-bar input::placeholder {
            color: #bbb;
        }

        .search-bar i {
            color: #B59359;
            margin-right: 10px;
            font-size: 16px;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .actions .button {
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .actions .button:hover {
            background-color: #B59359;
            color: #000;
        }

        .actions .profile {
            width: 40px;
            height: 40px;
            background-color: #B59359 !important;
            color: #fff !important;
            font-size: 20px;
            font-weight: bold;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .profile-dropdown {
            position: relative;
        }
        .profile-dropdown .dropdown-menu {
            display: none;
            position: absolute;
            top: 48px;
            right: 0;
            background: #fff;
            min-width: 200px;
            border-radius: 10px;
            box-shadow: 0 4px 18px #b5935915;
            z-index: 2000;
            font-size: 15px;
            text-align: left;
            transition: opacity 0.15s;
            opacity: 0;
            pointer-events: none;
        }
        .profile-dropdown.open .dropdown-menu,
        .profile-dropdown:focus-within .dropdown-menu {
            display: block;
            opacity: 1;
            pointer-events: auto;
        }
        .dropdown-item {
            color: #222;
            padding: 10px 18px;
            display: block;
            text-decoration: none;
            transition: background 0.15s;
        }
        .dropdown-item:hover {
            background: #f5f5f5;
        }
        .dropdown-divider {
            border-top: 1px solid #eee;
            margin: 0;
        }
    </style>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var profile = document.querySelector('.profile-dropdown');
            var dropdown = profile.querySelector('.dropdown-menu');
            var timeout;

            function openMenu() {
                clearTimeout(timeout);
                profile.classList.add('open');
            }
            function closeMenu() {
                timeout = setTimeout(function () {
                    profile.classList.remove('open');
                }, 180);
            }
            profile.addEventListener('mouseenter', openMenu);
            profile.addEventListener('mouseleave', closeMenu);
            dropdown.addEventListener('mouseenter', openMenu);
            dropdown.addEventListener('mouseleave', closeMenu);
            profile.addEventListener('focusin', openMenu);
            profile.addEventListener('focusout', closeMenu);
        });
    </script>
</head>
<body>
    <div class="top-bar">
        <!-- Search Bar -->
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Buscar por: página, curso, categoría, etc...">
        </div>

        <!-- Action Buttons -->
        <div class="actions">
            <button class="button" onclick="window.location.href='<?php echo site_url('elevant/home'); ?>'">Visit Website</button>
            <button class="button">Idioma</button>
            <div class="profile profile-dropdown" tabindex="0">
                <?php
                $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
                echo strtoupper(substr($user_details['first_name'], 0, 1));
                ?>
                <div class="dropdown-menu">
                    <div style="padding: 10px 18px; font-weight: bold; color: #222;">
                        <?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="fas fa-user"></i> Mi perfil</a>
                    <a href="#" class="dropdown-item"><i class="fas fa-cog"></i> Configuración</a>
                    <a href="#" class="dropdown-item"><i class="fas fa-bell"></i> Notificaciones</a>
                    <a href="#" class="dropdown-item"><i class="fas fa-question-circle"></i> Ayuda</a>
                    <div class="dropdown-divider"></div>
                    <a href="<?php echo site_url('elevant/login'); ?>" class="dropdown-item" style="color: #d42ad8;"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>