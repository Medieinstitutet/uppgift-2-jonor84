<?
if ($gloBrandHideForget) {
    header("Location: ?task=login");
} else {
?>
<form class="" action="?task=rsms" method="post">
<input type="hidden" name="frmBRANDING" value="<? echo $BRAND; ?>">

    <p class="pheader">Fyll i din e-postadress och ditt mobilnummer nedan, så skickar vi en 6-siffrig kod till dig på SMS.</p>
    <input type="email" id="inputEmail" class="form-control" name="frmUser" placeholder="E-postadress" required autofocus>
    <label for="frmMobileNumber" class="sr-only">Mobilnummer</label>
    <input type="tel" id="frmMobileNumber" class="form-control" name="frmMobileNumber" placeholder="Exempel: 0790000001" required autofocus>

    <div id="charCountMobile" class="alert alert-light border-warning text-dark font-weight-bold p-2" role="alert">
        10 siffror kvar <i class="fas fa-exclamation-circle"></i>
    </div>         
    <script>
        const inputMobileNumber = document.getElementById('frmMobileNumber');
        const charCountMobile = document.getElementById('charCountMobile');

        inputMobileNumber.addEventListener('input', function() {
                // Remove all non-numeric characters
                this.value = this.value.replace(/\D/g, '');

                // Limit input to 10 digits
                if (this.value.length > 10) {
                    this.value = this.value.slice(0, 10);
            }

            const remainingMobile = 10 - this.value.length;
            charCountMobile.textContent = remainingMobile + ' siffror kvar';
        });
    </script>
    <div id="message"><div class="alert alert-warning text-dark"><i class="fas fa-exclamation-circle"></i> Du måste fylla i ditt mobilnummer innan du kan fortsätta.</div></div>
    <button class="mt-3 btn btn-lg btn-block btn-colors growsm" id="submitBtn" disabled type="submit"><i class="fas fa-sms"></i> Skicka kod</button>
</form>
<? } ?>
<hr>
<p>
    <i class="fa-solid fa-circle-arrow-left"></i> <a href="?task=login">Tillbaka till Inloggningen</a>
</p>
<hr>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputMobileNumber = document.getElementById('frmMobileNumber');
    const charCountMobile = document.getElementById('charCountMobile');
    const message = document.getElementById('message');
    const submitBtn = document.getElementById('submitBtn');

    // Function to update character count and styles
    function updateCharCount() {
        // Remove all non-numeric characters
        inputMobileNumber.value = inputMobileNumber.value.replace(/\D/g, '');

        // Limit input to 10 digits
        if (inputMobileNumber.value.length > 10) {
            inputMobileNumber.value = inputMobileNumber.value.slice(0, 10);
        }

        const remainingMobile = 10 - Number(inputMobileNumber.value.length); // Convert to number explicitly
        charCountMobile.textContent = remainingMobile + ' siffror kvar';

        // Change text color and icon based on remaining characters
        if (remainingMobile === 0) {
            charCountMobile.textContent = '0 siffror kvar ';
            charCountMobile.classList.remove('text-black');
            charCountMobile.classList.remove('border-warning');
            charCountMobile.classList.add('text-success');
            charCountMobile.classList.add('border-success');
            charCountMobile.innerHTML += ' <i class="fas fa-check-circle"></i>';
        } else {
            charCountMobile.textContent = remainingMobile + ' siffror kvar';
            charCountMobile.classList.remove('text-success');
            charCountMobile.classList.remove('border-success');
            charCountMobile.classList.add('text-black');
            charCountMobile.classList.add('border-warning');
            charCountMobile.innerHTML += ' <i class="fas fa-exclamation-circle"></i>';
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
    inputMobileNumber.addEventListener('input', updateCharCount);

    // Check if the input already has a value when the DOM is fully loaded
    if (inputMobileNumber.value.length > 0) {
        updateCharCount();
    }
});
</script>