<!-- Developed by Julián González Bucheli -->
<html>
<?php
include "sessions.php";
include "sessionvalidation.php";
include "headermgmt.php";
include "db_connection1.php";
//include "nobackpage.php"; 
include "SessionTimeOut.php";
// Verificar si el usuario está autenticado (si $_SESSION['email'] está definido)
if (!isset($_SESSION['email'])) {
  // Si no hay sesión, redirigir a la página de autenticación
  header('Location: closetaskcon.php');
  exit(); // Detener la ejecución del script
}

// Si el usuario está autenticado, continuar con el resto del código
$local_username = $_SESSION['email']; // Obtener el email del usuario desde la sesión

/*Sync daysleft */

$query20="UPDATE videotips_app_access_list SET suscriptiondaysleft = DATEDIFF(CURDATE(), registrationdate), trialdaysleft = DATEDIFF(CURDATE(), registrationdate)"; 
$result20=mysqli_query($conn, $query20);

$query4 = "UPDATE videotips_app_access_list SET suscriptiondaysleft = DATEDIFF(CURDATE(), lastsuscriptionpaymentdate), trialdaysleft = DATEDIFF(CURDATE(), registrationdate)";
$result4 = mysqli_query($conn, $query4);

/*Consulta para contar los usuarios suscritos*/
$query = "SELECT COUNT(suscriptionpayed) as total_suscriptions FROM videotips_app_access_list WHERE suscriptionpayed = 1 and suscriptionkind = 'De Pago'";
$result = mysqli_query($conn, $query);

/*$query1 = "SELECT COUNT(active) as active_users FROM videotips_app_access_list WHERE active = 1 and suscriptionpayed = 1 and suscriptiondaysleft > 0 and suscriptionkind <> 'De Pago'";
$result1 = mysqli_query($conn, $query1);*/

$query1 = "SELECT COUNT(active) as active_users FROM videotips_app_access_list WHERE suscriptionkind <> 'De Pago'";
$result1 = mysqli_query($conn, $query1);

$query2 = "SELECT COUNT(*) as suscriptionstodue FROM videotips_app_access_list WHERE (active = 1 and suscriptionpayed = 1 and suscriptiondaysleft > 335 and suscriptionkind = 'De Pago')";
$result2 = mysqli_query($conn, $query2);

$query3 = "SELECT COUNT(*) as pendingaccess FROM videotips_accessrequests WHERE (processed = 'No'and granted = 'No')";
$result3 = mysqli_query($conn, $query3);

$query5 = "SELECT COUNT(*) as monthsuscriptions FROM videotips_app_access_list  WHERE  suscriptionkind = 'De Pago' and (365-suscriptiondaysleft between 0 and 30)";
$result5 = mysqli_query($conn, $query5);

$query6 = "SELECT COUNT(*) as twosuscriptions FROM videotips_app_access_list  WHERE suscriptionkind = 'De Pago' and (365-suscriptiondaysleft between 31 and 60)";
$result6 = mysqli_query($conn, $query6);

$query7 = "SELECT COUNT(*) as threesuscriptions FROM videotips_app_access_list  WHERE suscriptionkind = 'De Pago' and (365-suscriptiondaysleft between 61 and 90)";
$result7 = mysqli_query($conn, $query7);

$query8 = "SELECT COUNT(*) as foursuscriptions FROM videotips_app_access_list  WHERE suscriptionkind = 'De Pago' and (365-suscriptiondaysleft between 91 and 120)";
$result8 = mysqli_query($conn, $query8);

$query9 = "SELECT COUNT(*) as fivesuscriptions FROM videotips_app_access_list  WHERE suscriptionkind = 'De Pago' and (365-suscriptiondaysleft between 121 and 150)";
$result9 = mysqli_query($conn, $query9);

$query10 = "SELECT COUNT(*) as sixsuscriptions FROM videotips_app_access_list  WHERE suscriptionkind = 'De Pago' and (365-suscriptiondaysleft between 151 and 180)";
$result10 = mysqli_query($conn, $query10);

