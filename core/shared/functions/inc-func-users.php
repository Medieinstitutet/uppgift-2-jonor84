<?
// USER FUNCTIONS


// Auth function - login in user
function loginUser($strUser, $UserID, $isAdmin, $logevent, $FOLDERNAME)
{
    global $SQLlink, $gloBrandSiteName;

    // Make new session ID
    session_start();
    $sessionID = session_id();

    // Set session data
    $_SESSION['UID'] = $UserID; // User ID
    $_SESSION['ULIFETIME'] = time(); // Start of session
    $_SESSION['UACTIVE'] = time(); // Time of last action
    $_SESSION['SID'] = $sessionID; // Session ID
    $_SESSION['BRANDING'] = $FOLDERNAME; // Folder name -> get right branding
    $_SESSION['MAINBRANDING'] = $FOLDERNAME; // Folder name -> get right main branding

    if ($isAdmin) {
        $_SESSION['ADMIN'] = $UserID; // Admin user ID
    }

    // Reset login tries and set latest login to now
    $sql_query = "UPDATE data_users SET accepted_terms = 1, login_tries = 5, last_login = NOW() WHERE id = $UserID";
    mysqli_query($SQLlink, $sql_query);

    if ($logevent) {
        // Add activity $sessionid, $userid, $event, $notes
        $ActivityEvent = "login";
        $ActivityNotes = "Inlogging: " . $_SERVER['HTTP_USER_AGENT'];
        addLogAuth($sessionID, $UserID, $ActivityEvent, $ActivityNotes);

        // Get user's IP address, location, and browser
        $ip = getIP();
        // $location = getLocationFromIP($ip);
        $userBrowser = getUserBrowser();

        // Get user's first name
        $UserFirstname = UserFirstName($UserID);
        $gloDateNow = date('Y-m-d H:i'); // DATE/TIME NOW			

        // Message to user
        $MailSubject = "Ny inloggning på ditt konto - " . $gloBrandSiteName;
        $MailMessage = "Det har skett en ny inloggning på ditt konto nyss.<br><br>
        Datum: $gloDateNow<br>
        App: $userBrowser<br>
        IP: $ip<br><br>
        Om det inte var du, bör du byta ditt lösenord för att skydda ditt konto.<br><br>
        Vänligen kontakta support om du behöver hjälp.
        ";

        // Send email to user about new login - $mailToAddress, $mailToName, $mailSubject, $mailMessage, $mailuserID
        sendMailPM($strUser, $UserFirstname, $MailSubject, $MailMessage, $UserID);
    }
    $LoginSuccess = 1;
    return $LoginSuccess;
}


// Auth function to get userid from user email
function getUserID($user)
{
    global $SQLlink, $BRAND;

    // Check if user exist
    $strSQL = "SELECT * FROM data_users WHERE user_email = '$user'";
    $results = mysqli_query($SQLlink, $strSQL);
    $UserExist = mysqli_num_rows($results);

    if (!$UserExist) {
        $UserID = 0;
    } else {
        // GET user id from user
        $strSQLUserid = "SELECT id FROM data_users WHERE user_email = '$user' LIMIT 1";
        $resultUserid = mysqli_query($SQLlink, $strSQLUserid);
        $rowUserid = mysqli_fetch_assoc($resultUserid);
        $UserID = $rowUserid['id'];
    }

    return $UserID;
}


// Auth function to check email and phone
function verifyUserSMS($user, $phone)
{
    global $SQLlink, $BRAND;

    // Check if user exist
    $strSQL = "SELECT * FROM data_users WHERE user_email = '$user'";
    $results = mysqli_query($SQLlink, $strSQL);
    $UserExist = mysqli_num_rows($results);

    if (!$UserExist) {
        $PhoneMatch = 0;
    } else {
        // GET phone from user
        $strSQLPhone = "SELECT user_phone FROM data_users WHERE user_email = '$user' LIMIT 1";
        $resultPhone = mysqli_query($SQLlink, $strSQLPhone);
        $rowPhone = mysqli_fetch_assoc($resultPhone);
        $UserPhone = $rowPhone['user_phone'];

        // Check if phone matches
        if ($phone == $UserPhone) {
            $PhoneMatch = 1;
        } else {
            $PhoneMatch = 0;
        }
    }

    return $PhoneMatch;
}

// Auth function to check email
function verifyUserEmail($user)
{
    global $SQLlink, $BRAND;

    // Check if user exist
    $strSQL = "SELECT * FROM data_users WHERE user_email = '$user'";
    $results = mysqli_query($SQLlink, $strSQL);
    $UserExist = mysqli_num_rows($results);

    if ($UserExist) {
        $EmailMatch = 1;
    } else {
        $EmailMatch = 0;
    }

    return $EmailMatch;
}

// update user pass
function userUpdatePwd($pwd, $userid)
{
    global $SQLlink, $BRAND;

    $new_hash = password_hash($pwd, PASSWORD_BCRYPT);
    if (strlen($new_hash) >= 20) {
        $strSQL = "UPDATE data_users SET user_pass='$new_hash', user_updated=NOW() WHERE id = '$userid' LIMIT 1";
        $result = mysqli_query($SQLlink, $strSQL);

        if ($result) {

            // INSERT EVENT IN LOG
            $session_id = 0;
            $ActivityEvent = 'pwdrecovery';
            $ActivityNotes = 'Lösenordet uppdaterades.';
            addLogAuth($session_id, $userid, $ActivityEvent, $ActivityNotes);

            // Reset login tries
            resetLoginTries($userid);

            $PasswordUpdate = 1;
        } else {
            $PasswordUpdate = 0;
        }
    } else {
        $PasswordUpdate = 0;
    }

    return $PasswordUpdate;
}

