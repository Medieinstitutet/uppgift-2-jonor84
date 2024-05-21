<?
// GENERAL FUNCTIONS

// Function to format news header with importance indicator
function formatNewsHeader($header, $important) {
    $indicator = $important ? "<span class='fa fa-1x fa-exclamation-circle text-danger'></span>" : "";
    return $indicator . " " . $header;
}

// Check a date and transform if needed
function formatDate($dateTime)
{
    // Check if $dateTime is a valid timestamp
    if (is_numeric($dateTime)) {
        // If it's a valid timestamp, convert it to a formatted date
        $formattedDate = date('Y-m-d H:i', $dateTime);
    } else {
        // If it's not a timestamp, assume it's a regular date string
        // Remove seconds if present
        if (strlen($dateTime) > 16) {
            $formattedDate = substr($dateTime, 0, -3);
        } else {
            $formattedDate = $dateTime;
        }
    }

    return $formattedDate;
}

// Function to short text like news titles or news text..
function shortenText($title, $maxLength) {
    // Check if the title length is greater than the maximum length
    if (strlen($title) > $maxLength) {
        // Truncate the title to the maximum length
        $truncatedTitle = substr($title, 0, $maxLength);
        
        // Find the last space within the truncated title
        $lastSpace = strrpos($truncatedTitle, ' ');
        
        // If a space was found, truncate the title at that space
        if ($lastSpace !== false) {
            $truncatedTitle = substr($truncatedTitle, 0, $lastSpace);
        }
        
        // Remove any trailing punctuation
        $truncatedTitle = rtrim($truncatedTitle, ",.?!:;");

        // Add ellipsis to indicate truncation
        $truncatedTitle .= '...';
        
        return $truncatedTitle;
    }
    
    // If the title length is within the maximum length, return the original title
    return $title;
}


//GET Startpage Name
function StartPageName($page)
{
    global $SQLlink;

    $strSQL = "SELECT name FROM data_startpages WHERE page = '$page'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CHECK = mysqli_num_rows($results);
    if (empty($CHECK)) { $CHECK = 0; }

    if (!$CHECK) {
        $StartPageNAME = "Startappar";
    } else { 
        // GET NAME FROM DATABASE
        $strSQL = "
			SELECT name FROM data_startpages WHERE page = '$page' LIMIT 1";
        $result = mysqli_query($SQLlink, $strSQL);
        $row = mysqli_fetch_assoc($result);

        $StartPageNAME = ucfirst($row['name']);
    }

    return $StartPageNAME;

}

//GET NAME OF A LANGUAGE
function LanguageName($ID)
{
    global $SQLlink;
    // If id = 0 set to 1 - Svenska is default language
    if ($ID == 0 ) { $ID = 1; }

    // GET NAME FROM DATABASE
    $strSQL = "SELECT name FROM data_languages WHERE id = '$ID' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);

    $LangNAME = ucfirst($row['name']);


    return $LangNAME;

}

//GET NAME OF A COUNTRY
function CountryNameSE($ID)
{
    global $SQLlink;

    $strSQL = "SELECT country_name FROM data_countrys WHERE id = '$ID'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CHECK = mysqli_num_rows($results);

    if ($CHECK != 0) {

        // GET NAME FROM DATABASE
        $strSQL = "
			SELECT 
			country_name
			FROM data_countrys
			WHERE id = '$ID'
			LIMIT 1";
        $result = mysqli_query($SQLlink, $strSQL);
        $row = mysqli_fetch_assoc($result);

        $CountryNAME = ucfirst($row['country_name']);
        return $CountryNAME;
    }
}


function generateRandomNonZeroDigits($length)
{
    $digits = '';
    for ($i = 0; $i < $length; $i++) {
        // Generate a random digit (1-9)
        $digit = mt_rand(1, 9);
        $digits .= $digit;
    }
    return $digits;
}


function count_digits($number)
{
    return strlen($number);
}

function GeneratePIN($chars)
{
    $PINCODE = "";
    while ($chars != 0) {
        $PINCODE .= rand(1, 9);
        $chars--;
    }
    return $PINCODE;
}

