<?php
// *** ***********************
// *** MODULE: 	SHOWPROFILE -> User
// *** ***********************
// CHECK ACCESS	 	

// CHECK IF USER HAS A BUSINESS CREATED OR CREATE IT
//checkClient($gloUID);

if ($gloBANKID == 0) {
    if ($gloTempPass == "Y") {
        header("location: /editaccount&show=passwordnew");
    }
}

if ($gloUserNew || $gloUserNewClient) {
    echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {

    // Access to subpages for this app
    $SUBPAGEUACCESS = 1;
?>
    <!-- Begin content -->

    <div class="row" id="user-profile">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="wideget-user mb-2">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="panel profile-cover" style="padding: 0px;">
                                        <div class="profile-cover__action bg-img" style="background: url(<? echo $gloProfileBKGDir; ?>/<? echo $rowProfileBKG; ?>) no-repeat; background-size: cover;">
                                        </div>
                                        <div class="profile-cover__img">
                                            <div class="profile-img-1">
                                                <img src="<? echo $gloAvatarsDir; ?>/<? echo $rowUserPic; ?>" alt="img">
                                            </div>
                                            <div class="profile-img-content text-dark text-start">
                                                <div class="text-dark">
                                                    <h3 class="h3 mb-2">
                                                        <? echo $rowUserFullname; ?>
                                                    </h3>
                                                    <h5 class="text-muted">ID:
                                                        <? echo $rowUSERID; ?>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-profilestart">
                                            <!-- <h2 class="btn-profilestart-text">Mitt konto</h2> -->
                                        </div>
                                        <div class="btn-profile">
                                            <!-- <button class="btn btn-secondary mt-1 mb-1"> <i class="fa fa-envelope"></i> <span>Skicka meddelande</span></button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="px-0 px-sm-4">
                                        <div class="social social-profile-buttons mt-5 float-end">

                                            <div class="mt-3">Hantera:
                                                <a class="social-icon text-primary jtooltip" title="Ändra konto" href="editaccount"><i class="fas fa-user-edit"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3">

            <div class="card">
                <div class="card-body">
                    <h3>Kontaktuppgifter</h3>
                    <? echo $HR0; ?>
                    <div class="d-flex align-items-center mb-3 mt-3">
                        <div class="me-4 text-center text-primary">
                            <span><i class="fa fa-phone"></i></span>
                        </div>
                        <div>
                            <strong><a href="tel:<? echo $rowPhone; ?>" title="phone link">
                                    <? echo $rowPhone; ?>
                                </a></strong>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 mt-3">
                        <div class="me-4 text-center text-primary">
                            <span><i class="fas fa-envelope"></i></span>
                        </div>
                        <div>
                            <strong><a href="mailto:<? echo $rowEmail; ?>" title="email link">
                                    <? echo $rowEmail; ?>
                                </a></strong>
                        </div>
                    </div>
                    <? echo $HR0; ?>
                    <a class="btn btn-primary btn-block mt-3" href="editaccount" title="ändra konto"><i class="fas fa-user-edit" aria-hidden="true"></i> Ändra konto</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3>Information</h3>
                    <? echo $HR0; ?>
                    <div class="mt-4">
                        <div class="alert alert-<? echo $AlertBKG; ?> p-2">
                            <span class="me-2 fw-bold text-dark">Status: </span>
                            <? echo $rowActive; ?> <br>
                            <? if ($rowClosed) { ?>
                                <br>
                                <span class="me-2">
                                    <? echo $ClosedText; ?>
                                </span>
                            <? } ?>
                        </div>
                        <p>Registrerad: <br>
                            <? echo $rowUserAdded; ?>
                        </p>
                        <p>Senast inloggad:<br>
                            <? echo $rowUserLastLogin; ?>
                        </p>
                        <!-- <? echo $rowPresentation; ?> -->
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3>Kopplingar</h3>
                    <? echo $HR0; ?>
                    <div class="mt-4">

                        <?php
                        // IF RS = TRUE THEN PRINT TABLE
                        if (mysqli_num_rows($arrRSActiveClient)) {
                        ?>
                            <div class="card" style="width: auto;">
                                <ul class="list-group list-group-flush" style="a:hover: bg-primary;">
                                    <li class="list-group-item list-group-item-action">
                                        <a href="#">
                                            <h4><i class="fas fa-fw fa-user-tag"></i>
                                                <? echo $rowResellerName; ?>
                                            </h4>
                                        </a> (Leverantör)
                                    </li>
                                    <?
                                    // LOOPS RS AND PRINTS TABLE
                                    while ($arrRowActiveClient = mysqli_fetch_row($arrRSActiveClient)) {

                                        // PUT RS IN VARS
                                        $rowClientID  = $arrRowActiveClient[1];
                                        $rowCompanyName  = $arrRowActiveClient[2];
                                        $rowClientType  = $arrRowActiveClient[3];
                                        $rowAccessName  = $arrRowActiveClient[4];


                                        // PRINTS ROW IN TABLE
                                    ?>
                                        <li class="list-group-item list-group-item-action">
                                            <a href="#">
                                                <h4><i class="fas fa-fw fa-user-tie"></i>
                                                    <? echo $rowCompanyName; ?>
                                                </h4>
                                            </a> (<? echo $rowAccessName; ?>)
                                        </li>

                                    <? } ?>
                                </ul>
                            </div>
                        <? } else {
                            // echo "<div class='$alertInfo'>Det finns inga aktiva kopplade ännu.</div>";
                        } ?>

                    </div>
                </div>
            </div>


        </div>
        <div class="col-xl-9">

            <?
            // SHOW MODULE CONTENTS
            if ($GETSHOW) {
                include_once('show_' . $GETSHOW . '.php');
            }

            // DO MODULE TASKS
            else if ($GETTASK) {
                include_once('task_' . $GETTASK . '.php');
            } else {
                include 'show_start.php';
            }

            ?>
        </div>
    </div>
    <!-- COL-END -->
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card mt-3">
                <div class="card-body">
                    <? echo $gloBackButton; ?>
                </div>
            </div>
        </div>
    </div>


    <!-- End content -->

<? } ?>