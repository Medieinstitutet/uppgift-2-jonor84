<?php
// *** ***********************
// *** MODULE: 	Account -> Userlog new
// *** ***********************
// CHECK ACCESS	
if (!$SUBPAGEUACCESS) {
	echo "<div class='$alertError'>$gloWrongAccess2</div>";
} else {

	$strSQL = "
		SELECT event, notes, INET_NTOA(ip), date, id  
		FROM data_activities 
		WHERE uid = '" . $gloUID . "' 
		ORDER BY id DESC
		";
	$arrRS = mysqli_query($SQLlink, $strSQL);

	// DEBUG
	//if ($gloAccess==9) { echo "<div class='debug'>".$strSQL."</div>"; }

	if ($gloBANKID == 0) {
		if ($gloTempPass == "Y") {
			header("location: editaccount&show=passwordnew");
		}
	}

	if ($gloUserNew || $gloUserNewClient) {
		echo "<div class='$alertError'>$gloWrongAccess</div>";
	} else {
?>

		<!-- Begin content -->

		<!-- DataTables -->

		<?php
		// IF RS = TRUE THEN PRINT TABLE
		if (!mysqli_num_rows($arrRS)) {
			echo "<div class='$alertInfo'>$gloEmpty</div>";
		} else {
		?>
			<h4>Nya loggen</h4>
			<? echo $HR0; ?>
			<div class="mt-4">

				<div class="table-responsive">
					<table class="table table-sm table-striped table-bordered display responsive" style="margin-bottom: 0px;" id="dataTable" width="100%" cellspacing="0">
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
								$rowDate = formatDate($arrRow[3]);
								$rowID		= $arrRow[4];

								// PRINTS ROW IN TABLE
								echo "
							<tr>
								<td>$rowDate</td>
								<td>$rowNotes</td>
								<td>$rowIP</td>
							</tr>
							";
							} ?>
						</tbody>
					</table>
				</div>

			</div>
		<? } ?>


		<!-- End content -->
<? }
} ?>