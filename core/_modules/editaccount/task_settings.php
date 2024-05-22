<?php
$Edit	= mysqli_real_escape_string($SQLlink,$_POST['frmEdit']);
if ($Edit) {		
	$strDefaultStart	= mysqli_real_escape_string($SQLlink,$_POST['frmDefaultStart']);
	$strDefaultProfile	= mysqli_real_escape_string($SQLlink,$_POST['frmDefaultProfile']);
	$strDefaultLang		= mysqli_real_escape_string($SQLlink,$_POST['frmDefaultLang']);
	$str2FASMS			= mysqli_real_escape_string($SQLlink,$_POST['frm2FASMS']);

	if ($strDefaultStart) {
		
		$Defaultstart = $strDefaultStart;
		
	} else { 
		$Defaultstart = "";

	}

	if ($str2FASMS == "on") {
        $str2FASMS = 1;
    } else {
        $str2FASMS = 0;
    }

	$strSQL = "
	UPDATE data_users 
	SET 
		2fasms ='$str2FASMS',
		defaultlanguageid ='$strDefaultLang',
		defaultcid='$strDefaultProfile',
		defaultstart='$Defaultstart',
		user_updated='$gloTimeStamp' 
	WHERE id = $gloUID 
	LIMIT 1";

	mysqli_query($SQLlink,$strSQL);		

	if (intval(mysqli_affected_rows($SQLlink))==1) 	{ 
			
		// INSERT EVENT IN LOG
		$Event = "updateprofile";
		$Notes = "Profilinställningar uppdaterades av användaren.";
		addLog($Event, $Notes);

		$_SESSION['success'] = "Dina Profilinställingar uppdaterades utan problem. "; 
		header("Location: $gloBaseModule");
	}
	else { 
		$_SESSION['error'] = "Dina Profilinställingar kunde inte uppdateras korrekt. Var god försök igen eller kontakta administratören."; 	
		header("Location: $gloBaseModule");
	}

}
?>