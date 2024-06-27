<?php
// if($_SERVER["HTTPS"] != "on")
// {
//     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
//     exit();
// }

	ob_start();
	session_start();
	
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
		
	// Get essential files
	include_once("core/mysqli.php");
	include_once("core/settings.php");
	// include_once("core/func.php");
	// include_once("core/globaldata.php");
	// include_once("core/branding.php");
	require_once('core/vendor/autoload.php');

	// START TEMPLATE
		//include $gloTemplateDir."/auth/$gloBrandTemplateLogin/index.php";

	echo "hello world ";
	echo $gloDomain;


	ob_end_flush();
?>