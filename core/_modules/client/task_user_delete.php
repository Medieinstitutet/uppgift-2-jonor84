<?php
//if (isset($_POST['frmDEL'])) {			

	$strIDA = mysqli_real_escape_string($SQLlink,$_GET['a']);
    $strIDU = mysqli_real_escape_string($SQLlink,$_GET['u']);

	$strSQL = "DELETE FROM data_clients_access WHERE id = '$strIDA' AND uid = '$strIDU' LIMIT 1";
	mysqli_query($SQLlink,$strSQL);
	
	$checkFirst = intval(mysqli_affected_rows($SQLlink));
    
	if ($checkFirst) { 
	 $_SESSION['success'] = "Användarens koppling till kundprofilen togs bort utan problem.";
	 header("Location: $gloBaseModule&show=subaccounts");
	} else {
	 $_SESSION['error'] = "Användarens koppling till kundprofilen kunde inte tas bort. Var god försök igen eller kontakta administratören.";
	 header("Location: $gloBaseModule&show=subaccounts");
	}
//}		
?>		
