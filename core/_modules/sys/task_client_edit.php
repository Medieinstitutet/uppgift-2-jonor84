<?php
if (isset($_POST['frmID'])) {
	$strID			= intval($_POST['frmID']);
	$strCompany		= mysqli_real_escape_string($SQLlink, $_POST['frmCompany']);
	$strContact		= mysqli_real_escape_string($SQLlink, $_POST['frmContact']);
	$strPhone		= mysqli_real_escape_string($SQLlink, $_POST['frmPhone']);
	$strEmail		= mysqli_real_escape_string($SQLlink, $_POST['frmEmail']);
	$strCity		= mysqli_real_escape_string($SQLlink, $_POST['frmCity']);
	$strUserID		= mysqli_real_escape_string($SQLlink, implode(",", $_POST['frmUserID']));

	$strAFID		= mysqli_real_escape_string($SQLlink, $_POST['frmAFID']);
	$strCountryID		= mysqli_real_escape_string($SQLlink, $_POST['frmCountryID']);
	$strActive		= mysqli_real_escape_string($SQLlink, $_POST['frmActive']);
	$strInfo		= mysqli_real_escape_string($SQLlink, $_POST['frmInfo']);
	$strWebsite		= mysqli_real_escape_string($SQLlink, $_POST['frmWebsite']);

	$strCompanyID	= mysqli_real_escape_string($SQLlink, $_POST['frmCompanyID']);
	$strVATID	    = mysqli_real_escape_string($SQLlink, $_POST['frmVATID']);

	$strInvoiceA	  = mysqli_real_escape_string($SQLlink, $_POST['frmInvoiceA']);
	$strInvoiceAZip	  = mysqli_real_escape_string($SQLlink, $_POST['frmInvoiceAZip']);
	$strInvoiceATown  = mysqli_real_escape_string($SQLlink, $_POST['frmInvoiceATown']);
	$strInvoiceAEmail = mysqli_real_escape_string($SQLlink, $_POST['frmInvoiceEmail']);

	$strPostA		= mysqli_real_escape_string($SQLlink, $_POST['frmPostA']);
	$strPostAZip	= mysqli_real_escape_string($SQLlink, $_POST['frmPostAZip']);
	$strPostATown	= mysqli_real_escape_string($SQLlink, $_POST['frmPostATown']);

	$strTypeID  	= mysqli_real_escape_string($SQLlink, $_POST['frmOrgType']);

	$strNotes  	    = mysqli_real_escape_string($SQLlink, $_POST['frmNotes']);
	$strANotes  	= mysqli_real_escape_string($SQLlink, $_POST['frmANotes']);
	$strOrgAdminID 	= mysqli_real_escape_string($SQLlink, $_POST['frmOrgAdminID']);
	$strMBingoActive = mysqli_real_escape_string($SQLlink, $_POST['frmMBingoActive']);

	if (!$strInvoiceA) {
		$strInvoiceA = $strPostA;
	}
	if (!$strInvoiceAZip) {
		$strInvoiceAZip = $strPostAZip;
	}
	if (!$strInvoiceATown) {
		$strInvoiceATown = $strPostATown;
	}
	if (!$strInvoiceEmail) {
		$strInvoiceEmail = $strEmail;
	}

	if (!$strCity) {
		$strCity = $strPostATown;
	}

	if ($strActive == "on") {
		$strActive = 1;
	} else {
		$strActive = 0;
	}

	if ($strMBingoActive == "on") {
		$strMBingoActive = 1;
	} else {
		$strMBingoActive = 0;
	}

	$strSQL = "
			UPDATE data_clients
			SET 
			mbingo='$strMBingoActive',
			iemail='$strInvoiceAEmail',
			orgadmin='$strOrgAdminID',
            notes='$strNotes',
            adminnotes='$strANotes',
            typeid='$strTypeID',
            companyid='$strCompanyID',
			vatid='$strVATID',
			paddress='$strPostA',
			pzip='$strPostAZip',
			ptown='$strPostATown',
			iaddress='$strInvoiceA',
			izip='$strInvoiceAZip',
			itown='$strInvoiceATown',
			companyname='$strCompany', 
			contactname='$strContact', 
			phone='$strPhone', 
			email='$strEmail', 
			active='$strActive', 
			countryid='$strCountryID',
			town='$strCity',
			userid='$strUserID',
			afid='$strAFID',
			info='$strInfo',
			website='$strWebsite',
			updated='$gloTimeStamp' 
			WHERE id = $strID 
			LIMIT 1";
	mysqli_query($SQLlink, $strSQL);

	$checkFirst = intval(mysqli_affected_rows($SQLlink));

	if ($checkFirst) {

		if ($strMBingoActive == 1) {

			$strSQL2 = "
					UPDATE app_gameorganizers
					SET 
					companyname='$strCompany', 
					contactname='$strContact', 
					phone='$strPhone', 
					email='$strEmail', 
					active='$strActive', 
					countryid='$strCountryID',
					town='$strCity',
					afid='$strAFID',
					website='$strWebsite',
					updated='$gloTimeStamp' 
					WHERE id = $strID 
					LIMIT 1";
			mysqli_query($SQLlinkA, $strSQL2);
		}

		$_SESSION['success'] = "Kunden uppdaterades utan problem.";
		header("Location: $gloBaseModule&show=clients");
	} else {
		$_SESSION['error'] = "Kunden kunde inte uppdateras korrekt. Var god försök igen eller kontakta administratören.";
		header("Location: $gloBaseModule&show=clients");
	}
}
