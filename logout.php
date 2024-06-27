<?php
	
	// *** ***********************
	// *** LOGOUT
	// *** ***********************

	session_start();

    unset($_SESSION['gloCurrentClient']);
    unset($_SESSION['sys']);
    unset($_SESSION['ADMIN']);
    unset($_SESSION['UID']);

	session_unset();
	session_destroy();

	header("location: index.php");
	exit;
	
?>