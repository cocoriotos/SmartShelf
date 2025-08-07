<?php
session_start();

// Definir variables globales
GLOBAL $global_username, $savedlink, $duplicatedlink, $updatedlink, $deletedlink;
GLOBAL $savedcategory, $duplicatedcategory, $updatedcategory, $deletedcategory;
GLOBAL $suscriptiondue, $suscriptioninactive, $FreeSubcateryReached, $sessiontimeoutreached;
GLOBAL $global_name, $copytoclipboard, $categorytoclipboard, $subcategorytoclipboard;
GLOBAL $copynumber, $linktoclipboard, $videoUrl, $embedUrl, $click;

// Inicializar sesiones
$_SESSION['savedlink'] = 0;
$_SESSION['duplicatedlink'] = 0;
$_SESSION['updatedlink'] = 0;
$_SESSION['deletedlink'] = 0;

$_SESSION['savedcategory'] = 0;
$_SESSION['duplicatedcategory'] = 0;
$_SESSION['updatedcategory'] = 0;
$_SESSION['deletedcategory'] = 0;
$_SESSION['suscriptiondue'] = 0;
$_SESSION['suscriptioninactive'] = 0;
$_SESSION['FreeSubcateryReached'] = 0;
$_SESSION['sessiontimeoutreached'] = 0;

$_SESSION['copytoclipboard'] = 0;
$_SESSION['categorytoclipboard'] = 0;
$_SESSION['subcategorytoclipboard'] = 0;
$_SESSION['copynumber'] = 0;
$_SESSION['linktoclipboard'] = 0;
$_SESSION['videoUrl'] = "";
$_SESSION['embedUrl'] = "";
$_SESSION['click'] = 0;
$_SESSION['name'] = "";


$savedlink = $_SESSION['savedlink'];
$duplicatedlink = $_SESSION['duplicatedlink'];
$updatedlink = $_SESSION['updatedlink'];
$deletedlink = $_SESSION['deletedlink'];
$name = $_SESSION['name'];


$savedcategory = $_SESSION['savedcategory'];
$duplicatedcategory = $_SESSION['duplicatedcategory'];
$updatedcategory = $_SESSION['updatedcategory'];
$deletedcategory = $_SESSION['deletedcategory'];
$FreeSubcateryReached = $_SESSION['FreeSubcateryReached'];

$suscriptiondue = $_SESSION['suscriptiondue'];
$suscriptioninactive = $_SESSION['suscriptioninactive'];
$sessiontimeoutreached = $_SESSION['sessiontimeoutreached'];

