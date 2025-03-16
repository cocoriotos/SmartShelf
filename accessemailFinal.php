<?php 
session_start();
$captcha_input = $_POST["captcha"];
$global_username = $_POST["email"];
$_SESSION['email'] = $global_username;
$local_username = $_SESSION['email'];
$password = $_POST["password"];
$captcha_input = $_POST["captcha"];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar que los campos existan
    if (!isset($_POST["Name"]) || !isset($_POST["LastName"]) || !isset($_POST["Email"]) || !isset($_POST["Country"]) || !isset($_POST["City"]) || !isset($_POST["password1"]) || !isset($_POST["captcha"])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Mensaje',
                    text: '¡Todos los campos son obligatorios!',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        window.location.href = 'closetaskscon.php';
                    }
                });
            });
        </script>";
        exit();
    }

    

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
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        window.location.href = 'closetaskscon.php';
                    }
                });
            });
        </script>";
        exit();
    }

    // Comparar el CAPTCHA ingresado con el almacenado en sesión
    if (strtolower($captcha_input) !== strtolower($_SESSION["captcha"])) {
        unset($_SESSION["captcha"]);
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Mensaje',
                    text: 'CAPTCHA incorrecto.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        window.location.href = 'closetaskscon.php';
                    }
                });
            });
        </script>";
        exit();
    }

    // Destruir el CAPTCHA después de la verificación para evitar reutilización
    unset($_SESSION["captcha"]);

    include ("db_connection1.php");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $lastname = mysqli_real_escape_string($conn, $_POST['LastName']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $country = mysqli_real_escape_string($conn, $_POST['Country']);
    $city = mysqli_real_escape_string($conn, $_POST['City']);
    /*$password = password_hash($_POST['password1'], PASSWORD_DEFAULT);*/
    $password = mysqli_real_escape_string($conn, $_POST['password1']);

    $query3 = "SELECT * from videotips_app_access_list where email = '$email'";
    $result3 = $conn->query($query3);

    if ($result3->num_rows > 0) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Mensaje',
                    text: 'Correo ya había sido registrado en la aplicación, Si olvidó la contraseña usar la opción de recuperación. Si no es su correo entonces por favor usar otro',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        popup: 'custom-swal-popup',
                        title: 'custom-swal-title',
                        content: 'custom-swal-content',
                        confirmButton: 'custom-swal-confirm-button'
                    }
                }).then(() => {
                    window.location.href = 'requestaccessfinal.php';
                });
            });
        </script>";
		exit();
    } else {
        $query = "INSERT INTO videotips_accessrequests (name, lastname, email, country, city, password,processed,granted) VALUES ('$name', '$lastname', '$email', '$country', '$city','$password','Yes','Yes')";
        $result = $conn->query($query);

        $query1 = "INSERT INTO videotips_app_access_list (name,lastname, username, email, password, role, active, adm_role, suscriptionactive, categorycounter, extendcounterfeature, terms_conditions_awareness) VALUES ('$name', '$lastname', '$email', '$email', '$password', 'user', 1, 0, 1, 0, 0, 'Yes')";
        $result1 = $conn->query($query1);

        /*$query2 = "INSERT INTO videotips_suscription_payments (username, categoriescounts, active, freeregistrationdate, suscriptionactive) SELECT email, categorycounter, active, registrationdate, suscriptionactive from videotips_app_access_list where username = '$email'";
        $result2 = $conn->query($query2);*/

        /*Destination email information*/
        $to = "adm@solicionespro.com";
        $subject = "Urgent SmartShelf access request";
        $message = "Good day Admin Team:  \n\n";
        $message .= "This user is requesting tool access, please response ASAP \n\n";
        $message .= str_pad("Member name", 40) . ": $name \n";
        $message .= str_pad("Member Last name", 40) . ": $lastname \n";
        $message .= str_pad("Member email", 40) . ": $email \n\n";
        $message .= "Thank you for your support \n\n";
        $message .= "Email Application sender";
        $message .= "Dear Customer, you will be receiving Tool admin message advising if was granted or denied your request \n\n";
        $message .= "Email Application sender";
        $header = "From: adm@solicionespro.com" . "\r\n";
        $header .= "Bcc: cocoriotos@hotmail.com\r\n";
        $header .= "Reply-To: noreply@solicionespro.com" . "\r\n";
        $header .= "X-Mailer: PHP/" . phpversion();

        //Sending Email 
        $mail = mail($to, $subject, $message, $header);

        $to = "$email, adm@solicionespro.com";
        $subject = "Requerimiento de acceso a SmartShelf";
        $message = "Buen día $lastname, $name :  \n\n";
        $message .= "Su requerimiento ha sido enviado a los administradores de la herramienta para processar su solicitud. Acá la información de su solicitud \n\n";
        $message .= str_pad("Nombre", 40) . ": $name \n";
        $message .= str_pad("Apellido", 40) . ": $lastname \n";
        $message .= str_pad("Email", 40) . ": $email \n";
        $message .= str_pad("País", 40) . ": $country \n";
        $message .= str_pad("Ciudad", 40) . ": $city \n";
        $message .= str_pad("Nombre de usuario asignado", 40) . ": $email \n\n";
        $message .= "Por favor no responder éste correo \n\n";
        $message .= "Gracias por su registro, ya puede ingresar a la app desde este enlace https://solicionespro.com/SmartShelf/videotrackerauth.php con su usuario $email y la contraseña que escogió. \n\n";
        $message .= "Puedes también ingresar por este enlace donde podrás obtener más información importante de la aplicación así como videos tutoriales y manual del usuario https://www.youtube.com/playlist?list=PLRQ5KF9igtB2GRlHLSP6Uwx1lzy387Wz5. \n\n";
        $header = "From: adm@solicionespro.com" . "\r\n";
        $header .= "Bcc: cocoriotos@hotmail.com\r\n";
        $header .= "X-Mailer: PHP/" . phpversion();

        $mail1 = mail($to, $subject, $message, $header);

        if ($result && $mail && $mail1) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Mensaje',
                        text: 'Su requerimiento fue enviado, puede ingresar con el usuario y contraseña que digitó. Un correo con esta información fué enviado',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        customClass: {
                            popup: 'custom-swal-popup',
                            title: 'custom-swal-title',
                            content: 'custom-swal-content',
                            confirmButton: 'custom-swal-confirm-button'
                        }
                    }).then(() => {
                        window.location.href = 'videotrackerauth.php';
                    });
                });
            </script>";
			exit();
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Mensaje',
                        text: 'Requerimiento no enviado, por favor trate nuevamente o más tarde.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        customClass: {
                            popup: 'custom-swal-popup',
                            title: 'custom-swal-title',
                            content: 'custom-swal-content',
                            confirmButton: 'custom-swal-confirm-button'
                        }
                    }).then(() => {
                        window.location.href = 'closetaskscon.php';
                    });
                });
            </script>";
			exit();
        }
    }
}
?>