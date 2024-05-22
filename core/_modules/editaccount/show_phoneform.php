<!-- Begin content -->
<div class="row">
    <div class="col-xl-12 col-md-6 mb-4">
      <div class="card mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h3 class="m-0 font-weight-bold brand-title"><?php echo $strHeader; ?> / Ändra Mobilnummer 1/2</h3>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="alert alert-info text-dark p-3 col-xl-8">
            <h4 class="text-dark mb-0"><i class="fas fa-info-circle"></i> Du kan få sms notiser och sms koder på detta nummer.</h4>
          </div>

          <form method="post" class="form-horizontal" action="<?php echo $gloBaseModule; ?>&show=mobile">
           
          <div class="form-group mb-3">
              <div class="form-row">
                <div class="col-xl-6">
                
                    <input type="tel" id="frmMobileNumber" class="form-control" name="frmMobileNumber" placeholder="Exempel: 0790000001" value="<? echo $rowPhone; ?>" required autofocus>
                    <div id="charCountMobile" class="alert alert-light border-warning text-dark font-weight-bold p-2" role="alert">
                        10 siffror kvar <i class="fas fa-exclamation-circle"></i>
                    </div>         
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const inputMobileNumber = document.getElementById('frmMobileNumber');
                            const charCountMobile = document.getElementById('charCountMobile');
                            const message = document.getElementById('message');
                            const submitBtn = document.getElementById('submitBtn');

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
                
                </div>
              </div>

            </div>

            <div id="message" class="col-xl-6"><div class="alert alert-warning text-dark"><i class="fas fa-exclamation-circle"></i> Du måste fylla i ditt mobilnummer innan du kan fortsätta.</div></div>
            <?php echo $HRB; ?>
            <button type="submit" id="submitBtn" disabled class="<?php echo $btnSuccess; ?>">Nästa <i class="fas fa-arrow-alt-circle-right"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- End content -->
