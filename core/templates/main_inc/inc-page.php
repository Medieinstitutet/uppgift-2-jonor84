<?
//PAGES
$APP_PATH = "_modules";

  $NODATA = 1; 

  if (file_exists($APP_PATH . "/" . $GETMODULE . "/index.php")) {
    include $APP_PATH . "/" . $GETMODULE . "/inc-settings.php";
    include $APP_PATH . "/" . $GETMODULE . "/index.php";
  } else {
    include "templates/main_inc/inc-page404.php";
  }
?>