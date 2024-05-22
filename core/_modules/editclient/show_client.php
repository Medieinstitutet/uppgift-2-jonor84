<style>
	.profilecard {
		padding-right: 12px;
		padding-left: 12px;
	}
</style>
<?php
// *** ***********************
// *** MODULE: 	SHOWPROFILE -> Client
// *** ***********************
// CHECK ACCESS	 	

// if ($gloClientAccessLevel < 7) {
// 	echo "<div class='$alertError'>$gloWrongAccess</div>";
// } else {

// if ($CHECKCLIENT == 0) {
// 	echo "<div class='$alertInfo'>$gloMissingID</div>";
// } else {

?>

<!-- Begin content -->


<div class="row" id="user-profile">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body pt-0 profilecard">
				<div class="wideget-user mb-2">
					<div class="row">
						<div class="col-xl-12">
							<div class="row">
								<div class="panel profile-cover" style="padding: 0px;">
									<div class="profile-cover__action bg-img" style="background: url(<? echo $gloProfileBKGDir; ?>/<? echo $rowProfileBKG; ?>) no-repeat; background-size: cover;"></div>
									<div class="profile-cover__img">
										<div class="profile-img-1">
											<img src="<? echo $gloAvatarsDir; ?>/<? echo $rowImage; ?>" alt="img">
										</div>
										<div class="profile-img-content text-dark text-start">
											<div class="text-dark">
												<h3 class="h3 mb-2"><? echo $rowCompany; ?></h3>
												<h5 class="text-muted">ID: <? echo $rowClientID; ?></h5>
											</div>
										</div>
									</div>
									<div class="btn-profile">
										<!-- <button class="btn btn-secondary mt-1 mb-1"> <i class="fa fa-envelope"></i> <span>Skicka meddelande</span></button> -->
									</div>
								</div>
							</div>
							<div class="row">
								<div class="px-0 px-sm-4">
									<div class="social social-profile-buttons mt-5 float-end">

										<div class="mt-3">Visa:
											<a class="social-icon text-primary jtooltip" title="Visa Kund" href="client"><i class="fas fa-user-circle"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-xl-3">

		<div class="card">
			<div class="card-header py-3">
				<h3 class="m-0 font-weight-bold brand-title">Meny</h3>
			</div>
			<div class="card-body p-0">
				<? include 'editmenu.php'; ?>
			</div>
		</div>

		<div class="card">
			<div class="card-header py-3">
				<h3 class="m-0 font-weight-bold brand-title">Information</h3>
			</div>
			<div class="card-body">
				<div class="alert alert-<? echo $AlertBKG; ?> p-2">
					<span class="me-2 fw-bold text-dark">Status: </span><? echo $rowActive; ?> <br>
					<span class="me-2"><? echo $ClosedText; ?></span>
				</div>
				<p>Registrerad: <br><? echo $rowDateAdded; ?> </p>
				<p>Senast uppdaterad:<br> <? echo $rowDateUpdated; ?></p>
				<!-- <? echo $rowPresentation; ?> -->
			</div>
		</div>




	</div>
	<div class="col-xl-9">

		<?
		// SHOW MODULE CONTENTS
		if ($GETSHOW) {
			include_once('show_' . $GETSHOW . '.php');
		}

		// DO MODULE TASKS
		else if ($GETTASK) {
			include_once('task_' . $GETTASK . '.php');
		} else {
			include 'show_start.php';
		}

		?>
	</div>

</div>



<div class="row">
	<div class="col-xl-12">
		<div class="card mt-3">
			<div class="card-body">
				<? echo $gloBackButton; ?>
			</div>
		</div>
	</div>
</div>


<!-- End content -->





<?
// 	}
// 	// }
// }
?>