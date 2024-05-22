<?
// GLOBAL LOGGED IN USER/CLIENT SERVICES DATA

//GET TOTAL BINGO GAMEPLACES
$strSQLTotalMGameplaces = "SELECT sum(id) FROM data_myservices WHERE cid = '$gloCurrentClientID' AND mbingoservice = '1'";
$strResTotalMGameplaces = mysqli_query($SQLlink,$strSQLTotalMGameplaces);
$TotalMGameplaces1 = mysqli_fetch_array($strResTotalMGameplaces);

$gloTotalMGameplaces = $TotalMGameplaces1[ '0' ];
if (empty($gloTotalMGameplaces)) { $gloTotalMGameplaces = 0; }


//CHECK IF LOGGED IN USER NEED TO INSTALL NEW MOONSITE

$strSQLSNeed = "SELECT id FROM data_myservices WHERE cid = '$gloCurrentClientID' AND siteneedinstall = '1'";
$strResSNeed = mysqli_query($SQLlink,$strSQLSNeed);
$gloAccessSNeed = mysqli_num_rows($strResSNeed);

if ($gloAccessSNeed > 0) { 
     $_SESSION[ "info" ] = "<b>Du har en hemsida att skapa</b><br>
     Vi är glada att just du har registrerat dig hos oss och ville testa på en MoonSite hemsida. Klicka på skapa hemsida för att fortsätta. <br><br> <a class='btn btn-primary' href='/startsite'>Skapa hemsida</a>. ";
} 

//CHECK IF LOGGED IN USER HAS MOONSITE AGENCY

$strSQLAgency = "SELECT id FROM data_myservices WHERE cid = '$gloCurrentClientID' AND sid = '33'";
$strResAgency = mysqli_query($SQLlink,$strSQLAgency);
$gloAccessAgency = mysqli_num_rows($strResAgency);

if ($gloAccessAgency > 0) { 
 $gloAccessAgency = 1;
} else { 
 $gloAccessAgency = 0;
}

//GET TOTAL MOONSITES CLIENT CAN HAVE

$strSQLTotalMSites = "SELECT sum(msites) FROM data_myservices WHERE cid = '$gloCurrentClientID' AND msiteservice = '1'";
$strResTotalMSites = mysqli_query($SQLlink,$strSQLTotalMSites);
$TotalMSites1 = mysqli_fetch_array($strResTotalMSites);

$gloTotalMSites = $TotalMSites1[ '0' ];
if (empty($gloTotalMSites)) { $gloTotalMSites = 0; }

//GET TOTAL MOONSITES CLIENT HAVE NOW
$strSQLMSitesUsing = "SELECT siteid FROM data_sites WHERE clientid = '$gloCurrentClientID'";
$strResMSitesUsing = mysqli_query($SQLlink,$strSQLMSitesUsing);
$gloMSitesUsing = mysqli_num_rows($strResMSitesUsing);

//GET TOTAL MOONSITES CLIENT HAVE LEFT
$gloMSites = $gloTotalMSites - $gloMSitesUsing;

if ($gloMSites < 0) { $gloMSites = 0; }


//GET TOTAL HALOS CLIENT CAN HAVE

$strSQLTotalMHalos = "SELECT sum(mhalos) FROM data_myservices WHERE cid = '$gloCurrentClientID' AND mhaloservice = '1'";
$strResTotalMHalos = mysqli_query($SQLlink,$strSQLTotalMHalos);
$TotalMHalos1 = mysqli_fetch_array($strResTotalMHalos);

$gloTotalMHalos = $TotalMHalos1[ '0' ];
if (empty($gloTotalMHalos)) { $gloTotalMHalos = 0; }

//GET TOTAL HALOS CLIENT HAVE NOW
$strSQLMHalosUsing = "SELECT siteid FROM data_halos WHERE clientid = '$gloCurrentClientID'";
$strResMHalosUsing = mysqli_query($SQLlink,$strSQLMHalosUsing);
$gloMHalosUsing = mysqli_num_rows($strResMHalosUsing);

//GET TOTAL HALOS CLIENT HAVE LEFT
$gloMHalos = $gloTotalMHalos - $gloMHalosUsing;
if ($gloMHalos < 0) { $gloMHalos = 0; }

?>