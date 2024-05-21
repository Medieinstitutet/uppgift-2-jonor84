<?
if ($gloUserNew) {
    $SERVICENAME = "Start";
    $SERVICESTARTLINK = "/dashboard";
    $COLLENGTH = 12;
    $SERVICEADMINMODE = 0;
    $SHOWTOPSERVICENAME = 1;
} else {

    if (!$_SESSION["service"]) {
        $_SESSION['w'] = 1;
        $SERVICENAME = "Start";
        $SERVICESTARTLINK = "/dashboard";
        $COLLENGTH = 12;
        $SERVICEADMINMODE = 0;
        $SHOWTOPSERVICENAME = 1;
    } else {

        if ($_SESSION["service"] == "newaccount") {
            $SERVICENAME = "Nytt Konto";
            $SERVICESTARTLINK = "/newaccount";
            $_SESSION['w'] = 1;
            $COLLENGTH = 12;
            $SERVICEADMINMODE = 0;
            $SHOWTOPSERVICENAME = 1;
        } else if ($_SESSION["service"] == "account") {
            $SERVICENAME = "Mitt Konto";
            $SERVICESTARTLINK = "/account";
            $_SESSION['w'] = 1;
            $COLLENGTH = 12;
            $SERVICEADMINMODE = 0;
            $SHOWTOPSERVICENAME = 1;
        } else if ($_SESSION["service"] == "editaccount") {
            $SERVICENAME = "Mitt Konto";
            $SERVICESTARTLINK = "/editaccount";
            $_SESSION['w'] = 1;
            $COLLENGTH = 12;
            $SERVICEADMINMODE = 0;
            $SHOWTOPSERVICENAME = 1;
        } else if ($_SESSION["service"] == "account2") {
            $SERVICENAME = "Mitt Konto";
            $SERVICESTARTLINK = "/account2";
            $_SESSION['w'] = 0;
            $COLLENGTH = 10;
            $SERVICEADMINMODE = 0;
            $SHOWTOPSERVICENAME = 1;
        } else if ($_SESSION["service"] == "sys") {
            $SERVICENAME = "SYS";
            $SERVICESTARTLINK = "/dashboard";
            $_SESSION['w'] = 0;
            $COLLENGTH = 10;
            $SERVICEADMINMODE = 1;
            $SHOWTOPSERVICENAME = 0;
        }
    }
}

// GET CORE MODULE TITLE
if (isset($GETMODULE)) {
    include "_modules/" . $GETMODULE . "/inc-settings.php";
    $strModuleHeader = "<b>" . $SERVICENAME . "</b> / " . $strHeader;
    $gloBrowserTitle = $SERVICENAME . "/" . $strHeader;
} else {
    // $strModuleHeader = "NO MODULE LOADED";
    $gloBrowserTitle = $SERVICENAME;
    $strModuleHeader = $SERVICENAME;
}
