<?php
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

ob_start();
session_start();

$BRAND = "mailboy";
	
if (!$BRAND) { echo "EMPTY"; } else {
	//IF BRAND FOUND RUN APPLICATION

	// global variable - if logged in or not 
	$LOGGEDIN = false;

	// DEBUG
	error_reporting(1);
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	ini_set('display_errors', 1);
		
	// LOCAL SETTINGS
	setlocale(LC_ALL, 'sv_SE');
	date_default_timezone_set("Europe/Stockholm");  
		
	// GET MYSQL
	include_once("./core/mysqli.php");

	// GET SETTINGS
	include_once("./core/settings.php");

	// GET FUNCTIONS
	include_once("./core/inc/func.php");
			
	// GET GLOBAL DATA
	include_once("./core/inc/globaldata.php");

	// INCLUDE BRANDING
	include_once("./core/inc/branding.php");

	// GET VENDOR
	require_once('./core/vendor/autoload.php');

	// START WITH HTML FOR PAGE
		// INCLUDE LOGIN THEME
		include "./$gloTemplateDir/auth/$gloBrandTemplateLogin/index.php";

	ob_end_flush();
}
?>