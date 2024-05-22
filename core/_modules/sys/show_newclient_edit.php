<?php
if ($gloAccess < 7) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
	$CID = intval($_GET['id']);



	$strSQL = "
		SELECT 	
         id,
         companyname,contactname,phone,email,active,
		 countryid,town,added,updated,website,
         companyid,paddress,pzip,ptown,iaddress,
         izip,itown,vatid,typeid, orgemail, orgiemail, orgnew, orgadmin
		FROM data_clients 
		WHERE id = '$CID'
		LIMIT 1";

	$arrRS = mysqli_query($SQLlink, $strSQL);

	while ($arrRow = mysqli_fetch_row($arrRS)) {
		$rowID				= $arrRow[0];

		$rowCompany			= $arrRow[1];
		$rowContact			= $arrRow[2];
		$rowPhone			= $arrRow[3];
		$rowEmail 			= $arrRow[4];
		$rowActive 			= $arrRow[5];

		$rowCountryID		= $arrRow[6];
		$rowHQCity			= $arrRow[7];
		$rowAdded			= $arrRow[8];
		$rowUpdated			= $arrRow[9];
		$rowWebsite			= $arrRow[10];

		$rowCompanyID		= $arrRow[11];
		$rowPostA			= $arrRow[12];
		$rowPostAZip		= $arrRow[13];
		$rowPostATown		= $arrRow[14];
		$rowInvoiceA		= $arrRow[15];

		$rowInvoiceAZip		= $arrRow[16];
		$rowInvoiceATown	= $arrRow[17];
		$rowVATID	        = $arrRow[18];
		$rowTypeID	        = $arrRow[19];

		$rowORGEMAIL	    = $arrRow[20];
		$rowORGIEMAIL	    = $arrRow[21];
		$rowORGNEW	        = $arrRow[22];
		$rowORGADMINID      = $arrRow[23];
	}

	
	if (!$rowORGNEW) { 
		echo "<div class='$alertInfo text-dark'><h4><i class='fas fa-info-circle'></i> Denna kundprofil är redan aktiv.</h4> $gloBackButton</div>";
	   
	  } else { 
?>

	<!-- Begin content -->
	<div class="row">
		<div class="col-xl-8 col-md-6 mb-4">

			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Organisationsuppgifter</h4>
				</div>
				<!-- Card Body -->
				<div class="card-body">

					<form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=newclient_edit">
						<input type="hidden" name="frmCLIENTID" value="<? echo $CID; ?>">
						<input type="hidden" name="frmOrgAdminID" value="<? echo $rowORGADMINID; ?>">

						<div class="form-group">
							<label for="inputStandard" class="control-label">Organisationsform:</label>
							<select id="select100" class="select2 form-control" name="frmOrgType">
								<? $strSQL = "SELECT id,se_type FROM data_clienttypes WHERE active = '1' ORDER BY id ASC";
								$arrRS = mysqli_query($SQLlink, $strSQL);
								while ($arrRow = mysqli_fetch_row($arrRS)) {
									$rowID 		= $arrRow[0];
									$rowName 	= $arrRow[1];

									if ($rowTypeID == $rowID) {
										echo "<option value='$rowID' selected>* ($rowID) $rowName</option>";
									}
									echo "<option value='$rowID'>($rowID) $rowName</option>";
								} ?>
							</select>
						</div>

						<div class="form-group">
							<label for="inputStandard" class="control-label">Organisationsnamn: *</label>
							<input type="text" id="inputStandard" class="form-control" name="frmCompany" value="<? echo $rowCompany; ?>" required>
						</div>

						<div class="form-group">
							<label for="inputStandard" class="control-label">Person/Organisationsnr: *</label>
							<input type="text" id="inputStandard" class="form-control" name="frmCompanyID" value="<? echo $rowCompanyID; ?>" required>
						</div>

						<div class="form-group">
							<label for="inputStandard" class="control-label">VATID: </label>
							<input type="text" id="inputStandard" class="form-control" name="frmVATID" value="<? echo $rowVATID; ?>">
							<small>Momsregistreringsnummer i Sverige. För organisationer med moms verksamhet.</small>
						</div>
						<div class="form-group">
							<label for="inputStandard" class="control-label">Kontaktperson till <? echo $gloName; ?>: *</label>

							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">Namn: </span>
								</div>
								<input type="text" placeholder="Anna Andersson" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmContact" value="<? echo $rowContact; ?>" required>
							</div>
							<small id="phoneHelp" class="form-text text-muted">Exempel: 070-0000000</small>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">Telefon:</span>
								</div>
								<input type="tel" placeholder="070-0000000" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmPhone" value="<? echo $rowPhone; ?>" required>
							</div>
							<small id="emailHelp" class="form-text text-muted">Exempel: namn@exempel.se</small>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">E-post: </span>
								</div>
								<input type="email" placeholder="namn@exempel.se" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmEmail" value="<? echo $rowEmail; ?>" required>
							</div>
						</div>

						<div class="form-group">
							<label for="inputStandard" class="control-label">Hemsida:</label>
							<small id="websiteHelp" class="form-text text-muted">(Om du inte har en hemsida, tipsar vi om <a href="https://moonserver.site/se" target="_blank">Moonserver.site</a>)</small>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">https://</span>
								</div>
								<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmWebsite" value="<? echo $rowWebsite; ?>">
							</div>
						</div>

						<hr>
						<div class="form-group">
							<label for="inputAddress2">Postaddress: *</label>
							<input type="text" class="form-control" placeholder="Testvägen 1" name="frmInvoiceA" value="<? echo $rowInvoiceA; ?>" required>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="inputZip">Postnr: *</label>
								<input type="text" class="form-control" placeholder="12345" name="frmInvoiceAZip" value="<? echo $rowInvoiceAZip; ?>" required>
							</div>
							<div class="form-group col-md-9">
								<label for="inputCity">Ort: *</label>
								<input type="text" class="form-control" placeholder="Ort" name="frmInvoiceATown" value="<? echo $rowInvoiceATown; ?>" required>
							</div>
						</div>

						<hr>

						<div class="form-group">
							<label for="inputAddress2">Fakturaaddress: *</label>
							<input type="text" class="form-control" placeholder="Testvägen 2" name="frmPostA" value="<? echo $rowPostA; ?>" required>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="inputZip">Postnr: *</label>
								<input type="text" class="form-control" placeholder="12345" name="frmPostAZip" value="<? echo $rowPostAZip; ?>" required>
							</div>
							<div class="form-group col-md-9">
								<label for="inputCity">Ort: *</label>
								<input type="text" class="form-control" placeholder="Ort" name="frmPostATown" value="<? echo $rowPostATown; ?>" required>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label for="inputStandard">Stad där Huvudkontoret ligger: *</label>
							<input type="text" id="inputStandard" class="form-control" name="frmCity" value="<? if (empty($rowHQCity)) {
																													echo $rowPostATown;
																												} else {
																													echo $rowHQCity;
																												} ?>" required>
						</div>
						<hr>


						Kund Notering: <span style="color:red;">(Syns för kund)</span>
						<textarea class="form-control" name="frmNotes"><? echo $Notes; ?></textarea>
						Admin Notering: <span style="color:red;">(Syns ej för kund)</span>
						<textarea class="form-control" name="frmANotes"><? echo $ANotes; ?></textarea>

						<? echo $HRB; ?>
						<? echo $gloBackButton; ?>
						<button type="submit" class="<? echo $btnPrimary; ?>"><i class="fas fa-rocket"></i> Spara och Aktivera</button>
						<a class="btn btn-secondary" href="#" data-id="AbortClient" data-bs-toggle="modal" data-bs-target="#Modal-AbortClient">
							<i class="fas fa-times-circle"></i> Avbryt/Neka
						</a>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End content -->

<? } }?>