$query11 = "SELECT COUNT(*) as sevensuscriptions FROM videotips_app_access_list  WHERE suscriptionkind = 'De Pago' and (365-suscriptiondaysleft between 181 and 210)";
$result11 = mysqli_query($conn, $query11);

$query12 = "SELECT COUNT(*) as eightsuscriptions FROM videotips_app_access_list  WHERE suscriptionkind = 'De Pago' and (365-suscriptiondaysleft between 211 and 240)";
$result12 = mysqli_query($conn, $query12);

$query13 = "SELECT COUNT(*) as ninesuscriptions FROM videotips_app_access_list  WHERE suscriptionkind = 'De Pago' and (365-suscriptiondaysleft between 241 and 270)";
$result13 = mysqli_query($conn, $query13);

$query14 = "SELECT COUNT(*) as tensuscriptions FROM videotips_app_access_list  WHERE suscriptionkind = 'De Pago' and (365-suscriptiondaysleft between 271 and 300)";
$result14 = mysqli_query($conn, $query14);

$query15 = "SELECT COUNT(*) as elevensuscriptions FROM videotips_app_access_list  WHERE suscriptionkind = 'De Pago' and (365-suscriptiondaysleft between 301 and 330)";
$result15 = mysqli_query($conn, $query15);

$query16 = "SELECT COUNT(*) as twelvesuscriptions FROM videotips_app_access_list  WHERE suscriptionkind = 'De Pago' and (365-suscriptiondaysleft between 331 and 366)";
$result16 = mysqli_query($conn, $query16);

$query17 = "UPDATE videotips_app_access_list SET suscriptionpayed = 0 WHERE trialdaysleft  > 16 and suscriptionkind = 'Trial'";
$result17 = mysqli_query($conn, $query17);

$query18 = "UPDATE videotips_app_access_list a JOIN (SELECT username, COUNT(*) AS link_count FROM videotips_videotips GROUP BY username) v ON a.username = v.username SET a.linksquantity = v.link_count";
$result18 = mysqli_query($conn, $query18);

$query19 = "SELECT COUNT(*) as monthsuscriptionsnopayed FROM videotips_app_access_list  WHERE  suscriptionkind <> 'De Pago' and (365-suscriptiondaysleft between 0 and 30)";
$result19 = mysqli_query($conn, $query19);

$query21 = "SELECT COUNT(*) as twosuscriptionsnopayed FROM videotips_app_access_list  WHERE suscriptionkind <> 'De Pago' and (365-suscriptiondaysleft between 31 and 60)";
$result21 = mysqli_query($conn, $query21);

$query22 = "SELECT COUNT(*) as threesuscriptionsnopayed FROM videotips_app_access_list  WHERE suscriptionkind <> 'De Pago' and (365-suscriptiondaysleft between 61 and 90)";
$result22 = mysqli_query($conn, $query22);

$query23 = "SELECT COUNT(*) as foursuscriptionsnopayed FROM videotips_app_access_list  WHERE suscriptionkind <> 'De Pago' and (365-suscriptiondaysleft between 91 and 120)";
$result23= mysqli_query($conn, $query23);

$query24 = "SELECT COUNT(*) as fivesuscriptionsnopayed FROM videotips_app_access_list  WHERE suscriptionkind <> 'De Pago' and (365-suscriptiondaysleft between 121 and 150)";
$result24 = mysqli_query($conn, $query24);

$query25 = "SELECT COUNT(*) as sixsuscriptionsnopayed FROM videotips_app_access_list  WHERE suscriptionkind <> 'De Pago' and (365-suscriptiondaysleft between 151 and 180)";
$result25 = mysqli_query($conn, $query25);

$query26 = "SELECT COUNT(*) as sevensuscriptionsnopayed FROM videotips_app_access_list  WHERE suscriptionkind <> 'De Pago' and (365-suscriptiondaysleft between 181 and 210)";
$result26 = mysqli_query($conn, $query26);

