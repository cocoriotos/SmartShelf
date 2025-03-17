<!-- Developed by Julián González Bucheli -->
<html>
<?php
include "sessions.php";
include "sessionvalidation.php";
include "headermgmt.php";
include "db_connection1.php";
//include "nobackpage.php"; 
//include "SessionTimeOut.php";
// Verificar si el usuario está autenticado (si $_SESSION['email'] está definido)
//if (!isset($_SESSION['email'])) {
  // Si no hay sesión, redirigir a la página de autenticación
//  header('Location: closetaskcon.php');
//  exit(); // Detener la ejecución del script
//}

// Si el usuario está autenticado, continuar con el resto del código
$local_username = $_SESSION['email']; // Obtener el email del usuario desde la sesión

/*Sync daysleft */
$query4 = "update videotips_app_access_list SET suscriptiondaysleft = DATEDIFF(CURDATE(), lastsuscriptionpaymentdate)";
$result4 = mysqli_query($conn, $query4);

/*Consulta para contar los usuarios suscritos*/
$query = "SELECT COUNT(suscriptionpayed) as total_suscriptions FROM videotips_app_access_list WHERE suscriptionpayed = 1 and suscriptionkind = 'De Pago'";
$result = mysqli_query($conn, $query);

$query1 = "SELECT COUNT(active) as active_users FROM videotips_app_access_list WHERE active = 1";
$result1 = mysqli_query($conn, $query1);

$query2 = "SELECT COUNT(*) as suscriptionstodue FROM videotips_app_access_list WHERE (active = 1 and suscriptionpayed = 1 and suscriptiondaysleft > 335 and suscriptionkind = 'De Pago')";
$result2 = mysqli_query($conn, $query2);

$query3 = "SELECT COUNT(*) as pendingaccess FROM videotips_accessrequests WHERE (processed = 'No'and granted = 'No')";
$result3 = mysqli_query($conn, $query3);

$query5 = "SELECT COUNT(*) as monthsuscriptions FROM videotips_app_access_list  WHERE  365-suscriptiondaysleft between 0 and 30";
$result5 = mysqli_query($conn, $query5);

$query6 = "SELECT COUNT(*) as twosuscriptions FROM videotips_app_access_list  WHERE  365-suscriptiondaysleft between 31 and 60";
$result6 = mysqli_query($conn, $query6);

$query7 = "SELECT COUNT(*) as trisuscriptions FROM videotips_app_access_list  WHERE  365-suscriptiondaysleft between 61 and 90";
$result7 = mysqli_query($conn, $query7);

$query8 = "SELECT COUNT(*) as fouruscriptions FROM videotips_app_access_list  WHERE  365-suscriptiondaysleft between 91 and 120";
$result8 = mysqli_query($conn, $query8);

$query9 = "SELECT COUNT(*) as fivesuscriptions FROM videotips_app_access_list  WHERE  365-suscriptiondaysleft between 121 and 150";
$result9 = mysqli_query($conn, $query9);

$query10 = "SELECT COUNT(*) as sixsuscriptions FROM videotips_app_access_list  WHERE  365-suscriptiondaysleft between 151 and 180";
$result10 = mysqli_query($conn, $query10);

$query11 = "SELECT COUNT(*) as sevensuscriptions FROM videotips_app_access_list  WHERE  365-suscriptiondaysleft between 181 and 210";
$result11 = mysqli_query($conn, $query11);

$query12 = "SELECT COUNT(*) as eightsuscriptions FROM videotips_app_access_list  WHERE  365-suscriptiondaysleft between 211 and 240";
$result12 = mysqli_query($conn, $query12);

$query13 = "SELECT COUNT(*) as ninesuscriptions FROM videotips_app_access_list  WHERE  365-suscriptiondaysleft between 241 and 270";
$result13 = mysqli_query($conn, $query13);

$query14 = "SELECT COUNT(*) as tensuscriptions FROM videotips_app_access_list  WHERE  365-suscriptiondaysleft between 271 and 300";
$result14 = mysqli_query($conn, $query14);

$query15 = "SELECT COUNT(*) as elevensuscriptions FROM videotips_app_access_list  WHERE  365-suscriptiondaysleft between 301 and 330";
$result15 = mysqli_query($conn, $query15);

$query16 = "SELECT COUNT(*) as twelvesuscriptions FROM videotips_app_access_list  WHERE  365-suscriptiondaysleft between 331 and 366";
$result16 = mysqli_query($conn, $query16);



