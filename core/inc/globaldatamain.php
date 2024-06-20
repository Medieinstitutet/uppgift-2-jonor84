<?php
// GLOBAL VARS
$VERSION = '(v1.0l)';

$gloUseNewBingo = 1;
$gloUseNewCustomerzone = 0;

// Name of Resellers - if needed to change
$gloRTitle = "Återförsäljare"; // Reseller
$gloRTitleBIG = "ÅTERFÖRSÄLJARE"; // RESELLER
$gloRTitleS = "Återförsäljare"; // Resellers
$gloRTitleSBIG = "ÅTERFÖRSÄLJARE"; // RESELLERS
$gloRID = "ÅFID"; // RID - ResellerID

// USERS ARE NOT ALLOWED TO CREATE PAGES WITH SAME NAME THESE
$SYSTEMFOLDERS = array("system", "login", "core", "cpanel", "webmail", "admin", "directadmin", "test", "systemstart");

//Admin Footertext
$gloAdminFootertext = "&copy;" . $gloYear . " Moonserver AB";

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
$PHPFILE = basename($_SERVER['REQUEST_URI']); // GET PHP FILE

$_SESSION['gloDomain'] = $gloDomain;
$_SESSION['gloAdminPath'] = $gloAdminPath;

$gloNULL = "N/A"; // PRINT WHEN NULL
$gloMaxRows = 20; // NUMBER OF ROWS PER PAGE
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

// IF HALO SESSION
if ($_SESSION["service"] == "haloone") {
  $HALOSESSION = 1;
} else if ($_SESSION["service"] == "haloca") {
  $HALOSESSION = 1;
} else if ($_SESSION["service"] == "marketplace") {
  $HALOSESSION = 1;
} else {
  $HALOSESSION = 0;
}

// GET SITE SETTINGS FROM DATEBASE
include $gloDataFolder . "inc-global-sitesettings.php";

// INCLUDE PAGES/MENU AND APPS/MODULES
include $gloDataFolder . "inc-global-pages.php";

//if ( empty( $GETMODULE ) ) {
//  $GETMODULE = "profile";
//}

// GLOBAL LOGGED IN USER DATA
include $gloDataFolder . "inc-global-user.php";

// GLOBAL LOGGED IN USER/CLIENT DATA
include $gloDataFolder . "inc-global-client.php";

// GLOBAL LOGGED IN USER/RESELLER DATA
include $gloDataFolder . "inc-global-reseller.php";

// GLOBAL LOGGED IN USER/CLIENT SERVICES DATA
include $gloDataFolder . "inc-global-services.php";


//Check if group is editable by all users or not - will return: 1 / 0 (1 i s editable and 0 is not editable)
$GroupEditable = editableGroup($GETVIEW);
//Check if current user has access to this group
$UserAllowed = userAccessGroup($GETVIEW);
//Check if current reseller has access to this module
$ResellerAllowed = userAccessGroupReseller($gloResellerID);

//CHECK ACCESS
//Check if user is sysadmin
if ($SystemAdmin) {
  $gloModuleAccess = 1;
} else {
  //IF RESELLER IS ALLOWED (BRAND)
  if ($ResellerAllowed) {
    $gloModuleAccess = 1;
  } else {
    //IF USER IS ALLOWED
    if ($UserAllowed) {
      $gloModuleAccess = 1;
    } else {
      $gloModuleAccess = 0;
    }
  }
}

// GLOBAL CLASSES/ALERTS/BUTTONS DATA
include $gloDataFolder . "inc-global-alert-buttons.php";

// INCLUDE RANDOM QOUTES
include $gloDataFolder . 'rand_qoutes.php';
