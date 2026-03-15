<html>
<?php 

GLOBAL $global_username;
GLOBAL $suscriptiondue;
GLOBAL $suscriptioninactive;
GLOBAL $sessiontimeoutreached;


session_start();


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
				
				$query2="update videotips_app_access_list SET suscriptiondaysleft = DATEDIFF(CURDATE(), registrationdate) where username ='$local_username'"; 
				$result2=mysqli_query($conn, $query2);

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

				$query1="select * from videotips_app_access_list where email='$local_username' and active='1' and password='$password'"; 
				$result1=mysqli_query($conn, $query1); 


				if ($suscriptiondaysleft > 8 && $suscriptionpayed == 0) {
					$_SESSION['suscriptiondue']=1;
					header("refresh:0; url=suscriptionpayment.php");
					exit();
				  }else{	
						if(mysqli_num_rows($result1)==true)
							{	
								header("refresh:0; url=videolinkadminmodule.php");
								exit();
							}
							else 
							{
								include("access_not_successtasksfinal.php");	
								header("refresh:0; url=videotrackerauth.php");
								exit();
							}
						}		
 }
?>	
</html>
