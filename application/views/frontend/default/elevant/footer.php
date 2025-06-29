<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Footer Elevant Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        footer {
            background: #111111;
            color: #fff;
            padding: 40px 20px;
            width: 100%;
            box-sizing: border-box;
        }
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }
        .newsletter-section {
            background: #222;
            padding: 40px 20px;
            border-radius: 12px;
            text-align: center;
        }
        .newsletter-section h2 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .newsletter-section p {
            font-size: 1rem;
            color: #e0e0e0;
            margin-bottom: 20px;
        }
        .newsletter-form {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .newsletter-form input[type="email"] {
            padding: 10px 14px;
            border-radius: 20px;
            border: 1px solid #444;
            background: #181818;
            color: #fff;
            outline: none;
            min-width: 260px;
        }
        .newsletter-form button {
            background: #ffcc49;
            border: none;
            color: #181818;
            padding: 10px 28px;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.2s;
        }
        .newsletter-form button:hover {
            background: #ffd776;
        }
        .footer-main {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
        }
        .footer-logo {
            flex: 1 1 250px;
        }
        .footer-logo h1 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 10px;
        }
        .footer-logo p {
            font-size: 1rem;
            color: #d0d0d0;
            margin-top: 10px;
        }
        .footer-columns {
            display: flex;
            gap: 40px;
            flex: 2 1 600px;
            flex-wrap: wrap;
        }
        .footer-col h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .footer-col ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-col ul li {
            font-size: 1rem;
            color: #d0d0d0;
            margin-bottom: 8px;
        }
        .footer-bottom {
            text-align: center;
            font-size: 0.9rem;
            color: #777;
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .footer-main {
                flex-direction: column;
                align-items: center;
            }
            .footer-columns {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <footer>
        <div class="footer-container">
            <div class="newsletter-section">
                <h2>Suscríbete a nuestro boletín</h2>
                <p>Recibe actualizaciones y noticias directamente en tu correo.</p>
                <form class="newsletter-form" autocomplete="off">
                    <input type="email" placeholder="Ingresa tu correo electrónico" required>
                    <button type="submit">Suscribirse</button>
                </form>
            </div>
            <div class="footer-main">
                <div class="footer-logo">
                    <h1>ELEVANT</h1>
                    <p>Study any topic, anytime. Explore thousands of courses for the lowest price ever!</p>
                </div>
                <div class="footer-columns">
                    <div class="footer-col">
                        <h3>Top Category</h3>
                        <ul>
                            <li>Farmacia</li>
                            <li>Multimedia</li>
                            <li>Podcast</li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h3>Use Link</h3>
                        <ul>
                            <li>Courses</li>
                            <li>Instructor</li>
                            <li>Afiliado</li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h3>Help</h3>
                        <ul>
                            <li>About Us</li>
                            <li>Contact</li>
                            <li>Term and condition</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                © 2024 Elevant Academy. Todos los derechos reservados.
            </div>
        </div>
    </footer>
</body>
</html>