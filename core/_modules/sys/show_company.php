<?php
if (!$gloClientAccessTempRPanel) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {

?>

	<!-- Begin content -->
	<div class="row">
		<div class="col-xl-8 col-md-6 mb-4">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Företagsuppgifter</h4>
				</div>
				<!-- Card Body -->
				<div class="card-body">
				<div class='<? echo $alertInfo; ?> text-dark'><i class="fas fa-info-circle"></i> Dessa uppgifter är synliga för era kunder.</div>

					<form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=company">
					<input type="hidden" name="frmID" value="<? echo $gloResellerID; ?>">
					<input type="hidden" name="frmBRAND" value="<? echo $BRAND; ?>">


					<h4>Organisation</h4>
						<div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label for="inputStandard">Org. Nr: *</label>
								<input type="text" id="inputStandard" class="form-control" name="frmOrgNr" value="<? echo $gloResellerCompanyID; ?>" required>
                                </div>
                                <div class="col">
                                <label for="inputStandard">Företagsnamn:</label>
								<input type="text" id="inputStandard" class="form-control" name="frmCompany" value="<? echo $gloResellerCompany; ?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
						<h4>Bankgiro & Plusgiro </h4>
						<div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label for="inputStandard">BankGiro: *</label>
								<input type="text" id="inputStandard" class="form-control" name="frmBG" value="<? echo $gloResellerBG; ?>">
                                </div>
                                <div class="col">
                                <label for="inputStandard">PlusGiro:</label>
								<input type="text" id="inputStandard" class="form-control" name="frmPG" value="<? echo $gloResellerPG; ?>">
                                </div>
                            </div>
                        </div>
                        <hr>
						<h4>Telefon</h4>
						<div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label for="inputStandard">Telefon: *</label>
								<input type="tel" id="phone" class="form-control" name="frmPhone" value="<? echo $gloBrandPhone1; ?>" required />
								<div class='<? echo $alertInfo; ?> text-dark'><small><i class="fas fa-info-circle"></i> Endast siffror.</small></div>

                                </div>
                                <div class="col">
                                <label for="inputStandard">Telefon Support:</label>
								<input type="tel" id="phone" class="form-control" name="frmPhoneSupport" value="<? echo $gloBrandPhoneSupport; ?>" required />
								<div class='<? echo $alertInfo; ?> text-dark'><small><i class="fas fa-info-circle"></i> Endast siffror.</small></div>

                                </div>
                            </div>
                        </div>
                        <hr>
						<h4>E-post</h4>
						<div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label for="inputStandard">E-post (Publik): *</label>
								<input type="email" id="inputStandard" class="form-control" name="frmEmail" value="<? echo $gloBrandMail; ?>" required>
                                </div>
                                <div class="col">
                                <label for="inputStandard">E-post (Support):</label>
								<input type="email" id="inputStandard" class="form-control" name="frmEmailSupport" value="<? echo $gloBrandMailSupport; ?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>

						<h4>Adress</h4>
						<div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label for="inputStandard">Land: *</label>
								<select id="select1" class="select2 form-control" name="frmCountryID">
                                        <? $strSQL = "SELECT id,country_name FROM data_countrys WHERE id = 1";
                                        $arrRS = mysqli_query($SQLlink, $strSQL);
                                        while ($arrRow = mysqli_fetch_row($arrRS)) {
                                            $rowID = $arrRow[0];
                                            $rowName = $arrRow[1];

                                            if ($rowAF == $rowID) {
                                                echo "<option value='$rowID' selected>* ($rowID) $rowName</option>";
                                            }
                                            echo "<option value='$rowID'>($rowID) $rowName</option>";
                                        } ?>
                                    </select>                                
								</div>
                                <div class="col">
                                <label for="inputStandard">Adress:</label>
								<input type="text" id="inputStandard" class="form-control" name="frmAddress" value="<? echo $gloResellerAddress; ?>">
                                </div>
                            </div>
                        </div>

						<div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                <label for="inputStandard">Postnummer: *</label>
								<input type="text" id="inputStandard" class="form-control" name="frmZip" value="<? echo $gloResellerZip; ?>">
                                </div>
                                <div class="col">
                                <label for="inputStandard">Ort:</label>
								<input type="text" id="inputStandard" class="form-control" name="frmCity" value="<? echo $gloResellerTown; ?>">
                                </div>
                            </div>
                        </div>
                        <hr>



						<? echo $HRB; ?>

						<? echo $gloSendButton; ?>
						<? echo $gloBackButton; ?>
					</form>

				</div>
			</div>
		</div>
	</div>
	<!-- End content -->
<?
}
?>