function generateRandomPassword($length)
{
    // Define character sets
    $capitalLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercaseLetters = 'abcdefghijklmnopqrstuvwxyz';
    $digits = '0123456789';
    $specialCharacters = '!@#$%^&*()-_=+{};:,<.>';

    // Ensure at least one character from each character set
    $password = '';
    $password .= $capitalLetters[rand(0, strlen($capitalLetters) - 1)];
    $password .= $lowercaseLetters[rand(0, strlen($lowercaseLetters) - 1)];
    $password .= $digits[rand(0, strlen($digits) - 1)];
    $password .= $specialCharacters[rand(0, strlen($specialCharacters) - 1)];

    // Fill the rest of the password with random characters
    $remainingLength = $length - 4; // Deducting 4 for the characters already chosen
    $characters = $capitalLetters . $lowercaseLetters . $digits . $specialCharacters;
    for ($i = 0; $i < $remainingLength; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    // Shuffle the password to randomize the characters' positions
    $password = str_shuffle($password);

    return $password;
}


function generateRandomString($length = 64)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateRandomString2($length)
{
    if (empty($length)) {
        $length = 64;
    }

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Function to get users IP
function getIP()
{
    $tmpIP = NULL;
    if (getenv("HTTP_CLIENT_IP")) {
        $tmpIP = getenv("HTTP_CLIENT_IP");
    } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
        $tmpIP = getenv("HTTP_X_FORWARDED_FOR");
    } elseif (getenv("REMOTE_ADDR")) {
        $tmpIP = getenv("REMOTE_ADDR");
    } else {
        $tmpIP = "NOIP";
    }
    return $tmpIP;
}



// get users browser
function getUserBrowser() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    // List of common browsers and their corresponding regular expressions
    $browsers = [
        'Edge'      => 'Microsoft Edge',
        'Firefox'   => 'Mozilla Firefox',
        'Chrome'    => 'Chrome',
        'Safari'    => 'Apple Safari',
        'Opera'     => 'OPR',
        'IE'        => 'MSIE|Trident',
    ];

    // Iterate through the list of browsers and check if the user agent string matches any of them
    foreach ($browsers as $browser => $pattern) {
        if (preg_match("/$pattern/", $userAgent)) {
            return $browser;
        }
    }

    // If no match is found, return 'Unknown'
    return 'Unknown/Okänd';
}

// // get location from ip
// function getLocationFromIP($ip) {
//     global $gloGeoDataPath;
//     // Path to the GeoLite2 City database file
//     $databaseFile = $gloGeoDataPath.'/GeoLite2-City.mmdb'; // Update this with the actual path to your database file

//     // Load the MaxMind GeoLite2 Reader
//     use GeoIp2\Database\Reader;

//     // Initialize the reader
//     $reader = new Reader($databaseFile);

//     try {
//         // Get location information for the IP address
//         $record = $reader->city($ip);

//         // Extract relevant location details
//         $country = $record->country->name;
//         $city = $record->city->name;
//         $latitude = $record->location->latitude;
//         $longitude = $record->location->longitude;

//         // Construct location string
//         $location = "$city, $country (Lat: $latitude, Long: $longitude)";

//         return $location;
//     } catch (Exception $e) {
//         // Handle exceptions (e.g., if IP address not found in the database)
//         return "Location not found./Plats kunde inte lokaliseras.";
//     }
// }


function generatePassword($l = 8, $c = 0, $n = 0, $s = 0)
{
    // get count of all required minimum special chars
    $count = $c + $n + $s;

    // sanitize inputs; should be self-explanatory
    if (!is_int($l) || !is_int($c) || !is_int($n) || !is_int($s)) {
        trigger_error('Argument(s) not an integer', E_USER_WARNING);
        return false;
    } elseif ($l < 0 || $l > 20 || $c < 0 || $n < 0 || $s < 0) {
        trigger_error('Argument(s) out of range', E_USER_WARNING);
        return false;
    } elseif ($c > $l) {
        trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
        return false;
    } elseif ($n > $l) {
        trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
        return false;
    } elseif ($s > $l) {
        trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
        return false;
    } elseif ($count > $l) {
        trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
        return false;
    }

    // all inputs clean, proceed to build password

    // change these strings if you want to include or exclude possible password characters
    $chars = "abcdefghijklmnopqrstuvwxyz";
    $caps = strtoupper($chars);
    $nums = "0123456789";
    $syms = "!@#$%^&*()-_=+{};:,<.>";

    // build the base password of all lower-case letters
    for ($i = 0; $i < $l; $i++) {
        $out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }

    // create arrays if special character(s) required
    if ($count) {
        // split base password to array; create special chars array
        $tmp1 = str_split($out);
        $tmp2 = array();

        // add required special character(s) to second array
        for ($i = 0; $i < $c; $i++) {
            array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
        }
        for ($i = 0; $i < $n; $i++) {
            array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
        }
        for ($i = 0; $i < $s; $i++) {
            array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
        }

        // hack off a chunk of the base password array that's as big as the special chars array
        $tmp1 = array_slice($tmp1, 0, $l - $count);
        // merge special character(s) array with base password array
        $tmp1 = array_merge($tmp1, $tmp2);
        // mix the characters up
        shuffle($tmp1);
        // convert to string for output
        $out = implode('', $tmp1);
    }

    return $out;
}

