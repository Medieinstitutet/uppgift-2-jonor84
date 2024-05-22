<?
// CLIENTS FUNCTIONS

// Generate uniqe ClientID 
function generateClientID()
{
    $currentYear = date("y");
    $zerodivider = 0;
    $randomPart = generateRandomNonZeroDigits(7); // Generate a 5-digit number without zeros
    $randomString = $currentYear . $zerodivider . $randomPart;
    return $randomString;
}


// GET MAINBRAND FOR CLIENT
function ClientBrand($ID)
{
    global $SQLlink, $BRAND;

    // GET NAME OF PARENT
    $strSQL = "SELECT mainbrand FROM data_clients WHERE id = '$ID' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $MainBrand = $row['mainbrand'];

    // if (empty($MainBrand)) { $MainBrand = "moonserver"; }

    return $MainBrand;
}

//GET CLIENTID ON BRAND 
function BrandClientID($BrandID)
{
    global $SQLlink, $BRAND;

    $strSQL = "SELECT cid FROM data_branding WHERE id = '$BrandID'";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $ClientID = $row['cid'];

    return $ClientID;
}

//GET COMPANYNAME FROM CID
function CompanyName($CID)
{
    global $SQLlink;

    $strSQL = "SELECT * FROM data_clients WHERE id = '$CID'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CHECK = mysqli_num_rows($results);

    if ($CHECK != 0) {

        // GET companyname FROM DATABASE
        $strSQL = "
			SELECT 
			companyname
			FROM data_clients
			WHERE id = '$CID'
			LIMIT 1";
        $result = mysqli_query($SQLlink, $strSQL);
        $row = mysqli_fetch_assoc($result);

        $COMPANY = $row['companyname'];
        return $COMPANY;
    }
}

//GET invoice email from FROM CID
function InvoiceEmail($CID)
{
    global $SQLlink;

    $strSQL = "SELECT * FROM data_clients WHERE id = '$CID'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CHECK = mysqli_num_rows($results);

    if ($CHECK != 0) {

        // GET email,iemail FROM DATABASE
        $strSQL = "
			SELECT 
			email,iemail
			FROM data_clients
			WHERE id = '$CID'
			LIMIT 1";
        $result = mysqli_query($SQLlink, $strSQL);
        $row = mysqli_fetch_assoc($result);

        $COMPANYEMAIL = $row['email'];
        $COMPANYIEMAIL = $row['iemail'];

        if (!$COMPANYIEMAIL) {
            $COMPANYIEMAIL = $COMPANYEMAIL;
        }

        return $COMPANYIEMAIL;
    }
}

//GET COMPANY CONTACT FROM CID
function CompanyReference($CID)
{
    global $SQLlink;

    $strSQL = "SELECT * FROM data_clients WHERE id = '$CID'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CHECK = mysqli_num_rows($results);

    if ($CHECK != 0) {

        // GET contactname FROM DATABASE
        $strSQL = "
			SELECT 
			contactname
			FROM data_clients
			WHERE id = '$CID'
			LIMIT 1";
        $result = mysqli_query($SQLlink, $strSQL);
        $row = mysqli_fetch_assoc($result);

        $COMPANYContact = $row['contactname'];
        return $COMPANYContact;
    }
}
