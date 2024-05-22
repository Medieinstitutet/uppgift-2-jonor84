<?php
if (isset($_POST['frmUser'])) {		
		$strAccess		= mysqli_real_escape_string($SQLlink,$_POST['frmAccess']);
		$strUser		= mysqli_real_escape_string($SQLlink,$_POST['frmUser']);
		$strPass		= mysqli_real_escape_string($SQLlink,$_POST['frmPass']);
		$strFName		= mysqli_real_escape_string($SQLlink,$_POST['frmFName']);
		$strSName		= mysqli_real_escape_string($SQLlink,$_POST['frmSName']);
		$strActive		= mysqli_real_escape_string($SQLlink,$_POST['frmActive']);
		$strAF		 	= mysqli_real_escape_string($SQLlink,$_POST['frmAF']);
		$strClient		= mysqli_real_escape_string($SQLlink,$_POST['frmClient']);
		$strPhone		= mysqli_real_escape_string($SQLlink,$_POST['frmPhone']);
		// $strHidden		= mysqli_real_escape_string($SQLlink,$_POST['frmHidden']);
		$strTempPass		= mysqli_real_escape_string($SQLlink,$_POST['frmTempPass']);


        if ($strActive == "on") { $strActive = 1; } else { $strActive = 0; }
        if ($strTempPass == "on") { $strTempPass ="Y"; } else { $strTempPass ="N"; }

		// check if e-mail address is well-formed
 if (!filter_var($strUser, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Felaktig E-postadress. Var god försök igen.";
	header("Location: $gloBaseModule&show=users");
 } else {

  //Checking if email/username exist 
  $strSQL = "SELECT * FROM data_users WHERE user_email = '$strUser'";
  $results = mysqli_query($SQLlink,$strSQL);
  $CHECKEMAIL = mysqli_num_rows($results);

  if ($CHECKEMAIL > 0) {
        $_SESSION['error'] = "E-postadress upptaget - Var god försök igen.";
	header("Location: $gloBaseModule&show=users");
  } else if ($CHECKEMAIL == 0) {  				

		//CHECK PASSWORD
		$CHECKPASS = valid_pass($strPass);
		if ($CHECKPASS) {
				//IF OK PREPARE CHANGE
				$new_hash = password_hash("$strPass", PASSWORD_BCRYPT);

			if (strlen($new_hash) >= 20) {

			$strSQL = "
				INSERT INTO data_users 
				(brand,using_tmp_pw,user_pass,user_fname,user_sname,
				user_email,user_access,group_id,user_phone,
				user_active,client_id,user_added,user_updated) 
				VALUES 
				('$BRAND','$strTempPass','$new_hash','$strFName','$strSName',
				'$strUser',$strAccess,$strAF,'$strPhone',
				'$strActive','$strClient','$gloTimeStamp','$gloTimeStamp')";			
				mysqli_query($SQLlink,$strSQL);			
				
				$checkFirst = intval(mysqli_affected_rows($SQLlink));

					// send user mail?

				if ($checkFirst) 	{ 
					$_SESSION['success'] = "Användaren skapades utan problem.";
					header("Location: $gloBaseModule&show=users");
				} 
				else {
					$_SESSION['error'] = "Användaren kunde inte skapas korrekt, var god försök igen eller kontakta administratören.";
					header("Location: $gloBaseModule&show=users");
				}
			}
				
		} else {
			//IF NOT OK SEND BACK WITH ERROR
			$_SESSION['error'] = "Lösenordet ej starkt nog. Se Lösenordsinformation.";
			header("Location: $gloBaseModule&show=users");
		}	
  }					
 }
}


?>