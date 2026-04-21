<?php
include "sessions.php";
include 'db_connection1.php'; // Archivo para conectar a la base de datos

$username =  $_SESSION['email']; // Define el username dinámicamente si es necesario
$maincategory = $_GET['maincategory'] ?? '';

if ($maincategory) {
    $sql = "SELECT DISTINCT category 
            FROM videotips_viodetipscategory 
            WHERE maincategory = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $maincategory, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $subcategories = [];
    while ($row = $result->fetch_assoc()) {
        $subcategories[] = $row;
    }

    echo json_encode($subcategories);
} else {
    echo json_encode([]);
}
?>

