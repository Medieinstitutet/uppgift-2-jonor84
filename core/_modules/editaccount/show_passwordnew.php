<?php
$strSQL = "
    SELECT id, 
    (SELECT date FROM data_activities WHERE event = 'pwdrecovery' AND uid = $gloUID ORDER BY date DESC LIMIT 1) AS R1 
    FROM data_users 
    WHERE id = $gloUID AND user_active > 0 
    LIMIT 1";
$arrRS = mysqli_query($SQLlink, $strSQL);

while ($arrRow = mysqli_fetch_row($arrRS)) {
    $rowDate    = (!empty($arrRow[1])) ? date("Y-m-d", strtotime($arrRow[1])) : "Aldrig";
}

if ($gloTempPass == "N") {
    echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
    if ($gloUserNew || $gloUserNewClient) {
        echo "<div class='$alertError'>$gloWrongAccess</div>";
    } else {

?>
        <div class='alert alert-warning text-dark' role='alert'>
           <h4 class="text-dark mb-0"><i class="fas fa-info-circle"></i> Du har loggat in med ett tillfälligt lösenord och måste nu därför välj ett eget.</h4>
        </div>

        <!-- Begin content -->
        <div class="row">

            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h3 class="m-0 font-weight-bold brand-title"><? echo $strHeader; ?> / Ändra lösenord</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=passwordnew">
                            <div class="form-group mb-4">
                                <h4>Datum för senaste byte:</h4>
                                <p class="form-control-static text-muted"><? echo $rowDate; ?></p>
                            </div>
                            <h4>Nytt lösenord: *</h4>
                            <div class="input-group mb-2">
                                <input type="password" id="inputPW1" class="form-control" name="frmPW1" placeholder="Ditt nya lösenord" required autofocus autocomplete="new-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword('inputPW1')">
                                        <i class="far fa-eye"></i>
                                    </span>
                                </div>
                            </div>

                            <h4>Nytt lösenord igen: *</h4>
                            <div class="input-group mb-3">
                                <input type="password" id="inputPW2" class="form-control" name="frmPW2" placeholder="Ditt nya lösenord igen" required autofocus autocomplete="new-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword('inputPW2')">
                                    <i class="far fa-eye"></i>
                                    </span>
                                </div>
                            </div>

                            <div id="message"></div>
                            <? echo $HRB; ?>

                            <button type="submit" id="submitBtn" disabled class="<? echo $btnSuccess; ?>"><i class="fas fa-check-circle"></i> Uppdatera lösenord</button>
                            
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h3 class="m-0 font-weight-bold brand-title">Lösenordsinformation</h3>
                    </div>
                    <div class="card-body">
                        <? include "inc/passwordinfo.php"; ?>
                    </div>
                </div>
            </div>


        </div>
        <!-- End content -->
<? }
} ?>

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
            message.innerHTML = '<div class="alert alert-warning text-dark p-3" role="alert"><i class="fas fa-exclamation-circle"></i> Lösenorden matchar inte.</div>';
            submitBtn.disabled = true;
        } else if (inputPW1.value.length < 8) {
            message.innerHTML = '<div class="alert alert-warning text-dark p-3" role="alert"><i class="fas fa-exclamation-circle"></i> Lösenordet måste vara minst 8 tecken långt.</div>';
            submitBtn.disabled = true;
        } else if (!checkPasswordStrength(inputPW1.value)) {
            message.innerHTML = '<div class="alert alert-warning text-dark p-3" role="alert"><i class="fas fa-exclamation-circle"></i> Lösenordet uppfyller inte kraven.</div>';
            submitBtn.disabled = true;
        } else if (/\s/.test(inputPW1.value)) {
            message.innerHTML = '<div class="alert alert-warning text-dark p-3" role="alert"><i class="fas fa-exclamation-circle"></i> Lösenordet får inte innehålla blanksteg.</div>';
            submitBtn.disabled = true;
        } else {
            message.innerHTML = '<div class="alert alert-success text-dark p-3" role="alert"><i class="fas fa-check-circle"></i> Lösenordet uppfyller kraven.</div>';
            submitBtn.disabled = false;
        }
    }

    // Update message and button on password input
    inputPW1.addEventListener('input', updateMessageAndButton);
    inputPW2.addEventListener('input', updateMessageAndButton);
});
</script>