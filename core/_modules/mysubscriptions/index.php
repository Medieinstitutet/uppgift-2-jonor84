

<?php
// *** ***********************
// *** MODULE:  My Subscriptions
// *** ***********************
// MODULE SETTINGS IS ALREADY LOADED AUTO

// GET ID FROM QUERYSTRING
$intID = intval($_GET['id']);

	if (!$_SESSION["service"]) {
		$_SESSION["service"] = "mysubscriptions";
		$_SESSION["THEME"] = "default";
		header("Refresh:0; url=/mysubscriptions");
	} else if ($_SESSION["service"] == "mysubscriptions") {
	} else {
		$_SESSION["service"] = "mysubscriptions";
		$_SESSION["THEME"] = "default";
		header("Refresh:0; url=/mysubscriptions");
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
