<?php 
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

echo $username . "\n\n" ;
echo $active . "\n\n" ;
echo $suscriptionactive . "\n\n" ;
echo $suscriptiondaysleft . "\n\n" ;
echo $suscriptionpayed . "\n\n" ;
echo $registrationdate . "\n\n" ;
echo $lastsuscriptionpaymentdate . "\n\n" ;
echo $suscriptionkind . "\n\n" ;
echo $packages . "\n\n" ;
echo $proofofpurchasenumber . "\n\n" ;


$sql = "UPDATE videotips_suscription_payments SET currentpaid = currentpaid + 1, paymentcounter = paymentcounter + 1, lastpaymentdate = '$lastsuscriptionpaymentdate', suscription_package = '$packages', proofofpurchasenumber = '$proofofpurchasenumber' WHERE username = '$username'";
$result = $conn->query($sql);

$sql1 = "UPDATE videotips_app_access_list SET suscriptionactive = '$suscriptionactive', suscriptionpayed = '$suscriptionpayed', lastsuscriptionpaymentdate = '$lastsuscriptionpaymentdate', suscriptionkind = '$suscriptionkind' where username = '$username'";
$result1 = $conn->query($sql1);

/*$stmt = $mysqli->prepare("UPDATE videotips_suscription_payments 
                          SET currentpaid = currentpaid + 1, 
                              paymentcounter = paymentcounter + 1, 
                              lastpaymentdate = ?, 
                              suscription_package = ?, 
                              proofofpurchasenumber = ? 
                          WHERE username = ?");
$stmt->bind_param("ssss", '$lastsuscriptionpaymentdate', '$packages', '$proofofpurchasenumber', '$username');
$stmt->execute();*/


/*$stmt1 = $mysqli->prepare("UPDATE videotips_app_access_list 
                           SET suscriptionactive = ?, 
                               suscriptionpayed = ?, 
                               lastsuscriptionpaymentdate = ?, 
                               suscriptionkind = ?  
                           where username = ?");
$stmt1->bind_param("sssss", '$suscriptionactive', '$suscriptionpayed', '$lastsuscriptionpaymentdate', '$suscriptionkind', '$username');
$stmt1->execute();*/


if ($result && $result1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Suscripción Actualizada Correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 3000, // 3000 milisegundos = 3 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
    </script>";	
    header("refresh:0; url=edittrial.php");
    exit();
    }
  else{
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
            title: 'Mensaje',
            text: 'Suscripción No Pudo Ser Actualizada Correctamente',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            customClass: {
              popup: 'custom-swal-popup',
              title: 'custom-swal-title',
              content: 'custom-swal-content',
              confirmButton: 'custom-swal-confirm-button'
            },
            timer: 3000, // 3000 milisegundos = 3 segundos
            timerProgressBar: true, // Muestra una barra de progreso
            didOpen: () => {
              Swal.showLoading(); // Muestra un indicador de carga
            },
            willClose: () => {
            }
          });
        });
      </script>";
      header("refresh:0; url=AppMgmt.php");
      exit();
      }
?>