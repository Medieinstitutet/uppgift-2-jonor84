

<?php
// *** ***********************
// *** MODULE:  NEWSLETTERS
// *** ***********************
// MODULE SETTINGS IS ALREADY LOADED AUTO

// GET ID FROM QUERYSTRING
$intID = intval($_GET['id']);

	if (!$_SESSION["service"]) {
		$_SESSION["service"] = "newsletters";
		$_SESSION["THEME"] = "default";
		header("Refresh:0; url=/newsletters");
	} else if ($_SESSION["service"] == "newsletters") {
	} else {
		$_SESSION["service"] = "newsletters";
		$_SESSION["THEME"] = "default";
		header("Refresh:0; url=/newsletters");
	}


	// SHOW MODULE CONTENTS
	if ($GETSHOW) {
		include_once('show_' . $GETSHOW . '.php');
	}
	// DO MODULE TASKS
	else if ($GETTASK) {
		include_once('task_' . $GETTASK . '.php');
	} else {

		include_once('show_newsletters.php');
	}
?>
