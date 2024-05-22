<?php
//if (isset($_GET['id'])) {	        

	$strID = mysqli_real_escape_string($SQLlink,$_GET['id']);

	$strSQL = "DELETE FROM data_users WHERE id = '$strID' LIMIT 1";
	mysqli_query($SQLlink,$strSQL);
	
	$checkFirst = intval(mysqli_affected_rows($SQLlink));
	if ($checkFirst) { 
	 $_SESSION['success'] = "Användaren togs bort utan problem.";
	 header("Location: $gloBaseModule&show=users");
	} else {
	 $_SESSION['error'] = "Användaren kunde inte tas bort. Var god försök igen eller kontakta administratören.";
	 header("Location: $gloBaseModule&show=users");
	}
//}		
?>		
