<?php
if ($gloUserNew || $gloUserNewClient) {
  echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {

?>


  <!-- Begin content -->
  <div class="row">
    <div class="col-xl-12 col-md-6 mb-4">

      <div class="card mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h3 class="m-0 font-weight-bold brand-title"><? echo $strHeader; ?> / Ändra Profilinställningar</h3>
        </div>
        <!-- Card Body -->
        <div class="card-body">

        <div class="col-xl-6 col-md-6 mb-4">

          <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=settings">
          <input type="hidden" name="frmEdit" value="1">

            <div class="form-group">
            <h4>Standard Profil: <i class="fas fa-question-circle text-primary jtooltip" title="Om du har tillgång till flera kundprofiler så kan du välja här <br>vilken som ska användas som standard när du loggar in."></i></h4>
              <select id="select100" class="select2 form-control" name="frmDefaultProfile">
                <?
                $strSQL = "SELECT t1.id,
                 t1.companyname
                 FROM data_clients AS t1 
                 LEFT JOIN data_clients_access AS t2 
                 ON t1.id = t2.cid 		 
                 WHERE t1.closed = '0'
                 AND t2.accepted = '1'
                 AND '" . $gloUID . "' IN (t2.uid)
                 ORDER BY companyname";
                $arrRS = mysqli_query($SQLlink, $strSQL);
                while ($arrRow = mysqli_fetch_row($arrRS)) {
                  $rowID = $arrRow[0];
                  $rowName = $arrRow[1];

                ?>
                  <option value='<? echo $rowID; ?>' 
                  <? if ($rowDefaultProfile == $rowID) {
                    echo "selected";
                  } ?>><? if ($rowDefaultProfile == $rowID) {
                    echo "*";
                  } ?> (<? echo $rowID; ?>) <? echo $rowName; ?></option>";
                <? } ?>
              </select>
            </div>

            <div class="form-group">
            <h4>Startsida: <i class="fas fa-question-circle text-primary jtooltip" title="Här kan du välja vilken sida du vill som ska öppnas direkt när du loggar in."></i></h4>
              <select id="select101" class="select2 form-control" name="frmDefaultStart">
                <option value='' <? if (!$rowDefaultStart) {
                                    echo "selected";
                                  } ?>><? if (!$rowDefaultStart) {
                                          echo "*";
                                        } ?> Startappar</option>";
                <?
                $strSQL = "SELECT name, page
                 FROM data_startpages		 
                 WHERE active = '1'
                 ORDER BY id";
                $arrRS = mysqli_query($SQLlink, $strSQL);
                while ($arrRow = mysqli_fetch_row($arrRS)) {
                  $rowName = $arrRow[0];
                  $rowPage = $arrRow[1];

                ?>
                  <option value='<? echo $rowPage; ?>' <? if ($rowDefaultStart == $rowPage) {
                    echo "selected";
                  } ?>><? if ($rowDefaultStart == $rowPage) {
                    echo "*";
                  } ?> <? echo $rowName; ?></option>";

                <? } ?>
              </select>
            </div>

              <div class="form-group">
                <h4>Standard Språk: <i class="fas fa-question-circle text-primary jtooltip" title="Här kan du välja vilket språk som ska laddas när du loggar in."></i></h4>
                <select id="select102" class="select2 form-control" name="frmDefaultLang">

                  <?
                  if ($SystemAdmin) { 
                    $strSQL = "SELECT id, name
                    FROM data_languages		 
                    WHERE active = '1'
                    ORDER BY id ASC";
                  } else { 
                    $strSQL = "SELECT id, name
                    FROM data_languages		 
                    WHERE id = '1'
                    ORDER BY id ASC";
                  }
                  $arrRS = mysqli_query($SQLlink, $strSQL);
                  while ($arrRow = mysqli_fetch_row($arrRS)) {
                    $rowLID = $arrRow[0];
                    $rowLName = $arrRow[1];

                  ?>
                    <option value='<? echo $rowLID; ?>' <?  if ($rowDefaultLanguageID == $rowLID) { echo "selected"; } ?>><? if ($rowDefaultLanguageID == $rowLID) { echo "*"; } ?> <? echo $rowLName; ?></option>";
                  
                    <? } ?>
                </select>
              </div>         


              <div class="form-group">
                    <h4>2FA med SMS <a href='#' data-id='2fasms' data-toggle='modal' data-bs-toggle='modal' data-bs-target='#infoModal-2fasms' data-target='#infoModal-2fasms'><i class="fas fa-question-circle text-primary"></i></a></h4>
                    
              <? if ($SystemAdmin) { ?>

                <? if ($rowVerifiedPhone) { ?>
                    <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
                      <input type="checkbox" name="frm2FASMS" class="custom-switch-input" <?php echo $row2FASMS ? 'checked' : ''; ?>>
                      <span class="custom-switch-indicator"></span> <span class="custom-switch-description">Aktiv</span> </label>
                    <br> <br>
                <? } else { ?> 
                    <div class="alert alert-info"><i class="fas fa-info-circle"></i> Du måste verifiera ditt mobilnummer först innan du kan aktivera 2FA med SMS.</div>
                    <input type="hidden" name="frm2FASMS" value="0">
                  <? } ?>

              <? } else { ?>
                    <div class="alert alert-info"><i class="fas fa-info-circle"></i> Denna funktion är under utveckling.</div>
                    <input type="hidden" name="frm2FASMS" value="0">
              <? } ?>
              </div> 


            <? echo $HRB; ?>
            <button type="submit" id="submitBtn" class="<? echo $btnSuccess; ?>"><i class="fas fa-check-circle"></i> Spara</button>
            <? echo $gloAbortButton; ?>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End content -->
<? } ?>