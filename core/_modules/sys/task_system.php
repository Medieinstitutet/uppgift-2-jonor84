<?php
	if (isset($_POST['frmDomain'])) {		
		$strDomain		= mysqli_real_escape_string($SQLlink,$_POST['frmDomain']);
		$strStatus		= mysqli_real_escape_string($SQLlink,$_POST['frmStatus']);
		$strOfflineMsg		= mysqli_real_escape_string($SQLlink,$_POST['frmOfflineMsg']);
		$strGloNote		= mysqli_real_escape_string($SQLlink,$_POST['frmGloNote']);
		$strTopNote		= mysqli_real_escape_string($SQLlink,$_POST['frmTopNote']);
		$strSideNote		= mysqli_real_escape_string($SQLlink,$_POST['frmSideNote']);
		$strWelcomeNote		= mysqli_real_escape_string($SQLlink,$_POST['frmWelcomeNote']);

		$strSQL = "
		UPDATE data_settings 
		SET
		set_welcomenote = '$strWelcomeNote',
		set_glonote = '$strGloNote',
		set_topnote = '$strTopNote',
		set_sidenote = '$strSideNote',
		set_offlinemsg = '$strOfflineMsg', 
		set_status = '$strStatus',
		set_domain = '$strDomain' 
		WHERE id = '999' 
		LIMIT 1";
		mysqli_query($SQLlink,$strSQL);

		if (intval(mysqli_affected_rows($SQLlink))==1) 	{ 
			$_SESSION['success'] = "System inställningarna uppdaterades utan problem";
			header("Location: $gloBaseModule&show=system");
		}
		else {
			$_SESSION['error'] = "System inställningarna kunde inte uppdateras korrekt";
			header("Location: $gloBaseModule&show=system");
		}
	}
?>