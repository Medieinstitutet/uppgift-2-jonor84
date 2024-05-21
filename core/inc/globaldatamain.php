<?php
// GLOBAL VARS for logged in
$VERSION = '(v1.0)';

// Name of Resellers - if needed to change
$gloRTitle = "Återförsäljare"; // Reseller
$gloRTitleBIG = "ÅTERFÖRSÄLJARE"; // RESELLER
$gloRTitleS = "Återförsäljare"; // Resellers
$gloRTitleSBIG = "ÅTERFÖRSÄLJARE"; // RESELLERS
$gloRID = "ÅFID"; // RID - ResellerID

//Admin Themepath
$gloAdminThemePath = "theme/";
//Admin Footertext
$gloAdminFootertext = "&copy;" . $gloYear . " JN";

$gloUID = $_SESSION['UID'];
$gloADMINSESSION = $_SESSION['ADMIN'];
$gloSessionID = $_SESSION['SID'];

$gloULifetime = date("Y-m-d H:i:s", $_SESSION['ULIFETIME']);
$gloUActive = date("Y-m-d H:i:s", $_SESSION['UACTIVE']);
$gloSID = session_id();
$gloIP = getIP();
$PHPFILE = basename($_SERVER['REQUEST_URI']); // GET PHP FILE

$_SESSION['gloDomain'] = $gloDomain;
$_SESSION['gloAdminPath'] = $gloAdminPath;

$gloNULL = "N/A"; // PRINT WHEN NULL
$gloYear = date('Y'); // YEAR NOW
$gloNow = date('Y-m-d H:i'); // DATE/TIME NOW			
$gloNowS = date('Y-m-d H:i:s'); // DATE/TIME NOW	with seconds..						

$gloTimeStamp = strtotime("now"); // IF DB TIME SETTINGS IS WRONG EDIT HOURS HERE For example +2 Hours
$gloNow2 = date('Y-m-d H:i', $gloTimeStamp); // DATE/TIME NOW from strtotime
$gloNowYMD = date('Y-m-d'); // DATENOW													

// IF FULL WINDOW
if ($_SESSION['WINDOW']) {
  $gloWindow = 1;
} else {
  $gloWindow = 0;
}

// IF ADMIN SESSION SHOW ADMIN MODE
if ($gloADMINSESSION) {
  if ($gloUID == $gloADMINSESSION) {
    $SHOWADMINMODE = 0;
  } else {
    $SHOWADMINMODE = 1;
  }
}

// GLOBAL LOGGED IN USER DATA
include $gloDataFolder . "inc-global-user.php";

//CHECK ACCESS
//Check if user is sysadmin
if ($SystemAdmin) {
  $gloModuleAccess = 1;
} else {
    //IF USER IS ALLOWED
    if ($UserAllowed) {
      $gloModuleAccess = 1;
    } else {
      $gloModuleAccess = 0;
    }
}

// GLOBAL CLASSES/ALERTS/BUTTONS DATA
include $gloDataFolder . "inc-global-alert-buttons.php";

// INCLUDE RANDOM QOUTES
include $gloDataFolder . 'rand_qoutes.php';
