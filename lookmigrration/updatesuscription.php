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

echo $username;
echo $active;
echo $suscriptionactive;
echo $suscriptiondaysleft;
echo $suscriptionpayed;
echo $registrationdate;
echo $lastsuscriptionpaymentdate;
echo $suscriptionkind;
echo $packages;
echo $proofofpurchasenumber;

$stmt = $mysqli->prepare("UPDATE videotips_suscription_payments 
                          SET currentpaid = currentpaid+1, 
                              paymentcounter = paymentcounter+1, 
                              lastpaymentdate = ?, 
                              suscription_package = ?, 
                              proofofpurchasenumber = ? 
                          WHERE username = ?");
$stmt->bind_param("ssss", '$lastsuscriptionpaymentdate', '$packages', '$proofofpurchasenumber', '$username');
$stmt->execute();

$stmt1 = $mysqli->prepare("UPDATE videotips_app_access_list 
                           SET suscriptionactive = ?, 
                               suscriptionpayed = ?, 
                               lastsuscriptionpaymentdate = ?, 
                               suscriptionkind = ?  
                           where username = ?");
$stmt1->bind_param("sssss", '$suscriptionactive', '$suscriptionpayed', '$lastsuscriptionpaymentdate', '$suscriptionkind', '$username');
$stmt1->execute();


if ($stmt && $stmt1) {
    header("refresh:0; url=edittrial.php");
  exit();
    }
  else{
      header("refresh:0; url=AppMgmt.php");
      exit();
      }
?>