<?
//THEMESETTINGS
//$SidePanelActive = "1";
//$ExtraMenuActive = "1";
$DateActive = 1;
$ServiceNameActive = 1;
$SearchActive = 0;
$AlertsActive = 0;
$AlertsActive2 = 0;
//$LangActive = 0;
$CartActive = 0;
$MessagesActive = 0;
$QuotesActive = 0;
$TopAppsActive = 0;
$FullscreenActive = 0;
//$TopbarDivider = "0";
//$DropdownActive = "0";
//$ColorActive = "0";

if ($gloWindow) {
    $SideMenuActive = 0;
} else if ($MAXWINDOW) {
    $SideMenuActive = 0;
} else {
    $SideMenuActive = 1;
}


$gloTemplateName = $gloBrandTemplateMain;
$gloTemplate = $SysDomain . "/core/templates/";
$gloTemplateMain = $gloTemplate ."main/". $gloTemplateName;
$gloMainIncPath = $gloTemplateDir . "/main_inc";

$gloTemplateContent = $gloMainIncPath . '/inc-page.php';

$gloTemplateSidemenu = $gloMainIncPath . '/sidemenu.php';
$gloTemplateNotifications = $gloMainIncPath . '/notification.php';

// $gloTemplateAlerts = $gloMainIncPath . '/alerts.php';

// $gloTemplateMessages = $gloMainIncPath . '/messages.php';
$gloTemplateUsermenu = $gloMainIncPath . '/usermenu.php';

// $gloTemplateTopappsmenu = $gloMainIncPath . '/topappsmenu.php';
$gloTemplateFullwindowmenu = $gloMainIncPath . '/fullwindowmenu.php';
// $gloTemplateCart = $gloMainIncPath . '/cart.php';

$gloTemplateLoader = $SysDomain . "/public/preloaders/loaderblue.svg";
//$gloLoaderIMG

// Dark or Light sign in
// if ($gloBrandDarklogin) {
//     $LoginCSS = "signin_dark.css";
// } else {
//     $LoginCSS = "signin_light.css";
// }
// Path to own sign in css file. index login will auto check if file exist and read it if it exist.
$owncss = $gloBrandTemplateMain . "/css/main_" . strtolower($gloBrandSiteName) . ".css";
