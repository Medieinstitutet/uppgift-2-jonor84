<?php
if ($gloAccess < 9) { echo "<div class='$alertError'>$gloWrongAccess</div>"; }
else {
	$strSQL = "
	SELECT set_domain, set_status, set_offlinemsg, set_glonote, set_topnote, set_sidenote, set_welcomenote
	FROM data_settings 
	WHERE id = 999 
	LIMIT 1";
	$arrRS = mysqli_query($SQLlink,$strSQL);	
	while ($arrRow = mysqli_fetch_row($arrRS)) {		
		$rowDomain		= $arrRow[0];
		$rowStatus		= $arrRow[1];
		$rowOfflineMsg		= $arrRow[2];
		$rowGloNote		= $arrRow[3];
		$rowGloTopNote		= $arrRow[4];
		$rowGloSideNote		= $arrRow[5];
		$rowGloWelcomeNote		= $arrRow[6];
	}
?>


<!-- Begin content -->
<div class="row">

                          <div class="col-xl-10 col-md-6 mb-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / System inställningar</h6>
                               </div>
                                <!-- Card Body -->
                                <div class="card-body">

	    			<form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=system">

                      			<div class="form-group">
                        		 <label for="inputStandard">Domän (ex. mindomän.se):</label>
                            		 <input type="text" id="inputStandard" class="form-control" name="frmDomain" value="<? echo $rowDomain; ?>">
                      			</div>

					<div class="form-group">
                        		 <label for="inputStandard">Globalt viktigt meddelande:</label>
                            		 <textarea id="textarea" name="frmGloNote" class="form-control"><? echo $rowGloNote; ?></textarea>
                      			 <small id="websiteHelp" class="form-text text-muted">(Lämna tomt om inget meddelande)</small>
					</div>

					<div class="form-group">
                        		 <label for="inputStandard">Global Välkomstmeddelande:</label>
                            		 <textarea id="textarea" name="frmWelcomeNote" class="summernote form-control"><? echo $rowGloWelcomeNote; ?></textarea>
                      			 <small id="websiteHelp1" class="form-text text-muted">(Lämna tomt om inget välkomstmeddelande)</small>
					</div>


					<div class="form-group">
                        		 <label for="inputStandard">Global TopNote:</label>
                            		 <textarea id="textarea" name="frmTopNote" class="form-control"><? echo $rowGloTopNote; ?></textarea>
                      			 <small id="websiteHelp2" class="form-text text-muted">(Lämna tomt om ingen topnote)</small>
					</div>

					<div class="form-group">
                        		 <label for="inputStandard">Global SideNote:</label>
                            		 <textarea id="textarea" name="frmSideNote" class="summernote form-control"><? echo $rowGloSideNote; ?></textarea>
                      			 <small id="websiteHelp3" class="form-text text-muted">(Lämna tomt om ingen sidenote)</small>
					</div>

					<div class="form-group">
  			                 <label for="inputStandard">Systemet status: *</label>
                            			<select id="Select" class="form-control" name="frmStatus">
                             			<option value="0" <? if ($rowStatus== "0") { echo "selected"; }?>><? if ($rowStatus== "0") { echo "* "; }?>Inaktiv</option>
                             			<option value="1" <? if ($rowStatus== "1") { echo "selected"; }?>><? if ($rowStatus== "1") { echo "* "; }?>Aktiv</option>
                            		 </select>
                     			</div>
					<div class="form-group">
                        		 <label for="inputStandard">Driftmeddelande vid inaktiv:</label>
                            		 <textarea id="summernote1" class="summernote" name="frmOfflineMsg"><? echo $rowOfflineMsg; ?></textarea>
                      			</div>

<hr>
				   <? echo $gloSendButton; ?>
                 <? echo $gloBackButton; ?>
				</form>
  				 
                                </div>
                           </div>
		       </div>
</div>
<!-- End content -->      
<? } ?>