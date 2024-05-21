<?
// SITE FUNCTIONS

// GET INSTANCE FOR OPENSITE
function SiteInstance($ID)
{
    global $SQLlink, $BRAND;

    // GET NAME OF PARENT
    $strSQL = "SELECT instance FROM data_cloudapps WHERE serviceid = '$ID' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $SiteInstance = $row['instance'];

    if (empty($SiteInstance)) { $SiteInstance = "N/A"; }

    return $SiteInstance;
}


// GET SITE SITEID
function SiteSiteID($ID)
{
    global $SQLlink;

    $strSQL = "SELECT siteid FROM data_sites WHERE serviceid = '$ID' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $SiteID = $row['siteid'];

    return $SiteID;
}


// GET SITE NAME
function SiteName($ID)
{
    global $SQLlink, $BRAND;

    $strSQL = "SELECT sitename FROM data_sites WHERE serviceid = '$ID'";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $SiteName = $row['sitename'];

    if (empty($SiteName)) { $SiteName = "N/A"; }

    return $SiteName;
}

// CHECK IF SITE EXIST
function checkSiteExist($ID)
{
    global $SQLlink, $BRAND;

    $strSQL = "SELECT siteid FROM data_sites WHERE serviceid = '$ID'";
    $strRes = mysqli_query($SQLlink, $strSQL);
    $SiteExist = mysqli_num_rows($strRes);
    
    if (!$SiteExist) { $SiteExist = 0; } else { $SiteExist = 1; }
    
    return $SiteExist;
}

?>