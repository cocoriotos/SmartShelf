<?php 
include "sessions.php";
include "sessionvalidation.php";
$id = $_GET['id'];
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

<body id="bodyadminmodule" style="padding: 0%;">	
<div class="container p-4">
	<div class="row">
		<div class="col-md-4">
		     		 
			 <?php 
					$query = "select id, username, active, suscriptionactive, suscriptiondaysleft, suscriptionpayed, lastsuscriptionpaymentdate, suscriptionkind  from videotips_app_access_list where  id='$id'";
					$result_tasks = mysqli_query($conn,$query);
					$row = mysqli_fetch_array($result_tasks);
			 ?>
			 			 
		  
			<div class="card card-body">
				<form action="updatesuscription.php" method="POST"> 
					
					<div class="form-group">
                        <a>ID</a><br>
						<input type="text" name="id" class="form-control" placeholder="id" autofocus value ="<?php echo $row['id'];?>" readonly></input><br>
					</div>
                    <div class="form-group">
                        <a>Usuario</a><br>
						<input type="text" name="id" class="form-control" placeholder="username" autofocus value ="<?php echo $row['username'];?>" readonly></input><br>
					</div>
					<div class="form-group">
                        <a>Usuario Activo</a><br>
						<select name="active" class="form-control" autofocus><?php $query = "SELECT active FROM videotips_active"; $result = mysqli_query($conn, $query); while ($usuarioActivo = mysqli_fetch_assoc($result)) {$active = $usuarioActivo['active']; $selected = ($active == $row['active']) ? 'selected' : ''; echo "<option value='$active' $selected>$active</option>";}?></select>
						<!--<input type="text" name="active" class="form-control" placeholder="Usuario Activo" autofocus value ="<?php /*echo $row['active'];*/?>"></input><br>-->
					</div>
					<div class="form-group">
                        <a>Suscripción Activa</a><br>
						<select name="suscriptionactive" class="form-control" autofocus><?php $query = "SELECT active FROM videotips_active"; $result = mysqli_query($conn, $query); while ($suscriptionactive = mysqli_fetch_assoc($result)) {$active = $suscriptionactive['active']; $selected = ($active == $row['suscriptionactive']) ? 'selected' : ''; echo "<option value='$active' $selected>$active</option>";}?></select>
						<!--<input type="text" name="suscriptionactive" class="form-control" placeholder="Suscripción Activa" value = "<?php /*echo $row['suscriptionactive']*/?>"></input><br>-->
					</div>
					<div class="form-group">
                        <a>Días usados de suscripción</a><br>
						<input type="text" name="suscriptiondaysleft" class="form-control" placeholder="Dias de suscripción usados" value = "<?php echo $row['suscriptiondaysleft'];?>"  readonly></input><br>
					</div>
					<div class="form-group">
                        <a>Suscripción Pagada</a><br>
						<input type="text" name="suscriptionpayed" class="form-control" placeholder="Suscripción Pagada" value = "<?php echo $row['suscriptionpayed'];?>"></input><br>
					</div>
					<div class="form-group">
                        <a>Última Fecha de Pago</a><br>
						<input type="date" name="lastsuscriptionpaymentdate" class="form-control" placeholder="Última Fecha de Pago" value = "<?php echo $row['lastsuscriptionpaymentdate']?>"></input><br>
					</div>
                    <div class="form-group">
                        <a>Tipo de Suscripción</a><br>
						<select name="suscriptionkind" class="form-control" autofocus><?php $query = "SELECT suscriptionkind FROM videotips_suscriptionkind order by suscriptionkind desc"; $result = mysqli_query($conn, $query); while ($suscriptionkind = mysqli_fetch_assoc($result)) {$suscriptionkind = $suscriptionkind['suscriptionkind']; $selected = ($suscriptionkind == $row['suscriptionkind']) ? 'selected' : ''; echo "<option value='$suscriptionkind' $selected>$suscriptionkind</option>";}?></select>
						<!--<input type="text" name="suscriptionkind" class="form-control" placeholder="Tipo de Suscripción" value = "<?php /*echo $row['suscriptionkind']*/?>"></input><br>-->
					</div>
					<input type="submit" class="btn btn-success btn-block" name="update_suscription" value="Actualizar Suscripción"></input>
					<input type="submit" class="btn btn-success btn-block" name="logout" value="Cancel" formaction="AppMgmt.php"></input>
				</form>
			</div>
		</div>
    </div>	
</div>    
</body>

