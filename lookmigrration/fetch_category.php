<?php
include "sessions.php";
include "db_connection1.php";
$username = $_SESSION['email'];

$category = $_GET['subcategory'] ?? '';
 print("$category");

if ($category) {
    $sql = "SELECT DISTINCT maincategory 
            FROM videotips_viodetipscategory 
            WHERE category = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $category, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    echo json_encode($categories);
} else {
    echo json_encode([]);
}
?>