// register new user
function registerNewUser($pwd, $useremail)
{
    global $SQLlink, $BRAND, $gloTimeStamp, $gloBrandID, $gloBrandResellerID, $gloBrandSiteName, $gloBrandMSGWelcome;

    $strAccess = 3; // CLIENT ADMIN
    $strActive = 1; //  Active 1/0
    $strTmpPass = "N"; //  N/Y
    $strRegistered = 1; //  1 user now registered
    $UserFName = "TMPNAME"; // temp name for admin purposes - not showing for user.
    $UserNew = 1; // 1 user new
    $strACCEPTGDPR = 1; // 1 
    $strVerified = 1; // 1 
    $AccountID = generateAccountID();

    $new_hash = password_hash($pwd, PASSWORD_BCRYPT);
    if (strlen($new_hash) >= 20) {

        $strSQLUSER = "INSERT INTO data_users (userid, verifiedemail, group_id, brand, brandid, registered, user_new, user_fname, user_pass, user_email, user_access, user_active, using_tmp_pw, gdpr_terms, user_added,user_updated) 
        VALUES ('$AccountID','$strVerified','$gloBrandResellerID','$BRAND','$gloBrandID', '$strRegistered', '$UserNew', '$UserFName', '$new_hash', '$useremail', '$strAccess', '$strActive','$strTmpPass', '$strACCEPTGDPR','$gloTimeStamp','$gloTimeStamp')";
        mysqli_query($SQLlink, $strSQLUSER);
        $NewUserID = $SQLlink->insert_id;

        // INSERT EVENT IN LOG
        $session_id = 0;
        $ActivityEvent = 'usernew';
        $ActivityNotes = 'Du registrerade kontot.';
        addLogAuth($session_id, $NewUserID, $ActivityEvent, $ActivityNotes);

        // INSERT MESSAGE - welcome
        $MHeader = 'Varmt välkommen till ' . $gloBrandSiteName;
        $MData = $gloBrandMSGWelcome;
        $MSignature = "Mvh, System";
        $strSQL = "INSERT INTO data_messages (fromuid, touid, header, message, signature, date) VALUES ('0','$NewUserID','$MHeader','$MData','$MSignature','$gloTimeStamp')";
        mysqli_query($SQLlink, $strSQL);

        $NewuserData = $NewUserID;
    } else {
        $NewuserData = 0;
    }

    return $NewuserData;
}




// Auth function to check pw reset code
function verifyPwCode($code)
{
    global $SQLlink, $BRAND;

    // Check if code exist
    $strSQL = "SELECT * FROM data_pw_reset WHERE pin = '$code' AND valid = 'Y'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CodeExist = mysqli_num_rows($results);

    if (!$CodeExist) {
        $ActiveCode = 0;
    } else {
        // GET data from data_pw_reset
        $strSQLPwCode = "SELECT receiver, user, uid, date_expire FROM data_pw_reset WHERE pin = '$code' AND valid = 'Y' LIMIT 1";
        $resultPwCode = mysqli_query($SQLlink, $strSQLPwCode);
        $rowPwCode = mysqli_fetch_assoc($resultPwCode);
        $userReciever = $rowPwCode['receiver']; // new 
        $userEmail = $rowPwCode['user'];    // old
        $UserID = $rowPwCode['uid'];
        $DateExpired = $rowPwCode['date_expire'];



        // Convert dates to timestamps
        $DateNow = date('Y-m-d H:i');
        $timestampNow = strtotime($DateNow);
        $timestampExpired = strtotime($DateExpired);

        // Double check if code has expired
        if ($timestampNow > $timestampExpired) {
            // "Expiration date has passed.";

            // Set valid = N
            $sql_query_deactivate = "UPDATE data_pw_reset SET valid = 'N' WHERE pin = '$code'";
            mysqli_query($SQLlink, $sql_query_deactivate);

            $ActiveCode = 0;
        } else {
            // "Expiration date has not passed yet.";
            $ActiveCode = 1;
        }
    }

    return $ActiveCode;
}

// Auth function to check pw reset code email
function getUserEmailPwCode($code)
{
    global $SQLlink, $BRAND;

    // Check if code exist
    $strSQL = "SELECT * FROM data_pw_reset WHERE pin = '$code' AND valid = 'Y'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CodeExist = mysqli_num_rows($results);

    if (!$CodeExist) {
        $UserEmail = 0;
    } else {
        // GET data from data_pw_reset
        $strSQLPwCode = "SELECT receiver FROM data_pw_reset WHERE pin = '$code' LIMIT 1";
        $resultPwCode = mysqli_query($SQLlink, $strSQLPwCode);
        $rowPwCode = mysqli_fetch_assoc($resultPwCode);
        $UserEmail = $rowPwCode['receiver'];
    }

    return $UserEmail;
}

