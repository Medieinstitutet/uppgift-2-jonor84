<?php
if (isset($_POST['frmID'])) {		
        $NewsletterID		= mysqli_real_escape_string($SQLlink,$_POST['frmID']);
		$NewsletterDesc		= mysqli_real_escape_string($SQLlink,$_POST['frmDesc']);
		$NewsletterName		= mysqli_real_escape_string($SQLlink,$_POST['frmName']);
		$NewsletterActive	= mysqli_real_escape_string($SQLlink,$_POST['frmActive']);

        $check = updateNewsletter($NewsletterID, $NewsletterName, $NewsletterDesc, $NewsletterActive);

        if ($check) 	{ 
            $_SESSION['success'] = "Nyhetsbrevet ".$NewsletterName." är nu ändrat.";
            header("Location: $gloBaseModule");
        } 
        else {
            $_SESSION['error'] = "Något gick fel, var god försök igen eller kontakta support.";
            header("Location: $gloBaseModule");
        }

}
?>