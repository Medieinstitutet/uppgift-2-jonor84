<?php
if ($task == 'regcodeauth') {
    // GET DATA FROM POST
    $strCode = mysqli_real_escape_string($SQLlink, $_POST['frmCode'] ?? '');
    $BRANDING = mysqli_real_escape_string($SQLlink, $_POST['frmBRANDING'] ?? '');

    // Check code
    $CodeActive = verifyPwCode($strCode);
    
    if (!$CodeActive) { 
        $_SESSION['info'] = 'Koden är ogiltig. Prova igen eller påbörja en ny återställning för att få en ny kod. <a href="?task=forget">Starta en ny återställning.</a>';
        header("location: ?task=regcode");
    } else { 
        $_SESSION['info'] = 'Koden är fortfarande giltig.';
        header("location: ?task=regpass&code=$strCode");
    }

}
?>
