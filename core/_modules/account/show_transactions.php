<?php	

if ($gloUserNew || $gloUserNewClient) { 
	echo "<div class='$alertError'>$gloWrongAccess</div>"; 
  } else {

	$strSQL = "
	SELECT id, invoiceid, date, amount, text  
	FROM user_transactions 
	WHERE userid = '" . $gloUID . "' 
	ORDER BY id DESC
	LIMIT 100";
	$arrRS = mysqli_query($SQLlink,$strSQL);

	// DEBUG
	//if ($gloAccess==9) { echo "<div class='debug'>".$strSQL."</div>"; }

	if ($gloTempPass == "Y") {
	header("location: main.php?module=profile&show=passwordnew");
	}

?>
<!-- Begin content -->


     <!-- DataTables -->
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Mina transaktioner</h4>
                        </div>
			<?php
		        // IF RS = TRUE THEN PRINT TABLE
        		if (mysqli_num_rows($arrRS)) {
            		?>

                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-sm table-striped table-bordered display responsive" style="margin-bottom: 0px;" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
						<th>ID</th>
						<th>Datum</th>
                    				<th>Beskrivning</th>
						<th>Summa</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
					<tr>
						<th>ID</th>
						<th>Datum</th>
                    				<th>Beskrivning</th>
						<th>Summa</th>
                    			</tr>
                                    </tfoot>
                                    <tbody>
					<? 		
					// LOOPS RS AND PRINTS TABLE
					while ($arrRow = mysqli_fetch_row($arrRS)) {
									
					// PUT RS IN VARS
					$rowID		= $arrRow[0];
					$rowInvoiceID	= $arrRow[1];
					$rowDate	= !empty($arrRow[2]) ? date("Y-m-d H:i",$arrRow[2]) : $gloNULL;
					$rowAmount	= $arrRow[3];
					$rowText	= $arrRow[4];
				
					if ($rowInvoiceID > 0) { 
					$rowInvoiceTEXT = " #".$rowInvoiceID;
					} else { $rowInvoiceTEXT = ""; }

					if (strpos($rowAmount, '-') === 0) {
						$rowColor = "#e74a3b";
					} else {
						$rowColor = "#1cc88a";
					}

                    $SHOWAMOUNT = number_format($rowAmount,2);
			

					// PRINTS ROW IN TABLE
					echo "
					<tr>
					<td>$rowID</td>
					<td>$rowDate</td>
					<td>$rowText $rowInvoiceTEXT</td>
					<td style='text-align:right; color:$rowColor;'>$SHOWAMOUNT SEK</td>
					</tr>";
			
					}
					?>
			    	    </tbody>
                                 </table>
				<? } ?>	<? echo $gloBackButton; ?>
                            </div>
			

                        
                    </div>
</div>
<!-- End content -->
<? } ?>