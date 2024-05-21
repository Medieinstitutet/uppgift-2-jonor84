<?php 
//NOT TESTED
if ($_GET['task'] == 'auth') {
    // GET DATA FROM POST
    $UserPID = mysqli_real_escape_string($SQLlink, $_POST['frmPID'] ?? '');
    
    // Check if PID exists
    $strSQLPIDEXIST = "SELECT * FROM data_users WHERE pid = '$UserPID'";
    $resultsPIDEXIST = mysqli_query($SQLlink, $strSQLPIDEXIST);
    $PIDEXIST = mysqli_num_rows($resultsPIDEXIST);

    // If PID does not exist, create user
    if ($PIDEXIST == 0) { 
        // CREATE USER
        include("../auth/run-createuser-bankid.php");
    }

    // CHECK BANKID
    //include("../auth/run-check-bankid.php");  

    // Get UserID and check if user is active
    $sql_query = "SELECT id, user_active FROM data_users WHERE pid = '$UserPID'";
    $result = mysqli_query($SQLlink, $sql_query);
    $row = mysqli_fetch_assoc($result);
    
    $strUser = $row['id'];
    $UserActive = $row['user_active'];

    // IF BANKID CHECK PASSES
    if ($BankIDOK == 1) {
        // IF USER IS ACTIVE, LOGIN
        if ($UserActive == 1) {      
            // MAKE NEW SESSION-ID
            session_start();

            // SET SESSION-DATA
            $_SESSION['UID'] = $strUser;        // USER-ID
            $_SESSION['ULIFETIME'] = time();    // START OF SESSION
            $_SESSION['UACTIVE'] = time();      // TIME OF LAST ACTION
            $_SESSION['SID'] = session_id();    // SESSION-ID
            
            $strIP  = getIP();      
            $strUID = $strUser;
            $strSID = session_id();
            
            $clientData = "Inlogging: ".$_SERVER['HTTP_USER_AGENT'];
            
            // INSERT EVENT IN LOG
            $strSQL = "INSERT INTO log_admin (user_id,session_id,log_event,log_notes,log_ip,log_date) VALUES ($strUID,'$strSID','login','$clientData',INET_ATON('$strIP'),'$gloTimeStamp')";
            mysqli_query($SQLlink, $strSQL);

            // Reset login tries and set latest login to now
            $sql_query = "UPDATE data_users SET login_tries = 5, last_login = '$gloTimeStamp' WHERE id = $strUID";
            mysqli_query($SQLlink, $sql_query);

            header("location: main.php?module=default");
            exit;
        } else {  
            // USER ACCOUNT LOCKED
            $strError = "Kontot är låst. Var god kontakta oss.";
        }
    } else {  
        // BANKID CHECK DID NOT PASS
        $strError = "Något gick fel med inloggningen, var god försök igen.";
    }
}   
?>
