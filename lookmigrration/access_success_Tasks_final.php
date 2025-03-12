<html>
<?php 

GLOBAL $global_username;
GLOBAL $savedlink;
GLOBAL $duplicatedlink;
GLOBAL $updatedlink;
GLOBAL $deletedlink;
GLOBAL $savedcategory;
GLOBAL $duplicatedcategory;
GLOBAL $updatedcategory;
GLOBAL $deletedcategory;
GLOBAL $suscriptiondue;
GLOBAL $suscriptioninactive;
GLOBAL $FreeSubcateryReached;
GLOBAL $sessiontimeoutreached;
GLOBAL $global_name;

GLOBAL $copytoclipboard;
GLOBAL $categorytoclipboard;
GLOBAL $subcategorytoclipboard;
GLOBAL $copynumber;
GLOBAL $linktoclipboard;
GLOBAL $videoUrl;
GLOBAL $embedUrl;
GLOBAL $click;


session_start();

$_SESSION['savedlink']=0;
$_SESSION['duplicatedlink']=0;
$_SESSION['updatedlink']=0;
$_SESSION['deletedlink']=0;

$_SESSION['savedcategory']=0;
$_SESSION['duplicatedcategory']=0;
$_SESSION['updatedcategory']=0;
$_SESSION['deletedcategory']=0;
$_SESSION['suscriptiondue']=0;
$_SESSION['suscriptioninactive']=0;
$_SESSION['FreeSubcateryReached']=0;
$_SESSION['sessiontimeoutreached']=0;

$_SESSION['copytoclipboard']=0;
$_SESSION['categorytoclipboard']=0;
$_SESSION['subcategorytoclipboard']=0;
$_SESSION['copynumber']=0;
$_SESSION['linktoclipboard']=0;
$_SESSION['videoUrl']="";
$_SESSION['embedUrl']="";
$_SESSION['click']=0;
$_SESSION['name']="";

$savedlink = $_SESSION['savedlink'];
$duplicatedlink = $_SESSION['duplicatedlink'];
$updatedlink = $_SESSION['updatedlink'];
$deletedlink = $_SESSION['deletedlink'];
$name = $_SESSION['name'];

$savedcategory = $_SESSION['savedcategory'];
$duplicatedcategory = $_SESSION['duplicatedcategory'];
$updatedcategory = $_SESSION['updatedcategory'];
$deletedcategory = $_SESSION['deletedcategory'];
$FreeSubcateryReached = $_SESSION['FreeSubcateryReached'];

$suscriptiondue = $_SESSION['suscriptiondue'];
$suscriptioninactive = $_SESSION['suscriptioninactive'];
$sessiontimeoutreached = $_SESSION['sessiontimeoutreached'];


$copytoclipboard = $_SESSION['copytoclipboard'];
$categorytoclipboard = $_SESSION['categorytoclipboard'];
$subcategorytoclipboard = $_SESSION['subcategorytoclipboard'];
$copynumber = $_SESSION['copynumber'];
$linktoclipboard = $_SESSION['linktoclipboard'];
$videoUrl = $_SESSION['videoUrl'];
$embedUrl = $_SESSION['embedUrl'];
$click = $_SESSION['click'];

$global_username=$_POST['email'];
$_SESSION['email']=$global_username;
$local_username=$_SESSION['email'];
$password=$_POST['password'];

	if($_POST)
 {
  $db_host="127.0.0.1";
  $db_user="u927778197_adm";
  $db_pass="C0mp13t3501ut10n5*";
  $db_name="u927778197_appsdb";
  $conn=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		if(mysqli_connect_errno()) 
					{	
					include("No_DB_Connectionfinal.php");
					include ("videotrackerauth.php");
					exit();
					}
		mysqli_select_db($conn,$db_name) or die ("<center>No hay conexión disponible a la aplicación</center>");		

		if ($conn==true)
				{

				} 
				
				

				$stmt = $conn->prepare("SELECT suscriptiondaysleft FROM videotips_app_access_list WHERE username = ?");
				$stmt->bind_param("s", $local_username);
				$stmt->execute();
				$result3 = $stmt->get_result();
				$suscriptiondaysleft = $result3->fetch_assoc()['suscriptiondaysleft'];

				$stmt = $conn->prepare("SELECT suscriptionpayed FROM videotips_app_access_list WHERE username = ?");
				$stmt->bind_param("s", $local_username);
				$stmt->execute();
				$result4 = $stmt->get_result();
				$suscriptionpayed = $result4->fetch_assoc()['suscriptionpayed'];

				$stmt = $conn->prepare("SELECT name FROM videotips_app_access_list WHERE username = ?");
				$stmt->bind_param("s", $local_username);
				$stmt->execute();
				$result7 = $stmt->get_result();
				$_SESSION['name'] = $result7->fetch_assoc()['name'];

				$query1="select * from videotips_app_access_list where email='$local_username' and active='1' and password='$password'"; 
				$result1=mysqli_query($conn, $query1); 

				$query2="UPDATE videotips_suscription_payments SET currentdate = CURDATE() where username ='$local_username'"; 
				$result2=mysqli_query($conn, $query2);

				$query6="UPDATE videotips_suscription_payments SET suscriptiondaysleft = (365 - (DATEDIFF(CURDATE(), lastpaymentdate))) where username ='$local_username'"; 
				$result6=mysqli_query($conn, $query6);


				if ($suscriptiondaysleft > 16 && $suscriptionpayed == 0) {
					$_SESSION['suscriptiondue']=1;
					header("refresh:0; url=suscriptionpayment.php");
					exit();
				  }else{	
						if(mysqli_num_rows($result1)==true)
							{	
								$query5="update videotips_app_access_list SET suscriptiondaysleft = DATEDIFF(CURDATE(), registrationdate), visits = visits+1 where username ='$local_username'"; 
								$result5=mysqli_query($conn, $query5);
								header("refresh:0; url=videolinkadminmodule.php");
								exit();
							}
							else 
							{
					echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
					echo "<script>
						document.addEventListener('DOMContentLoaded', function() {
							Swal.fire({
								title: 'Mensaje',
								text: 'Su usuario o contraseña son incorrectos, por favor intentar nuevamente si está registrado de lo contrario solicite la opción de Solicitud de Acceso',
								icon: 'error',
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
							}
						}		
}
?>	
</html>
