<?php
// *** ***********************
// *** MODULE: 	Account -> Messagehistory
// *** ***********************
// CHECK ACCESS	
if (!$SUBPAGEUACCESS) {
	echo "<div class='$alertError'>$gloWrongAccess2</div>";
} else {

	$strSQL = "
		SELECT id, type, message, subject, receiver, INET_NTOA(ip), date  
		FROM data_sentmessages 
		WHERE uid = '" . $gloUID . "' 
        AND cid = 0
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
			<h4>Meddelandehistorik</h4>
			<? echo $HR0; ?>
			<div class="mt-4">

				<div class="table-responsive">
					<table class="table table-sm table-striped table-bordered display responsive" style="margin-bottom: 0px;" id="dataTable2" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Datum</th>
								<th>Typ</th>
								<th>Meddelande</th>
								<th>Mottagare</th>
								<th>IP-nummer</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Datum</th>
								<th>Typ</th>
								<th>Meddelande</th>
								<th>Mottagare</th>
								<th>IP-nummer</th>
							</tr>
						</tfoot>
						<tbody>
							<?
							// LOOPS RS AND PRINTS TABLE
							while ($arrRow = mysqli_fetch_row($arrRS)) {

								// PUT RS IN VARS
								$rowID		= $arrRow[0];
								$rowType	= $arrRow[1];
								$rowMessage	= trim($arrRow[2]);
								$rowSubject	= $arrRow[3];
								$rowReceiver = $arrRow[4];
								$rowIP		= !empty($arrRow[5]) ? $arrRow[5] : $gloNULL;
								$rowDate = formatDate($arrRow[6]);

								if ($rowType == 'email') {
									$TypeIcon = "<i class='fas fa-at jtooltip' title='E-post'></i>";
								} elseif ($rowType == 'sms') {
									$TypeIcon = "<i class='fas fa-sms jtooltip' title='SMS'></i>";
								}

								// PRINTS ROW IN TABLE
								echo "
							<tr>
								<td>$rowDate</td>
                                <td>$TypeIcon</td>
                                <td>$rowSubject <a href='#' data-id='$rowID' data-bs-toggle='modal' data-bs-target='#Modal-$rowID'><i class='fas fa-comment-alt jtooltip' title='Läs meddelande'></i></a></td>
                                <td>$rowReceiver</td>
								<td>$rowIP</td>

                                <!-- CONFIRM DELETE Modal-->
                                <div class='modal fade' id='Modal-$rowID' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h4 class='modal-title'>$rowSubject</h4>
                                                <a class='close btn btn-light' data-bs-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>×</span>
                                                </a>
                                            </div>
                                            <div class='modal-body'>$rowMessage</div>
                                            <div class='modal-footer'>
                                                <button class='btn btn-light' type='button' data-bs-dismiss='modal' data-dismiss='modal'><i class='fas fa-times-circle text-dark' aria-hidden='true'></i> Avbryt</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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