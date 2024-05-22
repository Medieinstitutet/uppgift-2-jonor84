<?php
$strPass1	= mysqli_real_escape_string($SQLlink,$_POST['frmPW0']);

if ($strPass1) {	
	$strPass2	= mysqli_real_escape_string($SQLlink,$_POST['frmPW1']);
	$strPass3	= mysqli_real_escape_string($SQLlink,$_POST['frmPW2']);
		
	//Get password hash from database
	$sql_query = "SELECT user_pass FROM data_users WHERE id = $gloUID";
	$result = mysqli_query($SQLlink,$sql_query);
	$row = mysqli_fetch_assoc($result);
	$hash = $row['user_pass'];
		
 	//Check existing password
	if (password_verify($strPass1, $hash)) {
  	  $check = '1'; // Password is valid!
	} else {
   	  $check = '0'; // Invalid password.
	}

 //If valid password ..
 if ($check == 1) {

  //If new password and verify password match
  if ($strPass2==$strPass3) {

	//If new password is valid
	if (valid_pass($strPass2)) {
		
		$new_hash = password_hash("$strPass2", PASSWORD_BCRYPT);
				
		if (strlen($new_hash) >= 20) {

			$strSQL = "
				UPDATE data_users 
				SET 
				user_pass='$new_hash', 
				user_updated='$gloTimeStamp' 
				WHERE id = $gloUID AND user_active > 0 
				LIMIT 1";
				$result = mysqli_query($SQLlink,$strSQL);
										
				if ($result) { 
					
					// INSERT EVENT IN LOG
					$Event = "pwdrecovery";
					$Notes = "Lösenordet uppdaterades av användaren.";
					addLog($Event, $Notes);

					// Get user's IP address, location and browser
					$ip = getIP();
					// $location = getLocationFromIP($ip);
					$userBrowser = getUserBrowser();

					// Get users first name
					$UserFirstname = UserFirstName($gloUID);
					// Get users email
					$UserEmail = UserEmail($gloUID);

					// Message to user
					$MailSubject = "Ditt lösenord har bytts - ".$gloBrandSiteName;
					$MailMessage = "Vi vill informera dig om att ditt lösenord nyss har återställts.<br><br>
					Datum: $gloNow<br>
					App: $userBrowser<br>
					IP: $ip<br><br>
					Om du inte bytt ditt lösenord kan du återfå ditt konto genom att vår lösenordsåterställning.<br><br>
					Vänligen kontakta support om du behöver hjälp.
					";

					// SEND EMAIL to user about password change - $mailToAddress, $mailToName, $mailSubject, $mailMessage, $mailReplyAddress, $mailReplyName
					sendMailPM($UserEmail, $UserFirstname, $MailSubject, $MailMessage);

					$_SESSION['success'] = "Lösenordet uppdaterades utan problem.";
					header("Location: $gloBaseModule");
							
				} else { 
					$_SESSION['error'] = "Lösenordet kunde inte uppdateras korrekt. FELKOD: PASS1";
					header("Location: $gloBaseModule"); 
				  }
		} else {
			$_SESSION['error'] = "Lösenordet kunde inte uppdateras korrekt.FELKOD: PASS2"; 
			header("Location: $gloBaseModule");
		  } 

	} else {
		$_SESSION['error'] = "Lösenordet ej starkt nog. Se Lösenordsinformation.";
		header("Location: $gloBaseModule"); 
	  } 
  }
  else { 
	$_SESSION['error'] = "Lösenorden matchar ej.";
	header("Location: $gloBaseModule");
  }
 }
 else { 
	$_SESSION['error'] = "Ditt nuvarande lösenord är inte rätt.";
	header("Location: $gloBaseModule"); 
 }
}
else { 	$_SESSION['info'] = "Du skrev inget i fälten.";
	header("Location: $gloBaseModule"); 
}
?>