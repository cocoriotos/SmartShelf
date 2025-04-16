<!DOCTYPE html>
<html lang="en">
<?php 
include "sessions.php";
include "sessionvalidation.php";
include "db_connection1.php";
include "headersuscription.php";
$local_username=$_SESSION['email'];
$suscriptiondue = $_SESSION['suscriptiondue']; 
//include "SessionTimeOut.php";
/*include "SessionTimeOut.php";*/

// Verificar si el usuario está autenticado (si $_SESSION['email'] está definido)
//if (!isset($_SESSION['email'])) {
    // Si no hay sesión, redirigir a la página de autenticación
//    header('Location: closetaskcon.php');
//    exit(); // Detener la ejecución del script
//}

// Si el usuario está autenticado, continuar con el resto del código
//$local_username = $_SESSION['email']; // Obtener el email del usuario desde la sesión
?>
<head>
  <link rel="icon" href="SSCircleBackgroundWhite.ico" type="image/x-icon">
  <link rel="stylesheet" href="style_sheet.css"/>
	<script src="Popper/popper.min.js"></script>
	<script src="plugins/sweetalert/sweetalert.min.js"></script>
	<script src="plugins/alertifyjs/alertify.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
</head>

<header>
    <script src="copynumber.js"></script>
    <script src="copypaypal.js"></script>
</header>  	
<body id="bodyadminmodule">
          <br><br>
  <div class="container1">
      <div class="column-wrap clearfix">
            <div class="col-xs-12">
                <hr>
            </div>
      <center><div class="col-xs-12 col-sm-12 column-custom-wrap">
                <div class="column-custom">
                    <h3 id="conditions" align="center" style="padding-bottom: 5px">Condiciones y Beneficios de Uso de la Aplicación</h3>
                    <!--<p> Video paso a paso del uso de la aplicación. Click Aquí</p><br>-->
                    <br>
                    <center><p style="color: blue; font-weight: bold; font-size: 24px;"> Ventajas </p></center>
                    <p > Gracias por haber usado la herramienta o la versión gratuita de 15 días calendario de la biblioteca de Contenidos Útiles la cuál te ayuda a: </p><br>
                    <p> 1. Etiquetar con una breve descripción del contenido para que puedas hacer las búsquedas más facilmente</p>
                    <p> 2. Tener todos tus enlaces importantes, indistinto de cual plataforma sea, donde la búsqueda la haces en un solo sitio</p>
                    <p> 3. La búsqueda de un enlace en cualquier histórico o favoritos en las aplicaciones, que normalmente toma mucho tiempo encontrarla, la harás en segundos en tu bliblioteca porque las tendrás en un solo lugar y con un motor de búsqueda efectivo</p>
                    <p> 4. Abrir el enlace directamente para ver los contenidos</p>
                    <p> 5. Copiar los Enlaces guardados para compartirlos</p>
					          <br>
                    <center><p style="color: blue; font-weight: bold; font-size: 24px;"> Condiciones </p></center>
                    <br>
                    <p> 1. No incluir información sensitiva ni personal. No nos hacemos responsables del salvaguardar o uso de su información por terceros</p>
                    <p> 2. Tratamiento de los datos bajo la modalidad de Habeas Data</p>
                    <p> 3. No nos responsabilizamos por información que incite a la violencia física, psicológica, delitos informáticos o cualquier manifestación delictiva</p>
                    <p> 4. Opciones de valores por Suscripción: </p>
                    <p><span class="destacado">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$20.000</span> Pesos Colombianos COP por Tres Meses</p>
                    <p><span class="destacado">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$40.000</span> Pesos Colombianos COP por Seis Meses</p>
                    <p><span class="destacado">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$60.000</span> Pesos Colombianos COP por un Año</p>
                    <p> 5. Al momento de no renovación de suscripción y no querer continuar con el servicios, dispondrá de máximos 3 meses calendario para solicitar sean enviados sus enlaces e información asociados a ellos en archivo CSV. Hacer la solicitud al correo al correo <a href="mailto:adm@solicionespro.com">adm@solicionespro.com</a> y recibirá la información al correo registrado del usuario en la página</p>
                    <br>
                    <center><p style="color: blue; font-weight: bold; font-size: 24px;"> Forma de Pago de Suscripción y Subcategorías</p></center>
                    <p> 1. Pago por Nequi al número +57 305 4293185 o PayPal al YSXRZMT2AAG4G.</p> 
                    <p> 2. Tomar una imagen por cada uno de los pagos realizados y convertirlas a formato PDF</p>
                    <p> 3. Al realizar el pago dar click en el botón de abajo para enviar correo el archivo PDF o una imagen del pago realizado.</p>
                    <p> 4. Si tiene alguna duda, enviar correo al administrador: adm@solicionespro.com o WhatsApp: +57 3054293185</p>
				        </div>
          </div>
          </center>
          <hr>
      </div>    
  </div>

  <div class="col-md-12">
					<br>
				<!--<?php /*include("search.php") */?>-->
				<div class="card card-body">
				<center><label for="description" class="col-form-label" style="color: black; font-size: 28px;"><strong> Resúmen de tu estado de cuenta </strong></label></center>

              <table id="autosearch" class="display" font color="back">
                  <thead id="tableswhite">
                  <tr>
                  <th>Usuario</th>
                    <th>Fecha de último Pago</th>
                    <th>Fecha inicial de acceso </th>
                    <th>Tipo Suscripcion</th>
                    <th>Paquete de Suscripcion</th>
                    <th>Días Usados de Suscripción</th>
                    <!--<th>Descargar Documento</th>-->
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $query1 = "select * from videotips_app_access_list where active = '1' and username ='$local_username'";
                    $result_links = mysqli_query($conn,$query1);
                    while($links = mysqli_fetch_array($result_links)) { ?>
                    <tr>
                      <td align="center"><?php echo $links['username']?></td>
                      <td align="center"><?php echo $links['lastsuscriptionpaymentdate'] ?></td>
                      <td align="center"><?php echo $links['registrationdate'] ?></td>
                      <td align="center"><?php echo $links['suscriptionkind'] ?></td>
                      <td align="center"><?php echo $links['suscription_package'] ?></td>
                      <td align="center"><?php echo $links['suscriptiondaysleft'] ?></td>
                      </td>
                    </tr>
                    <?php }?>
                  <tbody>
                </table>
                <br>
                <center><a href="mailto:adm@solicionespro.com?subject=Evidencia%20Pago%20Suscripción.&body=Hola,%20adjunto%20evidencia%20del%20pago%20de%20la%20suscripción%20a%20nombre%20de%20<?php echo urlencode($local_username); ?>.">        
                <input type="button" class="btn btn-success btn-block" style="color: white; font-weight: bold; font-size: 24px;" value="Enviar Constancia de Pago por Correo"></a></center>

                <!--<center><input type="submit" class="btn btn-success btn-block" name="save_link" value="Agregar Constancia de Pago"></input></center>-->
        </div>
  </div>
</body>

<?php
if ($suscriptiondue == 1) {
    
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Has alcanzado el límite de 15 días de uso gratuito y/o tu Suscripción está vencida. Te invitamos a renovarla por medio nuestros canales de Nequi  para Colombia o Paypayl para Internacional',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 5000, // 5000 milisegundos = 5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
          // Aquí puedes agregar cualquier acción que desees realizar cuando la alerta se cierre
        }
      });
    });
  </script>";
    $_SESSION['suscriptiondue'] = 0;
}
?>
</html>