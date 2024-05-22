		<? // CHECK IF USER HAS A BUSINESS CREATED OR CREATE IT
    //checkClient($gloUID);

    if ($gloBANKID == 0) {
      if ($gloTempPass == "Y") {
        header("location: /profile&show=passwordnew");
      }
    }

    if ($gloUserNew || $gloUserNewClient) {
      echo "<div class='$alertError'>$gloWrongAccess</div>";
    } else {
    ?>

		<!-- Begin content -->
		<div class="row">
		    <div class="col-xl-12 col-md-6 mb-4">
		        <div class="card mb-4">
		            <!-- Card Header - Dropdown -->
		            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		                <h3 class="m-0 font-weight-bold brand-title">
		                    <? echo $strHeader; ?> / Min Profil
		                </h3>
		            </div>
		            <!-- Card Body -->
		            <div class="card-body">

		                <div class="row">
		                    <div class="col-md-auto">
		                        <a href="<? echo $gloBaseModule; ?>&show=image"><img src="<? echo $gloAvatarsDir . " /" .
		                                $gloUserPic; ?>" alt="
		                            <? echo $rowFName . " " . $rowSName; ?>" class="img-thumbnail" style="border-radius:
		                            50%;max-width:200px;">
		                        </a>
		                    </div>
		                    <div class="col-md-auto">
		                        <h4>
		                            <? echo $rowWorktitle; ?>
		                        </h4>
		                        <h4><b>
		                                <? echo $rowFName . " " . $rowSName; ?>
		                            </b></h4>
		                        <br>
		                        <p>E-post: <a href="mailto:<? echo $rowEMail; ?>">
		                                <? echo $rowEMail; ?>
		                            </a>
		                            <br> Telefon:
		                            <? echo $rowPhone; ?>
		                            <!-- <br>
						Adress: <? echo $rowAdress; ?>, <? echo $rowZip . " " . $rowCity; ?>-->
		                        </p>
		                        <p><small>
		                                <!--Standardprofil vid inloggning: <? echo $gloDefaultProfile; ?><br>-->
		                                Användaren skapad:
		                                <? echo $gloUserAdded; ?><br>
		                                Senaste inloggning:
		                                <? echo $gloUserLastLogin; ?>
		                            </small>
		                        </p>
		                    </div>
		                </div>
		                <hr>

		                <div class="btn-group flex-wrap" role="group" style="padding-top:0px;">
		                    <a href="<? echo $gloBaseModule; ?>&show=contact" class="btn brand-button"><i
		                            class="fas fa-pen"></i> Ändra Profil</a>
		                    <a href="<? echo $gloBaseModule; ?>&show=image" class="btn btn-light"><i
		                            class="fas fa-user-circle"></i> Ändra Bild</a>
		                    <a href="<? echo $gloBaseModule; ?>&show=password" class="btn btn-light"><i
		                            class="fas fa-key"></i> Ändra Lösenord</a>
		                </div>


		            </div>
		        </div>
		    </div>
		</div>
		<!-- End content -->
		<? } ?>