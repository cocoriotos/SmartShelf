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
    <!-- Incluye SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <!--<a href="requestaccessfinal.php" class="btn">Registrarse</a>-->
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
                <div class="feature-item">
                    <h3>Multiplataforma</h3>
                    <p>Integra contenido de YouTube, LinkedIn, Google Drive y de más links públicos.</p>
                </div>
            </div>
            <div class="feature-grid">
                <!--<div class="feature-item">
                    <h3>Uso de la Aplicación</h3>
                    <p>Videos cortos que te ayudan a saber cómo usar la aplicación paso a paso.</p>
                    <div class="button-container">
                        <a href="https://www.youtube.com/playlist?list=PLRQ5KF9igtB2GRlHLSP6Uwx1lzy387Wz5" class="btn1" target="_blank" style="color: white">Videos Tutoriales</a>
                        <a href="UCLToolManualDelUsuario2025.pdf" class="btn1" target="_blank" style="color: white">Manual del Usuario</a>
                    </div>-->
                <div class="feature-item">
                    <h3 style="color: #D2691E; font-weight: bold; text-transform: uppercase;">¡Prueba Gratis por 15 Días!  Regístrate</h3>
                    <p>Explora todas las funciones, organiza tus enlaces importantes y crea categorías personalizadas.</p> 
                    <p>Si necesitas ayuda, ingresa y consulta los videos tutoriales y/o el Manual del Usuario en PDF.</p>
                </div>
                <div class="feature-item">
                    <h3>Primeros pasos después de registrarte e ingresar</h3>
                    <p><strong style="color: blue">1. Crea categorías y subcategorías:</strong></p> 
                    <p>Define al menos una categoría con sus respectivas subcategorías. Ejemplos:</p>
                    <p><em>a. Categoría:</em> Películas → <em>Subcategoría:</em> Español.</p>
                    <p><em>b. Categoría:</em> Películas → <em>Subcategoría:</em> Inglés.</p>
                    <p><em>c. Categoría:</em> Soporte → <em>Subcategoría:</em> Documentación Linux.</p>
                    <p><em>d. Categoría:</em> Soporte → <em>Subcategoría:</em> Documentación Windows.</p>
                    <p><strong style="color: blue">2. Organiza tus enlaces:</strong> </p>
                    <p>Guarda los links de tus contenidos, asígnalos a una categoría y añade una breve descripción.</p>
                    <p><strong style="color: blue">3. Encuentra contenido rápidamente:</strong></p> 
                    <p>Utiliza el buscador ingresando palabras clave, incluso si están en desorden o incompletas, para recuperar lo que necesitas.</p>
                </div>
                <div class="feature-item">
                    <h3 style="color: #D2691E; font-weight: bold; text-transform: uppercase;">¡Sigue disfrutando al Suscribirte!</h3>
                    <p>Pasado el periodo de prueba podrás continuar disfrutando por medio de los diferentes tipos de suscripciones así: </p>
                    <p><strong style="color: blue">Trimestral $20.000 COP</strong></p>
                    <p><strong style="color: blue">Semestral  $40.000 COP</strong></p>
                    <p><strong style="color: blue">Anual&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$60.000 COP</strong></p>
                </div>
                <div class="feature-item">
                    <h3>Términos y Condiciones</h3>
                    <p>Los derechos y deberes deben estar claramente definidos, leerlos detenidadmente.</p>
                    <div class="button-container">
                        <a href="TermsConditions.php" class="btn1" target="_blank" style="color: white">Términos Y Condiciones</a>
                    </div>
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

  <!--<section id="contact" class="contact">
        <div class="container">
            <h2>Contáctanos</h2>
            <form action="contact.php" method="POST">
                <input type="text" name="name" placeholder="Nombre" required>
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <textarea name="message" placeholder="Mensaje" required></textarea>
                <center><img src="captcha.php" alt="CAPTCHA"></center>
                <input type="text" name="captcha" placeholder="Ingrese el CAPTCHA" required>
                <button type="submit" class="btn">Enviar Mensaje</button>
                <br>
            </form>
        </div>
    </section> -->

    <footer>
        <div class="container">
            <p>&copy; 2025 SmartShelf. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>