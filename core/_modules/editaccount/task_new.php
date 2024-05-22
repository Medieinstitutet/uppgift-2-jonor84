<?php
if (isset($_POST['frmEmail'])) {
  $strFName      = mysqli_real_escape_string($SQLlink, $_POST['frmFName']);
  $strSName      = mysqli_real_escape_string($SQLlink, $_POST['frmSName']);
  $strEmail      = mysqli_real_escape_string($SQLlink, $_POST['frmEmail']);
  $strPhone      = mysqli_real_escape_string($SQLlink, $_POST['frmPhone']);
  $strFindus     = mysqli_real_escape_string($SQLlink, $_POST['frmFindus']);

  $UserNew       = 0;
  $UserNewClient = 1;


  $strSQL = "
		UPDATE data_users 
		SET 
		user_fname='$strFName', 
		user_sname='$strSName', 
		user_phone='$strPhone',
    user_new='$UserNew',
    user_newclient='$UserNewClient',
    findus='$strFindus',
		user_updated='$gloTimeStamp' 
		WHERE id = $gloUID 
		LIMIT 1";
  mysqli_query($SQLlink, $strSQL);



  // if ($gloBrandID == 1) {
  //   // if moonserver - add cloud apps to customer 
  //   $AppActive = 1; // app active
  //   $AppIDOldCZ = 3; // app id old customer zone
  //   $AppIDNewCZ = 5; // app id new customer zone
  //   $AppIDMSite = 2; // app id msite

  //   $strSQLAppOldCZ = "
  //             INSERT INTO data_mycloudapps
  //             (uid, appid, active, added, updated) 
  //           VALUES 
  //             ('$gloUID','$AppIDOldCZ','$AppActive','$gloTimeStamp','$gloTimeStamp')";
  //   mysqli_query($SQLlink, $strSQLAppOldCZ);

  //   if ($gloUseNewCustomerzone) {
  //     $strSQLAppNewCZ = "
  //                 INSERT INTO data_mycloudapps
  //                 (uid, appid, active, added, updated) 
  //               VALUES 
  //                 ('$gloUID','$AppIDNewCZ','$AppActive','$gloTimeStamp','$gloTimeStamp')";
  //     mysqli_query($SQLlink, $strSQLAppNewCZ);
  //   }

  //   $strSQLAppMSite = "
  //             INSERT INTO data_mycloudapps
  //             (uid, appid, active, added, updated) 
  //           VALUES 
  //             ('$gloUID','$AppIDMSite','$AppActive','$gloTimeStamp','$gloTimeStamp')";
  //   mysqli_query($SQLlink, $strSQLAppMSite);
  // }


  if (intval(mysqli_affected_rows($SQLlink)) == 1) {

    $_SESSION['success'] = "Din profil skapades utan problem.";
    // INSERT EVENT IN LOG
    $strSQL = "
			INSERT INTO log_admin 
			(user_id,session_id,log_event,log_ip,log_date,log_notes) 
			VALUES 
			($gloUID,'$gloSID','update_profile',INET_ATON('$gloIP'),'$gloTimeStamp','Profilen blev ifylld för första gången av användaren')";
    mysqli_query($SQLlink, $strSQL);

    if ($SHOWSTEPS) {
      if ($gloIDLinkPID) {
        $NEXTURL = "/account&show=newclient&$gloIDLinkPID";
      } else if ($gloIDLinkCID) {
        $NEXTURL = "/account&show=newclient&$gloIDLinkCID";
      } else {
        $NEXTURL = "/account&show=newclient";
      }
    } else {
      $NEXTURL = "/dashboard";
    }

    header("Location: $NEXTURL");
  } else {

    $_SESSION['error'] = "Profilen kunde inte uppdateras korrekt. Var god försök igen eller kontakta support.";
    header("Location: /account&show=new");
  }
} else {
  $_SESSION['error'] = "Du behöver fylla i alla uppgifter";
  header("Location: /account&show=new");
}
