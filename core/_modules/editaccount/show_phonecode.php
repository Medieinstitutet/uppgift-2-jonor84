<? 
// Define Sendtype
$Sendtype = 'sms';

// Get Brand SMS Name
$BRANDNAME = getBrandSMSName($BRAND);

 // Code - Get a fresh code
 $CODE = GeneratePIN(6);
    
 // Add code to active codes with limited expiring - $type, $reciever, $userid, $code
 addCodeAuth($Sendtype, $PhonePosted, $gloUID, $CODE);

// Prepare Text with code for sending
$Text = $CODE. " är din kod. Använd koden för att byta lösenord. Om det inte var du som begärde detta kan du ignorera detta sms. /".$BRANDNAME;

// SEND SMS - $smsNumber, $smsName, $smsMessage, $userid
$MailSent = sendMailSMS($PhonePosted, $BRANDNAME, $Text, $UserID);

 if ($MailSent) { 
    // $_SESSION['info'] = 'SMS skickat.';
} else { 
    // $_SESSION['info'] = 'Det gick inte att skicka SMS. Något gick fel. Var god kontakta support om du behöver hjälp.';
}

?>
<!-- Begin content -->
<div class="row">
    <div class="col-xl-12 col-md-6 mb-4">
      <div class="card mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h3 class="m-0 font-weight-bold brand-title"><? echo $strHeader; ?> / Ändra Mobilnummer 2/2</h3>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=mobile">
                <input type="hidden" name="frmPhone" value="<?php echo htmlspecialchars($PhonePosted); ?>">

                <div class="col-xl-6">
                    <p class="pheader">Verifera din nya E-post: Fyll i den 6-siffrig kod som skickats till dig. Koden gäller i 5 minuter.</p>
                    <label for="frmCode" class="sr-only">Kod</label>
                    <input type="tel" id="frmCode" class="form-control" name="frmCode" placeholder="Exempel: 101010" required autofocus>

                    <div id="charCountCode" class="alert alert-light border-warning text-dark font-weight-bold p-2" role="alert">
                        6 siffror kvar <i class="fas fa-exclamation-circle"></i>
                    </div> 
       
                <script>
                    const inputCode = document.getElementById('frmCode');
                    const charCountCode = document.getElementById('charCountCode');

                    inputCode.addEventListener('input', function() {
                            // Remove all non-numeric characters
                            this.value = this.value.replace(/\D/g, '');

                            // Limit input to 10 digits
                            if (this.value.length > 6) {
                                this.value = this.value.slice(0, 6);
                        }

                        const remainingMobile = 6 - this.value.length;
                        charCountCode.textContent = remainingMobile + ' siffror kvar';
                    });
                </script>
                
                <div id="message"><div class="alert alert-warning text-dark"><i class="fas fa-exclamation-circle"></i> Du måste fylla i koden innan du kan fortsätta.</div></div>
                </div> 
                <? echo $HRB; ?>
                <button type="submit" id="submitBtn" disabled class="<? echo $btnSuccess; ?>"><i class="fas fa-key"></i> Kontrollera kod</button>

            </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End content -->

  <script>
document.addEventListener('DOMContentLoaded', function() {
    const inputCode = document.getElementById('frmCode');
    const charCountCode = document.getElementById('charCountCode');
    const message = document.getElementById('message');
    const submitBtn = document.getElementById('submitBtn');

    // Function to update character count and styles
    function updateCharCount() {
        // Remove all non-numeric characters
        inputCode.value = inputCode.value.replace(/\D/g, '');

        // Limit input to 10 digits
        if (inputCode.value.length > 6) {
            inputCode.value = inputCode.value.slice(0, 6);
        }

        const remainingMobile = 6 - Number(inputCode.value.length); // Convert to number explicitly
        charCountCode.textContent = remainingMobile + ' siffror kvar';

        // Change text color and icon based on remaining characters
        if (remainingMobile === 0) {
            charCountCode.textContent = '0 siffror kvar ';
            charCountCode.classList.remove('text-black');
            charCountCode.classList.remove('border-warning');
            charCountCode.classList.add('text-success');
            charCountCode.classList.add('border-success');
            charCountCode.innerHTML += ' <i class="fas fa-check-circle"></i>';
        } else {
            charCountCode.textContent = remainingMobile + ' siffror kvar';
            charCountCode.classList.remove('text-success');
            charCountCode.classList.remove('border-success');
            charCountCode.classList.add('text-black');
            charCountCode.classList.add('border-warning');
            charCountCode.innerHTML += ' <i class="fas fa-exclamation-circle"></i>';
        }

        // Show/hide message based on the remaining characters
        if (remainingMobile === 0) {
            message.style.display = 'none';
            submitBtn.removeAttribute('disabled');
        } else {
            message.style.display = 'block';
            submitBtn.setAttribute('disabled', 'disabled');
        }
    }

    // Update character count when input event occurs
    inputCode.addEventListener('input', updateCharCount);

    // Check if the input already has a value when the DOM is fully loaded
    if (inputCode.value.length > 0) {
        updateCharCount();
    }
});
</script>