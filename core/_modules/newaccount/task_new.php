<?php
if (isset($_POST['frmEmail'])) {
  $strFName      = mysqli_real_escape_string($SQLlink, $_POST['frmFName']);
  $strSName      = mysqli_real_escape_string($SQLlink, $_POST['frmSName']);
  $strEmail      = mysqli_real_escape_string($SQLlink, $_POST['frmEmail']);
  $strPhone      = mysqli_real_escape_string($SQLlink, $_POST['frmMobileNumber']);
  $strFindus     = mysqli_real_escape_string($SQLlink, $_POST['frmFindus']);
  $strPNR        = mysqli_real_escape_string($SQLlink, $_POST['frmPNR']);

  $strAdress1 = mysqli_real_escape_string($SQLlink, $_POST['frmAdress']);
  $strZip = mysqli_real_escape_string($SQLlink, $_POST['frmZip']);
  $strCity1 = mysqli_real_escape_string($SQLlink, $_POST['frmCity']);

  $ClientReg       = mysqli_real_escape_string($SQLlink, $_POST['frmClient']);

  $strFullName = ucwords($strFName . " " . $strSName);

  // ORG DATA
	$strORGID			= mysqli_real_escape_string($SQLlink, $_POST['frmOrgID']);
	$strORGNAME1			= mysqli_real_escape_string($SQLlink, $_POST['frmOrgName']);
	$strTypeID  		= mysqli_real_escape_string($SQLlink, $_POST['frmOrgType']);
  $strContact = $strFullName;
	
  $strORGNAME = strtoupper($strORGNAME1);
  $strAdress = ucwords($strAdress1);
  $strCity = ucwords($strCity1);
  $strCountryID = 1;

  $strActive = 1; // Active 1/0
  $strAccess = 3; // ACCESS 
  $strAccepted = 1; // ACCEPTED    
  $strPostA = $strAdress;
  $strPostAZip = $strZip;
  $strPostATown = $strCity;
  $strInvoiceA = $strAdress;
  $strInvoiceAZip = $strZip;
  $strInvoiceATown = $strCity;
  $strOrgNew = 0; // DONT NEED TO ACCEPT 
  $strCID = generateClientID();

  $UserNew       = 0;
  $UserNewClient = 0;
  $UserAccess = 3;
  $UserAccept = 1;
  $UserAccessActive = 1;

  if ($ClientReg)  { 

  // ADD USER CLIENT
  $strSQLClient = "
		INSERT INTO data_clients
        (clientid,brand,orgnew,orgadmin,typeid,companyid,companyname,
          contactname,phone,email,active,countryid,
          userid,afid,paddress,pzip,ptown,
          iaddress,izip,itown,orgemail,orgiemail,
          added,updated) 
		VALUES 
        ('$strCID','$BRAND','$strOrgNew','$gloUID','$strTypeID','$strORGID','$strORGNAME',
          '$strContact','$strPhone','$strEmail','$strActive','$strCountryID',
          '$gloUID','$gloResellerID','$strPostA','$strPostAZip','$strPostATown',
          '$strInvoiceA','$strInvoiceAZip','$strInvoiceATown','$strEmail','$strEmail',
          '$gloTimeStamp','$gloTimeStamp')";
  mysqli_query($SQLlink, $strSQLClient);

  $CreatedClientID = $SQLlink->insert_id;

    // ADD ACCESS TO USER CLIENT
    $strSQLClientAccess = "
    INSERT INTO data_clients_access 
      (uid,cid,aid,added,addeduid,updated,updateduid,accepted,active) 
    VALUES 
      ('$gloUID','$CreatedClientID','$UserAccess','$gloTimeStamp','$gloUID','$gloTimeStamp','$gloUID','$UserAccept','$UserAccessActive')";
    mysqli_query($SQLlink, $strSQLClientAccess);

    $_SESSION['gloCurrentClient'] = $CreatedClientID;
  } else { 
    $_SESSION['gloCurrentClient'] = 0;
  }


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
    
    unset($_SESSION["service"]);
    header("Location: /dashboard");
  } else {

    $_SESSION['error'] = "Profilen kunde inte uppdateras korrekt. Var god försök igen eller kontakta support.";
    header("Location: /newaccount");
  }
} else {
  $_SESSION['error'] = "Du behöver fylla i alla uppgifter";
  header("Location: /newaccount");
}
