<!-- Developed by Julián González Bucheli -->
<html>
<?php 
    include "sessions.php";
    include "sessionvalidation.php";
    $local_username = $_SESSION['email'];
    $savedcategory = $_SESSION['savedcategory'];
    $duplicatedcategory = $_SESSION['duplicatedcategory'];
    $sessiontimeoutreached = $_SESSION['sessiontimeoutreached'];
    $updatedcategory = $_SESSION['updatedcategory'];
    $deletedcategory = $_SESSION['deletedcategory'];
    include "headercategory.php";
    include "db_connection1.php";
?>
<head>	
    <script src="head.js" defer></script>		
    <script src="categorytoclipboard.js" defer></script>  
    <link rel="stylesheet" href="style_sheet_ops.css"/>
	<script src="Popper/popper.min.js"></script>
    <script src="plugins/sweetalert/sweetalert.min.js"></script>
    <script src="plugins/alertifyjs/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css" />
</head>
<body id="bodyadminmodule" style="padding: 0%;">
    <div class="container-fluid p-0">
        <div class="row justify-content-start" style="padding: 0%; width: 100%;">
            <div class="col-md-12"> 
                <div class="card card-body">
                    <form action="savecategory.php" method="POST">
                        <center><label for="title" class="col-form-label" style="color: black; font-size: 28px;"><strong>Adicionar Categoría y Subcategoría</strong></label></center><br>
                        <div class="row justify-content-center">
                            <div class="form-group col-md-4">
                                <label for="maincategory" class="col-form-label" style="color: black;"><strong>Categoría</strong></label><br>	
                                <input class="form-control" style="text-align: center;" id="maincategory" type="text" name="maincategory" placeholder="Digite la Categoría Principal" required><br>
                            </div><br>
                            <div class="form-group col-md-4">
                                <label for="category" class="col-form-label" style="color: black;"><strong>Subcategoría</strong></label><br>	
                                <input class="form-control" style="text-align: center;" id="category" type="text" name="category" placeholder="Digite la SubCategoría" required><br> 
                            </div>	
                        </div>
                        <center><input id="save_link" type="submit" class="btn btn-success btn-block" name="add filter" value="Adicionar Categoría"></center><br>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <br>
                <center><?php include("search.php") ?></center>
                <div class="card card-body">
                    <div class="grid-container">
                        <?php 
                            $query1 = "select * from videotips_viodetipscategory where username ='$local_username' order by id, maincategory, category asc";
                            $result_categories = mysqli_query($conn, $query1);
                            while($categories = mysqli_fetch_array($result_categories)) { 
                                $randomColor = getRandomLightColor();		  
                        ?>
                        <div class="grid-item" style="background-color: <?php echo $randomColor; ?>;">
                            <button class="grid-item-action-btn" style="color: black; font-size: 40px; font-weight: bold;" onclick="toggleActions(event, <?php echo $categories['id']; ?>)">...</button>	
                            <div class="grid-item-actions">
                                <div class="grid-item-action-menu" id="action-menu-<?php echo $categories['id']; ?>">
                                    <button style="background: white; color: green; font-size: 12px;" onclick="copyToClipboard('<?php echo $categories['maincategory']; ?>'); toggleActions(event, <?php echo $categories['id']; ?>);" class="btn btn-secondary">Copiar Categoría</button>
                                    <button style="background: white; color: green; font-size: 12px;" onclick="copyToClipboard('<?php echo $categories['category']; ?>'); toggleActions(event, <?php echo $categories['id']; ?>);" class="btn btn-secondary">Copiar Subcategoría</button>
                                    <button style="background: white; color: gray; font-size: 12px;" onclick="window.location.href = 'editcategory.php?id=<?php echo $categories['id']; ?>'" class="btn btn-secondary">Modificar</button>
                                    <button style="background: white; color: red; font-size: 12px;" onclick="confirmDelete(<?php echo $categories['id']; ?>)" class="btn btn-secondary">Borrar</button>
                                </div>
                            </div>
                            <div class="grid-item-header"></div>
                            <span class="grid-item-title" style="color: blue"><?php echo $categories['content']; ?></span>
                            <div class="grid-item-body">
                                <p><span class="p-title">Categoría:</span><span class="p-content"><?php echo $categories['maincategory']; ?></span></p>
                                <p><span class="p-title">Subcategoría:</span><span class="p-content"><?php echo $categories['category']; ?></span></p>
                            </div>
                        </div> 
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
<script>
    function toggleActions(event, id) {
        event.stopPropagation(); // Evita que el evento de clic se propague al documento
        var actionMenu = document.getElementById("action-menu-" + id);
        if (actionMenu.style.display === "block") {
            actionMenu.style.display = "none";
        } else {
            // Cerrar todos los menús abiertos antes de abrir uno nuevo
            var allMenus = document.querySelectorAll('.grid-item-action-menu');
            allMenus.forEach(function(menu) {
                menu.style.display = "none";
            });
            actionMenu.style.display = "block";
        }
    }

	// Cerrar el menú al hacer clic fuera de él
    document.addEventListener('click', function(event) {
        var allMenus = document.querySelectorAll('.grid-item-action-menu');
        var isClickInside = false;

        allMenus.forEach(function(menu) {
            // Verificar si el clic fue dentro del menú
            if (menu.contains(event.target)) {
                isClickInside = true;
            }
        });

        if (!isClickInside) {
            allMenus.forEach(function(menu) {
                menu.style.display = "none";
            });
        }
    });

	function confirmDelete(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#032642',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                content: 'custom-swal-content',
                confirmButton: 'custom-swal-confirm-button',
                cancelButton: 'custom-swal-cancel-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, redirigir a delete.php con el ID
                window.location.href = "deletecategory.php?id=" + id;
            } else {
                // Si el usuario cancela, no hacer nada
                Swal.fire({
                    title: 'Cancelado',
                    text: 'El elemento no fue borrado.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        popup: 'custom-swal-popup',
                        title: 'custom-swal-title',
                        content: 'custom-swal-content',
                        confirmButton: 'custom-swal-confirm-button'
                    }
                });
            }
        });
    }

