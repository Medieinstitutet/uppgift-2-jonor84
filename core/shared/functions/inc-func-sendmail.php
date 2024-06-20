<?

// Function to add a new log entry for sent messages
function addLogSentMessages($sendtype, $receiver, $senderid, $message, $subject)
{
	// Get global variables
	global $SQLlink, $BRAND;

	// Get user's IP address
    $ip = ip2long(getIP());
    
	// Get Reseller ID
	$BRANDRID = getBrandRID($BRAND);

	// Sanitize input values
    $UID = $SQLlink->real_escape_string($senderid);
	$MessageTo = $SQLlink->real_escape_string($receiver);
	$Message = $SQLlink->real_escape_string($message);
    $Subject = $SQLlink->real_escape_string($subject);
	$Add0 = 0;

	if (empty($Subject)) { $Subject = null; }
	if (empty($BRANDRID)) { $BRANDRID = $Add0; }

	// Add to DB
	$strSQLADD = "
	INSERT INTO data_sentmessages
	 (brand, type, rid, cid, uid, message, subject, receiver, ip, date)
	VALUES 
	 ('$BRAND','$sendtype','$BRANDRID','$Add0','$UID','$Message','$Subject','$MessageTo','$ip', CURRENT_TIMESTAMP)
	";

    mysqli_query($SQLlink, $strSQLADD);

    // Get ID of the newly inserted log entry
    $NEWLOGENTRYID = mysqli_insert_id($SQLlink);

    // Return the ID of the newly inserted log entry
    return $NEWLOGENTRYID;
}


// SEND MAIL FUNCTIONS
use Postmark\PostmarkClient;
use Postmark\Models\PostmarkAttachment;

//FUNCTION SEND MAILS WITH PDF
function sendMailPDF($mailToAddress, $mailToName, $mailSubject, $mailMessage, $mailReplyAddress = null, $mailReplyName = null, $mailINVOICEID, $mailClientID)
{

	global $SQLlink, $gloSysMail, $gloSysMailName, $gloSysNoReplyMail, $gloBrandSiteName, $gloBrandCompanyName, $gloBrandLoginURL, $gloBrandLogoMailShow2;
    if (is_null($mailReplyAddress)) {
		$mailReplyAddress = $gloSysNoReplyMail;
	}
    if (is_null($mailReplyName)) {
		$mailReplyName = $gloSysMailName;
	}
	if (empty($UserID)) {
		$UserID = '0';
	}

	$gloSysMail = 'send@myhalo.se';
	$Sendtype = 'email';

	$fromMail = $gloBrandSiteName . ' <' . $gloSysMail . '>'; // MAIL to
	$toMail = $mailToName . ' <' . $mailToAddress . '>'; // Mail from
	if ($mailToName) {
		$mailHeader = 'Hej ' . $mailToName . '!';
	} else {
		$mailHeader = 'Hej!';
	}
	$mailIntro = 'Här kommer en ny faktura från ' . $gloBrandSiteName . '. Klicka på knappen nedan för att se den direkt i din webbläsare:';

    // Define and send to log: $sendtype, $receiver, $senderid, $message, $subject
    addLogSentMessages($Sendtype, $mailToAddress, $UserID, $mailMessage, $mailSubject);

	// GET Invoice Data from DB
	$INVOICEID = $mailINVOICEID;
	$CurrentClientID = $mailClientID;
	include("/home/mhemsi31/domains/myhalo.se/core/_modules/i/db_invoice.php");

	$asAttachment = 1;
	$invoicename = "invoice_" . $INVOICEID . ".pdf";
	require '/home/mhemsi31/domains/myhalo.se/core/view/invoice_pdf_file.php';

	$pdfattachment = $pdf->Output($invoicename, 'S');

	//CHANGE THIS
	$client = new PostmarkClient('xxxxx'); //CHANGE THIS
	$attachment = PostmarkAttachment::fromRawData($pdfattachment, $invoicename, "application/pdf");

	$fromMail = $gloBrandSiteName . ' <' . $gloSysMail . '>';

	// Send an email:
	$sendResult = $client->sendEmailWithTemplate(
		$fromMail,
		$toMail,
		34007452,
		[
			"url" => $gloBrandLoginURL,
			"brandlogo" => $gloBrandLogoMailShow2,
			"header" => $mailHeader,
			"intro" => $mailIntro,
			"body" => $mailMessage,
			"brandname" => $gloBrandSiteName,
			"company_name" => $gloBrandCompanyName,
			"subject" => $mailSubject
		],
		TRUE,
		NULL,
		NULL,
		NULL,
		NULL,
		NULL,
		NULL,
		[$attachment]
	);

	if ($sendResult) {
		$MailStatus = 1;
	} else {
		$MailStatus = 0;
	}

	return $MailStatus;
}

