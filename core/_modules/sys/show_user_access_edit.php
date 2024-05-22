<?php
if ($gloAccess < 8) {
    echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
    $intID = intval($_GET['id']);
    $strSQL = "
    SELECT 
        t1.id,
        t1.added, t1.updated, t1.active, t1.accepted, t1.activebingo,
        t1.activesites, t1.bingosid, t1.sitesid, t1.aid, t1.cid, 
        t1.activehalo, t1.halosid, t1.activehosting, t1.hostingsid, t1.activecards,
        t1.cardsid, t1.activedrives, t1.drivesid, t1.economy, 
        t1.sales, t1.support,
        t2.id,t2.user_fname,t2.user_sname,t2.user_email,t2.user_access,
        t2.user_active,
        t3.access_name,
        t4.companyname
    FROM data_clients_access AS t1 
    LEFT JOIN data_users AS t2 
    ON t1.uid = t2.id 
    LEFT JOIN data_access AS t3 
    ON t1.aid = t3.id 
    LEFT JOIN data_clients AS t4 
    ON t1.cid = t4.id 
    WHERE t1.id = '$intID'
    ORDER BY t2.user_email DESC";

    $arrRS = mysqli_query($SQLlink, $strSQL);
    while ($arrRow = mysqli_fetch_row($arrRS)) {
        $rowID = $arrRow[0]; // Access ID t1.id
        $rowAdded = date('Y-m-d H:i', $arrRow[1]); //  t1.added
        $rowUpdated = date('Y-m-d H:i', $arrRow[2]); // t1.updated

        $rowActive = $arrRow[3]; // t1.active
        $rowAccepted = $arrRow[4]; // t1.accepted
        $rowActiveBingo = $arrRow[5]; // t1.activebingo
        $rowActiveSite = $arrRow[6]; // t1.activesites
        $rowBingosID = $arrRow[7]; // t1.bingosid
        $rowSitesID = $arrRow[8]; // t1.sitesid
        $rowAccessID = $arrRow[9]; // t1.aid
        $rowClientID = $arrRow[10]; // t1.cid

        $rowActiveHalo = $arrRow[11]; // t1.activehalo
        $rowHalosID = $arrRow[12]; // t1.halosid

        $rowActiveHosting = $arrRow[13]; // t1.activehosting
        $rowHostingsID = $arrRow[14]; // t1.hostingsid

        $rowActiveCards = $arrRow[15]; // t1.activecards
        $rowCardsID = $arrRow[16]; // t1.cardsid

        $rowActiveDrive = $arrRow[17]; // t1.activedrives
        $rowDrivesID = $arrRow[18]; // t1.drivesid

        $rowActiveEconomy = $arrRow[19]; // t1.halosid
        $rowActiveSales = $arrRow[20]; // t1.halosid
        $rowActiveSupport = $arrRow[21]; // t1.halosid


        $rowUID = $arrRow[22]; // User ID t2.id
        $rowName = $arrRow[24] . " " . $arrRow[23]; // t2.user_fname t2.user_sname
        $rowEmail = $arrRow[25]; // t2.user_email
        $rowUAccess = $arrRow[26]; // t2.user_access
        $rowUActive = ($arrRow[27]) ? "Ja" : "Nej"; // t2.user_active

        $rowAccessName = $arrRow[28]; // t3.access_name
        $rowCompanyName = $arrRow[29]; // t4.companyname

        //$rowGPlacesAll      = $arrRow[11];
        //$rowGPlaces     = explode(",",$rowGPlacesAll);


    }
?>


    <!-- Begin content -->
    <div class="row">

        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-body">

                    <h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Ändra användares behörighet</h4>
                    <? echo $HR10; ?>
                    <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=user_access_edit">
                        <input type="hidden" name="frmID" value="<? echo $intID; ?>">


                        <h3 class="text-success">(<? echo $rowUID; ?>) <? echo $rowEmail; ?> - <? echo $rowName; ?></h3>

                        <br>
                        <h3>Allmänt</h3>
                        <hr>
                        <div class="row">
                            <div class="col-xl-4">
                                <h4><b>Kundprofil: *</b></h4>
                                <div class="form-group">
                                    <select id="select01" class="select2 select2-show-search form-control" name="frmCID">
                                        <? $strSQL = "SELECT id,companyname FROM data_clients ORDER BY id ASC";
                                        $arrRS = mysqli_query($SQLlink, $strSQL);
                                        while ($arrRow = mysqli_fetch_row($arrRS)) {
                                            $rowCID    = $arrRow[0];
                                            $rowCName  = $arrRow[1];

                                        ?>
                                            <option value='<? echo $rowCID; ?>' <? if ($rowClientID == $rowCID) {
                                                                                    echo "selected";
                                                                                } ?>><? if ($rowClientID == $rowCID) {
                                                                                            echo "* ";
                                                                                        } ?> (<? echo $rowCID; ?>) <? echo $rowCName; ?></option>

                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <h4><b>Behörighet: *</b></h4>
                                <div class="form-group">
                                    <select id="Select21" class="select2 form-control" name="frmAID">
                                        <? $strSQL = "SELECT id,access_name FROM data_access WHERE id < '$gloAccess' AND access_active = 1 ORDER BY id ASC";
                                        $arrRS = mysqli_query($SQLlink, $strSQL);
                                        while ($arrRow = mysqli_fetch_row($arrRS)) {
                                            $rowID = $arrRow[0];
                                            $rowName = $arrRow[1];
                                        ?>

                                            <option value='<? echo $rowID; ?>' <? if ($rowAccessID == $rowID) {
                                                                                    echo "selected";
                                                                                } ?>><? if ($rowAccessID == $rowID) {
                                                                                            echo "* ";
                                                                                        } ?> (<? echo $rowID; ?>) <? echo $rowName; ?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <h4><b>Status: *</b></h4>
                                <? if ($rowActive == 1) {
                                    $Active = "checked";
                                } else {
                                    $Active = "";
                                } ?>

                                <div class="form-group">
                                    <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                        <input type="checkbox" name="frmActive" class="custom-switch-input" <? echo $Active; ?>></input>
                                        <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>
                                </div>
                            </div>
                        </div>
                        <br>

                        <h3>Molnappar Tjänster</h3>
                        <hr>
                        <h4><b>MSite:</b></h4>
                        <div class="row">
                            <div class="col-3">
                                <? if ($rowActiveSite == 1) {
                                    $MSITEActive = "checked";
                                } else {
                                    $MSITEActive = "";
                                } ?>

                                <div class="form-group">
                                    <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                        <input type="checkbox" name="frmActiveSites" class="custom-switch-input" <? echo $MSITEActive; ?>></input>
                                        <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <input type="text" id="inputStandard" class="form-control" name="frmSitesID" placeholder="Exempel: 1,2,4" value="<? echo $rowSitesID; ?>">
                            </div>
                        </div>
                        <hr>

                        <h4><b>MHalo:</b></h4>
                        <div class="row">
                            <div class="col-3">
                                <? if ($rowActiveHalo == 1) {
                                    $MHALOActive = "checked";
                                } else {
                                    $MHALOActive = "";
                                } ?>

                                <div class="form-group">
                                    <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                        <input type="checkbox" name="frmActiveHalo" class="custom-switch-input" <? echo $MHALOActive; ?>></input>
                                        <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>

                                </div>
                            </div>
                            <div class="col-6">
                                <input type="text" id="inputStandard" class="form-control" name="frmHaloID" placeholder="Exempel: 1,2,4" value="<? echo $rowHalosID; ?>">
                            </div>
                        </div>
                        <hr>

                        <h4><b>MBingo:</b></h4>
                        <div class="row">
                            <div class="col-3">
                                <? if ($rowActiveBingo == 1) {
                                    $MBINGOActive = "checked";
                                } else {
                                    $MBINGOActive = "";
                                } ?>

                                <div class="form-group">
                                    <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                        <input type="checkbox" name="frmActiveBingo" class="custom-switch-input" <? echo $MBINGOActive; ?>></input>
                                        <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>

                                </div>
                            </div>
                            <div class="col-6">
                                <input type="text" id="inputStandard" class="form-control" name="frmBingosID" placeholder="Exempel: 1,2,4" value="<? echo $rowBingosID; ?>">
                            </div>
                        </div>
                        <hr>

                        <h4><b>MHosting:</b></h4>
                        <div class="row">
                            <div class="col-3">
                                <? if ($rowActiveHosting == 1) {
                                    $MHostingActive = "checked";
                                } else {
                                    $MHostingActive = "";
                                } ?>

                                <div class="form-group">
                                    <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                        <input type="checkbox" name="frmActiveHosting" class="custom-switch-input" <? echo $MHostingActive; ?>></input>
                                        <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>

                                </div>
                            </div>
                            <div class="col-6">
                                <input type="text" id="inputStandard" class="form-control" name="frmHostingsID" placeholder="Exempel: 1,2,4" value="<? echo $rowHostingsID; ?>">
                            </div>
                        </div>
                        <hr>

                        <h4><b>MCards:</b></h4>
                        <div class="row">
                            <div class="col-3">
                                <? if ($rowActiveCards == 1) {
                                    $MCardsActive = "checked";
                                } else {
                                    $MCardsActive = "";
                                } ?>

                                <div class="form-group">
                                    <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                        <input type="checkbox" name="frmActiveCards" class="custom-switch-input" <? echo $MCardsActive; ?>></input>
                                        <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>

                                </div>
                            </div>
                            <div class="col-6">
                                <input type="text" id="inputStandard" class="form-control" name="frmCardsID" placeholder="Exempel: 1,2,4" value="<? echo $rowCardsID; ?>">
                            </div>
                        </div>
                        <hr>

                        <h4><b>MDrive:</b></h4>
                        <div class="row">
                            <div class="col-3">
                                <? if ($rowActiveDrive == 1) {
                                    $MDriveActive = "checked";
                                } else {
                                    $MDriveActive = "";
                                } ?>

                                <div class="form-group">
                                    <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                        <input type="checkbox" name="frmActiveDrive" class="custom-switch-input" <? echo $MDriveActive; ?>></input>
                                        <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>

                                </div>
                            </div>
                            <div class="col-6">
                                <input type="text" id="inputStandard" class="form-control" name="frmDrivesID" placeholder="Exempel: 1,2,4" value="<? echo $rowDrivesID; ?>">
                            </div>
                        </div>
                        <hr>

                        <br>
                        <!-- START ClientAdmins apps -->
                        <h3>Molnappar Övriga</h3>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h4><b>Ekonomi:</b></h4>
                                <? if ($rowActiveEconomy == 1) {
                                    $EconomyActive = "checked";
                                } else {
                                    $EconomyActive = "";
                                } ?>

                                <div class="form-group">
                                    <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                        <input type="checkbox" name="frmActiveEconomy" class="custom-switch-input" <? echo $EconomyActive; ?>></input>
                                        <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>

                                </div>
                            </div>
                            <div class="col-4">
                                <h4><b>Försäljning:</b></h4>
                                <? if ($rowActiveSales == 1) {
                                    $SalesActive = "checked";
                                } else {
                                    $SalesActive = "";
                                } ?>

                                <div class="form-group">
                                    <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                        <input type="checkbox" name="frmActiveSales" class="custom-switch-input" <? echo $SalesActive; ?>></input>
                                        <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>

                                    <br>
                                </div>
                            </div>
                            <div class="col-4">
                                <h4><b>Support:</b></h4>
                                <? if ($rowActiveSupport == 1) {
                                    $SupportActive = "checked";
                                } else {
                                    $SupportActive = "";
                                } ?>

                                <div class="form-group">
                                    <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                        <input type="checkbox" name="frmActiveSupport" class="custom-switch-input" <? echo $SupportActive; ?>></input>
                                        <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>

                                    <br>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- END ClientAdmins apps -->


                        <? echo $HRB; ?>

                        <? echo $gloSendButton; ?>
                        <? echo $gloBackButton; ?>
                    </form>
                </div>
            </div>
        </div>



    </div>
    <!-- End content -->
<?
}
?>