if (($result) && ($result1)) {
    $row = mysqli_fetch_assoc($result);
    $total_suscriptions = $row['total_suscriptions'];
    $row1 = mysqli_fetch_assoc($result1);
    $active_users = $row1['active_users'];
    $row2 = mysqli_fetch_assoc($result2);
    $suscriptionstodue = $row2['suscriptionstodue'];
    $row3 = mysqli_fetch_assoc($result3);
    $pendingaccess = $row3['pendingaccess'];
    $row5 = mysqli_fetch_assoc($result5);
    $monthsuscriptions = $row5['monthsuscriptions'];
    $row6 = mysqli_fetch_assoc($result6);
    $twosuscriptions = $row6['twosuscriptions'];
    $row7 = mysqli_fetch_assoc($result7);
    $threesuscriptions = $row7['threesuscriptions'];
    $row8 = mysqli_fetch_assoc($result8);
    $foursuscriptions = $row8['foursuscriptions'];
    $row9 = mysqli_fetch_assoc($result9);
    $fivesuscriptions = $row8['fivesuscriptions'];
    $row10 = mysqli_fetch_assoc($result10);
    $sixsuscriptions = $row8['sixsuscriptions'];
    $row11 = mysqli_fetch_assoc($result11);
    $sevensuscriptions = $row8['sevensuscriptions'];
    $row12 = mysqli_fetch_assoc($result12);
    $eightsuscriptions = $row8['eightsuscriptions'];
    $row13 = mysqli_fetch_assoc($result13);
    $ninesuscriptions = $row8['ninesuscriptions'];
    $row14 = mysqli_fetch_assoc($result14);
    $tensuscriptions = $row8['tensuscriptions'];
    $row15 = mysqli_fetch_assoc($result15);
    $elevensuscriptions = $row8['elevensuscriptions'];
    $row16 = mysqli_fetch_assoc($result16);
    $twelvesuscriptions = $row8['twelvesuscriptions'];
    

    
} else {
    $total_suscriptores = 0; // En caso de error, mostrar 0
    $usuarios_activos = 0;
    $suscriptionstodue = 0;
    $pendingaccess = 0;
    $monthtoduesuscriptions = 0;
    $twomothtoduesuscriptions = 0;
    $trimothtoduesuscriptions = 0;
    $fourmothtoduesuscriptions = 0;
    $fivementhoduesuscriptions = 0;
    $sixmenthoduesuscriptions = 0;
    $sevenmenthoduesuscriptions = 0;
    $eightmenthoduesuscriptions = 0;
    $ninefivementhoduesuscriptions = 0;
    $tenmenthoduesuscriptions = 0;
    $elevementhoduesuscriptions = 0;
    $twelvemonthoduesuscriptions = 0;
}

// Verificar si el usuario está autenticado (si $_SESSION['email'] está definido)
if (!isset($_SESSION['email'])) {
  // Si no hay sesión, redirigir a la página de autenticación
  header('Location: closetaskcon.php');
  exit(); // Detener la ejecución del script
}

// Si el usuario está autenticado, continuar con el resto del código
$local_username = $_SESSION['email']; // Obtener el email del usuario desde la sesión
?>

