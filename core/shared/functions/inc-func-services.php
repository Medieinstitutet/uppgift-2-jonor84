<?
// SERVICES FUNCTIONS


//AUTO CREATE INVOICE DRAFT ON A CURRENT SERVICE WHEN DUE
function createInvoiceService($MYSERVICEID)
{
    global $SQLlink, $gloTimeStamp, $gloNow, $SystemAdmin, $BRAND;

    //GLOBAL DATA 
    // $MYSERVICEID = "";
    $StatusID        = 1; //status statusid
    $CurrencyID        = 1; // currency currencyid
    $RotRut            = 0; // rotrut

    //GET SERVICE DATA
    $strSQLSD = "
			SELECT 
             t1.id,
             t1.cid, t1.rid, t1.typeid, t2.se_name, t1.name, 
			 t1.term, t1.domain, t1.periodpay, t1.expires, t1.nextinvoicedate, 
			 t1.extenddate,t3.id,t3.se_name, t4.companyname, t4.companyid, 
             t4.vatid, t4.phone, t4.email, t4.iemail, t4.countryid, 
             t4.iaddress, t4.izip, t4.itown, t4.contactname 
			FROM data_myservices AS t1 
            LEFT JOIN data_services AS t2 
			ON t1.sid = t2.id
			LEFT JOIN data_servicetypes AS t3 
			ON t1.typeid = t3.id
			LEFT JOIN data_clients AS t4 
			ON t1.cid = t4.id
            WHERE t1.closed = '0'
			AND t1.renewal = '1'
			AND t1.id = '$MYSERVICEID'
			";
    $arrRSSD = mysqli_query($SQLlink, $strSQLSD);
    while ($arrRow = mysqli_fetch_row($arrRSSD)) {

        // PUT RS IN VARS - SERVICE DATA
        $ServiceID = $arrRow[0]; // t1.id service id

        $ClientID = $arrRow[1]; // t1.cid client id
        $ResellerID = $arrRow[2]; // t1.rid reseller id
        $ServiceTypeID = $arrRow[3]; // t1.typeid servicetype id
        $ServiceName = $arrRow[4]; // t2.se_name example My Gameplace /Min Spelplats
        $ServiceOwnName = $arrRow[5]; // t1.name example Arenan 23

        $ServiceTerm = $arrRow[6]; // t1.term monthly or yearly
        $ServiceDomain = $arrRow[7]; // t1.domain
        $ServicePeriodPay = $arrRow[8]; // t1.periodpay
        $ServiceExpires = date('Y-m-d', $arrRow[9]); // t1.expires date
        $ServiceNextInvoice = date('Y-m-d', $arrRow[10]); // t1.nextinvoicedate date

        $ServiceExtendDate = date('Y-m-d', $arrRow[11]); // t1.extenddate date
        // SERVICE TYPE 
        $ServiceTypeID             = $arrRow[12]; // t3.id servicetype id   bingo is id 8
        $ServiceTypeName         = $arrRow[13]; // t3.se_name servicetype name

        // CLIENT DATA
        $ClName                    = $arrRow[14]; //t4.companyname get client org name
        $ClIDNR                    = $arrRow[15]; //t4.companyid get client org/personnummer

        $ClientVAT                = $arrRow[16]; //t4.vatid get client vat
        $CLPhone                 = $arrRow[17]; //t4.phone get client phone
        $CLEmail                 = $arrRow[18]; //t4.email get client email
        $CLIEmail                 = $arrRow[19]; //t4.iemail get client iemail
        $CLCountryID               = $arrRow[20]; //t4.countryid get client countryid

        $CLAddress                 = $arrRow[21]; //t4.iaddress get client address
        $CLZip                     = $arrRow[22]; //t4.izip get client zip
        $CLTown                    = $arrRow[23]; //t4.itown get client town
        $CLRef                    = $arrRow[24]; //t4.contactname get client reference

    }

    // IF no invoicemail use user mail.
    if (empty($CLIEmail)) {
        $CLIEmail = $CLEmail;
    }

    // $PERIOD
    // 0 = Onetime/Engångsköp
    // 1 = Monthly/Månadsvis
    // 2 = Yearly/Årsvis
    // 3 = Free/Gratis
    switch ($PERIOD) {
        case 0:
            $Description = "Denna tjänst är ett engångsköp.";
            $NewExpireDate = "";
            break;
        case 1:
            $Description = "Gäller Månadsbetalning.";
            $NewExpireDate = " -> " . date('Y-m-d', strtotime($ServiceExpires . ' + 1 month'));
            break;
        case 2:
            $Description = "Gäller Årsbetalning.";
            $NewExpireDate = " -> " . date('Y-m-d', strtotime($ServiceExpires . ' + 1 year'));
            break;
        case 3:
            $Description = "Denna tjänst är gratis.";
            $NewExpireDate = "";
            break;
    }

    // IF SERVICE TYPE BINGO (8) 20 Paydays else 14 paydays.
    if ($ServiceTypeID == 8) {
        $PayDays = 20;
    } else {
        $PayDays = 14;
    }

    //SERVICE DATA TO ADD ON INVOICE ROW
    // EXAMPLE: "Hall/Bilbingon.se / Min Spelplats: Arena X 2023"
    // EXAMPLE: "Hemsideabonnemang / MoonSite Luna -> 2023-03-27"
    // $ServiceTypeName."/".$ServiceName." ".$ServiceOwnName." ->".$NewExpireDate;

    $ProductDesc     = $ServiceTypeName . "/" . $ServiceName . " (" . $ServiceOwnName . ")" . $NewExpireDate;
    $ProductCount    = 1;
    $ProductVAT      = 25;
    $ProductPrice     = $ServicePeriodPay;
    $SYSUSER = 0;

    //CREATE NEW INVOICE DRAFT
    $strSQL = "
        INSERT INTO data_invoices 
         (brand,serviceid,reseller_id, status, days, currency, rotrut,
          client_id, name, idnr, vatid, phone,
          email, countryid, zip, town, address, 
          description,reference,created_date) 
        VALUES 
         ('$BRAND','$ServiceID','$ResellerID','$StatusID','$PayDays','$CurrencyID','$RotRut',
          '$ClientID','$ClName','$ClIDNR','$ClientVAT','$CLPhone',
          '$CLEmail','$CLCountryID','$CLZip','$CLTown','$CLAddress',
          '$Description','$CLRef', '$gloTimeStamp')";
    mysqli_query($SQLlink, $strSQL);

    $CreatedINVID = $SQLlink->insert_id;
    // INSERT SERVICE INTO PRODUCT ROW ON INVOICE DRAFT
    $strSQL1 = "
        INSERT INTO data_invoice_rows 
         (brand,invoice_id,description,count,vat,price,added,addeduser,updated,updateduser) 
        VALUES 
         ('$BRAND','$CreatedINVID','$ProductDesc','$ProductCount','$ProductVAT','$ProductPrice','$gloTimeStamp','$SYSUSER','$gloTimeStamp','$SYSUSER')";
    mysqli_query($SQLlink, $strSQL1);

    return $CreatedINVID;
}



