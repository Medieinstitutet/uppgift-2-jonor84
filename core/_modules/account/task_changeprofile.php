<?php
if (isset($_GET['c'])) {		
		$strID			= mysqli_real_escape_string($SQLlink,$_GET['c']);
		$strSAMEPAGE	= mysqli_real_escape_string($SQLlink,$_POST['frmSAMEPAGE']);
		$strSAMESERVICE	= mysqli_real_escape_string($SQLlink,$_GET['s']);

		if ($_SESSION["service"] == "account") { 
		//	unset($_SESSION["service"]); 
		} 
    
    $strSQLActiveClient = "
	SELECT t1.id,t1.companyname,t2.se_type
	FROM data_clients AS t1
    LEFT JOIN data_clienttypes AS t2 
    ON t1.typeid = t2.id    
	WHERE t1.id = '$strID'
	ORDER BY id DESC
	LIMIT 100";
	$arrRSActiveClient = mysqli_query($SQLlink,$strSQLActiveClient);
    
		        // IF RS = TRUE THEN PRINT TABLE
        		if (mysqli_num_rows($arrRSActiveClient)) {

					// LOOPS RS AND PRINTS TABLE
					while ($arrRowActiveClient = mysqli_fetch_row($arrRSActiveClient)) {
									
					// PUT RS IN VARS
					$rowID	= $arrRowActiveClient[0];
					$rowCompanyName	= $arrRowActiveClient[1];
                    $rowClientType	= $arrRowActiveClient[2];

                    $Success = '1';
                    $_SESSION['gloCurrentClient'] = $rowID;
                    }
                } else {
                    $Success = '0';
                }
	
    
		if ($Success == '1') 	{ 
            
			$_SESSION['success'] = "Kundprofilen byttes utan problem till: ".$rowCompanyName; 
            
			// INSERT EVENT IN LOG
            $Eventtext = "Användaren bytte profil till ".$rowCompanyName; 
			$strSQL = "
			INSERT INTO log_admin 
			(user_id,session_id,log_event,log_ip,log_date,log_notes) 
			VALUES 
			($gloUID,'$gloSID','update_profile',INET_ATON('$gloIP'),'$gloTimeStamp','$Eventtext')";
			mysqli_query($SQLlink,$strSQL);
			if ($strSAMEPAGE) { 
				header("Refresh:0;");
			} else {
				header("Refresh:0; url=/close");
			}

			//header("Location: /dashboard");
		}
		else { $_SESSION['error'] = "Kundprofilen kunde inte bytas korrekt. Var god försök igen eller kontakta support."; 	
		header("Location: /close");
		}
	} else {

}
?>