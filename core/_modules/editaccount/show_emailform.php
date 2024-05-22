<!-- Begin content -->
<div class="row">
    <div class="col-xl-12 col-md-6 mb-4">
      <div class="card mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h3 class="m-0 font-weight-bold brand-title"><? echo $strHeader; ?> / Ändra E-postadress 1/2</h3>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="alert alert-info text-dark p-3 col-xl-8">
            <h4 class="text-dark mb-0"><i class="fas fa-info-circle"></i> Om du ändrar din e-post, kom ihåg att du loggar in med din e-post</h4>
          </div>

          <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&show=email">
            <div class="form-group mb-3">
              <div class="form-row">
                <div class="col-xl-6">
                  <h4>E-post: *</h4>
                  <input type="email" class="form-control" placeholder="E-postadress" name="frmEmail" id="frmEmail" value="<? echo $rowEmail; ?>" oninput="this.value = this.value.replace(/\s+/g, '');" required>
                </div>
              </div>
            </div>
            <div id="message" class="col-xl-6"></div>
            <? echo $HRB; ?>
            <button type="submit" id="submitBtn" disabled class="<? echo $btnSuccess; ?>">Nästa <i class="fas fa-arrow-alt-circle-right"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End content -->
  
<script>
  // Function to check if email exists
  function checkEmail() {
    var email = document.getElementById('frmEmail').value.trim();
    var messageDiv = document.getElementById('message');
    var submitBtn = document.getElementById('submitBtn');

    // Clear previous messages
    messageDiv.innerHTML = '';

    // Check if email field is empty
    if (email === '') {
      submitBtn.disabled = true; // Disable button
      messageDiv.innerHTML = "<div class='<?php echo $alertWarning; ?>'><i class='fas fa-exclamation-circle'></i> Du måste fylla i en e-postadress innan du kan fortsätta. </div>";
      return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/core/shared/ajax/check_userexist.php', true); // Replace with your absolute path
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var response = xhr.responseText.trim();
        if (response === 'YES') {
          // Email exists
          submitBtn.disabled = true; // Disable button
          messageDiv.innerHTML = "<div class='<?php echo $alertError; ?>'><i class='fas fa-times-circle'></i> Det finns redan ett konto med denna E-postadress.</div>";
        } else if (response === 'NO') {
          // Email does not exist
          submitBtn.disabled = false; // Enable button
          messageDiv.innerHTML = "<div class='<?php echo $alertSuccess; ?>'><i class='fas fa-check-circle'></i> Det finns inget konto med denna E-postadress så det går bra att byta till denna. I nästa steg får du verifiera att du kommer åt meddelanden som skickas till denna e-postadress.</div>";
        } else {
          // Unexpected response
          messageDiv.innerHTML = 'Unexpected response from server';
        }
      }
    };
    xhr.send('email=' + email);
  }

  // Event listener for email input
  document.getElementById('frmEmail').addEventListener('input', checkEmail);

</script>