// Auth function to check pw reset code userid
function getUserIDPwCode($code)
{
    global $SQLlink, $BRAND;

    // Check if code exist
    $strSQL = "SELECT * FROM data_pw_reset WHERE pin = '$code' AND valid = 'Y'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CodeExist = mysqli_num_rows($results);

    if (!$CodeExist) {
        $UserID = 0;
    } else {
        // GET data from data_pw_reset
        $strSQLPwCode = "SELECT uid FROM data_pw_reset WHERE pin = '$code' LIMIT 1";
        $resultPwCode = mysqli_query($SQLlink, $strSQLPwCode);
        $rowPwCode = mysqli_fetch_assoc($resultPwCode);
        $UserID = $rowPwCode['uid'];
    }

    return $UserID;
}

function deactivatePwdCode($code)
{
    global $SQLlink, $BRAND;

    $sql_query_deactivate = "UPDATE data_pw_reset SET valid = 'N' WHERE pin = '$code'";
    $deactivatedtry = mysqli_query($SQLlink, $sql_query_deactivate);

    if ($deactivatedtry) {
        $code_deactivated = 1;
    } else {
        $code_deactivated = 0;
    }
    return $code_deactivated;
}

function resetLoginTries($userid)
{
    global $SQLlink, $BRAND;

    $sql_query = "UPDATE data_users SET login_tries = 5 WHERE id = '$userid'";
    $resettry = mysqli_query($SQLlink, $sql_query);

    if ($resettry) {
        $Reseted = 1;
    } else {
        $Reseted = 0;
    }
    return $Reseted;
}


// Function to add a new log entry for user event
function addLog($event, $notes)
{
    // Get user's IP address
    $ip = ip2long(getIP());

    // Get global variables
    global $SQLlink, $gloUID, $gloSessionID, $gloCurrentClientID, $gloResellerID, $BRAND;

    // Sanitize input values
    $event = $SQLlink->real_escape_string($event);
    $notes = $SQLlink->real_escape_string($notes);

    // Construct SQL query
    $strSQL = "
    INSERT INTO data_activities 
     (brand, resellerid, clientid, uid, sessionid, event, ip, notes, date)
    VALUES 
     ('$BRAND','$gloResellerID','$gloCurrentClientID','$gloUID','$gloSessionID','$event','$ip','$notes', CURRENT_TIMESTAMP)
    ";

    // Execute SQL query
    mysqli_query($SQLlink, $strSQL);

    // Get ID of the newly inserted log entry
    $NEWLOGENTRYID = mysqli_insert_id($SQLlink);

    // Return the ID of the newly inserted log entry
    return $NEWLOGENTRYID;
}

// Function to add a new log entry for user event when not logged in
function addLogAuth($sessionid, $userid, $event, $notes)
{
    // Get user's IP address
    $ip = ip2long(getIP());

    // Get global variables
    global $SQLlink, $BRAND;

    $Add0 = 0;
    if (empty($sessionid)) {
        $sessionid = $Add0;
    }

    // GET current BRAND resellerid from DB
    $strSQLB = "SELECT rid FROM data_branding WHERE brandname = '$BRAND' LIMIT 1";
    $resultB = mysqli_query($SQLlink, $strSQLB);
    $rowB = mysqli_fetch_assoc($resultB);
    $BRANDRID = $rowB['rid'];
    if (empty($BRANDRID)) {
        $BRANDRID = $Add0;
    }

    // Sanitize input values
    $event = $SQLlink->real_escape_string($event);
    $notes = $SQLlink->real_escape_string($notes);

    // Construct SQL query
    $strSQL = "
    INSERT INTO data_activities 
     (brand, resellerid, clientid, uid, sessionid, event, ip, notes, date)
    VALUES 
     ('$BRAND','$BRANDRID','$Add0','$userid','$sessionid','$event','$ip','$notes', CURRENT_TIMESTAMP)
    ";

    // Execute SQL query
    mysqli_query($SQLlink, $strSQL);

    // Get ID of the newly inserted log entry
    $NEWLOGENTRYID = mysqli_insert_id($SQLlink);

    // Return the ID of the newly inserted log entry
    return $NEWLOGENTRYID;
}

// Auth Password recovery codes
function addCodeAuth($type, $reciever, $userid, $code)
{
    // Get global variables
    global $SQLlink, $BRAND;

    // Get user's IP address
    $Ip = ip2long(getIP());

    // Sanitize input values
    $Type = $SQLlink->real_escape_string($type);
    $Reciever = $SQLlink->real_escape_string($reciever);
    $UID = $SQLlink->real_escape_string($userid);
    $Code = $SQLlink->real_escape_string($code);
    $Add0 = 0;

    if (empty($UID)) {
        $UID = $Add0;
    }
    $Dateexpire = date('Y-m-d H:i', strtotime('+5 minutes'));

    // Add to DB
    $strSQLADD = "
    INSERT INTO data_pw_reset 
     (brand, type, receiver, uid, pin, ip, date_expire)
    VALUES 
     ('$BRAND','$Type','$Reciever','$UID','$Code','$Ip','$Dateexpire')
    ";
    mysqli_query($SQLlink, $strSQLADD);

    // Get ID of the newly inserted log entry
    $NEWLOGENTRYID = mysqli_insert_id($SQLlink);

    // Return the ID of the newly inserted log entry
    return $NEWLOGENTRYID;
}



