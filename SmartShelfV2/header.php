<!DOCTYPE html>
<?php
include "sessions.php";
include "sessionvalidation.php";
/*include "SessionTimeOut.php";*/
$name = $_SESSION['name'];
?>
<head>    
    <link rel="stylesheet" href="style_sheet_ops.css"/>
</head>
<html lang="us"> 
  <header>
  <nav class="navbar navbar-dark bg-dark d-flex justify-content-center" id="welcome" >
  <center><a id="welcome"  class="navbar-brand"><span class="username-style"><?php echo $name; ?></span>, éstas en tu Biblioteca de Contenidos Útiles</a></center>
  </nav>
  <script src="copynumber.js"></script>
  <script src="copypaypal.js"></script>

  <nav class="navbar navbar-dark bg-dark d-flex justify-content-between align-items-center">
      <div class="d-flex flex-wrap flex-grow-1">
        <a id="headerfonts" href="suscriptionpayment.php" class="btn" style="background-color: #d0fff8; color: black; font-weight: bold;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Suscribirse</a>
        <a id="headerfonts" href="https://www.youtube.com/playlist?list=PLRQ5KF9igtB2GRlHLSP6Uwx1lzy387Wz5" class="btn" target="_blank" style="background-color: white; color: #c4302b; font-weight: bold;"><i class="fa fa-youtube-play" aria-hidden="true"></i> Tutoriales</a>
        <a id="headerfonts" href="UCLToolManualDelUsuario2025.pdf" class="btn" target="_blank" style="background-color: white; color: black; font-weight: bold;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Manual</a>
      
        <a id="headerfonts" href="videolinkadminmodule.php" class="btn" style="background-color: #FFF9CC; color: black; font-weight: bold;"><i class="fas fa-broom"></i> Limpiar Formulario</a>
        <a id="headerfonts" href="addcategory.php" class="btn" style="background-color: #D6EEFF; color: black; font-weight: bold;"><i class="fas fa-layer-group"></i> Categorías</a>
        <a id="headerfonts" href="closetaskscon.php" class="btn btn-danger" style="background-color: #9A97F5; color: black; font-weight: bold;"><i class="fas fa-sign-out-alt"></i> Salir</a>
      </div>
  </nav>


  <!-- BOOTSTRAP -->	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></link>
    <script src="https://kit.fontawesome.com/60f0db780e.js" crossorigin="anonymous"></script>
	</header>
  <br>
    </html>