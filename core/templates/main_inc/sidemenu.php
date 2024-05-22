<style>
	.slide a:hover {
		background: linear-gradient(to left, #F9F9F9, #ffffff) !important;
	}

	.slide li a:active {
		background: linear-gradient(to left, #9853af, #623AA2) !important;
	}
</style>

<?

if ($GETMODULE == "default") {
	$LINKACTIVE_D = "active";
} else if ($GETMODULE == "sites") {
	$LINKACTIVE_S = "active";
} else if ($GETMODULE == "apps") {
	$LINKACTIVE_A = "active";
} else if ($GETMODULE == "support") {
	$LINKACTIVE_SUPPORT = "active";
} else if ($GETMODULE == "gameplaces") {
	$LINKACTIVE_G = "active";
} else if ($GETMODULE == "organizer" || $GETMODULE == "account") {
	$LINKACTIVE_B_O = "active";
	$LINKACTIVE_ACCOUNT = "active";
}

// $LINKACTIVE_CLOUDAPPS
// $LINKACTIVE_SUBACCOUNTS
// $LINKACTIVE_ORGANISATIONS

?>

<? if ($ServiceNameActive) { ?>
	<li class="slide2">
		<a class="side-menu__item">
			<span class="side-menu__label1">
				<h4 style="margin-bottom: -1px; font-weight: bold;"><? echo $SERVICENAME; ?> </h4>
			</span>
		</a>
	</li>
	<hr style="border: 1px solid #d9d9d9; margin: 0px;">
<? } ?>

<? if ($_SESSION["service"] == "rs") { ?>


	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_D; ?>" data-toggle="slide" href="<? echo $gloBase; ?>dashboard">
			<i class="side-menu__icon fa-fw fa fa-tachometer-alt brand-title"></i>
			<span class="side-menu__label">Dashboard</span>
			<i class="angle fa-fw fa fa-angle-right"></i></a>
	</li>
	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_S; ?>" data-toggle="slide" href="<? echo $gloBase; ?>rs&show=menuinfo">
			<i class="side-menu__icon fa-fw fas fa-file-alt brand-title"></i>
			<span class="side-menu__label">Information</span>
			<i class="angle fa-fw fa fa-angle-right"></i></a>
	</li>
	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_A; ?>" data-toggle="slide" href="<? echo $gloBase; ?>rs&show=menuoffice">
			<i class="side-menu__icon fa-fw fas fa-file-invoice hor-icon brand-title"></i>
			<span class="side-menu__label">Webbkontoret</span>
			<i class="angle fa-fw fa fa-angle-right"></i></a>
	</li>

	<li class="slide">
		<a class="side-menu__item" data-toggle="slide" href="<? echo $gloBase; ?>rs&show=menuservices">
			<i class="side-menu__icon fa-fw fas fa-cloud hor-icon brand-title"></i>
			<span class="side-menu__label">Tjänster</span>
			<i class="angle fa-fw fa fa-angle-right"></i>
		</a>
	</li>
	<li class="slide">
		<a class="side-menu__item" data-toggle="slide" href="<? echo $gloBase; ?>rs&show=menuusers">
			<i class="side-menu__icon fa-fw fas fa-user hor-icon brand-title"></i>
			<span class="side-menu__label">Användare</span>
			<i class="angle fa-fw fa fa-angle-right"></i>
		</a>
	</li>
	<li class="slide">
		<a class="side-menu__item" data-toggle="slide" href="<? echo $gloBase; ?>rs&show=menusettings">
			<i class="side-menu__icon fa-fw fas fa-tools hor-icon brand-title"></i>
			<span class="side-menu__label">Inställningar</span>
			<i class="angle fa-fw fa fa-angle-right"></i>
		</a>
	</li>
	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_SUPPORT; ?>" data-toggle="slide" href="<? echo $gloBase; ?>support">
			<i class="side-menu__icon fa-fw far fa-life-ring hor-icon brand-title"></i>
			<span class="side-menu__label">Support</span>
			<i class="angle fa-fw fa fa-angle-right"></i>
		</a>
	</li>

	<hr style="border: 1px solid #d9d9d9; margin: 0px;">
	<li class="slide bg-lightblue">
		<a class="side-menu__item" data-toggle="slide" href="<? echo $gloBase; ?>close">
			<i class="side-menu__icon fa-fw fas fa-angle-double-left brand-title"></i>
			<span class="side-menu__label"><b>Till <? echo $gloMainBrandSiteName; ?> Start</b></span>
		</a>
	</li>

<? } ?>


<? if ($_SESSION["service"] == "sys") { ?>


	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_D; ?>" data-toggle="slide" href="<? echo $gloBase; ?>dashboard">
			<i class="side-menu__icon fa-fw fa fa-tachometer-alt brand-title"></i>
			<span class="side-menu__label">Dashboard</span>
			<i class="angle fa-fw fa fa-angle-right"></i></a>
	</li>
	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_S; ?>" data-toggle="slide" href="<? echo $gloBase; ?>sys&show=menuinfo">
			<i class="side-menu__icon fa-fw fas fa-file-alt brand-title"></i>
			<span class="side-menu__label">Information</span>
			<i class="angle fa-fw fa fa-angle-right"></i></a>
	</li>
	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_A; ?>" data-toggle="slide" href="<? echo $gloBase; ?>sys&show=menuoffice">
			<i class="side-menu__icon fa-fw fas fa-file-invoice hor-icon brand-title"></i>
			<span class="side-menu__label">Webbkontoret</span>
			<i class="angle fa-fw fa fa-angle-right"></i></a>
	</li>
	<li class="slide">
		<a class="side-menu__item" data-toggle="slide" href="<? echo $gloBase; ?>sys&show=menuservices">
			<i class="side-menu__icon fa-fw fas fa-cloud hor-icon brand-title"></i>
			<span class="side-menu__label">Tjänster</span>
			<i class="angle fa-fw fa fa-angle-right"></i>
		</a>
	</li>

	<li class="slide">
		<a class="side-menu__item" data-toggle="slide" href="<? echo $gloBase; ?>sys&show=menuusers">
			<i class="side-menu__icon fa-fw fas fa-user hor-icon brand-title"></i>
			<span class="side-menu__label">Användare</span>
			<i class="angle fa-fw fa fa-angle-right"></i>
		</a>
	</li>
	<li class="slide">
		<a class="side-menu__item" data-toggle="slide" href="<? echo $gloBase; ?>sys&show=menusettings">
			<i class="side-menu__icon fa-fw fas fa-tools hor-icon brand-title"></i>
			<span class="side-menu__label">Inställningar</span>
			<i class="angle fa-fw fa fa-angle-right"></i>
		</a>
	</li>

	<hr style="border: 1px solid #d9d9d9; margin: 0px;">
	<li class="slide bg-lightblue">
		<a class="side-menu__item" data-toggle="slide" href="<? echo $gloBase; ?>close">
			<i class="side-menu__icon fa-fw fas fa-angle-double-left brand-title"></i>
			<span class="side-menu__label"><b>Till <? echo $gloMainBrandSiteName; ?> Start</b></span>
		</a>
	</li>

<? } ?>

<? if ($_SESSION["service"] == "account2") { ?>
	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_ACCOUNT; ?>" data-toggle="slide" href="<? echo $gloBase; ?>account2">
			<i class="side-menu__icon fa fa-fw fa-user-circle brand-title"></i>
			<span class="side-menu__label">Mitt Konto</span>
			<i class="angle fa fa-angle-right"></i></a>
	</li>

	<!-- <li class="slide">
							<a class="side-menu__item <? echo $LINKACTIVE_CLOUDAPPS; ?>" data-toggle="slide" href="<? echo $gloBase; ?>clouds">
							<i class="side-menu__icon fas fa-cloud"></i>
							<span class="side-menu__label">Anslutna Molnappar</span>
							<i class="angle fa fa-angle-right"></i></a>
						</li> -->

	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_SUBACCOUNTS; ?>" data-toggle="slide" href="<? echo $gloBase; ?>account2&show=subaccounts">
			<i class="side-menu__icon fas fa-fw fa-users brand-title"></i>
			<span class="side-menu__label">Underkonton</span>
			<i class="angle fa fa-angle-right"></i></a>
	</li>
	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_ORGANISATIONS; ?>" data-toggle="slide" href="<? echo $gloBase; ?>account2&show=organisations">
			<i class="side-menu__icon fa fa-fw fa-sitemap brand-title"></i>
			<span class="side-menu__label">Mina Organisationer</span>
			<i class="angle fa fa-angle-right"></i></a>
	</li>



	<li class="slide">
		<a class="side-menu__item" data-toggle="slide" href="<? echo $gloBase; ?>account2&show=log">
			<i class="side-menu__icon fa fa-fw fa-list-alt brand-title"></i>
			<span class="side-menu__label">Min Aktivitetslogg</span>
			<i class="angle fa fa-angle-right"></i></a>
	</li>

	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_SUPPORT; ?>" data-toggle="slide" href="<? echo $gloBase; ?>support">
			<i class="side-menu__icon far fa-fw fa-life-ring hor-icon brand-title"></i>
			<span class="side-menu__label">Support</span>
			<i class="angle fa fa-angle-right"></i>
		</a>
	</li>
	<hr style="border: 1px solid #d9d9d9; margin: 0px;">
	<li class="slide bg-light">
		<a class="side-menu__item active" data-toggle="slide" href="<? echo $gloBase; ?>close">
			<i class="side-menu__icon fas fa-fw fa-angle-double-left brand-title"></i>
			<span class="side-menu__label"><b>Till <? echo $gloMainBrandSiteName; ?> Start</b></span>
		</a>
	</li>
<? } ?>


<? if (!$_SESSION["service"]) { ?>
<!-- If no fullwindow a sidemenu will appear -->

	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_D; ?>" data-toggle="slide" href="<? echo $gloBase; ?>dashboard">
			<i class="side-menu__icon fas fa-tachometer-alt hor-icon brand-title"></i>
			<span class="side-menu__label">Dashboard</span>
			<i class="angle fa fa-angle-right"></i></a>
	</li>

	
<? } ?>

<? if ($DateActive) { ?>
	<br>
	<li class="slide">
		<div class="side-menu__item" data-toggle="slide">
			<i class="side-menu__icon fas fa-clock hor-icon brand-title" title="<? echo date('Y-m-d'); ?>"></i>
			<span class="side-menu__label">
				<span id="datetime"></span>

				<script>
					// create a function to update the date and time
					function updateDateTime() {
						// create a new `Date` object
						const now = new Date();

						// get the current date and time as a string
						const currentDateTime = now.toLocaleString();

						// update the `textContent` property of the `span` element with the `id` of `datetime`
						document.querySelector('#datetime').textContent = currentDateTime;
					}

					// call the `updateDateTime` function every second
					setInterval(updateDateTime, 1000);
				</script>
			</span>
		</div>
	</li>
<? } ?>