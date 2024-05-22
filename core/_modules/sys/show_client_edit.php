<?php
if ( $gloAccess < 8 ) {
  echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
  $intID = intval( $_GET[ 'id' ] );

  $strSQL = "
	SELECT
		id,
        companyname,contactname,phone,email,active,
		countryid,town,added,updated,info,
        userid,afid,website,companyid,paddress,
        pzip,ptown,iaddress,izip,itown,vatid,
        typeid, notes, adminnotes, orgadmin, invoiceaddress, 
		iemail, mbingo
	FROM data_clients
	WHERE id = $intID 
	LIMIT 1";
  $arrRS = mysqli_query( $SQLlink, $strSQL );
  while ( $arrRow = mysqli_fetch_row( $arrRS ) ) {
    $rowID = $arrRow[ 0 ];

    $rowCompany = $arrRow[ 1 ];
    $rowContact = $arrRow[ 2 ];
    $rowPhone = $arrRow[ 3 ];
    $rowEmail = $arrRow[ 4 ];
    $rowActive = $arrRow[ 5 ];

    $rowCountryID = $arrRow[ 6 ];
    $rowHQCity = $arrRow[ 7 ];
    $rowAdded = $arrRow[ 8 ];
    $rowUpdated = $arrRow[ 9 ];
    $rowInfo = $arrRow[ 10 ];

    $rowUserID = $arrRow[ 11 ];
    $rowRID = $arrRow[ 12 ];
    $rowWebsite = $arrRow[ 13 ];
    $rowCompanyID = $arrRow[ 14 ];
    $rowPostA = $arrRow[ 15 ];

    $rowPostAZip = $arrRow[ 16 ];
    $rowPostATown = $arrRow[ 17 ];
    $rowInvoiceA = $arrRow[ 18 ];
    $rowInvoiceAZip = $arrRow[ 19 ];
    $rowInvoiceATown = $arrRow[ 20 ];

    $rowVATID = $arrRow[ 21 ];
    $rowTypeID = $arrRow[ 22 ];

    $rowUIDS = explode( ",", $rowUserID );

    $rowNotes = $arrRow[ 23 ];
    $rowANotes = $arrRow[ 24 ];

    $rowOrgAdminID = $arrRow[ 25 ];
    $rowOldIAdress = $arrRow[ 26 ];
    $rowInvoiceEmail = $arrRow[ 27 ];

	$rowMBingoActive = $arrRow[ 28 ];

	if (!$rowInvoiceEmail) { $rowInvoiceEmail = $rowEmail; }  

  }
	
	
  ?>

<!-- Begin content -->
<div class="row">
  <div class="col-xl-9 col-md-6 mb-4">
    <div class="card shadow mb-4"> 
      <!-- Card Header - Dropdown -->
      <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Ändra kund</h4>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=client_edit">
          <input type="hidden" name="frmID" value="<? echo $intID; ?>">
			
					<!-- START ORGANISATION DATA -->	
		
          <h5 class="text-uppercase font-weight-bold">Organisation</h5>
          <div class="card shadow">
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputStandard" class="control-label"><b>Organisationsform:</b></label>
                  <select id="select100" class="select2 form-control" name="frmOrgType">
                    <?
                    $strSQL = "SELECT id,se_type FROM data_clienttypes WHERE active = '1' ORDER BY id ASC";
                    $arrRS = mysqli_query( $SQLlink, $strSQL );
                    while ( $arrRow = mysqli_fetch_row( $arrRS ) ) {
                      $rowID = $arrRow[ 0 ];
                      $rowName = $arrRow[ 1 ];

                      if ( $rowTypeID == $rowID ) {
                        echo "<option value='$rowID' selected>* ($rowID) $rowName</option>";
                      }
                      echo "<option value='$rowID'>($rowID) $rowName</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-8">
                  <label for="inputStandard" class="control-label"><b>Organisationsnamn: *</b></label>
                  <input type="text" id="inputStandard" class="form-control" name="frmCompany" value="<? echo $rowCompany; ?>" placeholder="Bolaget AB eller SportKlubben IF" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputStandard" class="control-label"><b>Person/Organisationsnr:</b> *</label>
                  <input type="text" id="inputStandard" class="form-control" name="frmCompanyID" placeholder="XXXXXXXXXX" value="<? echo $rowCompanyID; ?>">
                  <div class="alert alert-info p-1"><small>Utan bindestreck - Exempel: 5556561201</small></div>
                </div>
                <div class="form-group col-md-8">
                  <label for="inputStandard" class="control-label">VATID: </label>
                  <input type="text" id="inputStandard" class="form-control" name="frmVATID" placeholder="SEXXXXXXXXXX01" value="<? echo $rowVATID; ?>">
                  <div class="alert alert-info p-1"><small>Momsregistreringsnummer i Sverige. För organisationer med moms verksamhet.</small></div>
                </div>
              </div>
				<div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputStandard" class="control-label"><b>Land:</b> *</label>
						  <select id="select0" class="select2 form-control custom-select-lg" name="frmCountryID">
					  <?
					  $strSQL = "SELECT id,country_name FROM data_countrys ORDER BY id ASC";
					  $arrRS = mysqli_query( $SQLlink, $strSQL );
					  while ( $arrRow = mysqli_fetch_row( $arrRS ) ) {
						$rowID = $arrRow[ 0 ];
						$rowName = $arrRow[ 1 ];

						if ( $rowCountryID == $rowID ) {
						  echo "<option value='$rowID' selected>* $rowName</option>";
						}
						echo "<option value='$rowID'>$rowName</option>";
					  }
					  ?>
					</select>
                  <div class="alert alert-info p-1"><small>Där företaget är registrerat</small></div>
                </div>
                <div class="form-group col-md-8">
                  <label for="inputStandard" class="control-label">Hemsida: </label>
					<div class="input-group mb-3">
					  <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon3">https://</span> </div>
					  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmWebsite" value="<? echo $rowWebsite; ?>">
					</div>
					   <div class="alert alert-info p-1" style="margin-top: -12px;"><small>Om du inte har en hemsida, tipsar vi om <a href="https://moonsite.se" target="_blank">Moonsite.se</a></small></div>
                </div>
              </div>

            </div>
          </div>
		<!-- END ORGANISATION DATA -->	

		<!-- START CONTACT PERSON DATA -->		

          <h5 class="text-uppercase font-weight-bold">Kontaktperson till <? echo $gloBrandSiteName; ?></h5>
          <div class="card shadow">
            <div class="card-body">
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon3">Namn: </span> </div>
                  <input type="text" placeholder="Anna Andersson" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmContact" value="<? echo $rowContact; ?>" >
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon3">Telefon:</span> </div>
                      <input type="tel" placeholder="0700000000" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmPhone" value="<? echo $rowPhone; ?>" >
                    </div>
					<div class="alert alert-info p-1" style="margin-top: -12px;">Ett nummer vi kan skicka SMS till. Exempel: 0700000000</div>

                  </div>
                  <div class="form-group col-md-6">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon3">E-post: </span> </div>
                      <input type="email" placeholder="namn@exempel.se" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="frmEmail" value="<? echo $rowEmail; ?>" >
                    </div>
					  <div class="alert alert-info p-1" style="margin-top: -12px;">Exempel: namn@exempel.se</div>

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

				<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item1">
					<a class="nav-link active" id="post-tab" data-bs-toggle="tab" href="#post" role="tab" aria-controls="post" aria-selected="true">Postadress</a>
				  </li>
				  <li class="nav-item1">
					<a class="nav-link" id="invoice-tab" data-bs-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="false">Fakturaadress</a>
				  </li>
				</ul>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="post" role="tabpanel" aria-labelledby="post-tab">
					  <br>
					  <? if ($rowOldIAdress) { echo $rowOldIAdress."<hr>"; } ?>
					  <div class="form-group">
						<div class="input-group mb-3">
						  <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon3">Postaddress: </span> </div>
						  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Postvägen 2" name="frmPostA" value="<? echo $rowPostA; ?>">
						</div>
						<div class="form-row">
						  <div class="form-group col-md-6">
							<div class="input-group mb-3">
							  <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon3">Postnr:</span> </div>
							  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="12345" name="frmPostAZip" value="<? echo $rowPostAZip; ?>">
							</div>

						  </div>
						  <div class="form-group col-md-6">
							<div class="input-group mb-3">
							  <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon3">Ort: </span> </div>
							  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Ort" name="frmPostATown" value="<? echo $rowPostATown; ?>">
							</div>
						  </div>
						</div>
							  <div class="alert alert-info p-1" style="margin-top: -28px;">Om du lämnar fakturaadress fälten tomma, kommer automatiskt postadressen att användas.</div>
					  </div>

				  </div>
				  <div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
					  <br>
					  <div class="form-group">
						<div class="input-group mb-3">
						  <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon3">Fakturaaddress: </span> </div>
						  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Fakturavägen 1" name="frmInvoiceA" value="<? echo $rowInvoiceA; ?>">
						</div>
						<div class="form-row">
						  <div class="form-group col-md-6">
							<div class="input-group mb-3">
							  <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon3">Postnr:</span> </div>
							  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="12345" name="frmInvoiceAZip" value="<? echo $rowInvoiceAZip; ?>">
							</div>

						  </div>
						  <div class="form-group col-md-6">
							<div class="input-group mb-3">
							  <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon3">Ort: </span> </div>
							  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Ort" name="frmInvoiceATown" value="<? echo $rowInvoiceATown; ?>">
							</div>
						  </div>
						</div>
							  <div class="alert alert-info p-1" style="margin-top: -28px;">Om du lämnar fakturaadress fälten tomma, kommer automatiskt postadressen att användas.</div>
					  </div>


							  <div class="form-group">
								<label for="inputStandard09" class="control-label">E-post faktura: </label>
								<input type="email" id="inputStandard" class="form-control" name="frmInvoiceEmail" value="<? echo $rowInvoiceEmail; ?>">
								<div class="alert alert-info p-1">Om du lämnar epost faktura fältet tomt, kommer automatiskt kontaktpersonens e-postadress att användas.</div>
							  </div>
				  </div>
				</div>
				
				
            </div>
          </div>
			<!-- END ORGANISATION ADDRESS DATA -->
			
			
			
			
			
			
<!-- START CONNECTIONS AND STATUS DATA -->

                   <h5 class="text-uppercase font-weight-bold">Kopplingar, Noteringar och Status</h5>
          <div class="card shadow">
            <div class="card-body">

							
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputStandard1" class="control-label"><b>Tillhör ÅF:</b></label>
								<select id="select1" class="select2 form-control" name="frmAFID">
								  <?
								  $strSQL = "SELECT id,companyname FROM data_resellers ORDER BY id ASC";
								  $arrRS = mysqli_query( $SQLlink, $strSQL );
								  while ( $arrRow = mysqli_fetch_row( $arrRS ) ) {
									$rowID = $arrRow[ 0 ];
									$rowName = $arrRow[ 1 ];
?>
	<option value='<? echo $rowID; ?>' <? if ( $rowRID == $rowID ) { echo "selected"; } ?>> <? if ( $rowRID == $rowID ) { echo "*"; } ?> (<? echo $rowID; ?>) <? echo $rowName; ?></option>
							<?	  }
								  ?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<h5><b>OrganisationsHuvudAdmin: *</b></h5>
                                    <select id="frmOrgAdminID" class="select2 select2-show-search form-control" name="frmOrgAdminID">
                                        <? $strSQL = "SELECT id, user_email, user_fname, user_sname FROM data_users ORDER BY id ASC";
                                        $arrRS = mysqli_query($SQLlink, $strSQL);
                                        while ($arrRow = mysqli_fetch_row($arrRS)) {
                                            $rowUID     = $arrRow[0];
                                            $rowUEmail    = $arrRow[1];
                                            $rowUName     = $arrRow[2] . " " . $arrRow[3];
											?>
												<option value='<? echo $rowUID; ?>' <? if ( $rowOrgAdminID == $rowUID ) { echo "selected"; } ?>> <? if ( $rowOrgAdminID == $rowUID ) { echo "*"; } ?> (<? echo $rowUID; ?>) <? echo $rowUEmail; ?> <? echo $rowUName; ?></option>
                                     <? } ?>
                                    </select>
							</div>
						  </div>
				

							<div class="form-row">
							<div class="form-group col-md-6">
							   <label for="inputStandard10" class="control-label">Kund Noteringar: <span style="color:red;">(Syns för kund)</span></label>
                          		 <textarea class="form-control" name="frmNotes"><? echo $rowNotes; ?></textarea>
							</div>
							<div class="form-group col-md-6">
 								 <label for="inputStandard11" class="control-label">Admin Noteringar: (Syns ej för kund)</label>
                          		 <textarea class="form-control" name="frmANotes"><? echo $rowANotes; ?></textarea>
							</div>
						  </div>

				
								<div class="form-group12">
									<label for="inputStandard011" class="control-label"><b>Status:</b> (<? echo $rowActive; ?>)</label><br>
									
									  <? if ($rowActive == 1) { 
										$ClientActive = "checked"; 
									} else { $ClientActive = ""; } ?>
									<label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
									  <input type="checkbox" name="frmActive" class="custom-switch-input" <? echo $ClientActive; ?>></input>
									  <span class="custom-switch-indicator pr-6"></span> <span class="custom-switch-description pr-1">Aktiv</span>
									</label>
									<br><br>
									<label for="inputStandard012" class="control-label"><b>MBingo:</b> (<? echo $rowMBingoActive; ?>)</label><br>
									
									<? if ($rowMBingoActive == 1) { 
										$MBingoActive = "checked"; 
									} else { $MBingoActive = ""; } ?>
								  <label class="custom-switch"> <span class="custom-switch-description">Inaktiv &nbsp;</span>
									<input type="checkbox" name="frmMBingoActive" class="custom-switch-input" <? echo $MBingoActive; ?>></input>
									<span class="custom-switch-indicator pr-6"></span> <span class="custom-switch-description pr-1">Aktiv</span>
								  </label>

								  <br><br>
								  <label for="inputStandard010"><b>Användare som får hantera Kunden:</b></label>
								  <br>

								<small><a href="<? echo $gloBaseModule; ?>&show=users&clientid=<? echo $intID; ?>" class="btn btn-light"><i class="fas fa-users-cog"></i> Hantera användare & behörigheter</a></small>

								</div>
			       </div>
          </div>	
         <!-- END CONNECTIONS AND STATUS DATA -->

		 <? echo $HRB; ?>

                       <? echo $gloSendButton; ?>
                 <? echo $gloBackButton; ?>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End content -->

<? } ?>
