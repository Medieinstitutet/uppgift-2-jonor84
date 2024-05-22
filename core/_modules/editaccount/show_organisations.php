<?php
if ($gloAccess < 1) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {

	if ($gloUserNew || $gloUserNewClient) {
		echo "<div class='$alertError'>$gloWrongAccess</div>";
	} else {


		// CHECK HOW MANY NEW INVITES
		$strSQLNEW = "SELECT * FROM data_notifications WHERE userid = '$gloUID' AND open = '0' AND invite = '1'";
		$resultsNEW = mysqli_query($SQLlink, $strSQLNEW);
		$CHECKNEW = mysqli_num_rows($resultsNEW);

		if (empty($CHECKNEW)) {
			$CHECKNEW = 0;
		}


		$strSQL = "
		 SELECT t1.id,
		 t1.companyname,t1.contactname,t1.phone,t1.email,t1.active,
		 t1.countryid,t1.town,t1.added,t1.updated,
		 t1.userid,t1.afid,
		 t2.country_name,
		 t3.aid, t3.added, t3.updated,
		 t4.access_name,
		 t5.user_fname, t5.user_sname, t5.user_email
		 FROM data_clients AS t1 
		 LEFT JOIN data_countrys AS t2 
		 ON t1.countryid = t2.id 
		 LEFT JOIN data_clients_access AS t3 
		 ON t1.id = t3.cid 
		 LEFT JOIN data_access AS t4 
		 ON t3.aid = t4.id
		 LEFT JOIN data_users AS t5 
		 ON t1.orgadmin = t5.id 		 
		 WHERE t1.closed = '0' 
         AND t3.accepted = '1'
		 AND '" . $gloUID . "' IN (t3.uid)
		 ORDER BY companyname 
		 ";
		$arrRS = mysqli_query($SQLlink, $strSQL);

		// DEBUG
		//if ($gloAccess==9) { echo "<div class='debug'>".$strSQL."</div>"; }
?>

		<!-- Begin content -->

		<!-- DataTables -->
		<div class="card mb-4">
			<div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
				<h3 class="m-0 font-weight-bold brand-title"><? echo $strHeader; ?> / Kopplade Organisationer (Kundprofiler) <? echo $Titleextra; ?></h3>
				<div class="dropdown no-arrow">

					<span><a class="btn brand-button btn-sm" role="button" href="<? echo $gloBase; ?>support&show=createticket"><i class=" fas fa-plus" title="Lägg till Organisation"></i> Lägg till Organisation</a></span>

				</div>

			</div>
			<?php
			// IF RS = TRUE THEN PRINT TABLE
			if (!mysqli_num_rows($arrRS)) { ?>
				<div class="<? echo $alertInfo; ?>"><? echo $gloMissingID; ?></div>
			<? } else {
			?>

				<div class="card-body">

					<?

					if ($CHECKNEW) { ?>
						<div class='<? echo $alertSuccess; ?>'>
							<i class="fas fa-hands-helping"></i> <b>Inbjudningar</b><br>
							Du har fått <b><? echo $CHECKNEW; ?> st</b> nya inbjudningar att hantera andras kundprofiler med tjänster. <a href="<? echo $gloBaseModule; ?>&show=orginvites"><u>Visa inbjudningar</u></a>.

						</div>
					<? } ?>


					<div class='<? echo $alertInfo; ?> text-dark'>
						<h3><i class="fas fa-info-circle"></i> Information</h3>
						<p>
							Om du vill ta bort kopplingen till en Kundprofil, kontaktar du Kundprofilens Administratör eller <a href="<? echo $gloBase; ?>support&show=createticket"><u>skapar ett ärende till supporten</u></a>. <br>
							Om du inte kan lägga till eller vill ha hjälp att lägga till en Organisation(kundprofil) <a href="<? echo $gloBase; ?>support&show=createticket"><u>skapa ett ärende till supporten</u></a>. <br>
						</p>

					</div>

					<div class="table-responsive">

						<table class="table table-sm table-bordered table-striped display responsive" style="white-space:nowrap; margin-bottom: 0px;" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>KundID</th>
									<th>Organisation</th>
									<th>Min Behörighet</th>
									<th>Administratör</th>
									<th>Aktiv</th>
									<th>Uppdaterad</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>KundID</th>
									<th>Organisation</th>
									<th>Min Behörighet</th>
									<th>Administratör</th>
									<th>Aktiv</th>
									<th>Uppdaterad</th>
								</tr>
							</tfoot>
							<tbody>
								<?
								// LOOPS RS AND PRINTS TABLE
								while ($arrRow = mysqli_fetch_row($arrRS)) {

									// PUT RS IN VARS
									$rowID			= $arrRow[0];
									$rowCompany		= $arrRow[1];
									$rowContact		= $arrRow[2];
									$rowPhone		= $arrRow[3];
									$rowEmail		= $arrRow[4];
									$rowActive		= ($arrRow[5]) ? "Ja" : "Nej";
									$rowCountryID		= $arrRow[6];
									$rowTown 		= $arrRow[7];
									$rowDateAdded		= date('Y-m-d H:i', $arrRow[8]);
									$rowDateUpdated		= date('Y-m-d H:i', $arrRow[9]);
									$rowUserID		= $arrRow[10];
									$rowAFID		= $arrRow[11];

									$rowCountryName		= $arrRow[12];

									$AccessID			= $arrRow[13];
									$AccessAdded		= $arrRow[14];
									$AccessUpdated		= $arrRow[15];

									$AccessName			= $arrRow[16];
									$OrgAdminName		= $arrRow[17] . " " . $arrRow[18];
									$OrgAdminEmail		= $arrRow[19];

									// PRINTS ROW IN TABLE
									echo "
					<tr>
					 <td>$rowID</td>
					 <td>$rowCompany</td>
 					 <td>$AccessName</td>
					 <td><a href='mailto:$OrgAdminEmail'>$OrgAdminName</a></td>
				 	 <td>$rowActive</td>
					 <td>$rowDateUpdated</td> 

					</tr>";
								}
								?>
							</tbody>
						</table>
					<? } ?>



					<? //echo $gloBackButton; 
					?>
					</div>
				</div>

		</div>

		<!-- End content -->
<? }
}  ?>