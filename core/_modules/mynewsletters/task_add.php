<?php
if (isset($_POST['frmName'])) {		
		$NewsletterDesc		= mysqli_real_escape_string($SQLlink,$_POST['frmDesc']);
		$NewsletterName		= mysqli_real_escape_string($SQLlink,$_POST['frmName']);
		$NewsletterActive	= mysqli_real_escape_string($SQLlink,$_POST['frmActive']);

        $check = addNewsletter($NewsletterName, $NewsletterDesc, $NewsletterActive);

        if ($check) 	{ 
            $_SESSION['success'] = "Nyhetsbrevet ".$NewsletterName." är nu skapat.";
            header("Location: $gloBaseModule");
        } 
        else {
            $_SESSION['error'] = "Något gick fel, var god försök igen eller kontakta support.";
            header("Location: $gloBaseModule");
        }

}
?>