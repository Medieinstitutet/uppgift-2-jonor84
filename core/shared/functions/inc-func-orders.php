<?
// ORDER FUNCTIONS

//AUTO CREATE INVOICE DRAFT ON ORDERS
function createInvoiceOrder($ORDERID)
{
    global $SQLlink, $gloTimeStamp, $gloNow, $SystemAdmin, $BRAND;

    //GLOBAL DATA 
    // $MYSERVICEID = "";
    $CurrencyID        = 1; // currency currencyid
    $RotRut            = 0; // rotrut
    $StatusID = 3; //status statusid draft/utkast 3 sent

    //GET SERVICE DATA
    $strSQLSD = "
			SELECT 
			 t1.cid,
			 t1.rid,t1.firstpay,t1.periodpay,t1.term,t1.campaigncode,
			 t1.domain,t1.sid,t1.csid,t1.sname,
             t2.se_name,
             t3.id, t3.se_name,
			 t4.companyname, t4.companyid, t4.vatid, t4.phone, t4.email,
			 t4.iemail, t4.countryid, t4.iaddress, t4.izip, t4.itown, 
			 t4.contactname
			FROM data_orders AS t1 
			LEFT JOIN data_services AS t2 
			ON t1.sid = t2.id
			LEFT JOIN data_servicetypes AS t3 
			ON t1.typeid = t3.id
			LEFT JOIN data_clients AS t4 
			ON t1.cid = t4.id
			WHERE t1.id = '$ORDERID'
			";
    $arrRSSD = mysqli_query($SQLlink, $strSQLSD);
    while ($arrRow = mysqli_fetch_row($arrRSSD)) {

        // PUT RS IN VARS - SERVICE DATA
        $ClientID = $arrRow[0]; // t1.cid
        $ResellerID = $arrRow[1]; // t1.rid
        $ServiceFirstPay = $arrRow[2]; // t1.firstpay
        $ServicePeriodPay = $arrRow[3]; // t1.periodpay
        $PERIOD = $arrRow[4]; // t1.term -> period
        $Campaigncode = $arrRow[5]; // t1.campaigncode
        $Domain = $arrRow[6]; // t1.domain
        $ServiceID = $arrRow[7]; // t1.sid
        $CustomerServiceID = $arrRow[8]; // t1.csid
        $ServiceOwnName = $arrRow[9]; // t1.sname customers own service name

        $ServiceName = $arrRow[10]; // t2.se_name example My Gameplace /Min Spelplats

        // SERVICE TYPE   
        $ServiceTypeID = $arrRow[11]; // t3.id servicetype id 
        $ServiceTypeName = $arrRow[12]; // t3.se_name servicetype name

        // CLIENT DATA
        $ClName                    = $arrRow[13]; //t4.companyname get client org name
        $ClIDNR                    = $arrRow[14]; //t4.companyid get client org/personnummer
        $ClientVAT                = $arrRow[15]; //t4.vatid get client vat

        $CLPhone                 = $arrRow[16]; //t4.phone get client phone
        $CLEmail                 = $arrRow[17]; //t4.email get client email
        $CLIEmail                 = $arrRow[18]; //t4.iemail get client iemail
        $CLCountryID               = $arrRow[19]; //t4.countryid get client countryid
        $CLAddress                 = $arrRow[20]; //t4.iaddress get client address

        $CLZip                     = $arrRow[21]; //t4.izip get client zip
        $CLTown                    = $arrRow[22]; //t4.itown get client town
        $CLRef                    = $arrRow[23]; //t4.contactname get client reference

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
    } // days   

    //SERVICE DATA TO ADD ON INVOICE ROW
    // EXAMPLE: "Hall/Bilbingon.se / Min Spelplats: Arena X 2023"
    // EXAMPLE: "Hemsideabonnemang / MoonSite Luna -> 2023-03-27"
    // $ServiceTypeName."/".$ServiceName." ".$ServiceOwnName." ->".$NewExpireDate;

    $ProductDesc     = $ServiceTypeName . "/" . $ServiceName . " (" . $ServiceOwnName . ")" . $NewExpireDate;
    $ProductCount    = 1;
    $ProductVAT      = 25;
    $ProductPrice     = $ServiceFirstPay;
    $TotalSum1 = $ServiceFirstPay * 1.25; //Add total sum with swedish moms/tax included
    $SYSUSER = 0;

    $TotalSum = str_replace(",", ".", $TotalSum1);
    $DateDue = date('Y-m-d', strtotime($gloNow . ' + ' . $PayDays . ' days'));


    //CREATE NEW INVOICE
    $strSQLI = "
        INSERT INTO data_invoices 
         (serviceid,myserviceid,orderid,brand,reseller_id, status, days, currency, rotrut,
          client_id, name, idnr, vatid, phone,
          email, countryid, zip, town, address, 
		  totalsum,invoicetext,reference,created_date,due_date) 
        VALUES 
         ('$ServiceID','$CustomerServiceID','$ORDERID','$BRAND','$ResellerID','$StatusID','$PayDays','$CurrencyID','$RotRut',
          '$ClientID','$ClName','$ClIDNR','$ClientVAT','$CLPhone',
          '$CLIEmail','$CLCountryID','$CLZip','$CLTown','$CLAddress',
          '$TotalSum','$Description','$CLRef', '$gloTimeStamp', '$DateDue')";
    mysqli_query($SQLlink, $strSQLI);

    $CreatedINVID = $SQLlink->insert_id;

    // INSERT SERVICE INTO PRODUCT ROW ON INVOICE
    $strSQL1 = "
        INSERT INTO data_invoice_rows 
         (brand,invoice_id,description,count,vat,price,added,addeduser,updated,updateduser) 
        VALUES 
         ('$BRAND','$CreatedINVID','$ProductDesc','$ProductCount','$ProductVAT','$ProductPrice','$gloTimeStamp','$SYSUSER','$gloTimeStamp','$SYSUSER')";
    mysqli_query($SQLlink, $strSQL1);

    return $CreatedINVID;
}
