<?
if ($gloBrandHideForget) {
    header("Location: ?task=login");
} else {
?>
<form class="" action="?task=remail" method="post">
    <p class="pheader">Fyll i din e-postadress nedan,<br> så skickar vi en 6-siffrig kod till dig.</p>
    <label for="inputEmail" class="sr-only">E-postadress</label>
    <input type="email" id="inputEmail" class="form-control" name="frmUser" placeholder="E-postadress" required autofocus>

    <button class="mt-3 btn btn-lg btn-block btn-colors growsm" type="submit"><i class="fas fa-at"></i> Skicka kod</button>
</form>
<? } ?>
<hr>
<p>
    <i class="fa-solid fa-circle-arrow-left"></i> <a href="?task=login">Tillbaka till Inloggningen</a>
</p>
<hr>