function checkPasswordKey($KEY)
{
    global $SQLlink;
    //TESTING OF CHECK IF KEY EXISTS
    $strSQL = "SELECT * FROM data_pw_reset WHERE valid = 'Y' AND hash = '$KEY'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CHECKKEY = mysqli_num_rows($results);

    if ($CHECKKEY == 0) {
        $VALIDKEY = "0";
    } else {
        $VALIDKEY = "1";
    }
    return $VALIDKEY;
}

function generateAccountID()
{
    $currentYear = date("y");
    $zerodivider = 0;
    $randomPart = generateRandomNonZeroDigits(7); // Generate a 5-digit number without zeros
    $randomString = $currentYear . $zerodivider . $randomPart;
    return $randomString;
}


// Function to update userID for a product
function updateAccountID($uid, $newAccountID)
{
    global $SQLlink;

    $uid = (int) $uid; // Ensure $productId is an integer to prevent SQL injection
    $newAccountID = $SQLlink->real_escape_string($newAccountID); // Escape the new service ID to prevent SQL injection

    // Check if the new service ID already exists
    $checkQuery = "SELECT COUNT(*) as count FROM data_users WHERE userid = '$newAccountID' AND id != $uid";
    $checkResult = $SQLlink->query($checkQuery);

    if ($checkResult) {
        $row = $checkResult->fetch_assoc();
        $count = (int) $row['count'];

        if ($count > 0) {
            // The new service ID already exists, generate a new one
            $newAccountID = generateAccountID();
        }
    } else {
        // Handle the case where the check query failed
        return false;
    }

    // Update the userID in the database
    $query = "UPDATE data_users SET userid = '$newAccountID' WHERE id = $uid";

    if ($SQLlink->query($query)) {
        return true; // Update successful
    } else {
        return false; // Update failed
    }
}

// Function to check and create/update userid for a specific user id
function checkAccountID($userID)
{
    global $SQLlink;

    $userID = (int)$userID; // Ensure $userID is an integer to prevent SQL injection

    // Select the row for the given user id
    $selectQuery = "SELECT id, userid FROM data_users WHERE id = $userID";
    $selectResult = $SQLlink->query($selectQuery);

    if ($selectResult) {
        // Fetch the row
        $row = $selectResult->fetch_assoc();

        if ($row) {
            $existingUserID = $row['userid'];

            if (!$existingUserID) {
                // userid does not exist for the current row, generate and update
                $newUserID = generateAccountID();
                updateAccountID($row['id'], $newUserID);
                // echo $row['id']." ,";
                // echo $newUserID;
            }

            return $existingUserID;
        } else {
            // Handle the case where the row does not exist
            return false;
        }
    } else {
        // Handle the case where the select query failed
        return false;
    }
}


// function to check if reseller is allowed to this module - need to rechek it. Brand allowed to module. 
function userAccessGroupReseller($rid)
{
    global $SQLlink, $BRAND;

    // GET current BRAND resellerid from DB
    $strSQLB = "SELECT rid FROM data_branding WHERE brandname = '$BRAND' LIMIT 1";
    $resultB = mysqli_query($SQLlink, $strSQLB);
    $rowB = mysqli_fetch_assoc($resultB);
    $BRANDRID = $rowB['rid'];

    if ($rid == $BRANDRID) {
        $CHECKAccess = 1;
    } else {
        $CHECKAccess = 0;
    }

    return $CHECKAccess;
}

// function to check if user is allowed to current group
function userAccessGroup($groupID)
{
    global $SQLlink, $gloUID, $BRAND, $gloAccess;

    // GET gid from DB - 1 is editable and 0 is not editable
    $strSQLCHECKAccess = "SELECT id FROM data_groups_access WHERE brand = '$BRAND' AND uid='$gloUID' AND gid = '$groupID'";
    $resultsCHECKAccess = mysqli_query($SQLlink, $strSQLCHECKAccess);
    $CHECKAccess = mysqli_num_rows($resultsCHECKAccess);

    if (empty($CHECKAccess)) {
        $CHECKAccess = 0;
    }
    if ($gloAccess > 6) {
        $CHECKAccess = 1;
    }

    return $CHECKAccess;
}

//CHECK IF USERS HAVE RIGHT TO SHOW AND OPEN CLOUDAPP
function checkUserAllowedApp($gloUID, $AppID)
{
    global $SQLlink, $gloCurrentClientID, $gloClientAccessLevel, $gloClientSysAdmins, $gloClientRsAdmins, $gloClientServiceAdmins;
    global $gloClientAccessBingosID, $gloClientAccessSitesID, $gloClientAccessHalosID,  $gloClientAccessHostingID, $gloClientAccessCardsID, $gloClientAccessDrivesID;

    // AppID -> GET TypeID
    $strSQL = "
		SELECT 
		typeid
		FROM data_cloudapps
		WHERE id = '$AppID'
		LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);

    $TypeID = $row['typeid'];

    //CHECK USER ACCESSLEVEL
    if (in_array($gloClientAccessLevel, $gloClientSysAdmins)) {
        $OpenApp = 1;
    } // 8,9 - Always allow
    else if (in_array($gloClientAccessLevel, $gloClientRsAdmins)) {
        if ($TypeID == 0) {
            $OpenApp = 1;
        } else {
            $OpenApp = checkClientAccessService($gloCurrentClientID, $TypeID);
        }
    } // 5,6
    else if (in_array($gloClientAccessLevel, $gloClientServiceAdmins)) {
        if ($TypeID == 0) {
            $OpenApp = 1;
        } else {
            $OpenApp = checkClientAccessService($gloCurrentClientID, $TypeID);
        }
    } // 2,3 - client Admins - Allow if they have service.
    else if (in_array($gloClientAccessLevel, $gloClientServiceAdmins)) {
        if ($TypeID == 0) {
            $OpenApp = 1;
        } else {
            $checkOpenApp = checkClientAccessService($gloCurrentClientID, $TypeID);
            if ($checkOpenApp) {
                // check ids

                // // check MBINGO
                // if in_array($, $gloClientAccessBingosID) { 

                // } else { 

                // }
                $OpenApp = 0;
            } else {
                $OpenApp = 0;
            }
        }
    } // 1,4,7 user - Allow if user is allowed to service/app.
    else {
        $OpenApp = 0;
    }

    return $OpenApp;
}


