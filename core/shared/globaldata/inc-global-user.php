<?
// GET LOGGED IN USERS DATA FROM DB
$strSQL = "
	SELECT 
     t1.user_name,
     t1.pid,t1.user_fname,t1.user_sname,t1.user_worktitle,t1.client_id,
     t1.user_email,t1.user_phone,t1.user_img,t1.user_added,t1.user_updated,
     t1.last_login,t1.user_active,t1.user_hidden,t1.user_presentation,t1.user_balance,
     t1.user_reservedmoney,t1.using_tmp_pw,t1.accepted_terms,t1.user_access,t1.group_id,
     t1.defaultcid, t1.user_new, t1.user_newclient, t1.user_pass, t1.defaultstart, 
     t1.defaultlanguageid, t1.userid,
     t2.access_name 
	FROM data_users AS t1 
	LEFT JOIN data_access AS t2 
	ON user_access = t2.id 
	WHERE t1.id = $gloUID 
	LIMIT 1";
$arrRS = mysqli_query($SQLlink, $strSQL);
while ($arrRow = mysqli_fetch_row($arrRS)) {
    //DATA USER
    $gloUser = $arrRow[0]; // t1.user_name
    $gloPID = $arrRow[1]; // t1.pid
    $gloFName = $arrRow[2]; // t1.user_fname

    if ($gloFName == "TMPNAME") {
        $gloFName = "<i>[ EJ IFYLLT ÄNNU ]</i>";
    }

    $gloSName = $arrRow[3]; // t1.user_sname
    $gloUserWorkTitle = $arrRow[4]; // t1.user_worktitle
    $gloClientID = $arrRow[5]; // t1.client_id main clientid for the personal account

    $gloUserMail = $arrRow[6]; // t1.user_email
    $gloUserPhone = $arrRow[7]; // t1.user_phone
    $gloUserPic = $arrRow[8]; // t1.user_img
    $gloUserAdded = date('Y-m-d H:i', $arrRow[9]); // t1.user_added
    $gloUserUpdated = date('Y-m-d H:i', $arrRow[10]); // t1.user_updated

    $gloUserLastLogin = date('Y-m-d H:i', $arrRow[11]); // t1.last_login
    $gloUserActive = $arrRow[12]; // t1.user_active
    $gloUserHidden = $arrRow[13]; // t1.user_hidden
    $gloUserPresentation = $arrRow[14]; // t1.user_presentation
    $gloUserBalance = $arrRow[15]; // t1.user_balance

    $gloUserReserved = $arrRow[16]; // t1.user_reservedmoney
    $gloTempPass = $arrRow[17]; // t1.using_tmp_pw if BANKID is off
    $gloAcceptedTerms = $arrRow[18]; // t1.accepted_terms IF USER HAVE ACCEPTED TERMS/GDPR OR NOT
    $gloAccess = $arrRow[19]; // t1.user_access - access level id 1-9
    $gloAccessGroup = $arrRow[20]; // t1.group_id - reseller id
    $gloDefaultProfile = $arrRow[21]; // t1.default client id at login
    $gloUserNew = $arrRow[22]; // t1.user_new at login first time
    $gloUserNewClient = $arrRow[23]; // t1.user_newclient at login first time
    $gloUserPwd = $arrRow[24]; // t1.user_pass at login first time

    $gloUserDefaultStart = $arrRow[25]; // t1.defaultstart
    $gloUserDefaultLanguageID = $arrRow[26]; // t1.defaultlanguageid
    $gloUserAccountID = $arrRow[27]; // t1.userid

    if (!$_SESSION["gloCurrentClient"]) {
        $_SESSION["gloCurrentClient"] = $gloDefaultProfile;


        if (!$gloUserNew and !$gloUserNewClient) {
            if ($_SESSION["gloCurrentClient"] == '0') {
                $_SESSION["INFONOCLIENTDATA"] = "<a href='/editaccount&show=contact' class='btn btn-light'><i class='fas fa-arrow-alt-circle-down'></i>  Klicka här</a> och välj vilken kundprofil som ska laddas automatiskt vid inloggning. (Har du bara en att välja på så klicka på spara knappen bara.)<br><br>Om du inte kan välja någon profil alls behöver du skapa en ny kundprofil genom att <a class='btn btn-dark' href='/account&show=organisations'><i class='fas fa-arrow-alt-circle-down'></i>  klicka här</a>. ";
            }
        }
    }
    if ($gloIDLinkPID) {
        $NEWLINK = "&" . $gloIDLinkPID;
    } else if ($gloIDLinkCID) {
        $NEWLINK = "&" . $gloIDLinkCID;
    } else {
        $NEWLINK = "";
    }

    if ($gloUserNew) {
        $gloWindow = 1;
        $_SESSION["INFOWELCOME"] = "Vi är glada att just du har registrerat dig hos oss. Då ditt konto är nytt behöver du fylla i mer information om dig innan du kan börja utforska våra tjänster. <a class='btn btn-light' href='/newaccount" . $NEWLINK . "'><i class='fas fa-arrow-alt-circle-down'></i>  Klicka här</a>";
    } else if ($gloUserNewClient) {
        $gloWindow = 1;
        $_SESSION["INFOCLIENTDATANEEDED"] = "Här kan du lägga till en ny kundprofil. <a class='btn btn-light' href='/newaccount&show=newclient" . $NEWLINK . "'><i class='fas fa-arrow-alt-circle-down'></i> Klicka här</a>";
    } else {
        $gloWindow = 0;
    }

    //DATA ACCESS
    $gloAccessName = $arrRow[28]; // t2.access_name - Name of Access level 1-9
}

