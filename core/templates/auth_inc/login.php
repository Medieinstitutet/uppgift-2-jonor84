<form id="loginForm" action="?task=auth" method="post">
    <input type="hidden" name="frmBRANDING" value="<? echo $BRAND; ?>">

    <label for="inputEmail" class="sr-only">E-postadress</label>
    <input type="email" id="inputEmail" class="form-control" value="" name="frmUser" placeholder="E-postadress" required
        autofocus>
    <label for="inputPassword" class="sr-only">Lösenord</label>
    <input type="password" id="inputPassword" class="form-control" name="frmPass" placeholder="Lösenord" required>
    <button class="mt-3 btn btn-lg btn-block btn-colors growsm" type="submit"><i class="fa-solid fa-arrow-right-to-bracket"></i> Logga in</button>
</form>
<hr>
<p>
    <? echo $RegisterLink; ?> <? echo $BothLinksDivider; ?> <? echo $ForgetLink; ?>
    <? echo $ExtraHR; ?>
</p>