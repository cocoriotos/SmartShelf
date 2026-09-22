<?php
include "sessions.php";
$timeout_duration = 900;
$sessiontimeoutreached = $_SESSION['sessiontimeoutreached'];


if (isset($_SESSION['LAST_ACTIVITY'])) {
    $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];
    if ($elapsed_time > $timeout_duration) {
        $_SESSION['sessiontimeoutreached'] = 1;
        include("closetaskscon.php");
        include("videotrackerauth.php");
    }
}
$_SESSION['LAST_ACTIVITY'] = time();
?>