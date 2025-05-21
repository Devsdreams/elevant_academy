<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
            margin-bottom: 20px;
        }

        .register-container p {
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }

        .register-container input[type="text"],
        .register-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            background-color: #f9f9f9;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .register-container input[type="text"]:focus,
        .register-container input[type="password"]:focus {
            border-color: #000;
            background-color: #fff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        .register-container button.next-button {
            width: 60%;
            padding: 10px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .register-container button.next-button:hover {
            background-color: #333;
        }

        .option-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        .option-buttons button {
            width: 100%;
            padding: 12px;
            background-color: #fff;
            border: 1px solid #000;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            color: #000;
            cursor: pointer;
        }

        .option-buttons button:hover {
            background-color: #000;
            color: #fff;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .back-button {
            display: flex;
            align-items: center;
            justify-content: start;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .back-button span {
            font-size: 16px;
            font-weight: bold;
            color: #000;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">

        <!-- Paso 1: Seleccionar opción -->
        <div id="step1" class="step active">
            <img src="<?php echo base_url('uploads/elevant/elevant_dark.png'); ?>" alt="Logo Elevant">
            <h1>Registro</h1>
            <p>En qué te quieres enfocar</p>
            <div class="option-buttons">
                <button type="button" onclick="selectOption('Estudiante')">Estudiante</button>
                <button type="button" onclick="selectOption('Instructor')">Instructor</button>
                <button type="button" onclick="selectOption('Afiliado')">Afiliado</button>
            </div>
            <button class="next-button" onclick="nextStep()">Siguiente</button>
        </div>

        <!-- Paso 2: Preguntar nombre y apellido -->
        <div id="step2" class="step">
            <div class="back-button" onclick="previousStep()">
                <span>&larr; Atrás</span>
            </div>
            <img src="<?php echo base_url('uploads/elevant/elevant_dark.png'); ?>" alt="Logo Elevant">
            <h1>Queremos saber más de ti, <br> ¿Cómo te llamas?</h1>
            <p>Queremos saber más sobre ti</p>
            <form>
                <input type="text" id="first_name" placeholder="Escribe tu primer nombre..." required>
                <input type="text" id="last_name" placeholder="Escribe tu apellido..." required>
                <button class="next-button" type="button" onclick="nextStep()">Siguiente</button>
            </form>
        </div>

        <!-- Paso 3: Preguntar número de celular -->
        <div id="step3" class="step">
            <div class="back-button" onclick="previousStep()">
                <span>&larr; Atrás</span>
            </div>
            <img src="<?php echo base_url('uploads/elevant/elevant_dark.png'); ?>" alt="Logo Elevant">
            <h1>Eres importante para nosotros y queremos saber, <br> ¿Cuál es tu número de celular?</h1>
            <p>No escribas comas, ni caracteres especiales.</p>
            <form>
                <input type="text" id="phone_number" placeholder="Escribe número de celular" required>
                <button class="next-button" type="button" onclick="nextStep()">Siguiente</button>
            </form>
        </div>

        <!-- Paso 4: Crear contraseña -->
        <div id="step4" class="step">
            <div class="back-button" onclick="previousStep()">
                <span>&larr; Atrás</span>
            </div>
            <img src="<?php echo base_url('uploads/elevant/elevant_dark.png'); ?>" alt="Logo Elevant">
            <h1>¡Crea tu contraseña!</h1>
            <p>Verifica tu información y crea una contraseña segura.</p>
            <form id="final-form" action="<?php echo site_url('login/register_user'); ?>" method="post">
                <input type="hidden" name="role" id="role">
                
                <!-- Información recopilada del usuario -->
                <input type="text" name="first_name" id="final_first_name" placeholder="Primer nombre" readonly>
                <input type="text" name="last_name" id="final_last_name" placeholder="Apellido" readonly>
                <input type="text" name="phone_number" id="final_phone_number" placeholder="Número de celular" readonly>
                <input type="text" name="email" id="final_email" placeholder="Correo electrónico" readonly>
                
                <!-- Campos para la contraseña -->
                <input type="password" name="password" placeholder="Crea una contraseña" required>
                <input type="password" name="confirm_password" placeholder="Confirma tu contraseña" required>
                
                <button class="next-button" type="submit">Finalizar</button>
            </form>
        </div>

    </div>

    <script>
        let currentStep = 1;
        let selectedOption = '';

        function selectOption(option) {
            selectedOption = option;
            document.getElementById('role').value = option;
            const buttons = document.querySelectorAll('.option-buttons button');
            buttons.forEach(btn => {
                btn.style.backgroundColor = '#fff';
                btn.style.color = '#000';
            });

            const selectedButton = Array.from(buttons).find(
                btn => btn.textContent === option
            );
            if (selectedButton) {
                selectedButton.style.backgroundColor = '#000';
                selectedButton.style.color = '#fff';
            }
        }

        function nextStep() {
            if (currentStep === 1 && !selectedOption) {
                alert('Por favor elige una opción antes de continuar.');
                return;
            }

            if (currentStep === 2) {
                const firstName = document.getElementById('first_name').value;
                const lastName = document.getElementById('last_name').value;
                if (!firstName || !lastName) {
                    alert('Por favor ingresa tu nombre y apellido.');
                    return;
                }
                document.getElementById('final_first_name').value = firstName;
                document.getElementById('final_last_name').value = lastName;
            }

            if (currentStep === 3) {
                const phoneNumber = document.getElementById('phone_number').value;
                if (!phoneNumber) {
                    alert('Por favor ingresa tu número de celular.');
                    return;
                }
                document.getElementById('final_phone_number').value = phoneNumber;
                document.getElementById('final_email').value = "<?php echo $this->input->get('email'); ?>"; // Asignar el correo desde la URL
            }

            document.getElementById(`step${currentStep}`).classList.remove('active');
            currentStep++;
            document.getElementById(`step${currentStep}`).classList.add('active');
        }

        function previousStep() {
            document.getElementById(`step${currentStep}`).classList.remove('active');
            currentStep--;
            document.getElementById(`step${currentStep}`).classList.add('active');
        }
    </script>
</body>
</html>