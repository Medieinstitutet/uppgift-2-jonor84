<?php
if (isset($_POST['frmCID'])) {
	$strCID		= mysqli_real_escape_string($SQLlink, $_POST['frmCID']);

	$strCompany			= mysqli_real_escape_string($SQLlink, $_POST['frmCompany']);
	$strContact 		= mysqli_real_escape_string($SQLlink, $_POST['frmContact']);
	$strPhone 			= mysqli_real_escape_string($SQLlink, $_POST['frmPhone']);
	$strEmail			= mysqli_real_escape_string($SQLlink, $_POST['frmEmail']);
	$strCity 			= mysqli_real_escape_string($SQLlink, $_POST['frmCity']);
	$strPostA			= mysqli_real_escape_string($SQLlink, $_POST['frmPostA']);
	$strPostZip			= mysqli_real_escape_string($SQLlink, $_POST['frmPostAZip']);
	$strPostTown		= mysqli_real_escape_string($SQLlink, $_POST['frmPostATown']);

	$strInvoiceA	 	= mysqli_real_escape_string($SQLlink, $_POST['frmInvoiceA']);
	$strInvoiceZip	 	= mysqli_real_escape_string($SQLlink, $_POST['frmInvoiceAZip']);
	$strInvoiceTown	 	= mysqli_real_escape_string($SQLlink, $_POST['frmInvoiceATown']);

	$strWebsite	 		= mysqli_real_escape_string($SQLlink, $_POST['frmWebsite']);
	$strCompanyID	 	= mysqli_real_escape_string($SQLlink, $_POST['frmCompanyID']);
	$strVatID	 		= mysqli_real_escape_string($SQLlink, $_POST['frmVATID']);

	$strAlliance1 		= mysqli_real_escape_string($SQLlink, $_POST['frmAlliance']);
	$strStateID1 		= mysqli_real_escape_string($SQLlink, $_POST['frmState']);
	$MBINGO	 		    = mysqli_real_escape_string($SQLlink, $_POST['frmMBINGO']);
	$MSITE	 		    = mysqli_real_escape_string($SQLlink, $_POST['frmMSITE']);

	$strInfo	 		    = mysqli_real_escape_string($SQLlink, $_POST['frmInfo']);
	$strFacebook	 		    = mysqli_real_escape_string($SQLlink, $_POST['frmFacebook']);
	$strInstagram	 		    = mysqli_real_escape_string($SQLlink, $_POST['frmInstagram']);

	$strInvoiceEmail = mysqli_real_escape_string($SQLlink, $_POST['frmInvoiceEmail']);

	$CountryID 		    = 1;

	if (!$strInvoiceA) {
		$strInvoiceA = $strPostA;
	}
	if (!$strInvoiceZip) {
		$strInvoiceZip = $strPostZip;
	}
	if (!$strInvoiceTown) {
		$strInvoiceTown = $strPostTown;
	}
	if (!$strInvoiceEmail) {
		$strInvoiceEmail = $strEmail;
	}

	if (!$strCity) {
		$strCity = $strPostTown;
	}


	if ($MBINGO) {
		$strPublicAccount = 1;

		$strStateID = $strStateID1;
		$strAlliance = $strAlliance1;

		$strSQLTotalMGameO = "SELECT sum(id) FROM app_gameorganizers WHERE id = '$strCID'";
		$strResTotalMGameO = mysqli_query($SQLlinkA, $strSQLTotalMGameO);
		$TotalMGameO = mysqli_fetch_array($strResTotalMGameO);
		$TotalMGameO1 = 11111;
		if ($TotalMGameO1 == 0) {


			$strSQLORGANIZER = "
				  INSERT INTO app_gameorganizers
				  (alliance, landskapsid, companyname, contactname, phone, 
				  email, town, website, companyid, countryid, userid, active, added, updated) 
				VALUES 
				  ('$strAlliance', '$strStateID', '$strCompany', '$strContact', '$strPhone',
				  '$strEmail', '$strCity', '$strWebsite', '$strCompanyID', '$CountryID ',
				  '$gloUID', '1','$gloTimeStamp','$gloTimeStamp')";
			mysqli_query($SQLlinkA, $strSQLORGANIZER);

			$NEWORGANIZERID = $SQLlinkA->insert_id;

			$strSQL = "
				UPDATE data_clients 
				SET
				 bingoorganizerid = '$NEWORGANIZERID'
				WHERE id = '$strCID'
				LIMIT 1";

			mysqli_query($SQLlink, $strSQL);
		} else {

			$strSQLORGANIZER = "
				UPDATE app_gameorganizers 
				SET
				 info = '$strInfo',
				 facebook = '$strFacebook',
				 instagram = '$strInstagram',
				 alliance = '$strAlliance',
				 landskapsid = '$strStateID',
				 companyname = '$strCompany',
				 contactname = '$strContact',
				 phone = '$strPhone', 
				 email = '$strEmail',
				 town = '$strCity',
				 website = '$strWebsite',
				 companyid = '$strCompanyID',
				 countryid = '$CountryID',
				 updated = '$gloTimeStamp' 
				WHERE id = '$strCID'
				LIMIT 1";

			mysqli_query($SQLlinkA, $strSQLORGANIZER);
		}
	} else {
		$strStateID = 0;
		$strAlliance = "";
		$strPublicAccount = 0;
	}

	if (empty($strStateID)) {
		$strStateID = 0;
	}

	$strSQL = "
            UPDATE data_clients 
            SET
			info = '$strInfo',
			facebook = '$strFacebook',
			instagram = '$strInstagram',			
            public = '$strPublicAccount',
			alliance = '$strAlliance',
            landskapsid = '$strStateID',
            companyname = '$strCompany',
            contactname = '$strContact',
            phone = '$strPhone', 
            email = '$strEmail',
			iemail = '$strInvoiceEmail',
            town = '$strCity',
            paddress = '$strPostA',
            pzip = '$strPostZip',
            ptown = '$strPostTown',
            iaddress = '$strInvoiceA',
            izip = '$strInvoiceZip',
            itown = '$strInvoiceTown',    
            website = '$strWebsite',
            companyid = '$strCompanyID',
            vatid = '$strVatID',
			countryid = '$CountryID',
            updated = '$gloTimeStamp' 
            WHERE id = '$strCID'
            LIMIT 1";

	mysqli_query($SQLlink, $strSQL);

	$checkFirst = intval(mysqli_affected_rows($SQLlink));

	if ($checkFirst) {
		$_SESSION['success'] = "Organisationsuppgifterna uppdaterades utan problem.";
		header("Location: $gloBaseModule");
	} else {
		$_SESSION['error'] = "Organisationsuppgifterna kunde inte uppdateras korrekt. Var god försök igen eller kontakta support.";
		header("Location: $gloBaseModule");
	}
}
