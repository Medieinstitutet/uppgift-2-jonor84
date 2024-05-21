<?php
if ($task == 'rcodeauth') {
    // GET DATA FROM POST
    $strCode = mysqli_real_escape_string($SQLlink, $_POST['frmCode'] ?? '');
    $BRANDING = mysqli_real_escape_string($SQLlink, $_POST['frmBRANDING'] ?? '');
    $BRANDNAME = ucfirst($BRANDING);

    // Check code
    $CodeActive = verifyPwCode($strCode);
    
    if (!$CodeActive) { 
        $_SESSION['info'] = 'Koden är ogiltig. Prova igen eller påbörja en ny återställning för att få en ny kod. <a href="?task=forget">Starta en ny återställning.</a>';
        header("location: ?task=rcode");
    } else { 
        $_SESSION['info'] = 'Koden är fortfarande giltig.';
        header("location: ?task=rpass&code=$strCode");
    }

}
?>