function valid_pass($candidate)
{
    $r1 = '/[A-Z]/';  //Uppercase
    $r2 = '/[a-z]/';  //lowercase
    $r3 = '/[!@#$%^&*()-_=+{};:,<.>]/';  // whatever you mean by 'special char'
    $r4 = '/[0-9]/';  //numbers

    if (!preg_match($r1, $candidate)) return FALSE;

    if (!preg_match($r2, $candidate)) return FALSE;

    if (!preg_match($r3, $candidate)) return FALSE;

    if (!preg_match($r4, $candidate)) return FALSE;

    if (strlen($candidate) < 8) return FALSE;

    return TRUE;
}



// Generates cPanel session to user, redirects user to cpanel(autologin)
function cPanelLogin(string $user = "")
{
    if (empty($user)) {
        return;
    }

    // Secure those!!
    $whmusername = 'moonserv';
    $whmpassword = 'L9@dy4-q-T';

    $query = "https://s510.ams8.mysecurecloudhost.com:2087/json-api/create_user_session?api.version=1&user=$user&service=cpaneld";
    $header = array();
    $header[0] = "Authorization: Basic " . base64_encode($whmusername . ":" . $whmpassword) . "\n\r";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_URL, $query);

    $result = curl_exec($curl);
    $decoded_response = @json_decode($result, true);

    if (!empty($decoded_response['cpanelresult']['error']) || empty($decoded_response['data']['url'])) {
        $_SESSION['error'] = $decoded_response['cpanelresult']['error'];
        die(header("Location: " . $_SERVER['REQUEST_URI']));
    }

    // Redirect to cPanel
    $session_url = $decoded_response['data']['url'];
    die(header("Location: " . $session_url));
}


// FROM OLD VERSION

// SHOW RIGHT BODYCLASS ON RIGHT MODULE - THEME DEFAULT
// function printBodyClass($SQLlink)
// {
//     global $SQLlink, $strModule, $GETSHOW, $GETTASK;

//     $generalbodyclass = "dashboard-page sb-l-o sb-r-c";

//     if ($strModule == "default") {
//         echo "dashboard-page sb-l-o sb-r-c";
//     } elseif ($strModule == "profile") {
//         if ($GETSHOW) {
//             echo $generalbodyclass;
//         } else if ($GETTASK) {
//             echo $generalbodyclass;
//         } else {
//             echo "profile-page";
//         }
//     } elseif ($strModule == "showprofile") {
//         echo "profile-page";
//     } else {
//         echo $generalbodyclass;
//     }
// }

// SHOW RIGHT SECTIONCLASS ON RIGHT MODULE - THEME DEFAULT
// function printSectionClass($SQLlink)
// {
//     global $SQLlink, $strModule, $GETSHOW, $GETTASK;

//     $generalsectionclass = "table-layout";

//     if ($strModule == "default") {
//         echo $generalsectionclass;
//     } elseif ($strModule == "profile") {
//         if ($GETSHOW) {
//             echo $generalsectionclass;
//         } else if ($GETTASK) {
//             echo $generalsectionclass;
//         } else {
//             echo "pn";
//         }
//     } elseif ($strModule == "showprofile") {
//         echo "pn";
//     } else {
//         echo $generalsectionclass;
//     }
// }
