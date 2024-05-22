<?
// INVOICE FUNCTIONS

//GET ClientID FROM Invoice
function ClientIDInvoice($INVOICEID)
{
    global $SQLlink;

    $strSQL = "SELECT * FROM data_invoices WHERE id = '$INVOICEID'";
    $results = mysqli_query($SQLlink, $strSQL);
    $CHECK = mysqli_num_rows($results);

    if ($CHECK != 0) {

        // GET clientid FROM DATABASE
        $strSQL = "
			SELECT 
			    client_id
			FROM data_invoices
			WHERE id = '$INVOICEID'
			LIMIT 1";
        $result = mysqli_query($SQLlink, $strSQL);
        $row = mysqli_fetch_assoc($result);

        $CID = $row['client_id'];
        return $CID;
    }
}


function sendStatusInvoicePayed($INVOICEID, $Paydate)
{
    global $gloAdminsEmail, $SystemAdmin, $gloBrandLogoMailShow, $gloBrandSiteName, $BRAND;

    $CLIENTID = ClientIDInvoice($INVOICEID);
    $ClientInvoiceEmail = InvoiceEmail($CLIENTID);
    $ClientCompany = CompanyName($CLIENTID);
    $ClientCompanyRef = CompanyReference($CLIENTID);

    // MAIL USER ABOUT INVOICE PAYED        
    $mailToAddress = $ClientInvoiceEmail;
    $mailToName = $ClientCompanyRef;
    $mailReplyAddress = $gloAdminsEmail;
    $mailReplyName = $gloBrandSiteName;
    $mailSubject = "Din betalning har mottagits (faktura #" . $INVOICEID . ") - " . $gloBrandSiteName;
    $mailMessage = "<p>Tack för din betalning på faktura #" . $INVOICEID . ". Betalningen mottogs " . $Paydate . "</p>";

    sendMailPM($mailToAddress, $mailToName, $mailSubject, $mailMessage, $mailReplyAddress, $mailReplyName);
}

function sendStatusInvoiceCancelled($INVOICEID)
{
    global $gloAdminsEmail, $SystemAdmin, $gloBrandLogoMailShow, $gloBrandSiteName, $BRAND;

    $CLIENTID = ClientIDInvoice($INVOICEID);
    $ClientInvoiceEmail = InvoiceEmail($CLIENTID);
    $ClientCompany = CompanyName($CLIENTID);
    $ClientCompanyRef = CompanyReference($CLIENTID);

    // MAIL USER ABOUT INVOICE CANCELLED / MAKULERAD     
    $mailToAddressAdmin = "johan@moonserver.se";
    $mailToNameAdmin = "Johan";
    $mailSubjectAdmin = "Faktura #" . $INVOICEID . " har makulerats - " . $gloBrandSiteName;

    $mailToAddress = $ClientInvoiceEmail;
    $mailToName = $ClientCompanyRef;
    $mailReplyAddress = $gloAdminsEmail;
    $mailReplyName = $gloBrandSiteName;
    $mailSubject = "Din faktura #" . $INVOICEID . " har makulerats - " . $gloBrandSiteName;

    $mailMessage  = "<p>Din faktura med nummer #" . $INVOICEID . " har makulerats.<br></p>";

    sendMailPM($mailToAddress, $mailToName, $mailSubject, $mailMessage, $mailReplyAddress, $mailReplyName);

    //sendMailPM($mailToAddressAdmin, $mailToNameAdmin, $mailSubjectAdmin, $mailMessage, $mailReplyAddress, $mailReplyName);
}

