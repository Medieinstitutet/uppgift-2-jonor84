<?php
if (!$gloClientAccessTempRPanel) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
	$strSQL = "
		SELECT id, country_name, country_name_en, active, regactive, updated  
		FROM data_countrys
		ORDER BY id ASC";
	$arrRS = mysqli_query($SQLlink, $strSQL);
	// DEBUG
	//if ($gloAccess==9) { echo "<div class='debug'>".$strSQL."</div>"; }
?>


	<!-- Begin content -->

	<!-- DataTables -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Länder</h4>
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
								<th>ID</th>
								<th>Namn</th>
								<th>Aktiv / Registrering</th>
								<th>Uppdaterad</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Namn</th>
								<th>Aktiv / Registrering</th>
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
								$rowNameEN	= (!empty($arrRow[2])) ? $arrRow[2] : $gloNULL;
								$rowActive = ($arrRow[3]) ? "<i class='fas fa-check-circle text-success jtooltip' title='Landet är aktivt'></i> Ja" : "<i class='fas fa-times-circle text-dark jtooltip' title='Landet är inaktivt'></i> Nej"; // t1.active
								$rowRegActive = ($arrRow[4]) ? "<i class='fas fa-check-circle text-success jtooltip' title='Landet är aktivt'></i> Ja" : "<i class='fas fa-times-circle text-dark jtooltip' title='Landet är inaktivt'></i> Nej"; // t1.active
								$rowUpdated	= $arrRow[5];

								// PRINTS ROW IN TABLE
								echo "
					<tr>
						<td>$rowID</td>
						<td>$rowName</td>
						<td>$rowActive / $rowRegActive</td>
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