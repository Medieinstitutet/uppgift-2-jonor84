<?php
// *** ***********************
// *** MODULE: 	SHOWPROFILE -> Userlog OLD
// *** ***********************
// CHECK ACCESS	
if (!$SUBPAGEUACCESS) {
	echo "<div class='$alertError'>$gloWrongAccess2</div>";
} else {

		$strSQL = "
			SELECT log_event, log_notes, INET_NTOA(log_ip), log_date, id  
			FROM log_admin 
			WHERE user_id = '" . $gloUID . "' 
			ORDER BY id DESC
			";
		$arrRS = mysqli_query($SQLlink, $strSQL);

?>

<!-- Begin content -->


<!-- DataTables -->
<div class="card mb-4">
    <div class="card-body">
        <h3>Aktivitetslogg (Gamla)</h3>
        <? echo $HR0; ?>
        <div class="mt-4">

            <?php
					// IF RS = TRUE THEN PRINT TABLE
					if (!mysqli_num_rows($arrRS)) {
						echo "<div class='$alertInfo'>$gloEmpty</div>";
					} else {
					?>


            <div class="table-responsive">

                <table class="table table-sm table-striped table-bordered display responsive"
                    style="margin-bottom: 0px;" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Händelse</th>
                            <th>IP-nummer</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Datum</th>
                            <th>Händelse</th>
                            <th>IP-nummer</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?
									// LOOPS RS AND PRINTS TABLE
									while ($arrRow = mysqli_fetch_row($arrRS)) {

										// PUT RS IN VARS
										$rowEvent	= $arrRow[0];
										$rowNotes	= $arrRow[1];
										$rowIP		= !empty($arrRow[2]) ? $arrRow[2] : $gloNULL;
										$rowDate	= !empty($arrRow[3]) ? date("Y-m-d", $arrRow[3]) : $gloNULL;
										$rowTime	= !empty($arrRow[3]) ? date("H:i", $arrRow[3]) : $gloNULL;

										// Assuming $arrRow[3] contains a date string in the format 'YYYY-MM-DD HH:MM:SS'
										// $rowDate = !empty($arrRow[3]) ? date("Y-m-d", strtotime($arrRow[3])) : $gloNULL;
										// $rowTime = !empty($arrRow[3]) ? date("H:i", strtotime($arrRow[3])) : $gloNULL;

										$rowDateTime = $rowDate . " " . $rowTime;

										$rowID		= $arrRow[4];

										// PRINTS ROW IN TABLE
										echo "
											<tr>
											<td>$rowDateTime</td>
											<td>$rowNotes</td>
											<td>$rowIP</td>
											</tr>
										";
									}
									?>
                    </tbody>
                </table>
                <? } ?>
            </div>
        </div>

    </div>
    <!-- End content -->
</div>
<?
}
?>