<?php
if (isset($_POST['frmCompany'])) {
		
		$strCompany		= mysqli_real_escape_string($SQLlink,$_POST['frmCompany']);
		$strContact		= mysqli_real_escape_string($SQLlink,$_POST['frmContact']);
		$strPhone		= mysqli_real_escape_string($SQLlink,$_POST['frmPhone']);
		$strEmail		= mysqli_real_escape_string($SQLlink,$_POST['frmEmail']);
		$strCity		= mysqli_real_escape_string($SQLlink,$_POST['frmCity']);
		$strUserID		= mysqli_real_escape_string($SQLlink,$_POST['frmUserID']);
		$strAFID		= mysqli_real_escape_string($SQLlink,$_POST['frmAFID']);
		$strCountryID		= mysqli_real_escape_string($SQLlink,$_POST['frmCountryID']);
		$strActive		= mysqli_real_escape_string($SQLlink,$_POST['frmActive']);
		$strInfo		= mysqli_real_escape_string($SQLlink,$_POST['frmInfo']);
		$strWebsite		= mysqli_real_escape_string($SQLlink,$_POST['frmWebsite']);
    
        $strCompanyID	= mysqli_real_escape_string($SQLlink,$_POST['frmCompanyID']);
        $strVATID	    = mysqli_real_escape_string($SQLlink,$_POST['frmVATID']);

		$strInvoiceA	  = mysqli_real_escape_string($SQLlink,$_POST['frmInvoiceA']);
		$strInvoiceAZip	  = mysqli_real_escape_string($SQLlink,$_POST['frmInvoiceAZip']);
		$strInvoiceATown  = mysqli_real_escape_string($SQLlink,$_POST['frmInvoiceATown']);
		$strInvoiceEmail  = mysqli_real_escape_string($SQLlink,$_POST['frmInvoiceEmail']);

		$strPostA		= mysqli_real_escape_string($SQLlink,$_POST['frmPostA']);
		$strPostAZip	= mysqli_real_escape_string($SQLlink,$_POST['frmPostAZip']);
		$strPostATown	= mysqli_real_escape_string($SQLlink,$_POST['frmPostATown']);

        $strTypeID  	= mysqli_real_escape_string($SQLlink,$_POST['frmOrgType']);
		$strMBingoActive = mysqli_real_escape_string($SQLlink,$_POST['frmMBingoActive']);

		if (!$strInvoiceA) { $strInvoiceA = $strPostA; }  
		if (!$strInvoiceAZip) { $strInvoiceAZip = $strPostAZip; }  
		if (!$strInvoiceATown) { $strInvoiceATown = $strPostATown; }  
		if (!$strInvoiceEmail) { $strInvoiceEmail = $strEmail; } 
	
		if (!$strCity) { $strCity = $strPostATown; }  
	
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
			INSERT INTO data_clients 
			 (typeid,companyid,vatid,companyname,contactname,
             phone,email,active,countryid,town,
             userid,afid,info,paddress,pzip,
             ptown,iaddress,izip,itown,iemail,
             website,mbingo,added,updated,addeduid,
			 updateduid) 
			VALUES 
			 ('$strTypeID','$strCompanyID','$strVATID','$strCompany','$strContact',
             '$strPhone','$strEmail','$strActive','$strCountryID','$strCity',
             '$strUserID','$strAFID','$strInfo','$strPostA','$strPostAZip',
             '$strPostATown','$strInvoiceA','$strInvoiceAZip','$strInvoiceATown','$strInvoiceEmail',
             '$strWebsite','$strMBingoActive','$gloTimeStamp','$gloTimeStamp','$gloUID',
			 '$gloUID')";
			mysqli_query($SQLlink,$strSQL);
			
			$CreatedClientID = mysqli_insert_id($SQLlink);

			$checkFirst = intval(mysqli_affected_rows($SQLlink));

			if ($checkFirst) {

				if ($strMBingoActive == 1) {
					$strSQL2 = "
					INSERT INTO app_gameorganizers
					 (id,companyname,contactname,phone,email,
					 active,countryid,town,afid,landskapsid,
					 website,added,updated) 
					VALUES 
					 ('$CreatedClientID','$strCompany','$strContact','$strPhone','$strEmail',
					 '$strActive','$strCountryID','$strCity','1','0',
					 '$strWebsite','$gloTimeStamp','$gloTimeStamp')";
					mysqli_query($SQLlinkA,$strSQL2);

				}

			 $_SESSION['success'] = "Kunden skapades utan problem.";
			 header("Location: $gloBaseModule&show=clients");
			} else { 
			 $_SESSION['error'] = "Kunden kunde ej skapas. Vänligen försök igen eller kontakta administratören.";
			 header("Location: $gloBaseModule&show=clients");
		}
	}
?>