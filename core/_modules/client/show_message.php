<?php
if ($gloUserNew || $gloUserNewClient) {
  echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {

  $MESSAGEID = mysqli_real_escape_string($SQLlink, $_GET['id']);

  //MESSAGE OPENED
  $strSQLOPEN = "UPDATE data_messages SET opened='1',openeddate='$gloTimeStamp' WHERE id = '$MESSAGEID'";
  mysqli_query($SQLlink, $strSQLOPEN);


  $strSQL = "
	SELECT t1.id, 
     t1.fromuid, t1.touid, t1.header, t1.message, t1.opened, t1.openeddate, t1.date, t1.signature, t1.history,
     t2.user_fname, t2.user_sname, t2.user_img
	FROM data_messages as t1
    LEFT JOIN data_users AS t2 
	ON t1.fromuid = t2.id
	WHERE t1.id = '$MESSAGEID'
    AND t1.touid = '" . $gloUID . "' 
	ORDER BY date DESC";
  $arrRS = mysqli_query($SQLlink, $strSQL);

  // IF RS = TRUE THEN PRINT TABLE
  if (mysqli_num_rows($arrRS)) {

    // LOOPS RS AND PRINTS TABLE
    while ($arrRow = mysqli_fetch_row($arrRS)) {

      // PUT RS IN VARS
      $MessID = $arrRow[0]; // id

      $MessFromUID = $arrRow[1]; // fromuid
      $MessToUID = $arrRow[2]; // touid
      $MessHeader = $arrRow[3]; // header
      $MessMessage = $arrRow[4]; // message
      $MessOpen = !empty($arrRow[5]) ? Läst : "<i class='fa fa-exclamation-circle text-danger'></i> Ny"; // opened
      $MessOpenDate = !empty($arrRow[6]) ? date("Y-m-d", $arrRow[6]) : $gloNULL; // openeddate              
      $MessDate = !empty($arrRow[7]) ? date("Y-m-d H:i", $arrRow[7]) : $gloNULL; // date
      $MessSignature = $arrRow[8]; // signature
      $MessHistory = $arrRow[9]; // signature

      //USER DATA
      $UserFName = $arrRow[10]; // user_fname
      $UserSName = $arrRow[11]; // user_sname
      $UserIMG = $arrRow[12]; // user_img              

      $UserFullname = $UserFName . " " . $UserSName;
    }
  }

  if ($MessFromUID == 0) {

    $SENDBTN = "0";

    if (empty($gloBrandProfileLogo)) {
      $UserIMG = "no-profile-image.png";
    } else {
      $UserIMG = $gloBrandProfileLogo;
    }
  } else {
    $SENDBTN = "1";
    if (empty($UserIMG)) {
      $UserIMG = "no-profile-image.png";
    }
  }

  if (empty($UserSignature)) {
    $UserSignature = "Mvh, <br> <b>" . $UserFullname . "</b>";
  }


?>

  <!-- Begin content -->
  <div class="row">
    <div class="col-xl-12">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3">
          <h3 class="m-0 font-weight-bold brand-title">Mina Meddelanden / Meddelande: <? echo $MessHeader; ?></h3>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-auto"> <img src="<? echo $gloAvatarsDir . "/" . $UserIMG; ?>" alt="<? echo $rowFName . " " . $rowSName; ?>" class="img-thumbnail" style="border-radius: 50%;max-width:70px; padding:6px;"> </div>
            <div class="col-md-auto">

              <h4><b> <? echo $MessHeader; ?></b> <small>(<? echo $MessDate; ?>)</small></h4>

              <? echo $MessMessage; ?>
              <br><br>
              <? echo $MessSignature; ?>
              <br>
              <? echo $MessHistory; ?>
              <br>
            </div>
          </div>
          <hr>
          <? if ($SENDBTN) { ?>
            <a class="btn btn-primary" href="<? echo $gloBaseModule; ?>&show=respondmessage&id=<? echo $MessID; ?>"><i class="fas fa-pen"></i> Svara</a>
          <? } ?>
          <? echo $gloBackButton; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- End content -->
<? } ?>