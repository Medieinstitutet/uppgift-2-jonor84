<?php
if (isset($_POST['frmUser'])) {
    $strAccess        = mysqli_real_escape_string($SQLlink, $_POST['frmAccess']);
    $strUser        = mysqli_real_escape_string($SQLlink, $_POST['frmUser']);

    $strMBINGO        = mysqli_real_escape_string($SQLlink, $_POST['frmMBINGO']);
    $strMSITE        = mysqli_real_escape_string($SQLlink, $_POST['frmMSITE']);
    $strMHALO        = mysqli_real_escape_string($SQLlink, $_POST['frmMHALO']);

    if ($strMHALO == "on") {
        $strMHALO = 1;
    } else {
        $strMHALO = 0;
    }
    if ($strMBINGO == "on") {
        $strMBINGO = 1;
    } else {
        $strMBINGO = 0;
    }
    if ($strMSITE == "on") {
        $strMSITE = 1;
    } else {
        $strMSITE = 0;
    }

    if ($strAccess == "2") {
        $strMSITE = 1;
        $strMBINGO = 1;
        $strMHALO = 1;
    }

    $strMSitesID    = mysqli_real_escape_string($SQLlink, implode(",", $_POST['frmMSitesID']));
    // $strMHalosID    = mysqli_real_escape_string($SQLlink, implode(",", $_POST['frmMHalosID']));
    $strMBingosID    = mysqli_real_escape_string($SQLlink, implode(",", $_POST['frmMBingosID']));

    // check if e-mail address is well-formed
    if (!filter_var($strUser, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Felaktig E-postadress. Var god försök igen.";
        //header("Location: $gloBaseModule&show=subaccounts");
    } else if ($gloUserMail == $strUser) {
        $_SESSION['info'] = "Du kan inte bjuda in dig själv då du redan har behörighet.";
        //header("Location: $gloBaseModule&show=subaccounts");
    } else {

        //Checking if email/username exist 
        $strSQL = "SELECT * FROM data_users WHERE user_email = '$strUser'";
        $results = mysqli_query($SQLlink, $strSQL);
        $CHECKEMAIL = mysqli_num_rows($results);

        if ($CHECKEMAIL > 0) {
            //IF USER EXIST
            //$_SESSION['info'] = "Användarkontot finns. ";
            // if user exist get user id 
            $strSQL = "
            SELECT 
             id, user_access
            FROM data_users
            WHERE user_email = '$strUser'
            LIMIT 1";
            $result = mysqli_query($SQLlink, $strSQL);
            $row = mysqli_fetch_assoc($result);

            $USERID = $row['id'];
            $USERACCESS = $row['user_access'];

            $MAILUEXIST = 1;
        } else if ($CHECKEMAIL == 0) {
            //IF USER DONT EXIST
            //$_SESSION['info'] = "Användarkontot finns inte. ";
            // if user dont exist, create a new user account - with usernew=1 and accetterms=0

            $UserNew = 1; // new user 
            $UserAccessDefault = 3; // Own account
            $UserAcceptedTerms = 0; // Not accepted terms yet
            $UserFName = "TMPNAME"; // temp name for admin purposes - not showing for user.
            $Registered = 0; // user not registered yet (temp account) 

            $strSQLAccess = "
          INSERT INTO data_users
		  (group_id, brandid, registered, user_email,user_fname,accepted_terms,user_access,user_new,user_added,user_updated) 
		VALUES 
		  ('$gloResellerID','$gloBrandID','$Registered','$strUser','$UserFName','$UserAcceptedTerms','$UserAccessDefault','$UserNew','$gloTimeStamp','$gloTimeStamp')";
            mysqli_query($SQLlink, $strSQLAccess);

            $USERID = $SQLlink->insert_id;
            $MAILUEXIST = 0;
            $USERACCESS = 0;
        }
        //Checking if email/username already has access to this clientprofile 
        $strSQLA = "SELECT * FROM data_clients_access WHERE cid='$gloCurrentClientID' AND uid = '$USERID'";
        $resultsA = mysqli_query($SQLlink, $strSQLA);
        $CHECKEMAILA = mysqli_num_rows($resultsA);

        if ($CHECKEMAILA > 0) {
            $_SESSION['info'] = "Denna användare har redan behörighet till denna kundprofil.";
            header("Location: $gloBaseModule&show=subaccounts");
        } else if ($USERACCESS > 6) {
            $_SESSION['info'] = "Denna användare har redan behörighet till denna kundprofil.";
            header("Location: $gloBaseModule&show=subaccounts");
        } else {


            $Accepted = "0";

            //ADD CLIENT ACCESS
            $strSQLAccess = "
				INSERT INTO data_clients_access 
				(uid,aid,cid,accepted,activebingo,activesites,activehalo,bingosid,sitesid,added,addeduid,updateduid,updated) 
				VALUES 
				('$USERID','$strAccess','$gloCurrentClientID','$Accepted','$strMBINGO','$strMSITE','$strMHALO','$strMBingosID','$strMSitesID','$gloTimeStamp','$gloUID','$gloUID','$gloTimeStamp')";
            mysqli_query($SQLlink, $strSQLAccess);

            // $checkFirst = intval(mysqli_affected_rows($SQLlink));

            // send mail to invite users
            $mailToAddress = $strUser;
            $mailToName = "";
            $mailReplyAddress = "";
            $mailReplyName = "";

            if ($MAILUEXIST) {
                //SEND MAIL INVITE EXISTING USER                      
                $mailSubject = 'Inbjudan - ' . $gloBrandSiteName;
                $mailMessage = "<p>Du har fått en inbjudan att hantera kundprofil: " . $gloClientCompany . ".</p><p>Om du accepterar inbjudan loggar du in på ditt konto och accepterar inbjudan.</p>";
            } else {
                //SEND MAIL INVITE NONEXISTING USER                  
                $mailSubject = 'Inbjudan - ' . $gloBrandSiteName;
                $REGURL = $gloBrandLoginURL . "/index.php?task=register&u=" . $mailToAddress;

                $mailMessage = "<p>Du har fått en inbjudan att hantera kundprofil: " . $gloClientCompany . ".</p><p>Om du accepterar inbjudan klickar du på länken nedan och skapar ett konto: <br><br>
                        <a href='" . $REGURL . "' target='_blank'>Skapa konto</a></p>";
            }

            $MailStatus = sendMailPM($mailToAddress, $mailToName, $mailSubject, $mailMessage, $mailReplyAddress, $mailReplyName);

            if ($MailStatus == "SUCCESS") {

                //ADD TO USERS LOG
                $Eventtext = "Användare " . $strUser . " bjöds in för att hantera kundprofil: " . $gloClientCompany;
                $strSQL = "
                    INSERT INTO log_admin 
                    (user_id,session_id,log_event,log_ip,log_date,log_notes) 
                    VALUES 
                    ($gloUID,'$gloSID','userinvite',INET_ATON('$gloIP'),'$gloTimeStamp','$Eventtext')";
                mysqli_query($SQLlink, $strSQL);

                //ADD A NOTIFICATION FOR THE USER
                $Nottext = "Inbjudan att hantera kundprofil: " . $gloClientCompany;
                $Notinvite = 1;
                $Notimportant = 1;
                $strSQLNot = "
                    INSERT INTO data_notifications 
                     (important,userid,adminuserid,sessionid,invite,appname,app,applink,notes,date) 
                    VALUES 
                     ('$Notimportant','$USERID','$gloUID','$gloSID','$Notinvite','orginvites','account','/account&show=orginvites','$Nottext','$gloTimeStamp')";
                mysqli_query($SQLlink, $strSQLNot);

                $_SESSION['success'] = "Användaren bjöds in utan problem.";
                header("Location: $gloBaseModule&show=subaccounts");
            } else {
                $_SESSION['error'] = "Användaren kunde inte bjödas in korrekt, var god försök igen eller kontakta support.";
                header("Location: $gloBaseModule&show=subaccounts");
            }
        }
    }
}
