<?
// HALO SITE FUNCTIONS

// OLD VERSION! NEEDS TO BE UPDATED

function getSubpages($tmpID,$tmpLevel,$SQLlink) { 
    global $SQLlink, $strModule,$iconEdit, $iconDel, $iconUp, $iconDown,$tmpID,$tmpLevel;
    
    if (!$tmpLevel) { $tmpLevel = 1; }
    
    $strSQL2 = "SELECT id, page_topic, page_updated, page_sort FROM data_pages WHERE parent_id = $tmpID ORDER BY page_sort ASC";
    $tmpSQL = mysqli_query($SQLlink,$strSQL2); 

    if (!mysqli_num_rows($tmpSQL))  {
        return; 
    }
    else {   	
        while($tmpRow=mysqli_fetch_row($tmpSQL)) { 
            $rowID = $tmpRow[0];
            $rowName = $tmpRow[1];
            $rowUpdated = date("Y-m-d", strtotime($tmpRow[2]));
            $rowMargin = ($tmpLevel-1) * 10 + 10;
            $rowPrefix = "<img src='http://system.voby.se/s2/admin/_system/tree.gif' alt='Undersida' style='margin-left:{$rowMargin}px;'>";
            $intSort = $tmpRow[3];
            echo "
            <tr>
            <td>$rowPrefix <a href='?module=$strModule&show=edit&id=$rowID' title='&Auml;ndra'>$rowName ($intSort)</a></th>
            <td>$rowUpdated</th>
            <td><a href='?module=$strModule&task=sort&sort=mu&id=$rowID'><img src='$iconUp' alt='Flytta upp' /></a></th>
            <td><a href='?module=$strModule&task=sort&sort=md&id=$rowID'><img src='$iconDown' alt='Flytta ner' /></a></th>
            <td><a href='?module=$strModule&show=edit&id=$rowID' title='&Auml;ndra'><img src='$iconEdit' alt='&Auml;ndra' /></a></td>
            <td><a class='dialog_delete' href='_modules/$strModule/show_delete.php?module=$strModule&task=delete&id=$rowID' title='Ta bort'><img src='$iconDel' alt='Ta bort' /></a></td>
            </tr>";
            getSubpages($rowID,($tmpLevel+1));
            
        } 
    }
} 

function getListofsubs($tmpID,$tmpLevel,$tmpNeedle,$SQLlink) {
    global $SQLlink, $intID,$tmpID,$tmpLevel,$tmpNeedle;
    
    if (!$tmpLevel) { $tmpLevel = 1; }
    
    $strSQL3 = "SELECT id, page_topic FROM data_pages WHERE parent_id = $tmpID ORDER BY page_sort ASC";
    
    $tmpSQL = mysqli_query($SQLlink,$strSQL3); 

    if (!mysqli_num_rows($tmpSQL))  {
        return; 
    }
    else {   	
        while($tmpRow=mysqli_fetch_row($tmpSQL)) { 
            $rowID = $tmpRow[0];
            $rowName = $tmpRow[1];
            $rowPrefix = str_repeat("-", $tmpLevel);
            if ($rowID!=$intID) {
                if ($rowID==$tmpNeedle) { echo "<option value='$rowID' selected>$rowPrefix $rowName</option>"; }
                else { echo "<option value='$rowID'>$rowPrefix $rowName</option>"; }
                getListofsubs($rowID,($tmpLevel+1),$tmpNeedle); 
            }
        } 
    }
} 

function delPage($tmpID,$SQLlink) { 
global $SQLlink,$tmpID;

    if (!$tmpID) { return; }
    
    delSubspages($rowID); 

    $strSQL4 = "SELECT parent_id, page_sort FROM data_pages WHERE id = $tmpID LIMIT 1";

    $tmpSQL = mysqli_query($SQLlink,$strSQL4);
            
    if (mysql_num_rows($tmpSQL))  { 	
        while($tmpRow=mysql_fetch_row($tmpSQL)) { 
            $tmpPID = $tmpRow[0];
            $tmpSort = $tmpRow[1]; 
        } 
    }

    $strSQL5 = "UPDATE data_pages SET page_sort = (page_sort-1) WHERE parent_id = $tmpPID AND page_sort > $tmpSort";
    mysqli_query($SQLlink,$strSQL5); 
            
    $strSQL6 = "DELETE FROM data_pages WHERE id = $tmpID";	
    mysqli_query($SQLlink,$strSQL6);
            
    if (mysql_affected_rows()>=1) {
        return true;
    }
    else {
        return false;
    }
} 

function delSubspages($tmpID,$SQLlink) {
global $SQLlink,$tmpID;

    if (!$tmpID) { return; }
    
    $strSQL6 = "SELECT id FROM data_pages WHERE parent_id = $tmpID ORDER BY page_sort ASC";
    $tmpSQL = mysqli_query($SQLlink,$strSQL6); 

    if (mysql_num_rows($tmpSQL))  { 	
        while($tmpRow=mysqli_fetch_row($tmpSQL)) { 
            $rowID = $tmpRow[0];
            delSubspages($rowID); 
        } 
    }
}
    
function sortPages($tmpParentID,$SQLlink) { 
global $SQLlink,$tmpParentID;

    $tmpParentID = (is_int($tmpParentID)) ? $tmpParentID : NULL;
    
    $strSQL7 = "SELECT id FROM data_pages WHERE (parent_id = $tmpParentID AND $tmpParentID IS NOT NULL) OR (parent_id IS NULL AND $tmpParentID IS NULL) ORDER BY page_sort ASC";
    $tmpSQL = mysqli_query($SQLlink,$strSQL7); 

    if (!mysqli_num_rows($tmpSQL))  {
        return false; 
    }
    else {
        $i = 1;
        while($tmpRow=mysqli_fetch_row($tmpSQL)) { 
            $rowID = $tmpRow[0];
            
            $strSQL8 = "UPDATE data_pages SET page_sort = $i WHERE id = $rowID LIMIT 1";
            mysqli_query($SQLlink,$strSQL6);
            
            $i++;
        } 
    }
} 

?>