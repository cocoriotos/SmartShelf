<?php 
include "sessions.php";
if (empty($_SESSION['email'])) {
    // Cerrar la conexión antes de redirigir
    if (isset($conn)) {
        $conn->close();
    }
    session_unset();
    session_destroy();
    header("Location: videotrackerauth.php");
    exit;
}
?>