$query27 = "SELECT COUNT(*) as eightsuscriptionsnopayed FROM videotips_app_access_list  WHERE suscriptionkind <> 'De Pago' and (365-suscriptiondaysleft between 211 and 240)";
$result27 = mysqli_query($conn, $query27);

$query28 = "SELECT COUNT(*) as ninesuscriptionsnopayed FROM videotips_app_access_list  WHERE suscriptionkind <> 'De Pago' and (365-suscriptiondaysleft between 241 and 270)";
$result28 = mysqli_query($conn, $query28);

$query29 = "SELECT COUNT(*) as tensuscriptionsnopayed FROM videotips_app_access_list  WHERE suscriptionkind <> 'De Pago' and (365-suscriptiondaysleft between 271 and 300)";
$result29 = mysqli_query($conn, $query29);

$query30 = "SELECT COUNT(*) as elevensuscriptionsnopayed FROM videotips_app_access_list  WHERE suscriptionkind <> 'De Pago' and (365-suscriptiondaysleft between 301 and 330)";
$result30 = mysqli_query($conn, $query30);

$query20 = "SELECT COUNT(*) as twelvesuscriptionsnopayed FROM videotips_app_access_list  WHERE suscriptionkind <> 'De Pago' and (365-suscriptiondaysleft between 331 and 366)";
$result20 = mysqli_query($conn, $query20);

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
    $fivesuscriptions = $row9['fivesuscriptions'];
    $row10 = mysqli_fetch_assoc($result10);
    $sixsuscriptions = $row10['sixsuscriptions'];
    $row11 = mysqli_fetch_assoc($result11);
    $sevensuscriptions = $row11['sevensuscriptions'];
    $row12 = mysqli_fetch_assoc($result12);
    $eightsuscriptions = $row12['eightsuscriptions'];
    $row13 = mysqli_fetch_assoc($result13);
    $ninesuscriptions = $row13['ninesuscriptions'];
    $row14 = mysqli_fetch_assoc($result14);
    $tensuscriptions = $row14['tensuscriptions'];
    $row15 = mysqli_fetch_assoc($result15);
    $elevensuscriptions = $row15['elevensuscriptions'];
    $row16 = mysqli_fetch_assoc($result16);
    $twelvesuscriptions = $row16['twelvesuscriptions'];
    $row19 = mysqli_fetch_assoc($result19);
    $monthsuscriptionsnopayed = $row19['monthsuscriptionsnopayed'];
    $row21 = mysqli_fetch_assoc($result21);
    $twosuscriptionsnopayed = $row21['twosuscriptionsnopayed'];
    $row22 = mysqli_fetch_assoc($result22);
    $threesuscriptionsnopayed = $row22['threesuscriptionsnopayed'];
    $row23 = mysqli_fetch_assoc($result23);
    $foursuscriptionsnopayed = $row23['foursuscriptionsnopayed'];
    $row24 = mysqli_fetch_assoc($result24);
    $fivesuscriptionsnopayed = $row24['fivesuscriptionsnopayed'];
    $row25 = mysqli_fetch_assoc($result25); 
    $sixsuscriptionsnopayed = $row25['sixsuscriptionsnopayed'];
    $row26 = mysqli_fetch_assoc($result26);
    $sevensuscriptionsnopayed = $row26['sevensuscriptionsnopayed'];
    $row27 = mysqli_fetch_assoc($result27);
    $eightsuscriptionsnopayed = $row27['eightsuscriptionsnopayed'];
    $row28 = mysqli_fetch_assoc($result28);
    $ninesuscriptionsnopayed = $row28['ninesuscriptionsnopayed'];
    $row29 = mysqli_fetch_assoc($result29);
    $tensuscriptionsnopayed = $row29['tensuscriptionsnopayed'];
    $row30 = mysqli_fetch_assoc($result30);
    $elevensuscriptionsnopayed = $row30['elevensuscriptionsnopayed'];
    $row20 = mysqli_fetch_assoc($result20);
    $twelvesuscriptionsnopayed = $row20['twelvesuscriptionsnopayed'];

    
} else {
    $total_suscriptores = 0; // En caso de error, mostrar 0
    $usuarios_activos = 0;
    $suscriptionstodue = 0;
    $pendingaccess = 0;
    $monthsuscriptions = 0;
    $twosuscriptions = 0;
    $threesuscriptions = 0;
    $foursuscriptions = 0;
    $fivesuscriptions = 0;
    $sixsuscriptions = 0;
    $sevensuscriptions = 0;
    $eightsuscriptions = 0;
    $ninesuscriptions = 0;
    $tensuscriptions = 0;
    $elevensuscriptions = 0;
    $twelvesuscriptions = 0;
    $monthsuscriptionsnopayed = 0;
    $twosuscriptionsnopayed = 0;
    $threesuscriptionsnopayed = 0;
    $foursuscriptionsnopayed = 0;
    $fivesuscriptionsnopayed = 0;
    $sixsuscriptionsnopayed = 0;
    $sevensuscriptionsnopayed = 0;
    $eightsuscriptionsnopayed = 0;
    $ninesuscriptionsnopayed = 0;
    $tensuscriptionsnopayed = 0;
    $elevensuscriptionsnopayed = 0;
    $twelvesuscriptionsnopayed = 0;
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
                    <button class="tablinks" onclick="openTab(event, 'Ops')" id="defaultOpen">Operaciones</button>
                    <button class="tablinks" onclick="openTab(event, 'Administration')">Administración</button>
                    <!--<button class="tablinks" onclick="openTab(event, 'Reports')">Reportes y Estadísticas</button>-->
                </div>
    
                <!-- Contenido de las pestañas -->
                <div id="Ops" class="tabcontent">
                    <div class="grid-container">
                        <div class="grid-item">
                            <div class="grid-item-content">
                                <div class="grid-item-header">
                                    <div class="grid-item-title">Listado de Suscripciones</div>
                                </div>
                                <div class="grid-item-body">
                                    <p class="p-title">Total Suscripciones De Pago:</p>
                                    <center><p class="p-content" style="font-size: 42px;"><?php echo $total_suscriptions; ?></p></center>
                                    <a class="btn-primary" onclick="openTab(event, 'opstotalsuscriptions')">Ver Detalles</a> 
                                </div>
                            </div>
                        </div>
                        <div class="grid-item">
                            <div class="grid-item-content">
                                <div class="grid-item-header">
                                    <div class="grid-item-title">Suscripciones De Pago:</div>
                                </div>
                                    <p class="p-title"><span class="left-text"> 1 Mes:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($monthsuscriptions < 8) ? 'green' : (($monthsuscriptions >= 9 && $monthsuscriptions <= 10) ? 'orange' : ($monthsuscriptions == 11 ? 'red' : '')); ?>"><?php echo $monthsuscriptions; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 2 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($twosuscriptions < 8) ? 'green' : (($twosuscriptions >= 9 && $twosuscriptions <= 10) ? 'orange' : ($twosuscriptions == 11 ? 'red' : '')); ?>"><?php echo $twosuscriptions; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 3 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($threesuscriptions < 8) ? 'green' : (($threesuscriptions >= 9 && $threesuscriptions <= 10) ? 'orange' : ($threesuscriptions == 11 ? 'red' : '')); ?>"><?php echo $threesuscriptions; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 4 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($foursuscriptions < 8) ? 'green' : (($foursuscriptions >= 9 && $foursuscriptions <= 10) ? 'orange' : ($foursuscriptions == 11 ? 'red' : '')); ?>"><?php echo $foursuscriptions; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 5 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($fivesuscriptions < 8) ? 'green' : (($fivesuscriptions >= 9 && $fivesuscriptions <= 10) ? 'orange' : ($fivesuscriptions == 11 ? 'red' : '')); ?>"><?php echo $fivesuscriptions; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 6 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($sixsuscriptions < 8) ? 'green' : (($sixsuscriptions >= 9 && $sixsuscriptions <= 10) ? 'orange' : ($sixsuscriptions == 11 ? 'red' : '')); ?>"><?php echo $sixsuscriptions; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 7 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($sevensuscriptions  < 8) ? 'g reen' : (($sevensuscriptions >= 9 && $sevensuscriptions <= 10) ? 'orange' : ($sevensuscriptions == 11 ? 'red' : '')); ?>"><?php echo $sevensuscriptions; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 8 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($eightsuscriptions < 8) ? 'green' : (($eightsuscriptions >= 9 && $eightsuscriptions <= 10) ? 'orange' : ($eightsuscriptions == 11 ? 'red' : '')); ?>"><?php echo $eightsuscriptions; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 9 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($ninesuscriptions < 8) ? 'green' : (($ninesuscriptions >= 9 && $ninesuscriptions <= 10) ? 'orange' : ($ninesuscriptions == 11 ? 'red' : '')); ?>"><?php echo $ninesuscriptions; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 10 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($tensuscriptions < 8) ? 'green' : (($tensuscriptions >= 9 && $tensuscriptions <= 10) ? 'orange' : ($tensuscriptions == 11 ? 'red' : '')); ?>"><?php echo $tensuscriptions; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 11 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($elevensuscriptions < 8) ? 'green' : (($elevensuscriptions >= 9 && $elevensuscriptions <= 10) ? 'orange' : ($elevensuscriptions == 11 ? 'red' : '')); ?>"><?php echo $elevensuscriptions; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 12 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($twelvesuscriptions < 8) ? 'green' : (($twelvesuscriptions >= 9 && $twelvesuscriptions <= 10) ? 'orange' : ($twelvesuscriptions == 11 ? 'red' : '')); ?>"><?php echo $twelvesuscriptions; ?></span></span></p>
                                    <!--<a href="#" class="btn-primary">Ver Detalles</a>-->
                            </div>
                        </div>
                        <div class="grid-item">
                            <div class="grid-item-content">
                                <div class="grid-item-header">
                                    <div class="grid-item-title">Listado de Suscripciones</div>
                                </div>
                                <div class="grid-item-body">
                                    <p class="p-title">Total Suscripciones De No Pago:</p>
                                    <center><p class="p-content" style="font-size: 42px;"><?php echo $active_users; ?></p></center>
                                    <a class="btn-primary" onclick="openTab(event, 'opsactives')">Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid-item">
                            <div class="grid-item-content">
                                <div class="grid-item-header">
                                    <div class="grid-item-title">Suscripciones No Pago:</div>
                                </div>
                                    <p class="p-title"><span class="left-text"> 1 Mes:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($monthsuscriptionsnopayed < 8) ? 'green' : (($monthsuscriptionsnopayed >= 9 && $monthsuscriptionsnopayed <= 10) ? 'orange' : ($monthsuscriptionsnopayed == 11 ? 'red' : '')); ?>"><?php echo $monthsuscriptionsnopayed; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 2 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($twosuscriptionsnopayed < 8) ? 'green' : (($twosuscriptionsnopayed >= 9 && $twosuscriptionsnopayed <= 10) ? 'orange' : ($twosuscriptionsnopayed == 11 ? 'red' : '')); ?>"><?php echo $twosuscriptionsnopayed; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 3 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($threesuscriptionsnopayed < 8) ? 'green' : (($threesuscriptionsnopayed >= 9 && $threesuscriptionsnopayed <= 10) ? 'orange' : ($threesuscriptionsnopayed == 11 ? 'red' : '')); ?>"><?php echo $threesuscriptionsnopayed; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 4 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($foursuscriptionsnopayed < 8) ? 'green' : (($foursuscriptionsnopayed >= 9 && $foursuscriptionsnopayed <= 10) ? 'orange' : ($foursuscriptionsnopayed == 11 ? 'red' : '')); ?>"><?php echo $foursuscriptionsnopayed; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 5 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($fivesuscriptionsnopayed < 8) ? 'green' : (($fivesuscriptionsnopayed >= 9 && $fivesuscriptionsnopayed <= 10) ? 'orange' : ($fivesuscriptionsnopayed == 11 ? 'red' : '')); ?>"><?php echo $fivesuscriptionsnopayed; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 6 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($sixsuscriptionsnopayed < 8) ? 'green' : (($sixsuscriptionsnopayed >= 9 && $sixsuscriptionsnopayed <= 10) ? 'orange' : ($sixsuscriptionsnopayed == 11 ? 'red' : '')); ?>"><?php echo $sixsuscriptionsnopayed; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 7 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($sevensuscriptionsnopayed  < 8) ? 'g reen' : (($sevensuscriptionsnopayed >= 9 && $sevensuscriptionsnopayed <= 10) ? 'orange' : ($sevensuscriptionsnopayed == 11 ? 'red' : '')); ?>"><?php echo $sevensuscriptionsnopayed; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 8 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($eightsuscriptionsnopayed < 8) ? 'green' : (($eightsuscriptionsnopayed >= 9 && $eightsuscriptionsnopayed <= 10) ? 'orange' : ($eightsuscriptionsnopayed == 11 ? 'red' : '')); ?>"><?php echo $eightsuscriptionsnopayed; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 9 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($ninesuscriptionsnopayed < 8) ? 'green' : (($ninesuscriptionsnopayed >= 9 && $ninesuscriptionsnopayed <= 10) ? 'orange' : ($ninesuscriptionsnopayed == 11 ? 'red' : '')); ?>"><?php echo $ninesuscriptionsnopayed; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 10 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($tensuscriptionsnopayed < 8) ? 'green' : (($tensuscriptionsnopayed >= 9 && $tensuscriptionsnopayed <= 10) ? 'orange' : ($tensuscriptionsnopayed == 11 ? 'red' : '')); ?>"><?php echo $tensuscriptionsnopayed; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 11 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($elevensuscriptionsnopayed < 8) ? 'green' : (($elevensuscriptionsnopayed >= 9 && $elevensuscriptionsnopayed <= 10) ? 'orange' : ($elevensuscriptionsnopayed == 11 ? 'red' : '')); ?>"><?php echo $elevensuscriptionsnopayed; ?></span></span></p>
                                    <p class="p-title"><span class="left-text"> 12 Meses:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="<?php echo ($twelvesuscriptionsnopayed < 8) ? 'green' : (($twelvesuscriptionsnopayed >= 9 && $twelvesuscriptionsnopayed <= 10) ? 'orange' : ($twelvesuscriptionsnopayed == 11 ? 'red' : '')); ?>"><?php echo $twelvesuscriptionsnopayed; ?></span></span></p>
                                    <!--<a href="#" class="btn-primary">Ver Detalles</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            

            <div id="Administration" class="tabcontent">
                    <label class="col-form-label"></label>
                    <div class="grid-container">
                        <div class="grid-item">
                                <div class="grid-item-content">
                                    <div class="grid-item-header">
                                        <div class="grid-item-title">Suscripciones</div>
                                    </div>
                                    <div class="grid-item-body">
                                        <p class="p-title">Usuarios a contactar</p>
                                        <p class="p-content">Inactivos</p>
                                        <a class="btn-primary" onclick="openTab(event, 'Suscriptions')">Listado de Usuarios</a>
                                    </div>
                                </div>
                        </div>
                        <!--<div class="grid-item">
                                   <div class="grid-item-content">
                                       <div class="grid-item-header">
                                           <div class="grid-item-title">Suscripciones</div>
                                       </div>
                                       <div class="grid-item-body">
                                           <p class="p-title">Renovaciones</p>
                                           <p class="p-content">Rehabilitar accesos</p>
                                           <a class="btn-primary" onclick="openTab(event, 'SuscriptionsRenewals')">Listado de Usuarios</a>
                                       </div>
                                   </div>
                        </div>-->

                        <div class="grid-item">
                                    <div class="grid-item-content">
                                        <div class="grid-item-header">
                                            <div class="grid-item-title">Visitas de Usuarios</div>
                                        </div>
                                        <div class="grid-item-body">
                                            <p class="p-title">Visitas:</p>
                                            <p class="p-content">Por fecha</p>
                                            <a class="btn-primary" onclick="openTab(event, 'adminvisits')">Listado de Usuarios</a>
                                        </div>
                                    </div>
                        </div>
                    </div>
            </div>

            <div id="adminvisits" class="tabcontent">
                <div class="grid-containeropstable">
                    <div class="grid-item1">
                        <div class="grid-item-content">
                            <div class="grid-item-header">
                                <div class="grid-item-title">Visitas por fecha | Administración</div>
                                <br>
                                <center style="width: 90%;"><?php include("searchvisits.php") ?></center> <!-- Incluir el buscador -->
                            </div>
                                <!-- Aquí va la tabla que listará los resultados -->
                                <table  id="inactiveUsersTable" border="1" cellpadding="5" cellspacing="0" class="user-table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Usuario</th>
                                            <th>Último Ingreso a la Plataforma </th>
                                            <th>Cantidad Links Guardados </th>
                                            <th>Tipo de Suscripción</th>
                                            <th>Modificar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Ejecutar la consulta
                                        $sql = "SELECT id, name, lastname, username, lastlogindate, suscriptionkind, linksquantity FROM videotips_app_access_list order by lastlogindate desc";
                                        $result = $conn->query($sql);

                                        // Mostrar los resultados en la tabla
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row['name'] . "</td>";
                                                echo "<td>" . $row['lastname'] . "</td>";
                                                echo "<td><a href='mailto:" . $row['username'] . "'>" . $row["username"] . "</a></td>";                                                
                                                echo "<td>" . $row['lastlogindate'] . "</td>";
                                                echo "<td>" . $row['linksquantity'] . "</td>"; 
                                                echo "<td>" . $row['suscriptionkind'] . "</td>";
                                                echo '<td><a href="editnodepagotrial.php?id=' . $row['id'] . '" class="btn btn-secondary"><i class="fas fa-marker"></i></a></td>';
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>No se encontraron resultados</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            
                        </div>
                    </div>
                </div>
            </div>


            <div id="Suscriptions" class="tabcontent">
                    <!--<label class="col-form-label"></label>-->
                    <div class="grid-containeropstable">
                        <div class="grid-item1">
                                <div class="grid-item-content1">
                                    <div class="grid-item-header">
                                                <div class="grid-item-title">Usuarios Inactivos | Administración</div>
                                                <br>
                                                <center style="width: 90%;"><?php include("searchvisits.php") ?></center> <!-- Incluir el buscador -->
                                    </div> 
                                        <table id="inactiveUsersTable" border="1" cellpadding="5" cellspacing="0" class="user-table">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Apellido</th>
                                                        <th>Usuario</th>
                                                        <th>Usuario Activo</th>
                                                        <th>Suscripción Activa</th>
                                                        <th>Tipo de Suscripción</th>
                                                        <th>Modificar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Consulta SQL
                                                    $sql = "SELECT id, name, lastname, username, active, suscriptionactive, suscriptionkind FROM videotips_app_access_list where active = 0 and suscriptionactive = 0 and (suscriptionkind = 'Trial' or suscriptionkind = 'De Pago')";
                                                    $result = $conn->query($sql);
                                                    // Mostrar los resultados en la tabla
                                                    if ($result->num_rows > 0) {
                                                        // Iterar a través de los resultados y mostrarlos en la tabla
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . $row['name'] . "</td>";
                                                            echo "<td>" . $row['lastname'] . "</td>";
                                                            echo "<td><a href='mailto:" . $row["username"] . "'>" . $row["username"] . "</a></td>";
                                                            echo "<td>" . ($row['active'] ? 'Sí' : 'No') . "</td>";
                                                            echo "<td>" . ($row['suscriptionactive'] ? 'Sí' : 'No'). "</td>";
                                                            echo "<td>" . $row['suscriptionkind'] . "</td>";
                                                            echo '<td><a href="edittrial.php?id=' . $row['id'] . '" class="btn btn-secondary"><i class="fas fa-marker"></i></a></td>';
                                                            echo "</tr>";
                                                            }   
                                                        } else {
                                                    echo "<tr><td colspan='7'>No hay usuarios activos</td></tr>";
                                                    }
                                                ?>
                                                </tbody>
                                        </table>
                                </div>
                        </div>
                    </div>
            </div> 


            <div id="opstotalsuscriptions" class="tabcontent">
                <div class="grid-containeropstable">
                    <div class="grid-item1" >
                        <div class="grid-item-content1">
                            <div class="grid-item-header">
                                <div class="grid-item-title">Suscriptores De Pago | Operación</div>
                                <br>
                                <center style="width: 90%;"><?php include("searchvisits.php") ?></center> <!-- Incluir el buscador -->
                            </div>
                                <!-- Aquí va la tabla que listará los resultados -->
                                <table id="inactiveUsersTable" border="1" style="width: 100%; margin-top: 20px; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Usuario</th>
                                            <th>Días de Suscripción Usados</th>
                                            <th>Modificar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Ejecutar la consulta
                                        $sql = "SELECT id, name, lastname, username, suscriptiondaysleft, suscriptionkind FROM videotips_app_access_list WHERE suscriptionkind = 'De Pago' order by suscriptiondaysleft desc  ";
                                        $result = $conn->query($sql);

                                        // Mostrar los resultados en la tabla
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["name"] . "</td>";
                                                echo "<td>" . $row["lastname"] . "</td>";
                                                echo "<td><a href='mailto:" . $row["username"] . "'>" . $row["username"] . "</a></td>";
                                                echo "<td>" . $row["suscriptiondaysleft"] . "</td>";
                                                echo '<td><a href="editdepago.php?id=' . $row['id'] . '" class="btn btn-secondary"><i class="fas fa-marker"></i></a></td>';
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No se encontraron resultados</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            
                        </div>
                    </div>
                </div>
            </div>   
            

            <div id="opsactives" class="tabcontent">
                    <label class="col-form-label"></label>
                    <div class="grid-containeropstable">
                        <div class="grid-item1">
                                <div class="grid-item-content1">
                                    <div class="grid-item-header">
                                                <div class="grid-item-title">Suscripciones por Usuario | Operación</div>
                                                <br>
                                                <center style="width: 90%;"><?php include("searchvisits.php") ?></center> <!-- Incluir el buscador -->
                                    </div> 
                                        <table id="inactiveUsersTable" border="1" cellpadding="5" cellspacing="0" class="user-table">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Apellido</th>
                                                        <th>Usuario</th>
                                                        <th>Fecha Registro</th>
                                                        <th>Ultimo Acceso</th>
                                                        <th>Días Corridos</th>
                                                        <th>Tipo de Suscripción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Consulta SQL
                                                    /*$sql = "SELECT name, lastname, username, suscriptionkind FROM videotips_app_access_list WHERE active = 1 order by suscriptionkind asc";*/
                                                    $sql = "SELECT name, lastname, username, suscriptionkind, registrationdate, lastlogindate, trialdaysleft FROM videotips_app_access_list WHERE suscriptionkind <> 'De Pago' order by trialdaysleft desc";
                                                    $result = $conn->query($sql);
                                                    // Mostrar los resultados en la tabla
                                                    if ($result->num_rows > 0) {
                                                        // Iterar a través de los resultados y mostrarlos en la tabla
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . $row['name'] . "</td>";
                                                            echo "<td>" . $row['lastname'] . "</td>";
                                                            echo "<td><a href='mailto:" . $row["username"] . "'>" . $row["username"] . "</a></td>";
                                                            echo "<td>" . $row['registrationdate'] . "</td>";
                                                            echo "<td>" . $row['lastlogindate'] . "</td>";
                                                            echo "<td>" . $row['trialdaysleft'] . "</td>";
                                                            echo "<td>" . $row['suscriptionkind'] . "</td>";
                                                            echo "</tr>";
                                                            }   
                                                        } else {
                                                    echo "<tr><td colspan='1'>No hay usuarios activos</td></tr>";
                                                    }
                                                ?>
                                                </tbody>
                                        </table>
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