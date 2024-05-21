<?
// GLOBAL BRANDING FUNCTIONS


// GET BRAND NAME from password key
function BrandNameFromPasswordKey($KEY)
{
    global $SQLlink;

    $strSQL = "SELECT brand FROM data_pw_reset WHERE valid = 'Y' AND hash = '$KEY' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $BrandName = $row['brand'];

    return $BrandName;
}

// GET BRAND NAME
function BrandName($BrandID)
{
    global $SQLlink;

    // GET NAME OF PARENT
    $strSQL = "SELECT brandname FROM data_branding WHERE id = '$BrandID' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $BrandName = $row['brandname'];

    return $BrandName;
}

// GET BRAND ID
function BrandID($BRAND)
{
    global $SQLlink;

    // GET NAME OF PARENT
    $strSQL = "SELECT id FROM data_branding WHERE brandname = '$BRAND' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $BrandID = $row['id'];

    return $BrandID;
}

// GET BRAND Reseller ID
function getBrandRID($BRAND)
{
    global $SQLlink;

    // GET NAME OF PARENT
    $strSQL = "SELECT rid FROM data_branding WHERE brandname = '$BRAND' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $BrandID = $row['rid'];

    return $BrandID;
}


// GET BRAND SMS NAME
function getBrandSMSName($BRAND)
{
    global $SQLlink;

    $strSQL = "SELECT smsname FROM data_branding WHERE brandname = '$BRAND' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $BrandSMSName = $row['smsname'];

    return $BrandSMSName;
}

// GET BRAND Site NAME
function getBrandSiteName($BRAND)
{
    global $SQLlink;

    $strSQL = "SELECT sitename FROM data_branding WHERE brandname = '$BRAND' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $BrandSiteName = $row['sitename'];

    return $BrandSiteName;
}


// GET BRAND Company NAME
function getBrandcompanyName($BRAND)
{
    global $SQLlink;

    $strSQL = "SELECT companyname FROM data_branding WHERE brandname = '$BRAND' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $BrandCompanyName = $row['companyname'];

    return $BrandCompanyName;
}

?>