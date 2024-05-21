<? 
if ($gloOpen == 0){
	echo "
	<div class='alert alert-danger' role='info'>
	 $gloOfflineMSG
	</div>";
} else {

	if ($_SESSION['error']) {
	echo "
	 <div class='alert alert-danger' role='alert'>
	  <i class='fas fa-exclamation-triangle'></i> ".$_SESSION['error']."
	 </div>";
	unset($_SESSION['error']);
	}

	if ($_SESSION['success']) {
	echo "
	 <div class='alert alert-success' role='alert'>
	  <i class='fas fa-check-circle'></i> ".$_SESSION['success']."
	 </div>";
	unset($_SESSION['success']);
	}

	if ($_SESSION['warning']) {
	echo "
	 <div class='alert alert-warning' role='alert'>
	  <i class='fas fa-exclamation-triangle'></i> ".$_SESSION['warning']."
	 </div>";
	unset($_SESSION['warning']);
	}

	if ($_SESSION['info']) {
	echo "
	 <div class='alert alert-info' role='alert'>
	  <i class='fas fa-info-circle'></i> ".$_SESSION['info']."
	 </div>";
	unset($_SESSION['info']);
	}

	if ($_SESSION['danger']) {
		echo "
		 <div class='alert alert-danger' role='alert'>
		 <i class='fas fa-exclamation-triangle'></i> ".$_SESSION['danger']."
		 </div>";
		unset($_SESSION['danger']);
	}

	if ($strError) {
	echo "
	<div class='alert alert-danger' role='alert'>
	  ".$strError."
	</div>";
	}
}
?>