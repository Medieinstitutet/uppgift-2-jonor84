<?php

		$strSQL = "
		UPDATE data_users 
		SET
		 user_img = '',
		 user_img_date = '$gloTimeStamp'
		WHERE id = '$gloUID' 
		LIMIT 1";
		mysqli_query($SQLlink,$strSQL);
			
		$checkFirst = intval(mysqli_affected_rows($SQLlink));
			
			if ($checkFirst) 	{ 

				// INSERT EVENT IN LOG
				$Event = "updateprofile";
				$Notes = "Profilbilden togs bort av användaren.";
				addLog($Event, $Notes);

				$_SESSION['success'] = "Profilbilden raderades utan problem.";
				header("Location: $gloBaseModule");
			}

			else {
				$_SESSION['error'] = "Profilbilden kunde inte raderas korrekt. Var god försök igen eller kontakta administratören.";
				header("Location: $gloBaseModule");
			}
?>