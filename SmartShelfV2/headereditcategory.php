<!DOCTYPE html>
<?php
include "sessions.php";
include "sessionvalidation.php";
$name = $_SESSION['name'];
?>
<html lang="us">
<head>    
    <link rel="stylesheet" href="style_sheet_ops.css"/>
</head>
<header>
<nav class="navbar navbar-dark bg-dark d-flex justify-content-center" id="welcome">
<center><a id="welcome"  class="navbar-brand"><span class="username-style"><?php echo $name; ?></span>, éstas en tu Biblioteca de Contenidos Útiles</a></center>
</nav>

<nav class="navbar navbar-dark bg-dark d-flex justify-content-between align-items-center">
     
      <div class="header-action-group">
          <a id="headerfonts" href="videolinkadminmodule.php" class="header-action-btn clear"><i class="fas fa-reply"></i> Adicionar Enlace</a>
          <a id="headerfonts" href="addcategory.php" class="header-action-btn categories"><i class="fas fa-folder-tree"></i> Categorías</a>  
          <a id="headerfonts" href="closetaskscon.php" class="header-action-btn logout"><i class="fas fa-right-from-bracket"></i> Salir</a>
      </div>
</nav>
  <!-- BOOTSTRAP -->	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></link>
    <script src="https://kit.fontawesome.com/60f0db780e.js" crossorigin="anonymous"></script>
	</header>
    </html>