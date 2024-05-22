<?php

// GLOBAL START PAGE
$strSQLSTARTPAGE = "SELECT url FROM data_pages WHERE type = 'main' AND brand = '$BRAND' and home = '1' LIMIT 1";
$resultSTARTPAGE = mysqli_query( $SQLlink, $strSQLSTARTPAGE );
$rowSTARTPAGE = mysqli_fetch_assoc( $resultSTARTPAGE );
$gloStartPage = $rowSTARTPAGE[ 'url' ];

// GET CURRENT PAGE
$ACTIVEPAGE = strstr($_SERVER['QUERY_STRING'], "=");
$ACTIVEPAGE = str_replace("=", "", $ACTIVEPAGE);

$GETSHOW = mysqli_real_escape_string( $SQLlink, $_GET[ 'show' ] );
$GETTASK = mysqli_real_escape_string( $SQLlink, $_GET[ 'task' ] );
$GETVIEW = mysqli_real_escape_string( $SQLlink, $_GET[ 'view' ] );
$GETAPPAGE = mysqli_real_escape_string( $SQLlink, $_GET[ 'p' ] );

// MODULE FUNCTIONS

// GET CORE MODULE/APP
$GETMODULE = mysqli_real_escape_string( $SQLlink, $_GET[ "module" ] );
$strModule = ( isset( $_GET[ "module" ] ) ) ? $_GET[ "module" ] : "dashboard";

// function to get home id on group pages
function GroupPageHome($groupid) { 
  global $SQLlink,$BRAND;
        
  $strSQL = "SELECT url FROM data_pages WHERE home = '1' AND type = 'group' AND groupid = '$groupid' AND brand = '$BRAND' LIMIT 1";
  $result = mysqli_query( $SQLlink, $strSQL );
  $row = mysqli_fetch_assoc( $result );
  $PageHome = $row[ 'url' ];
        
  return $PageHome;
}

// GET CURRENT GROUPS PAGE HOME ID
$gloGroupHomePage = GroupPageHome($GETVIEW);
if (empty($GETAPPAGE)) { $GETAPPAGE = $gloGroupHomePage; } 

//check if any pages exist under this BRAND
$strSQLActivepages = "SELECT count(id) FROM data_pages WHERE type = 'main' AND parent = '' AND hidden = '0' AND active = '1' AND brand = '$BRAND'";
$strSQLActiveGrouppages = "SELECT count(id) FROM data_pages WHERE type = 'group' AND groupid='$GETVIEW' AND parent = '' AND hidden = '0' AND active = '1' AND brand = '$BRAND'";

if ($GETMODULE == "groups") { 
  $strResActivepages = mysqli_query($SQLlink,$strSQLActiveGrouppages);
} else { 
  $strResActivepages = mysqli_query($SQLlink,$strSQLActivepages);
}

$Activepages = mysqli_fetch_array($strResActivepages);

$gloActiveMenupagesExist = $Activepages[ '0' ];
if (empty($gloActiveMenupagesExist)) { $gloActiveMenupagesExist = 0; }

// GET ACTIVE PAGE DATA
$strSQLACTIVEPAGE = "
 SELECT 
  t1.id,
  t1.name, t1.content, t1.app, t1.added, t1.addeduid, 
  t1.updated, t1.updateduid, t1.url, t1.parent, t1.typeid,
  t1.placeapp,
  t2.standardid  
 FROM data_pages as t1
 LEFT JOIN data_apps_standard AS t2 
 ON t1.app = t2.app 
 WHERE t1.type = 'main' AND t1.hidden = '0' AND t1.active = '1' AND t1.brand = '$BRAND' AND t1.url = '$ACTIVEPAGE'
";

// GET ACTIVE GROUP PAGE DATA
$strSQLACTIVEGROUPPAGE = "
 SELECT 
  t1.id,
  t1.name, t1.content, t1.app, t1.added, t1.addeduid, 
  t1.updated, t1.updateduid, t1.url, t1.parent, t1.typeid,
  t1.placeapp,
  t2.standardid  
 FROM data_pages as t1
 LEFT JOIN data_apps_standard AS t2 
 ON t1.app = t2.app 
 WHERE t1.type = 'group' AND t1.groupid = '$GETVIEW' AND t1.hidden = '0' AND t1.active = '1' AND t1.brand = '$BRAND' AND t1.url = '$GETAPPAGE'
