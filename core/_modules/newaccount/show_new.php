<?php
if (!$gloUserNew) {
  echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
?>

  <!-- Begin content -->
  <div class="row d-flex justify-content-center">
    <div class="col-xl-12 mt-5 mb-5">

      <div class="card mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h2 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Ny användare</h2>
        </div>
        <!-- Card Body -->
        <div class="card-body">

          <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=new">

            <div class="form-group">
              <div class="form-row">
                <div class="col">

                  <div class="form-row">
                    <div class="form-group col">
                      <h4>Förnamn: *</h4>
                      <input type="text" class="form-control" placeholder="Förnamn" name="frmFName" value="" required>
                    </div>
                    <div class="form-group col">
                      <h4>Efternamn: *</h4>
                      <input type="text" class="form-control" placeholder="Efternamn" name="frmSName" value="" required>
                    </div>
                  </div>


                </div>
              </div>
            </div>
            <hr>
            <div class="form-group">
              <div class="form-row">
                <div class="col">
                  <h4>E-post: *</h4>
                    <input type="email" class="form-control" placeholder="E-postadress" name="frmEmail" value="<? echo $gloUserMail; ?>" readonly>
                    <? echo $gloRegEmailText; ?>
                </div>
                <div class="col">
                  <h4>Mobilnummer: *</h4>
                  <input type="tel" id="frmMobileNumber" class="form-control" name="frmMobileNumber" placeholder="Exempel: 0790000001" value="<? echo $gloUserPhone; ?>" required autofocus>
                  <div id="charCountMobile" class="alert alert-light border-warning text-dark font-weight-bold p-2" role="alert">
                    10 siffror kvar <i class="fas fa-exclamation-circle"></i>
                  </div>
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                      const inputMobileNumber = document.getElementById('frmMobileNumber');
                      const charCountMobile = document.getElementById('charCountMobile');
                      const message = document.getElementById('message');

                      // Function to update character count and styles for mobile number input
                      function updateCharCount() {
                        // Remove all non-numeric characters
                        inputMobileNumber.value = inputMobileNumber.value.replace(/\D/g, '');

                        // Limit input to 10 digits
                        if (inputMobileNumber.value.length > 10) {
                          inputMobileNumber.value = inputMobileNumber.value.slice(0, 10);
                        }

                        const remainingMobile = 10 - inputMobileNumber.value.length;
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
                        } else {
                          message.style.display = 'block';
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

                  <div class="alert alert-info text-dark p-2" style="margin-top: -15px;">
                    <p class="text-dark mb-0"><i class="fas fa-info-circle"></i> Du kan få sms notiser och sms koder på detta nummer.</p>
                  </div>
                </div>
              </div>
            </div>


            <hr>
            <div class="form-group">
              <div class="form-row">
                <div class="col">
                  <h4>Adress: *</h4>
                  <input type="text" class="form-control" placeholder="Testvägen 2" name="frmAdress" value="<? echo $rowPostA; ?>" required>
                </div>
                <div class="col">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <h4>Postnr: *</h4>
                      <input type="text" class="form-control" placeholder="12345" name="frmZip" id="frmZip" value="<? echo $rowPostAZip; ?>" required>

                      <script>
                        document.addEventListener('DOMContentLoaded', function() {
                          const zipInput = document.getElementById('frmORGZip');

                          zipInput.addEventListener('input', function(event) {
                            const inputValue = event.target.value.trim(); // Remove leading/trailing spaces

                            // Allow only digits and limit input to 5 characters
                            const sanitizedInput = inputValue.replace(/\D/g, '').slice(0, 5);

                            // Update the input value with sanitized input
                            event.target.value = sanitizedInput;
                          });
                        });
                      </script>
                    </div>
                    <div class="form-group col-md-9">
                      <h4>Ort: *</h4>
                      <input type="text" class="form-control" placeholder="Ort" name="frmCity" value="<? echo $rowPostATown; ?>" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="alert alert-info text-dark p-2" style="margin-top: -15px;">
                <p class="text-dark mb-0"><i class="fas fa-info-circle"></i> Om vi behöver skicka viktig information per brev till dig.</p>
              </div>
            </div>
            <hr>

            <div class="form-group">
              <h4>Hur hittade du till <? echo $gloBrandSiteName; ?>? *</h4>
              <textarea class="form-control" style="width: 100%;" placeholder="Skriv gärna hur du hittade <? echo $gloBrandSiteName; ?>" name="frmFindus" rows="4" required=""></textarea>
            </div>

            <div class="form-group">
              <h4>Prenumerant eller Kund?</h4>


                <div class="card offer h-100">
                  <div class="card-body text-center p-1 text-nowrap">
                    <label class="custom-switch form-switch mb-0"> 
                      <span class="custom-switch-description p-2">Prenumerant</span> 
                      <input type="checkbox" class="custom-switch-input" id="frmClientSwitch" name="frmClient" value="client"> 
                      <span class="custom-switch-indicator custom-switch-indicator-md"></span> 
                      <span class="custom-switch-description">Kund</span> 
                    </label> 
                  </div>
                </div>
        
            </div>


          <div id="clientdata" style="display: none;">

            <div class="row">
                <div class="col-sm">
                  <h4 class="text-dark">Organisationsform: *</h4>
                  <select id="select100" class="select2 select2-show-search form-control" name="frmOrgType">
                    <? $strSQL = "SELECT id,se_type FROM data_clienttypes WHERE active = '1' ORDER BY id ASC";
                    $arrRS = mysqli_query($SQLlink, $strSQL);
                    while ($arrRow = mysqli_fetch_row($arrRS)) {
                      $rowID     = $arrRow[0];
                      $rowName   = $arrRow[1];
                      ?>
                      
                      <option value='<? echo $rowID; ?>' <? if (5 == $rowID) { echo "selected"; } ?>><? if (5 == $rowID) { echo "*"; } ?> (<? echo $rowID; ?>) <? echo $rowName; ?></option>

                    <?
                    } ?>
                  </select>
                </div>
                <div class="col-sm">
                  <h4 class="text-dark">Organisationsnummer *</h4>
                  <input type="text" id="frmPNR" class="form-control" placeholder="YYMMDDXXXX" name="frmOrgID" required>
                  <div id="charCountPNR" class="alert alert-light border-warning text-dark font-weight-bold p-2" role="alert">
                    10 siffror kvar <i class="fas fa-exclamation-circle"></i>
                  </div>
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                      const inputPNR = document.getElementById('frmPNR');
                      const charCountPNR = document.getElementById('charCountPNR');
                      const messagePNR = document.getElementById('messagePNR');
                      const submitBtn = document.getElementById('submitBtn');

                      function updateCharCountPNR() {
                        inputPNR.value = inputPNR.value.replace(/\D/g, '');

                        // Ensure the length is not more than 10 digits
                        if (inputPNR.value.length > 10) {
                          inputPNR.value = inputPNR.value.slice(0, 10);
                        }

                        const remainingPNR = 10 - inputPNR.value.length;
                        charCountPNR.textContent = remainingPNR + ' siffror kvar';

                        if (remainingPNR === 0) {
                          charCountPNR.textContent = '0 siffror kvar ';
                          charCountPNR.classList.remove('text-black');
                          charCountPNR.classList.remove('border-warning');
                          charCountPNR.classList.add('text-success');
                          charCountPNR.classList.add('border-success');
                          charCountPNR.innerHTML += ' <i class="fas fa-check-circle"></i>';
                          submitBtn.disabled = false; 
                        } else {
                          charCountPNR.textContent = remainingPNR + ' siffror kvar';
                          charCountPNR.classList.remove('text-success');
                          charCountPNR.classList.remove('border-success');
                          charCountPNR.classList.add('text-black');
                          charCountPNR.classList.add('border-warning');
                          charCountPNR.innerHTML += ' <i class="fas fa-exclamation-circle"></i>';
                          submitBtn.disabled = true;
                        }

                        // Show/hide message based on the remaining characters
                        if (remainingPNR === 0) {
                          messagePNR.style.display = 'none';
                        } else {
                          messagePNR.style.display = 'block';
                        }
                      }

                      inputPNR.addEventListener('input', updateCharCountPNR);

                      // Check if the input already has a value when the DOM is fully loaded
                      if (inputPNR.value.length > 0) {
                        updateCharCountPNR();
                      }
                    });
                  </script>
                </div>
                <div class="col-sm">
                  <h4 class="text-dark">Organisationsnamn: *</h4>
                  <input type="text" id="inputStandard" class="form-control" name="frmOrgName" minlength="3" placeholder="Organisationens namn" required>
                  <div class="alert alert-info p-2 text-dark">Exempel: Företaget AB eller Sportklubben IK (Som det står på ert registreringsbevis).
                  </div>
                </div>
              </div>
            </div>









            <? echo $HRB; ?>
            <div style="float:right;"><button type="submit" class="<? echo $btnSuccess; ?>">Spara och fortsätt <i class="fas fa-arrow-circle-right"></i></button></div>
            <? //echo $gloAbortButton; 
            ?>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- End content -->
<? } ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const clientSwitch = document.getElementById('frmClientSwitch');
    const clientData = document.getElementById('clientdata');
    const orgInputs = clientData.querySelectorAll('input, select');

    function toggleClientData() {
      if (clientSwitch.checked) {
        clientData.style.display = 'block';
        orgInputs.forEach(input => {
          input.required = true;
        });
      } else {
        clientData.style.display = 'none';
        orgInputs.forEach(input => {
          input.required = false;
        });
      }
    }

    clientSwitch.addEventListener('change', toggleClientData);
    toggleClientData();
  });
</script>