//CHECK IF USERS HAVE CLOUDAPP
function checkUserApp($gloUID, $AppID)
{
    global $SQLlink, $SystemAdmin;

    $strSQLApp = "SELECT * FROM data_mycloudapps WHERE appid = '$AppID' AND uid = '$gloUID'";
    $strResApp = mysqli_query($SQLlink, $strSQLApp);
    $ServiceApp = mysqli_num_rows($strResApp);

    if (!$ServiceApp) {
        $gloHas = "0";
    } else {
        $gloHas = "1";
    }
    return $gloHas;
}
//            $AppIDCZ = 3; // app id customerzone
//            $AppIDMSite = 2; // app id msite


// //CHECK IF USER HAS CLOUD START APPS
// function checkMoonApps($gloUID)
// {
//     global $SQLlink, $gloAccess, $gloTimeStamp, $SystemAdmin, $gloTotalMGameplaces, $gloCheckAllowedBingo, $gloCheckAllowedSite, $gloCheckAllowedHalo, $gloCheckAllowedSales, $gloCheckAllowedCZone, $gloCheckAllowedOpenHalo, $gloCheckAppLogo, $gloCheckAppSite, $gloCheckAppCZone, $gloCheckAppBingo, $gloCheckAppHalo, $gloCheckAppCV, $gloCheckAppSales, $gloCheckAppOpenHalo;

//     // Global variables for checking if customer is allowed to service (row 382 inc-globaldatamain.php)
//     // $gloCheckAllowedBingo - $gloCheckAllowedSite - $gloCheckAllowedHalo - gloCheckAllowedSales - $gloCheckAllowedCZone - $gloCheckAllowedOpenHalo

//     // Global variables for checking if user has app (row 389 inc-globaldatamain.php)
//     // $gloCheckAppLogo - $gloCheckAppSite - $gloCheckAppCZone - $gloCheckAppBingo - $gloCheckAppHalo - $gloCheckAppCV - $gloCheckAppSales

//     if ($SystemAdmin) {
//         // APPS ONLY FOR STAFF
//         if ($gloAccess == 7) {
//             $AppLogoEnabled = 0;
//             $AppSiteEnabled = 1;
//             $AppCZoneEnabled = 0;
//             $AppBingoEnabled = 0;
//             $AppHaloEnabled = 0;
//             $AppCvEnabled = 0;
//             $AppSalesEnabled = 1;
//             $AppOpenHaloEnabled = 0;
//         } else {
//             $AppLogoEnabled = 0;
//             $AppSiteEnabled = 1;
//             $AppCZoneEnabled = 0;
//             $AppBingoEnabled = 1;
//             $AppHaloEnabled = 1;
//             $AppCvEnabled = 0;
//             $AppSalesEnabled = 1;
//             $AppOpenHaloEnabled = 1;
//         }
//     } else {
//         $AppLogoEnabled = 0;
//         $AppSiteEnabled = 1;
//         $AppCZoneEnabled = 0;
//         $AppBingoEnabled = 1;
//         $AppHaloEnabled = 0;
//         $AppCvEnabled = 0;
//         $AppSalesEnabled = 0;
//         $AppOpenHaloEnabled = 0;
//     }


//     //CHECK APP LOGO

//     //CHECK APP SITE
//     if ($gloCheckAllowedSite and $AppSiteEnabled) {
//         if (!$gloCheckAppSite) {
//             $strSQLAppMSite = "
// 				INSERT INTO data_mycloudapps
// 				(uid, appid, active, added, updated) 
// 				VALUES 
// 				('$gloUID','2','1','$gloTimeStamp','$gloTimeStamp')";
//             mysqli_query($SQLlink, $strSQLAppMSite);
//         }
//     }

//     // CHECK APP CUSTOMERZONE
//     if ($gloCheckAllowedCZone and $AppCZoneEnabled) {
//         if (!$gloCheckAppCZone) {
//             $strSQLAppCZ = "
// 				INSERT INTO data_mycloudapps
// 				(uid, appid, active, added, updated) 
// 				VALUES 
// 				('$gloUID','3','1','$gloTimeStamp','$gloTimeStamp')";
//             mysqli_query($SQLlink, $strSQLAppCZ);
//         }
//     }

