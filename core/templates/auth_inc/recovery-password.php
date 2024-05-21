<style>
    .form-signin input[type="password"] {
        margin-bottom: 0px!important;
    }
</style>

<?
if ($gloBrandHideForget) {
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

    if (!$CodeActive) {
        $_SESSION['info'] = 'Koden är ogiltig. Var god påbörja en ny återställning för att få en ny kod.';
        header("location: ?task=forget");
    } else { 

?>
        <form class="" action="?task=rpasschange" method="post">
        <input type="hidden" name="frmBRANDING" value="<? echo $BRAND; ?>">
        <input type="hidden" name="frmCODE" value="<? echo $PWCODE; ?>">
        <input type="hidden" name="frmUID" value="<? echo $codeUserID; ?>">

            <p class="pheader">Nu kan du byta lösenordet</p>
            <div id="passwordRules" class="mb-2">
                <? include $gloPasswordRules; ?>
            </div>

            <div class="input-group">
                <input type="password" id="inputPW1" class="form-control" name="frmPW1" placeholder="Ditt nya lösenord" required autofocus autocomplete="new-password">
                <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePassword('inputPW1')">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" id="inputPW2" class="form-control" name="frmPW2" placeholder="Ditt nya lösenord igen" required autofocus autocomplete="new-password">
                <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePassword('inputPW2')">
                    <i class="far fa-eye"></i>
                    </span>
                </div>
            </div>

            <div id="message"></div>

            <button class="mt-3 btn btn-lg btn-block btn-colors growsm" id="submitBtn" disabled type="submit"><i class="fas fa-user-lock"></i> Uppdatera lösenord</button>
        </form>
<?      } 
    } 
}
?>
<hr>
<p>
    <i class="fa-solid fa-circle-arrow-left"></i> <a href="?task=login">Tillbaka till Inloggningen</a>
</p>
<hr>
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
