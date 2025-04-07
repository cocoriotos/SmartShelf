<?php 
include "sessions.php";
include "sessionvalidation.php";
$id = $_GET['id'];
$videolink = $_GET['videolink'];
$local_username = $_SESSION['email'];
$deletedlink = $_SESSION['deletedlink'];
$updatedlink = $_SESSION['updatedlink'];
$sessiontimeoutreached = $_SESSION['sessiontimeoutreached'];
$name = $_SESSION['name'];
include "headeredit.php";
include "db_connection1.php";
?>

<head>	
    <script src="head.js" defer></script>
    <link rel="stylesheet" href="style_sheet_ops.css"/>
    <script src="Popper/popper.min.js"></script>
    <script src="plugins/sweetalert/sweetalert.min.js"></script>
    <script src="plugins/alertifyjs/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
</head>

<body id="bodyadminmodule">	
<div class="container p-4">
	<div class="row">
		<div class="col-md-4">
		     		 
			 <?php 
					$query = "select id, active, suscriptionactive, suscriptiondaysleft, suscriptionpayed, lastsuscriptionpaymentdate, suscriptionkind  from videotips_app_access_list where  id='$id'";
					$result_tasks = mysqli_query($conn,$query);
					$row = mysqli_fetch_array($result_tasks);
			 ?>
			 			 
		  
			<div class="card card-body">
				<form action="updatesuscription.php" method="POST"> 
					
					<div class="form-group">
						<input type="text" name="id" class="form-control" placeholder="id" autofocus value ="<?php echo $row['id'];?>" readonly></input><br>
					</div>
					<div class="form-group">
						<input type="text" name="active" class="form-control" placeholder="Usuario Activo" autofocus value ="<?php echo $row['active'];?>"></input><br>
					</div>
					<div class="form-group">
						<input name="suscriptionactive" class="form-control" placeholder="Suscripción Activa"><?php echo $row['suscriptionactive']?></input>
					</div>
					<div class="form-group">
						<input type="text" name="suscriptiondaysleft" class="form-control" placeholder="Suscription Days Used" value = "<?php echo $row['suscriptiondaysleft'];?>"  readonly></input><br>
					</div>
					<div class="form-group">
						<input type="text" name="suscriptionpayed" class="form-control" placeholder="Suscription Payed" value = "<?php echo $row['suscriptionpayed'];?>"></input><br>
					</div>
					<div class="form-group">
						<input type="text" name="lastsuscriptionpaymentdate" class="form-control" placeholder="Última Fecha de Pago" value = "<?php echo $row['lastsuscriptionpaymentdate']?>"></input><br>
					</div>
                    <div class="form-group">
						<input type="text" name="suscriptionkind" class="form-control" placeholder="Tipo de Suscripción" value = "<?php echo $row['suscriptionkind']?>"></input><br>
					</div>
					<input type="submit" class="btn btn-success btn-block" name="update_suscription" value="Actualizar Suscripción"></input>
					<input type="submit" class="btn btn-success btn-block" name="logout" value="Cancel" formaction="AppMgmt.php"></input>
				</form>
			</div>
		</div>
		
		<div class="col-md-8">
			<table class="table table-bordered">
				<thead>
				   <tr>
	                  <th>ID</th>
				      <th>Usuario Activo</th>
					  <th>Suscripción Activa</th>
					  <th>Dias usados de Suscripción</th>
					  <th>Suscripcion Pagada</th>
					  <th>Última fecha de pago Suscripción</th>
					  <th>Tipo de Suscripción</th>
				   </tr>
			    </thead>
				<tbody>
					<?php 
					$query1 = "select * from dailytasks_dailytask where completed = '0'  and id=$id";
					$result_tasks1 = mysqli_query($conn,$query1);
					while($row = mysqli_fetch_array($result_tasks1)) { ?>
					  <tr>
					    <td><?php echo $row['id'] ?></td>
						<td><?php echo $row['active'] ?></td>
						<td><?php echo $row['suscriptionactive'] ?></td>
						<td><?php echo $row['suscriptiondaysleft'] ?></td>
						<td><?php echo $row['suscriptionpayed'] ?></td>
						<td><?php echo $row['lastsuscriptionpaymentdate'] ?></td>
						<td><?php echo $row['suscriptionkind'] ?></td>
						</td>
					  </tr>
					<?php }?>
				<tbody>
			</table>
		</div>
	</div>
</div>    
</body>

