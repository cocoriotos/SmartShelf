<?php
session_start();
$captcha_input = $_POST["captcha"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["message"]) || !isset($_POST["captcha"])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
		Swal.fire({
					title: 'Mensaje',
                text: '¡Todos los campos son obligatorios!',
                icon: 'error',
                confirmButtonText: 'Aceptar',
                timer: 2000, // 2 segundos antes de redirigir
                timerProgressBar: true, // Barra de progreso
                willClose: () => {
                  window.location.href = 'index.php'; // Redirección automática
                }
              });
          });
         </script>";
         exit();
    }
    
    if (!isset($_SESSION["captcha"])) {
		echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
      echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
                  title: 'Mensaje',
                  text: 'CAPTCHA ha expirado, recarga la página.',
                  icon: 'error',
                  confirmButtonText: 'Aceptar',
                  timer: 2000, // 2 segundos antes de redirigir
                  timerProgressBar: true, // Barra de progreso
                  willClose: () => {
                    window.location.href = 'index.php'; // Redirección automática
                  }
                });
            });
           </script>";
           exit();
    }

    // Comparar el CAPTCHA ingresado con el almacenado en sesión
    if (strtolower($captcha_input) !== strtolower($_SESSION["captcha"])) {
		echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
		  Swal.fire({
					title: 'Mensaje',
					text: 'CAPTCHA incorrecto.',
					icon: 'error',
					confirmButtonText: 'Aceptar',
					timer: 2000, // 2 segundos antes de redirigir
					timerProgressBar: true, // Barra de progreso
					willClose: () => {
					  window.location.href = 'index.php'; // Redirección automática
					}
				  });
			  });
			 </script>";
			 exit();
    }

    // Destruir el CAPTCHA después de la verificación para evitar reutilización
    unset($_SESSION["captcha"]);


    // Aquí puedes agregar la lógica para enviar el correo o guardar en una base de datos
    // Ejemplo de envío de correo:
    $to = "adm@solicionespro.com";
    $subject = "Nuevo Mensaje de SmartShelf";
    $body = "Nombre: $name\nCorreo: $email\nMensaje: $message";
    $headers = "From: $email";

    $mail = mail($to, $subject, $body, $headers);

    if ($mail) {
        // Alerta de éxito y redirección
        echo "El Mensaje fué enviado correctamente";
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Mensaje',
                text: 'Gracias por contactarnos, estamos revisando tu mensaje y te responderemos pronto.',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                timer: 2000, // 2 segundos antes de redirigir
                timerProgressBar: true, // Barra de progreso
                willClose: () => {
                  window.location.href = 'index.php'; // Redirección automática
                }
                });
              });
            </script>";
            exit();
    } else {
        // Alerta de error y redirección
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: 'Mensaje',
              text: 'Hubo un error al enviar tu mensaje. Inténtalo de nuevo.',
              icon: 'error',
              confirmButtonText: 'Aceptar',
              timer: 2000, // 2 segundos antes de redirigir
              timerProgressBar: true, // Barra de progreso
              willClose: () => {
                window.location.href = 'index.php'; // Redirección automática
              }
              });
            });
          </script>";
          exit();
    }
}

?>