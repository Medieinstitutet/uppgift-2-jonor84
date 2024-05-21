<?php
if ($task == 'remail') {
    // GET DATA FROM POST
    $strUser = mysqli_real_escape_string($SQLlink, $_POST['frmUser'] ?? '');
    $BRANDING = mysqli_real_escape_string($SQLlink, $_POST['frmBRANDING'] ?? '');

 
    // Get Brand Name
    $BRANDNAME = $gloBrandSiteName;
    // get UserID and First name
    $UserID = getUserID($strUser);
    $UserFirstName = UserFirstName($UserID);
    // Define Sendtype
    $Sendtype = 'email';

    // Check user email
    $EmailMatch = verifyUserEmail($strUser);

    if ($EmailMatch == 0) { 
        $_SESSION['info'] = 'Det gick inte att skicka e-post till denna e-postadress. Detta kan bero på flera orsaker men den vanligaste, är att den inte existerar i vårt system. Var god kontakta support om du behöver hjälp.';
        header("location: ?task=login");
    } else { 

        // Code - Get a fresh code
        $CODE = GeneratePIN(6);
  
        // Add code to active codes with limited expiring - $type, $reciever, $userid, $code
        addCodeAuth($Sendtype, $strUser, $UserID, $CODE);

        // Prepare Text with code for sending
        $Subject = 'Lösenordsåterställning - ' . $gloBrandSiteName;
        $Message = "
        <b>Använd denna 6-siffriga KOD för att kunna byta lösenord: </b><br>
        <h1>$CODE</h1></p>
        <p>Om det inte var du som begärde detta så kan du strunta i detta mailet. Ett inlägg har gjorts i din aktivitetslogg, med bl.a. IP:n hos datorn som gjorde det. Aktivitetsloggen hittar du under Min Profil / Aktivitetslogg.</p>
        ";

        // SEND Email - $mailToAddress, $mailToName, $mailSubject, $mailMessage, $mailuserID, $mailReplyAddress = null, $mailReplyName = null
        $MailSent = sendMailPM($strUser, $UserFirstName, $Subject, $Message, $UserID);
        if ($MailSent) { 
            $_SESSION['info'] = 'E-postmeddelandet är skickat.';
        } else { 
            $_SESSION['info'] = 'Det gick inte att skicka e-post. Något gick fel. Var god kontakta support om du behöver hjälp.';
        }

        // $_SESSION['info'] = 'E-postmeddelandet är skickat. '.$test;
        header("location: ?task=rcode");
    }

}
?>
