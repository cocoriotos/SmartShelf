<?php 
include "sessions.php";
include "sessionvalidation.php";
include "db_connection1.php";
$id = $_GET['id'];
$videolink = $_GET['videolink'];
$local_username=$_SESSION['username'];
$deletedlink = $_SESSION['deletedlink'];

$query = "delete from videotips_videotips where id = '$id'";
$result = mysqli_query($conn,$query);
if ($result) {
  $_SESSION['deletedlink'] = 1; 
    header("refresh:0; url=videolinkadminmodule.php");  
    exit();
  }else{
    $_SESSION['deletedlink'] = 2;
    header("refresh:0; url=videolinkadminmodule.php");  
    exit();
}
?>