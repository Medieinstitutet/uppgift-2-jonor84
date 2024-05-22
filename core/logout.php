<?php
	
	// *** ***********************
	// *** LOGOUT
	// *** ***********************

	//session_regenerate_id(true);
	session_start();
	$FOLDERNAME = $_SESSION['BRANDING'];
    $ActualAddress = $_SESSION['ACTUALURL'];
	
	$logouturl = "https://".$ActualAddress;

    unset($_SESSION[ "gloCurrentClient" ]);
    unset($_SESSION[ "rs" ]);
    unset($_SESSION[ "sys" ]);
    unset($_SESSION['ADMIN']);
    unset($_SESSION['UID']);
    unset($_SESSION['bingon']);
    unset($_SESSION['site']);
    unset($_SESSION['customerzone']);
	unset($_SESSION['DefaultStartUsed']);
	unset($_SESSION['LANG']);

	session_unset();
	session_destroy();

	header("location: $logouturl");
	exit;
	
?>