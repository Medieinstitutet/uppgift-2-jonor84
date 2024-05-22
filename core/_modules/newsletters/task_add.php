<?php
if (isset($_POST['frmID'])) {		
		$NewsletterID		= mysqli_real_escape_string($SQLlink,$_POST['frmID']);
		$NewsletterName		= mysqli_real_escape_string($SQLlink,$_POST['frmName']);

        $check = adduserNewsletter($NewsletterID);

        if ($check) 	{ 
            $_SESSION['success'] = "Du är nu prenumerant på nyhetsbrev: ".$NewsletterName;
            header("Location: $gloBaseModule");
        } 
        else {
            $_SESSION['error'] = "Något gick fel, var god försök igen eller kontakta support.";
            header("Location: $gloBaseModule");
        }

}
?>