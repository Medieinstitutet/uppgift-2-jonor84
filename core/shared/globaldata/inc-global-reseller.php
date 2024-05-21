<?
// GLOBAL LOGGED IN USERS RESELLER DATA

//GLOBAL RESELLER DATA
$strSQLR = "
	SELECT 
     t1.id,
     t1.companyname,t1.contactname,t1.phone,t1.email,t1.active,
     t1.town,t1.added,t1.updated,t1.info,t1.logo,
     t1.logos,t1.address,t1.invoiceaddress,t1.support_phone,t1.support_email,
     t1.support_info,t1.support_link,t1.website,t1.companyid,t1.bg,
     t1.pg,t1.zip,
     t2.country_name 
	FROM data_resellers AS t1 
	LEFT JOIN data_countrys AS t2 
	ON t1.countryid = t2.id 
	WHERE t1.userid = $gloUID 
	LIMIT 1";
$arrRSR = mysqli_query($SQLlink, $strSQLR);
while ($arrRowR = mysqli_fetch_row($arrRSR)) {
    //RESELLER DATA
    $gloResellerID = $arrRowR[0];
    $gloResellerCompany = $arrRowR[1];
    $gloResellerContact = $arrRowR[2];
    $gloResellerPhone = $arrRowR[3];
    $gloResellerEmail = $arrRowR[4];
    $gloResellerActive = $arrRowR[5];

    $gloResellerTown = $arrRowR[6];
    $gloResellerAdded = date('Y-m-d H:i', $arrRowR[7]);
    $gloResellerUpdated = date('Y-m-d H:i', $arrRowR[8]);
    $gloResellerInfo = $arrRowR[9];
    $gloResellerLogo = $arrRowR[10];

    $gloResellerLogoS = $arrRowR[11];
    $gloResellerAddress = $arrRowR[12];
    $gloResellerIAdress = $arrRowR[13];
    $gloResellerSPhone = $arrRowR[14];
    $gloResellerSEmail = $arrRowR[15];

    $gloResellerSInfo = $arrRowR[16];
    $gloResellerSLink = $arrRowR[17];
    $gloResellerSite = $arrRowR[18];
    $gloResellerCompanyID = $arrRowR[19];
    $gloResellerBG = $arrRowR[20];

    $gloResellerPG = $arrRowR[21];
    $gloResellerZip = $arrRowR[22];

    // COUNTRY DATA
    $gloResellerCountryName = $arrRowR[23];
}

if (empty($gloResellerSPhone)) {
    $gloResellerSPhone = $gloResellerPhone;
}
if (empty($gloResellerSEmail)) {
    $gloResellerSEmail = $gloResellerEmail;
}

if ($gloResellerPhone) {
    $gloRPhone = "Telefon: <a href='callto:" . $gloResellerPhone . "'>" . $gloResellerPhone . "</a>";
    $gloRPhone1 = "<a href='callto:" . $gloResellerPhone . "'>" . $gloResellerPhone . "</a>";
} else {
    $gloRPhone = "";
    $gloRPhone1 = "";
}

if ($gloResellerSPhone) {
    $gloRSPhone = "Telefon: <a href='callto:" . $gloResellerSPhone . "'>" . $gloResellerSPhone . "</a>";
    $gloRSPhone1 = "<a href='callto:" . $gloResellerSPhone . "'>" . $gloResellerSPhone . "</a>";
} else {
    $gloRSPhone = "";
    $gloRSPhone1 = "";
}

if ($gloResellerEmail) {
    $gloREmail = "E-post: <a href='mailto:" . $gloResellerEmail . "' target='_blank'>" . $gloResellerEmail . "</a>";
    $gloREmail1 = "<a href='mailto:" . $gloResellerEmail . "' target='_blank'>" . $gloResellerEmail . "</a>";
} else {
    $gloREmail = "";
    $gloREmail1 = "";
}

if ($gloResellerSEmail) {
    $gloRSEmail = "E-post: <a href='mailto:" . $gloResellerSEmail . "' target='_blank'>" . $gloResellerSEmail . "</a>";
    $gloRSEmail1 = "<a href='mailto:" . $gloResellerSEmail . "' target='_blank'>" . $gloResellerSEmail . "</a>";
} else {
    $gloRSEmail = "";
    $gloRSEmail1 = "";
}

if ($gloResellerSite) {
    $gloRSite = "Hemsida: <a href='https://" . $gloResellerSite . "' target='_blank'>https://" . $gloResellerSite . "</a>";
    $gloRSite1 = "<a href='https://" . $gloResellerSite . "' target='_blank'>https://" . $gloResellerSite . "</a>";
} else {
    $gloRSite = "";
    $gloRSite1 = "";
}

if ($gloResellerCompany) {
    $gloRNAME = $gloResellerCompany;
} else {
    $gloRNAME = $gloUserFullname;
}

if ($gloResellerContact) {
    $gloRContact = $gloResellerContact;
} else {
    $gloRContact = $gloUserFullname;
}

switch ($gloResellerLogoS) {
    case 0:
        $gloRLOGO = "<span style='color:black; font-size:50px;'>" . $gloResellerCompany . "</span>";
        break;
    case 1:
        $gloRLOGO = "<img src='" . $gloLogosDir . "/" . $setLogoFile . "' style='max-width: 200px; margin-top: -15px;margin-bottom: -15px; padding:2px;' class='responsive'";
        break;
    case 2:
        $gloRLOGO = "<img src='" . $gloLogosDir . "/" . $gloResellerLogo . "' style='max-width: 200px; margin-top: -15px;margin-bottom: -15px; padding:2px;' class='responsive'>";
        break;
}
