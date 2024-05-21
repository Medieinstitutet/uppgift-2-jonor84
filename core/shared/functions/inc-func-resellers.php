<?
// GLOBAL RESELLER FUNCTIONS

// GET MAINBRAND OF RESELLER
function ResellerBrand($ID)
{
    global $SQLlink, $BRAND;

    $strSQL = "SELECT mainbrand FROM data_resellers WHERE id = '$ID' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $MainBrand = $row['mainbrand'];

    if (empty($MainBrand)) { $MainBrand = "moonserver"; }

    return $MainBrand;
}

// GET NAME OF RESELLER
function ResellerName($ID)
{
    global $SQLlink, $BRAND;

    $strSQL = "SELECT companyname FROM data_resellers WHERE id = '$ID' LIMIT 1";
    $result = mysqli_query($SQLlink, $strSQL);
    $row = mysqli_fetch_assoc($result);
    $Name = $row['companyname'];

    if (empty($Name)) { $Name = "moonserver"; }

    return $Name;
}

?>