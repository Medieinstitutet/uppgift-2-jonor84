<?php
if ($gloAccess < 8) {
    echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
    $intID = intval($_GET['id']);
    $strSQL = "
    SELECT
        id,user_email,user_fname,
        user_sname,user_access,
        user_active,group_id,user_phone,
        user_hidden,accepted_terms,client_id,
        using_tmp_pw
    FROM data_users
    WHERE id = $intID
    LIMIT 1";

    $arrRS = mysqli_query($SQLlink, $strSQL);
    while ($arrRow = mysqli_fetch_row($arrRS)) {
        $rowID          = $arrRow[0];
        $rowUser        = $arrRow[1];
        $rowFName       = $arrRow[2];
        $rowSName       = $arrRow[3];
        $rowAccess      = $arrRow[4];
        $rowActive      = $arrRow[5];
        $rowAF          = $arrRow[6];
        $rowPhone       = $arrRow[7];
        $rowHidden      = $arrRow[8];
        $rowAcceptedTerms   = $arrRow[9];
        $rowClientID        = $arrRow[10];
        $rowTempActive        = $arrRow[11];
    }

?>

    <? //TESTING OF CHECK if email/username exist working here but not with the ajax function
    $strSQL = "SELECT * FROM data_users WHERE user_email = '1johan.norr84@gmail.com'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CHECKEMAIL = mysqli_num_rows($results);
    //echo $CHECKEMAIL ;

    if ($CHECKEMAIL > 0) {
        //echo "<span class='status-not-available'> Unavailable</span>";
    } else {
        //echo "<span class='status-available'> Available</span>";
    }

    ?>


    <!-- Begin content -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Ändra användare</h4>
        </div>
        <div class="card-body">
            <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=user_edit">


                <div class="row">


                    <div class="col-xl-6">

                        <input type="hidden" name="frmID" value="<? echo $intID; ?>">


                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <h4>Förnamn: *</h4>
                                    <input type="text" class="form-control" placeholder="Förnamn" name="frmFName" value="<? echo $rowFName; ?>" required>
                                </div>
                                <div class="col">
                                    <h4>Efternamn:</h4>
                                    <input type="text" class="form-control" placeholder="Efternamn" name="frmSName" value="<? echo $rowSName; ?>">
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <h4>E-postadress: *</h4>

                                    <div class="position-relative" id="frmCheckUsername">
                                        <input type="text" class="form-control" id="frmUser" name="frmUser" value="<? echo $rowUser; ?>" data-user="<? echo $intID; ?>" required>
                                        <img src="<? echo $gloLoaderIMG; ?>" id="loaderIcon" class="position-absolute" style="right:7px;top:10px;display:none" height="20" />
                                        <img src="" id="statusIcon" class="position-absolute" style="right:7px;top:10px;display:none" height="20" />
                                    </div>
                                    <small id="emailCheck" class="form-text text-muted">
                                        <span id="user-availability-status">
                                    </small>
                                </div>

                                <div class="col">
                                    <h4>Telefon:</h4>

                                    <input type="tel" class="form-control" id="frmMobileNumber" placeholder="Exempel: 0790000001" name="frmPhone" value="<?php echo $rowPhone; ?>" required>
                                    <small>Endast siffror tillåtna.</small>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div id="charCountMobile" class="alert alert-light border-warning text-black font-weight-bold p-2" style="margin-left: -13px;" role="alert">
                                                    10 siffror kvar <i class="fas fa-exclamation-circle"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


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

                            </div>
                        </div>
                        <hr>

                        <!-- Lösenord: -->
                        <div class="form-group">
                            <h4>Lösenord:</h4>
                            <a href='#' data-id='Passwordinfo' data-toggle='modal' data-bs-toggle='modal' data-target='#Modal-Passwordinfo' data-bs-target='#Modal-Passwordinfo' class="btn btn-light btn-sm"><i class="fa-solid fa-key"></i> Lösenordsinformation</a>
                            <br><br>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-key" id="generatePassword"></i></span>
                                <input type="password" id="inputPassword" autocomplete="new-password" class="form-control" name="frmPass" value="<?php echo $rowPass; ?>">
                                <span class="input-group-text"><i class="fas fa-eye" id="togglePassword"></i></span>
                            </div>
                            <small id="passHelp" class="form-text text-muted">(Lämna tomt om du inte ska ändra lösenordet)</small>
                        </div>

                        <hr>
                        <div class="form-group">
                            <h4>Tvinga lösenordsbyte:</h4>
                            <? if ($rowTempActive == "Y") {
                                $TempActiveChecked = "checked";
                            } else {
                                $TempActiveChecked = "";
                            } ?>
                            <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                <input type="checkbox" name="frmTempPass" class="custom-switch-input" <? echo $TempActiveChecked; ?>></input>
                                <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>
                        </div>


                    </div>


                    <div class="col-xl-6">
                        <div class="form-group">
                            <h4>Huvud behörighet:</h4>
                            <select id="Select2" class="select2 select2-show-search form-control" name="frmAccess">
                                <? $strSQL = "SELECT id,access_name FROM data_access WHERE id < '$gloAccess' AND access_active = 1 ORDER BY id ASC";
                                $arrRS = mysqli_query($SQLlink, $strSQL);
                                while ($arrRow = mysqli_fetch_row($arrRS)) {
                                    $rowID = $arrRow[0];
                                    $rowName = $arrRow[1];

                                    if ($rowAccess == $rowID) {
                                        echo "<option value='$rowID' selected>* ($rowID) $rowName</option>";
                                    }
                                    echo "<option value='$rowID'>($rowID) $rowName</option>";
                                } ?>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <h4>Hör till kund:</h4>
                            <select id="select2" class="select2 select2-show-search form-control" name="frmClient">
                                <? $strSQL = "SELECT id,companyname,contactname FROM data_clients ORDER BY id ASC";
                                $arrRS = mysqli_query($SQLlink, $strSQL);
                                while ($arrRow = mysqli_fetch_row($arrRS)) {
                                    $rowCID    = $arrRow[0];
                                    $rowCName  = $arrRow[1];
                                    $rowCContact   = $arrRow[2];

                                    if ($rowClientID == $rowCID) {
                                        echo "<option value='$rowCID' selected>* ($rowCID) $rowCName - $rowCContact</option>";
                                    }
                                    echo "<option value='$rowCID'>($rowCID) $rowCName - $rowCContact</option>";
                                } ?>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <h4>Hör till återförsäljare:</h4>

                            <select id="select1" class="select2 select2-show-search form-control" name="frmAF">
                                <? $strSQL = "SELECT id,companyname FROM data_resellers ORDER BY id ASC";
                                $arrRS = mysqli_query($SQLlink, $strSQL);
                                while ($arrRow = mysqli_fetch_row($arrRS)) {
                                    $rowID = $arrRow[0];
                                    $rowName = $arrRow[1];

                                    if ($rowAF == $rowID) {
                                        echo "<option value='$rowID' selected>* ($rowID) $rowName</option>";
                                    }
                                    echo "<option value='$rowID'>($rowID) $rowName</option>";
                                } ?>
                            </select>
                        </div>

                        <hr>

                        <div class="form-group">
                            <h4>Aktiv: *</h4>
                            <? if ($rowActive) {
                                $ActiveChecked = "checked";
                            } else {
                                $ActiveChecked = "";
                            } ?>
                            <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                <input type="checkbox" name="frmActive" class="custom-switch-input" <? echo $ActiveChecked; ?>></input>
                                <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>
                        </div>

                    </div>
                </div>
                <div id="message">
                    <div class="alert alert-warning text-black"><i class="fas fa-exclamation-circle"></i> Du bör fylla i mobilnummer innan du sparar. Detta bland annat för sms lösenord.</div>
                </div>
                <? echo $HRB; ?>
                <? echo $gloSendButton; ?>
                <? echo $gloBackButton; ?>
            </form>
        </div>
    </div>

    <!-- End content -->
<?
}
?>

