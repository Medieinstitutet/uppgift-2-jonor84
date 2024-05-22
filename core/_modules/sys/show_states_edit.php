<?php
if ($gloAccess < 8) { echo "<div class='$alertError'>$gloWrongAccess</div>"; }
	else {
	$intID = intval($_GET['id']);

	$strSQL = "
	 SELECT id, namn, info, updated  
	 FROM data_landskap
	WHERE id = $intID 
	LIMIT 1";
	$arrRS = mysqli_query($SQLlink,$strSQL);	
	while ($arrRow = mysqli_fetch_row($arrRS)) {		
		$rowID		= $arrRow[0];
		$rowName	= $arrRow[1];
		$rowInfo	= $arrRow[2];
		$rowUpdated 	= $arrRow[3];
	}
?>


<!-- Begin content -->
<div class="row">
                        <div class="col-xl-8 col-md-6 mb-4">

                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Ändra landskap</h6>
                               </div>
                                <!-- Card Body -->
                                <div class="card-body">
	
				<form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=states_edit">

                     			<input type="hidden" name="frmID" value="<? echo $rowID; ?>">

                     
                      			<div class="form-group">
                        			<label for="inputStandard" class="col-lg-3 control-label">Namn:</label>
                            			<input type="text" id="inputStandard" class="form-control" name="frmName" value="<? echo $rowName; ?>">
                      			</div>
                     
                                            
                      <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label">Beskrivning:</label>
                            <textarea name="frmInfo" class="form-control" id="textArea2" rows="6"><? echo $rowInfo; ?></textarea>
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
<?
}
?>