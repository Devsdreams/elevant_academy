<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #fff; /* Fondo blanco */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            width: 400px;
            padding: 40px;
            background-color: #fff;
            text-align: center;
        }

        .register-container img {
            max-width: 100%;
            margin-bottom: 20px;
        }

        .register-container h1 {
            font-size: 24px;
            font-weight: bold;
            color: #808080; /* Gris */
            margin-bottom: 10px;
        }

        .register-container p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .register-container input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
        }

        .register-container button {
            width: 60%; /* Botón más pequeño */
            padding: 8px; /* Padding reducido */
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            margin: 0 auto; /* Centrado */
            display: block; /* Requerido para centrar */
        }

        .register-container button:hover {
            background-color: #333;
        }

        .register-container .login-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .register-container .login-link a {
            color: #000;
            font-weight: bold;
            text-decoration: none;
        }

        .register-container .resend {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
            text-decoration: underline;
            cursor: pointer;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <img src="<?php echo base_url('uploads/elevant/elevant_dark.png'); ?>" alt="Logo Elevant">
        
        <!-- Paso 1: Solicitar código -->
        <div id="request-code-step">
            <h1>Register</h1>
            <p>Permítenos saber más de ti, por eso necesitamos validar si eres tú...</p>
            <form id="request-code-form" action="<?php echo site_url('login/send_verification_code'); ?>" method="post" onsubmit="showValidationStep(event)">
                <input type="text" name="email" placeholder="Ingresa tu correo o número celular" required>
                <button type="submit">Enviar código</button>
            </form>
            <div class="login-link">
                ¿Ya tienes cuenta registrada? <a href="<?php echo site_url('elevant/login'); ?>">Inicia sesión</a>
            </div>
        </div>

        <!-- Paso 2: Validar código -->
        <div id="validate-code-step" class="hidden">
            <h1>Register</h1>
            <p>
                Te enviamos un código al correo <strong id="email-display"></strong>, <br>
                revisa spam ya que hay correos que llegan a esa bandeja.
            </p>
            <form id="validate-code-form" action="<?php echo site_url('login/validate_verification_code'); ?>" method="post" onsubmit="validateCode(event)">
                <input type="hidden" name="email" id="email-field">
                <input type="text" name="verification_code" placeholder="Ingresa el pin que te enviamos" required>
                <p style="font-size: 12px; color: #666;">60 seg. para renovar el código...</p>
                <button type="submit">Confirmar</button>
            </form>
            <div class="resend" onclick="resendCode()">Reenviar código</div>
        </div>
    </div>

    <script>
        function showValidationStep(event) {
            event.preventDefault(); // Evita el envío del formulario
            const form = event.target;
            const formData = new FormData(form);

            // Enviar la solicitud al servidor
            fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.redirect) {
                        // Redirigir al registro multi-step si es necesario
                        window.location.href = data.redirect;
                    } else {
                        // Mostrar el paso de validación
                        document.getElementById('request-code-step').classList.add('hidden');
                        document.getElementById('validate-code-step').classList.remove('hidden');
                        document.getElementById('email-display').textContent = data.email;
                        document.getElementById('email-field').value = data.email;
                    }
                } else {
                    alert(data.message || 'Error al enviar el código. Inténtalo de nuevo.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al enviar el código. Inténtalo de nuevo.');
            });
        }

        function validateCode(event) {
            event.preventDefault(); // Evita el envío del formulario
            const form = event.target;
            const formData = new FormData(form);

            // Enviar la solicitud al servidor
            fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirigir al multi-step register
                    window.location.href = data.redirect;
                } else {
                    alert(data.message || 'Error al validar el código. Inténtalo de nuevo.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al validar el código. Inténtalo de nuevo.');
            });
        }

        function resendCode() {
            alert('Se ha reenviado el código al correo proporcionado.');
            // Aquí puedes implementar la lógica para reenviar el código
        }
    </script>
</body>
</html>