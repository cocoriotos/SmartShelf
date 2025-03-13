<?php
session_start();
$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];
$captcha_input = $_POST["captcha"];
$captchaok = 0;

      


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["message"]) || !isset($_POST["captcha"])) {

  $to1 = "cocoriotos@hotmail.com, adm@solicionespro.com";
  $subject1 = "Nuevo Mensaje de SmartShelf";
  $body1 = "Nombre: $name\nCorreo: $email\nMensaje: $message";
  $headers1 = "From: adm@solicionespro.com";

  $mail3 = mail($to1, $subject1, $body1, $headers1);
  include ("index.php");

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
  include ("index.php");
}

?>