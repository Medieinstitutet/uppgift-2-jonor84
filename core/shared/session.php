<?	
	// START SESSION
	session_start();

	session_set_cookie_params($gloSessionLife,$gloAdminPath,$gloDomain);
	
  	// UACTIVE = TIMESTAMP OF USERS LAST ACTION. TO LOGOUT INACTIVE USERS.
  	// ULIFETIME = TIMESTAMP OF SESSION-START. TO REGENERATE SESSION-IS FOR SAFTEY

	$logouturl = "index.php";

	// CHECK IF USER HAS BEEN INACTIVE, IF YES THEN LOGOUT
	if (isset($_SESSION['UACTIVE']) && (time() - $_SESSION['UACTIVE'] > $gloSessionLife)) {
        echo "SESSION TIMEOUT";
		session_destroy();
		session_unset();
		session_start();
	}
    
    // UPDATE SESSION TO NOW()
    $_SESSION['UACTIVE'] = time();

	// IF USER IS NEW MAKE NEW TIMESTAMP OF SESSION-START
	if (!isset($_SESSION['ULIFETIME'])) {
		$_SESSION['ULIFETIME'] = time();
	} 
	// IF SESSION IS TOO OLD, MAKE NEW SESSION-ID
	elseif (time() - $_SESSION['ULIFETIME'] > $gloSessionLife) {
		session_regenerate_id(true);
		$_SESSION['SID'] = session_id();
		$_SESSION['ULIFETIME'] = time();
	}
	
	// IF USER IS LOGGED IN, SEND TO MAIN.PHP
	if ((isset($_SESSION['UID'])) && ($_SESSION['SID']==session_id()) ) {
		$blnAuthed = true;

	}
	else {
		$blnAuthed = false;
		header("location: $logouturl");
		exit;
	}

	
?>