<?php
// *** ***********************
// *** MODULE: 	New Account/Profile
// *** ***********************
// MODULE SETTINGS IS ALREADY LOADED AUTO


// CHECK ACCESS
if (!$gloUserNew) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
?>
	<?
	// OPEN SERVICE
	if (!$_SESSION["service"]) {
		$_SESSION["service"] = "newaccount";
		header("Refresh:0");
	} else if ($_SESSION["service"] != "newaccount") {
		$_SESSION["service"] = "newaccount";
		header("Refresh:0");
	}


	if ($gloUserNew) {
		$SHOWSTEPS = 0; // 1 usually
	} else if ($gloUserNewClient) {
		$SHOWSTEPS = 0; // 1 usually
	} else {
		$SHOWSTEPS = 0; // 0 usually
	}

	if ($SHOWSTEPS) {

		if ($GETSHOW == "new") {
			$STEP1DONE = "";
			$STEP1ACTIVE = "active";
			$STEP2DONE = "";
			$STEP2ACTIVE = "";
			$GLOWLINE1 = "glowline";
			$GLOWLINE2 = "";
		} else if ($GETSHOW == "newclient") {
			$STEP1DONE = "done";
			$STEP1ACTIVE = "";
			$STEP2DONE = "";
			$STEP2ACTIVE = "active";
			$GLOWLINE1 = "glowline";
			$GLOWLINE2 = "";
		}

	?>
		<div class="containerstep" style="">
			<section class="step-indicator">
				<? echo $Link1Start; ?>
				<div class="step step1 <? echo $STEP1DONE; ?> <? echo $STEP1ACTIVE; ?>">
					<div class="step-icon">1</div>
					<p class="text-primary">Konto</p>
				</div>
				<? echo $Link1End; ?>
				<div class="indicator-line <? echo $GLOWLINE1; ?>"></div>
				<? echo $Link2Start; ?>
				<div class="step step2 <? echo $STEP2DONE; ?> <? echo $STEP2ACTIVE; ?>">
					<div class="step-icon">2</div>
					<p class="text-primary">Kunduppgifter</p>
				</div>
				<? echo $Link2End; ?>
				<div class="indicator-line <? echo $GLOWLINE2; ?>"></div>
				<? echo $Link3Start; ?>
				<div class="step step3">
					<div class="step-icon">3</div>
					<p class="text-primary">Status</p>
				</div>
				<? echo $Link3End; ?>
			</section>
		</div>
		<br><br>
<? }



	// SHOW MODULE CONTENTS
	if ($GETSHOW) {
		include_once('show_' . $GETSHOW . '.php');
	}

	// DO MODULE TASKS
	else if ($GETTASK) {
		include_once('task_' . $GETTASK . '.php');
	} else {
		include("show_new.php");
	}
} ?>