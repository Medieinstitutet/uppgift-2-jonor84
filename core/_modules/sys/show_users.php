<?php
$GETAFID = mysqli_real_escape_string($SQLlink, $_GET['afid']);
$GETCLIENTID = mysqli_real_escape_string($SQLlink, $_GET['clientid']);

if (!$gloClientAccessTempRPanel) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
	if ($GETAFID) {
		$Titleextra = "(Not finished) hos återförsäljare: " . $GETAFID;
		$Type = "Reseller";
		$strSQL = "
		 SELECT t1.id,user_fname,user_sname,user_email,user_access,user_active,login_tries,group_id,client_id,access_name
		 FROM data_users AS t1 
		 LEFT JOIN data_access AS t2 
		 ON user_access = t2.id 
		 WHERE group_id = '$GETAFID' AND user_access < $gloAccess 
		 ORDER BY user_email DESC";
	} else if ($GETCLIENTID) {
		$Titleextra = " hos kund: " . $GETCLIENTID;
		$Type = "Client";
		$strSQL = "
		 SELECT 
			t1.id,t1.added, t1.updated, t1.active, t1.accepted, t1.activebingo, t1.activesites, t1.bingosid, t1.sitesid,
			t2.id,t2.user_fname,t2.user_sname,t2.user_email,t2.user_access,t2.user_active,t2.login_tries,t2.group_id,t2.client_id,
		  	t3.access_name
		 FROM data_clients_access AS t1 
		 LEFT JOIN data_users AS t2 
		 ON t1.uid = t2.id 
		 LEFT JOIN data_access AS t3 
		 ON t1.aid = t3.id 
		 WHERE t1.cid = '$GETCLIENTID'
		 ORDER BY t2.user_email DESC";
	} else {
		$Type = "Users";
		$strSQL = "
		 SELECT t1.id,user_fname,user_sname,user_email,user_access,user_active,login_tries,group_id,client_id,access_name
		 FROM data_users AS t1 
		 LEFT JOIN data_access AS t2 
		 ON user_access = t2.id 
		 WHERE user_access < $gloAccess 
		 ORDER BY user_email DESC";
	}


	$arrRS = mysqli_query($SQLlink, $strSQL);
	// DEBUG
	//if ($gloAccess==9) { echo "<div class='debug'>".$strSQL."</div>"; }
