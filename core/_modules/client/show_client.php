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

										<div class="mt-3">Hantera:
											<a class="social-icon text-primary jtooltip" title="Ändra Kund" href="editclient"><i class="fas fa-user-edit"></i></a>
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
				<h3 class="m-0 font-weight-bold brand-title">Kontaktuppgifter</h3>
			</div>
			<div class="card-body py-3">
				<div class="d-flex align-items-center mb-3 mt-0">
					<div class="me-4 text-center text-primary">
						<span><i class="fas fa-user-tie fs-20"></i></span>
					</div>
					<div>
						<span class="font-weight-bold"><? echo $rowContact; ?></span>
					</div>
				</div>
				<div class="d-flex align-items-center mb-3 mt-3">
					<div class="me-4 text-center text-primary">
						<span><i class="fe fe-phone fs-20"></i></span>
					</div>
					<div>
						<strong><a href="tel:<? echo $rowPhone; ?>" title="phone link"><? echo $rowPhone; ?></a></strong>
					</div>
				</div>
				<div class="d-flex align-items-center mb-3 mt-3">
					<div class="me-4 text-center text-primary">
						<span><i class="fe fe-mail fs-20"></i></span>
					</div>
					<div>
						<strong><a href="mailto:<? echo $rowEmail; ?>" title="email link"><? echo $rowEmail; ?></a></strong>
					</div>
				</div>
				<? echo $HR0; ?>
				<a class="btn btn-primary btn-block mt-3" href="editclient" title="ändra kundprofil"><i class="fas fa-user-edit" aria-hidden="true"></i> Ändra kund</a>
			</div>
		</div>

		<div class="card">
			<div class="card-header py-3">
				<h3 class="m-0 font-weight-bold brand-title">Information</h3>
			</div>
			<div class="card-body py-3">
				<div class="alert alert-<? echo $AlertBKG; ?> p-2 mt-0">
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

		<div class="card">
			<div class="card-body">

				<ul class="nav nav-pills" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Information</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Anteckningar</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Meddelandehistorik</button>
					</li>
				</ul>
				<? echo $HR10; ?>
				<div class="tab-content mt-3" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<? include "show_client_info.php"; ?>
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<? include "show_client_notes.php"; ?>
					</div>
					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						<? include "show_client_messagehistory.php"; ?>
					</div>
				</div>
			</div>

		</div>
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