<?php
if ($gloUserNew || $gloUserNewClient) {
  echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {

?>


  <!-- Begin content -->
  <div class="row">
    <div class="col-xl-12 col-md-6 mb-4">

      <div class="card mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h3 class="m-0 font-weight-bold brand-title"><? echo $strHeader; ?> / Ändra Profil</h3>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class='alert alert-info text-dark'><i class="fas fa-info-circle"></i> Alla fält markerade med en asterisk (*) är obligatoriska.</div>

          <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=profile">

            <div class="form-group">
              <div class="form-row">
                <div class="col">
                  <label for="inputStandard">Förnamn: *</label>
                  <input type="text" class="form-control" placeholder="Förnamn" name="frmFName" value="<? echo $rowFName; ?>" required>
                  <hr>
                  <label for="inputStandard">Efternamn: *</label>
                  <input type="text" class="form-control" placeholder="Efternamn" name="frmSName" value="<? echo $rowSName; ?>" required>
                </div>
                <div class="col">
                  <label for="inputStandard">Personnummer:</label>
                  <input type="text" class="form-control" id="frmPID" placeholder="Exempel: 196001010202" name="frmPID" value="<? echo $rowPID; ?>">
                  <small>Endast siffror tillåtna. Om till exempel, någon av organisationer du tillhör, kommer använda BankID funktionalitet.</small>

                  <div class="container">
                    <div class="row">
                      <div class="col-auto">
                        <div id="charCountPID" class="alert alert-light border-light text-black font-weight-bold p-2" style="margin-left: -13px;" role="alert">
                          12 siffror kvar
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <script>
                  const inputPID = document.getElementById('frmPID');
                  const charCountPID = document.getElementById('charCountPID');

                  inputPID.addEventListener('input', function() {
                    // Remove all non-numeric characters
                    this.value = this.value.replace(/\D/g, '');

                    // Limit input to 10 digits
                    if (this.value.length > 12) {
                      this.value = this.value.slice(0, 12);
                    }

                    const remainingPID = 12 - this.value.length;
                    charCountPID.textContent = remainingPID + ' siffror kvar';
                  });
                </script>

              </div>
            </div>
            <hr>

            <!-- <div id="message"><div class="alert alert-warning text-black"><i class="fas fa-exclamation-circle"></i> Du måste fylla i ditt mobilnummer innan du kan spara. Detta bland annat för sms lösenord.</div></div> -->
            <? echo $HRB; ?>

            <button type="submit" id="submitBtn" class="<? echo $btnSuccess; ?>"><i class="fas fa-check-circle"></i> Spara</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- End content -->
<? } ?>