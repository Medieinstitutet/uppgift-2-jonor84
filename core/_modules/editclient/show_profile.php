<?php  // $gloClientID logged in users clientid
// CHECK IF USER IS A CLIENT ADMIN - ONLY A 3 Client Admin is allowed to this page

//CHECK LOGGED IN USERS ACCESS LEVEL ON SELECTED CLIENTID

$strSQLAccessCS = "SELECT id FROM data_clients_access WHERE cid = '$gloCurrentClientID' AND uid = '$gloUID' AND aid > 1";
$strResAccessCS = mysqli_query($SQLlink, $strSQLAccessCS);
$gloAccessClientS = mysqli_num_rows($strResAccessCS);

if ($gloClientAccessLevel == 4 || $gloClientAccessLevel == 7) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else if (!$gloAccessClientS) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {


?>

	<!-- Begin content -->
	<div class="row">
		<div class="col-xl-12">

			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h3 class="m-0 font-weight-bold brand-title"><? echo $strHeader; ?> / Organisationsuppgifter</h3>

				</div>
				<!-- Card Body -->
				<div class="card-body">
					<? if ($rowORGNEW) {
						echo "<div class='$alertInfo'><i class='fas fa-info-circle'></i> Kundprofilen <b>$rowCompany</b> är inte verifierad/aktiverad ännu.</div>";
					} else {
					?>

						<form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=profile">

							<input type="hidden" name="frmCID" value="<? echo $gloCurrentClientID; ?>">
							<input type="hidden" name="frmMBINGO" value="<? echo $rowOrgMbingo; ?>">
							<input type="hidden" name="frmMSITE" value="<? echo $rowOrgMsite; ?>">

							<!-- START ORGANISATION DATA -->

							<h5 class="text-uppercase font-weight-bold">Organisation</h5>
							<div class="card shadow">
								<div class="card-body">
									<div class="form-row">
										<div class="form-group col-md-5">
											<label for="inputStandard"><b>Organisationsform:</b></label>
											<input type="text" id="inputStandard" class="form-control" name="frmCompanyType" value="<? echo $rowTypeName; ?>" readonly>


										</div>
										<div class="form-group col-md-7">
											<label for="inputStandard"><b>Organisationsnamn: *</b></label>
											<input type="text" id="inputStandard" class="form-control" name="frmCompany" value="<? echo $rowCompany; ?>" placeholder="Bolaget AB eller SportKlubben IF" readonly>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-5">
											<? if (empty($rowCompanyID)) {
												$Readonly = "required";
											} else {
												$Readonly = "readonly";
											} ?>
											<label for="inputStandard"><b>Person/Organisationsnr:</b> *</label>
											<input type="text" id="inputStandard" class="form-control" name="frmCompanyID" placeholder="XXXXXXXXXX" value="<? echo $rowCompanyID; ?>" <? echo $Readonly; ?>>
											<div class="alert alert-info p-1 text-dark">Utan bindestreck - Exempel: 5556561245</div>
										</div>
										<div class="form-group col-md-7">
											<label for="inputStandard">VATID: </label>
											<input type="text" id="inputStandard" class="form-control" name="frmVATID" placeholder="SEXXXXXXXXXX01" value="<? echo $rowVATID; ?>">
											<div class="alert alert-info p-1 text-dark">Momsregistreringsnummer i Sverige. För organisationer med moms verksamhet.</div>
										</div>
									</div>
									<? if ($rowMBingo) { ?>

										<div class="form-row">
											<div class="form-group col-md-5">
												<label for="inputStandard9111"><b>Landskap:</b> *</label>
												<select id="select3" class="select2 form-control" name="frmState">
													<? $strSQL = "SELECT id,namn FROM data_landskap ORDER BY namn ASC";
													$arrRS = mysqli_query($SQLlink, $strSQL);
													while ($arrRow = mysqli_fetch_row($arrRS)) {
														$rowID = $arrRow[0];
														$rowName = $arrRow[1];

														if ($rowOrgLandskapsid == $rowID) {
															echo "<option value='$rowID' selected>* ($rowID) $rowName</option>";
														}
														echo "<option value='$rowID'>($rowID) $rowName</option>";
													} ?>
												</select>
												<div class="alert alert-info p-1 text-dark">Där organisationen är registrerad</div>
											</div>
											<div class="form-group col-md-7">
												<label for="inputStandard1">Ev. Allians: </label>
												<input type="text" id="inputStandard1" class="form-control" name="frmAlliance" value="<? echo $rowOrgAlliance; ?>">
											</div>
										</div>






									<?  } ?>

									<div class="form-row">
										<div class="form-group col-md-5">
											<label for="inputStandard"><b>Land:</b> *</label>
											<select id="select0" class="select2 form-control custom-select-lg" name="frmCountryID" disabled>
												<?
												$strSQL = "SELECT id,country_name FROM data_countrys ORDER BY id ASC";
												$arrRS = mysqli_query($SQLlink, $strSQL);
												while ($arrRow = mysqli_fetch_row($arrRS)) {
													$rowID = $arrRow[0];
													$rowName = $arrRow[1];

													if ($rowCountryID == $rowID) {
														echo "<option value='$rowID' selected>* $rowName</option>";
													}
													echo "<option value='$rowID'>$rowName</option>";
												}
												?>
											</select>
											<div class="alert alert-info p-1 text-dark">Där organisationen är registrerad</div>
										</div>
										<div class="form-group col-md-7">
											<label for="inputStandard">Hemsida: </label>
											<div class="input-group mb-3">
												<div class="input-group-prepend"> <span class="input-group-text bg-light text-dark" id="basic-addon3">https://</span> </div>
												<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmWebsite" value="<? echo $rowWebsite; ?>">
											</div>
											<div class="alert alert-info p-1 text-dark" style="margin-top: -12px;">Om du inte har en hemsida, tipsar vi om <a href="https://moonsite.se" target="_blank">Moonsite.se</a></div>
										</div>
									</div>
									<? if ($rowMBingo) { ?>
										<div class="form-row">
											<div class="form-group col-md-12">
												<label for="inputStandard">Facebook: </label>
												<div class="input-group mb-3">
													<div class="input-group-prepend"> <span class="input-group-text bg-light text-dark" id="basic-addon3">https://www.facebook.com/</span> </div>
													<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmFacebook" value="<? echo $rowOrgFacebook; ?>">
												</div>
												<div class="alert alert-info p-1 text-dark" style="margin-top: -12px;">Om det är en grupp liknande: https://www.facebook.com/groups/3333333332223/, skriv bara in siffrorna.</div>
											</div>
											<div class="form-group col-md-12">
												<label for="inputStandard">Instagram: </label>
												<div class="input-group mb-3">
													<div class="input-group-prepend"> <span class="input-group-text bg-light text-dark" id="basic-addon3">https://www.instagram.com/</span> </div>
													<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmInstagram" value="<? echo $rowOrgInstagram; ?>">
												</div>
											</div>
										</div>
									<? } ?>

								</div>
							</div>
							<!-- END ORGANISATION DATA -->


							<!-- START CONTACT PERSON DATA -->

							<h5 class="text-uppercase font-weight-bold">Kontaktperson till <? echo $gloBrandSiteName; ?></h5>
							<div class="card shadow">
								<div class="card-body">
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend"> <span class="input-group-text bg-light text-dark" id="basic-addon3">Namn: </span> </div>
											<input type="text" placeholder="Anna Andersson" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmContact" value="<? echo $rowContact; ?>">
										</div>
										<div class="form-row">
											<div class="form-group col-md-5">
												<div class="input-group mb-3">
													<div class="input-group-prepend"> <span class="input-group-text bg-light text-dark" id="basic-addon3">Telefon:</span> </div>
													<input type="tel" placeholder="0700000000" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmPhone" value="<? echo $rowPhone; ?>">
												</div>
												<div class="alert alert-info p-1 text-dark" style="margin-top: -12px;">Ett nummer vi kan skicka SMS till. Exempel: 0700000000</div>

											</div>
											<div class="form-group col-md-7">
												<div class="input-group mb-3">
													<div class="input-group-prepend"> <span class="input-group-text bg-light text-dark" id="basic-addon3">E-post: </span> </div>
													<input type="email" placeholder="namn@exempel.se" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmEmail" value="<? echo $rowEmail; ?>">
												</div>
												<div class="alert alert-info p-1 text-dark" style="margin-top: -12px;">Exempel: namn@exempel.se</div>

											</div>
										</div>

									</div>
								</div>
							</div>

							<!-- END CONTACT PERSON DATA -->



							<!-- START ORGANISATION ADDRESS DATA -->

							<h5 class="text-uppercase font-weight-bold">Organisationsadresser</h5>
							<div class="card shadow">
								<div class="card-body">

									<? if ($CURRENTTHEME == "moonserver") { ?>
										<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item1">
												<a class="nav-link active" id="post-tab" data-toggle="tab" href="#post" role="tab" aria-controls="post" aria-selected="true">Postadress</a>
											</li>
											<li class="nav-item1">
												<a class="nav-link" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="false">Fakturaadress</a>
											</li>
										</ul>
									<? } else { ?>

										<div class="tab-menu-heading tab-menu-heading-boxed">
											<div class="tabs-menu-boxed">
												<!-- Tabs -->
												<ul class="nav panel-tabs" role="tablist">
													<li><a href="#post" class="active" data-bs-toggle="tab" aria-selected="true" role="tab">Postadress</a></li>
													<li><a href="#invoice" data-bs-toggle="tab" aria-selected="false" role="tab" class="" tabindex="-1">Fakturaadress</a></li>
												</ul>
											</div>
										</div>
									<? } ?>


									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade show active" id="post" role="tabpanel" aria-labelledby="post-tab">
											<br>
											<? if ($rowOldIAdress) {
												echo $rowOldIAdress . "<hr>";
											} ?>
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend"> <span class="input-group-text bg-light text-dark" id="basic-addon3">Postaddress: </span> </div>
													<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Postvägen 2" name="frmPostA" value="<? echo $rowPAddress; ?>">
												</div>
												<div class="form-row">
													<div class="form-group col-md-5">
														<div class="input-group mb-3">
															<div class="input-group-prepend"> <span class="input-group-text bg-light text-dark" id="basic-addon3">Postnr:</span> </div>
															<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="12345" name="frmPostAZip" value="<? echo $rowPZip; ?>">
														</div>

													</div>
													<div class="form-group col-md-7">
														<div class="input-group mb-3">
															<div class="input-group-prepend"> <span class="input-group-text bg-light text-dark" id="basic-addon3">Ort: </span> </div>
															<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Ort" name="frmPostATown" value="<? echo $rowPTown; ?>">
														</div>
													</div>
												</div>
												<div class="alert alert-info p-1 text-dark" style="margin-top: -28px;">Om du lämnar fakturaadress fälten tomma, kommer automatiskt postadressen att användas.</div>
											</div>

										</div>
										<div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
											<br>
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend"> <span class="input-group-text bg-light text-dark" id="basic-addon3">Fakturaaddress: </span> </div>
													<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Fakturavägen 1" name="frmInvoiceA" value="<? echo $rowIAddress; ?>">
												</div>
												<div class="form-row">
													<div class="form-group col-md-5">
														<div class="input-group mb-3">
															<div class="input-group-prepend"> <span class="input-group-text bg-light text-dark" id="basic-addon3">Postnr:</span> </div>
															<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="12345" name="frmInvoiceAZip" value="<? echo $rowIZip; ?>">
														</div>

													</div>
													<div class="form-group col-md-7">
														<div class="input-group mb-3">
															<div class="input-group-prepend"> <span class="input-group-text bg-light text-dark" id="basic-addon3">Ort: </span> </div>
															<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Ort" name="frmInvoiceATown" value="<? echo $rowITown; ?>">
														</div>
													</div>
												</div>
												<div class="alert alert-info p-1 text-dark" style="margin-top: -28px;">Om du lämnar fakturaadress fälten tomma, kommer automatiskt postadressen att användas.</div>
											</div>


											<div class="form-group">
												<label for="inputStandard09">E-post faktura: </label>
												<input type="email" id="inputStandard" class="form-control" name="frmInvoiceEmail" value="<? echo $rowOrgiemail; ?>">
												<div class="alert alert-info p-1 text-dark">Om du lämnar epost faktura fältet tomt, kommer automatiskt kontaktpersonens e-postadress att användas.</div>
											</div>
										</div>
									</div>


								</div>
							</div>
							<!-- END ORGANISATION ADDRESS DATA -->

							<? if ($rowMBingo) { ?>
								<div class="form-group">
									<h5 class="text-uppercase font-weight-bold">Information om Arrangören:</h5>

									<div class="alert alert-info p-1 text-dark" style="margin-top: -5px;">Till exempel: X IF har så många lag, vi har funnits sedan årtal xxxx..</div>

									<textarea class="form-control" id="tiny" name='frmInfo' rows="4"><? echo $rowInfo; ?></textarea>
								</div>
							<? } ?>


							<hr>
							<button type="submit" class="<? echo $btnSuccess; ?>"><i class="fas fa-check-circle"></i> Spara</button>
							<? if ($rowMBingo) { ?>
								<a class="btn btn-light" href="<? $gloBase; ?>bingon"><i class="fas fa-arrow-circle-left" aria-hidden="true"></i> Tillbaka</a>
							<? } else { ?>
								<a class="btn btn-light" href="javascript:history.back()"><i class="fas fa-arrow-circle-left" aria-hidden="true"></i> Tillbaka</a>
							<? } ?>
						</form>
					<? } ?>
				</div>
			</div>
		</div>
	</div>
	<!-- End content -->
<?
} ?>