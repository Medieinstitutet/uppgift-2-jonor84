<?
//Settings
$SysDomain = "https://mailboy.myhalo.se"; // WITH https://

$gloHome = "https://jonor84.moonserver.nu";

$LogoUrl = $SysDomain . "/public/logos/logo_ms_black.png"; //FOR EMAIL SENDINGS

$gloBase = "/"; // main.php?module= or / when .htaccess / mod_rewrite is active

$gloSessionLife = 1800; // HOW LONG A SESSION LIVES (SECONDS)

$gloDomain = "mailboy.myhalo.se"; // DOMAN SOM ADMIN UTGAR FRAN
$gloAdminPath = "/"; // PATH TO LOGIN

//Global system path
$gloSysPath = "/home/mhemsi31/domains/" . $gloDomain;
$gloSystemPath = $gloSysPath."/core";

//FOR EMAIL PURPOSES
$gloSysMail = 'send@myhalo.se'; // SYSTEM MAIL OUTGOING postmarkapp.com
$gloSysMailName = 'System'; // SYSTEM NAME OUTGOING
$gloSysNoReplyMail = 'send@myhalo.se'; // SYSTEM MAIL NOREPLY

//FOLDERS/PATHS HERE
if ($LOGGEDIN) { 
    $gloDataFolder = "shared/globaldata/";
    $gloFunctionsFolder = "shared/functions/";
} else { 
    $gloDataFolder = "core/shared/globaldata/";
    $gloFunctionsFolder = "core/shared/functions/";
}

$gloSharedFolder = "system"; // SET GLOBAL SHARED FOLDER (NOT WORKING YET - JOHAN WORKING ON IT)

$gloAdminModule = "sys"; // STATS PAGE
$gloBaseAdminModule = "/sys";

$gloPathImg = $gloSysPath . "/public/images";
$gloImgURL  = $SysDomain . "/public/images";

//Templates
if ($LOGGEDIN) { 
    $gloTemplateDir  = "./templates";
    $gloTemplateSettings = $gloTemplateDir.'/main_inc/settings.php';
} else { 
    $gloTemplateDir  = "./core/templates";
    $gloTemplateSettings = $gloTemplateDir.'/auth_inc/settings.php';
}

//Logos
$gloLogosDir = $SysDomain . "/public/logos";
$gloLogosDir2 = "public/logos";
$gloLogosPath = $gloSysPath . "/public/logos/";

//Favicons
$gloFaviconsDir = $SysDomain . "/public/favicons";
$gloFaviconsDir2 = "public/favicons";
$gloFaviconsPath = $gloSysPath . "/public/favicons/";

//Avatars
$gloAvatarsDir = $SysDomain . "/public/avatars";
$gloAvatarsDir2 = "public/images/avatars";
$gloAvatarsPath = $gloSysPath . "/public/avatars/";

//ProfileBKG
$gloProfileBKGDir = $SysDomain . "/public/profilebkg";
$gloProfileBKGDir2 = "public/images/profilebkg";
$gloProfileBKGPath = $gloSysPath . "/public/profilebkg/";

//Preloader
$gloPreloaderDir = $SysDomain . "/public/preloaders";
$gloPreloaderDir2 = "./public/images/preloaders";
$gloPreloaderPath = $gloSysPath . "/public/preloaders/";

$gloLoaderIMG = $gloPreloaderDir2."/preloaders/loaderblue.svg"; //loaderblack for black and loader for white. loaderblue for primary blue.
$gloLoaderIMGStart = "../".$gloPreloaderDir2."/preloaders/loaderblue.svg"; //loaderblack for black and loader for white. loaderblue for primary blue.