<?php
if ($gloAccess < 7) {
  echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
  $intID = intval($_GET['id']);

  // SHOW SERVICE
  $TASKID = mysqli_real_escape_string($SQLlink, $_GET['id']);
  $strSQL = "
		 SELECT 
          t1.id,
          t1.cid, t1.rid, t1.sid, t1.csid, t1.typeid, t1.usernotes, t1.adminnotes, 
          t1.added, t1.addeduid, t1.updated, t1.updateduid, t1.text, t1.done, t1.uid, 
          t2.companyname,
          t3.companyname,
          t4.name,
          t5.se_name, t5.en_name,
          t6.se_name, t6.en_name,
		  t7.user_fname, t7.user_sname
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
		 LEFT JOIN data_users AS t7 
		 ON t1.uid = t7.id 
         WHERE t1.id = $TASKID
		 ";

  $arrRS = mysqli_query($SQLlink, $strSQL);

  while ($arrRow = mysqli_fetch_row($arrRS)) {
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
    $rowUID = $arrRow[14]; // t1.uid  

    // CLIENT DATA
    $ClientName = $arrRow[15]; // t2.companyname

    // RESELLER DATA
    $ResellerName = $arrRow[16]; // t3.companyname             

    // MYSERVICE DATA - CLIENTS SERVICE 
    $MyServiceName = $arrRow[17]; // t4.name                          

    // SERVICE TYPE DATA
    $TypeNameSE = $arrRow[18]; // t5.se_name
    $TypeNameEN = $arrRow[19]; // t5.en_name  

    // SERVICES DATA
    $ServiceNameSE = $arrRow[20]; // t6.se_name
    $ServiceNameEN = $arrRow[21]; // t6.en_name     

    // USERS DATA
    $UserFullname = $arrRow[22] . " " . $arrRow[23]; // t7.user_fname,  t7.user_sname
    if ($rowUID == 0) {
      $UserFullname = "System";
    }

    if ($rowDone) {
      $ModuleLink = "task_show";
      $Color = "#ccffd7";
    } else {
      $ModuleLink = "task_edit";
      $Color = "";
    }
  }
?>

  <!-- Begin content -->
  <div class="row">
    <div class="col-xl-12 col-md-6 mb-4">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Uppgift <? echo $rowID; ?></h4>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <h3>Uppgift gällande <? echo $ServiceNameSE; ?></h3>
          <div class='<? echo $alertSuccess; ?>'>Denna Uppgift är klar och stängd.</div>


          <div class="table-responsive">
            <table class="table table-striped" style="white-space:nowrap; margin-bottom: 0px;" width="100%">
              <thead>
                <tr>
                  <th scope="col" width="20%">#</th>
                  <th scope="col" width="80%">Data</th>
                </tr>
              </thead>
              <tbody>

                <tr>
                  <th scope="row">Skapades:</th>
                  <td><? echo $rowAdded; ?></td>
                </tr>
                <tr>
                  <th scope="row">Tjänst:</th>
                  <td><? echo $TypeNameSE; ?> / <? echo $ServiceNameSE; ?></td>
                </tr>
                <tr>
                  <th scope="row">Namn2:</th>
                  <td><? echo $MyServiceName; ?></td>
                </tr>
                <tr>
                  <th scope="row">ÅF / Kund:</th>
                  <td><? echo $ResellerName; ?> / <? echo $ClientName; ?></td>
                </tr>
                <tr>
                  <th scope="row">Skapare / Beställare:</th>
                  <td><? echo $UserFullname; ?></td>
                </tr>
                <tr>
                  <th scope="row">Att göra:</th>
                  <td><? echo $rowText; ?></td>
                </tr>

                <tr>
                  <th scope="row">Slutförd:</th>
                  <td>
                    <? if ($rowDone == 1) {
                      $ActiveService = "Slutförd";
                    } else {
                      $ActiveService = "Pågående";
                    } ?>
                    <? echo $ActiveService; ?>
                  </td>
                </tr>

                <tr>
                  <th scope="row">Kund Notering:</th>
                  <td><? echo $rowNotes; ?></td>
                </tr>
                <tr>
                  <th scope="row">Admin Notering:</th>
                  <td><textarea class="form-control" rows="5" name="frmANotes" disabled><? echo $rowANotes; ?></textarea></td>
                </tr>

              </tbody>
            </table>
            <? echo $HRB; ?>
            <a class='<? echo $btnLight; ?>' href='<? echo $gloBaseModule; ?>&show=tasks'><i class='fas fa-arrow-circle-left'></i> Tillbaka</a>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End content -->

  <? } ?>