<script>
    // $(document).ready(function() {
    //     $(document).on('blur', '#frmUser', function(e) {
    //         e.preventDefault();

    //         let username = $(this).val();
    //         let userId = $(this).attr('data-user');

    //         checkUsername(username, userId);
    //     });

    //     function checkUsername(username, userId) {
    //         $('#frmUser').removeClass('is-invalid');
    //         $('#frmCheckUsername #loaderIcon').fadeIn();
    //         $('#frmCheckUsername #statusIcon').fadeOut();

    //         let postData = {
    //             frmUser: username,
    //             frmUserId: userId,
    //         };

    //         $.ajax({
    //                 url: 'system/check-emailexist.php',
    //                 type: 'post',
    //                 dataType: 'json',
    //                 data: postData,
    //             })
    //             .done(function(response) {
    //                 if (response.exists === true) {
    //                     $('#frmUser').addClass('is-invalid');
    //                     $('#statusIcon').attr('src', 'system/images/error_16.png').fadeIn();
    //                 } else {
    //                     $('#statusIcon').attr('src', 'system/images/success_16.png').fadeIn();
    //                 }
    //             })
    //             .fail(function(jqXHR, textStatus, errorThrown) {
    //                 console.log(textStatus, errorThrown);
    //             })
    //             .always(function() {
    //                 $('#frmCheckUsername #loaderIcon').fadeOut();
    //             });
    //     };
    // });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const generatePasswordBtn = document.getElementById('generatePassword');
        const inputPassword = document.getElementById('inputPassword');
        const togglePassword = document.getElementById('togglePassword');

        generatePasswordBtn.addEventListener('click', function() {
            // Generate a random password
            const generatedPassword = generateRandomPassword(10);

            // Set the generated password to the input field
            inputPassword.value = generatedPassword;

            // Set input type to "text" to always show the password
            inputPassword.setAttribute('type', 'text');

            // Change icon to indicate password visibility
            togglePassword.classList.remove('fa-eye-slash');
            togglePassword.classList.add('fa-eye');
        });


        // Function to generate a random password
        function generateRandomPassword(length) {
            // Define character sets
            const capitalLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const lowercaseLetters = 'abcdefghijklmnopqrstuvwxyz';
            const digits = '0123456789';
            const specialCharacters = '!@#$%^&*()-_=+{};:,<.>';

            // Combine character sets
            const allCharacters = capitalLetters + lowercaseLetters + digits + specialCharacters;

            let password = '';
            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * allCharacters.length);
                password += allCharacters[randomIndex];
            }

            return password;
        }

        togglePassword.addEventListener('click', function() {
            const type = inputPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            inputPassword.setAttribute('type', type);

            // Change icon based on password visibility
            if (type === 'password') {
                togglePassword.classList.remove('fa-eye-slash');
                togglePassword.classList.add('fa-eye');
            } else {
                togglePassword.classList.remove('fa-eye');
                togglePassword.classList.add('fa-eye-slash');
            }
        });

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