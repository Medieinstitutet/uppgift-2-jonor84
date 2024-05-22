<?php
if (!$gloClientAccessTempRPanel) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
	$strSQL = "
		SELECT t1.id, access_name, access_updated, access_active, (SELECT COUNT(t2.id) FROM data_users AS t2 WHERE t1.id=user_access) AS R1   
		FROM data_access AS t1 
		WHERE t1.id < 9 
		ORDER BY t1.id ASC";
	$arrRS = mysqli_query($SQLlink, $strSQL);
	// DEBUG
	//if ($gloAccess==9) { echo "<div class='debug'>".$strSQL."</div>"; }
?>


	<!-- Begin content -->

	<!-- DataTables -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Behörigheter</h4>
		</div>
		<?php
		// IF RS = TRUE THEN PRINT TABLE
		if (mysqli_num_rows($arrRS)) {
		?>

			<div class="card-body">
				<div class="table-responsive">

					<table class="table table-sm table-bordered table-striped display responsive" style="white-space:nowrap; margin-bottom: 0px;" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Nivå</th>
								<th>Namn</th>
								<th>Aktiv</th>
								<th>Uppdaterad</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Nivå</th>
								<th>Namn</th>
								<th>Aktiv</th>
								<th>Uppdaterad</th>
							</tr>
						</tfoot>
						<tbody>
							<?
							// LOOPS RS AND PRINTS TABLE
							while ($arrRow = mysqli_fetch_row($arrRS)) {

								// PUT RS IN VARS
								$rowID		= $arrRow[0];
								$rowName	= (!empty($arrRow[1])) ? $arrRow[1] : $gloNULL;
								$rowUpdated	= date("Y-m-d", $arrRow[2]);
								$rowActive	= ($arrRow[3]) ? "Ja" : "Nej";
								$rowUsers	= $arrRow[4];

								// PRINTS ROW IN TABLE
								echo "
					<tr>
						<td>$rowID</td>
						<td>$rowName</td>
						<td>$rowActive</td>
						<td>$rowUpdated</td>
					</tr>";
							}
							?>
						</tbody>
					</table>
				<? } ?>
				<? echo $HRB; ?>

				<? echo $gloBackButton; ?>

				</div>
			</div>

	</div>
	<!-- End content -->
<? } ?>