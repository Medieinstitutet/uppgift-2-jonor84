<style>
	.btn-profilestart {
		position: absolute;
		inset-inline-start: 32px;
		inset-block-start: 10px;
	}

	.btn-profilestart-text {
		color: white !important;
		-webkit-text-stroke-width: 1px;
		-webkit-text-stroke-color: black;
		/* text-shadow: 2px 2px black; */

	}

	/* Media query for mobile devices (up to 767px width) */
	@media only screen and (max-width: 767px) {
		.btn-profilestart-text {
			display: none;
		}
	}
</style>
<?php
// *** ***********************
// *** MODULE: 	Account/Profile
// *** ***********************
// MODULE SETTINGS IS ALREADY LOADED AUTO

// CHECK ACCESS
if ($gloClientAccessLevel < 2) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
?>
	<? // OPEN SERVICE
	if (!$_SESSION["service"]) {
		$_SESSION["service"] = "client";
		header("Refresh:0");
	} else if ($_SESSION["service"] != "client") {
		$_SESSION["service"] = "client";
		header("Refresh:0");
	}

	// Access to subpages for this app
	$SUBPAGECACCESS = 1;

	//TESTING OF CHECK IF CLIENT EXISTS
	$strSQL = "SELECT * FROM data_clients WHERE id = '$gloCurrentClientID'";
	$results = mysqli_query($SQLlink, $strSQL);
	$CHECKCLIENT = mysqli_num_rows($results);


	// DEFAULT CONTENT
	$strSQL = "
			SELECT t1.id,
			t1.companyname,t1.contactname,t1.phone,t1.email,t1.active,
			t1.countryid,t1.town,t1.added,t1.updated,t1.userid,
			t1.address,t1.invoiceaddress,t1.info,t1.afid,t1.typeid,
			t1.image,t1.clientid,t1.iaddress,t1.izip,t1.itown,
			t1.paddress,t1.pzip,t1.ptown,t1.isnailmail,t1.website,
			t1.orgadmin,t1.closed,t1.companyid,t1.vatid,t1.noinvoice,
			t1.notes,t1.adminnotes,t1.ilandid,t1.plandid,t1.orgemail,
			t1.orgiemail, t1.orgnew, t1.alliance, t1.mbingo, t1.msite, 
			t1.landskapsid, t1.iemail, t1.facebook, t1.instagram,
			t2.se_type,
			t3.country_name
			FROM data_clients AS t1 
			LEFT JOIN data_clienttypes AS t2 
			ON t1.typeid = t2.id
			LEFT JOIN data_countrys AS t3 
			ON t1.countryid = t3.id 
			WHERE t1.id = $gloCurrentClientID 
		";
	$arrRS = mysqli_query($SQLlink, $strSQL);

	// DEBUG
	//if (intval($_SESSION['UACC'])==9) { echo "<div class='debug'>".$strSQL."</div>"; }

	// LOOPS RS AND PRINTS TABLE
	while ($arrRow = mysqli_fetch_row($arrRS)) {

		// PUT RS IN VARS
		$rowID			= $arrRow[0];

		$rowCompany		= $arrRow[1];
		$rowContact		= $arrRow[2];
		$rowPhone		= $arrRow[3];
		$rowEmail		= $arrRow[4];
		$rowActive		= ($arrRow[5]) ? "<span class='text-dark fw-bold'><i class='fas fa-check-circle text-success'></i> Aktiv</span>" : "<span class='text-dark fw-bold'><i class='fas fa-times-circle text-danger'></i> Inaktiv</span>";

		$rowCountryID		= $arrRow[6];
		$rowTown 		= $arrRow[7];
		$rowDateAdded		= formatDate($arrRow[8]);
		$rowDateUpdated		= formatDate($arrRow[9]);
		$rowUserID		= $arrRow[10];

		$rowAddress		= $arrRow[11];
		$rowInvoiceAddress	= $arrRow[12];
		$rowInfo		= $arrRow[13];
		$rowAFID		= $arrRow[14];
		$rowTypeID		= $arrRow[15];

		$rowImage	= $arrRow[16];
		$rowClientID	= $arrRow[17];

		$rowIAddress	= $arrRow[18];
		$rowIZip	= $arrRow[19];
		$rowITown	= $arrRow[20];

		$rowPAddress	= $arrRow[21];
		$rowPZip	= $arrRow[22];
		$rowPTown	= $arrRow[23];

		$rowILetter	= $arrRow[24];
		$rowWebsite	= $arrRow[25];
		$rowOrgadmin = $arrRow[26];
		$rowClosed = $arrRow[27];
		$rowCompanyID = $arrRow[28];
		$rowVATID = $arrRow[29];
		$rowNoInvoice = $arrRow[30];

		$rowNotes = $arrRow[31];
		$rowANotes = $arrRow[32];

		$rowILand = $arrRow[33];
		$rowPLand = $arrRow[34];

		$rowOrgemail = $arrRow[35];
		$rowOrgiemail = $arrRow[36];

		$rowOrgNew = $arrRow[37]; // t1.orgnew
		$rowOrgAlliance = $arrRow[38]; // t1.alliance
		$rowOrgMbingo = $arrRow[39]; // t1.mbingo
		$rowOrgMsite = $arrRow[40]; // t1.msite
		$rowOrgLandskapsid = $arrRow[41]; // t1.landskapsid
		$rowOrgIemail = $arrRow[42]; // t1.iemail
		$rowOrgFacebook = $arrRow[43]; // t1.facebook
		$rowOrgInstagram = $arrRow[44]; // t1.instagram

		$rowTypeName		= $arrRow[45];
		$rowCountryName		= $arrRow[46];

		$rowOrgadminName = UserFullName($rowOrgadmin);

		if (!$rowOrgadmin) {
			$rowOrgadminText = "Saknas";
		} else {
			$rowOrgadminText = "<a href='" . $gloBaseModule . "&u=" . $rowOrgadmin . "'>" . $rowOrgadminName . "</a>";
		}


		if (!$rowOrgiemail) {
			$rowOrgiemail = $rowEmail;
		}

		if ($rowClosed) {
			$AlertBKG = "danger";
			$rowNoInvoiceSet = 1;
			$ClosedText = "<span class='text-dark'>Kundprofilen är avslutad och kommer stängas när det är möjligt.</span>";
		} else {
			$ClosedText = "<span class='text-dark'>Kundprofilen är inte avslutad.</span>";
			$AlertBKG = "success";
			$rowNoInvoiceSet = 0;
		}

		if ($rowNoInvoiceSet) {
			$rowNoInvoice = $rowNoInvoiceSet;
		}

		if (!$rowClientID) {
			$rowClientID = $rowCompanyID;
		}

		if ($rowILetter) {
			$rowILetterText = "Brev";
		} else {
			$rowILetterText = "E-post";
		}

		$rowPLetterText = "E-post";

		if (!$rowProfileBKG) {
			$rowProfileBKG = 'halobkg.jpg';
		}

		if (!$rowNotes) {
			$rowNotes = 'Ingen anteckning finns sparad ännu..';
		}

		if (!$rowANotes) {
			$rowANotes = 'Ingen anteckning finns sparad ännu..';
		}
	}


	include 'show_client.php';

	?>
<? } ?>
<? if ($BRAND == "bingo") { ?>
	<br><a class="btn btn-dark btn-lg" href="<? echo $gloBase; ?>bingon"><i class="fas fa-car"></i><i class="fas fa-laptop-house"></i> Tillbaka till Bingo Start</a>
<? } ?>