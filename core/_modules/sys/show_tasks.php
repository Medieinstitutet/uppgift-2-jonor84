<?php
if ($gloAccess < 7) {
  echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {


  $strSQL = "
		 SELECT 
          t1.id,
          t1.cid, t1.rid, t1.sid, t1.csid, t1.typeid, t1.usernotes, t1.adminnotes, 
          t1.added, t1.addeduid, t1.updated, t1.updateduid, t1.text, t1.done, 
          t2.companyname,
          t3.companyname,
          t4.name,
          t5.se_name, t5.en_name,
          t6.se_name, t6.en_name
		 FROM data_tasks AS t1
		 LEFT JOIN data_clients AS t2 
		 ON t1.cid = t2.id
		 LEFT JOIN data_resellers AS t3 
		 ON t1.rid = t3.id 
		 LEFT JOIN data_myservices AS t4 
		 ON t1.csid = t4.id
		 LEFT JOIN data_servicetypes AS t5 
		 ON t1.typeid = t5.id         
         LEFT JOIN data_services AS t6 
		 ON t1.sid = t6.id 
		 ORDER BY t1.id DESC";
  $arrRS = mysqli_query($SQLlink, $strSQL);

  // DEBUG
  //if ($gloAccess==9) { echo "<div class='debug'>".$strSQL."</div>"; }
?>

  <!-- Begin content -->

  <!-- DataTables -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Uppgifter</h4>
      <div class="dropdown no-arrow">

      </div>
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
                <th>Uppgift</th>
                <th>Tjänst</th>
                <th>ÅF / Kund</th>
                <th>Skapad</th>
                <th>Åtgärd</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Uppgift</th>
                <th>Tjänst</th>
                <th>ÅF / Kund</th>
                <th>Skapad</th>
                <th>Åtgärd</th>
              </tr>
            </tfoot>
            <tbody>
              <?
              // LOOPS RS AND PRINTS TABLE
              while ($arrRow = mysqli_fetch_row($arrRS)) {

                // PUT RS IN VARS
                // TASKS DATA
                $rowID = $arrRow[0]; // t1.id 

                $rowCID = $arrRow[1]; // t1.cid
                $rowRID = $arrRow[2]; // t1.rid
                $rowSID = $arrRow[3]; // t1.sid 
                $rowCSID = $arrRow[4]; // t1.csid
                $rowTypeID = $arrRow[5]; // t1.typeid
                $rowNotes = $arrRow[6]; // t1.usernotes
                $rowANotes = $arrRow[7]; // t1.adminnotes

                $rowAdded = date('Y-m-d H:i', $arrRow[8]); //  t1.added
                $rowAddedUID = $arrRow[9]; // t1.addeduid  
                $rowUpdated = date('Y-m-d H:i', $arrRow[10]); // t1.updated
                $rowUpdatedUID = $arrRow[11]; // t1.updateduid  

                $rowText = $arrRow[12]; // t1.text  
                $rowDone = $arrRow[13]; // t1.done  

                // CLIENT DATA
                $ClientName = $arrRow[14]; // t2.companyname

                // RESELLER DATA
                $ResellerName = $arrRow[15]; // t3.companyname             

                // MYSERVICE DATA - CLIENTS SERVICE 
                $MyServiceName = $arrRow[16]; // t4.name                          

                // SERVICE TYPE DATA
                $TypeNameSE = $arrRow[17]; // t5.se_name
                $TypeNameEN = $arrRow[18]; // t5.en_name  

                // SERVICES DATA
                $ServiceNameSE = $arrRow[19]; // t6.se_name
                $ServiceNameEN = $arrRow[20]; // t6.en_name    

                if ($rowDone) {
                  $ModuleLink = "task_show";
                  $Color = "#ccffd7";
                } else {
                  $ModuleLink = "task_edit";
                  $Color = "";
                }

                // PRINTS ROW IN TABLE
                echo "
					<tr>
					 <td style='background: $Color;'><a href='$gloBaseModule&show=$ModuleLink&id=$rowID' title='Se order'>$rowID</a></td>
					 <td style='background: $Color;'>$rowText</td>
					 <td style='background: $Color;'>$TypeNameSE / $ServiceNameSE</td>
					 <td style='background: $Color;'>$ResellerName / $ClientName</td>
					 <td style='background: $Color;'>$rowAdded</td>
					 <td style='background: $Color;'>
                      <a href='$gloBaseModule&show=$ModuleLink&id=$rowID'><i class='fas fa-file-alt' title='Se order'></i></a>
				     </td>
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