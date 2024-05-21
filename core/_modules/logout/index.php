<?php
	
	// *** ***********************
	// *** LOGOUT
	// *** ***********************

	session_start();
	$FOLDERNAME = $_SESSION['BRANDING'];
    $ActualAddress = $_SESSION['ACTUALURL'];
	
	$logouturl = "https://".$ActualAddress;

	unset($_SESSION['sys']);
    unset($_SESSION['ADMIN']);
    unset($_SESSION['UID']);
	unset($_SESSION['DefaultStartUsed']);

	session_unset();
	session_destroy();
	header("location: $logouturl");
	exit;
	
?>