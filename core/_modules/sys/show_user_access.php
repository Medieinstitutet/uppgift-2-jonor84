<?php
$GETUID = mysqli_real_escape_string($SQLlink, $_GET['id']);
$GETCID = mysqli_real_escape_string($SQLlink, $_GET['cid']);

if ($gloAccess < 7) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
	if ($GETUID) {
		$TITLEEXTRA = ": (" . $GETUID . ") " . UserEmail($GETUID);
		$strSQL = "
		 SELECT 
			t1.id,t1.added, t1.updated, t1.active, t1.accepted, t1.activebingo, t1.activesites, t1.bingosid, t1.sitesid, t1.aid, t1.cid,
			t2.id,t2.user_fname,t2.user_sname,t2.user_email,t2.user_access,t2.user_active,
			t3.access_name,
			t4.companyname
		 FROM data_clients_access AS t1 
		 LEFT JOIN data_users AS t2 
		 ON t1.uid = t2.id 
		 LEFT JOIN data_access AS t3 
		 ON t1.aid = t3.id 
		 LEFT JOIN data_clients AS t4 
		 ON t1.cid = t4.id 
		 WHERE t1.uid = '$GETUID'
		 ORDER BY t2.user_email DESC";
	} else if ($GETCID) {
		$TITLEEXTRA = ": (" . $GETCID . ") " . CompanyName($GETCID);
		$strSQL = "
			 SELECT 
				t1.id,t1.added, t1.updated, t1.active, t1.accepted, t1.activebingo, t1.activesites, t1.bingosid, t1.sitesid, t1.aid, t1.cid,
				t2.id,t2.user_fname,t2.user_sname,t2.user_email,t2.user_access,t2.user_active,
				t3.access_name,
				t4.companyname
			 FROM data_clients_access AS t1 
			 LEFT JOIN data_users AS t2 
			 ON t1.uid = t2.id 
			 LEFT JOIN data_access AS t3 
			 ON t1.aid = t3.id 
			 LEFT JOIN data_clients AS t4 
			 ON t1.cid = t4.id 
			 WHERE t1.cid = '$GETCID'
			 ORDER BY t2.user_email DESC";
	} else {
		$TITLEEXTRA = "";
		$strSQL = "
			 SELECT 
				t1.id,t1.added, t1.updated, t1.active, t1.accepted, t1.activebingo, t1.activesites, t1.bingosid, t1.sitesid, t1.aid, t1.cid,
				t2.id,t2.user_fname,t2.user_sname,t2.user_email,t2.user_access,t2.user_active,
				t3.access_name,
				t4.companyname
			 FROM data_clients_access AS t1 
			 LEFT JOIN data_users AS t2 
			 ON t1.uid = t2.id 
			 LEFT JOIN data_access AS t3 
			 ON t1.aid = t3.id 
			 LEFT JOIN data_clients AS t4 
			 ON t1.cid = t4.id 
			 WHERE t1.uid != '2'
			 ORDER BY t2.user_email DESC";
	}
	$arrRS = mysqli_query($SQLlink, $strSQL);
	// DEBUG
	//if ($gloAccess==9) { echo "<div class='debug'>".$strSQL."</div>"; }
?>

	<!-- Begin content -->

	<!-- DataTables -->
	<div class="card shadow mb-4">
		<div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
			<h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Behörigheter på användare<? echo $TITLEEXTRA; ?></h4>
			<div class="dropdown no-arrow"> 
				<span>
					<a class="btn btn-primary btn-sm" role="button" href="<? echo $gloBaseModule; ?>&show=users"><i class="fas fa-user" title="Användare"></i> Användare</a>
					<a class="btn btn-primary btn-sm" role="button" href="<? echo $gloBaseModule; ?>&show=user_access_add"><i class="fas fa-plus" title="Lägg till behörighet"></i> Lägg till behörighet</a>
				</span> 
			</div>
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
								<th>Användare</th>
								<th>Profil</th>
								<th>Behörighet</th>
								<th>Aktiv</th>
								<!-- <th>Inlagd</th> -->
								<th>Uppdaterad</th>
								<th>Åtgärd</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Användare</th>
								<th>Profil</th>
								<th>Behörighet</th>
								<th>Aktiv</th>
								<!-- <th>Inlagd</th> -->
								<th>Uppdaterad</th>
								<th>Åtgärd</th>
							</tr>
						</tfoot>
						<tbody>
							<?
							// LOOPS RS AND PRINTS TABLE
							while ($arrRow = mysqli_fetch_row($arrRS)) {

								// PUT RS IN VARS
								$rowID = $arrRow[0]; // Access ID t1.id
								$rowAdded = date('Y-m-d H:i', $arrRow[1]); //  t1.added
								$rowUpdated = date('Y-m-d H:i', $arrRow[2]); // t1.updated

								$rowActive = ($arrRow[3]) ? "Ja" : "Nej"; // t1.active
								$rowAccepted = $arrRow[4]; // t1.accepted
								$rowActiveBingo = $arrRow[5]; // t1.activebingo
								$rowActiveSite = $arrRow[6]; // t1.activesites
								$rowBingosID = $arrRow[7]; // t1.bingosid
								$rowSitesID = $arrRow[8]; // t1.sitesid
								$rowAccessID = $arrRow[9]; // t1.aid
								$rowClientID = $arrRow[10]; // t1.cid

								$rowUID = $arrRow[11]; // User ID t2.id
								$rowName = $arrRow[12] . " " . $arrRow[13]; // t2.user_fname t2.user_sname
								$rowEmail = $arrRow[14]; // t2.user_email
								$rowUAccess = $arrRow[15]; // t2.user_access
								$rowUActive = ($arrRow[16]) ? "Ja" : "Nej"; // t2.user_active

								$rowAccessName = $arrRow[17]; // t3.access_name
								$rowCompanyName = $arrRow[18]; // t4.companyname

								// PRINTS ROW IN TABLE
								echo "
					<tr>
					 <td>$rowID</td>
					 <td>$rowEmail ($rowName)</td>
					 <td>$rowCompanyName</td>
           			 <td>($rowAccessID) $rowAccessName</td>
				 	 <td>$rowActive</td>

				 	 <td>$rowUpdated</td>
					 <td>
					  <a href='$gloBaseModule&show=user_access_edit&id=$rowID'><i class='far fa-edit' title='Ändra'></i></a> | 
					  <a href='#' data-id='$rowID' data-bs-toggle='modal' data-bs-target='#delModal-$rowID'><i class='far fa-trash-alt' title='Radera'></i></a></td>

    					  <!-- CONFIRM DELETE Modal-->
    					  <div class='modal fade' id='delModal-$rowID' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        				   <div class='modal-dialog' role='document'>
            				    <div class='modal-content'>
                			   	<div class='modal-header'>
                    					 <h4 class='modal-title' id='exampleModalLabel'>Är du säker på att du vill ta bort?</h4>
                    					 <a class='close btn btn-light' data-bs-dismiss='modal' aria-label='Close'>
                        				 <span aria-hidden='true'>×</span>
                    					</a>
                			   	</div>
                				<div class='modal-body'>ID: $rowUID / E-post: $rowEmail / Access: $rowAccessName / Profil: $rowCompanyName</div>
                			 		<div class='modal-footer'>
		    					 <a class='btn btn-primary' href='$gloBaseModule&task=user_access_delete&id=$rowID'><i class='fas fa-check-circle'></i> Ja</a>
								 $gloModalAbortButton

                			 		</div>
            				    </div>
        				    </div>
   					       </div>

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