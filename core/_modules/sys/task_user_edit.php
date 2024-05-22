<?php
if (isset($_POST['frmUser'])) {
	$strID			= mysqli_real_escape_string($SQLlink, $_POST['frmID']);
	$strAccess		= mysqli_real_escape_string($SQLlink, $_POST['frmAccess']);
	$strUser		= mysqli_real_escape_string($SQLlink, $_POST['frmUser']);
	$strPass		= mysqli_real_escape_string($SQLlink, $_POST['frmPass']);
	$strFName		= mysqli_real_escape_string($SQLlink, $_POST['frmFName']);
	$strSName		= mysqli_real_escape_string($SQLlink, $_POST['frmSName']);
	$strActive		= mysqli_real_escape_string($SQLlink, $_POST['frmActive']);
	$strAF		 	= mysqli_real_escape_string($SQLlink, $_POST['frmAF']);
	$strPhone		= mysqli_real_escape_string($SQLlink, $_POST['frmPhone']);
	$strClient		= mysqli_real_escape_string($SQLlink, $_POST['frmClient']);
	// $strHidden		= mysqli_real_escape_string($SQLlink,$_POST['frmHidden']);		
	$strTempPass		= mysqli_real_escape_string($SQLlink, $_POST['frmTempPass']);

	//IF A USER IS SET TO ACTIVE REFILL LOGIN TRIES
	if ($strActive == "on") {
		$strActive = 1;
	} else {
		$strActive = 0;
	}
	if ($strTempPass == "on") {
		$strTempPass = "Y";
	} else {
		$strTempPass = "N";
	}

	if ($strActive == 1) {
		$login_tries = 5;
	}

	$email = $strUser;
	// check if e-mail address is well-formed
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['error'] = "Inga ändringar gjorde på grund av felaktig E-postadress. Var god försök igen.";
		header("Location: $gloBaseModule&show=users");
	} else {


		// IF PASSWORD IS SET 
		if ($strPass) {
			//CHECK PASSWORD
			$CHECKPASS = valid_pass($strPass);
			if ($CHECKPASS) {
				//IF OK PREPARE CHANGE
				$new_hash = password_hash("$strPass", PASSWORD_BCRYPT);

				if (strlen($new_hash) >= 20) {

					$strSQL = "
					UPDATE data_users 
					SET
					user_pass='$new_hash',
					user_fname='$strFName', 
					user_sname='$strSName', 
					user_email='$strUser', 
					user_access='$strAccess', 
					user_active='$strActive', 
					login_tries='$login_tries',
					group_id='$strAF',
					client_id='$strClient',
					user_phone='$strPhone',
					using_tmp_pw='$strTempPass',
					user_updated='$gloTimeStamp' 
					WHERE id = $strID 
					LIMIT 1";
				}
			} else {
				//IF NOT OK SEND BACK WITH ERROR
				$_SESSION['error'] = "Lösenordet ej starkt nog. Se Lösenordsinformation.";
				header("Location: $gloBaseModule&show=users");
			}
		} else {
			$strSQL = "
					UPDATE data_users 
					SET
					user_fname='$strFName', 
					user_sname='$strSName', 
					user_email='$strUser', 
					user_access='$strAccess', 
					user_active='$strActive', 
					login_tries='$login_tries',
					group_id='$strAF',
					client_id='$strClient',
					user_phone='$strPhone',
					using_tmp_pw='$strTempPass',
					user_updated='$gloTimeStamp' 
					WHERE id = $strID 
					LIMIT 1";
		}



		mysqli_query($SQLlink, $strSQL);
		$checkFirst = intval(mysqli_affected_rows($SQLlink));


		if ($checkFirst) {
			$_SESSION['success'] = "Användaren uppdaterades utan problem.";
			header("Location: $gloBaseModule&show=users");
		} else {
			$_SESSION['error'] = "Användaren kunde inte uppdateras korrekt";
			header("Location: $gloBaseModule&show=users");
		}
	}
}