$gloCurrentClientID = $_SESSION["gloCurrentClient"];

if (empty($gloUserPic)) {
    $gloUserPic = "no-profile-image.png";
} // IF NO PROFILE IMAGE USE DEFAULT IMAGE
$gloUserFullname = $gloFName . " " . $gloSName; //Show users firstname and lastname

// RESELLER ID FROM USER
$gloResellerID = $gloAccessGroup;

// FOR MENU AND OTHERE FUNCTIONS - USER ACCESS TYPE - CLIENT, RESELLER OR ADMIN

//GET ACCESS TYPES
switch ($gloAccess) {
    case 1:
        $isReseller = "0";
        $isClient = "1";
        $gloAccessType = "Client";
        $gloAccessAdmin = "C0";
        break;
    case 2:
        $isReseller = "0";
        $isClient = "1";
        $gloAccessType = "Client";
        $gloAccessAdmin = "C0";
        break;
    case 3:
        $isReseller = "0";
        $isClient = "1";
        $gloAccessType = "Client";
        $gloAccessAdmin = "C1";
        break;
    case 4:
        $isReseller = "1";
        $gloAccessType = "Reseller";
        $gloAccessAdmin = "R0";
        break;
    case 5:
        $isReseller = "1";
        $gloAccessType = "Reseller";
        $gloAccessAdmin = "R0";
        break;
    case 6:
        $isReseller = "1";
        $gloAccessType = "Reseller";
        $gloAccessAdmin = "R1";
        break;
    case 7:
        $isReseller = "0";
        $SystemAdmin = "1";
        $gloAccessType = "Admin";
        $gloAccessAdmin = "A0";
        break;
    case 8:
        $isReseller = "0";
        $SystemAdmin = "1";
        $gloAccessType = "Admin";
        $gloAccessAdmin = "A0";
        break;
    case 9:
        $isReseller = "0";
        $SystemAdmin = "1";
        $gloAccessType = "Admin";
        $gloAccessAdmin = "A1";
        break;
}


//GET LOGGED IN USERS ACCESS LEVEL ON CURRENT CLIENTID

