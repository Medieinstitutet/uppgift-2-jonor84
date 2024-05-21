<? // MODALS
?>

<!-- Passwordgenerator Modal-->
<div class='modal fade' id='Modal-Passwordgenerator' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <form method="post" class="form-horizontal" action="#">

        <div class='modal-header'>
          <h3 class='modal-title' id='exampleModalLabel'><b><i class="fa-solid fa-key"></i> Lösenordsgenerator</b></h3>
          <a class='btn btn-light close' data-bs-dismiss='modal' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>×</span>
          </a>
        </div>
        <div class='modal-body'>
          <!-- <input type="hidden" name="frmOID" value="<? echo $_GET['id']; ?>"> -->
          <? $GeneratedPassword = generateRandomPassword(10); ?>

          <input type="text" value="<? echo $GeneratedPassword; ?>" id="Password" hidden>
          <p>Genererat lösenord:<br> <span class="font-weight-bold"><? echo $GeneratedPassword; ?></span> <button class="btn btn-light btn-sm" onclick="copyPasswordSuggestion()"><i class="far fa-copy"></i> Kopiera</button></p>
          <br>
          <p>Klicka på kopiera knappen och sen klistrar du in det i lösenordsrutan.</p>
        </div>

        <div class='modal-footer'>
          <!-- <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Ja, Avbryt Order</button> -->
          <button type='button' class='btn btn-light' data-dismiss='modal' data-bs-dismiss='modal'><i class='fas fa-times-circle'></i> Avbryt</a>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  function copyPasswordSuggestion() {
    // Get the text field
    var copyText = document.getElementById("Password");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);

    // Alert the copied text
    // alert("Lösenord kopierat: " + copyText.value);
  }
</script>
<!-- END Passwordgenerator Modal-->

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

<!-- START INFO FONT AWESOME Modal-->
<div class='modal fade' id='infoModal-Awesome' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h4 class='modal-title' id='exampleModalLabel'><b>Info - Font Awesome</b></h4>
        <button class='close <? echo $btnLight; ?>' type='button' data-dismiss='modal' data-bs-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>×</span>
        </button>
      </div>
      <div class='modal-body'>
        Vi använder oss av ikonbiblioteket Font Awesome på denna webbplats. Om du vill, kan du själv använda deras ikoner på utvalda platser på denna webbplats.
        Du kan dock endast använda deras gratis ikoner och i dagsläget använder vi version 5.
        <br><br>
        <div class="card mb-3 text-dark bg-light ">
          <div class="card-body p-4">
            <b>Så här lägger du in en ikon i vår webbplats:</b><br>
            <i>I exemplet nedan använder vi ikonen toolbox: <i class="fas fa-toolbox"></i> </i><br><br>
            1. Välj den ikon du vill ha på Font Awesomes webbplats och klicka på den. <br>
            2. Kopiera koden som du nu visas i HTML på Font Awesome webbplats genom att bara klicka på den:
            <pre class="text-light bg-dark" style="text-shadow: none!important;"><code>&lt;i class="<span style='color:#5cceae; font-weight: bold;'>fas fa-toolbox</span>"&gt;&lt;/i&gt;</code></pre>
            3. Klistra in koden i Ikon rutan och spara.
          </div>
        </div>
        Använd länken genom knappen nedan för att se vilka ikoner som du kan välja mellan.
        <br><br>
        <a class='<? echo $btnPrimary; ?>' href='https://fontawesome.com/v5/search?o=r&m=free' target='_blank'>Se befintliga ikoner här <i class='fas fa-external-link-alt'></i></a>

      </div>
      <div class='modal-footer'>
        <? echo $gloModalCloseButton; ?>
      </div>
    </div>
  </div>
</div>
<!-- END INFO FONT AWESOME Modal-->

<!-- START TIPS FONT AWESOME Modal-->
<div class='modal fade' id='tipsModal-Awesome' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h4 class='modal-title' id='exampleModalLabel'><b>Tips - Font Awesome</b></h4>
        <button class='close <? echo $btnLight; ?>' type='button' data-dismiss='modal' data-bs-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>×</span>
        </button>
      </div>
      <div class='modal-body'>
        Här får du lite tips på hur du kan styla din ikon.<br>
        <i>I exemplen nedan använder vi ikonen toolbox: <i class="fas fa-toolbox"></i> </i><br>

        <div class="card mb-2 mt-2 text-dark bg-light ">
          <div class="card-body p-2">
            Din inklistrade kod liknar detta:
            <pre class="text-light bg-dark" style="text-shadow: none!important;"><code>&lt;i class="<span style='color:#5cceae; font-weight: bold;'>fas fa-toolbox</span>"&gt;&lt;/i&gt;</code></pre>
          </div>
        </div>

        <div class="card mb-2 mt-2 text-dark bg-light ">
          <div class="card-body p-2">
            <b>Så här skapar du mer utrymme runt din ikon:</b><br>
            Lägg till <b>fa-fw</b> så din kod liknar denna:
            <pre class="text-light bg-dark mb-1" style="text-shadow: none!important;"><code>&lt;i class="<span style='color:#5cceae; font-weight: bold;'>fa-fw fas fa-toolbox</span>"&gt;&lt;/i&gt;</code></pre>
            <i>Detta är också bra i tex menyn där alla ikoner får samma avstånd till meny texterna.</i>
          </div>
        </div>

        <div class="card mb-2 mt-2 text-dark bg-light ">
          <div class="card-body p-2">
            <b>Så här byter du färg på din ikon:</b><br>
            Lägg till <b>text-primary</b> så din kod liknar denna:
            <pre class="text-light bg-dark mb-1" style="text-shadow: none!important;"><code>&lt;i class="<span style='color:#5cceae; font-weight: bold;'>text-primary fa-fw fas fa-toolbox</span>"&gt;&lt;/i&gt;</code></pre>
            <i>Du kan använda vilken av färgerna du vill nedan, genom att använda dess rätta namn. För dig som kan kodning kan du självklart använda style attributet.</i>

            <ul class="list-group text-center">
              <li class="list-group-item bg-white">
                <i class="fa-fw fas fa-toolbox text-primary" aria-hidden="true"></i> <b>text-primary</b>
                <i class="fa-fw fas fa-toolbox text-secondary" aria-hidden="true"></i> text-secondary
                <i class="fa-fw fas fa-toolbox text-success" aria-hidden="true"></i> text-success <br>
                <i class="fa-fw fas fa-toolbox text-warning" aria-hidden="true"></i> text-warning
                <i class="fa-fw fas fa-toolbox text-info" aria-hidden="true"></i> text-info
                <i class="fa-fw fas fa-toolbox text-dark" aria-hidden="true"></i> text-dark
                <i class="fa-fw fas fa-toolbox text-muted" aria-hidden="true"></i> text-muted
              </li>
              <li class="list-group-item text-white bg-dark">
                <i class="fa-fw fas fa-toolbox text-light" aria-hidden="true"></i> text-light
                <i class="fa-fw fas fa-toolbox text-white" aria-hidden="true"></i> text-white
              </li>
            </ul>

          </div>
        </div>
        Glöm inte att klicka på spara knappen efter du har ändrat koden.

      </div>
      <div class='modal-footer'>
        <? echo $gloModalCloseButton; ?>
      </div>
    </div>
  </div>
</div>
<!-- END TIPS FONT AWESOME Modal-->