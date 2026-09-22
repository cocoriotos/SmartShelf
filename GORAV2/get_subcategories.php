<?php
include "db_connection1.php"; // DB connection
$local_username=$_SESSION['email'];

if (isset($_POST['maincategory'])) {
    $maincategory = $_POST['maincategory'];
    $username = $local_username; // $local_username is correct

    $SQLSELECT = "SELECT DISTINCT(category) FROM videotips_viodetipscategory WHERE maincategory = '$maincategory' AND username = '$username' ORDER BY category ASC";
    $result_set = mysqli_query($conn, $SQLSELECT);

    while ($rows = $result_set->fetch_assoc()) {
        $category = $rows['category'];
        echo "<option value='$category'>$category</option>";
    }
}
?>
