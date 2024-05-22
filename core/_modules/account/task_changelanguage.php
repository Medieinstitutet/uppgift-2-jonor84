<?php
if (isset($_GET['lid'])) {		
	$strLID			= mysqli_real_escape_string($SQLlink,$_GET['lid']);
	$strSAMESERVICE	= mysqli_real_escape_string($SQLlink,$_GET['s']);

	if (empty($strSAMESERVICE)) { 
		$strSAMESERVICE = "close";
	}

	$_SESSION['LANG'] = $strLID; 
	header("Location: /$strSAMESERVICE");
}
?>