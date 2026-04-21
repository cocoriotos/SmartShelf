<?php 
	include "sessions.php";
    session_start();
	session_unset();
	session_destroy();
	include "sessionvalidation.php";
?>