?>

	<!-- Begin content -->

	<!-- DataTables -->
	<div class="card shadow mb-4">
		<div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
			<h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Användare <? echo $Titleextra; ?></h4>
			<div class="dropdown no-arrow">
				<span>
					<a class="btn btn-primary btn-sm" role="button" href="<? echo $gloBaseModule; ?>&show=user_access"><i class="fas fa-user-shield" title="Användarbehörigheter"></i> Användarbehörigheter</a>
					<a class="btn btn-primary btn-sm" role="button" href="<? echo $gloBaseModule; ?>&show=user_add"><i class="fas fa-plus" title="Skapa användare"></i> Skapa användare</a>
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
								<th>E-post</th>
								<th>Behörighet</th>
								<th>Aktiv</th>
								<th>Genvägar</th>
								<th>Åtgärd</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>E-post</th>
								<th>Behörighet</th>
								<th>Aktiv</th>
								<th>Genvägar</th>
								<th>Åtgärd</th>
							</tr>
						</tfoot>
						<tbody>
							<?
							// LOOPS RS AND PRINTS TABLE
							while ($arrRow = mysqli_fetch_row($arrRS)) {

								// PUT RS IN VARS
								if ($Type == "Reseller") {
									//reseller not ready
								} elseif ($Type == "Client") {
									$rowID = $arrRow[0]; // Access ID t1.id
									$rowActive = ($arrRow[1]) ? "Ja" : "Nej"; // t1.active
									$rowTries = $arrRow[2]; // t1.updated
									$rowAFID = $arrRow[3]; // t1.active
									$rowAccepted = $arrRow[4]; // t1.accepted
									$rowActiveBingo = $arrRow[5]; // t1.activebingo
									$rowActiveSite = $arrRow[6]; // t1.activesites
									$rowBingosID = $arrRow[7]; // t1.bingosid
									$rowSitesID = $arrRow[8]; // t1.sitesid

									$rowUID = $arrRow[9]; // User ID t2.id
									$rowName = $arrRow[10] . " " . $arrRow[11]; // t2.user_fname t2.user_sname
									$rowEmail = $arrRow[12]; // t2.user_email
									$rowActive = ($arrRow[13]) ? "Ja" : "Nej"; // t2.user_active
									$rowTries = $arrRow[14]; // t2.login_tries
									$rowAFID = $arrRow[15]; // t2.group_id
									$rowClientID = $arrRow[16]; // t2.client_id
									$rowAccessName = $arrRow[17]; // t3.access_name

								} elseif ($Type == "Users") {
									$rowUID = $arrRow[0];
									$rowName = $arrRow[1] . " " . $arrRow[2];
									$rowEmail = $arrRow[3];
									$rowActive = ($arrRow[5]) ? "Ja" : "Nej";
									$rowTries = $arrRow[6];
									$rowAFID = $arrRow[7];
									$rowClientID = $arrRow[8];
									$rowAccessName = $arrRow[9];
								}

								// PRINTS ROW IN TABLE
								echo "
					<tr>
					 <td>$rowUID</td>
					 <td><a href='$gloBaseModule&show=user_edit&id=$rowUID' title='&Auml;ndra'>$rowEmail $showLocked</a> 
					 <a href='#' data-id='$rowUID' data-bs-toggle='modal' data-bs-target='#switchModal-$rowUID'><i class='fas fa-sign-in-alt' style='float:right;'></i></a></td>
                <!-- Switch USER Modal-->
                <div class='modal fade' id='switchModal-$rowUID' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                                      <form method='post' class='form-horizontal' action='/account&task=user_switch'>
                                          <input type='hidden' name='frmToUID' value='$rowUID'>

                            <div class='modal-header'>
                                <h4 class='modal-title' id='exampleModalLabel'>Vill du byta användare?</h4>
								<a class='close btn btn-light' data-bs-dismiss='modal' aria-label='Close'>
								<span aria-hidden='true'>×</span>
							   </a>
                            </div>
                        <div class='modal-body'>
                                <p>Byt till: <b>$rowName ($rowUID)</b> </p>

                            <div class='modal-footer'>
                                      <button type='submit' class='$btnSuccess'><i class='fas fa-check-circle'></i> Ja</button>
									  $gloModalAbortButton

                            </div>
                                    </form>
                        </div>
                    </div>
                </div><!-- Switch USER Modal-->
           <td>$rowAccessName</td>
				 	 <td>$rowActive</td>
					 <td>
						<a href='showprofile&r=$rowAFID' title='Visa ÅFprofil'><i class='fas fa-user-tag jtooltip' title='Visa leverantör ($rowAFID)'></i></a>  | 
						<a href='showprofile&u=$rowUID'><i class='far fa-address-card jtooltip' title='Visa Användarprofil'></i></i></a>
					 </td>
					 <!--<td><a href='?module=workplace&WID=$rowWID'>$rowWID</title></td>-->
					 <td>
					  <a href='$gloBaseModule&show=user_edit&id=$rowUID'><i class='far fa-edit jtooltip' title='Ändra'></i></a> | 
					  <a href='$gloBaseModule&show=user_access&id=$rowUID'><i class='fas fa-user-shield jtooltip' title='Ändra Behörigheter'></i></a> | 
					  <a href='#' data-id='$rowUID' data-bs-toggle='modal' data-bs-target='#delModal-$rowUID'><i class='far fa-trash-alt jtooltip' title='Radera'></i></a></td>

    					  <!-- CONFIRM DELETE Modal-->
    					  <div class='modal fade' id='delModal-$rowUID' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        				   <div class='modal-dialog' role='document'>
            				    <div class='modal-content'>
                			   	<div class='modal-header'>
                    					 <h4 class='modal-title' id='exampleModalLabel'>Är du säker på att du vill ta bort?</h4>
                    					 <a class='close btn btn-light' data-bs-dismiss='modal' aria-label='Close'>
                        				 <span aria-hidden='true'>×</span>
                    					</a>
                			   	</div>
                				<div class='modal-body'>ID: $rowUID / E-post: $rowEmail</div>
                			 		<div class='modal-footer'>
		    					 <a class='btn btn-primary' href='$gloBaseModule&task=user_delete&id=$rowUID'><i class='fas fa-check-circle'></i> Ja</a>
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
<!-- <a href='showprofile&c=$rowClientID' title='Visa Kundprofil'><i class='fas fa-user' title='Visa Kundprofil'></i>($rowClientID)</a>  |  -->