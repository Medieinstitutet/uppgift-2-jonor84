<?php
if (isset($_POST['frmID'])) {		
		$NewsletterID		= mysqli_real_escape_string($SQLlink,$_POST['frmID']);
		$NewsletterName		= mysqli_real_escape_string($SQLlink,$_POST['frmName']);

        $check = removeNewsletter($NewsletterID);

        if ($check) 	{ 
            $_SESSION['success'] = "Nyhetsbrevet ".$NewsletterName." är nu borttaget.";
            header("Location: $gloBaseModule");
        } 
        else {
            $_SESSION['error'] = "Något gick fel, var god försök igen eller kontakta support.";
            header("Location: $gloBaseModule");
        }

}
?>