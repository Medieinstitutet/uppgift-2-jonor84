  <?php
    // *** ***********************
    // *** MODULE:	DEFAULT/DASHBOARD
    // *** ***********************
    // MODULE SETTINGS IS ALREADY LOADED AUTO

    if ($gloAccess < $intAccess) {
        echo "<div class='$alertError'>$gloWrongAccess</div>";
    } else {

    if ($gloUserNew) {
        header("location: /newaccount");
    }
    ?>

    <!-- Begin content -->
    <?
        if (!$gloUserNew) {
            if ($_SESSION['accountcreated']) {
                unset($_SESSION['accountcreated']);
            }

                $_SESSION['DefaultStartUsed'] = "1";
                unset($_SESSION['DefaultStart']);
                header("Refresh:0; url=/dashboard");

                include('start.php');
            }
        }
        ?>
    <!-- End content -->
    
<? } ?>