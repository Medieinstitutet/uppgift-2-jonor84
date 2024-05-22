<?php
if (isset($_POST['frmAID'])) {		
		$strAID			= mysqli_real_escape_string($SQLlink,$_POST['frmAID']); // ACCESS LEVEL ID
		$strUID			= mysqli_real_escape_string($SQLlink,$_POST['frmUID']); // USER ID
		$strCID			= mysqli_real_escape_string($SQLlink,$_POST['frmCID']); // CLIENT ID

		$strActiveBingo		= mysqli_real_escape_string($SQLlink,$_POST['frmActiveBingo']); 
		$strBingosID		= mysqli_real_escape_string($SQLlink,$_POST['frmBingosID']); // IF LIMITED - WICH GAMEPLACES FOR MOONBINGO
	
		$strActiveSites		= mysqli_real_escape_string($SQLlink,$_POST['frmActiveSites']); 
		$strSitesID			= mysqli_real_escape_string($SQLlink,$_POST['frmSitesID']); // IF LIMITED - WICH SITES FOR MOONSITE
	
		$strActiveHalo		= mysqli_real_escape_string($SQLlink,$_POST['frmActiveHalo']); 
		$strHaloID			= mysqli_real_escape_string($SQLlink,$_POST['frmHaloID']); // IF LIMITED - WICH SITES FOR MOONHALO
	
		$strActiveHosting	= mysqli_real_escape_string($SQLlink,$_POST['frmActiveHosting']); 
		$strHostingsID		= mysqli_real_escape_string($SQLlink,$_POST['frmHostingsID']); // IF LIMITED - WICH hostinaccount
	
		$strActiveCards		= mysqli_real_escape_string($SQLlink,$_POST['frmActiveCards']); 
		$strCardsID			= mysqli_real_escape_string($SQLlink,$_POST['frmCardsID']); // IF LIMITED - WICH CARDS
	
		$strActiveDrive		= mysqli_real_escape_string($SQLlink,$_POST['frmActiveDrive']); 
		$strDrivesID		= mysqli_real_escape_string($SQLlink,$_POST['frmDrivesID']); // IF LIMITED - WICH Drives
	
		$strActiveEconomy		= mysqli_real_escape_string($SQLlink,$_POST['frmActiveEconomy']); 
		$strActiveSales		= mysqli_real_escape_string($SQLlink,$_POST['frmActiveSales']); 
		$strActiveSupport		= mysqli_real_escape_string($SQLlink,$_POST['frmActiveSupport']); 

		$strAccepted		= 1; 
		$strActive			= 1; 


		if ($strActiveBingo == "on") { 
            $strActiveBingo ="1"; 
        } else { 
            $strActiveBingo ="0"; 
        } 

		if ($strActiveHalo == "on") { 
			$strActiveHalo ="1"; 
		} else { 
			$strActiveHalo ="0"; 
		} 

		if ($strActiveSites == "on") { 
            $strActiveSites ="1"; 
        } else { 
            $strActiveSites ="0"; 
        } 

		if ($strActiveHosting == "on") { 
			$strActiveHosting ="1"; 
		} else { 
			$strActiveHosting ="0"; 
		} 
	
	
		if ($strActiveCards == "on") { 
			$strActiveCards ="1"; 
		} else { 
			$strActiveCards ="0"; 
		} 
	
	
		if ($strActiveDrive == "on") { 
			$strActiveDrive ="1"; 
		} else { 
			$strActiveDrive ="0"; 
		} 

		if ($strActiveEconomy == "on") { 
			$strActiveEconomy ="1"; 
		} else { 
			$strActiveEconomy ="0"; 
		} 
	
		if ($strActiveSales == "on") { 
			$strActiveSales ="1"; 
		} else { 
			$strActiveSales ="0"; 
		} 
	
		if ($strActiveSupport == "on") { 
			$strActiveSupport ="1"; 
		} else { 
			$strActiveSupport ="0"; 
		} 

		
  //Checking if ACCESS ON CLIENT EXIST 
  $strSQL = "SELECT * FROM data_clients_access WHERE uid = '$strUID' AND cid = '$strCID'";
  $results = mysqli_query($SQLlink,$strSQL);
  $CHECKACCESS = mysqli_num_rows($results);

  if ($CHECKACCESS > 0) {
        $_SESSION['error'] = "Denna användare har redan en behörighetsnivå på denna KundProfil.";
		header("Location: $gloBaseModule&show=user_access");
  } else if ($CHECKACCESS == 0) {  				
	
			$strSQL = "
				INSERT INTO data_clients_access 
				(aid,
				 uid,cid,active,accepted,
				 activesites, sitesid, 
				 activehalo, halosid,
				 activebingo, bingosid,
				 activehosting, hostingsid,
				 activecards, cardsid,
				 activedrives, drivesid,
				 economy, sales, support,
				 added, updated) 
				VALUES 
				('$strAID',
				 '$strUID','$strCID','$strActive','$strAccepted',
				 '$strActiveSites','$strSitesID',
				 '$strActiveHalo','$strHaloID',
				 '$strActiveBingo','$strBingosID',
				 '$strActiveHosting','$strHostingsID',
				 '$strActiveCards','$strCardsID',
				 '$strActiveDrive','$strDrivesID',
				 '$strActiveEconomy','$strActiveSales','$strActiveSupport',
				 '$gloTimeStamp','$gloTimeStamp')";			
				mysqli_query($SQLlink,$strSQL);			
				
				$checkFirst = intval(mysqli_affected_rows($SQLlink));

				if ($checkFirst) 	{ 
				 $_SESSION['success'] = "Användarens behörighet skapades utan problem.";
				 header("Location: $gloBaseModule&show=user_access");
				} 
				else {
				 $_SESSION['error'] = "Användarens behörighet kunde inte skapas korrekt, var god försök igen eller kontakta administratören.";
				 header("Location: $gloBaseModule&show=user_access");
				}
			  

  				
 }
}


?>