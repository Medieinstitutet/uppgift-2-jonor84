<? // MODALS
?>
<!-- Passworinfo Modal-->
<div class='modal fade' id='Modal-Passwordinfo' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>

      <div class='modal-header'>
        <h3 class='modal-title' id='exampleModalLabel'><b><i class="fa-solid fa-key"></i> Lösenordsinformation</b></h3>
        <a class='btn btn-light close' data-bs-dismiss='modal' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>×</span>
        </a>
      </div>
      <div class='modal-body'>
        <? include "passwordinfo2.php"; ?>
      </div>

      <div class='modal-footer'>
        <button type='button' class='btn btn-light' data-dismiss='modal' data-bs-dismiss='modal'><i class='fas fa-times-circle'></i> Avbryt</a>
      </div>
    </div>
  </div>
</div>
<!-- END Passworinfo Modal-->

<!-- Switch USER Modal-->

<div class='modal fade' id='switchAModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <form method='post' class='form-horizontal' action='/editaccount&task=user_switch'>
        <div class='modal-header'>
          <h4 class='modal-title' id='exampleModalLabel'>Byt användare</h4>
          <a class='btn btn-light close' data-bs-dismiss='modal' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>×</span>
          </a>
        </div>
        <div class='modal-body'>
          <input type='hidden' name='frmToUID' value='<? echo $gloADMINSESSION; ?>'>

          <p>Byt tillbaka till mitt konto? </p>
        </div>
        <div class='modal-footer'>
          <button type="submit" class="<? echo $btnSuccess; ?>"><i class="fas fa-check-circle"></i> Ja</button>
          <button class='btn btn-light' type='button' data-dismiss='modal' data-bs-dismiss='modal'><i class="fas fa-times-circle"></i> Avbryt</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Switch USER Modal-->


<!-- START INFO 2FA SMS Modal-->
<div class='modal fade' id='infoModal-2fasms' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h4 class='modal-title' id='exampleModalLabel'><b>Info - 2FA med SMS</b></h4>
        <button class='close <? echo $btnLight; ?>' type='button' data-dismiss='modal' data-bs-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>×</span>
        </button>
      </div>
      <div class='modal-body'>
        Tvåfaktorsautentisering (2FA) är en säkerhetsmetod som kräver två oberoende sätt att verifiera din identitet innan du får åtkomst till ditt konto. Vid användning av 2FA krävs vanligtvis något du vet, såsom ett lösenord, tillsammans med något du har, såsom en enhet eller en unik kod.
        <br><br>
        <div class="card mb-3 text-dark bg-light ">
          <div class="card-body p-4">
            <i class="fas fa-sms"></i> Vi använder 2FA med SMS, vilket innebär att efter att du har angett ditt lösenord skickar vi en engångskod till din mobiltelefon via textmeddelande. För att slutföra inloggningen måste du ange den unika koden som skickas till din telefon. Detta extra steg förhindrar obehörig åtkomst till ditt konto, även om någon skulle få tag på ditt lösenord.
          </div>
        </div>
      </div>
      <div class='modal-footer'>
        <? echo $gloModalCloseButton; ?>
      </div>
    </div>
  </div>
</div>
<!-- END INFO 2FA SMS Modal-->