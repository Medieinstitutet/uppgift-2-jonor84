<?php
if ($_POST['frmSKIP'] == 0) {
	// ORG DATA
	$strContact1 = mysqli_real_escape_string($SQLlink, $_POST['frmContact']);
	$strPhone = mysqli_real_escape_string($SQLlink, $_POST['frmPhone']);
	$strEmail = mysqli_real_escape_string($SQLlink, $_POST['frmEmail']);


	$strORGID1 = mysqli_real_escape_string($SQLlink, $_POST['frmOrgID1']);
	$strORGID2 = mysqli_real_escape_string($SQLlink, $_POST['frmOrgID2']);
	$strORGID = $strORGID1 . "-" . $strORGID2;

	$strORGTYPE = mysqli_real_escape_string($SQLlink, $_POST['frmOrgType']);

	$strORGNAME1 = mysqli_real_escape_string($SQLlink, $_POST['frmOrgName']);
	$strORGAdress1 = mysqli_real_escape_string($SQLlink, $_POST['frmORGAdress']);
	$strORGZip = mysqli_real_escape_string($SQLlink, $_POST['frmORGZip']);
	$strORGCity1 = mysqli_real_escape_string($SQLlink, $_POST['frmORGCity']);
	$strORGEMAIL = mysqli_real_escape_string($SQLlink, $_POST['frmOrgEmail']);

	$strORGNAME = strtoupper($strORGNAME1);
	$strContact = ucwords($strContact1);
	$strORGAdress = ucwords($strORGAdress1);
	$strORGCity = ucwords($strORGCity1);

	// OTHER DATA
	$strCountryID = 1;

	$UserNewClient	= 0;

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

	$strSQLClient = "
		INSERT INTO data_clients
		 (orgnew,orgadmin,typeid,companyid,companyname,
          contactname,phone,email,active,countryid,
          userid,afid,paddress,pzip,ptown,
          iaddress,izip,itown,orgemail,orgiemail,
          added,updated) 
		VALUES 
		 ('$strOrgNew','$gloUID','$strORGTYPE','$strORGID','$strORGNAME',
          '$strContact','$strPhone','$strEmail','$strActive','$strCountryID',
          '$gloUID','$strAFID','$strPostA','$strPostAZip','$strPostATown',
          '$strInvoiceA','$strInvoiceAZip','$strInvoiceATown','$strORGEMAIL','$strORGEMAIL',
          '$gloTimeStamp','$gloTimeStamp')";
	mysqli_query($SQLlink, $strSQLClient);

	$CreatedClientID = $SQLlink->insert_id;

	// UPDATE USER WITH CLIENTID
	$strSQLUserUpdate = "
			UPDATE data_users
			SET
			pid='$strORGID',
            defaultcid='$CreatedClientID',
			user_newclient='$UserNewClient',
            client_id='$CreatedClientID'
			WHERE id = $gloUID 
			LIMIT 1";
	mysqli_query($SQLlink, $strSQLUserUpdate);

	//UPDATE USER ACCESS / CLIENT
	$strSQLACCESS = "
			INSERT INTO data_clients_access
			 (accepted,uid,cid,aid,added,addeduid,updated,updateduid) 
			VALUES 
			 ('$strAccepted','$gloUID','$CreatedClientID','$strAccess','$gloTimeStamp','$gloUID','$gloTimeStamp','$gloUID')";
	mysqli_query($SQLlink, $strSQLACCESS);

	if (intval(mysqli_affected_rows($SQLlink)) == 1) {

		$_SESSION['success'] = "Konto med kundprofilen skapades utan problem. Du kan nu prova på tjänster och beställa tjänster.";
		$_SESSION['accountcreated'] = "Kundprofilen skapades utan problem. Du kan nu prova på tjänster och beställa tjänster. 
			<br><br>
			<b>Vad vill du göra nu?</b><br><br>
			<a class='btn btn-dark' href='/close'><i class='fas fa-home'></i> Gå till startsidan </a> <a class='btn btn-dark' href='/store'><i class='fas fa-shopping-cart'></i> Gå till Butiken</a> 
			";
		// INSERT EVENT IN LOG
		$strSQL = "
			INSERT INTO log_admin 
			(user_id,session_id,log_event,log_ip,log_date,log_notes) 
			VALUES 
			($gloUID,'$gloSID','update_profile',INET_ATON('$gloIP'),'$gloTimeStamp','Kundprofil blev ifylld för första gången av användaren')";
		mysqli_query($SQLlink, $strSQL);

		unset($_SESSION['service']);
		header("Location: /dashboard");
	} else {

		unset($_SESSION['storep']);
		unset($_SESSION['storec']);

		$UserNewClient	= 0;

		// UPDATE USER WITH CLIENTID
		$strSQLUserUpdate = "
                UPDATE data_users
                SET
                user_newclient='$UserNewClient'
                WHERE id = $gloUID 
                LIMIT 1";
		mysqli_query($SQLlink, $strSQLUserUpdate);

		$_SESSION['warning'] = "Din kontoprofil skapades utan problem men kundprofilen kunde inte skapas. Du kan när som helst skapa en kundprofil under mina organisationer.<br><br>
		<b>Vad vill du göra nu?</b><br><br>
		<a class='btn btn-dark' href='/close'><i class='fas fa-home'></i> Gå till startsidan </a>";

		unset($_SESSION['service']);
		header("Location: /dashboard");
	}
} else {

	unset($_SESSION['storep']);
	unset($_SESSION['storec']);

	$UserNewClient	= 0;

	// UPDATE USER WITH CLIENTID
	$strSQLUserUpdate = "
                UPDATE data_users
                SET
                user_newclient='$UserNewClient'
                WHERE id = $gloUID 
                LIMIT 1";
	mysqli_query($SQLlink, $strSQLUserUpdate);

	// skip what to do
	$_SESSION['success'] = "Din kontoprofil skapades utan problem och kundprofilen hoppades över utan problem. Du kan när som helst skapa en kundprofil under mina organisationer. <br><br>
			<b>Vad vill du göra nu?</b><br><br>
			<a class='btn btn-dark' href='/close'><i class='fas fa-home'></i> Gå till startsidan </a>";

	unset($_SESSION['service']);
	header("Location: /dashboard");
}
