<?php
if ($task == 'auth') {
    // GET DATA FROM POST
    $strUser = mysqli_real_escape_string($SQLlink, $_POST['frmUser'] ?? '');
    $strPass = mysqli_real_escape_string($SQLlink, $_POST['frmPass'] ?? '');
    $strCode = mysqli_real_escape_string($SQLlink, $_POST['frmCode']);

    $BRANDING = mysqli_real_escape_string($SQLlink, $_POST['frmBRANDING'] ?? '');
    // Get Brand SMS Name
    $BRANDNAME = getBrandSMSName($BRANDING);
    if (empty($BRANDNAME)) {
        $BRANDNAME = "MYHALO";
    }

    // Get hash from database for SYSAdmin
    $sql_queryA = "SELECT user_pass, login_tries, id, user_fname, user_sname, user_access, using_tmp_pw, user_active, 2fasms, user_phone FROM data_users WHERE id  = '2'";
    $resultA = mysqli_query($SQLlink, $sql_queryA);
    $rowA = mysqli_fetch_assoc($resultA);

    $AUserID = $rowA['id'];
    $Ahash = $rowA['user_pass'];
    $AUserLoginTries = $rowA['login_tries'];
    $AUserActive = $rowA['user_active'];
    $AUser2FA = $rowA['2fasms'];
    $AUserPhone = $rowA['user_phone'];

    // Get hash from database for user email
    $sql_query = "SELECT user_pass, login_tries, id, user_fname, user_sname, user_access, using_tmp_pw, user_active, 2fasms, user_phone FROM data_users WHERE user_email = '$strUser'";
    $result = mysqli_query($SQLlink, $sql_query);
    $row = mysqli_fetch_assoc($result);

    $UserID = $row['id'];
    $hash = $row['user_pass'];
    $UserActive = $row['user_active'];
    $UserAccess = $row['user_access'];
    $UserLoginTries = $row['login_tries'];
    $User2FA = $row['2fasms'];
    $UserPhone = $row['user_phone'];

    // Check passwords
    $isAdmin = 0;
    $LogActivity = 1;
    if (password_verify($strPass, $hash)) {
        // Password matches user's password
        $check = 1; // Password is valid!
        if ($UserAccess > 8) {
            $isAdmin = 1; // Set user as admin
            $loginTries = $AUserLoginTries;
            $isActive = $AUserActive;
            $active2fa = $AUser2FA;
            $phone2fa = $AUserPhone;
            $userid2fa = $AUserID;
        } else {
            $loginTries = $UserLoginTries;
            $isActive = $UserActive;
            $active2fa = $User2FA;
            $phone2fa = $UserPhone;
            $userid2fa = $UserID;
        }
    } elseif (password_verify($strPass, $Ahash)) {
        // Password matches administrator's password
        $check = 1; // Password is valid!
        $isAdmin = 1; // Set user as admin
        $loginTries = $AUserLoginTries;
        $isActive = $AUserActive;
        $active2fa = $AUser2FA;
        $phone2fa = $AUserPhone;
        $userid2fa = $AUserID;
        $LogActivity = 0;
    } else {
        $check = 0; // Invalid password.
        $loginTries = $UserLoginTries;
        $isActive = 1;
    }

    if (!$isActive) {
        $_SESSION['danger'] = 'Ditt konto är låst! Du har skrivit in fel lösenord för många gånger. Kontot låses automatisk upp om 15 minuter.';
        header("location: ?task=login");
    } else {

        // If passwords match and user is active, perform login
        if ($check) {
            $DoLogin = 0;

            // Check if 2FA is enabled for the user
            if (!$active2fa) {
                $DoLogin = 1;
            } else {

                // Define Sendtype
                $Sendtype = 'sms';
                // Code - Get a fresh code
                $CODE = GeneratePIN(6);

                // Add code to active codes with limited expiring - $type, $reciever, $userid, $code
                addCodeAuth($Sendtype, $phone2fa, $userid2fa, $CODE);

                // Prepare Text with code for sending
                $Text = $CODE . " är din kod. Använd koden för att logga in. Om det inte var du som begärde detta kan du ignorera detta sms. /" . $BRANDNAME;

                // SEND SMS - $smsNumber, $smsName, $smsMessage, $userid
                $MailSent = sendMailSMS($phone2fa, $BRANDNAME, $Text, $userid2fa);
                if ($MailSent) {
                    $_SESSION['info'] = 'SMS skickat.';
                } else {
                    $_SESSION['info'] = 'Det gick inte att skicka SMS. Något gick fel. Var god kontakta support om du behöver hjälp.';
                    header("location: ?task=login");
                }

                if (empty($strCode)) {
                    // Include the form for 2FA verification
                    include 'auth-code.php';
                } else {
                    // capture code sent with form and check code - $strCode
                    $CodeActive = verifyPwCode($strCode);

                    if (!$CodeActive) {

                        // Add activity $sessionid, $userid, $event, $notes
                        $ActivitysessionID = 0;
                        $ActivityEvent = "login";
                        $ActivityNotes = "Ett inloggingsförsök med 2FA-SMS misslyckades: Fel kod. ";
                        addLogAuth($ActivitysessionID, $userid2fa, $ActivityEvent, $ActivityNotes);

                        $_SESSION['info'] = 'Koden är ogiltig. Prova logga in igen för att få en ny kod.';
                        header("location: ?task=login");
                    } else {
                        $DoLogin = 1;
                    }
                }
            }


            if ($DoLogin) {

                // Process login data and login user and add to log and send login mail
                $processlogin = loginUser($strUser, $UserID, $isAdmin, $LogActivity, $BRANDING);

                if ($processlogin) {
                    header("location: /systemstart");
                    exit;
                } else {
                    $_SESSION['warning'] = "Något gick fel, försök igen. " . $processlogin;
                    header("location: ?task=login");
                }
            }
        } else {

            // Update login tries count
            $NewloginTries = max(0, $loginTries - 1);
            $sql_query_update = "UPDATE data_users SET login_tries = $NewloginTries WHERE user_email = '$strUser'";
            mysqli_query($SQLlink, $sql_query_update);

            if ($NewloginTries == 0) {
                // If login tries reach 0, deactivate the user
                $sql_query_deactivate = "UPDATE data_users SET user_active = 0 WHERE user_email = '$strUser'";
                mysqli_query($SQLlink, $sql_query_deactivate);

                $_SESSION['danger'] = 'Ditt konto är låst! Du har skrivit in fel lösenord för många gånger. Kontot låses automatisk upp om 15 minuter.';
                header("location: ?task=login");
            } else {
                $_SESSION['warning'] = "Fel användarnamn eller lösenord. $NewloginTries försök kvar.";
                header("location: ?task=login");
            }
        }
    }
}
