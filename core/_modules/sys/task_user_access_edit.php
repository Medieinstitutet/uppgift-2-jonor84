<?php
if (isset($_POST['frmID'])) {		
	$strID			= mysqli_real_escape_string($SQLlink,$_POST['frmID']);
	$strAID			= mysqli_real_escape_string($SQLlink,$_POST['frmAID']); // ACCESS LEVEL ID
	$strUID			= mysqli_real_escape_string($SQLlink,$_POST['frmUID']); // USER ID
	$strCID			= mysqli_real_escape_string($SQLlink,$_POST['frmCID']); // CLIENT ID
	$strActive		= mysqli_real_escape_string($SQLlink,$_POST['frmActive']); 

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


	if ($strActive == "on") { 
		$strActive ="1"; 
	} else { 
		$strActive ="0"; 
	} 

	if ($strActiveHalo == "on") { 
		$strActiveHalo ="1"; 
	} else { 
		$strActiveHalo ="0"; 
	} 

	if ($strActiveBingo == "on") { 
		$strActiveBingo ="1"; 
	} else { 
		$strActiveBingo ="0"; 
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

			$strSQL = "
					UPDATE data_clients_access
					SET
					aid='$strAID',
					cid='$strCID', 
					active='$strActive', 
					economy='$strActiveEconomy', 
					sales='$strActiveSales', 
					support='$strActiveSupport', 
					activebingo='$strActiveBingo',
					bingosid='$strBingosID',
					activesites='$strActiveSites',
					sitesid='$strSitesID',
					activehalo='$strActiveHalo',
					halosid='$strHaloID',
					activehosting='$strActiveHosting',
					hostingsid='$strHostingsID',
					activecards='$strActiveCards',
					cardsid='$strCardsID',
					activedrives='$strActiveDrive',
					drivesid='$strDrivesID',
					halosid='$strHaloID',
					updated='$gloTimeStamp' 
					WHERE id = $strID 
					LIMIT 1";

					mysqli_query($SQLlink,$strSQL);
					$checkFirst = intval(mysqli_affected_rows($SQLlink));

					if ($checkFirst) 	{ 
					 $_SESSION['success'] = "Användarens behörighet uppdaterades utan problem.";
					 header("Location: $gloBaseModule&show=user_access");
					}
					else {
					 $_SESSION['error'] = "Användaren kunde inte uppdateras korrekt";
					 header("Location: $gloBaseModule&show=user_access");
					}
				
}
?>