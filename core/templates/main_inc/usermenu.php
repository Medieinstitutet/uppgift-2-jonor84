<div class="dropdown d-flex profile-1"> <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex"> <img src="<? echo $gloAvatarsDir; ?>/<? echo $gloUserPic; ?>" alt="profile-user" class="avatar profile-user brround cover-image"> </a>
	<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
		<div class="drop-heading">
			<div class="text-center">
				<h4 class="text-dark mb-0 fs-14"><? echo $gloUserFullname; ?></h4>
				<? if ($gloUserAccountID) {
					echo "ID: " . $gloUserAccountID;
				} ?>
				<!--<small class="text-muted"><? echo $_SESSION['ACTIVECLIENT']; ?></small> -->
			</div>

		</div>
		<div class="dropdown-divider m-0"></div>


			<div class="text-center">
				<? if (!$gloUserNew) { ?>
					<a class="dropdown-item" href='#' data-id='Switch' data-toggle='modal' data-bs-toggle='modal' data-bs-target='#Modal-Switch' data-target='#Modal-Switch'>

						<span class="brand-title" title="Växla profil"><b><? echo $_SESSION['ACTIVECLIENT']; ?></b></span>
						<br> <i class="fas fa-people-arrows fa-sm brand-title" title="Växla profil"></i> <small class="text-muted">Växla profil</small>
					</a>
				<? } else { ?>
					<small class="text-muted"><b><? echo $_SESSION['ACTIVECLIENT']; ?></b></small>
				<? } ?>
			</div>
			<div class="dropdown-divider m-0"></div>

			<? if (!$gloUserNew) { ?>

				<a class="dropdown-item" href="<? echo $gloBase; ?>account"> <i class="dropdown-icon fas fa-fw fa-user-circle brand-title"></i> Mitt Konto </a>
				<a class="dropdown-item" href="<? echo $gloBase; ?>client"> <i class="dropdown-icon fas fa-fw fa-user-circle brand-title"></i> Kundprofil </a>
				<a class="dropdown-item" href="<? echo $gloBase; ?>support"> <i class="dropdown-icon fas fa-fw fa-life-ring brand-title"></i> Support </a>


				<? if ($_SESSION["service"] || $GETMODULE  != "dashboard") { ?>
					<a class="dropdown-item" href="<? echo $gloBase; ?>close"> <i class="dropdown-icon fas fa-fw fa-house-user brand-title"></i> Startappar </a>
				<? } ?>

			<? } ?>


			<? // IF ADMINS
			if ($gloAccess > 7) {
			?>
				<a class="dropdown-item" href="<? echo $gloBase; ?>sys"> <i class="dropdown-icon fas fa-fw fa-user-tie brand-title"></i> AdminPanel </a>
			<? } ?>

		<a class="dropdown-item" href="/logout.php"> <i class="dropdown-icon fas fa-fw fa-sign-out-alt brand-title"></i> Logga ut </a>
	</div>
</div>