//CHECK IF USERS CLIENT HAVE ACCESS TO CERTAIN SERVICE
function checkClientAccessService($gloCurrentClientID, $TypeID)
{
    global $SQLlink, $SystemAdmin;

    $strSQLAccess = "SELECT id FROM data_myservices WHERE cid = '$gloCurrentClientID' AND typeid = '$TypeID'";
    $strResAccess = mysqli_query($SQLlink, $strSQLAccess);
    $ServiceAccess = mysqli_num_rows($strResAccess);

    if (!$ServiceAccess) {
        $gloAllowed = "0";
    } else {
        $gloAllowed = "1";
    }

    return $gloAllowed;
}

//returns true, if domain is available, false if not
function isDomainAvailable($domain)
{
    //check, if a valid url is provided
    if (!filter_var($domain, FILTER_VALIDATE_URL)) {
        return false;
    }

    //initialize curl
    $curlInit = curl_init($domain);
    curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($curlInit, CURLOPT_HEADER, true);
    curl_setopt($curlInit, CURLOPT_NOBODY, true);
    curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

    //get answer
    $response = curl_exec($curlInit);

    curl_close($curlInit);

    if ($response) return true;

    return false;
}


function has_ssl($domain)
{
    $res = false;
    $stream = @stream_context_create(array('ssl' => array('capture_peer_cert' => true)));
    $socket = @stream_socket_client('ssl://' . $domain . ':443', $errno, $errstr, 4, STREAM_CLIENT_CONNECT, $stream);

    // If we got a ssl certificate we check here, if the certificate domain
    // matches the website domain.
    if ($socket) {
        $cont = stream_context_get_params($socket);
        $cert_ressource = $cont['options']['ssl']['peer_certificate'];
        $cert = openssl_x509_parse($cert_ressource);

        // Expected name has format "/CN=*.yourdomain.com"
        $namepart = explode('=', $cert['name']);

        // We want to correctly confirm the certificate even 
        // for subdomains like "www.yourdomain.com"
        if (count($namepart) == 2) {
            $cert_domain = trim($namepart[1], '*. ');
            $check_domain = substr($domain, -strlen($cert_domain));
            $res = ($cert_domain == $check_domain);
        }
    }

    return $res;
}

