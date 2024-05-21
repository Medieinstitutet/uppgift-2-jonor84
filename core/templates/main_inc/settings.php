<?
//THEMESETTINGS
//$SidePanelActive = "1";
//$ExtraMenuActive = "1";
$DateActive = 1;
$ServiceNameActive = 1;
$SearchActive = 0;
$AlertsActive = 1;
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
$gloTemplatePath = $SysDomain . "/core/templates/main/" . $gloTemplateName;
$gloTemplate = $gloTemplatePath . $gloTemplateName;
$gloMainPath = $gloSystemPath . "/main";

$gloTemplateContent = $gloMainPath . '/content.php';
$gloTemplateSidemenu = $gloMainPath . '/sidemenu.php';
$gloTemplateNotifications = $gloMainPath . '/notification.php';

$gloTemplateAlerts = $gloMainPath . '/alerts.php';
$gloTemplateAlerts2 = $gloMainPath . '/alerts2.php';

$gloTemplateMessages = $gloMainPath . '/messages.php';
$gloTemplateUsermenu = $gloMainPath . '/usermenu.php';
$gloTemplateUsermenu2 = $gloMainPath . '/usermenu2.php';


$gloTemplateTopappsmenu = $gloMainPath . '/topappsmenu.php';
$gloTemplateFullwindowmenu = $gloMainPath . '/fullwindowmenu.php';
$gloTemplateCart = $gloMainPath . '/cart.php';

$gloTemplateLoader = $SysDomain . "/core/system/images/loaderblue.svg";
//$gloLoaderIMG

// Dark or Light sign in
// if ($gloBrandDarklogin) {
//     $LoginCSS = "signin_dark.css";
// } else {
//     $LoginCSS = "signin_light.css";
// }
// Path to own sign in css file. index login will auto check if file exist and read it if it exist.
$owncss = $gloBrandTemplateMain . "/css/main_" . strtolower($gloBrandSiteName) . ".css";