";

if ($GETMODULE == "groups") { 
  $resultACTIVEPAGE = mysqli_query( $SQLlink, $strSQLACTIVEGROUPPAGE );
} else { 
  $resultACTIVEPAGE = mysqli_query( $SQLlink, $strSQLACTIVEPAGE );
}

$rowACTIVEPAGE = mysqli_fetch_assoc( $resultACTIVEPAGE );

$gloActivePageID = $rowACTIVEPAGE[ 'id' ];
$gloActivePageName = $rowACTIVEPAGE[ 'name' ];
$gloActivePageContent = $rowACTIVEPAGE[ 'content' ];
$gloActivePageApp = $rowACTIVEPAGE[ 'app' ];
$gloActivePageAdded = $rowACTIVEPAGE[ 'added' ];
$gloActivePageAddedUID = $rowACTIVEPAGE[ 'addeduid' ];
$gloActivePageUpdated = $rowACTIVEPAGE[ 'updated' ];
$gloActivePageUpdatedUID = $rowACTIVEPAGE[ 'updateduid' ];
$gloActivePageURL = $rowACTIVEPAGE[ 'url' ];
$gloActivePageParent = $rowACTIVEPAGE[ 'parent' ];
$gloActivePageAppTypeID = $rowACTIVEPAGE[ 'typeid' ];
$gloActivePagePlaceApp = $rowACTIVEPAGE[ 'placeapp' ];

$gloActivePageAppStandardID = $rowACTIVEPAGE[ 'standardid' ];


// Check if there is a appid 
// if (empty($gloActivePageAppTypeID)) { $gloActivePageAppTypeID = $gloActivePageAppStandardID; }


//check if active page exist
$strSQLActivepage = "SELECT count(id) FROM data_pages WHERE type = 'main' AND url = '$gloActivePageURL' AND hidden = '0' AND active = '1' AND brand = '$BRAND'";
$strSQLActiveGrouppage = "SELECT count(id) FROM data_pages WHERE type = 'group' AND groupid = '$GETVIEW' AND url = '$GETAPPAGE' AND hidden = '0' AND active = '1' AND brand = '$BRAND'";

  if ($GETMODULE == "groups") { 
    $strResActivepage = mysqli_query($SQLlink,$strSQLActiveGrouppage);
  } else { 
    $strResActivepage = mysqli_query($SQLlink,$strSQLActivepage);
  }

$Activepage = mysqli_fetch_array($strResActivepage);

$gloActivepageExist = $Activepage[ 0 ];
if (empty($gloActivepageExist)) { $gloActivepageExist = 0; }
$gloActivepageExist2 = 1;

//GET TOTAL SUBPAGES OF ACTIVE PAGE
$strSQLTotalSubPages = "SELECT count(id) FROM data_pages WHERE parent = '$gloActivePageURL' AND type = 'main' AND hidden = '0' AND active = '1' AND brand = '$BRAND'";
$strResTotalSubPages = mysqli_query($SQLlink,$strSQLTotalSubPages);
$TotalSubPages = mysqli_fetch_array($strResTotalSubPages);

$gloTotalSubPages = $TotalSubPages[ '0' ];
if (empty($gloTotalSubPages)) { $gloTotalSubPages = 0; }

//GET TOTAL SUBPAGES OF PARENT PAGE
$strSQLTotalSubPagesParent = "SELECT count(id) FROM data_pages WHERE url = '$gloActivePageParent' AND type = 'main' AND hidden = '0' AND active = '1' AND brand = '$BRAND'";
$strResTotalSubPagesParent = mysqli_query($SQLlink,$strSQLTotalSubPagesParent);
$TotalSubPagesParent = mysqli_fetch_array($strResTotalSubPagesParent);

$gloTotalSubPagesParent = $TotalSubPagesParent[ '0' ];
if (empty($gloTotalSubPagesParent)) { $gloTotalSubPagesParent = 0; }


if ($gloActivePageName) {
    $SHOWNAME = $gloActivePageName;
    $pageURL = MakeURL($gloActivePageName);
  } else { 
    $SHOWNAME = "Namn saknas";
    $pageURL = "404";
  }

?>