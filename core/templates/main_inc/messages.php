   <style>
       .header .message-menu {
           height: auto;
       }
   </style>



   <?

    // CHECK HOW MANY NEW MESSAGES
    $strSQLNEW = "SELECT * FROM data_messages WHERE touid = '$gloUID' AND opened = '0'";
    $resultsNEW = mysqli_query($SQLlink, $strSQLNEW);
    $CHECKNEW = mysqli_num_rows($resultsNEW);

    if (empty($CHECKNEW)) {
        $CHECKNEW = 0;
    }

    ?>

   <div class="dropdown  d-flex message">
       <a class="nav-link icon text-center" data-bs-toggle="dropdown">
           <i class="fe fe-message-square jtooltip" title="Nya meddelanden"></i>
           <span class="badge bg-dark header-badge"><? echo $CHECKNEW; ?></span>
       </a>
       <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
           <div class="drop-heading border-bottom">
               <div class="d-flex">
                   <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Meddelande Center</h6>
               </div>
           </div>
           <div class="message-menu message-menu-scroll">

               <?

                // GET LATEST MESSAGES
                $strSQL = "
	SELECT t1.id, 
     t1.fromuid, t1.touid, t1.header, t1.message, t1.opened, t1.openeddate, t1.date, t1.signature, t1.history,
     t2.user_fname, t2.user_sname, t2.user_img
	FROM data_messages as t1
    LEFT JOIN data_users AS t2 
	ON t1.fromuid = t2.id
	WHERE t1.touid = '$gloUID' 
	ORDER BY date DESC LIMIT 4";
                $arrRS = mysqli_query($SQLlink, $strSQL);


                // IF RS = TRUE THEN PRINT TABLE
                if (!mysqli_num_rows($arrRS)) { ?>
                   <div class="alert alert-info"><i class="fa-solid fa-circle-info"></i> Det finns inga meddelanden ännu.</div>
               <? } else {

                ?>

                   <?
                    // LOOPS RS AND PRINTS TABLE
                    while ($arrRow = mysqli_fetch_row($arrRS)) {

                        // PUT RS IN VARS
                        $MessID = $arrRow[0]; // id

                        $MessFromUID = $arrRow[1]; // fromuid
                        $MessToUID = $arrRow[2]; // touid
                        $MessHeader = $arrRow[3]; // header
                        $MessMessage = $arrRow[4]; // message
                        $MessOpen = !empty($arrRow[5]) ? Läst : "<i class='fa fa-exclamation-circle text-danger'></i> Ny"; // open
                        $MessOpen1 = $arrRow[5]; // open

                        $MessOpenDate = !empty($arrRow[6]) ? date("Y-m-d", $arrRow[6]) : $gloNULL; // openeddate              
                        $MessDate = !empty($arrRow[7]) ? date("Y-m-d", $arrRow[7]) : $gloNULL; // date
                        $MessSignature = $arrRow[8]; // signature
                        $MessHistory = $arrRow[9]; // signature

                        //USER DATA
                        $UserFName = $arrRow[10]; // user_fname
                        $UserSName = $arrRow[11]; // user_sname
                        $UserIMG = $arrRow[12]; // user_img              

                        if ($MessFromUID == 0) {

                            $UserFullname = "System";
                            $UserEmail = "";

                            if (empty($gloBrandProfileLogo)) {
                                $UserIMG = "nopic.png";
                            } else {
                                $UserIMG = $gloBrandProfileLogo;
                            }
                        } else {
                            $UserFullname = $UserFName . " " . $UserSName;
                            $UserEmail = "(" . $UserEmail . ")";
                            if (empty($UserIMG)) {
                                $UserIMG = "nopic.png";
                            }
                        }


                        if ($MessOpen1 == 1) {
                            $MHeader = $MessHeader;
                        } else {
                            $MHeader = "<b>" . $MessHeader . "</b>";
                        }

                        // PRINTS ROW IN TABLE
                    ?>
                       <div class="container">

                           <div class="row p-1">
                               <div class="col-2">
                                   <span class="avatar avatar-md brround me-3 align-self-center bg-light" data-image-src="<? echo $gloAvatarsDir; ?>/<? echo $UserIMG; ?>">
                                       <img src="<? echo $gloAvatarsDir; ?>/<? echo $UserIMG; ?>" alt="profile-user"> </a>
                                   </span>
                               </div>
                               <div class="col-10">
                                   <div class="wd-90p">
                                        <a href="<? echo $gloBase; ?>account&show=messages">
                                            <h5 class="mb-1"><? echo $MHeader; ?></h5>
                                            <small class="text-muted ms-auto text-end">
                                                <? echo $MessOpen; ?> · <? echo $UserFullname; ?> · <? echo $MessDate; ?>
                                            </small>
                                        </a>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <!-- <a class="dropdown-item d-flex pb-3" href="<? echo $gloBase; ?>account&show=messages">
                           <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-image-src="<? echo $gloAvatarsDir; ?>/<? echo $UserIMG; ?>">
                               <img src="<? echo $gloAvatarsDir; ?>/<? echo $UserIMG; ?>" alt="profile-user"> </a>
                       </span>
                       <div class="wd-90p">
                           <div class="d-flex">
                               <h5 class="mb-1"><? echo $MHeader; ?></h5>

                           </div>
                           <small class="text-muted ms-auto text-end">
                               <? echo $MessOpen; ?> · <? echo $UserFullname; ?> · <? echo $MessDate; ?>
                           </small>
                       </div>
                       </a> -->


                       <? } ?><? } ?>

                       <div class="dropdown-divider m-0"></div>
                       <a href="<? echo $gloBase; ?>account&show=messages" class="dropdown-item text-center">Visa alla meddelanden</a>
           </div>
       </div>
   </div>