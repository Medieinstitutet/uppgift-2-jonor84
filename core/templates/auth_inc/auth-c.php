<?php 
// NOT UPDATED YET

if ($_GET['task']=='auth1111') {

    
$URLCODE = $_GET['c']; // hzzado4ijbzF3wVM13oTRAarOqscjA==
    
 //CHECK IF THERE IS A URLCODE OR NOT
    
    // Storing the cipher method 
    $ciphering = "AES-128-CTR";

    // Non-NULL Initialization Vector for decryption 
    $decryption_iv = '1234567891011121';

    // Using openssl_decrypt() function to decrypt the data 
    $decryptedURL = openssl_decrypt($URLCODE, $ciphering, $secret_hash_key, $options, $decryption_iv);
    
    
if (!$URLCODE) { 
$strError = "NO INPUT. ";
} else {    
    
    //CHECK URL DATA
    $URLpieces      = explode("&", $decryptedURL);
    $EMAIL          = $URLpieces['0']; // USER EMAIL    
    $USERTYPE       = $URLpieces['1']; // USER TYPE Client, Reseller, Admin
    $MODULE         = $URLpieces['2']; // MODULE / DESTINATION
    $SECRETCODE     = $URLpieces['3']; // SECRET CODE
    
        
        
    if ( $USERTYPE == "Admin") {
        
        if ($AllowAdminAutoLogin == 0) {
            $ACCESS = "0";
            $strError = "NOT ALLOWED (1).<br> ";
        } else {
                //CHECK IF SECRET CODE IS ACCEPTED
                if ($secret_hash_key == $SECRETCODE) {
                    $ACCESS = "1";
                } else {
                    $ACCESS = "0";
                    $strError = "WRONG INPUT. ";
                }
        }
    } else {
        
         if ($AllowAutoLogin == 0) {
            $ACCESS = "0";
            $strError = "NOT ALLOWED (2).<br> ";
        } else {
                //CHECK IF SECRET CODE IS ACCEPTED
                if ($secret_hash_key == $SECRETCODE) {
                    $ACCESS = "1";
                } else {
                    $ACCESS = "0";
                    $strError = "WRONG INPUT. ";
                }
             
        }
    }
        
        
    
//CONTINUE IF URL IS ACCEPTED
if ($ACCESS == 0) {    
    //ACCESS CHECK DID NOT PASS
	$strError .= "Något gick fel med inloggningen, var god försök igen nedan.";
    
} else {
		
		//CHECK IF EMAIL EXIST
		 $strSQLEMAILEXIST = "SELECT * FROM data_users WHERE user_email = '$EMAIL'";
  		 $resultsEMAILEXIST = mysqli_query($SQLlink,$strSQLEMAILEXIST);
		 $EMAILEXIST = mysqli_num_rows($resultsEMAILEXIST);

		//IF NOT PID EXIST - CREATE USER
		if ($EMAILEXIST == 0) { 
	       $strError .= "NO EMAIL. ";

		} else { 
            
            // GET USERID AND IF USER IS ACTIVE
            $sql_query = "SELECT id, user_active FROM data_users WHERE user_email = '$EMAIL'";
            $result = mysqli_query($SQLlink,$sql_query);
            $row = mysqli_fetch_assoc($result);

            $strUser 	= $row['id'];
            $UserActive 	= $row['user_active'];

            // SET COOKIE TO REMEMBER USER
            if (!empty($strUser)) { setcookie ("WelcomeBack", $strUser, time() + 3153600, "/"); }


                // IF USER IS ACTIVE LOGIN
                if ($UserActive == 0) {			
                        //USER ACCOUNT LOCKED
                        $strError .= "Kontot är låst. Var god kontakta oss.";
                 }
                else { 
                        // MAKE NEW SESSION-ID
                        session_start();

                        // SET SESSION-DATA
                        $_SESSION['UID'] = $strUser;		// USER-ID
                        $_SESSION['ULIFETIME'] 	= time();	// START OF SESSION
                        $_SESSION['UACTIVE'] = time();		// TIME OF LAST ACTION
                        $_SESSION['SID'] = session_id();	// SESSION-ID

                        $strIP  = getIP();		
                        $strUID = $strUser;
                        $strSID = session_id();

                        $clientData = "Inlogging: ".$_SERVER['HTTP_USER_AGENT'];

                        // INSERT EVENT IN LOG

                        $strSQL = "
                        INSERT INTO log_admin 
                        (user_id,session_id,log_event,log_notes,log_ip,log_date) 
                        VALUES 
                        ($strUID,'$strSID','login','$clientData',INET_ATON('$strIP'),'$gloTimeStamp')";
                        mysqli_query($SQLlink,$strSQL);

                        //Reset login tries and set latest login to now
                        $sql_query = "UPDATE data_users SET login_tries = 5, last_login = '$gloTimeStamp' WHERE id = $strUID";
                        mysqli_query($SQLlink,$sql_query);
                    
                        if ($MODULE) {
                            header("location:main.php?module=$MODULE");
                            exit;
                        } else {
                            header("location:main.php?module=default");
                            exit;
                        }
                    

                 }

		}
}
	
}
}
?>		