<?php
if ($gloClientAccessLevel < 2) {
    echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {

    if ($gloUserNew || $gloUserNewClient) {
        echo "<div class='$alertError'>$gloWrongAccess</div>";
    } else {
?>


        <!-- Begin content -->
        <div class="row">

            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h3 class="m-0 font-weight-bold brand-title"><? echo $strHeader; ?> / Bjud in användare till <? echo $_SESSION['ACTIVECLIENT']; ?></h3>
                    </div>
                    <div class="card-body">
                        <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=user_add">
                            <input type="hidden" name="frmID" value="<? echo $intID; ?>">

                            <div class="form-group" id="frmCheckUsername">
                                <label for="frmUser"><b>E-postadress: *</b></label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" id="frmUser" name="frmUser" value="<? echo $rowUser; ?>" data-user="<? echo $intID; ?>" required>
                                    <img src="<? echo $gloLoaderIMG; ?>" id="loaderIcon" class="position-absolute" style="right:7px;top:10px;display:none" height="20" />
                                    <img src="" id="statusIcon" class="position-absolute" style="right:7px;top:10px;display:none" height="20" />
                                </div>
                                <small id="emailCheck" class="form-text text-muted">
                                    <span id="user-availability-status">
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="inputStandard"><b>Behörighet:</b></label>
                                <select id="select2" class="form-control" data-plugin="select2" name="frmAccess" onchange="yesnoCheck(this);">
                                    <? $strSQL = "SELECT id, access_name FROM data_access WHERE access_active = '1' AND id < '3' ORDER BY id DESC";
                                    $arrRS = mysqli_query($SQLlink, $strSQL);
                                    while ($arrRow = mysqli_fetch_row($arrRS)) {
                                        $rowID = $arrRow[0];
                                        $rowName = $arrRow[1];
                                    ?>

                                        <option value='<? echo $rowID; ?>' <? if ($rowAccessID == $rowID) {
                                                                                echo "selected";
                                                                            } ?>><? if ($rowAccessID == $rowID) {
                                                                                        echo "* ";
                                                                                    } ?>(<? echo $rowID; ?>) <? echo $rowName; ?></option>
                                    <? } ?>
                                </select>
                            </div>

                            <?
                            if ($gloAccess > 6) {
                                $SITEACTIVE = 1;
                            } else {
                                $SITEACTIVE = 0;
                            }
                            if ($gloTotalMSites > 0) {
                                $SITEACTIVE = 1;
                            } else {
                                $SITEACTIVE = 0;
                            }

                            if ($gloAccess > 6) {
                                $BINGOACTIVE = 1;
                            } else {
                                $BINGOACTIVE = 0;
                            }
                            if ($gloTotalMGameplaces > 0) {
                                $BINGOACTIVE = 1;
                            } else {
                                $BINGOACTIVE = 0;
                            }
                            ?>
                            <div id="ifOne" style="display: none;">

                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Halo</button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <h4>Halo</h4>
                                                <? if ($HALOACTIVE) { ?>
                                                    <p>Du har ingen Halo tjänst än. Beställ här.</p>
                                                <? } else { ?>
                                                    <!-- <input type="hidden" name="frmMHALO" value="1">  -->
                                                    <div class="form-group">
                                                        <!-- <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input form-control-lg" id="frmMSITE" name="frmMSITE">
                                <label class="custom-control-label" for="frmMSITE">Aktiv</label>
                                </div> <br>-->

                                                        <!--<input type="checkbox" data-toggle="switchbutton" data-onlabel="Aktiv" data-offlabel="Inaktiv" data-size="sm" name="frmMSITE" data-width="80" data-height="25"> Klicka på knappen för att aktivera eller inaktivera.-->

                                                        <label class="custom-switch">
                                                            <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                                            <input type="checkbox" name="frmMHALO" class="custom-switch-input"></input>
                                                            <span class="custom-switch-indicator"></span>
                                                            <span class="custom-switch-description">Aktiv</span>
                                                        </label>

                                                        <br><br>
                                                        <!-- <h5>Ange vilka Halos som underkontot ska få tillgång till:</h5> -->
                                                        <!-- <select id="select212" class="select2 form-control" name="frmMHalosID[]" multiple>
                                        <? $strSQL = "SELECT siteid,sitename FROM data_halos WHERE clientid ='$gloCurrentClientID' ORDER BY siteid ASC";
                                                    $arrRS = mysqli_query($SQLlink, $strSQL);
                                                    while ($arrRow = mysqli_fetch_row($arrRS)) {
                                                        $rowID         = $arrRow[0];
                                                        $rowName     = $arrRow[1];
                                                        $rowContact = $arrRow[2] . " " . $arrRow[3];

                                                        if ($rowUserID == $rowID) {
                                                            echo "<option value='$rowID' selected>* ($rowID) - $rowName</option>";
                                                        }
                                                        echo "<option value='$rowID'>($rowID) - $rowName</option>";
                                                    } ?>
                                    </select> -->
                                                        <div class="alert alert-info p-2">
                                                            <i class="fas fa-info-circle"></i> När användaren har godkänt din inbjudan kan du lägga till användaren i en eller flera Halo, vilket ger användaren tillgång till dem.
                                                        </div>
                                                    </div>
                                                <? } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Site </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <h4>Site</h4>
                                                <? if (!$SITEACTIVE) { ?>
                                                    <p>Du har ingen Site tjänst än. Beställ här.</p>
                                                <? } else { ?>
                                                    <!--<input type="hidden" name="frmMSITE" value="1"> -->
                                                    <div class="form-group">
                                                        <!-- <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input form-control-lg" id="frmMSITE" name="frmMSITE">
                                    <label class="custom-control-label" for="frmMSITE">Aktiv</label>
                                    </div> <br>-->
                                                        <!--<input type="checkbox" data-toggle="switchbutton" data-onlabel="Aktiv" data-offlabel="Inaktiv" data-size="sm" name="frmMSITE" data-width="80" data-height="25"> Klicka på knappen för att aktivera eller inaktivera.-->


                                                        <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                                            <input type="checkbox" name="frmMSITE" class="custom-switch-input"></input>
                                                            <span class="custom-switch-indicator"></span>
                                                            <span class="custom-switch-description">Aktiv</span>
                                                        </label>

                                                        <br><br>
                                                        <h5>Ange vilka Site hemsidor som underkontot ska få tillgång till:</h5>
                                                        <select id="select21" class="select2 form-control" name="frmMSitesID[]" multiple>
                                                            <? $strSQL = "SELECT siteid,sitename FROM data_sites WHERE clientid ='$gloCurrentClientID' ORDER BY siteid ASC";
                                                            $arrRS = mysqli_query($SQLlink, $strSQL);
                                                            while ($arrRow = mysqli_fetch_row($arrRS)) {
                                                                $rowID         = $arrRow[0];
                                                                $rowName     = $arrRow[1];
                                                                $rowContact = $arrRow[2] . " " . $arrRow[3];

                                                                if ($rowUserID == $rowID) {
                                                                    echo "<option value='$rowID' selected>* ($rowID) - $rowName</option>";
                                                                }
                                                                echo "<option value='$rowID'>($rowID) - $rowName</option>";
                                                            } ?>
                                                        </select>
                                                        <div class="alert alert-info p-2">
                                                            <i class="fas fa-info-circle"></i> Om Moonsite är Aktivt ovan och du lämnar tomt här så får underkontot tillgång till alla MoonSite hemsidor som Kundkontot har tillgång till.
                                                        </div>
                                                    </div>
                                                <? } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Hall/Bilbingo </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <h4>Hall/Bilbingo</h4>
                                                <? if (!$BINGOACTIVE) { ?>
                                                    <p>Du har ingen Bingo tjänst än. Beställ här.</p>
                                                <? } else { ?>
                                                    <!-- <input type="hidden" name="frmMBINGO" value="1">  -->
                                                    <div class="form-group">
                                                        <!--<input type="checkbox" data-toggle="switchbutton" data-onlabel="Aktiv" data-offlabel="Inaktiv" data-size="sm" name="frmMBINGO" data-width="80" data-height="25"> Klicka på knappen för att aktivera eller inaktivera.-->
                                                        <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                                            <input type="checkbox" name="frmMBINGO" class="custom-switch-input"></input>
                                                            <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>
                                                        <br> <br>
                                                        <h5>Ange vilka Spelplatser som underkontot ska få tillgång till:</h5>

                                                        <select id="select200" class="select2 form-control" name="frmMBingosID[]" multiple>
                                                            <? $strSQL = "SELECT id,platsnamn FROM app_gameplaces WHERE clientid ='$gloCurrentClientID' ORDER BY id ASC";
                                                            $arrRS = mysqli_query($SQLlinkA, $strSQL);
                                                            while ($arrRow = mysqli_fetch_row($arrRS)) {
                                                                $rowID         = $arrRow[0];
                                                                $rowName     = $arrRow[1];


                                                                if ($rowUserID == $rowID) {
                                                                    echo "<option value='$rowID' selected>* ($rowID) - $rowName</option>";
                                                                }
                                                                echo "<option value='$rowID'>($rowID) - $rowName</option>";
                                                            } ?>
                                                        </select>

                                                        <div class="alert alert-info p-2">
                                                            <i class="fas fa-info-circle"></i> Om Hall/Bilbingo är Aktivt ovan och du lämnar tomt här så får underkontot tillgång till alla Spelplatser som Kundkontot har tillgång till.
                                                        </div>
                                                    </div>
                                                <? } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <hr>
                            <button type="submit" class="<? echo $btnSuccess; ?>"><i class="fas fa-arrow-circle-right"></i> Spara</button>
                            <a class='<? echo $btnCancel; ?>' href='<? echo $gloBaseModule; ?>&show=subaccounts'><i class="fas fa-times-circle"></i> Avbryt</a>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h3 class="m-0 font-weight-bold brand-title">Information</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            En Medarbetare har den lägsta behörigheten och en Admin har den näst högsta behörighet i kundkontot.
                            Ett underkonto kan aldrig ha samma behörighet som dig själv vilket är den högsta på kundkontot.
                        </p>
                        <p>
                            En Admin har tillgång till Kundkontots alla tjänster samt kunna hantera Medarbetarekonton.
                            Medarbetare har tillgång till alla tjänster eller de tjänster som ni ställer in.
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <!-- End content -->
    <?
    }
    ?>
    <script>
        function yesnoCheck(that) {
            if (that.value == "1") {
                document.getElementById("ifOne").style.display = "block";
            } else {
                document.getElementById("ifOne").style.display = "none";
            }
        }
    </script>
<? } ?>