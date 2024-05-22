

<?php
// *** ***********************
// *** MODULE:  My Subscribers
// *** ***********************
// MODULE SETTINGS IS ALREADY LOADED AUTO

// GET ID FROM QUERYSTRING
$intID = intval($_GET['id']);

	if (!$_SESSION["service"]) {
		$_SESSION["service"] = "mysubscribers";
		$_SESSION["THEME"] = "default";
		header("Refresh:0; url=/mysubscribers");
	} else if ($_SESSION["service"] == "mysubscribers") {
	} else {
		$_SESSION["service"] = "mysubscribers";
		$_SESSION["THEME"] = "default";
		header("Refresh:0; url=/mysubscribers");
	}


	// SHOW MODULE CONTENTS
	if ($GETSHOW) {
		include_once('show_' . $GETSHOW . '.php');
	}
	// DO MODULE TASKS
	else if ($GETTASK) {
		include_once('task_' . $GETTASK . '.php');
	} else {

		include_once('show_subscribers.php');
	}
?>
