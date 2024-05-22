<?php
	if ($gloAccess < 8) { echo "<div class='$alertError'>$gloWrongAccess</div>"; }
	else {				
		$strSQL = "
		SELECT id, namn, updated  
		FROM data_landskap
		ORDER BY id ASC";
		$arrRS = mysqli_query($SQLlink,$strSQL);
		// DEBUG
		//if ($gloAccess==9) { echo "<div class='debug'>".$strSQL."</div>"; }
?>


<!-- Begin content -->

     <!-- DataTables -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" >
                            <h6 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Landskap</h6>
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
			                    <th>Namn</th>
                    			    <th>Uppdaterad</th>
                    			    <th>Åtgärd</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
					<tr>
					    <th>ID</th>
			                    <th>Namn</th>
                    			    <th>Uppdaterad</th>
                    			    <th>Åtgärd</th>
                    			</tr>
                                    </tfoot>
                                    <tbody>
					<? 		
					// LOOPS RS AND PRINTS TABLE
					while ($arrRow = mysqli_fetch_row($arrRS)) {
									
					// PUT RS IN VARS
					$rowID		= $arrRow[0];
					$rowName	= (!empty($arrRow[1])) ? $arrRow[1] : $gloNULL;
					$rowUpdated	= date("Y-m-d",$arrRow[2]);

					// PRINTS ROW IN TABLE
					echo "
					<tr>
						<td>$rowID</td>
						<td><a href='$gloBaseModule&show=states_edit&id=$rowID' title='&Auml;ndra'>$rowName</a></td>
						<td>$rowUpdated</td>
						<td><a href='$gloBaseModule&show=states_edit&id=$rowID' title='&Auml;ndra'><i class='far fa-edit' title='Ändra'></i></a></td>
					</tr>";
					}
					?>
			    	    </tbody>
                                 </table>
				<? } ?>
                      

                      
                    </div></div>

</div>
<!-- End content -->
<? } ?>