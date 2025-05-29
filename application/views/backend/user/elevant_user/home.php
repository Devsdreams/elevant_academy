<?php $active_page = 'elevant_user_home'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($page_title) ? $page_title : 'Inicio Elevant'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome CDN para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Arial Rounded MT Bold", Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
        }
        .main-content {
            margin-left: 80px; /* Sidebar width */
            padding: 0;
            min-height: 100vh;
            background: #f5f5f5;
        }
        .content-wrapper {
            max-width: 1100px;
            margin: 90px auto 0 auto;
            padding: 32px 24px 24px 24px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px #b5935918;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #222;
            margin-bottom: 18px;
        }
        p {
            font-size: 1.15rem;
            color: #555;
        }
        /* Ajuste para la top-bar */
        .top-bar-space {
            height: 60px;
        }
        @media (max-width: 900px) {
            .main-content { margin-left: 0; }
            .content-wrapper { margin: 90px 8px 0 8px; }
        }
    </style>
</head>
<body>
    <?php
        // Sidebar
        include(APPPATH . 'views/backend/user/elevant_user/navigation.php');
        // Topbar
        include(APPPATH . 'views/backend/user/elevant_user/top_bar.php');
    ?>
    <div class="main-content">
        <div class="top-bar-space"></div>
        <div class="content-wrapper">
            <h1>Bienvenido al Home de Elevant User</h1>
            <p>Esta es la página de inicio personalizada para usuarios Elevant.</p>
            <!-- Puedes agregar aquí más contenido personalizado -->
        </div>
    </div>
</body>
</html>