//     //CHECK APP BINGO
//     if ($gloCheckAllowedBingo and $AppBingoEnabled) {
//         if (!$gloCheckAppBingo) {
//             $strSQLAppMBINGO = "
// 				INSERT INTO data_mycloudapps
// 				(uid, appid, active, added, updated) 
// 				VALUES 
// 				('$gloUID','4','1','$gloTimeStamp','$gloTimeStamp')";
//             mysqli_query($SQLlink, $strSQLAppMBINGO);
//         }
//     }


//     //CHECK APP HALO
//     if ($gloCheckAllowedHalo and $AppHaloEnabled) {
//         if (!$gloCheckAppBingo) {
//             $strSQLAppMHALO = "
// 				INSERT INTO data_mycloudapps
// 				(uid, appid, active, added, updated) 
// 				VALUES 
// 				('$gloUID','5','1','$gloTimeStamp','$gloTimeStamp')";
//             mysqli_query($SQLlink, $strSQLAppMHALO);
//         }
//     }
//     //CHECK APP CV

//     //CHECK APP SALES
//     if ($gloCheckAllowedSales and $AppSalesEnabled) {
//         if (!$gloCheckAppSales) {
//             $strSQLAppMSales = "
// 				INSERT INTO data_mycloudapps
// 				(uid, appid, active, added, updated) 
// 				VALUES 
// 				('$gloUID','7','1','$gloTimeStamp','$gloTimeStamp')";
//             mysqli_query($SQLlink, $strSQLAppMSales);
//         }
//     }

//     //CHECK APP OPENHALO
//     if ($gloCheckAllowedOpenHalo and $AppOpenHaloEnabled) {
//         if (!$gloCheckAppOpenHalo) {
//             $strSQLAppMOpenHalo = "
// 				INSERT INTO data_mycloudapps
// 				(uid, appid, active, added, updated) 
// 				VALUES 
// 				('$gloUID','8','1','$gloTimeStamp','$gloTimeStamp')";
//             mysqli_query($SQLlink, $strSQLAppMOpenHalo);
//         }
//     }
// }

//GET FULL NAME OF A USER
function UserFullName($UserID)
{
    global $SQLlink;

    $strSQL = "SELECT user_fname, user_sname FROM data_users WHERE id = '$UserID'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CHECK = mysqli_num_rows($results);

    if ($CHECK != 0) {

        // GET USER FULLNAME FROM DATABASE
        $strSQL = "
			SELECT 
			user_fname, user_sname
			FROM data_users
			WHERE id = '$UserID'
			LIMIT 1";
        $result = mysqli_query($SQLlink, $strSQL);
        $row = mysqli_fetch_assoc($result);

        $UFULLNAME = ucfirst($row['user_fname']) . " " . ucfirst($row['user_sname']);
        return $UFULLNAME;
    }
}

// Check if user exist
function checkUserExist($email)
{
    global $SQLlink;

    $strSQL = "SELECT * FROM data_users WHERE user_email = '$email'";
    $results = mysqli_query($SQLlink, $strSQL);
    $Usercount = mysqli_num_rows($results);

    if (!$Usercount) {
        $Usercount = 0;
    }

    return $Usercount;
}

//GET FIRST NAME OF A USER
function UserFirstName($UserID)
{
    global $SQLlink;

    $strSQL = "SELECT user_fname FROM data_users WHERE id = '$UserID'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CHECK = mysqli_num_rows($results);

    if ($CHECK != 0) {

        // GET USER FIRSTNAME FROM DATABASE
        $strSQL = "
			SELECT 
			user_fname
			FROM data_users
			WHERE id = '$UserID'
			LIMIT 1";
        $result = mysqli_query($SQLlink, $strSQL);
        $row = mysqli_fetch_assoc($result);

        $UFIRSTNAME = ucfirst($row['user_fname']);
        return $UFIRSTNAME;
    }
}

//GET EMAIL OF A USER
function UserEmail($UserID)
{
    global $SQLlink;

    $strSQL = "SELECT * FROM data_users WHERE id = '$UserID'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CHECK = mysqli_num_rows($results);

    if ($CHECK != 0) {

        // GET USER EMAIL FROM DATABASE
        $strSQL = "
			SELECT 
			user_email
			FROM data_users
			WHERE id = '$UserID'
			LIMIT 1";
        $result = mysqli_query($SQLlink, $strSQL);
        $row = mysqli_fetch_assoc($result);

        $UEMAIL = $row['user_email'];
        return $UEMAIL;
    }
}

//GET ACCESS LEVEL OF A USER
function UserAccess($UserID)
{
    global $SQLlink;
    global $BRAND;

    $strSQL = "SELECT * FROM data_users WHERE id = '$UserID'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CHECK = mysqli_num_rows($results);

    if ($CHECK != 0) {

        // GET USER ACCESS FROM DATABASE
        $strSQL = "
			SELECT 
			 user_access
			FROM data_users
			WHERE id = '$UserID'
			LIMIT 1";
        $result = mysqli_query($SQLlink, $strSQL);
        $row = mysqli_fetch_assoc($result);

        $UACCESS = ucfirst($row['user_access']);
        return $UACCESS;
    }
}

//GET ACCESS LEVEL ON CLIENT OF A USER
function UserAccessClient($UserID, $ClientID)
{
    global $SQLlink, $BRAND;

    $strSQL = "SELECT aid FROM data_clients_access WHERE uid = '$UserID' AND cid='$ClientID'";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $AccessID = $row['aid'];

    return $AccessID;
}


