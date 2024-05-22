<?php
if (isset($_POST['frmFName'])) {		
		$strFName			= mysqli_real_escape_string($SQLlink,$_POST['frmFName']);
		$strSName			= mysqli_real_escape_string($SQLlink,$_POST['frmSName']);
		$strPID				= mysqli_real_escape_string($SQLlink,$_POST['frmPID']);

		$strSQL = "
		UPDATE data_users 
		SET 
			pid='$strPID', 
			user_fname='$strFName', 
			user_sname='$strSName', 
			user_updated='$gloTimeStamp' 
		WHERE id = $gloUID 
		LIMIT 1";
		mysqli_query($SQLlink,$strSQL);		

		if (intval(mysqli_affected_rows($SQLlink))==1) 	{ 
			
			// INSERT EVENT IN LOG
			$Event = "updateprofile";
			$Notes = "Profilen uppdaterades av användaren.";
			addLog($Event, $Notes);

			$_SESSION['success'] = "Din profil uppdaterades utan problem."; 
			header("Location: $gloBaseModule");
		}
		else { 
			$_SESSION['error'] = "Profilen kunde inte uppdateras korrekt. Var god försök igen eller kontakta administratören."; 	
			header("Location: $gloBaseModule");
		}

}
?>