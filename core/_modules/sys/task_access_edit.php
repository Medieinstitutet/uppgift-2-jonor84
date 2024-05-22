<?php
	if (isset($_POST['frmID'])) {	
		$strID			= intval($_POST['frmID']);
		$strName		= mysqli_real_escape_string($SQLlink,$_POST['frmName']);
		$strNotes		= mysqli_real_escape_string($SQLlink,$_POST['frmNotes']);
		$strActive		= intval($_POST['frmActive']);
				
		$strSQL = "
		UPDATE data_access 
		SET 
		access_name='$strName',
		access_notes='$strNotes',
		access_active=$strActive, 
		access_updated='$gloTimeStamp' 
		WHERE id = $strID 
		LIMIT 1";
		
		mysqli_query($SQLlink,$strSQL);
					
		if (intval(mysqli_affected_rows($SQLlink))==1) 	{ 
			$_SESSION['success'] = "Behörigheterna uppdaterades utan problem";
			//$arrSuccess[] = "Objektet uppdaterades utan problem."; 
			header("Location: $gloBaseModule&show=access");

		}
		else {
			$_SESSION['error'] = "Behörigheterna kunde inte uppdateras korrekt. Försök igen eller kontakta administratören."; 
			header("Location: $gloBaseModule&show=access");

		}
	}

?>