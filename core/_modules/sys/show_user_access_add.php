<?php

if ($gloAccess < 8) {
    echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
?>
    <div class="row">
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                <h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Lägg till behörighet till användare</h4>
                <? echo $HR10; ?>
                    <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=user_access_add">


                        <h3>Allmänt</h3>
                        <hr>
                        <div class="row">
                            <div class="col-xl-4">
                                <h5><b>Användare: *</b></h5>
                                    <select id="frmUID" class="select2 select2-show-search form-control" name="frmUID">
                                        <? $strSQL = "SELECT id, user_email, user_fname, user_sname FROM data_users ORDER BY id ASC";
                                        $arrRS = mysqli_query($SQLlink, $strSQL);
                                        while ($arrRow = mysqli_fetch_row($arrRS)) {
                                            $rowUID     = $arrRow[0];
                                            $rowUEmail    = $arrRow[1];
                                            $rowUName     = $arrRow[2] . " " . $arrRow[3];
                                            echo "<option value='$rowUID'>($rowUID) $rowUEmail - $rowUName</option>";
                                        } ?>
                                    </select>
                            </div>
                            <div class="col-xl-4">
                                <h5><b>Behörighet: *</b></h5>
                                <div class="form-group">
                                    <select id="frmAID" class="select2 form-control" name="frmAID">
                                        <? $strSQL = "SELECT id,access_name FROM data_access WHERE id < '$gloAccess' AND access_active = 1 ORDER BY id ASC";
                                        $arrRS = mysqli_query($SQLlink, $strSQL);
                                        while ($arrRow = mysqli_fetch_row($arrRS)) {
                                            $rowID = $arrRow[0];
                                            $rowName = $arrRow[1];
                                            echo "<option value='$rowID'>($rowID) $rowName</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <h5><b>Kundprofil: *</b></h5>
                                <div class="form-group">
                                    <select id="frmCID" class="select2 select2-show-search form-control" name="frmCID">
                                        <? $strSQL = "SELECT id,companyname,contactname FROM data_clients ORDER BY id ASC";
                                        $arrRS = mysqli_query($SQLlink, $strSQL);
                                        while ($arrRow = mysqli_fetch_row($arrRS)) {
                                            $rowCID     = $arrRow[0];
                                            $rowCName     = $arrRow[1];
                                            $rowCContact    = $arrRow[2];
                                            echo "<option value='$rowCID'>($rowCID) $rowCName - $rowCContact</option>";
                                        } ?>
                                    </select>
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
<? } ?>