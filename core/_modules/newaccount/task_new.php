<?php
if (isset($_POST['frmEmail'])) {
  $strFName      = mysqli_real_escape_string($SQLlink, $_POST['frmFName']);
  $strSName      = mysqli_real_escape_string($SQLlink, $_POST['frmSName']);
  $strEmail      = mysqli_real_escape_string($SQLlink, $_POST['frmEmail']);
  $strPhone      = mysqli_real_escape_string($SQLlink, $_POST['frmMobileNumber']);
  $strFindus     = mysqli_real_escape_string($SQLlink, $_POST['frmFindus']);
  $strPNR        = mysqli_real_escape_string($SQLlink, $_POST['frmPNR']);

  $strFullName = $strFName . " " . $strSName;

  // ORG DATA
  $strContact1 = $strFullName;
  $strORGID = $strPNR;
  $strORGTYPE = 1;

  $strORGNAME1 = $strFullName;
  $strORGAdress1 = mysqli_real_escape_string($SQLlink, $_POST['frmORGAdress']);
  $strORGZip = mysqli_real_escape_string($SQLlink, $_POST['frmORGZip']);
  $strORGCity1 = mysqli_real_escape_string($SQLlink, $_POST['frmORGCity']);
  $strORGEMAIL = $strEmail;

  $strORGNAME = strtoupper($strORGNAME1);
  $strContact = ucwords($strContact1);
  $strORGAdress = ucwords($strORGAdress1);
  $strORGCity = ucwords($strORGCity1);
  $strCountryID = 1;

  // ADD CLIENT PROFILE / "client data" 
  $strActive = 1; // Active 1/0
  $strAFID = $gloResellerID; // Reseller ID
  $strAccess = 3; // ACCESS 
  $strAccepted = 1; // ACCEPTED    
  $strPostA = $strORGAdress;
  $strPostAZip = $strORGZip;
  $strPostATown = $strORGCity;
  $strInvoiceA = $strORGAdress;
  $strInvoiceAZip = $strORGZip;
  $strInvoiceATown = $strORGCity;
  $strOrgNew = 0; // DONT NEED TO ACCEPT 
  $strCID = generateClientID();

  // ADD USER CLIENT
  // $strSQLClient = "
	// 	INSERT INTO data_clients
	// 	 (clientid,brand,orgnew,orgadmin,typeid,companyid,companyname,
  //         contactname,phone,email,active,countryid,
  //         userid,afid,paddress,pzip,ptown,
  //         iaddress,izip,itown,orgemail,orgiemail,
  //         added,updated) 
	// 	VALUES 
	// 	 ('$strCID','$BRAND','$strOrgNew','$gloUID','$strORGTYPE','$strORGID','$strORGNAME',
  //         '$strContact','$strPhone','$strEmail','$strActive','$strCountryID',
  //         '$gloUID','$strAFID','$strPostA','$strPostAZip','$strPostATown',
  //         '$strInvoiceA','$strInvoiceAZip','$strInvoiceATown','$strORGEMAIL','$strORGEMAIL',
  //         '$gloTimeStamp','$gloTimeStamp')";
  // mysqli_query($SQLlink, $strSQLClient);

  // $CreatedClientID = $SQLlink->insert_id;

  $UserNew       = 0;
  $UserNewClient = 0;
  $UserAccess = 3;
  $UserAccept = 1;
  $UserAccessActive = 1;

  // ADD ACCESS TO USER CLIENT
  // $strSQLClientAccess = "
	// 	INSERT INTO data_clients_access
	// 	 (uid,cid,aid,added,addeduid,updated,updateduid,accepted,active) 
	// 	VALUES 
	// 	 ('$gloUID','$CreatedClientID','$UserAccess','$gloTimeStamp','$gloUID','$gloTimeStamp','$gloUID','$UserAccept','$UserAccessActive')";
  // mysqli_query($SQLlink, $strSQLClientAccess);


  // UPDATE USER
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


  if (intval(mysqli_affected_rows($SQLlink)) == 1) {

    $_SESSION['success'] = "Din profil skapades utan problem.";

    // INSERT EVENT IN LOG
    $event = "newaccount";
    $notes = "Profilen blev ifylld för första gången av användaren";
    addLog($event, $notes);

    if ($SHOWSTEPS) {
      if ($gloIDLinkPID) {
        $NEXTURL = "/dashboard&" . $gloIDLinkPID;
      } else if ($gloIDLinkCID) {
        $NEXTURL = "/dashboard&" . $gloIDLinkCID;
      } else {
        $NEXTURL = "/dashboard";
      }
    } else {
      $NEXTURL = "/dashboard";
    }
    $_SESSION['gloCurrentClient'] = 0;
    unset($_SESSION["service"]);
    header("Location: $NEXTURL");
  } else {

    $_SESSION['error'] = "Profilen kunde inte uppdateras korrekt. Var god försök igen eller kontakta support.";
    header("Location: /newaccount");
  }
} else {
  $_SESSION['error'] = "Du behöver fylla i alla uppgifter";
  header("Location: /newaccount");
}