// Generate uniqe serviceID 
function generateServiceID($servicetypeid)
{
    if (empty($servicetypeid)) {
        $servicetypeid = 0;
    }
    $currentYear = date("y");
    $zerodivider = 0;
    $randomPart = generateRandomNonZeroDigits(5); // Generate a 5-digit number without zeros
    $randomString = $currentYear . $zerodivider . $servicetypeid . $zerodivider . $randomPart;
    return $randomString;
}

// ...

// Function to update service ID for a product
function updateServiceID($productId, $newServiceID, $servicetypeid)
{
    global $SQLlink;

    if (empty($servicetypeid)) {
        $servicetypeid = 0;
    }

    $productId = (int) $productId; // Ensure $productId is an integer to prevent SQL injection
    $newServiceID = $SQLlink->real_escape_string($newServiceID); // Escape the new service ID to prevent SQL injection

    // Check if the new service ID already exists
    $checkQuery = "SELECT COUNT(*) as count FROM data_myservices WHERE myserviceid = '$newServiceID' AND id != $productId";
    $checkResult = $SQLlink->query($checkQuery);

    if ($checkResult) {
        $row = $checkResult->fetch_assoc();
        $count = (int) $row['count'];

        if ($count > 0) {
            // The new service ID already exists, generate a new one
            $newServiceID = generateServiceID($servicetypeid);
        }
    } else {
        // Handle the case where the check query failed
        return false;
    }

    // Update the service ID in the database
    $query = "UPDATE data_myservices SET myserviceid = '$newServiceID' WHERE id = $productId";

    if ($SQLlink->query($query)) {
        return true; // Update successful
    } else {
        return false; // Update failed
    }
}

// Function to check and create/update myserviceid for a specific clientid
function checkServiceID($clientID)
{
    global $SQLlink;

    $clientID = (int)$clientID; // Ensure $clientID is an integer to prevent SQL injection

    // Select all rows for the given clientid
    $selectQuery = "SELECT id, myserviceid FROM data_myservices WHERE cid = $clientID";
    $selectResult = $SQLlink->query($selectQuery);

    if ($selectResult) {
        $existingServiceIDs = array();

        // Iterate through each row
        while ($row = $selectResult->fetch_assoc()) {
            $existingServiceID = $row['myserviceid'];
            $existingServiceIDs[$row['id']] = $existingServiceID;

            if (!$existingServiceID) {
                // myserviceid does not exist for the current row, generate and update
                $newServiceID = generateServiceID($clientID); // You need to implement this function
                updateServiceID($row['id'], $newServiceID, $servicetypeid);
                // echo $row['id']." ,";
                // echo $newServiceID;
            }
        }

        //return $existingServiceIDs;
    } else {
        // Handle the case where the select query failed
        return false;
    }
}


// // Example usage:
// $gloClientID = 123; // Replace with your client ID
// $result = checkServiceID($gloClientID);

// if ($result !== false) {
//   echo "Existing service IDs: " . implode(', ', $result);
// } else {
//   echo "Error checking/updating service IDs.";
// }




// Function to check if a Domain is up or down.
function isDomainUp($domain)
{
    $headers = @get_headers($domain);

    // Check if get_headers returns a response
    if ($headers && isset($headers[0])) {
        // Check if the response code indicates success (2xx or 3xx)
        return preg_match('/^HTTP\/\d\.\d\s+(200|30[0-9])/', $headers[0]);
    }

    // If get_headers fails, consider the domain as down
    return false;
}

// // Example usage:
// $domainToCheck = "http://example.com";
// if (isDomainUp($domainToCheck)) {
//   echo "$domainToCheck is up!";
// } else {
//   echo "$domainToCheck is down!";
// }

// function getWhoisData($domain) {
//   $apiKey = "";
//   $url = "https://www.whoisxmlapi.com/whoisserver/WhoisService?domainName=$domain&apiKey=$apiKey";
//   $response = file_get_contents($url);

//   return $response;
// }

// Example usage:
// $domainToCheck = "example.com";
// $apiKey = "YOUR_WHOISXMLAPI_KEY";
// $whoisData = getWhoisData($domainToCheck, $apiKey);

// echo "WHOIS data for $domainToCheck:\n";
// echo $whoisData;
