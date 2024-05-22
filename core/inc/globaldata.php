<?php // GLOBAL VARS FOR NOT LOGGED IN
	// $_SESSION['gloDomain'] 		= $gloDomain;
	// $_SESSION['gloAdminPath'] 	= $gloAdminPath;
	
    $gloSessionLife = 3600; // HOW LONG A SESSION LIVES (SECONDS)

	$gloNULL 		= "N/A";			// PRINT WHEN NULL
	$gloYear 		= date('Y');  			// YEAR NOW
	$gloNow			= date('Y-m-d');  		// DATE/TIME NOW							
	$gloTimeStamp	= strtotime("now"); 		// IF DB TIME SETTINGS IS WRONG EDIT HOURS HERE For example +2 Hours
	$gloNow2		= date('Y-m-d H:i', $gloTimeStamp); // DATE/TIME NOW from strtotime

	// ERROR CONTROLL IF RS IS EOF
	if (empty($gloSiteName)) { $gloSiteName = "DEMO"; }	
	
	$gloName = $gloSiteName;
	
	// GET PHP FILE
	$PHPFILE = basename($_SERVER['REQUEST_URI']);
	
	// GLOBAL VARS
	$gloIP			= getIP();	
		
	$gloLoaderIMG = "system/images/loader.gif";

?>