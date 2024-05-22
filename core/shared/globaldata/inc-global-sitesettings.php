<?
$gloNEWCUSTOMERZONE = "/customerzone2";
$gloOLDCUSTOMERZONE = "/customerzone";

if ($gloUseNewCustomerzone) {
  $gloCustomerzonelink = $gloNEWCUSTOMERZONE;
  $NEWTAB = "_blank";
  $gloNEWCUSTOMERZONEINFO = "Vi har stoppat arbetet med denna kundzon och istället gått över till en annan kundzon för att lättare hantera domäner och hosting.";
} else {
  $gloCustomerzonelink = $gloOLDCUSTOMERZONE;
  $NEWTAB = "";
  $gloNEWCUSTOMERZONEINFO = "Vi jobbar på att gå över till en annan kundzon för att lättare hantera domäner och hosting. Mer information kommer så fort vi är redo.";
}

//CHANGE EMAIL
$ChangeEmailText = 1;

if ($ChangeEmailText) {
  $gloChangeEmail = "<small id='emailHelp' class='form-text text-muted'>Om du ändrar din e-post, kom ihåg att du loggar in med din e-post.</small>";
} else {
  $gloChangeEmail = "";
}
$gloRegEmailText = "<small id='emailHelp' class='form-text text-muted'>Det är möjligt att ändra e-post senare när du kommit in.</small>";

//TIPS
$TipsWebsite = 1;
$TipsEmailFree = 1;
$TipsEmail = 1;

if ($TipsWebsite) {
  $gloTipsWebsite = "<small id='websiteHelp' class='form-text text-muted'>(Om du inte har en hemsida, tipsar vi om <a href='https://moonserver.site' target='_blank'>Moonserver.site</a>)</small>";
} else {
  $gloTipsWebsite = "";
}
if ($TipsEmailFree) {
  $gloTipsEmailFree = "<small id='websiteHelp' class='form-text text-muted'>(Om du inte har en e-post, tipsar vi om <a href='https://gmail.com' target='_blank'>Gmail</a> där du kan skaffa en gratis.)</small>";
} else {
  $gloTipsEmailFree = "";
}
if ($TipsEmail) {
  $gloTipsEmail = "<small id='websiteHelp' class='form-text text-muted'>(Om du inte har en e-post i din verksamhet, tipsar vi om <a href='https://moonhost.se' target='_blank'>Moonserver Webbhotell</a>.)</small>";
} else {
  $gloTipsEmail = "";
}

// GET SITE SETTINGS FROM DATEBASE
$strSQL = "
	SELECT 
     set_name, 
     set_company, set_color, set_logo,set_logofile, set_email_system, set_bg, set_swish, set_swishqrimg, set_glonote, set_invoicenotes, set_orgnr,
     set_topnote, set_sidenote, set_welcomenote, set_faviconadmin, set_faviconfile,
     set_admindesign,set_BANKIDlogin
	FROM data_settings 
	WHERE id = 999 
	LIMIT 1";
$result = mysqli_query($SQLlink, $strSQL);
$row = mysqli_fetch_assoc($result);

$gloSiteName = $row['set_name'];
$gloCompany = $row['set_company'];
$gloColor = $row['set_color'];
$setLogo = $row['set_logo'];
$setLogo = $row['set_logofile'];
$gloSysMail = $row['set_email_system'];
$gloSetBG = $row['set_bg'];
$gloSetSwish = $row['set_swish'];
$gloSetSwishQR = $row['set_swishqrimg'];

$gloCompanyID = $row['set_orgnr'];

$gloNote = $row['set_glonote'];
$gloSetInvoiceNotes = $row['set_invoicenotes'];

if ($gloSetSwish) { $gloSwishActive = "1"; } else { $gloSwishActive = "0"; }

$gloTopNote = $row['set_topnote'];
$gloSideNote = $row['set_sidenote'];
$gloWelcomeNote = $row['set_welcomenote'];
$gloOwnFavicon = $row['set_faviconfile'];
$gloSetFavicon = $row['set_faviconadmin'];
$gloAdminDesign = $row['set_admindesign'];

//BANKID
$gloBANKID = $row['set_BANKIDlogin']; //BANKID LOGIN ON/OFF -> 1/0
$BANKIDLOGO = "<span class='bankid-logo'><img src='" . $gloLogosDir . "/logo-bankid.svg' alt='BankID Logo' width='30px;' style='margin-top:-4px;'></span>";


if ($gloSetFavicon == 0) {
  $gloFavicon = "";
} else if ($gloSetFavicon == 1) {
  $gloFavicon = "sa-favicon.ico";
} else if ($gloSetFavicon == 2) {
  $gloFavicon = $gloOwnFavicon;
}

// ERROR CONTROLL IF RS IS EOF
if (empty($gloSiteName)) { $gloSiteName = "DEMO"; }
$gloName = $gloSiteName;

?>