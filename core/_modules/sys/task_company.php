<?php
	if (isset($_POST['frmID'])) {	
		$strRID			= mysqli_real_escape_string($SQLlink,$_POST['frmID']); // FOR RESELLER DB
		$strBRAND		= mysqli_real_escape_string($SQLlink,$_POST['frmBRAND']); // FOR BRAND DB

		$strOrgNr			= mysqli_real_escape_string($SQLlink,$_POST['frmOrgNr']); // RESELLER
		$strCompany			= mysqli_real_escape_string($SQLlink,$_POST['frmCompany']); // BRAND AND RESELLER
		$strBG				= mysqli_real_escape_string($SQLlink,$_POST['frmBG']); // RESELLER
		$strPG				= mysqli_real_escape_string($SQLlink,$_POST['frmPG']); // RESELLER
		$strPhone			= mysqli_real_escape_string($SQLlink,$_POST['frmPhone']); // BRAND
		$strPhoneSupport	= mysqli_real_escape_string($SQLlink,$_POST['frmPhoneSupport']); // BRAND


		$strEmail			= mysqli_real_escape_string($SQLlink,$_POST['frmEmail']);
		$strEmailSupport	= mysqli_real_escape_string($SQLlink,$_POST['frmEmailSupport']);

		$strCountryID		= mysqli_real_escape_string($SQLlink,$_POST['frmCountryID']);
		$strAddress			= mysqli_real_escape_string($SQLlink,$_POST['frmAddress']);
		$strZip				= mysqli_real_escape_string($SQLlink,$_POST['frmZip']);
		$strCity			= mysqli_real_escape_string($SQLlink,$_POST['frmCity']);
		

		$strSQLBRAND = "
		UPDATE data_branding 
		SET 
		companyname='$strCompany',
		phone='$strPhone', 
		phonesupport='$strPhoneSupport', 
		mail='$strEmail', 
		mailsupport='$strEmailSupport',
		updateduid='$gloUID',
		updated='$gloTimeStamp'
		WHERE brandname = '$strBRAND'
		LIMIT 1";

		mysqli_query($SQLlink,$strSQLBRAND);

		$strSQLR = "
		UPDATE data_resellers 
		SET 
		companyname='$strCompany',
		companyid='$strOrgNr',
		bg='$strBG',
		pg='$strPG',
		countryid='$strCountryID',
		address='$strAddress', 
		zip='$strZip', 
		town='$strCity', 
		support_phone='$strPhoneSupport',
		support_email='$strEmailSupport', 
		updateduid='$gloUID',
		updated='$gloTimeStamp'
		WHERE id = '$strRID'
		LIMIT 1";

		mysqli_query($SQLlink,$strSQLR);

		$checkFirst = intval(mysqli_affected_rows($SQLlink));

		if ($checkFirst) { 
			$_SESSION['success'] = "Företagsuppgifterna uppdaterades utan problem.";
			header("Location: $gloBaseModule&show=company");
		}
		else { 
			$_SESSION['error'] = "Företagsuppgifterna kunde inte uppdateras korrekt. Var god försök igen eller kontakta administratören.";
			header("Location: $gloBaseModule&show=company");
		}
	
	} 
?>