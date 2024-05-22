<?php
if ($gloUserNew || $gloUserNewClient) {
  echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {

    $EmailPosted = mysqli_real_escape_string($SQLlink,$_POST['frmEmail']);
    $EmailCode = mysqli_real_escape_string($SQLlink,$_POST['frmCode']);

    if (empty($EmailPosted)) { 
        include 'show_emailform.php';
    } else { 
        include 'show_emailcode.php';
    }

} ?>
