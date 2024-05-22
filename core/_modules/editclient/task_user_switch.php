<?php
if (isset($_POST['frmToUID'])) {			
		$strUID	= mysqli_real_escape_string($SQLlink,$_POST['frmToUID']);

		unset($_SESSION['ACTIVECLIENT']);
		$_SESSION["gloCurrentClient"] = $gloResellerID;
		$_SESSION['UID'] = $strUID; 
		header("Location: /close");

}
?>