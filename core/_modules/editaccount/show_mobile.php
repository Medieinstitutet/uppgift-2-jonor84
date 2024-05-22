<?php
if ($gloUserNew || $gloUserNewClient) {
  echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {

    $PhonePosted = mysqli_real_escape_string($SQLlink,$_POST['frmMobileNumber']);
    $PhoneCode = mysqli_real_escape_string($SQLlink,$_POST['frmCode']);

    if (empty($PhonePosted)) { 
        include 'show_phoneform.php';
    } else { 
        include 'show_phonecode.php';
    }

} ?>

<!-- <div class="alert alert-info text-dark"><? echo $gloIndev; ?> <br> Du kan ändra telefon under <a href="editaccount&show=profile">profil</a> just nu.</div> -->
