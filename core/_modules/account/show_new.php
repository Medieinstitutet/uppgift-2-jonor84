<?php
$strSQL = "
	SELECT user_fname, user_sname, user_email, user_phone, user_adress1, user_city, user_zip, user_presentation, user_worktitle, defaultcid 
	FROM data_users WHERE id = $gloUID
	LIMIT 1
";
$arrRS   = mysqli_query($SQLlink, $strSQL);
while ($arrRow = mysqli_fetch_row($arrRS)) {
  $rowFName      = $arrRow[0];
  $rowSName      = $arrRow[1];
  $rowEMail      = $arrRow[2];
  $rowPhone      = $arrRow[3];
  $rowAdress      = $arrRow[4];
  $rowCity      = $arrRow[5];
  $rowZip       = $arrRow[6];
  $rowPresentation  = $arrRow[7];
  $rowWorktitle    = $arrRow[8];
  $rowDefaultProfile  = $arrRow[9];

  if ($rowFName == "TMPNAME") {
    $rowFName = "";
  }
}
$gloUserNew = 1;
echo $gloUserNew;
if ($gloUserNew) {
  echo "<div class='$alertError'>$gloWrongAccess dddd</div>";
} else {
?>

  <!-- Begin content -->
  <div class="row d-flex justify-content-center">
    <div class="col-xl-10 col-lg-7 mt-5">

      <div class="card mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Ny användare</h4>
        </div>
        <!-- Card Body -->
        <div class="card-body">

          <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=new">

            <div class="form-group">
              <div class="form-row">
                <div class="col">
                  <label for="inputFirstname">Förnamn:</label>
                  <input type="text" class="form-control" placeholder="Förnamn" name="frmFName" value="<? echo $rowFName; ?>" required>
                </div>
                <div class="col">
                  <label for="inputLastname">Efternamn:</label>
                  <input type="text" class="form-control" placeholder="Efternamn" name="frmSName" value="<? echo $rowSName; ?>" required>
                </div>
              </div>
            </div>
            <hr>
            <div class="form-group">
              <div class="form-row">
                <div class="col">
                  <label for="inputEmail">E-post:</label>
                  <input type="email" class="form-control" placeholder="E-postadress" name="frmEmail" value="<? echo $rowEMail; ?>" readonly>
                  <? echo $gloRegEmailText; ?>
                </div>
                <div class="col">
                  <label for="inputPhone">Telefon:</label>
                  <input type="tel" class="form-control" placeholder="Telefon" id="phone" name="frmPhone" value="<? echo $rowPhone; ?>" required>
                  <small class="text-muted">Gärna ett mobilnummer vi kan skicka viktiga SMS till.</small>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inputFindus">Hur hittade du till Moonserver?</label>
              <textarea class="form-control" style="width: 100%;" placeholder="Skriv gärna hur du hittade Moonserver" name="frmFindus" rows="4" required=""></textarea>
            </div>


            <hr>
            <div style="float:right;"><button type="submit" class="<? echo $btnSuccess; ?>">Spara och fortsätt <i class="fas fa-arrow-circle-right"></i></button></div>
            <? //echo $gloAbortButton; 
            ?>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- End content -->
<? } ?>