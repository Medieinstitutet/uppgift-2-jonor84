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
if ($gloAccess < $intAccess) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
?>
	<?
	// OPEN SERVICE
	if (!$_SESSION["service"]) {
		$_SESSION["service"] = "account";
		header("Refresh:0");
	} else if ($_SESSION["service"] != "account") {
		$_SESSION["service"] = "account";
		header("Refresh:0");
	}

	$strSQL = "
		SELECT 
				t1.id,
				t1.group_id, t1.user_hidden, t1.user_name, t1.user_img, t1.user_added, 
				t1.last_login, t1.user_fname, t1.user_sname, t1.user_email, t1.user_phone,
				t1.user_presentation, t1.user_access, t1.client_id, t1.profilebkg, t1.userid,
				t1.user_notes,t1.closed,t1.user_active,t1.defaultstart,t1.defaultlanguageid,
				t1.verifiedemail,t1.verifiedphone,t1.defaultcid,t1.pid,
				t2.access_name,
				t3.companyname
		FROM data_users AS t1 
		LEFT JOIN data_access AS t2 
		ON user_access = t2.id
		LEFT JOIN data_branding AS t3 
		ON t1.brand = t3.brandname  
		WHERE t1.id = $gloUID
		LIMIT 1";
	$arrRS 	= mysqli_query($SQLlink, $strSQL);
	while ($arrRow = mysqli_fetch_row($arrRS)) {

		// PUT RS IN VARS
		$rowUID		= !empty($arrRow[0]) ? $arrRow[0] : $gloNULL;
		$rowRID		= !empty($arrRow[1]) ? $arrRow[1] : $gloNULL;
		$rowHidden		= !empty($arrRow[2]) ? $arrRow[2] : $gloNULL;
		$rowUser		= !empty($arrRow[3]) ? $arrRow[3] : $gloNULL;
		$rowUserPic		= !empty($arrRow[4]) ? $arrRow[4] : $gloNULL;
		$rowUserAdded		= formatDate($arrRow[5]);
		$rowUserLastLogin	= formatDate($arrRow[6]);
		$rowFName		= !empty($arrRow[7]) ? $arrRow[7] : $gloNULL;
		$rowSName		= !empty($arrRow[8]) ? $arrRow[8] : $gloNULL;
		$rowEmail		= !empty($arrRow[9]) ? $arrRow[9] : $gloNULL;
		$rowPhone		= !empty($arrRow[10]) ? $arrRow[10] : $gloNULL;
		$rowPresentation = !empty($arrRow[11]) ? nl2br($arrRow[11]) : $gloNULL;
		$rowAccess		= !empty($arrRow[12]) ? $arrRow[12] : $gloNULL;
		$rowClientID	= !empty($arrRow[13]) ? $arrRow[13] : $gloNULL;

		$rowProfileBKG = $arrRow[14];
		$rowUSERID = $arrRow[15];
		$rowUSERNOTES = $arrRow[16];
		$rowClosed = $arrRow[17];
		$rowActive		= ($arrRow[18]) ? "<span class='text-dark fw-bold'><i class='fas fa-check-circle text-success'></i> Aktiv</span>" : "<span class='text-dark fw-bold'><i class='fas fa-times-circle text-danger'></i> Inaktiv</span>";
		$rowDefaultStart = $arrRow[19];
		$rowDefaultLanguageID = $arrRow[20];

		$rowVerifiedEmail		= ($arrRow[21]) ? "<span class='text-dark fw-bold'><i class='fas fa-check-circle text-success'></i> Ja</span>" : "<span class='text-dark fw-bold'><i class='fas fa-times-circle text-danger'></i> Nej</span>";
		$rowVerifiedEmailShow	= ($arrRow[21]) ? "<span class='text-dark fw-bold'><i class='fas fa-check-circle text-success'></i> Ja</span>" : "<span class='text-dark fw-bold'><i class='fas fa-times-circle text-danger'></i> Nej</span>";
		$rowVerifiedPhone		= ($arrRow[22]) ? "<span class='text-dark fw-bold'><i class='fas fa-check-circle text-success'></i> Ja</span>" : "<span class='text-dark fw-bold'><i class='fas fa-times-circle text-danger'></i> Nej</span>";
		$rowVerifiedPhoneShow	= ($arrRow[22]) ? "<span class='text-dark fw-bold'><i class='fas fa-check-circle text-success'></i> Ja</span>" : "<span class='text-dark fw-bold'><i class='fas fa-times-circle text-danger'></i> Nej</span>";

		$rowDefaultProfile = $arrRow[23]; // defaultcid
		$rowPID = $arrRow[24]; // pid

		$rowAccessName	= !empty($arrRow[25]) ? $arrRow[25] : $gloNULL;

		$rowUserFullname = $rowFName . " " . $rowSName; //Show users firstname and lastname	

		$rowResellerName	= !empty($arrRow[26]) ? $arrRow[26] : $gloNULL;


		$LanguageName = LanguageName($rowDefaultLanguageID);
		$DefaultProfile = CompanyName($rowDefaultProfile);
		$StartPageName = StartPageName($rowDefaultStart);


		if ($rowFName == "TMPNAME") {
			$rowFName = "";
		}

		if (!$rowUSERID) {
			$rowUSERID = $rowUID;
		}

		if (!$rowProfileBKG) {
			$rowProfileBKG = 'halobkg.jpg';
		}

		if (!$rowUSERNOTES) {
			$rowUSERNOTES = 'Ingen anteckning finns sparad ännu..';
		}

		if ($rowClosed) {
			$AlertBKG = "danger";
			$ClosedText = "<span class='text-dark'>Användaren är avslutad och kommer stängas när det är möjligt.</span>";
		} else {
			$ClosedText = "<span class='text-dark'>Användaren är inte avslutad.</span>";
			$AlertBKG = "success";
		}

		// GET CLIENTS USER IS ALLOWED TO
		$strSQLActiveClient = "
					SELECT t1.id, t1.cid,
					t2.companyname,
					t3.se_type,
					t4.access_name
					FROM data_clients_access AS t1
					LEFT JOIN data_clients AS t2 
					ON t1.cid = t2.id      
					LEFT JOIN data_clienttypes AS t3 
					ON t2.typeid = t3.id    
					LEFT JOIN data_access AS t4 
					ON t1.aid = t4.id   
					WHERE t1.uid = '$gloUID' AND t1.accepted = '1' AND t2.orgnew = '0' AND t2.active = '1'
					ORDER BY id DESC";
		$arrRSActiveClient = mysqli_query($SQLlink, $strSQLActiveClient);
	}


	include 'show_user.php';

	?>

<? } ?>
<? if ($BRAND == "bingo") { ?>
	<br><a class="btn btn-dark btn-lg" href="<? echo $gloBase; ?>bingon"><i class="fas fa-car"></i><i class="fas fa-laptop-house"></i> Tillbaka till Bingo Start</a>
<? } ?>