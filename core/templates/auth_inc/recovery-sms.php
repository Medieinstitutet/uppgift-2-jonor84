<?php
if ($task == 'rsms') {
    // GET DATA FROM POST
    $strUser = mysqli_real_escape_string($SQLlink, $_POST['frmUser'] ?? '');
    $strPhone = mysqli_real_escape_string($SQLlink, $_POST['frmMobileNumber'] ?? '');
    $BRANDING = mysqli_real_escape_string($SQLlink, $_POST['frmBRANDING'] ?? '');

    // Get Brand SMS Name
    $BRANDNAME = getBrandSMSName($BRANDING);
    // get UserID
    $UserID = getUserID($strUser);
    // Define Sendtype
    $Sendtype = 'sms';

    // Check user and phone
    $PhoneMatch = verifyUserSMS($strUser, $strPhone);
               
    if (!$PhoneMatch) { 
        $_SESSION['info'] = 'Det gick inte att skicka ett sms till detta nummer. Detta kan bero på flera orsaker men den vanligaste, är att den inte hör ihop med e-postadressen. Var god kontakta support om du behöver hjälp.';
        header("location: ?task=login");

    } else { 

        // Code - Get a fresh code
        $CODE = GeneratePIN(6);
   
        // Add code to active codes with limited expiring - $type, $reciever, $userid, $code
        addCodeAuth($Sendtype, $strUser, $UserID, $CODE);

        // Prepare Text with code for sending
        $Text = $CODE. " är din kod. Använd koden för att byta lösenord. Om det inte var du som begärde detta kan du ignorera detta sms. /".$BRANDNAME;

        // SEND SMS - $smsNumber, $smsName, $smsMessage, $userid
        $MailSent = sendMailSMS($strPhone, $BRANDNAME, $Text, $UserID);
        if ($MailSent) { 
            $_SESSION['info'] = 'SMS skickat.';
        } else { 
            $_SESSION['info'] = 'Det gick inte att skicka SMS. Något gick fel. Var god kontakta support om du behöver hjälp.';
        }

        //$_SESSION['info'] = 'YES '.$PhoneMatch.' '.$test;
        header("location: ?task=rcode");
    }

}
?>
