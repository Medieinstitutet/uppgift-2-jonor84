<? 
// GLOBAL LOGGED IN USERS CLIENTDATA

// CHECK IF LOGGED IN USER IS ALLOWED TO ACCESS CURRENT CLIENT DATA
$strSQLAccessC = "SELECT id FROM data_clients_access WHERE cid = '$gloCurrentClientID' AND accepted = '1' AND uid = '$gloUID'";
$strResAccessC = mysqli_query($SQLlink,$strSQLAccessC);
$gloAccessClient = mysqli_num_rows($strResAccessC);

if (!$gloAccessClient) {
$gloAllowedClient = 0;
} else { 

    // if ($gloClientAccessSites) { 
    //     $gloAllowedClient = 1;
    // } else { 
    //     $gloAllowedClient = 0;
    // }
    $gloAllowedClient = 1;

// GLOBAL CLIENT DATA
$strSQLC = "
SELECT 
 t1.id,
 t1.companyname,t1.contactname,t1.phone,t1.email,t1.active,
 t1.town,t1.added,t1.updated,t1.info,t1.paddress,
 t1.pzip,t1.ptown,t1.iaddress,t1.izip,t1.itown,
 t2.country_name 
FROM data_clients AS t1 
LEFT JOIN data_countrys AS t2 
ON t1.countryid = t2.id 
WHERE t1.id = '$gloCurrentClientID'
LIMIT 1";
$arrRSC = mysqli_query( $SQLlink, $strSQLC );
while ( $ClientRow = mysqli_fetch_row( $arrRSC ) ) {
//RESELLER DATA
$gloClientID = $ClientRow[ 0 ];

$gloClientCompany = $ClientRow[ 1 ];
$_SESSION['ACTIVECLIENT'] = $gloClientCompany;  
$gloACTIVECLIENTID = $_SESSION['ACTIVECLIENT'];

$gloClientContact = $ClientRow[ 2 ];
$gloClientPhone = $ClientRow[ 3 ];
$gloClientEmail = $ClientRow[ 4 ];
$gloClientActive = $ClientRow[ 5 ];

$gloClientHQTown = $ClientRow[ 6 ];
$gloClientAdded = date( 'Y-m-d H:i', $ClientRow[ 7 ] );
$gloClientUpdated = date( 'Y-m-d H:i', $ClientRow[ 8 ] );
$gloClientInfo = $ClientRow[ 9 ];
$gloClientAddress = $ClientRow[ 10 ];

$gloClientZip = $ClientRow[ 11 ];
$gloClientTown = $ClientRow[ 12 ];
$gloClientIAdress = $ClientRow[ 13 ];
$gloClientIZip = $ClientRow[ 14 ];
$gloClientITown = $ClientRow[ 15 ];

// COUNTRY DATA
$gloClientCountryName = $ClientRow[ 16 ];
}
}

?>