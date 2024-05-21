<?
if ($gloBrandHideForget) {
    header("Location: ?task=login");
} else {
?>
<p class="pheader">Välj hur du vill påbörja lösenordsåterställningen:</p>
<a class="btn btn-info mb-2" href="?task=femail"><i class="fas fa-at"></i> Via E-post</a>
<br>
<a class="btn btn-info" href="?task=fsms"><i class="fas fa-sms"></i> Via SMS</a>
<? } ?>
<hr>
<p>
    <i class="fa-solid fa-circle-arrow-left"></i> <a href="?task=login">Tillbaka till Inloggningen</a>
</p>
<hr>