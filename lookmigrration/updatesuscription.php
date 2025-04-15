<?php 
include "sessions.php";
include "sessionvalidation.php";
include "db_connection1.php"; 

$id = $_POST['id'];
$username = $_POST['username'];
$active = $_POST['active'];
$suscriptionactive = $_POST['suscriptionactive'];
$suscriptiondaysleft = $_POST['suscriptiondaysleft'];
$suscriptionpayed = $_POST['suscriptionpayed'];
$registrationdate = $_POST['registrationdate']; 
$lastsuscriptionpaymentdate = $_POST['lastsuscriptionpaymentdate'];
$suscriptionkind = $_POST['suscriptionkind'];   
$packages = $_POST['packages'];
$proofofpurchasenumber = $_POST['proofofpurchasenumber'];


$query = "UPDATE videotips_suscription_payments SET currentpaid = 1, paymentcounter = paymentcounter + 1, lastpaymentdate = $lastsuscriptionpaymentdate, suscription_package = $package, proofofpurchasenumber = $proofofpurchasenumber  WHERE username = $username";
$result = mysqli_query($conn,$query);

$query1 = "UPDATE videotips_app_access_list SET suscriptionactive = $suscriptionactive, suscriptionpayed = $suscriptionpayed, lastsuscriptionpaymentdate = $lastsuscriptionpaymentdate, suscriptionkind = $suscriptionkind  where username = $username";
$result1 = mysqli_query($conn,$query1);


if ($result && $result1) {
    header("refresh:0; url=edittrial.php");
  exit();
    }
  else{
      header("refresh:0; url=AppMgmt.php");
      exit();
      }
?>