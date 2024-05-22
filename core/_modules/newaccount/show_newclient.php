<?php
$strSQL = "
	SELECT user_fname, user_sname, user_email, user_phone, user_adress1, user_city, user_zip, user_presentation, user_worktitle, defaultcid 
	FROM data_users WHERE id = $gloUID
	LIMIT 1
";
$arrRS = mysqli_query($SQLlink, $strSQL);
while ($arrRow = mysqli_fetch_row($arrRS)) {
  $rowFName = $arrRow[0];
  $rowSName = $arrRow[1];
  $rowEmail = $arrRow[2];
  $rowPhone = $arrRow[3];
  $rowAdress = $arrRow[4];
  $rowCity = $arrRow[5];
  $rowZip = $arrRow[6];
  $rowPresentation = $arrRow[7];
  $rowWorktitle = $arrRow[8];
  $rowDefaultProfile = $arrRow[9];

  if ($rowFName == "TMPNAME") {
    $rowFName = "";
  }
  $rowContact = $rowFName . " " . $rowSName;
}

if (!$gloUserNewClient) {
  echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
?>
  <!-- Begin content -->
  <div class="row d-flex justify-content-center mt-2">

    <div class="col-xl-4 col-md-6 mb-1 pt-4">
      <div class="card mb-1">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h4 class="m-0 font-weight-bold text-primary">Information</h4>
        </div>
        <div class="card-body"> Vi behöver kunddata om du ska kunna prova på vissa tjänster eller beställa tjänster hos <? echo $gloBrandSiteName; ?>.
          <br><br>När du kommit in kan du skapa kundprofiler för ett företag eller förening som du är firmatecknare för.
          <br> <br>
          <a class="btn btn-info" href="https://terms.moonserver.se/policys" target="_blank">Information om GDPR. <i class="fas fa-external-link-alt"></i></a>
          <!--<div class='<? echo $alertWarning; ?>'><i class="fas fa-info-circle"></i> Vi kommer först kontrollera att organisationen inte redan finns i vårt system, om den finns måste du kontakta den ansvarige för att be dem bjuda in dig.</div>-->
          <!-- <div class='<? echo $alertInfo; ?>'><i class="fas fa-info-circle"></i> Du kan hoppa över detta steg och göra det senare. <br>
            <br>
            <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=newclient">
              <input type="hidden" name="frmSKIP" value="1">
              <button type="submit" class="btn btn-dark"><i class="fas fa-check-circle"></i> Hoppa över</button>
            </form>
          </div> -->
        </div>
      </div>
    </div>
    <div class="col-xl-8 col-md-6 mb-4 pt-4">
      <div class="card mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Ny kundprofil</h4>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=newclient">
            <input type="hidden" name="frmID" value="<? echo $intID; ?>">
            <input type="hidden" name="frmSKIP" value="0">
            <!-- <div class="form-group"> -->
            <!-- <label for="inputStandard" class="control-label">Organisationsform:</label>
              <select id="select100" class="select2 form-control" name="frmOrgType">
                <?
                $strSQL = "SELECT id,se_type FROM data_clienttypes WHERE active = '1' ORDER BY id ASC";
                $arrRS = mysqli_query($SQLlink, $strSQL);
                while ($arrRow = mysqli_fetch_row($arrRS)) {
                  $rowID = $arrRow[0];
                  $rowName = $arrRow[1];
                ?>
                  <option value='<? echo $rowID; ?>' <? if (5 == $rowID) {
                                                        echo "selected";
                                                      } ?>><? if (5 == $rowID) {
                                                              echo "*";
                                                            } ?> (<? echo $rowID; ?>) <? echo $rowName; ?></option>
                <?             }
                ?>
              </select> -->
            <input type="hidden" name="frmOrgType" value="1">

            <!-- </div> -->
            <div class="form-group">
              <label for="inputStandard">Personnummer: *</label>
              <div class="input-group mb-1">
                <input type="number" id="frmOrgID1" class="form-control" pattern="[0-9]" onKeyPress="if(this.value.length==6) return false;" maxlength="6" name="frmOrgID1" min="100001" placeholder="xxxxxx" required autofocus>
                <span class="input-group-text">-</span>
                <input type="number" id="frmOrgID2" class="form-control" pattern="[0-9]" onKeyPress="if(this.value.length==4) return false;" name="frmOrgID2" min="1001" placeholder="xxxx" required autofocus>
              </div>
            </div>

            <input type="text" name="frmOrgName" value="<? echo $rowContact; ?>">
            <input type="text" name="frmOrgEmail" value="<? echo $rowEmail; ?>">
            <input type="text" name="frmContact" value="<? echo $rowContact; ?>">
            <input type="text" name="frmPhone" value="<? echo $rowPhone; ?>">
            <input type="text" name="frmEmail" value="<? echo $rowEmail; ?>">


            <hr>
            <div class="form-group">
              <label for="inputAddress2">Adress: *</label>
              <input type="text" class="form-control" placeholder="Testvägen 2" name="frmORGAdress" value="<? echo $rowPostA; ?>" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="inputZip">Postnr: *</label>
                <input type="text" class="form-control" placeholder="12345" name="frmORGZip" value="<? echo $rowPostAZip; ?>" required>
              </div>
              <div class="form-group col-md-9">
                <label for="inputCity">Ort: *</label>
                <input type="text" class="form-control" placeholder="Ort" name="frmORGCity" value="<? echo $rowPostATown; ?>" required>
              </div>
            </div>
            <hr>
            <div style="float:right;"><button type="submit" class="<? echo $btnSuccess; ?>">Spara och fortsätt <i class="fas fa-arrow-circle-right"></i></button></div>
          </form>
          <br>
          <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=newclient">
            <input type="hidden" name="frmSKIP" value="1">
            <!-- <button type="submit" class="btn btn-dark"><i class="fas fa-check-circle"></i> Hoppa över</button> -->
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End content -->
<? } ?>