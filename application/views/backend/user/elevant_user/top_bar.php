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
            background-color: #f9f9f9; /* Blanco hueso */
            position: fixed;
            top: 0;
            left: 80px; /* Espacio para la barra lateral */
            right: 0;
            z-index: 1000;
            box-shadow: none; /* Elimina la sombra para una integración visual */
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
            color: #bbb;
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
            background-color: #333;
        }

        .actions .profile {
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
            cursor: pointer;
        }
    </style>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            <button class="button" onclick="window.location.href='<?php echo site_url('home'); ?>'">Visit Website</button>
            <button class="button">Idioma</button>
            <div class="profile">
                <?php
                $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
                echo strtoupper(substr($user_details['first_name'], 0, 1));
                ?>
            </div>
        </div>
    </div>
</body>
</html>