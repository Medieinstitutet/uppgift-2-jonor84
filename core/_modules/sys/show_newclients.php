<?php
if ( $gloAccess < 7 ) {
  echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {    					
    
  $strSQL = "
		 SELECT t1.id,
		 t1.companyname,t1.contactname,t1.phone,t1.email,t1.active,
		 t1.countryid,t1.town,t1.added,t1.updated,
		 t1.userid,t1.afid,
		 t2.country_name,
		 t3.aid, t3.added, t3.updated,
		 t4.access_name,
		 t5.user_fname, t5.user_sname, t5.user_email
		 FROM data_clients AS t1 
		 LEFT JOIN data_countrys AS t2 
		 ON t1.countryid = t2.id 
		 LEFT JOIN data_clients_access AS t3 
		 ON t1.id = t3.cid 
		 LEFT JOIN data_access AS t4 
		 ON t3.aid = t4.id
		 LEFT JOIN data_users AS t5 
		 ON t1.orgadmin = t5.id 		 
		 WHERE orgnew = '1'
		 ORDER BY companyname 
		 ";
		$arrRS = mysqli_query($SQLlink,$strSQL);

  // DEBUG
  //if ($gloAccess==9) { echo "<div class='debug'>".$strSQL."</div>"; }
  ?>

<!-- Begin content -->

<!-- DataTables -->
<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" >
    <h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Nya Kundregistreringar</h4>
    <div class="dropdown no-arrow"> 
 
      </div>
  </div>
  
    <div class="card-body">
  <?php
  // IF RS = TRUE THEN PRINT TABLE
  if ( mysqli_num_rows( $arrRS ) ) {
    ?>

  
    <div class="table-responsive">
      <table class="table table-sm table-bordered table-striped display responsive" style="white-space:nowrap; margin-bottom: 0px;" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>KundID</th>
            <th>Organisation</th>
            <th>Administratör</th>
            <th>Inlagd</th>
            <th>Åtgärd</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>KundID</th>
            <th>Organisation</th>
            <th>Administratör</th>
            <th>Inlagd</th>
            <th>Åtgärd</th>
          </tr>
        </tfoot>
        <tbody>
          <?
          // LOOPS RS AND PRINTS TABLE
          while ( $arrRow = mysqli_fetch_row( $arrRS ) ) {

            // PUT RS IN VARS
					$rowID			= $arrRow[0];
					$rowCompany		= $arrRow[1];
					$rowContact		= $arrRow[2];
					$rowPhone		= $arrRow[3];
					$rowEmail		= $arrRow[4];
					$rowActive		= ($arrRow[5]) ? "Ja" : "Nej";
					$rowCountryID		= $arrRow[6];
					$rowTown 		= $arrRow[7];
					$rowDateAdded		= date('Y-m-d H:i',$arrRow[8]);
					$rowDateUpdated		= date('Y-m-d H:i',$arrRow[9]);
					$rowUserID		= $arrRow[10];
					$rowAFID		= $arrRow[11];
					
					$rowCountryName		= $arrRow[12];

					$AccessID			= $arrRow[13];
					$AccessAdded		= $arrRow[14];
					$AccessUpdated		= $arrRow[15];
					
					$AccessName			= $arrRow[16];
					$OrgAdminName		= $arrRow[17]." ".$arrRow[18];
					$OrgAdminEmail		= $arrRow[19];

            // PRINTS ROW IN TABLE
			echo "
					<tr>
					 <td>$rowID</td>
					 <td><a href='$gloBaseModule&id=$rowID&show=newclient_edit' title='Ändra Kunduppgifter'>$rowCompany</a></td>
					 <td><a href='mailto:$OrgAdminEmail'>$OrgAdminName</a></td>
					 <td>$rowDateAdded</td>
					 
					 <td>
					 <a href='$gloBaseModule&id=$rowID&show=newclient_edit'><i class='far fa-edit' title='Ändra'></i></a> 
					 <!--<a href='#' data-id='$rowID' data-toggle='modal' data-target='#delModal-$rowID'><i class='far fa-trash-alt' title='Radera'></i></a></td>-->

    					  <!-- CONFIRM DELETE Modal-->
    					  <div class='modal fade' id='delModal-$rowID' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        				   <div class='modal-dialog' role='document'>
            				    <div class='modal-content'>
                			   	<div class='modal-header'>
                    					 <h5 class='modal-title' id='exampleModalLabel'>Är du säker på att du vill ta bort?</h5>
                    					 <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                        				 <span aria-hidden='true'>×</span>
                    					</button>
                			   	</div>
                				<div class='modal-body'>ID: $rowID / Företag: $rowCompany</div>
                			 		<div class='modal-footer'>
		    					 <a class='btn btn-success' href='$gloBaseModule&task=user_delete&id=$rowID'>Ja</a>
                   					 <button class='btn btn-danger' type='button' data-dismiss='modal'>Avbryt</button>
                			 		</div>
            				    </div>
        				   </div>
   					  </div>

					</tr>";
          }
          ?>
        </tbody>
      </table>
      <? } else {
		echo "<div class='$alertInfo'><i class='fas fa-info-circle'></i> Det finns inga nya kundprofiler att gå igenom just nu.</div>";
		} ?>
      <hr>
      <? echo $gloBackButton; ?> 
	</div>
  </div>
</div>

<!-- End content -->
<? } ?>
