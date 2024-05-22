<?php
$strPhone	= mysqli_real_escape_string($SQLlink,$_POST['frmPhone']);
if ($strPhone) {		
	$strCode	= mysqli_real_escape_string($SQLlink,$_POST['frmCode']);

    // Check code
    $CodeActive = verifyPwCode($strCode);
    
    if (!$CodeActive) { 
        $_SESSION['info'] = 'Koden för att verifiera mobilnumret är ogiltig. Var god prova igen eller kontakta support.';
        header("location: $gloBaseModule");
    } else { 

        $verified = 1;
        
        $strSQL = "
        UPDATE data_users 
        SET 
            verifiedphone ='$verified',
            user_phone ='$strPhone',
            user_updated='$gloTimeStamp' 
        WHERE id = $gloUID 
        LIMIT 1";

        mysqli_query($SQLlink,$strSQL);		

        if (intval(mysqli_affected_rows($SQLlink))==1) 	{ 
                
            // INSERT EVENT IN LOG
            $Event = "updateprofile";
            $Notes = "Mobilnumret uppdaterades av användaren.";
            addLog($Event, $Notes);

            $_SESSION['success'] = "Ditt mobilnummer uppdaterades utan problem. "; 
            header("Location: $gloBaseModule");
        }
        else { 
            $_SESSION['error'] = "Ditt mobilnummer kunde inte uppdateras korrekt. Var god försök igen eller kontakta support."; 	
            header("Location: $gloBaseModule");
        }
    }

}
?>