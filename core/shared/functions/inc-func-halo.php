<?
// HALO FUNCTIONS

// GET MAINBRAND FOR HALO
function HaloBrand($BRANDNAME)
{
    global $SQLlink, $BRAND;

    // GET NAME OF PARENT
    $strSQL = "SELECT mainbrand FROM data_halos WHERE brandname = '$BRANDNAME' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $MainBrand = $row['mainbrand'];

    if (empty($MainBrand)) { $MainBrand = "moonserver"; }

    return $MainBrand;
}

// GET INSTANCE FOR OPENHALO
function HaloInstance($ID)
{
    global $SQLlink, $BRAND;

    // GET NAME OF PARENT
    $strSQL = "SELECT instance FROM data_cloudapps WHERE serviceid = '$ID' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $HaloInstance = $row['instance'];

    if (empty($HaloInstance)) { $HaloInstance = "N/A"; }

    return $HaloInstance;
}


// GET HALO SITEID
function HaloSiteID($BRAND)
{
    global $SQLlink;

    $strSQL = "SELECT siteid FROM data_halos WHERE sitename = '$BRAND' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $HaloID = $row['siteid'];

    return $HaloID;
}


// GET HALO NAME
function HaloName($ID)
{
    global $SQLlink, $BRAND;

    $strSQL = "SELECT sitename FROM data_halos WHERE serviceid = '$ID'";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $HaloName = $row['sitename'];

    if (empty($HaloName)) { $HaloName = "N/A"; }

    return $HaloName;
}

// GET INSTANCE FOR OPENHALO
function checkHaloExist($ID)
{
    global $SQLlink, $BRAND;

    $strSQL = "SELECT siteid FROM data_halos WHERE serviceid = '$ID'";
    $strRes = mysqli_query($SQLlink, $strSQL);
    $HaloExist = mysqli_num_rows($strRes);
    
    if (!$HaloExist) {
        $HaloExist = "0";
    } else {
        $HaloExist = "1";
    }

    return $HaloExist;
}


// GET HALO NAME
function HaloClientID($ID)
{
    global $SQLlink, $BRAND;

    $strSQL = "SELECT clientid FROM data_halos WHERE serviceid = '$ID'";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $ClientID = $row['clientid'];

    if (empty($ClientID)) { $ClientID = 0; }

    return $ClientID;
}

// CREATE HALO SITE
// function createHalo($MYSERVICEID, $HALOTYPE)
// {
//     global $SQLlink, $gloTimeStamp, $gloNow, $SystemAdmin;
// }

// function to convert pagenames to URL:s for pages 
function MakeURL($pageName)
{
    global $SQLlink, $BRAND, $SYSTEMFOLDERS;

    $search = array('å', 'ä', 'ö', 'Å', 'Ä', 'Ö', 'Ã¥', 'Ã¤', 'Ã¶', ' ');
    $replace = array('a', 'a', 'o', 'A', 'A', 'O', 'a', 'a', 'o', '-');

    $pageName = str_replace($search, $replace, $pageName);
    $NewpageURL1 = strtolower($pageName);

    //CHECK if pagename is a forbidden name
    if (in_array($pageName, $SYSTEMFOLDERS)) { $FORBIDDENNAME = 1; } else { $FORBIDDENNAME = 0; }

    //Check if url already exists
    $strSQLCHECKURL = "SELECT id FROM data_pages WHERE url='$NewpageURL1' AND brand = '$BRAND'";
    $resultsCHECKURL = mysqli_query($SQLlink, $strSQLCHECKURL);
    $CHECKURLEXIST = mysqli_num_rows($resultsCHECKURL);

    if ($FORBIDDENNAME) {
        $RAND = rand(2, 9999);
        $NewpageURL = $NewpageURL1 . "-" . $RAND;
    } else if ($CHECKURLEXIST == 0) {
        $NewpageURL = $NewpageURL1;
    } else {
        $RAND = rand(2, 9999);
        $NewpageURL = $NewpageURL1 . "-" . $RAND;
    }

    return $NewpageURL;
}

// function to get parent name of page
function ParentUrlName($submenuPageParentID)
{
    global $SQLlink, $BRAND;

    // GET NAME OF PARENT
    $strSQL = "SELECT name FROM data_pages WHERE id = '$submenuPageParentID' AND brand = '$BRAND' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $PageNameParent = $row['name'];

    if (empty($PageNameParent)) {
        $PageNameParent = "";
    }

    return $PageNameParent;
}

// function to get parent name of group
function ParentGroupName($groupParentID)
{
    global $SQLlink, $BRAND;

    // GET NAME OF PARENT
    $strSQL = "SELECT name FROM data_groups WHERE id = '$groupParentID' AND brand = '$BRAND' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $groupNameParent = $row['name'];

    if (empty($groupNameParent)) {
        $groupNameParent = "";
    }

    return $groupNameParent;
}

// function to get parent name of group type
function ParentGroupTypeName($groupTypeID)
{
    global $SQLlink, $BRAND;

    // GET NAME OF PARENT
    $strSQL = "SELECT name FROM data_groups_types WHERE id = '$groupTypeID' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $groupTypeName = $row['name'];

    if (empty($groupTypeName)) {
        $groupTypeName = "";
    }

    return $groupTypeName;
}

// function to check if a group has subgroups
function GrouphasSubgroups($groupID)
{
    global $SQLlink, $BRAND;

    $strSQLCHECKGID = "SELECT id FROM data_groups WHERE parentid='$groupID' AND brand = '$BRAND'";
    $resultsCHECKGID = mysqli_query($SQLlink, $strSQLCHECKGID);
    $CHECKGID = mysqli_num_rows($resultsCHECKGID);

    return $CHECKGID;
}

// function to check if group is editable
function editableGroup($groupID)
{
    global $SQLlink, $BRAND;

    // GET editable from DB - 1 is editable and 0 is not editable
    $strSQL = "SELECT editable FROM data_groups WHERE brand = '$BRAND' AND id = '$groupID' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $groupEditable = $row['editable'];

    return $groupEditable;
}

// function check if page id belongs to current logged in BRAND
function PageIDBRAND($pageid)
{
    global $SQLlink, $BRAND;

    // GET NAME OF PARENT
    $strSQL = "SELECT name FROM data_pages WHERE id = '$pageid' AND brand = '$BRAND' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $PageNameExist = $row['name'];

    if (empty($PageNameExist)) {
        $PageIDexist = 0;
    } else {
        $PageIDexist = 1;
    }

    return $PageIDexist;
}

// function current url och current page id
function currentPageURL($pageid)
{
    global $SQLlink, $BRAND;

    // GET NAME OF PARENT
    $strSQL = "SELECT url FROM data_pages WHERE id = '$pageid' AND brand = '$BRAND' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $PageUrlExist = $row['url'];

    return $PageUrlExist;
}

// function check if page id is home (cannot be removed as long its home)
function PageIDHome($pageid)
{
    global $SQLlink, $BRAND;

    // GET NAME OF PARENT
    $strSQL = "SELECT home FROM data_pages WHERE id = '$pageid' AND brand = '$BRAND' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $PageHome = $row['home'];

    return $PageHome;
}

// function get StandardID for the BRAND if empty
function getStandardAppID($appid)
{
    global $SQLlink, $BRAND;

    // GET NAME OF PARENT
    $strSQL = "SELECT standardid FROM data_apps_standard WHERE appid = '$appid' AND brand = '$BRAND' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $StandardID = $row['standardid'];

    return $StandardID;
}
