<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            width: 400px;
            text-align: center;
        }

        .login-container img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .login-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #ccc;
        }

        .login-tab {
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            color: #808080;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .login-tab.active {
            color: #000;
            border-bottom: 2px solid #000;
        }

        .login-container h1 {
            font-size: 24px;
            font-weight: bold;
            color: #808080;
            margin-bottom: 10px;
        }

        .login-container p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .login-container button {
            width: 60%;
            padding: 8px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            margin: 0 auto;
            display: block;
        }

        .login-container button:hover {
            background-color: #333;
        }

        .login-container .register {
            margin-top: 20px;
            font-size: 14px;
        }

        .login-container .register a {
            color: #000;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="<?php echo base_url('uploads/elevant/elevant_dark.png'); ?>" alt="Logo Elevant">

        <!-- Pestañas -->
        <div class="login-tabs">
            <div class="login-tab active" id="user-tab" onclick="showForm('user')">Login como Usuario</div>
            <div class="login-tab" id="instructor-tab" onclick="showForm('instructor')">Login como Instructor</div>
        </div>

        <!-- Formulario de Usuario -->
        <div id="user-form" class="login-form">
            <h1>LOGIN</h1>
            <p>Ingresa tus credenciales de usuario</p>
            <form action="<?php echo site_url('login/validate_login'); ?>" method="post">
                <input type="hidden" name="localStorageRef" value="user">
                <input type="hidden" name="is_elevant_login" value="1">
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <?php if (get_frontend_settings('recaptcha_status')): ?>
                    <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                <?php endif; ?>
                <button type="submit">INICIAR SESIÓN</button>
            </form>
            <div class="register">
                ¿No tienes cuenta? <a href="<?php echo site_url('elevant/register'); ?>">Regístrate</a>
            </div>
        </div>

        <!-- Formulario de Instructor -->
        <div id="instructor-form" class="login-form" style="display: none;">
            <h1>LOGIN</h1>
            <p>Ingresa tus credenciales de instructor</p>
            <form action="<?php echo site_url('login/validate_login'); ?>" method="post">
                <input type="hidden" name="localStorageRef" value="instructor">
                <input type="hidden" name="is_elevant_login" value="1">
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">INICIAR SESIÓN</button>
            </form>
            <div class="register">
                ¿No tienes cuenta? <a href="<?php echo site_url('elevant/register?instructor=1'); ?>">Regístrate como Instructor</a>
            </div>
        </div>
    </div>

    <script>
        function showForm(role) {
            document.getElementById('user-tab').classList.remove('active');
            document.getElementById('instructor-tab').classList.remove('active');
            document.getElementById('user-form').style.display = 'none';
            document.getElementById('instructor-form').style.display = 'none';

            if (role === 'user') {
                document.getElementById('user-tab').classList.add('active');
                document.getElementById('user-form').style.display = 'block';
            } else if (role === 'instructor') {
                document.getElementById('instructor-tab').classList.add('active');
                document.getElementById('instructor-form').style.display = 'block';
            }
        }

        // Guardar el tipo de usuario y la clave `newElevant` en localStorage antes de enviar el formulario
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function () {
                const userType = this.querySelector('input[name="localStorageRef"]').value;
                localStorage.setItem('login_user_type', userType);
                localStorage.setItem('newElevant', 'true'); // Guardar la clave `newElevant`
            });
        });
    </script>
</body>
</html>