$strSQLAccessLevel = "
SELECT 
   aid, 
   activebingo, bingosid, 
   activesites, sitesid, 
   activehalo, halosid, 
   activehosting, hostingsid, 
   activecards, cardsid, 
   activedrives, drivesid, 
   economy, sales, support
  FROM data_clients_access 
  WHERE cid = '$gloCurrentClientID' AND accepted = '1' AND uid = '$gloUID'
LIMIT 1";
$resultAccessLevel = mysqli_query($SQLlink, $strSQLAccessLevel);
$rowAccessLevel = mysqli_fetch_assoc($resultAccessLevel);

$gloClientAccessLevel = $rowAccessLevel['aid'];

$gloClientAccessBingo = $rowAccessLevel['activebingo'];
$gloClientAccessBingosID = $rowAccessLevel['bingosid'];

$gloClientAccessSites = $rowAccessLevel['activesites'];
$gloClientAccessSitesID = $rowAccessLevel['sitesid'];

$gloClientAccessHalo = $rowAccessLevel['activehalo'];
$gloClientAccessHalosID = $rowAccessLevel['halosid'];

$gloClientAccessHosting = $rowAccessLevel['activehosting'];
$gloClientAccessHostingID = $rowAccessLevel['hostingsid'];

$gloClientAccessCards = $rowAccessLevel['activecards'];
$gloClientAccessCardsID = $rowAccessLevel['cardsid'];

$gloClientAccessDrives = $rowAccessLevel['activedrives'];
$gloClientAccessDrivesID = $rowAccessLevel['drivesid'];


$gloClientAccessEconomy = $rowAccessLevel['economy'];
$gloClientAccessSales = $rowAccessLevel['sales'];
$gloClientAccessSupport = $rowAccessLevel['support'];

//TEMP ACCESS FOR ECONOMY
$gloClientEconomyUsers = array(443, 5);

if (in_array($gloUID, $gloClientEconomyUsers)) {
    $gloClientAccessTempRPanel = 0;
    $gloClientAccessTempRPanelE = 1;
} else {
    if ($gloClientAccessLevel > 7) {
    }
    $gloClientAccessTempRPanel = 1;
    $gloClientAccessTempRPanelE = 1;
}

//checkUserAllowedApp($gloUID, $AppID)
//Variables for checking if users customer profile is allowed to service
$gloCheckAllowedBingo = checkClientAccessService($gloCurrentClientID, '8');  // Bingo service
$gloCheckAllowedSite = checkClientAccessService($gloCurrentClientID, '15'); // Site service 
$gloCheckAllowedHalo = checkClientAccessService($gloCurrentClientID, '16'); // Halo service


$gloCheckAllowedBingo1 = checkUserAllowedApp($gloUID, '4');  // Bingo app 4
$gloCheckAllowedSite1 = checkUserAllowedApp($gloUID, '2'); // Site app 2
$gloCheckAllowedHalo1 = checkUserAllowedApp($gloUID, '5'); // Halo app 5


$gloCheckAllowedCZone = 1; // Customerzone
$gloCheckAllowedSales = 1; // Sales Dashboard only for staff - another check will make sure its only for staff
$gloCheckAllowedOpenHalo = 1; // OpenHalo only for staff

//Variables for checking if user have app
//$gloCheckAppLogo = checkUserApp($gloUID, '1');  // Logo App
$gloCheckAppSite = checkUserApp($gloUID, '2');  // Site App
$gloCheckAppCZone = checkUserApp($gloUID, '3');  // Customerzone App
$gloCheckAppBingo = checkUserApp($gloUID, '4');  // Bingo App
$gloCheckAppHalo = checkUserApp($gloUID, '5');  // Halo App
//$gloCheckAppCV = checkUserApp($gloUID, '6');  // Cv App
$gloCheckAppSales = checkUserApp($gloUID, '7');  // Sales App only staff - another check will make sure its only for staff
$gloCheckAppOpenHalo = checkUserApp($gloUID, '8');  // OpenHalo App

