<style>
    .form-signin input[type="password"] {
        margin-bottom: 0px!important;
    }
</style>
<? 
if ($gloBrandHideRegister) {
    header("Location: ?task=login");
} else {
?>
<form class="form-signin" action="?task=regverify" method="post">
    <input type="hidden" name="REGCHECK" value="1"> 
    <input type="hidden" name="frmBRANDING" value="<? echo $BRAND; ?>">

    <h5 class="formheader">Registrera Konto (1 av 3)</h5>
    <div class="alert alert-success text-dark mb-2 mt-1"><i class="fas fa-info-circle"></i> När du klickar på nästa kommer du få ett meddelande till din e-postadress med en 6-siffrig kod 
    som används för att verifiera att e-postadressen tillhör dig.</div>
    <!-- <div class="alert alert-success text-dark mb-2 mt-1"><small><i class="fa-solid fa-circle-check"></i> Genom att skapa ett konto godkänner jag GDPR Policyn. <a href="<? echo $gloBrandGDPRLink; ?>" target="_blank">Visa GDPR Policy</a>.</small></div> -->

    <? if (!$HIDEFORM) { ?>
        <input type="email" autocomplete="off" id="inputEmail" class="form-control mb-3" name="frmUser" placeholder="E-postadress" value="<? echo $GetEmail; ?><? echo $_POST['frmUser']; ?>" required autofocus>

        <button class="mt-3 btn btn-lg btn-block btn-colors growsm" id="submitBtn" type="submit">Nästa steg <i class="fas fa-arrow-alt-circle-right"></i></button>

    <? } ?>
<hr>
<p>
    <i class="fa-solid fa-circle-arrow-left"></i> <a href="?task=login">Tillbaka till Inloggningen</a>
</p>
<hr>
</form>
<? } ?>