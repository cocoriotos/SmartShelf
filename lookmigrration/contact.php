<?php
session_start();
$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];
$captcha_input = $_POST["captcha"];
$captchaok = 0;

      


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
         $captchaok = 1;
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
           $captchaok = 1;
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
         $captchaok = 1;
         exit();
      }
  include ("index.php");
}
?>

