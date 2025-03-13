<?php
session_start();
$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];
$captcha_input = $_POST["captcha"];
$captchaok = 0;

      


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $to1 = "cocoriotos@hotmail.com, adm@solicionespro.com";
  $subject1 = "Nuevo Mensaje de SmartShelf";
  $body1 = "Nombre: $name\nCorreo: $email\nMensaje: $message";
  $headers1 = "From: adm@solicionespro.com";

  $mail3 = mail($to1, $subject1, $body1, $headers1);
  include ("index.php");
}

?>