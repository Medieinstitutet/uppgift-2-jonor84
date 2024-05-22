<?php
if (isset($_POST['frmToUID'])) {			
		$strUID			= mysqli_real_escape_string($SQLlink,$_POST['frmToUID']);

		unset($_SESSION[ "gloCurrentClient" ]);
		unset($_SESSION['ACTIVECLIENT']);

		$_SESSION['UID'] = $strUID; 
		header("Location: /close");

}
?>