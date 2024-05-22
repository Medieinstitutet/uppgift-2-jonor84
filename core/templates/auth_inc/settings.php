<? 
$task = mysqli_real_escape_string($SQLlink,$_GET['task']); 
$GetEmail = mysqli_real_escape_string($SQLlink,$_GET['u']); 
$URLCODE = mysqli_real_escape_string($SQLlink,$_GET['c']); 
$PWCODE = mysqli_real_escape_string($SQLlink,$_GET['code']); 


// THEME SETTINGS
if ($gloBrandStarWars) {
    $BKGFOLDER = "sw";
    $RandomNumber = rand(0, 4);
} else {
    $BKGFOLDER = "default";
    $RandomNumber = rand(0, 22);
}

$gloTemplateName = $gloBrandTemplateLogin;
$gloTemplateBKGDir = $SysDomain."/core/templates/bkg/" . $BKGFOLDER;
$gloTemplateBKG = $gloTemplateBKGDir."/".$RandomNumber.".jpg";

$gloTemplatePath = $SysDomain."/core/templates/auth/";
$gloTemplate = $gloTemplatePath . $gloTemplateName;
$gloAuthPath = $gloSystemPath."/templates/auth_inc";

$gloTemplateContent = $gloAuthPath.'/content.php';
$gloTemplateTopLinks = $gloAuthPath.'/toplinks.php';
$gloTemplateNotifications = $gloAuthPath.'/notifications.php';
$gloPasswordRules = $gloAuthPath.'/passwordrules.php';

$gloTemplateLoader = $SysDomain."/public/preloaders/loaderblue.svg";

// Dark or Light sign in
if ($gloBrandDarklogin) {
    $LoginCSS = "signin_dark.css";
} else {
    $LoginCSS = "signin_light.css";
}
// Path to own sign in css file. index login will auto check if file exist and read it if it exist.
$owncss = $gloBrandTemplateLogin . "/css/signin_" . strtolower($gloBrandSiteName) . ".css";

//IF BOTH HIDEFORGET AND HIDEREGISTER ARE INACTIVE
if (!$gloBrandHideForget AND !$gloBrandHideRegister) {
    $BothLinksDivider = " | ";
} else { 
    $BothLinksDivider = "";
}

//IF ANY OF HIDEFORGET OR HIDEREGISTER ARE ACTIVE
if (!$gloBrandHideForget OR !$gloBrandHideRegister) {
    $ExtraHR = "<hr>";
} else { 
    $ExtraHR = "";
}
        
if ($gloBrandHideRegister) {
    $RegisterLink = "";
} else { 
    $RegisterLink = "<i class='fa-solid fa-user-plus'></i> <a href='?task=register'>Registrera</a>";
}

if ($gloBrandHideForget) {
    $ForgetLink = "";
} else { 
    $ForgetLink = "<i class='fa-solid fa-circle-question'></i> <a href='?task=forget'>Glömt lösenord?</a>";
}

// Routes
if ($task == 'cookies') { 
    $gloTemplaceCardClass = 'form-signin-wider';
    $gloTemplateInclude = 'cookies.php';
    $gloTemplateCookieUse = 0;
    $gloTemplatePageClass = "-wider";

} else if ($task == 'register') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'register.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'regverify') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'register-verifyemail.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'regcode') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'register-code.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'regcodeauth') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'register-codeauth.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'regpass') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'register-password.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'regprocess') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'register-process.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'forget') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'forget.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'femail') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'forget-email.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'fsms') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'forget-sms.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'remail') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'recovery-email.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'rsms') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'recovery-sms.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'rcode') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'recovery-code.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'rcodeauth') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'recovery-codeauth.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'rpass') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'recovery-password.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'rpasschange') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'recovery-passwordchange.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'auth') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'auth.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'login') { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'login.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

} else if ($task == 'newsletters') { 
    $gloTemplaceCardClass = 'form-signin-wider';
    $gloTemplateInclude = 'newsletters.php';
    $gloTemplateCookieUse = 0;
    $gloTemplatePageClass = "-wider";

} else { 
    $gloTemplaceCardClass = 'form-signin';
    $gloTemplateInclude = 'login.php';
    $gloTemplateCookieUse = 1;
    $gloTemplatePageClass = "";

}