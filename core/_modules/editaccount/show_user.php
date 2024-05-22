<?php
// *** ***********************
// *** MODULE: 	SHOWPROFILE -> User
// *** ***********************
// CHECK ACCESS	 	

// CHECK IF USER HAS A BUSINESS CREATED OR CREATE IT
//checkClient($gloUID);

if ($gloBANKID == 0) {
    if ($gloTempPass == "Y") {
        //header("location: editaccount&show=passwordnew");
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
                                            <!-- <h2 class="btn-profilestart-text">Ändra mitt konto</h2> -->
                                        </div>
                                        <div class="btn-profile">
                                            <!-- <button class="btn btn-secondary mt-1 mb-1"> <i class="fa fa-envelope"></i> <span>Skicka meddelande</span></button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="px-0 px-sm-4">
                                        <div class="social social-profile-buttons mt-5 float-end">

                                            <div class="mt-3">Visa:
                                                <a class="social-icon text-primary jtooltip" title="Visa konto" href="account"><i class="fas fa-user-circle"></i></a>
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
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold brand-title">Meny</h3>
                        </div>
                        <div class="card-body p-0">
                            <? include 'editmenu.php'; ?>
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

                <!-- COL-END -->

                <div class="col-xl-12 mb-4">
                    <div class="card mt-3">
                        <div class="card-body">
                            <a class="btn btn-light" href="account"><i class="fas fa-arrow-circle-left" aria-hidden="true"></i> Tillbaka</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End content -->

<? } ?>