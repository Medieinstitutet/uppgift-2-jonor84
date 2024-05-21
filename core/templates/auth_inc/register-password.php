<style>
    .form-signin input[type="password"] {
        margin-bottom: 0px!important;
    }
</style>
<? 
if ($gloBrandHideRegister) {
    header("Location: ?task=login");
} else {
        // $PWCODE

    if (empty($PWCODE)) { 
        $_SESSION['error'] = "Ingen kod hittades.";
        header("Location: ?task=forget");
    } else {
    
        // Double check code
        $CodeActive = verifyPwCode($PWCODE);
        $codeUserID = getUserIDPwCode($PWCODE);
        $codeUserEmail = getUserEmailPwCode($PWCODE);

        if (!$CodeActive) {
            $_SESSION['info'] = 'Koden är ogiltig. Var god påbörja en ny återställning för att få en ny kod.';
            header("location: ?task=forget");
        } else { 
?>
<form class="form-signin" action="?task=regprocess" method="post">
    <input type="hidden" name="REGCHECK" value="1">
    <input type="hidden" name="frmBRANDING" value="<? echo $BRAND; ?>">
    <input type="hidden" name="frmCODE" value="<? echo $PWCODE; ?>">

    <h5 class="formheader">Registrera Konto (3 av 3)</h5>

    <? if (!$HIDEFORM) { ?>
        <input type="email" autocomplete="off" id="inputEmail" class="form-control" name="frmUser" placeholder="E-postadress" value="<? echo $codeUserEmail; ?>" readonly required autofocus>

            <div class="input-group">
                <input type="password" id="inputPW1" class="form-control" name="frmPW1" placeholder="Ditt nya lösenord" required autofocus autocomplete="new-password">
                <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePassword('inputPW1')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>

            <div class="input-group mb-0">
                <input type="password" id="inputPW2" class="form-control" name="frmPW2" placeholder="Ditt nya lösenord igen" required autofocus autocomplete="new-password">
                <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePassword('inputPW2')">
                    <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>
          
        <a href="#modal2" class="btn btn-light btn-block mt-0 mb-3" title="Lösenordinformation"><i class="fas fa-key"></i> Lösenordinformation</a></small>
 	    
        <div id="recaptcha" class="g-recaptcha" style="margin-left: -7px;" data-sitekey="6LcldCMpAAAAAOTqM9S1YV_uud0Vf_Ci02sgmfjv"></div>

        <div class="alert alert-success text-dark mb-1 mt-1"><small><i class="fa-solid fa-circle-check"></i> Genom att skapa ett konto godkänner jag GDPR Policyn. <a href="<? echo $gloBrandGDPRLink; ?>" target="_blank">Visa GDPR Policy</a>.</small></div>

        <div id="message" class="mt-2"></div>
        <button class="mt-3 btn btn-lg btn-block btn-colors growsm" id="submitBtn" disabled type="submit"><i class="fa-solid fa-user-plus"></i> Skapa konto</button>

<?      } 
    } 
}
?>
<hr>
<p>
    <i class="fa-solid fa-circle-arrow-left"></i> <a href="?task=login">Tillbaka till Inloggningen</a>
</p>
<hr>
</form>
<? } ?>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const inputPW1 = document.getElementById('inputPW1');
    const inputPW2 = document.getElementById('inputPW2');
    const message = document.getElementById('message');
    const submitBtn = document.getElementById('submitBtn');

    // Function to check password strength
    function checkPasswordStrength(password) {
        const passwordPattern = /^(?=.*[a-zåäö])(?=.*[A-ZÅÄÖ])(?=.*\d)(?=.*[!@#\$%\^&\*\(\)\-_=+\{\}\[\];:,<\.>]).{8,}$/;
        return passwordPattern.test(password);
    }

    // Function to update message and enable/disable submit button
    function updateMessageAndButton() {
        if (inputPW1.value !== inputPW2.value) {
            message.innerHTML = '<div class="alert alert-warning text-dark" role="alert"><i class="fas fa-exclamation-circle"></i> Lösenorden matchar inte.</div>';
            submitBtn.disabled = true;
        } else if (inputPW1.value.length < 8) {
            message.innerHTML = '<div class="alert alert-warning text-dark" role="alert"><i class="fas fa-exclamation-circle"></i> Lösenordet måste vara minst 8 tecken långt.</div>';
            submitBtn.disabled = true;
        } else if (!checkPasswordStrength(inputPW1.value)) {
            message.innerHTML = '<div class="alert alert-warning text-dark" role="alert"><i class="fas fa-exclamation-circle"></i> Lösenordet uppfyller inte kraven.</div>';
            submitBtn.disabled = true;
        } else if (/\s/.test(inputPW1.value)) {
            message.innerHTML = '<div class="alert alert-warning text-dark" role="alert"><i class="fas fa-exclamation-circle"></i> Lösenordet får inte innehålla blanksteg.</div>';
            submitBtn.disabled = true;
        } else {
            message.innerHTML = '<div class="alert alert-success text-dark" role="alert"><i class="fas fa-check-circle"></i> Lösenordet uppfyller kraven.</div>';
            submitBtn.disabled = false;
        }
    }

    // Update message and button on password input
    inputPW1.addEventListener('input', updateMessageAndButton);
    inputPW2.addEventListener('input', updateMessageAndButton);
});
</script>
