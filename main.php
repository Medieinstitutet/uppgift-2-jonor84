<?php
// DEBUG
error_reporting(0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 0);

// LOCAL SETTINGS 
setlocale(LC_ALL, 'sv_SE');
date_default_timezone_set("Europe/Stockholm");

ob_start();

// Get essential files
include_once("mysqli.php");
include_once("settings.php");
include_once("inc/session.php");
// include_once("inc/func.php");
include("inc/globaldatamain.php");
require_once("vendor/autoload.php");
include_once("inc/branding.php");
include_once("inc/servicename.php");

//CHECK IF LOGGED IN 
if ($blnAuthed = true) {

	// START WITH TEMPLATE
	// include $gloTemplateDir."/main/default/index.php";

	echo "logged in <br>";
	echo "<a href='logout.php'>Logout</a>";


	// Include modals
	include_once "inc/modals.php";

	ob_end_flush();
}