//CHECK ACCESS - CLIENT CLOUD APP - If user is allowed to this cloudapp on this currentclientid
function UserAccessCloudApp($CloudApp)
{
    global $SQLlink, $gloUID, $gloCurrentClientID, $BRAND;

    if ($CloudApp == "site") {
        $SQLACCESS = "activesites";
    } elseif ($CloudApp == "bingo") {
        $SQLACCESS = "activebingo";
    } elseif ($CloudApp == "bingo") {
        $SQLACCESS = "activehosting";
    } else {
        // Handle unknown CloudApp values
        return false;
    }

    $strSQL = "SELECT $SQLACCESS FROM data_clients_access WHERE uid = '$gloUID' AND cid='$gloCurrentClientID'";
    $result = mysqli_query($SQLlink, $strSQL);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $AccessID = isset($row[$SQLACCESS]) ? $row[$SQLACCESS] : 0;
        mysqli_free_result($result);
        return $AccessID;
    } else {
        // Handle query error
        return 0;
    }
}

//CHECK ACCESS - HALO - If user is allowed to this halo on this currentclientid
function UserAccessHalo($haloinstance)
{
    global $SQLlink, $gloUID, $gloCurrentClientID, $gloClientAccessHalo, $BRAND, $gloClientAccessLevel;

    // Sanitize input to prevent SQL injection
    $haloinstance = mysqli_real_escape_string($SQLlink, $haloinstance);

    // Check if the user is a system admin
    if ($gloClientAccessLevel > 7) {
        return $gloClientAccessLevel; // Return the access level of the system admin
    }

    // Check if the user is allowed access to the halo
    $strSQL = "SELECT aid FROM data_halos_access WHERE active = '1' AND haloid = '$haloinstance' AND uid = '$gloUID' AND cid = '$gloCurrentClientID'";

    $result = mysqli_query($SQLlink, $strSQL);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $accessID = isset($row['aid']) ? $row['aid'] : 0;
        mysqli_free_result($result);
        if ($gloClientAccessHalo) {
            return $accessID;
        } else {
            return 0;
        }
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($SQLlink);
        return false;
    }
}

//CHECK ACCESS - Site - If user is allowed to this site on this currentclientid
function UserAccessSite($siteinstance)
{
    global $SQLlink, $gloUID, $gloCurrentClientID, $gloClientAccessSites, $BRAND, $gloClientAccessLevel;

    // Sanitize input to prevent SQL injection
    $siteinstance = mysqli_real_escape_string($SQLlink, $siteinstance);

    // Check if the user is a system admin
    if ($gloClientAccessLevel > 7) {
        return $gloClientAccessLevel; // Return the access level of the system admin
    }

    // Check if the user is allowed access to the site
    $strSQL = "SELECT aid FROM data_sites_access WHERE active = '1' AND siteid = '$siteinstance' AND uid = '$gloUID' AND cid = '$gloCurrentClientID'";

    $result = mysqli_query($SQLlink, $strSQL);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $accessID = isset($row['aid']) ? $row['aid'] : 0;
        mysqli_free_result($result);
        if ($gloClientAccessSites) {
            return $accessID;
        } else {
            return 0;
        }
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($SQLlink);
        return false;
    }
}

// get a a list of halos user is allowed to
function GetUserAllowedHalos($loggedinUID)
{
    global $SQLlink, $gloCurrentClientID, $gloClientAccessHalo, $BRAND, $gloClientAccessLevel;

    // Sanitize input to prevent SQL injection
    $loggedinUID = mysqli_real_escape_string($SQLlink, $loggedinUID);

    // Check if the user is a system admin
    if ($gloClientAccessLevel > 7) {
        // Return all halo instances for system admins
        $allHalosQuery = "SELECT siteid FROM data_halos WHERE clientid = '$gloCurrentClientID'";
        $allHalosResult = mysqli_query($SQLlink, $allHalosQuery);

        if ($allHalosResult) {
            $allHalos = mysqli_fetch_all($allHalosResult, MYSQLI_ASSOC);
            mysqli_free_result($allHalosResult);

            return array_column($allHalos, 'siteid');
        } else {
            // Handle query error
            echo "Error: " . mysqli_error($SQLlink);
            return array();
        }
    }

    if (!$gloClientAccessHalo) {
        //
    } else {

        // Query to get all haloid instances the user is allowed to access
        $strSQL = "SELECT haloid FROM data_halos_access WHERE active = '1' AND uid = '$loggedinUID' AND cid = '$gloCurrentClientID'";
        $result = mysqli_query($SQLlink, $strSQL);

        $allowedSiteIds = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $haloid = $row['haloid'];

                // Fetch the corresponding siteid for the haloid
                $siteIdQuery = "SELECT siteid FROM data_halos WHERE serviceid = '$haloid' AND clientid = '$gloCurrentClientID'";
                $siteIdResult = mysqli_query($SQLlink, $siteIdQuery);

                if ($siteIdResult) {
                    $siteIdRow = mysqli_fetch_assoc($siteIdResult);
                    $siteId = isset($siteIdRow['siteid']) ? $siteIdRow['siteid'] : 0;

                    if ($siteId > 0) {
                        $allowedSiteIds[] = $siteId;
                    }

                    mysqli_free_result($siteIdResult);
                } else {
                    // Handle query error
                    echo "Error: " . mysqli_error($SQLlink);
                }
            }

            mysqli_free_result($result);
        } else {
            // Handle query error
            echo "Error: " . mysqli_error($SQLlink);
        }
    }
    return $allowedSiteIds;
}

