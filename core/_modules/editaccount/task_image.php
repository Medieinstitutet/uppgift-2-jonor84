<?php
	if (isset($_POST['BID'])) {		
		$BID			= mysqli_real_escape_string($SQLlink,$_POST['BID']);
		$MAXFILESIZE		= mysqli_real_escape_string($SQLlink,$_POST['MAX_FILE_SIZE']);

		$FileLogo		= $_FILES['uploadedfile']['name'];

		$strSQL = "
		UPDATE data_users 
		SET
		 user_img_date = '$gloTimeStamp'
		WHERE id = '$gloUID' 
		LIMIT 1";
		mysqli_query($SQLlink,$strSQL);

		$checkFirst = intval(mysqli_affected_rows($SQLlink));

		// CHECK IF LOGO IS NOT EMPTY
		if(file_exists($_FILES['uploadedfile']['tmp_name']) || is_uploaded_file($_FILES['uploadedfile']['tmp_name'])) {	
				$uploadError = 0;
				$FileLogo = date('Ymd_His'). '_' .$FileLogo;
				$target = $gloAvatarsPath;
				$targetfile = $target . $FileLogo;
				$imageFileType = strtolower(pathinfo($targetfile,PATHINFO_EXTENSION));
			
			// Check file size
			if ($_FILES["uploadedfile"]["size"] > $MAXFILESIZE) {
  				$ErrorDetail = "Profilbildens filstorlek är för stor. MAX 1 GB";
  				$uploadError = 1;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
    				$ErrorDetail = "Felaktigt filformat på Profilbilden. Endast JPG, JPEG, PNG & GIF är tillåtna.";
  				$uploadError = 1;
			}

			// Check if upload Ok
			if ($uploadError > 0) {
			 	$_SESSION['error'] = "Det uppstod ett fel när din profilbild skulle laddas upp. ".$ErrorDetail;
			} else {

  				if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $targetfile)) {

					$strSQLLogo = "
					UPDATE data_users 
					SET
					 user_img = '$FileLogo' 
					WHERE id = '$gloUID' 
					LIMIT 1";
					mysqli_query($SQLlink,$strSQLLogo);

    					$checkLogoUp = "Profilbild har laddats upp.";

  				} else {
    					$_SESSION['error'] = "Det uppstod ett fel när din profilbild skulle laddas upp. Felkod: S-P001";
  				}
			}

		} 

		if ($checkFirst) {

				// INSERT EVENT IN LOG
				$Event = "updateprofile";
				$Notes = "Profilbilden uppdaterades av användaren.";
				addLog($Event, $Notes);

			$_SESSION['success'] = "Profilbilden uppdaterades utan problem. ".$checkLogoUp;
			header("Location: $gloBaseModule");

		} else {
			$_SESSION['error'] = "Profilbilden kunde inte uppdateras korrekt.";
			header("Location: $gloBaseModule");
		}
	}
?>