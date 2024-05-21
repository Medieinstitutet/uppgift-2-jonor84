<?php
if ($task == 'regverify') {
    // GET DATA FROM POST
    $strUser = mysqli_real_escape_string($SQLlink, $_POST['frmUser'] ?? '');
    $BRANDING = mysqli_real_escape_string($SQLlink, $_POST['frmBRANDING'] ?? '');

	$IDLinkPID	= mysqli_real_escape_string($SQLlink, $_POST['frmIDLinkPID']);
	$IDLinkCID	= mysqli_real_escape_string($SQLlink, $_POST['frmIDLinkCID']);

    // Get Brand Name
    $BRANDNAME = getBrandSiteName($BRANDING);

    // Define Sendtype
    $Sendtype = 'email';
    $UserID = 0;

    // Check if user email exist
    $EmailExist = checkUserExist($strUser);

    if ($EmailExist) { 
        $_SESSION['info'] = 'Det finns redan ett användarkonto med denna e-postadress. Var god logga in eller använd vår glömt lösenordsfunktion.';
        header("location: ?task=login");
    } else { 

        // Code - Get a fresh code
        $CODE = GeneratePIN(6);
    
        // Add code to active codes with limited expiring - $type, $reciever, $userid, $code
        addCodeAuth($Sendtype, $strUser, $UserID, $CODE);

        // Prepare Text with code for sending
        $Subject = 'Verifiera din e-postadress - ' . $gloBrandSiteName;
        $Message = "<b>Använd denna 6-siffriga KOD för att verifiera din e-postadress: </b><br><h1>$CODE</h1></p><p>Om det inte var du som begärde detta så kan du strunta i detta mailet.</p>";

        // SEND Email - $mailToAddress, $mailToName, $mailSubject, $mailMessage, $mailuserID, $mailReplyAddress = null, $mailReplyName = null
        $MailSent = sendMailPM($strUser, $UserFirstName, $Subject, $Message, $UserID);
        if ($MailSent) { 
            $_SESSION['info'] = 'E-postmeddelandet är skickat.';
        } else { 
            $_SESSION['info'] = 'Det gick inte att skicka e-post. Något gick fel. Var god kontakta support om du behöver hjälp.';
        }
        
        // $_SESSION['info'] = 'E-postmeddelandet är skickat. '.$test;
        header("location: ?task=regcode");

    }
}
?>
