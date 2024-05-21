<?
if ($gloBrandHideForget) {
    header("Location: ?task=login");
} else {
?>
<form class="" action="?task=regcodeauth" method="post">
<input type="hidden" name="frmBRANDING" value="<? echo $BRAND; ?>">

<h5 class="formheader">Registrera Konto (2 av 3)</h5>
    <p class="pheader">Fyll i den 6-siffrig kod som skickats till dig. Koden gäller i 5 minuter.</p>
    <label for="frmCode" class="sr-only">Kod</label>
    <input type="tel" id="frmCode" class="form-control" name="frmCode" placeholder="Exempel: 101010" required autofocus>

    <div id="charCountCode" class="alert alert-light border-warning text-dark font-weight-bold p-2" role="alert">
        6 siffror kvar <i class="fas fa-exclamation-circle"></i>
    </div>         
    <script>
        const inputMobileNumber = document.getElementById('frmCode');
        const charCountCode = document.getElementById('charCountCode');

        inputMobileNumber.addEventListener('input', function() {
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
    <button class="mt-3 btn btn-lg btn-block btn-colors growsm" id="submitBtn" disabled type="submit"><i class="fas fa-key"></i> Kontrollera kod</button>
</form>
<? } ?>
<hr>
<p>
    <i class="fa-solid fa-circle-arrow-left"></i> <a href="?task=login">Tillbaka till Inloggningen</a>
</p>
<hr>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputMobileNumber = document.getElementById('frmCode');
    const charCountCode = document.getElementById('charCountCode');
    const message = document.getElementById('message');
    const submitBtn = document.getElementById('submitBtn');

    // Function to update character count and styles
    function updateCharCount() {
        // Remove all non-numeric characters
        inputMobileNumber.value = inputMobileNumber.value.replace(/\D/g, '');

        // Limit input to 10 digits
        if (inputMobileNumber.value.length > 6) {
            inputMobileNumber.value = inputMobileNumber.value.slice(0, 6);
        }

        const remainingMobile = 6 - Number(inputMobileNumber.value.length); // Convert to number explicitly
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
    inputMobileNumber.addEventListener('input', updateCharCount);

    // Check if the input already has a value when the DOM is fully loaded
    if (inputMobileNumber.value.length > 0) {
        updateCharCount();
    }
});
</script>