//FUNCTION SEND MAILS
function sendMailPM($mailToAddress, $mailToName, $mailSubject, $mailMessage, $mailuserID, $mailReplyAddress = null, $mailReplyName = null)
{

	global $gloSysMail, $gloSysMailName, $gloSysNoReplyMail, $gloBrandSiteName, $gloBrandCompanyName, $gloBrandLoginURL, $gloBrandLogoMailShow2;
    if (is_null($mailReplyAddress)) {
		$mailReplyAddress = $gloSysNoReplyMail;
	}
    if (is_null($mailReplyName)) {
		$mailReplyName = $gloSysMailName;
	}
	if (empty($mailuserID)) {
		$mailuserID = '0';
	}

	$gloSysMail = 'send@myhalo.se';
	$Sendtype = 'email';

	$fromMail = $gloBrandSiteName . ' <' . $gloSysMail . '>'; // MAIL to
	$toMail = $mailToName . ' <' . $mailToAddress . '>'; // Mail from
	if ($mailToName) {
		$mailHeader = 'Hej ' . $mailToName . '!';
	} else {
		$mailHeader = 'Hej!';
	}
	$mailIntro = "";

    // Define and send to log: $sendtype, $receiver, $senderid, $message, $subject
    addLogSentMessages($Sendtype, $mailToAddress, $mailuserID, $mailMessage, $mailSubject);

	$client = new PostmarkClient('xxxxx'); //CHANGE THIS
	// Send email:
	$sendResult = $client->sendEmailWithTemplate(
		$fromMail,
		$toMail,
		34007452,
		[
			"url" => $gloBrandLoginURL,
			"brandlogo" => $gloBrandLogoMailShow2,
			"header" => $mailHeader,
			"intro" => $mailIntro,
			"body" => $mailMessage,
			"brandname" => $gloBrandSiteName,
			"company_name" => $gloBrandCompanyName,
			"subject" => $mailSubject
		]
	);

	if ($sendResult) {
		$MailStatus = 1;
	} else {
		$MailStatus = 0;
	}

	return $MailStatus;
}

//FUNCTION SEND SMS MAILS
function sendMailSMS($smsNumber, $smsName, $smsMessage, $userid)
{
	$toMail = '46' . $smsNumber . '@emailsms.se'; // Mail to
	if (empty($UserID)) {
		$UserID = '0';
	}

	$Sendtype = 'sms';
    // Define and send to log: $sendtype, $receiver, $senderid, $message, $subject
    addLogSentMessages($Sendtype, $smsNumber, $userid, $smsMessage, $smsName);

	$client = new PostmarkClient('xxxxx'); //CHANGE THIS
	// Send email:
	$sendResult = $client->sendEmailWithTemplate(
		"send@myhalo.se",
		$toMail,
		35006304,
		[
			"body" => $smsMessage,
			"subject" => $smsName,
		]
	);

	if ($sendResult) {
		$MailStatus = 1;
	} else {
		$MailStatus = 0;
	}

	return $MailStatus;
}