// get a a list of sites user is allowed to
function GetUserAllowedSites($loggedinUID)
{
    global $SQLlink, $gloCurrentClientID, $gloClientAccessSites, $BRAND, $gloClientAccessLevel;

    // Sanitize input to prevent SQL injection
    $loggedinUID = mysqli_real_escape_string($SQLlink, $loggedinUID);

    // Check if the user is a system admin
    if ($gloClientAccessLevel > 7) {
        // Return all halo instances for system admins
        $allHalosQuery = "SELECT siteid FROM data_sites WHERE clientid = '$gloCurrentClientID'";
        $allHalosResult = mysqli_query($SQLlink, $allHalosQuery);

        if ($allHalosResult) {
            $allHalos = mysqli_fetch_all($allHalosResult, MYSQLI_ASSOC);
            mysqli_free_result($allHalosResult);

            return array_column($allHalos, 'siteid');
        } else {
            // Handle query error
            echo "Error: " . mysqli_error($SQLlink);
            return array();
        }
    }

    if (!$gloClientAccessSites) {
        //
    } else {

        // Query to get all siteid instances the user is allowed to access
        $strSQL = "SELECT siteid FROM data_sites_access WHERE active = '1' AND uid = '$loggedinUID' AND cid = '$gloCurrentClientID'";
        $result = mysqli_query($SQLlink, $strSQL);

        $allowedSiteIds = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $siteid = $row['siteid'];

                // Fetch the corresponding siteid for the siteid
                $siteIdQuery = "SELECT siteid FROM data_sites WHERE serviceid = '$siteid' AND clientid = '$gloCurrentClientID'";
                $siteIdResult = mysqli_query($SQLlink, $siteIdQuery);

                if ($siteIdResult) {
                    $siteIdRow = mysqli_fetch_assoc($siteIdResult);
                    $siteId = isset($siteIdRow['siteid']) ? $siteIdRow['siteid'] : 0;

                    if ($siteId > 0) {
                        $allowedSiteIds[] = $siteId;
                    }

                    mysqli_free_result($siteIdResult);
                } else {
                    // Handle query error
                    echo "Error: " . mysqli_error($SQLlink);
                }
            }

            mysqli_free_result($result);
        } else {
            // Handle query error
            echo "Error: " . mysqli_error($SQLlink);
        }
    }
    return $allowedSiteIds;
}





// check how many halos user is allowed to
function GetUserAllowedHalosCount($loggedinUID)
{
    global $SQLlink, $gloCurrentClientID, $gloClientAccessHalo, $gloClientAccessLevel;

    // Sanitize input to prevent SQL injection
    $loggedinUID = mysqli_real_escape_string($SQLlink, $loggedinUID);

    // Check if the user is a system admin
    if ($gloClientAccessLevel > 7) {
        // Return the count of all halo instances for system admins in the same client
        // You may fetch the count from your database here
        $strSQL = "SELECT COUNT(DISTINCT siteid) AS allowedHalosCount FROM data_halos WHERE active = '1' AND clientid = '$gloCurrentClientID'";
    } else {
        // Query to get the count of halo instances the user is allowed to access
        $strSQL = "SELECT COUNT(DISTINCT haloid) AS allowedHalosCount FROM data_halos_access WHERE active = '1' AND uid = '$loggedinUID' AND cid = '$gloCurrentClientID'";
    }

    $result = mysqli_query($SQLlink, $strSQL);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $allowedHalosCount = isset($row['allowedHalosCount']) ? $row['allowedHalosCount'] : 0;
        mysqli_free_result($result);
        if ($gloClientAccessHalo) {
            return $allowedHalosCount;
        } else {
            return 0;
        }
        return $allowedHalosCount;
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($SQLlink);
        return 0;
    }
}


// check how many Sites user is allowed to
function GetUserAllowedSitesCount($loggedinUID)
{
    global $SQLlink, $gloCurrentClientID, $gloClientAccessHalo, $gloClientAccessLevel;

    // Sanitize input to prevent SQL injection
    $loggedinUID = mysqli_real_escape_string($SQLlink, $loggedinUID);

    // Check if the user is a system admin
    if ($gloClientAccessLevel > 7) {
        // Return the count of all site instances for system admins in the same client
        // You may fetch the count from your database here
        $strSQL = "SELECT COUNT(DISTINCT siteid) AS allowedSitesCount FROM data_sites WHERE active = '1' AND clientid = '$gloCurrentClientID'";
    } else {
        // Query to get the count of site instances the user is allowed to access
        $strSQL = "SELECT COUNT(DISTINCT siteid) AS allowedSitesCount FROM data_sites_access WHERE active = '1' AND uid = '$loggedinUID' AND cid = '$gloCurrentClientID'";
    }

    $result = mysqli_query($SQLlink, $strSQL);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $allowedSitesCount = isset($row['allowedSitesCount']) ? $row['allowedSitesCount'] : 0;
        mysqli_free_result($result);
        if ($gloClientAccessHalo) {
            return $allowedSitesCount;
        } else {
            return 0;
        }
        return $allowedSitesCount;
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($SQLlink);
        return 0;
    }
}
