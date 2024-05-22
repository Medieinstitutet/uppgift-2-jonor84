

<?php
// *** ***********************
// *** MODULE:  SYS ADMINPANEL
// *** ***********************
// MODULE SETTINGS IS ALREADY LOADED AUTO

// GET ID FROM QUERYSTRING
$intID = intval($_GET['id']);

// CHECK ACCESS
if ($gloClientAccessLevel < $intAccess) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {

	if (!$_SESSION["service"]) {
		$_SESSION["service"] = "sys";
		$_SESSION["THEME"] = "default";
		header("Refresh:0; url=/dashboard");
	} else if ($_SESSION["service"] == "sys") {
	} else {
		$_SESSION["service"] = "sys";
		$_SESSION["THEME"] = "default";
		header("Refresh:0; url=/dashboard");
	}


	// SHOW MODULE CONTENTS
	if ($GETSHOW) {
		include_once('show_' . $GETSHOW . '.php');
	}
	// DO MODULE TASKS
	else if ($GETTASK) {
		include_once('task_' . $GETTASK . '.php');
	} else {

		include_once('show_start.php');
	}
}
?>
