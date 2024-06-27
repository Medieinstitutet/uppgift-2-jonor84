<?php
//Settings
$gloDomain = "localhost";
$SysDomain = $gloDomain;

$gloHome = "https://jonor84.moonserver.nu";
$gloBase = "/"; // main.php?module= or / when .htaccess / mod_rewrite is active

$gloSessionLife = 1800; // HOW LONG A SESSION LIVES (SECONDS)
$gloAdminPath = "/"; 
$gloSystemPath = "/";
$gloAdminModule = "sys";
$gloBaseAdminModule = "/sys";

//FOR EMAIL PURPOSES
$gloSysMail = 'send@myhalo.se'; // SYSTEM MAIL OUTGOING postmarkapp.com
$gloSysMailName = 'System'; // SYSTEM NAME OUTGOING
$gloSysNoReplyMail = 'send@myhalo.se'; // SYSTEM MAIL NOREPLY

//Templates
$gloTemplateDir  = "./core/templates";
$gloTemplateSettings = $gloTemplateDir.'/auth_inc/settings.php';

// For images, logos, favicons, avatars etc.
$PublicDir = "/public";

$gloLoaderIMG = $PublicDir."/loaderblue.svg"; // Preloader
