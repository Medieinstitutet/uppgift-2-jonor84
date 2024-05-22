<?php
//if (isset($_GET['id'])) {	        

	$strID = mysqli_real_escape_string($SQLlink,$_GET['id']);
	
	$strSQL = "DELETE FROM data_clients_access WHERE id = '$strID' LIMIT 1";
	mysqli_query($SQLlink,$strSQL);
	
	$checkFirst = intval(mysqli_affected_rows($SQLlink));
	if ($checkFirst) { 
	 $_SESSION['success'] = "Användarens behörighet på profilen togs bort utan problem.";
	 header("Location: $gloBaseModule&show=user_access");
	} else {
	 $_SESSION['error'] = "Användarens behörighet på profilen kunde inte tas bort. Var god försök igen eller kontakta administratören.";
	 header("Location: $gloBaseModule&show=user_access");
	}
//}		
?>		
