<?php 
include "sessions.php";
include "sessionvalidation.php";
$id = $_GET['id'];
$local_username=$_SESSION['email'];
$updatedcategory = $_SESSION['updatedcategory'];
$deletedcategory = $_SESSION['deletedcategory'];
$sessiontimeoutreached = $_SESSION['sessiontimeoutreached'];
$name = $_SESSION['name'];
include "headereditcategory.php";
include "db_connection1.php";
?>

<head>	
	<script src="head.js" defer></script>	  
	<link rel="stylesheet" href="style_sheet_ops.css"/>
</head>
<body id="bodyadminmodule"style="padding: 0%;>
<div class="container-fluid p-0" >
	<div class="row justify-content-start" style="padding: 0%; width: 100%;>
		<div class="col-md-12">
			 <?php 
					/*$query = "select * from videotips_viodetipscategory1 where category = '$category' and username='$local_username'";*/
					$query = "select * from videotips_viodetipscategory where id ='$id'";
					$result_link = mysqli_query($conn,$query);
					$link = mysqli_fetch_array($result_link);
			 ?>
			<div class="card card-body">
				<form text-align="center" action="updatecategory.php" method="POST"> 
					<center><label for="title" class="col-form-label" style="color: black; font-size: 28px;"><strong> Editar Categoría </strong></label></center>
						<center><div class="row justify-content-center">	
							<input type="hidden" name="id" value="<?php echo $link['id']; ?>">
							<!--<div class="form-group col-md-4">
								<label for="id" class="col-form-label" style="color: black;"><strong>Id</strong></label><br>	
								<input id="videolink" class="form-control" style="text-align: center;" type="text" name="id" class="form-control" placeholder="ID" autofocus value ="<?php echo $link['id'];?>"readonly></input><br>
							</div>-->
							<div class="form-group col-md-4">
								<label for="id" class="col-form-label" style="color: black;"><strong>Categoría</strong></label><br>	
								<input id="maincategory" class="form-control" style="text-align: center;" type="text" name="maincategory" class="form-control" placeholder="Categoría" required autofocus value ="<?php echo $link['maincategory'];?>"></input><br>
							</div>
							<div class="form-group col-md-4">
								<label for="videolink" class="col-form-label" style="color: black;"><strong>Subcategoría</strong></label><br>	
								<input id="category" class="form-control" style="text-align: center;" type="text" name="category" class="form-control" placeholder="Subcategoría" required autofocus value ="<?php echo $link['category'];?>"></input><br>
							</div>
							</div></center>					
								<center><input id="save_link" type="submit" class="btn btn-success btn-block" name="update_category" value="Actualizar"></input>
								<!--<input id="save_link" type="submit" class="btn btn-success btn-block" name="logout" value="Borrar" formaction="deletecategory.php"></input></center><br>-->
                 </form>
		    </div>
        </div>	
		
		<div class="col-md-12">
			<br>
			<div class="card card-body">
					<table id="autosearch" class="display" font color="back">
					<center><label for="maincategory" style="color: black; font-size: 28px;"><strong> Información de Categoría a Modificar </strong></label></center>	
						<thead id="tableswhite">
							<tr>
								<!--<th style="width: 33.33%;">ID</th>-->
								<th style="width: 50%;">Categoría</th>
								<th style="width: 50%;">Subcategoría</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							/*$query1 = "select * from videotips_viodetipscategory1 where category = '$category' and username = '$local_username'";*/
							$query1 = "select * from videotips_viodetipscategory where id = '$id'";
							$result_link1 = mysqli_query($conn,$query1);
							while($link = mysqli_fetch_array($result_link1)) { ?>
							<tr>
								<!--<td style="width: 33.33%;"><?php /*echo $link['id'] */?></td>-->
								<td style="width: 50%;"><?php echo $link['maincategory'] ?></td>
								<td style="width: 50%;"><?php echo $link['category'] ?></td>
								</td>
							</tr>
							<?php }?>
							</tbody>
					</table>
			</div>	
		</div>
	</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>

<?php


if ($sessiontimeoutreached  == 1){
	
	
	echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Detectada que la sesion no tiene actividad por más de 15 minutos, debe iniciar sesión nuevamente',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 2000, // 2000 milisegundos = 2 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
 	 </script>";  
}
?>
<?php include ("footer.php")?>