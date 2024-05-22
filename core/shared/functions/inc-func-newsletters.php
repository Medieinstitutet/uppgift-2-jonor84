<?

function getNewsletterslist()
{
    global $SQLlink;

    // Retrieve all active newsletters
    $sql = "SELECT id, cid, name, description, added FROM data_newsletters WHERE active = 1";
    $result = $SQLlink->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li title='" . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . "'>";
            echo "<strong>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</strong> (Skapad: " . htmlspecialchars($row['added'], ENT_QUOTES, 'UTF-8') . ")";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "No active newsletters found.";
    }
}

function getNewsletterData($userId)
{
    global $SQLlink;
    $data = array();

    // get all newsletters and check if user is subscribing or not
    $strSQL = "SELECT n.id, n.cid, n.name, n.description, n.added, CASE WHEN u.uid IS NULL THEN 0 ELSE 1 END AS subscribed 
               FROM data_newsletters n
               LEFT JOIN data_newsletters_users u ON n.id = u.newsletterid AND u.uid = $userId
               WHERE n.active = 1";

    $arrRS = mysqli_query($SQLlink, $strSQL);

    if (mysqli_num_rows($arrRS) > 0) {
        while ($arrRow = mysqli_fetch_assoc($arrRS)) {
            $data[] = $arrRow;
        }
    }

    return $data;
}

function getmyNewsletterData()
{
    global $SQLlink,$gloUID;
    $data = array();

    // Get newsletters that the user is subscribed to
    $strSQL = "SELECT n.id, n.cid, n.name, n.description, n.added
               FROM data_newsletters n
               INNER JOIN data_newsletters_users u ON n.id = u.newsletterid
               WHERE u.uid = $gloUID";

    $arrRS = mysqli_query($SQLlink, $strSQL);

    if (mysqli_num_rows($arrRS) > 0) {
        while ($arrRow = mysqli_fetch_assoc($arrRS)) {
            $data[] = $arrRow;
        }
    }

    return $data;
}

function getmyNewsletterClientData()
{
    global $SQLlink,$gloClientID;
    $data = array();

    // Get newsletters that belong to the logged-in client
    $strSQL = "SELECT id, cid, name, description, active, added
    FROM data_newsletters
    WHERE cid = $gloClientID";

    $arrRS = mysqli_query($SQLlink, $strSQL);

    if (mysqli_num_rows($arrRS) > 0) {
        while ($arrRow = mysqli_fetch_assoc($arrRS)) {
            $data[] = $arrRow;
        }
    }

    return $data;
}

function adduserNewsletter($newsletterId)
{
    global $SQLlink,$gloUID;
        
    // Add to DB
    $strSQLADD = "
    INSERT INTO data_newsletters_users 
        (newsletterid, uid)
    VALUES 
        ('$newsletterId','$gloUID')
    ";
    mysqli_query($SQLlink, $strSQLADD);
         
    $check = intval(mysqli_affected_rows($SQLlink));

    return $check;
}

function removeuserNewsletter($newsletterId)
{
    global $SQLlink,$gloUID;
        
    // Remove from DB
    $strSQLR = "DELETE FROM data_newsletters_users WHERE uid = '$gloUID' and newsletterid = '$newsletterId' LIMIT 1";
	mysqli_query($SQLlink,$strSQLR);

    $check = intval(mysqli_affected_rows($SQLlink));

    return $check;
}


function removeNewsletter($newsletterId)
{
    global $SQLlink,$gloClientID;
        
    // Remove from DB
    $strSQLR = "DELETE FROM data_newsletters WHERE cid = '$gloClientID' and id = '$newsletterId' LIMIT 1";
	mysqli_query($SQLlink,$strSQLR);

    $check = intval(mysqli_affected_rows($SQLlink));

    return $check;
}

function addNewsletter($newsletterName, $newsletterDescription, $newsletterActive)
{
    global $SQLlink,$gloUID,$gloClientID,$BRAND;

    if ($newsletterActive == "on") { $newsletterActive = 1; } else { $newsletterActive = 0; }

    // Add to DB
    $strSQLADD = "
    INSERT INTO data_newsletters
        (active, brand, name, description, cid, addeduid)
    VALUES 
        ('$newsletterActive','$BRAND','$newsletterName','$newsletterDescription','$gloClientID','$gloUID')
    ";
    mysqli_query($SQLlink, $strSQLADD);
         
    $check = intval(mysqli_affected_rows($SQLlink));

    return $check;
}

function updateNewsletter($newsletterId,$newsletterName, $newsletterDescription, $newsletterActive)
{
    global $SQLlink,$gloUID,$gloNow;
        
    if ($newsletterActive == "on") { $newsletterActive = 1; } else { $newsletterActive = 0; }

    // Update the newsletter in the database
    $strSQLEDIT = "UPDATE data_newsletters SET name = '$newsletterName', description = '$newsletterDescription', active = '$newsletterActive', updateduid = '$gloUID', updateduid = '$gloNow' WHERE id = $newsletterId";
    mysqli_query($SQLlink, $strSQLEDIT);
         
    $check = intval(mysqli_affected_rows($SQLlink));

    return $check;
}

function getNewsletterDatabyid($newsletterId)
{
    global $SQLlink;
    
    $data = array();
    
    // Get newsletter data by newsletter ID
    $strSQL = "SELECT name, description, active FROM data_newsletters WHERE id = $newsletterId";
    
    $result = mysqli_query($SQLlink, $strSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        if ($row) {
            $data['name'] = $row['name'];
            $data['description'] = $row['description'];
            $data['active'] = $row['active'];
        }
        
        mysqli_free_result($result);
    }
    
    return $data;
}


function getClientNewsletterSubscribers()
{
    global $SQLlink, $gloClientID;
    $data = array();

    // Get all users subscribed to newsletters for the specified client
    $strSQL = "SELECT u.id AS user_id, u.user_fname, u.user_sname, u.user_email,
                      nu.newsletterid AS newsletter_id, n.name AS newsletter_name, nu.added AS subscription_date
               FROM data_users u
               INNER JOIN data_newsletters_users nu ON u.id = nu.uid
               INNER JOIN data_newsletters n ON nu.newsletterid = n.id
               WHERE n.cid = $gloClientID";

    $arrRS = mysqli_query($SQLlink, $strSQL);

    if (mysqli_num_rows($arrRS) > 0) {
        while ($arrRow = mysqli_fetch_assoc($arrRS)) {
            $data[] = $arrRow;
        }
    }

    return $data;
}
