<? if ($SystemAdmin) { ?>
	<?

	$APPLINK1 = "";
	$APPLINKICON = "";
	$APPLINKTITLE = "";

	$APPLINK2 = "";
	$APPLINK2ICON = "";
	$APPLINK2TITLE = "";

	if ($_GET['wis']) {
		$INVOICEID = $_GET['wis'];
	} else if ($_GET['wic']) {
		$INVOICEID = $_GET['wic'];
	} else if ($_GET['wid']) {
		$INVOICEID = $_GET['wid'];
		$APPLINK1 = "wia";
		$APPLINKICON = "fas fa-edit";
		$APPLINKTITLE = "Ändra";
	} else if ($_GET['wia']) {
		$INVOICEID = $_GET['wia'];
		$APPLINK1 = "wid";
		$APPLINKICON = "fas fa-search";
		$APPLINKTITLE = "Förhandsgranska";

		$APPLINK2 = "send";
		$APPLINK2ICON = "fas fa-paper-plane";
		$APPLINK2TITLE = "Skicka";
	}
	?>
	<? if ($APPLINK2) { ?>
		<!-- SEND BUTTON -->
		<div class="dropdown d-flex">
			<a href='#' data-id='SendInv' data-bs-toggle='modal' data-bs-target='#Modal-SendInv' class="nav-link text-center">
				<i class="<? echo $APPLINK2ICON; ?> fa-2xl" title="<? echo $APPLINK2TITLE; ?>"></i>
			</a>
		</div>
	<? } ?>
	<? if ($APPLINK1) { ?>
		<!-- PREVIEW BUTTON -->
		<div class="dropdown d-flex">
			<a href="<? echo $gloBase; ?>irs&<? echo $APPLINK1; ?>=<? echo $INVOICEID; ?>" class="nav-link text-center">
				<i class="<? echo $APPLINKICON; ?> fa-2xl" title="<? echo $APPLINKTITLE; ?>"></i>
				<!--<span class="badgetext badge badge-dark text-white">Stäng</span>-->
			</a>
		</div>
	<? } ?>
<? } ?>
<!-- CLOSE BUTTON -->
<? if ($SERVICENAME != "Start") { ?>
	<div class="dropdown d-md-flex"> <a href="<? echo $gloBase; ?>close" class="nav-link text-center">
			<i class="fas fa-times-circle fa-2xl branding-text" title="Stäng / Tillbaka till <? echo $gloBrandSiteName; ?> Start"></i>
			<!--<span class="badgetext badge badge-dark text-white">Stäng</span>-->


		</a> </div>
<? } ?>