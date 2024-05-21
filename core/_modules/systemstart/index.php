<?php
	
	// *** ***********************
	// *** OPEN SYSTEMSTART
	// *** ***********************

	$gloBrandStartAppOne = $_SESSION[ "DefaultStart" ];

	if (!$gloBrandStartAppOne) { $gloBrandStartAppOne = "dashboard"; }
	if ($gloBrandStartAppOne == "default") { $gloBrandStartAppOne = "dashboard"; }

        $_SESSION["THEME"] = "default";
		$_SESSION['BRANDING'] = $_SESSION['MAINBRANDING'];

		header("Refresh:0; url=/$gloBrandStartAppOne");
	   
	
?>