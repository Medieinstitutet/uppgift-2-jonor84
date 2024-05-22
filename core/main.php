<?php
// global variable - if logged in or not 
$LOGGEDIN = true;

// DEBUG
error_reporting(0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 0);

// LOCAL SETTINGS 
setlocale(LC_ALL, 'sv_SE');
date_default_timezone_set("Europe/Stockholm");

// GET MYSQL
include_once("mysqli.php");

// GET SETTINGS
include_once("settings.php");

// GET SESSION 
include_once "inc/session.php";

// GET FUNCTIONS 
include_once "inc/func.php";

// GET GLOBAL DATA 
include "inc/globaldatamain.php";

// GET VENDOR
require_once("vendor/autoload.php");

//CHECK IF LOGGED IN 
if ($blnAuthed = true) {

	// Turn on OutputBuffering, so no header is set to early for redirect
	ob_start();

	// INCLUDE BRANDING
	include_once("inc/branding.php");
	// INCLUDE SERVICENAME
	include_once("inc/servicename.php");

	if (!$_SESSION["service"]) {
		$_SESSION["THEME"] = $gloBrandTemplateMain;
	}

	$CURRENTTHEME = $_SESSION["THEME"];
	$MAXWINDOW = $_SESSION["w"];

	// START WITH THEME
	include $gloTemplateDir."/main/".$CURRENTTHEME."/index.php";

	// Include modals
	include_once "inc/modals.php";

	ob_end_flush();
}
