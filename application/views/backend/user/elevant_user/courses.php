<?php $active_page = 'courses'; ?>
<?php include 'navigation.php'; ?>
       <?php include 'top_bar.php'; ?>

<div class="main-content">
    <main>
        <!-- Title and Description -->
        <h1>Espacio de trabajo, elige tu forma de trabajar</h1>
        <p>Permítenos saber qué podemos hacer para ti en tu creación de este curso</p>

        <!-- Card Container -->
        <div class="card-container">
            <!-- Card 1 -->
            <div class="card">
                <div style="position: relative; width: 100%;">
                    <img src="<?php echo base_url('uploads/elevant/ejecutivo1.png'); ?>" alt="Crear nuevo curso">
                    <span class="badge">Recomendado</span>
                </div>
                <h2>Crear nuevo curso</h2>
                <p>
                    Te ayudamos a crear el curso ideal para tu audiencia, sin importar el tema o tu experiencia.
                    Aprende a identificar qué quieren, cómo estructurarlo y destacar con valor único.
                </p>
                <button onclick="window.location.href='<?php echo site_url('user/elevant/course_add'); ?>'">Siguiente</button>
            </div>

            <!-- Card Extra: Gestiona tus cursos -->
            <div class="card">
                <img src="<?php echo base_url('uploads/elevant/ejecutivo3.png'); ?>" alt="Gestiona tus cursos">
                <h2>Gestiona tus cursos</h2>
                <p>
                    Administra todos tus cursos fácilmente desde un solo lugar. Controla el progreso, actualiza materiales y mantén la calidad para que tus estudiantes siempre tengan la mejor experiencia.
                </p>
                <button onclick="window.location.href='<?php echo site_url('user/elevant/course_manager'); ?>'">Ir a mis cursos</button>
            </div>

            <!-- Card 2 -->
            <div class="card">
                <img src="<?php echo base_url('uploads/elevant/ejecutivo2.png'); ?>" alt="Convertirme en afiliado">
                <h2>Convertirme en afiliado</h2>
                <p>
                    Conviértete en afiliado y gana dinero recomendando nuestros cursos. Es gratis y fácil:
                    comparte tu enlace y recibe comisiones por cada venta. ¡Empieza hoy!
                </p>
                <button>Afiliarme</button>
            </div>
        </div>
    </main>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');

    body {
        font-family: 'Nunito', sans-serif;
    }

    .main-content {
        margin-left: 80px; /* Espacio para la barra lateral */
        margin-top: 60px; /* Espacio para la barra superior */
        padding: 20px;
    }

    main {
        text-align: center;
        padding: 40px;
    }

    main h1 {
        font-size: 32px; /* Incrementa el tamaño del título */
        font-weight: bold;
        color: #000;
        margin-bottom: 20px;
    }

    main p {
        font-size: 18px; /* Incrementa el tamaño del texto */
        color: #666;
        margin-bottom: 40px;
    }

    .card-container {
        display: flex;
        justify-content: center;
        gap: 30px; /* Incrementa el espacio entre tarjetas */
        flex-wrap: wrap;
    }

    .card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        width: 400px; /* Incrementa el ancho de las tarjetas */
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .card img {
        width: 100%;
        height: 250px; /* Incrementa la altura de las imágenes */
        object-fit: cover;
    }

    .card .badge {
        position: absolute;
        background-color: #ffd700;
        color: #000;
        font-size: 14px; /* Incrementa el tamaño del texto de la insignia */
        font-weight: bold;
        padding: 8px 12px;
        border-radius: 12px;
        margin: 10px;
        top: 0;
        left: 0;
    }

    .card h2 {
        font-size: 22px; /* Incrementa el tamaño del texto del título */
        font-weight: bold;
        color: #000;
        margin: 20px 0 15px;
    }

    .card p {
        font-size: 16px; /* Incrementa el tamaño del texto de la descripción */
        color: #666;
        padding: 0 20px;
        margin-bottom: 30px;
        text-align: center;
    }

    .card button {
        background-color: #000;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 12px 25px; /* Incrementa el tamaño del botón */
        font-size: 16px; /* Incrementa el tamaño del texto del botón */
        font-weight: bold;
        cursor: pointer;
        margin-bottom: 30px;
    }

    .card button:hover {
        background-color: #333;
    }

    @media (max-width: 768px) {
        .card-container {
            flex-direction: column;
            align-items: center;
        }

        .card {
            width: 90%; /* Ajusta el ancho de las tarjetas en pantallas pequeñas */
        }
    }
</style>
