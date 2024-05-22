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
} 

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

<? if ($_SESSION["service"] == "sys") { ?>


	<li class="slide">
		<a class="side-menu__item <? echo $LINKACTIVE_D; ?>" data-toggle="slide" href="<? echo $gloBase; ?>dashboard">
			<i class="side-menu__icon fa-fw fa fa-tachometer-alt brand-title"></i>
			<span class="side-menu__label">Dashboard</span>
			<i class="angle fa-fw fa fa-angle-right"></i></a>
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