// FOR CLIENT SYS ADMIN
$gloClientSysAdmins = array(8, 9);
// FOR CLIENT RS ADMIN
$gloClientRsAdmins = array(5, 6);

// FOR Service ADMIN - for example to check if client has apps
$gloClientServiceAdmins = array(2, 3, 5, 6);

// FOR CLIENT ADMIN for example ICONS - new client, new orders, new tasks
$gloClientAdmins = array(2, 3, 5, 6, 8, 9);
// And for regular users on client - check if these users is allowed to apps/services.
$gloClientRegularUser = array(1, 4, 7);



// FOR ALERTS
// ----- MY OWN -----

// CHECK HOW MANY NEW NOTIFICATIONS
$strSQLNEWNOT = "SELECT * FROM data_notifications WHERE userid = '$gloUID' AND open = '0'";
$resultsNEWNOT = mysqli_query($SQLlink, $strSQLNEWNOT);
$gloNEWNOT = mysqli_num_rows($resultsNEWNOT);

// CHECK HOW MANY NEW MESSAGES
$strSQLNEW = "SELECT * FROM data_messages WHERE touid = '$gloUID' AND opened = '0'";
$resultsNEW = mysqli_query($SQLlink, $strSQLNEW);
$gloNEWMESS = mysqli_num_rows($resultsNEW);

// HOW MANY TASKS ARE UNFINISHED  
$strSQLUNTASKS = "SELECT id FROM data_tasks WHERE brand ='$BRAND' AND done = '0'";
$strResUNTASKS = mysqli_query($SQLlink, $strSQLUNTASKS);
$gloNEWTASK = mysqli_num_rows($strResUNTASKS);

$gloMYSUM = $gloNEWNOT + $gloNEWMESS + $gloNEWTASK;

// ----- ACTIVE CLIENTPROFILE -----

// CHECK HOW MANY NEW NOTIFICATIONS
$strSQLNEWNOTCLIENT = "SELECT * FROM data_notifications WHERE clientid = '$gloCurrentClientID' AND open = '0'";
$resultsNEWNOTCLIENT = mysqli_query($SQLlink, $strSQLNEWNOTCLIENT);
$gloNEWNOTCLIENT = mysqli_num_rows($resultsNEWNOTCLIENT);

// CHECK HOW MANY NEW MESSAGES
// $strSQLNEW = "SELECT * FROM data_messages WHERE touid = '$gloUID' AND opened = '0'";
// $resultsNEW = mysqli_query($SQLlink, $strSQLNEW);
// $NEWMESSCLIENT = mysqli_num_rows($resultsNEW);

// HOW MANY SERVICES IS DUE DATE
$strSQLSERVDUE = "SELECT id FROM data_myservices WHERE (DATEDIFF(now(),expires)<=30)";
$strResSERVDUE = mysqli_query($SQLlink, $strSQLSERVDUE);
$gloSERVICESDUE = mysqli_num_rows($strResSERVDUE);
// echo $numRowSERVDUE;			

// HOW MANY NEW CLIENTS APPLICATIONS  
$strSQLCNEW = "SELECT id FROM data_clients WHERE brand ='$BRAND' AND orgnew = '1'";
$strResCNEW = mysqli_query($SQLlink, $strSQLCNEW);
$gloNEWCLIENTS = mysqli_num_rows($strResCNEW);

// HOW MANY ORDERS ARE UNFINISHED  
$strSQLUNORDERS = "SELECT id FROM data_orders WHERE brand ='$BRAND' AND statusid = '1'";
$strResUNORDERS = mysqli_query($SQLlink, $strSQLUNORDERS);
$gloNEWORDERS = mysqli_num_rows($strResUNORDERS);

$gloACTIVECLIENTSUM = $gloNEWNOTCLIENT + $gloNEWCLIENTS + $gloNEWORDERS;

$gloSUMALLNOT = $gloACTIVECLIENTSUM + $gloMYSUM;
