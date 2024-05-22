<?php
	if (isset($_POST['frmCLIENTID'])) {	
	    $ClientID			= mysqli_real_escape_string($SQLlink,$_POST['frmCLIENTID']);
        $ClientCompany		= mysqli_real_escape_string($SQLlink,$_POST['frmCompanyName']);


		$NotesA			= mysqli_real_escape_string($SQLlink,$_POST['frmANotes']);
   		$OrgAdminID		= mysqli_real_escape_string($SQLlink,$_POST['frmOrgAdminID']);

        $NewClient = "0";


        // update client service - myservices        
			$strSQL = "
			UPDATE data_clients
			SET 
			orgnew = '$NewClient', 
            active='0',
			closed='1',
            adminnotes='$NotesA',                      
			updateduid='$gloUID',
			updated='$gloTimeStamp' 
			WHERE id = $ClientID 
			LIMIT 1";			
			mysqli_query($SQLlink,$strSQL);

			$checkFirst = intval(mysqli_affected_rows($SQLlink));

			if ($checkFirst) 	{ 
                
                // ADD to users log that the client service is activated
                $strSQL = "
                INSERT INTO log_admin 
                (user_id,session_id,log_event,log_ip,log_date,log_notes) 
                VALUES 
                ($OrgAdminID,'$gloSID','update_profile',INET_ATON('$gloIP'),'$gloTimeStamp','Kundprofilen: $ClientCompany är avbruten/Nekad. Kontakta Support om något är fel.')";
                mysqli_query($SQLlink,$strSQL);
                
                
				$_SESSION['success'] = "Kundprofilen nekades utan problem.";
				header("Location: $gloBaseModule&show=newclients");
			}
			else {
				$_SESSION['error'] = "Kundprofilen kunde inte nekas korrekt. Var god försök igen eller kontakta administratören.";
				header("Location: $gloBaseModule&show=newclients");
			}
	}
?>