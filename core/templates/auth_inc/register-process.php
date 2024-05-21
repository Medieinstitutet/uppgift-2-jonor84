<?php
if ($task == 'regprocess') {

    // GET DATA FROM POST
    $strUser = mysqli_real_escape_string($SQLlink, $_POST['frmUser'] ?? '');
    $BRANDING = mysqli_real_escape_string($SQLlink, $_POST['frmBRANDING'] ?? '');
    $strCode = mysqli_real_escape_string($SQLlink, $_POST['frmCODE'] ?? '');

	$strPass = mysqli_real_escape_string($SQLlink, $_POST['frmPW1']);
	$strPass2 = mysqli_real_escape_string($SQLlink, $_POST['frmPW2']);

	$IDLinkPID	= mysqli_real_escape_string($SQLlink, $_POST['frmIDLinkPID']);
	$IDLinkCID	= mysqli_real_escape_string($SQLlink, $_POST['frmIDLinkCID']);

	$strACCEPTGDPR = "1";

    // Get Brand Name
    $BRANDNAME = getBrandSiteName($BRANDING);
    // get UserID and First name
    $UserID = getUserID($strUser);
    $UserFirstName = '';
    // Define Sendtype
    $Sendtype = 'email';

	// CHECK IF PASSWORDS MATCH
	if ($strPass == $strPass2) {
		$PasswordMatch = "1";
	} else {
		$PasswordMatch = "0";
	}

    if (!$PasswordMatch) { 
        $_SESSION['info'] = 'Det gick inte att skicka skapa ditt användarkonto. Var god försök igen. Kontakta support om du behöver hjälp.';
        header("location: ?task=login");
    } else { 

        // create user account - $pwd, $useremail
        $AccountCreated = registerNewUser($strPass, $strUser);
 
        if (!$AccountCreated) { 
            $_SESSION['info'] = 'Det gick inte att skicka skapa ditt användarkonto. Var god försök igen. Kontakta support om du behöver hjälp.';
            header("location: ?task=login");
        } else { 

            // Add activity $sessionid, $userid, $event, $notes
            $ActivityEvent = "register";
            $ActivityNotes = "Användaren registrerade sig.";
            addLogAuth($sessionid, $UserID, $ActivityEvent, $ActivityNotes);         

            // Deactivate code
            deactivatePwdCode($strCode);

            // Prepare Text with code for sending welcome mail
            $Subject = 'Varmt välkommen till ' . $gloBrandSiteName;
            $Message = trim($gloBrandMailWelcome);

            // SEND Email - $mailToAddress, $mailToName, $mailSubject, $mailMessage, $mailReplyAddress = null, $mailReplyName = null
            sendMailPM($strUser, $UserFirstName, $Subject, $Message, $mailReplyAddress = null, $mailReplyName = null);


            // $_SESSION['info'] = 'E-postmeddelandet är skickat. '.$test;
            $_SESSION['info'] = 'Användarkontot är nu skapat. Du kan nu logga in.';
            header("location: ?task=login");

        }
    }

}
?>