<head>
    <script src="head.js" defer></script>
    <script src="Linktoclipboard.js" defer></script>
    <link rel="icon" href="SSCircleBackgroundWhite.ico" type="image/x-icon">
    <link rel="stylesheet" href="style_sheet_ops.css" />
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
    <div class="container-fluid">
        <!-- Barra de navegación -->
        
        <!-- Pestañas -->
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Operaciones')" id="defaultOpen">Operaciones</button>
            <button class="tablinks" onclick="openTab(event, 'Administracion')">Administración</button>
            <button class="tablinks" onclick="openTab(event, 'Reportes')">Reportes y Estadísticas</button>
        </div>

        <!-- Contenido de las pestañas -->
        <div id="Operaciones" class="tabcontent">
            <label class="col-form-label">Operaciones</label>
            <div class="grid-container">
                <div class="grid-item">
                    <div class="grid-item-content">
                        <div class="grid-item-header">
                            <div class="grid-item-title">Listado de Suscripciones</div>
                        </div>
                        <div class="grid-item-body">
                            <p class="p-title">Total Suscripciones:</p>
                            <center><p class="p-content"><?php echo $total_suscriptions; ?></p></center>
                            <a href="#" class="btn-primary">Ver Detalles</a>
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="grid-item-content">
                        <div class="grid-item-header">
                            <div class="grid-item-title">Suscripciones por Usuario</div>
                        </div>
                        <div class="grid-item-body">
                            <p class="p-title">Usuarios Activos:</p>
                            <center><p class="p-content"><?php echo $active_users; ?></p></center>
                            <a href="#" class="btn-primary">Ver Detalles</a>
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="grid-item-content">
                        <div class="grid-item-header">
                            <div class="grid-item-title">Habilitación de Acceso</div>
                        </div>
                        <div class="grid-item-body">
                            <p class="p-title">Accesos Pendientes:</p>
                            <center><p class="p-content"><?php echo $pendingaccess; ?></p></center>
                            <a href="#" class="btn-primary">Ver Detalles</a>
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="grid-item-content">
                        <div class="grid-item-header">
                            <div class="grid-item-title">Suscripciones por Vencer</div>
                        </div>
                        <div class="grid-item-body">
                            <p class="p-title">A Un Mes:</p>
                            <center><p class="p-content"><?php echo $monthtoduesuscriptions; ?></p></center>
                            <p class="p-title">A Dos Meses:</p>
                            <center><p class="p-content"><?php echo $twomothtoduesuscriptions; ?></p></center>
                            <p class="p-title">A Tres Meses:</p>
                            <center><p class="p-content"><?php echo $trimothtoduesuscriptions; ?></p></center>
                            <p class="p-title">A Cuatro Meses:</p>
                            <center><p class="p-content"><?php echo $fourmothtoduesuscriptions; ?></p></center>
                            <p class="p-title">A Cinco Meses:</p>
                            <center><p class="p-content"><?php echo $fivementhoduesuscriptions; ?></p></center>
                            <p class="p-title">A Seis Meses:</p>
                            <center><p class="p-content"><?php echo $sixmenthoduesuscriptions; ?></p></center>
                            <p class="p-title">A Siete Meses:</p>
                            <center><p class="p-content"><?php echo $sevenmenthoduesuscriptions; ?></p></center>
                            <p class="p-title">A Ocho Meses:</p>
                            <center><p class="p-content"><?php echo $eightmenthoduesuscriptions; ?></p></center>
                            <p class="p-title">A Nueve Meses:</p>
                            <center><p class="p-content"><?php echo $ninefivementhoduesuscriptions; ?></p></center>
                            <p class="p-title">A Diez Meses:</p>
                            <center><p class="p-content"><?php echo $tenmenthoduesuscriptions; ?></p></center>
                            <p class="p-title">A Once Meses:</p>
                            <center><p class="p-content"><?php echo $elevementhoduesuscriptions; ?></p></center>
                            <p class="p-title">A Doce Meses:</p>
                            <center><p class="p-content"><?php echo $twelvemonthoduesuscriptions; ?></p></center>
                            <a href="#" class="btn-primary">Ver Detalles</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="Administracion" class="tabcontent">
            <label class="col-form-label">Administración</label>
            <div class="grid-container">
                <div class="grid-item">
                    <div class="grid-item-content">
                        <div class="grid-item-header">
                            <div class="grid-item-title">Visitas de Usuarios</div>
                        </div>
                        <div class="grid-item-body">
                            <p class="p-title">Visitas Hoy:</p>
                            <p class="p-content">120</p>
                            <a href="#" class="btn-primary">Ver Detalles</a>
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="grid-item-content">
                        <div class="grid-item-header">
                            <div class="grid-item-title">Envío de Correos Masivos</div>
                        </div>
                        <div class="grid-item-body">
                            <p class="p-title">Plantilla de Correo:</p>
                            <p class="p-content">Promoción Especial</p>
                            <a href="#" class="btn-primary">Enviar Correo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="Reportes" class="tabcontent">
            <label class="col-form-label">Reportes y Estadísticas</label>
            <div class="grid-container">
                <div class="grid-item">
                    <div class="grid-item-content">
                        <div class="grid-item-header">
                            <div class="grid-item-title">Reporte de Suscripciones</div>
                        </div>
                        <div class="grid-item-body">
                            <p class="p-title">Total Suscripciones:</p>
                            <p class="p-content">500</p>
                            <a href="#" class="btn-primary">Generar Reporte</a>
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="grid-item-content">
                        <div class="grid-item-header">
                            <div class="grid-item-title">Estadísticas de Visitas</div>
                        </div>
                        <div class="grid-item-body">
                            <p class="p-title">Visitas Totales:</p>
                            <p class="p-content">10,000</p>
                            <a href="#" class="btn-primary">Ver Estadísticas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para abrir pestañas
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Abrir la pestaña por defecto al cargar la página
        document.getElementById("defaultOpen").click();
    </script>
</body>

</html>