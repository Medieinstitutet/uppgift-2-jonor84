<? // GET LOGO 
    echo $gloBrandLogoLoginShow;

    // Include notifications and task include
    include $gloTemplateNotifications;
    include $gloTemplateInclude;
?>
<div id="modal">
    <div class="modal-content">
        <div class="header" style="border-bottom: 1px solid <? echo $gloBrandColorButton; ?>!Important; border-radius: 5px 5px 0 0; margin: 0;">
            <h3>Cookies</h3>
        </div>
        <div class="copy">
            <?
                include 'modalcookie.php';
            ?>
            <a class="btn btn-lg btn-colors btn-block" href="#"><i class="fa-solid fa-circle-xmark"></i> Okej! Stäng rutan</a>
        </div>
    </div>
    <div class="overlay"></div>
</div>

<div id="modal2">
    <div class="modal-content">
        <div class="header" style="border-bottom: 1px solid <? echo $gloBrandColorButton; ?>!Important; border-radius: 5px 5px 0 0; margin: 0;">
            <h3>Lösenordsinformation</h3>
        </div>
        <div class="copy">
            <div id="passwordRules" class="mb-3">
                <? include $gloPasswordRules; ?>
            </div>
            <a class="btn btn-lg btn-colors btn-block" href="#"><i class="fa-solid fa-circle-xmark"></i> Okej! Stäng rutan</a>
        </div>
    </div>
    <div class="overlay"></div>
</div>

<? if ($gloTemplateCookieUse) { ?>
<p>
    <small>
        <? echo $gloBrandSiteName; ?> använder <a href="#modal" title="Information om cookies">cookies</a>.
    </small>
</p>
<? } ?>
<p class="mt-1 mb-1 footertext"> 
    <small>
        <b>&copy; <? echo $gloYear." ".$gloBrandCompanyName; ?></b>
    </small>
</p>