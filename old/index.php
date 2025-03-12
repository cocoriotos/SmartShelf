<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartShelf - Tu Biblioteca Digital Inteligente</title>
    <link rel="stylesheet" href="style_sheet_landing_page.css">
    <link rel="icon" href="SSCircleBackgroundWhite.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>
<body>
    <header>
        <div class="container">
            <h1>SmartShelf</h1>
            <img src="SmartShelfUsefulContentLibraryDarrkLightGreen.ico" alt="SmartShelf Logo" class="logo">
            <p>Tu Biblioteca Digital Inteligente</p>
        </div>
    </header>
    <section class="hero">
        <div class="container">
            <h2>Centraliza, Organiza y Accede a Todo tu Conocimiento en un Solo Lugar</h2>
            <p>¿Te has preguntado cuánto tiempo pierdes buscando enlaces, artículos, recursos o herramientas que guardaste pero no recuerdas dónde? Con <strong>SmartShelf</strong>, esa frustración se acabó.</p>
            <a href="videotrackerauth.php" class="btn">Ingresar</a>
            <a href="requestaccessfinal.php" class="btn">Registrarse</a>
        </div>
    </section>
    <br>
    <section id="features" class="features">
    <div class="container">
        <h2>¿Por qué Elegir SmartShelf?</h2>
        <div class="feature-grid">
            <div class="feature-item">
                <h3>Organización Inteligente</h3>
                <p>Guarda enlaces de cualquier plataforma y clasifícalos en categorías personalizadas.</p>
            </div>
            <div class="feature-item">
                <h3>Búsqueda Instantánea</h3>
                <p>Encuentra lo que necesitas con solo escribir palabras clave.</p>
            </div>
            <div class="feature-item">
                <h3>Acceso Rápido</h3>
                <p>Accede directamente al contenido o comparte enlaces de manera instantánea.</p>
            </div>
        </div>
        <div class="feature-grid">
            <div class="feature-item">
                <h3>Multiplataforma</h3>
                <p>Integra contenido de YouTube, LinkedIn, Google Drive y más.</p>
            </div>
            <div class="feature-item">
                <h3>Uso de la Aplicación</h3>
                <p>Videos cortos que te ayudan a saber cómo usar la aplicación paso a paso.</p>
                <div class="button-container">
                    <a href="https://www.youtube.com/playlist?list=PLRQ5KF9igtB2GRlHLSP6Uwx1lzy387Wz5" class="btn1" target="_blank" style="color: white">Videos Tutoriales</a>
                    <a href="UCLToolManualDelUsuario2025.pdf" class="btn1" target="_blank" style="color: white">Manual del Usuario</a>
                </div>
            </div>
            <div class="feature-item">
                <h3 style="color: #D2691E; font-weight: bold; text-transform: uppercase;">¡Prueba Gratis por 15 Días! | Regístrate</h3>
                <p>Explora todas las funciones, organiza tus enlaces importantes y crea categorías personalizadas. Si necesitas ayuda, consulta los videos tutoriales o el Manual del Usuario en PDF.</p>
            </div>
        </div>
    </div>
</section>


    <section class="cta">
        <div class="container">
            <h2>Transforma tu Forma de Gestionar el Conocimiento</h2>
            <p>Con <strong>SmartShelf</strong>, nunca más volverás a perder un enlace importante.</p>
            <a href="#contact" class="btn">¡Descubre SmartShelf Hoy!</a>
        </div>
    </section>

    <section id="contact" class="contact">
        <div class="container">
            <h2>Contáctanos</h2>
            <form action="contact.php" method="POST">
                <input type="text" name="name" placeholder="Nombre" required>
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <textarea name="message" placeholder="Mensaje" required></textarea>
                <button type="submit" class="btn">Enviar Mensaje</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 SmartShelf. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>