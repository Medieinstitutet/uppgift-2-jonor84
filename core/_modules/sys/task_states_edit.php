<?php
	if (isset($_POST['frmID'])) {	
		$strID			= intval($_POST['frmID']);
		$strName		= mysqli_real_escape_string($SQLlink,$_POST['frmName']);
		$strInfo		= mysqli_real_escape_string($SQLlink,$_POST['frmInfo']);
				
		$strSQL = "
		UPDATE data_landskap 
		SET 
		namn='$strName',
		info='$strInfo',
		updated='$gloTimeStamp' 
		WHERE id = $strID 
		LIMIT 1";
		
		mysqli_query($SQLlink,$strSQL);
					
		if (intval(mysqli_affected_rows($SQLlink))==1) 	{ 
			$_SESSION['success'] = "Landskapet uppdaterades utan problem";
			//$arrSuccess[] = "Objektet uppdaterades utan problem."; 
			header("Location: $gloBaseModule&show=states");

		}
		else {
			$_SESSION['error'] = "Landskapet kunde inte uppdateras korrekt. Försök igen eller kontakta administratören."; 
			header("Location: $gloBaseModule&show=states");

		}
	}

?>