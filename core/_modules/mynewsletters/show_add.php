<?php
if ($_SESSION["service"] != "mynewsletters") {
    echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
?>

    <!-- Begin content -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Skapa</h2>
        </div>
        <div class="card-body">
            <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=add">


                <div class="row">


                    <div class="col-xl-12">

                        <input type="hidden" name="frmID" value="<? echo $intID; ?>">


                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <h4>Namn: *</h4>
                                    <input type="text" class="form-control" placeholder="Namn" name="frmName" required>
                                </div>
                                <div class="col-6">
                                    <h4>Aktiv: *</h4>
                                    <?
                                    $ActiveChecked = "checked";
                                    ?>
                                    <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                                        <input type="checkbox" name="frmActive" class="custom-switch-input" <? echo $ActiveChecked; ?>></input>
                                        <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>
                                </div>
                            </div>
                        </div>
                        <hr>

                      
                        <hr>
                        <div class="form-group">
                            <h4>Beskrivning:</h4>
                            <textarea id="tiny" name="frmDesc">Kort beskrivning..</textarea>
                        </div>

                    </div>
                </div>
                <? echo $HRB; ?>
                <? echo $gloSendButton; ?>
                <? echo $gloBackButton; ?>
            </form>
        </div>
    </div>
    <!-- End content -->


<? } ?>