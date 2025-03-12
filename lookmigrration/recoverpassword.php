<!-- Developed by Julián González Bucheli -->
<html lang="us">
<?php 
include "sessions.php";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - SmartShelf</title>
    <link rel="icon" href="SSCircleBackgroundWhite.ico" type="image/x-icon">
    <script src="head.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style_sheet_auth.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body id="bodyadminmodule">
    <div class="login-container">
        <!-- Enlaces de ayuda en la parte superior derecha -->
        <div class="help-links">
            <!--<a href="https://www.youtube.com/playlist?list=PLRQ5KF9igtB2GRlHLSP6Uwx1lzy387Wz5" target="_blank">Video Tutoriales</a>while Adjustments
            <a href="UCLToolManualDelUsuario2025.pdf" target="_blank">Manual del Usuario</a>-->
        </div>

        <!-- Encabezado del formulario -->
        <div class="login-header">
            <img src="SmartShelfUsefulContentLibraryDarrkLightGreen.ico" alt="SmartShelf Logo" class="logo">
            <h1>Recuperación de Contraseña</h1>
        </div>

        <!-- Formulario de recuperación de contraseña -->
        <form id="login" action="recoverpasswordemailFinal.php" method="POST" autocomplete="off">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <button type="submit" class="btn-login">Recuperar Contraseña</button>
            <br>
        </form>
        
        <form id="login" action="index.php" method="POST" autocomplete="off">
            <button type="submit" class="btn-login">Cancelar</button>
            <br>
        </form>


        <!-- Información de contacto -->
        <form id="request-access">
            <p>¿Alguna duda? Contáctenos al Email: <a href="mailto:adm@solicionespro.com">adm@solicionespro.com</a></p>
            <br>
            <!--<p>Fecha: <?php /*echo date('m/d/Y');*/ ?></p>-->
        </form>
    </div>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("login").addEventListener("submit", function(event) {
            var emailInput = document.querySelector("input[name='email']");
            var email = emailInput.value;

            // Expresión regular para validar el formato de un correo electrónico
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                // Evita que el formulario se envíe
                event.preventDefault();

                // Muestra el SweetAlert
                Swal.fire({
                    title: 'Mensaje',
                    text: 'Por favor, ingresa una dirección de correo electrónico válida.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        popup: 'custom-swal-popup',
                        title: 'custom-swal-title',
                        content: 'custom-swal-content',
                        confirmButton: 'custom-swal-confirm-button'
                    }
                }).then(() => {
                    // Redirige a la página de recovery
                    window.location.href = 'recoverpassword.php';
                });
            }
        });
    </script>
</body>
</html>