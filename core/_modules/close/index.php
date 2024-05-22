<?php
	
	// *** ***********************
	// *** CLOSE SERVICE
	// *** ***********************

if ($_SESSION["service"]) { 
	
	if ($_SESSION["w"]) { 
		unset($_SESSION['w']);
	}

 	if ($_SESSION["service"] == "order") {
		unset($_SESSION['ServiceTerm']);
		unset($_SESSION['NewInvoiceID']);
		unset($_SESSION["service"]);

		$_SESSION["THEME"] = $gloBrandTemplateMain;  
		$CLOSELINK = "/dashboard";  
		
	} else if ($_SESSION["service"] == "invoice") {

		if ($_SESSION["w"]) { 
			unset($_SESSION['w']);
		}
		if ($_SESSION["wa"]) { 
			unset($_SESSION['wa']);
		}
		if ($_SESSION["wid"]) { 
			unset($_SESSION['wid']);
		}
		if ($_SESSION["wis"]) { 
			unset($_SESSION['wis']);
		}
		if ($_SESSION["wic"]) { 
			unset($_SESSION['wic']);
		}
		if ($_SESSION["wo"]) { 
			unset($_SESSION['wo']);
		}
		if ($_SESSION["s"]) { 
			unset($_SESSION['s']);
		}
	
		$_SESSION["service"] = "customerzone";
		$_SESSION["THEME"] = $gloBrandTemplateMain;
		
		if ($gloClientAccessLevel > 4) { 
			$CLOSELINK = "/rsinvoices"; 
		}  else { 
			$CLOSELINK = "/invoices"; 
		}
	} else {
		unset($_SESSION["service"]);
		$_SESSION["THEME"] = "default";  
		$CLOSELINK = "/dashboard";  
	}
	
} else { 

	$_SESSION["THEME"] = "default";  
	$CLOSELINK = "/dashboard";  
}

// if ($_SESSION["service2"]) { 
//	unset($_SESSION["service2"]);
//    
//    $_SESSION["THEME"] = $gloBrandTemplateMain;
//	$CLOSELINK = "/dashboard"; 
//}  

header("Location: $CLOSELINK");

?>