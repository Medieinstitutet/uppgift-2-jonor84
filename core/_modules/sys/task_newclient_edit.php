<?php
	if (isset($_POST['frmCLIENTID'])) {	
	    $ClientID			= mysqli_real_escape_string($SQLlink,$_POST['frmCLIENTID']);

		$Notes			= mysqli_real_escape_string($SQLlink,$_POST['frmNotes']);
		$NotesA			= mysqli_real_escape_string($SQLlink,$_POST['frmANotes']);
   		$OrgAdminID		= mysqli_real_escape_string($SQLlink,$_POST['frmOrgAdminID']);

		$strCompany			= mysqli_real_escape_string($SQLlink,$_POST['frmCompany']);
		$strContact 		= mysqli_real_escape_string($SQLlink,$_POST['frmContact']);
		$strPhone 			= mysqli_real_escape_string($SQLlink,$_POST['frmPhone']);
		$strEmail			= mysqli_real_escape_string($SQLlink,$_POST['frmEmail']);
		$strCity 			= mysqli_real_escape_string($SQLlink,$_POST['frmCity']);
		$strPostA			= mysqli_real_escape_string($SQLlink,$_POST['frmPostA']);
		$strPostZip			= mysqli_real_escape_string($SQLlink,$_POST['frmPostAZip']);
		$strPostTown		= mysqli_real_escape_string($SQLlink,$_POST['frmPostATown']);

		$strInvoiceA	 	= mysqli_real_escape_string($SQLlink,$_POST['frmInvoiceA']);
		$strInvoiceZip	 	= mysqli_real_escape_string($SQLlink,$_POST['frmInvoiceAZip']);
		$strInvoiceTown	 	= mysqli_real_escape_string($SQLlink,$_POST['frmInvoiceATown']);

		$strWebsite	 		= mysqli_real_escape_string($SQLlink,$_POST['frmWebsite']);
		$strCompanyID	 	= mysqli_real_escape_string($SQLlink,$_POST['frmCompanyID']);
		$strVatID	 		= mysqli_real_escape_string($SQLlink,$_POST['frmVATID']);
		$strCType	 		= mysqli_real_escape_string($SQLlink,$_POST['frmOrgType']);


        $Activated = "1";
        $NewClient = "0";
		
        // update client       
		$strSQL = "
		UPDATE data_clients 
		SET
		typeid = '$strCType', 
		orgnew = '$NewClient', 
		active = '$Activated', 
		notes = '$Notes',
		adminnotes = '$NotesA',		
		companyname = '$strCompany',
		contactname = '$strContact',
		phone = '$strPhone', 
		email = '$strEmail',
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
		updateduid = '$gloUID',		
		updated = '$gloTimeStamp' 
		WHERE id = '$ClientID'
		LIMIT 1"; 
		mysqli_query($SQLlink,$strSQL);
  
        
			$checkFirst = intval(mysqli_affected_rows($SQLlink));

			if ($checkFirst) 	{ 
                
                // ADD to users log that the client service is activated
                $strSQLLOG = "
                INSERT INTO log_admin 
                (user_id,session_id,log_event,log_ip,log_date,log_notes) 
                VALUES 
                ($OrgAdminID,'$gloSID','update_profile',INET_ATON('$gloIP'),'$gloTimeStamp','Kundprofilen: $ClientCompany är aktiverad.')";
                mysqli_query($SQLlink,$strSQLLOG);
                
                
				$_SESSION['success'] = "Kundprofilen: $ClientCompany aktiverades utan problem.";
				//$arrSuccess[] = "Objektet uppdaterades utan problem."; 
				header("Location: $gloBaseModule&show=newclients");
			}
			else {
				$_SESSION['error'] = "Kundprofilen: $ClientCompany kunde inte aktiveras korrekt. Var god försök igen eller kontakta administratören.";
				header("Location: $gloBaseModule&show=newclients");
			}
	}
?>