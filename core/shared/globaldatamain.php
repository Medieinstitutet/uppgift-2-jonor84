<?php
// GLOBAL VARS
$VERSION = '(v1.02)';

$gloUID = $_SESSION['UID'];
$gloADMINSESSION = $_SESSION['ADMIN'];
$gloSessionID = $_SESSION['SID'];

$gloIDLinkPID = $_SESSION['storep'];
$gloIDLinkCID = $_SESSION['storec'];
$gloIDLinkST = $_SESSION['support'];

$gloULifetime = date("Y-m-d H:i:s", $_SESSION['ULIFETIME']);
$gloUActive = date("Y-m-d H:i:s", $_SESSION['UACTIVE']);
$gloSID = session_id();
$gloIP = getIP();

$_SESSION['gloDomain'] = $gloDomain;
$_SESSION['gloAdminPath'] = $gloAdminPath;

$gloYear = date('Y'); // YEAR NOW
$gloNow = date('Y-m-d H:i'); // DATE/TIME NOW			
$gloNowS = date('Y-m-d H:i:s'); // DATE/TIME NOW	with seconds..						
$gloTimeStamp = strtotime("now"); // IF DB TIME SETTINGS IS WRONG EDIT HOURS HERE For example +2 Hours
$gloNow2 = date('Y-m-d H:i', $gloTimeStamp); // DATE/TIME NOW from strtotime
$gloNowYMD = date('Y-m-d'); // DATENOW													

// IF ADMIN SESSION SHOW ADMIN MODE
if ($gloADMINSESSION) {
  if ($gloUID == $gloADMINSESSION) {
    $SHOWADMINMODE = 0;
  } else {
    $SHOWADMINMODE = 1;
  }
}

// // GLOBAL LOGGED IN USER DATA
// include $gloDataFolder . "inc-global-user.php";

// // GLOBAL LOGGED IN USER/CLIENT DATA
// include $gloDataFolder . "inc-global-client.php";

// // GLOBAL LOGGED IN USER/RESELLER DATA
// include $gloDataFolder . "inc-global-reseller.php";

// // GLOBAL LOGGED IN USER/CLIENT SERVICES DATA
// include $gloDataFolder . "inc-global-services.php";

// // GLOBAL CLASSES/ALERTS/BUTTONS DATA
// include $gloDataFolder . "inc-global-alert-buttons.php";
