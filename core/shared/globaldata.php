<?php // GLOBAL VARS FOR NOT LOGGED IN
	$gloNULL 		= "N/A";			// PRINT WHEN NULL
	$gloYear 		= date('Y');  			// YEAR NOW
	$gloNow			= date('Y-m-d');  		// DATE/TIME NOW							
	$gloTimeStamp	= strtotime("now"); 		// IF DB TIME SETTINGS IS WRONG EDIT HOURS HERE For example +2 Hours
	$gloNow2		= date('Y-m-d H:i', $gloTimeStamp); // DATE/TIME NOW from strtotime
	
	// GLOBAL VARS
	$gloIP			= getIP();	
?>