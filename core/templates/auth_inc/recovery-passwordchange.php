<?php
if ($task == 'rpasschange') {
    // GET DATA FROM POST
    $strCode = mysqli_real_escape_string($SQLlink, $_POST['frmCODE']);
    $strUID = mysqli_real_escape_string($SQLlink, $_POST['frmUID']);
    $strPW1 = mysqli_real_escape_string($SQLlink, $_POST['frmPW1']);
    $strPW2 = mysqli_real_escape_string($SQLlink, $_POST['frmPW2']);

    if ($strPW1 == $strPW2) { 
        $PasswordMatch = 1;
    } else { 
        $PasswordMatch = 0;
    }

    if ($PasswordMatch) { 

        // hash and update password, activity log, reset login tries.
        $PasswordUpdated = userUpdatePwd($strPW1, $strUID);

        if ($PasswordUpdated) { 
            // Inactivate code
            deactivatePwdCode($strCode);

            $_SESSION['success'] = 'Lösenordet är nu ändrat och du kan nu logga in.';
            header("location: ?task=login");

        } else { 
            $_SESSION['danger'] = 'Något gick fel, försök igen.';
            header("location: ?task=rpass&code=$strCode");
        }

    } else { 
        $_SESSION['danger'] = 'Något gick fel, försök igen.';
        header("location: ?task=forget");
    }

}
?>