</script>
<?php
   if ($savedcategory == 1) {

	echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Subcategoría Adicionada Exitosamente',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1000, // 1000 milisegundos = 1 segundo
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
 	 </script>"; 
    $_SESSION['savedcategory'] = 0;
}

if ($savedcategory == 2 ) {

	echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Hubo un problema al adicionar la subcategoría, intente nuevamente',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
 	 </script>"; 
	$_SESSION['savedcategory'] = 0;
}

if ($duplicatedcategory == 1) {

	echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Subcategoría duplicada, usar otra',
        icon: 'error',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
 	 </script>"; 
    $_SESSION['duplicatedcategory'] = 0;
}

if ($FreeSubcateryReached == 1) {

	echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Ha alcanzado el límite de 5 subcategorías gratis. Para continuar subcategorizando puede usar el botón de Pago por Nequi para adquirir las subcategorías, leer muy bien los términos y condiciones',
        icon: 'warning',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
        timerProgressBar: true, // Muestra una barra de progreso
        didOpen: () => {
          Swal.showLoading(); // Muestra un indicador de carga
        },
        willClose: () => {
        }
      });
    });
 	 </script>"; 
    $_SESSION['FreeSubcateryReached'] = 0;
}

if ($sessiontimeoutreached  == 1){

	echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Mensaje',
        text: 'Detectada que la sesion no tiene actividad por más de 15 minutos, debe iniciar sesión nuevamente',
        icon: 'warning',
        confirmButtonText: 'Aceptar',
        customClass: {
          popup: 'custom-swal-popup',
          title: 'custom-swal-title',
          content: 'custom-swal-content',
          confirmButton: 'custom-swal-confirm-button'
        },
        timer: 1500, // 1500 milisegundos = 1.5 segundos
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
	
	if ($updatedcategory == 1) {

		echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
		Swal.fire({
			title: 'Mensaje',
			text: 'Subcategoría Actualizada Exitosamente',
			icon: 'success',
			confirmButtonText: 'Aceptar',
			customClass: {
			popup: 'custom-swal-popup',
			title: 'custom-swal-title',
			content: 'custom-swal-content',
			confirmButton: 'custom-swal-confirm-button'
			},
			timer: 1500, // 1500 milisegundos = 1.5 segundos
			timerProgressBar: true, // Muestra una barra de progreso
			didOpen: () => {
			Swal.showLoading(); // Muestra un indicador de carga
			},
			willClose: () => {
			}
		});
		});
		</script>"; 
		$_SESSION['updatedcategory'] = 0;
	}
	
	if ($updatedcategory == 2){

		echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
		Swal.fire({
			title: 'Mensaje',
			text: 'Hubo un problema al actualizar la subcategoría, intente nuevamente',
			icon: 'error',
			confirmButtonText: 'Aceptar',
			customClass: {
			popup: 'custom-swal-popup',
			title: 'custom-swal-title',
			content: 'custom-swal-content',
			confirmButton: 'custom-swal-confirm-button'
			},
			timer: 1500, // 1500 milisegundos = 1.5 segundos
			timerProgressBar: true, // Muestra una barra de progreso
			didOpen: () => {
			Swal.showLoading(); // Muestra un indicador de carga
			},
			willClose: () => {
			}
		});
		});
		</script>";  
	$_SESSION['updatedcategory'] = 0;
	}
	
	
	if ($deletedcategory == 1) {

		echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
		Swal.fire({
			title: 'Mensaje',
			text: 'Categoría Borrada satisfactoriamente',
			icon: 'Success',
			confirmButtonText: 'Aceptar',
			customClass: {
			popup: 'custom-swal-popup',
			title: 'custom-swal-title',
			content: 'custom-swal-content',
			confirmButton: 'custom-swal-confirm-button'
			},
			timer: 1500, // 1500 milisegundos = 1.5 segundos
			timerProgressBar: true, // Muestra una barra de progreso
			didOpen: () => {
			Swal.showLoading(); // Muestra un indicador de carga
			},
			willClose: () => {
			}
		});
		});
		</script>"; 
		$_SESSION['deletedcategory'] = 0;
	}
	
	if ($deletedcategory == 2){
		
		echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
		Swal.fire({
			title: 'Mensaje',
			text: 'Hubo un problema al borrar subcategoría, intente nuevamente',
			icon: 'error',
			confirmButtonText: 'Aceptar',
			customClass: {
			popup: 'custom-swal-popup',
			title: 'custom-swal-title',
			content: 'custom-swal-content',
			confirmButton: 'custom-swal-confirm-button'
			},
			timer: 1500, // 1500 milisegundos = 1.5 segundos
			timerProgressBar: true, // Muestra una barra de progreso
			didOpen: () => {
			Swal.showLoading(); // Muestra un indicador de carga
			},
			willClose: () => {
			}
		});
		});
		</script>"; 
	$_SESSION['deletedcategory'] = 0;
	}
?>
<?php 
    function getRandomLightColor() {
        $red = rand(200, 255);
        $green = rand(200, 255);
        $blue = rand(200, 255);
        return sprintf("#%02x%02x%02x", $red, $green, $blue);
    }
?>
</html>