<?php
$_SESSION['BRANDING'] = $BRAND;

//CHECK IF BRAND EXIST
$strSQLBRANDEXIST = "SELECT id FROM data_branding WHERE brandname = '$BRAND'";
$strResBRANDEXIST = mysqli_query($SQLlink, $strSQLBRANDEXIST);
$gloBRANDEXIST = mysqli_num_rows($strResBRANDEXIST);

if (!$gloBRANDEXIST) {
  echo "DONT EXIST";
} else {

  // GET BRANDING FROM DATEBASE
  $strSQLBRAND = "
    SELECT 
      id,
      rid, sitename, companyname, focuscolor, linkcolor, 
      linkhovercolor, buttoncolor, logowhite, logoblack, bkgcolor, 
      textcolor, templatelogin, templatemail, templatemain, starwars, 
      favicon, loginlogo, maillogo, mainlogo, infosupport, 
      infoterms, infoabout, infowelcome, infoimportant, infoinfo, 
      mail, mailsupport, phone, phonesupport, gdprlink, 
      termslink, mailwelcome, msgwelcome, profilelogo, darklogin, 
      hideregister, hideforget, websiteactive, type, imageintro, 
      open, closedmess, websiteincluded, websiteactive, domain, 
      infotopnote, infosidenote, cid, titlecolor, buttontextcolor, 
      bkgcolor2, starthere_title, starthere_desc, starthere_welcome, showstarthere, 
      mservice, templateview, templatestart, startapp, shownews, 
      showhelpcenter, startsupport_title, startsupport_desc, startsupport_welcome, templatesupport, 
      shownewsoutside, showstatus, showknowledgebase, showdomain, showwhois, 
      showcontact, showcreatecase, showterms, defaultstart, defaultlanguageid,
      domain, startappswelcome, templatecontact, startcontact_title, startcontact_desc,
      startcontact_welcome, showcontactcenter, contactcenterimage
    FROM data_branding
    WHERE brandname = '$BRAND' 
    LIMIT 1";

  $resultBrand = mysqli_query($SQLlink, $strSQLBRAND);
  while ($rowBrand = mysqli_fetch_row($resultBrand)) {
    //BRAND DATA
    $gloBrandID = $rowBrand[0];

    $gloBrandResellerID = $rowBrand[1];
    $gloBrandSiteName = ucfirst($rowBrand[2]);
    $gloBrandCompanyName = ucfirst($rowBrand[3]);
    $gloBrandFocusColor = $rowBrand[4];
    $gloBrandLinkColor = $rowBrand[5];

    $gloBrandLinkHoverColor = $rowBrand[6];
    $gloBrandButtonColor = $rowBrand[7];
    $gloBrandLogoWhite = $rowBrand[8];
    $gloBrandLogoBlack = $rowBrand[9];
    $gloBrandBkgColor = $rowBrand[10];

    $gloBrandTextColor = $rowBrand[11];
    $gloBrandTemplateLogin = $rowBrand[12];
    $gloBrandTemplateMail = $rowBrand[13];
    $gloBrandTemplateMain = $rowBrand[14];
    $gloBrandStarWars = $rowBrand[15];

    $gloBrandFavicon = $rowBrand[16];
    $gloBrandLogoLogin = $rowBrand[17];
    $gloBrandLogoMail = $rowBrand[18];
    $gloBrandLogoMain = $rowBrand[19];
    $gloBrandInfoSupport = $rowBrand[20];

    $gloBrandInfoTerms = $rowBrand[21];
    $gloBrandInfoAbout = $rowBrand[22];
    $gloBrandInfoWelcome = $rowBrand[23];
    $gloBrandInfoImportant = $rowBrand[24];
    $gloBrandInfoInfo = $rowBrand[25];

    $gloBrandMail = $rowBrand[26];
    $gloBrandMailSupport = $rowBrand[27];
    $gloBrandPhone1 = $rowBrand[28];
    $gloBrandPhoneSupport = $rowBrand[29];
    $gloBrandGDPRLink = $rowBrand[30];

    $gloBrandTERMSLink = $rowBrand[31];
    $gloBrandMailWelcome = $rowBrand[32];
    $gloBrandMSGWelcome = $rowBrand[33];
    $gloBrandProfileLogo = $rowBrand[34];
    $gloBrandDarklogin = $rowBrand[35];

    $gloBrandHideRegister = $rowBrand[36];
    $gloBrandHideForget = $rowBrand[37];
    $gloBrandWebsiteActive = $rowBrand[38];
    $gloBrandType = $rowBrand[39];
    $gloBrandImageIntro = $rowBrand[40];

    $gloOpen = $rowBrand[41];
    $gloClosedmess = $rowBrand[42];
    $gloWebsiteincluded = $rowBrand[43];
    $gloWebsiteactive = $rowBrand[44];
    $gloBrandDomain = $rowBrand[45];

    $gloBrandInfotopnote = $rowBrand[46];
    $gloBrandInfosidenote = $rowBrand[47];
    $gloBrandCID = $rowBrand[48];
    $gloBrandTitleColor = $rowBrand[49];
    $gloBrandButtonTextColor = $rowBrand[50];

    $gloBrandBkgColor2 = $rowBrand[51];
    $gloBrandStartHereTitle = $rowBrand[52];
    $gloBrandStartHereDesc = $rowBrand[53];
    $gloBrandStartHereWelcome = $rowBrand[54];
    $gloBrandShowStartHere = $rowBrand[55];

    $gloBrandMSERVICE = $rowBrand[56];
    $gloBrandTemplateView = $rowBrand[57];
    $gloBrandTemplateStart = $rowBrand[58];
    $gloBrandStartApp = $rowBrand[59];
    $gloBrandShowNews = $rowBrand[60];

    $gloBrandShowHelpcenter = $rowBrand[61];
    $gloBrandStartSupportTitle = $rowBrand[62];
    $gloBrandStartSupportDesc = $rowBrand[63];
    $gloBrandStartSupportWelcome = $rowBrand[64];
    $gloBrandTemplateSupport = $rowBrand[65];

    $gloBrandShowNewsOutside = $rowBrand[66];
    $gloBrandShowStatus = $rowBrand[67];
    $gloBrandShowKnowledgebase = $rowBrand[68];
    $gloBrandShowDomain = $rowBrand[69];
    $gloBrandShowWhois = $rowBrand[70];

    $gloBrandShowContact = $rowBrand[71];
    $gloBrandShowCreatecase = $rowBrand[72];
    $gloBrandShowTerms = $rowBrand[73];
    $gloBrandDefaultStart1 = $rowBrand[74];
    $gloBrandDefaultLanguageID = $rowBrand[75];

    $gloBrandDomain = $rowBrand[76];
    $gloBrandStartappsWelcome = $rowBrand[77];
    $gloBrandTemplateContact = $rowBrand[78];
    $gloBrandStartContactTitle = $rowBrand[79];
    $gloBrandStartContactDesc = $rowBrand[80];

    $gloBrandStartContactWelcome = $rowBrand[81];
    $gloBrandShowContactcenter = $rowBrand[82];
    $gloBrandShowContactimage = $rowBrand[83];
  }


  // CHECK PERSONAL START FIRST - OVERRIDE
  if (!$_SESSION["DefaultStartUsed"]) {
    if ($gloUserDefaultStart) {
      $_SESSION["DefaultStart"] = $gloUserDefaultStart;
    } else {
      if ($gloBrandDefaultStart1) {
        $_SESSION["DefaultStart"] = $gloBrandDefaultStart1;
      }
    }
  }
  if (!$gloBrandDefaultLanguageID) {
    $gloBrandDefaultLanguageID = 1;
  }
  if ($gloBrandDomain) {
    $gloBrandLoginURL = "https://" . $gloBrandDomain;
  } else {
    $gloBrandLoginURL = "https://" . $gloDomain;
  }
  if ($gloDomain) {
    $gloDomainURL = "<a href='https://" . $gloBrandDomain . "' target='_blank'>" . $gloBrandCompanyName . "</a>";
  } else {
    $gloDomainURL = $gloBrandCompanyName;
  }

  if (empty($gloBrandFavicon)) {
    $gloBrandFavicon = "sa-favicon.ico";
  }
  if (empty($gloBrandWebsiteActive)) {
    $gloBrandWebsiteActive = 0;
  }
  if (empty($gloBrandTemplateLogin)) {
    $gloBrandTemplateLogin = "default";
  }
  if (empty($gloBrandLogoMail)) {
    $gloBrandLogoMail = "default";
  }
  if (empty($gloBrandTemplateMain)) {
    $gloBrandTemplateMain = "default";
  }

  // get default avatar for brand - if none - get system default
  if ($gloBrandProfileLogo) {
    $gloBrandAvatar = $gloBrandProfileLogo;
  } else {
    $gloBrandAvatar = $gloUserPic;
  }

  // Primary colors
  $gloBrandColorBKG2ORG = "#ffffff";
  $gloBrandColorBKGORG = "#f1f0f5";
  $gloBrandColorTextORG = "#292f51";
  $gloBrandColorFocusORG = "#c1bbfd";
  $gloBrandColorButtonORG = "#6d5ffc";
  $gloBrandColorButtonTextORG = "#ffffff";
  $gloBrandColorLinkORG = "#8b52ff";
  $gloBrandColorLinkHoverORG = "#6d5ffc";
  $gloBrandColorTitleORG = "#6d5ffc";

  if ($gloBrandBkgColor) {
    $gloBrandColorBKG = $gloBrandBkgColor;
  } else {
    $gloBrandColorBKG = "#ffffff";
  }

  if ($gloBrandBkgColor2) {
    $gloBrandColorBKG2 = $gloBrandBkgColor2;
  } else {
    $gloBrandColorBKG2 = "#f1f0f5";
  }

  if ($gloBrandTextColor) {
    $gloBrandColorText = $gloBrandTextColor;
  } else {
    $gloBrandColorText = "#292f51";
  }

  if ($gloBrandFocusColor) {
    $gloBrandColorFocus = $gloBrandFocusColor;
  } else {
    $gloBrandColorFocus = "#c1bbfd";
  }

  if ($gloBrandButtonColor) {
    $gloBrandColorButton = $gloBrandButtonColor;
  } else {
    $gloBrandColorButton = "#6d5ffc";
  }

  if ($gloBrandButtonTextColor) {
    $gloBrandColorButtonText = $gloBrandButtonTextColor;
  } else {
    $gloBrandColorButtonText = "#ffffff";
  }

  if ($gloBrandLinkColor) {
    $gloBrandColorLink = $gloBrandLinkColor;
  } else {
    $gloBrandColorLink = "#8b52ff";
  }

  if ($gloBrandLinkHoverColor) {
    $gloBrandColorLinkHover = $gloBrandLinkHoverColor;
  } else {
    $gloBrandColorLinkHover = "#6d5ffc";
  }

  if ($gloBrandTitleColor) {
    $gloBrandColorTitle = $gloBrandTitleColor;
  } else {
    $gloBrandColorTitle = "#6d5ffc";
  }


  # Add connection with reseller data - adress etc for branding (example invoice) - move phone and email here?
  $gloBrandAddress = "Testvägen 123";
  $gloBrandZip = "12345";
  $gloBrandCity = "Teststan";
  $gloBrandORGNr = "550000-1010";
  $gloBrandBG = "1111-1111";
  $gloBrandSite = "test.se";
  $gloBrandPhone = "010-11111111";
  # end brand - reseller contact 

  // LOGO LOGIN
  if ($gloBrandLogoLogin == "" || $gloBrandLogoLogin == "none") {
    $gloBrandLogoLoginShow = "<h2 style='margin-bottom:18px; font-weight:bold;'>" . $gloBrandSiteName . "</h2>";
  } else if ($gloBrandLogoLogin == "black") {
      $gloBrandLogoLoginShow = "<img src='" . $gloLogosDir . "/" . $gloBrandLogoBlack . "' style='width: 250px; margin-top: -5px;margin-bottom: 15px; padding:0px;'>";
  } else {
    $gloBrandLogoLoginShow = "<img src='" . $gloLogosDir . "/" . $gloBrandLogoWhite . "' style='width: 250px; margin-top: -5px;margin-bottom: 15px; padding:0px;'>";
  }

  // LOGO MAIL
  if ($gloBrandLogoMail == "none") {
    $gloBrandLogoMailShow = "<h2>" . $gloBrandSiteName . "</h2>";
    $gloBrandLogoMailShow2 = "<h2>" . $gloBrandSiteName . "</h2>";
  } else if ($gloBrandLogoMail == "black") {
    $gloBrandLogoMailShow = "<img src='" . $gloLogosDir . "/" . $gloBrandLogoBlack . "'>";
    $gloBrandLogoMailShow2 = $gloLogosDir . "/" . $gloBrandLogoBlack;
  } else {
    $gloBrandLogoMailShow = "<img src='" . $gloLogosDir . "/" . $gloBrandLogoWhite . "'>";
    $gloBrandLogoMailShow2 = $gloLogosDir . "/" . $gloBrandLogoWhite;
  }

  // LOGO MAIN
    if ($gloBrandLogoMain == "" || $gloBrandLogoMain == "none") {
      $gloBrandLogoMainShow = "<h3 style='margin-top: 10px;'>" . $gloBrandSiteName . "</h3>";
    } else {
      if ($gloBrandLogoMain == "black") {
        $gloBrandLogoMainShow = "<img src='" . $gloLogosDir . "/" . $gloBrandLogoBlack . "' style='width: 200px; margin-top: -33px;margin-bottom: -16px; padding:0px;'>";
      } else {
        $gloBrandLogoMainShow = "<img src='" . $gloLogosDir . "/" . $gloBrandLogoWhite . "' style='width: 200px; margin-top: -28px;margin-bottom: -16px; padding:0px;'>";
      }
    }
}
