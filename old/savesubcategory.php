<?php 
session_start();
include "db_connection1.php";


$local_username=$_SESSION['email'];
$secondcategory=$_POST["secondcategory"];



$query="INSERT INTO videotips_viodetipscategory (category,username) values ('$secondcategory','$local_username')";
$resultado= $conn ->query($query);


if ($resultado){
  include "subcategory_saved.php";
  /*echo "<h4>Categoría Salvada Exitosamente</h4>";*/
  header("refresh:0; url=videolinkadminmodule.php");
  }
?>