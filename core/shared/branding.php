<?php
  $gloBrandSiteName = "Mailboy";
  $gloBrandCompanyName = "Mailboy AB";

  $gloBrandTemplateLogin = "default";
  $gloBrandTemplateMail = "default";
  $gloBrandTemplateMain = "default";

  $gloBrandLogo = "mailboy-logo.png";
  $gloBrandLoginURL = "https://" . $gloDomain;
  $gloDomainURL = $gloDomain;
  
  $gloBrandFavicon = "favicon.ico";
  $gloBrandTemplateLogin = "default";
  $gloBrandLogoMail = "default";
  $gloBrandTemplateMain = "default";

  // get default avatar
  if ($gloUserPic) {
    $gloBrandAvatar = $gloUserPic;
  } else {
    $gloBrandAvatar = "nopic.png";
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

  // LOGO LOGIN
  $gloBrandLogoLoginShow = "<img src='" . $gloPublicDir . "/" . $gloBrandLogo . "' style='width: 250px; margin-top: -5px;margin-bottom: 15px; padding:0px;'>";

  // LOGO MAIL
  $gloBrandLogoMailShow = "<img src='" . $gloPublicDir . "/" . $gloBrandLogo . "'>";
  $gloBrandLogoMailShow2 = $gloPublicDir . "/" . $gloBrandLogo;

  // LOGO MAIN
  $gloBrandLogoMainShow = "<img src='" . $gloPublicDir . "/" . $gloBrandLogo . "' style='width: 200px; margin-top: -15px; margin-bottom: -10px; padding:0px;'>";
}
