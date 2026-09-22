<!--Developed by julian Gonzalez-->
<?php
  $db_host="127.0.0.1";
  $db_user="u927778197_adm";
  $db_pass="C0mp13t3501ut10n5*";
  $db_name="u927778197_appsdb";
  $conn=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
  if(mysqli_connect_errno()) 
			{
				echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
				echo "<script>
					document.addEventListener('DOMContentLoaded', function() {
						Swal.fire({
							title: 'Mensaje',
							text: 'Conexión a la aplicación no exitosa',
							icon: 'error',
							confirmButtonText: 'Aceptar',
							customClass: {
								popup: 'custom-swal-popup',
								title: 'custom-swal-title',
								content: 'custom-swal-content',
								confirmButton: 'custom-swal-confirm-button'
							}
						})
					});
					</script>";	
			exit();
			}		
  mysqli_select_db($conn,$db_name) or die ("La aplicación no está disponible");/*database is not available*/			
  if ($conn==true)
			  {
			  }
?>