$copytoclipboard = $_SESSION['copytoclipboard'];
$categorytoclipboard = $_SESSION['categorytoclipboard'];
$subcategorytoclipboard = $_SESSION['subcategorytoclipboard'];
$copynumber = $_SESSION['copynumber'];
$linktoclipboard = $_SESSION['linktoclipboard'];
$videoUrl = $_SESSION['videoUrl'];
$embedUrl = $_SESSION['embedUrl'];
$click = $_SESSION['click'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar que los campos existan
    if (!isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["captcha"])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
                title: 'Mensaje',
                text: '¡Todos los campos son obligatorios!',
                icon: 'error',
                confirmButtonText: 'Aceptar',
                timer: 1000, // 1 segundos antes de redirigir
                timerProgressBar: true, // Barra de progreso
                willClose: () => {
                  window.location.href = 'closetaskscon.php'; // Redirección automática
                }
              });
          });
         </script>";
         exit();
    }

    $global_username = $_POST["email"];
    $_SESSION['email'] = $global_username;
    $local_username = $_SESSION['email'];
    $password = $_POST["password"];
    $captcha_input = $_POST["captcha"];

    // Validar si el CAPTCHA existe y ha expirado
    if (!isset($_SESSION["captcha"])) {
      echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
      echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
                  title: 'Mensaje',
                  text: 'CAPTCHA ha expirado, recarga la página.',
                  icon: 'error',
                  confirmButtonText: 'Aceptar',
                  timer: 1000, // 1 segundos antes de redirigir
                  timerProgressBar: true, // Barra de progreso
                  willClose: () => {
                    window.location.href = 'closetaskscon.php'; // Redirección automática
                  }
                });
            });
           </script>";
           exit();
    }

    // Comparar el CAPTCHA ingresado con el almacenado en sesión
    if (strtolower($captcha_input) !== strtolower($_SESSION["captcha"])) {
        unset($_SESSION["captcha"]); // Destruir el CAPTCHA después de un intento fallido
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
                title: 'Mensaje',
                text: 'CAPTCHA incorrecto.',
                icon: 'error',
                confirmButtonText: 'Aceptar',
                timer: 1000, // 1 segundo antes de redirigir
                timerProgressBar: true, // Barra de progreso
                willClose: () => {
                  window.location.href = 'closetaskscon.php'; // Redirección automática
                }
              });
          });
         </script>";
         exit();
    }

    // Destruir el CAPTCHA después de la verificación para evitar reutilización
    unset($_SESSION["captcha"]);

    // Conexión a la base de datos
    $db_host = "127.0.0.1";
    $db_user = "u927778197_adm";
    $db_pass = "C0mp13t3501ut10n5*";
    $db_name = "u927778197_appsdb";

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        include("No_DB_Connectionfinal.php");
        include("videotrackerauth.php");
        exit();
    }

    mysqli_select_db($conn, $db_name) or die("No hay conexión disponible a la aplicación");

    // Obtener datos del usuario
    $stmt = $conn->prepare("SELECT suscriptiondaysleft, suscriptionpayed, name FROM videotips_app_access_list WHERE username = ?");
    $stmt->bind_param("s", $local_username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();

    if (!$user_data) {
      echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
      echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
                  title: 'Mensaje',
                  text: 'Usuario no registrado.',
                  icon: 'error',
                  confirmButtonText: 'Aceptar',
                  timer: 1000, // 1 segundo antes de redirigir
                  timerProgressBar: true, // Barra de progreso
                  willClose: () => {
                    window.location.href = 'closetaskscon.php'; // Redirección automática
                  }
                });
            });
           </script>";
           exit();
    }

    $_SESSION['name'] = $user_data['name'];
    $suscriptiondaysleft = $user_data['suscriptiondaysleft'];
    $suscriptionpayed = $user_data['suscriptionpayed'];

    // Verificar credenciales
    $stmt = $conn->prepare("SELECT * FROM videotips_app_access_list WHERE email = ? AND active = 1 AND password = ?");
    $stmt->bind_param("ss", $local_username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Actualizar datos de suscripción
        $stmt = $conn->prepare("UPDATE videotips_suscription_payments SET currentdate = CURDATE() WHERE username = ?");
        $stmt->bind_param("s", $local_username);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE videotips_suscription_payments SET suscriptiondaysleft = (365 - (DATEDIFF(CURDATE(), lastpaymentdate))) WHERE username = ?");
        $stmt->bind_param("s", $local_username);
        $stmt->execute();

        if ($suscriptiondaysleft > 16 && $suscriptionpayed == 0) {
            $_SESSION['suscriptiondue'] = 1;
            header("Location: suscriptionpayment.php");
            exit();
        } else {
            $stmt = $conn->prepare("UPDATE videotips_app_access_list SET suscriptiondaysleft = DATEDIFF(CURDATE(), registrationdate), visits = visits+1 WHERE username = ?");
            $stmt->bind_param("s", $local_username);
            $stmt->execute();

            header("Location: videolinkadminmodule.php");
            exit();
        }
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Mensaje',
                    text: 'Su usuario o contraseña son incorrectos, por favor intentar nuevamente.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'videotrackerauth.php';
                });
            });
        </script>";
        exit();
    }
}





if ($captchat_status == 4) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Usuario no encontrado.',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1000, // 1 segundo antes de redirigir
        timerProgressBar: true, // Barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Indicador de carga
        },
        willClose: () => {
          window.location.href = 'closetaskscon.php'; // Redirección automática
        }
      });
    });
  </script>";
    $captchat_status = 10;
}

?>

