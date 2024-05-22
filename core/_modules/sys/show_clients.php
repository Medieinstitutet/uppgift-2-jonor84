<?php
$GETAFID = mysqli_real_escape_string($SQLlink, $_GET['afid']);
if (!$gloClientAccessTempRPanel) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {

	if ($GETAFID) {
		$Titleextra = "hos återförsäljare: " . $GETAFID;
		$strSQL = "
			SELECT t1.id,t1.companyname,t1.contactname,t1.phone,t1.email,t1.active,t1.countryid,t1.town,t1.added,t1.updated,t1.userid,t1.afid,t2.country_name
			FROM data_clients AS t1 
			LEFT JOIN data_countrys AS t2 
			ON countryid = t2.id 
			WHERE afid = $GETAFID
			ORDER BY companyname";
	} else {
		$strSQL = "
			SELECT t1.id,t1.companyname,t1.contactname,t1.phone,t1.email,t1.iemail,t1.active,t1.countryid,t1.town,t1.added,t1.updated,t1.userid,t1.afid,t2.country_name
			FROM data_clients AS t1 
			LEFT JOIN data_countrys AS t2 
			ON countryid = t2.id 
			ORDER BY companyname";
	}

	$arrRS = mysqli_query($SQLlink, $strSQL);

	// DEBUG
	//if ($gloAccess==9) { echo "<div class='debug'>".$strSQL."</div>"; }
?>


	<!-- Begin content -->

	<!-- DataTables -->
	<div class="card shadow mb-4">
		<div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
			<h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Kunder <? echo $Titleextra; ?></h4>
			<div class="dropdown no-arrow">
				<span><a class="btn btn-primary btn-sm" role="button" href="<? echo $gloBaseModule; ?>&show=client_add"><i class="fas fa-plus" title="Skapa kund"></i> Skapa ny kund</a></span>
			</div>
		</div>
		<?php
		// IF RS = TRUE THEN PRINT TABLE
		if (mysqli_num_rows($arrRS)) {
		?>

			<div class="card-body">

				<i class="fas fa-envelope"></i> = E-postadress | <i class="fas fa-envelope-open-text"></i> = Faktura E-postadress

				<hr>
				<div class="table-responsive">

					<table class="table table-sm table-bordered table-striped display responsive" style="white-space:nowrap; margin-bottom: 0px;" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>KundID</th>
								<th>Organisation</th>
								<th>Kontaktperson</th>
								<th>E-post</th>
								<th>Aktiv</th>
								<!-- <th>Land / Stad</th> -->
								<th>Uppdaterad</th>
								<th>Visa</th>
								<th>Åtgärd</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>KundID</th>
								<th>Organisation</th>
								<th>Kontaktperson</th>
								<th>E-post</th>
								<th>Aktiv</th>
								<!-- <th>Land / Stad</th> -->
								<th>Uppdaterad</th>
								<th>Visa</th>
								<th>Åtgärd</th>
							</tr>
						</tfoot>
						<tbody>
							<?
							// LOOPS RS AND PRINTS TABLE
							while ($arrRow = mysqli_fetch_row($arrRS)) {

								// PUT RS IN VARS
								$rowID			= $arrRow[0];
								$rowCompany		= $arrRow[1];
								$rowContact		= $arrRow[2];
								$rowPhone		= $arrRow[3];
								$rowEmail		= $arrRow[4];
								$rowIEmail		= $arrRow[5];
								$rowActive		= ($arrRow[6]) ? "Ja" : "Nej";
								$rowCountryID		= $arrRow[7];
								$rowTown 		= $arrRow[8];
								$rowDateAdded		= date('Y-m-d H:i', $arrRow[9]);
								$rowDateUpdated		= date('Y-m-d H:i', $arrRow[10]);
								$rowUserID		= $arrRow[11];
								$rowAFID		= $arrRow[12];
								$rowCountryName		= $arrRow[13];

								if (!$rowIEmail) {
									$rowIEmail = $rowEmail;
								}

								// PRINTS ROW IN TABLE
								echo "
					<tr>
					 <td>$rowID</td>
					 <td><a href='$gloBaseModule&show=client_edit&id=$rowID' title='Ändra'>$rowCompany</a></td>
					 <td>$rowContact</td>
					 <td><a href='mailto:$rowEmail'><i class='fas fa-envelope jtooltip' title='Meddelanden: $rowEmail'></i></a> |  
					     <a href='mailto:$rowIEmail'><i class='fas fa-envelope-open-text jtooltip' title='Fakturor: $rowIEmail'></i></a>
				     </td>
				 	 <td>$rowActive</td>
					 <td>$rowDateUpdated</td>
					 <td>
						<a href='$gloBaseModule&show=users&clientid=$rowID' title='Visa Kunds Användarkonton'><i class='fas fa-users-cog jtooltip' title='Visa Kunds Användarkonton'></i></a> | 
						<a href='/showprofile&r=$rowAFID' title='Visa ÅFprofil'><i class='far fa-address-card jtooltip' title='Visa Leverantör ($rowAFID)'></i></a> | 
						<a href='/showprofile&c=$rowID' title='Visa Kundprofil'><i class='fas fa-user-tie jtooltip' title='Visa Kund ($rowID)'></i></a>
					 </td>
					 <td><a href='$gloBaseModule&show=client_edit&id=$rowID'><i class='far fa-edit jtooltip' title='Ändra'></i></a> 
					 <!--<a href='#' data-id='$rowID' data-toggle='modal' data-target='#delModal-$rowID'><i class='far fa-trash-alt jtooltip' title='Radera'></i></a></td>-->

    					  <!-- CONFIRM DELETE Modal-->
    					  <div class='modal fade' id='delModal-$rowID' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        				   <div class='modal-dialog' role='document'>
            				    <div class='modal-content'>
                			   	<div class='modal-header'>
                    					 <h4 class='modal-title' id='exampleModalLabel'>Är du säker på att du vill ta bort?</h4>
                    					 <a class='close' type='button' data-dismiss='modal' aria-label='Close'>
                        				 <span aria-hidden='true'>×</span>
                    					</a>
                			   	</div>
                				<div class='modal-body'>ID: $rowID / Företag: $rowCompany</div>
                			 		<div class='modal-footer'>
		    					 <a class='btn btn-primary' href='$gloBaseModule&task=user_delete&id=$rowID'><i class='fas fa-check-circle'></i> Ja</a>
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

<!-- <td>$rowCountryName / $rowTown</td> -->