// SEND INVOICE DRAFT
function sendInvoice($INVOICEID)
{
    global $gloBrandLoginURL, $gloINVOICEPAYURL, $SQLlink, $gloTimeStamp, $gloNow, $SystemAdmin, $gloBrandSiteName, $BRAND;

    //GET INVOICE DATA
    $strSQLSD = "
    	SELECT 
    	 client_id,reseller_id,name,reference,email,totalsum,days,created_date,orgiemail
    	FROM data_invoices
    	WHERE id = '$INVOICEID'
    	";
    $arrRSSD = mysqli_query($SQLlink, $strSQLSD);
    while ($arrRow = mysqli_fetch_row($arrRSSD)) {

        // PUT RS IN VARS - SERVICE DATA
        $ClientID = $arrRow[0]; // client_id
        $ResellerID     = $arrRow[1]; // reseller_id
        $ClientCompany  = $arrRow[2]; // name
        $ClientRef      = $arrRow[3]; // reference
        $ClientEmail      = $arrRow[4]; // email
        $Amount         = $arrRow[5]; // totalsum 
        $Days            = $arrRow[6]; // days
        $Date = date('Y-m-d', $arrRow[7]); // t1.created_date
        $OrgInvoiceMail = $arrRow[8]; // orgiemail

    }

    if (!$OrgInvoiceMail) {
        $OrgInvoiceMail = $ClientEmail;
    }
    if ($Amount == 0) {
        $InvoicePayed = 1;
    } else {
        $InvoicePayed = 0;
    }

    $dateStringSent = strtotime($Date);
    $dateStringDue  = strtotime($Date . ' +' . $Days . ' days');

    // PREPARE INVOICE LINK/URL
    $MSTYPE  = "invoice"; // invoice, estimate etc
    $MSPASS = "johan"; // to double check url key on external site
    $MSADDED = date('Y-m-d'); // todays date
    $MSEXPIRY = date('Y-m-d', strtotime($MSADDED . ' + 12 months')); // expiry date 12 months

    //CREATING URLCODE
    $MSKEY = generateRandomString(); // for url

    //MAKE INVOICE URL
    $INVOICEURL = $gloBrandLoginURL . $gloINVOICEPAYURL . "?c=" . $MSKEY;
    $INVOICEURLPDF = $gloBrandLoginURL . $gloINVOICEPAYURL . "?c=" . $MSKEY . "&pdf=1";

    //Add to data_viewaccess so client can open invoice with url
    $strSQLSEND = "
		INSERT INTO data_viewaccess 
		 (mskey,brand,clientid,type,typeid,apass,added,expiry) 
		VALUES 
		 ('$MSKEY','$BRAND','$ClientID','$MSTYPE','$INVOICEID','$MSPASS','$MSADDED','$MSEXPIRY')";
    mysqli_query($SQLlink, $strSQLSEND);

    $checkFirst = mysqli_affected_rows($SQLlink);

    // SEND EMAIL
    $mailToAddress = $ClientEmail;
    $mailToName = $ClientRef;

    $mailToAddressEconomy = "moonserverab_8388@blarkiv.se";
    $mailToNameEconomy = "Moonserver Ekonomi";

    $mailSubject = "Ny faktura från " . $gloBrandSiteName;
    $mailSubjectEconomy = "Ny faktura skickad till " . $mailToName . " (" . $mailToAddress . ")";

    $mailReplyAddress = "";
    $mailReplyName = "";

    $mailMessage = "
        <a rel='noopener' target='_blank' href='" . $INVOICEURL . "' style='background-color: #dbeefc; font-size: 14px; font-weight: bold; text-decoration: none; padding: 10px 20px; color: #ffffff; border-radius: 5px; margin-top:2px; display: inline-block; mso-padding-alt: 0;'>
            <!--[if mso]>
            <i style='letter-spacing: 25px; mso-font-width: -100%; mso-text-raise: 30pt;'>&nbsp;</i>
            <![endif]-->
            <span style='mso-text-raise: 15pt;'>Visa faktura &rarr;</span>
            <!--[if mso]>
            <i style='letter-spacing: 25px; mso-font-width: -100%;'>&nbsp;</i>
            <![endif]-->
        </a>
        <p>Om det inte går att klicka på knappen, <a href='" . $INVOICEURL . "' target='_blank' style='color: #b59836;'>klicka här istället</a>.</p>
    ";

    sendMailPDF($mailToAddress, $mailToName, $mailSubject, $mailMessage, $mailReplyAddress, $mailReplyName, $INVOICEID, $ClientID);

    // sendMail($mailToAddressEconomy, $mailToNameEconomy, $mailSubjectEconomy, $mailMessage, $mailReplyAddress, $mailReplyName, array('name' => 'invoice_' . $INVOICEID . '.pdf', 'attachment' => $att));


    if ($InvoicePayed) {
        $StatusID = 5; //BETALD / PAYED
        $PayDate = $gloTimeStamp;
        $AdminNotes = "Fakturan är på 0 kr och blir då status betald direkt.";
    } else {
        $StatusID = 3; //OBETALD / UNPAYED
        $PayDate = "";
        $AdminNotes = "";
    }

    $Sent = 1; //1 for sent
    $DeliveryTypeID = 1; //1 Email

    // UPDATE INVOICE
    $strSQLUpdateINVSENT = "
		UPDATE data_invoices 
		SET 
		 mskeypdf='$INVOICEURLPDF',
		 mskey='$INVOICEURL',
		 sent_typeid='$DeliveryTypeID',
		 status='$StatusID',
		 sent='$Sent',
		 sent_date='$dateStringSent', 
		 sent_savedate='$dateStringSent', 
		 adminnotes='$AdminNotes',
		 updateduid='0', 
		 updated='$gloTimeStamp',
		 paydate='$PayDate',
		 due_date='$dateStringDue' 
		WHERE id = '$INVOICEID'
		";
    mysqli_query($SQLlink, $strSQLUpdateINVSENT);

    if ($InvoicePayed) {
        sendStatusInvoicePayed($INVOICEID, $gloNow);
    }

    return $INVOICEID;
}
