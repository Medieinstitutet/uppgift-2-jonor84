<?
//PAGES
if ($HALOSESSION) {
  $APP_PATH = "_modules/_halo";
} else {
  $APP_PATH = "_modules";
}

if (!$gloActivepageExist) {
  $NODATA = 1; ?>
      <? if (file_exists($APP_PATH . "/" . $GETMODULE . "/index.php")) {
        include $APP_PATH . "/" . $GETMODULE . "/inc-settings.php";
        include $APP_PATH . "/" . $GETMODULE . "/index.php";
      } else {
        include "templates/main_inc/inc-page404.php";
      }
      ?>
<?
} else {
  $NODATA = 0;
  //echo $gloTotalSubPages;
?>
      <?
      if ($HALOSESSION) {

        // CHECK IF ADMIN MODE IS ON
        if ($SERVICEADMINMODE) {
          include $APP_PATH . "/" . $GETMODULE . "/inc-settings.php";
          $strModuleHeader = "<b>" . $strAdminHeader . " </b>/ " . $strHeader;
          include $APP_PATH . "/" . $GETMODULE . "/index.php";
        } else {
          // JUST VIEW
      ?>
          <div class="row">
            <?
            if ($gloActivePagePlaceApp == 1) {
              if ($gloActivePageApp) {
                include $APP_PATH . "/" . $gloActivePageApp . "/inc-settings.php";
                $strModuleHeader = "<b>" . $strAdminHeader . " </b>/ " . $strHeader;
                include $APP_PATH . "/" . $gloActivePageApp . "/index.php";
              }
            }
            ?>
          </div>

          <? if ($gloActivePageContent) { ?>
                <div class="card">
                  <div class="card-body">
                    <? echo $gloActivePageContent; ?>
                  </div>
                </div>
          <? } ?>

          <div class="row">
            <?
            if ($gloActivePagePlaceApp == 0) {
              if ($gloActivePageApp) {
                include $APP_PATH . "/" . $gloActivePageApp . "/inc-settings.php";
                $strModuleHeader = "<b>" . $strAdminHeader . " </b>/ " . $strHeader;
                include $APP_PATH . "/" . $gloActivePageApp . "/index.php";
              }
            }
            ?>
          </div>
        <? } ?>
      <? } ?>
<?
}
?>