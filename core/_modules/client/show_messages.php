<?php
if ($gloUserNew || $gloUserNewClient) {
  echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {

  $strSQL = "
	SELECT t1.id, 
     t1.fromuid, t1.touid, t1.header, t1.message, t1.opened, t1.openeddate, t1.date,
     t2.user_fname, t2.user_sname, t2.user_email
	FROM data_messages as t1
    LEFT JOIN data_users AS t2 
	ON t1.fromuid = t2.id
	WHERE t1.touid = '" . $gloUID . "' 
	ORDER BY date DESC";
  $arrRS = mysqli_query($SQLlink, $strSQL);


  // DEBUG
  //if ($gloAccess==9) { echo "<div class='debug'>".$strSQL."</div>"; }

?>
  <!-- Begin content -->

  <!-- DataTables -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold brand-title">Mina Meddelanden</h3>
    </div>
    <div class="card-body">

      <?php
      // IF RS = TRUE THEN PRINT TABLE
      if (!mysqli_num_rows($arrRS)) {
        echo "<div class='$alertInfo'>$gloEmpty</div>";
      } else {
      ?>
        <div class="table-responsive">
          <table class="table table-sm table-striped table-bordered display responsive" style="margin-bottom: 0px;" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Från</th>
                <th>Ärende</th>
                <th>Status</th>
                <th>Datum</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Från</th>
                <th>Ärende</th>
                <th>Status</th>
                <th>Datum</th>
              </tr>
            </tfoot>
            <tbody>
              <?
              // LOOPS RS AND PRINTS TABLE
              while ($arrRow = mysqli_fetch_row($arrRS)) {

                // PUT RS IN VARS
                $MessID = $arrRow[0]; // id

                $MessFromUID = $arrRow[1]; // fromuid
                $MessToUID = $arrRow[2]; // touid
                $MessHeader = $arrRow[3]; // header
                $MessMessage = $arrRow[4]; // message
                $MessOpen = !empty($arrRow[5]) ? Läst : "<i class='fa fa-exclamation-circle text-danger'></i> Ny"; // opened
                $MessOpen1 = $arrRow[5]; // opened

                $MessOpenDate = !empty($arrRow[6]) ? date("Y-m-d", $arrRow[6]) : $gloNULL; // openeddate              
                $MessDate = !empty($arrRow[7]) ? date("Y-m-d H:i", $arrRow[7]) : $gloNULL; // date

                //USER DATA
                $UserFName = $arrRow[8]; // user_fname
                $UserSName = $arrRow[9]; // user_sname
                $UserEmail = $arrRow[10]; // user_email

                if ($MessFromUID == 0) {
                  $UserFullname = "System";
                  $UserEmail = "";
                } else {
                  $UserFullname = $UserFName . " " . $UserSName;
                  $UserEmail = "(" . $UserEmail . ")";
                }

                if ($MessOpen1 == 1) {
                  $MHeader = $MessHeader;
                } else {
                  $MHeader = "<b>" . $MessHeader . "</b>";
                }
                // PRINTS ROW IN TABLE
                echo "
					<tr>
					<td>$UserFullname $UserEmail</td>
					<td><a href='/account&show=message&id=$MessID'>$MHeader</a></td>
					<td>$MessOpen</td>
					<td>$MessDate</td>
					</tr>";
              }
              ?><? } ?>
            </tbody>
          </table>

        </div>
    </div>

  </div>
  <!-- End content -->
<? } ?>