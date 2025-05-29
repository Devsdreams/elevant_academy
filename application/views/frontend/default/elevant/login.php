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

        <!-- Formulario Único -->
        <div id="login-form" class="login-form">
            <h1>LOGIN</h1>
            <p>Ingresa tus credenciales</p>
            <form action="<?php echo site_url('login/validate_login'); ?>" method="post" id="main-login-form">
                <input type="hidden" name="is_elevant_login" value="1">
                <input type="email" name="email" placeholder="Correo Electrónico" required id="email-input">
                <input type="password" name="password" placeholder="Contraseña" required>
                <?php if (get_frontend_settings('recaptcha_status')): ?>
                    <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                <?php endif; ?>
                <button type="submit">INICIAR SESIÓN</button>
            </form>
            <!-- <div id="role-message" style="margin-top:10px; color:#007bff; font-weight:bold;"></div> -->
            <div class="register" id="register-link">
                ¿No tienes cuenta? <a href="<?php echo site_url('elevant/register'); ?>">Regístrate</a>
            </div>
        </div>
    </div>

    <script>
        // Eliminar la clave multistep si existe al cargar la página de login
        if (localStorage.getItem('multistep')) {
            localStorage.removeItem('multistep');
        }

        // Guardar la clave `newElevant` en localStorage antes de enviar el formulario
        document.getElementById('main-login-form').addEventListener('submit', function () {
            localStorage.setItem('newElevant', 'true');
        });

        // Detectar el rol automáticamente al ingresar el correo
        document.getElementById('email-input').addEventListener('blur', function () {
            var email = this.value.trim();
            var roleMsg = document.getElementById('role-message');
            roleMsg.textContent = '';
            if (email.length > 3 && email.includes('@')) {
                fetch('<?php echo site_url('login/detect_role'); ?>', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: 'email=' + encodeURIComponent(email)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'ok') {
                        if (data.role === 'instructor') {
                            roleMsg.textContent = 'Rol detectado: Instructor';
                        } else if (data.role === 'user') {
                            roleMsg.textContent = 'Rol detectado: Usuario';
                        } else {
                            roleMsg.textContent = 'Rol no detectado';
                        }
                    } else {
                        roleMsg.textContent = 'Correo no registrado';
                    }
                })
                .catch(() => {
                    roleMsg.textContent = '';
                });
            }
        });
    </script>
</body>
</html>