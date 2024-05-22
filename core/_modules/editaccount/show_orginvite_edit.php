<?php  // $gloClientID logged in users clientid
// CHECK IF USER IS A CLIENT ADMIN - ONLY A 3 Client Admin is allowed to this page

$CID = mysqli_real_escape_string($SQLlink,$_GET['id']);
 
if ($gloAccess < 1) { 
    echo "<div class='$alertError'>$gloWrongAccess</div>"; 
} else { 
    
    
		$strSQL = "
		SELECT 	
         t1.id,
         t1.companyname,t1.contactname,t1.phone,t1.email,t1.active,
		 t1.countryid,t1.town,t1.added,t1.updated,t1.website,
         t1.companyid,t1.paddress,t1.pzip,t1.ptown,t1.iaddress,
         t1.izip,t1.itown,t1.vatid,t1.typeid, t1.orgemail, t1.orgiemail, t1.orgnew,
		 t2.se_type
		FROM data_clients AS t1
		LEFT JOIN data_clienttypes AS t2 
		ON t1.typeid = t2.id        
		WHERE t1.id = '$CID'
		LIMIT 1";
		
		$arrRS = mysqli_query($SQLlink,$strSQL);
			
		while ($arrRow = mysqli_fetch_row($arrRS)) {		
		$rowID				= $arrRow[0];
        
		$rowCompany			= $arrRow[1];
		$rowContact			= $arrRow[2];
		$rowPhone			= $arrRow[3];
		$rowEmail 			= $arrRow[4];
		$rowActive 			= $arrRow[5];

		$rowCountryID		= $arrRow[6];
		$rowHQCity			= $arrRow[7];
		$rowAdded			= $arrRow[8];
		$rowUpdated			= $arrRow[9];
		$rowWebsite			= $arrRow[10];
            
        $rowCompanyID		= $arrRow[11];
		$rowPostA			= $arrRow[12];
		$rowPostAZip		= $arrRow[13];
		$rowPostATown		= $arrRow[14];        
        $rowInvoiceA		= $arrRow[15];
            
        $rowInvoiceAZip		= $arrRow[16];
        $rowInvoiceATown	= $arrRow[17];        
        $rowVATID	        = $arrRow[18];
        $rowTypeID	        = $arrRow[19];
		
        $rowORGEMAIL	    = $arrRow[20];
        $rowORGIEMAIL	    = $arrRow[21];
        $rowORGNEW	        = $arrRow[22];
        $rowORGTypeName     = $arrRow[23];

		}
    
        $strSQLA = "
		SELECT 	
         t1.id, t1.aid, t1.activebingo, t1.activesites, t1.activehalo, t1.bingosid, t1.sitesid, t1.halosid,
         t2.access_name
		FROM data_clients_access as t1
		LEFT JOIN data_access AS t2 
		ON t1.aid = t2.id           
		WHERE t1.cid = '$CID' AND t1.uid = '$gloUID'
		LIMIT 1";
		
		$arrRSA = mysqli_query($SQLlink,$strSQLA);
			
		while ($arrRowA = mysqli_fetch_row($arrRSA)) {		
			$rowID				= $arrRowA[0];
			$rowAID				= $arrRowA[1];
			$rowActiveBingo		= $arrRowA[2];
			$rowActiveSite		= $arrRowA[3];
			$rowActiveHalo		= $arrRowA[4];

			$rowActiveBingosID	= $arrRowA[5];
			$rowActiveSitesID	= $arrRowA[6];
			$rowActiveHalosID	= $arrRowA[7];

			$rowAccessName    	= $arrRowA[8];
		}
?>

<!-- Begin content -->
<div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">

                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Granskar organisationsinbjudan</h4>
                               </div>
                                <!-- Card Body -->
                                <div class="card-body">

	
				<form method="post" class="form-horizontal" action="<? echo $gloBaseModule; ?>&task=orginvite_edit">
				
				                     <input type="hidden" name="frmSENDID" value="<? echo $rowID; ?>">

            			<div class="form-group">
                        		 <label for="inputStandard" class="control-label">Organisationstyp: <? echo $rowORGTypeName; ?></label><br>
    
                        		 <label for="inputStandard" class="control-label">Organisationsnamn: <? echo $rowCompany; ?></label><br>

                        		 <label for="inputStandard" class="control-label">Person/Organisationsnr: <? echo $rowCompanyID; ?></label><br>
								</div>

<div class="form-group"> 
                        		 <label for="inputStandard" class="control-label">Kontaktperson: <? echo $rowContact; ?>, <a href="mailto:<? echo $rowEmail; ?>"><? echo $rowEmail; ?></a></label>
<hr>
                      			</div>
<div class="form-group">
    <h4><? echo $rowCompany; ?> vill ge dig följande behörighet:</h4>
    <p>Behörighet: <? echo $rowAccessName; ?> (<? echo $rowAID; ?>)</p>
    <? if ($rowActiveSite) { ?>
     <p>MoonSite: <i class="fas fa-check-circle text-success"></i></p>
    <? } ?>
	<? if ($rowActiveHalo) { ?>
     <p>Halo: <i class="fas fa-check-circle text-success"></i></p>
     <? } ?>
    <? if ($rowActiveBingo) { ?>
     <p>Hall/Bilbingon.se: <i class="fas fa-check-circle text-success"></i></p>
     <? } ?>
     </div>
                    <hr>
        <div class="form-group">            
    <h4>Accepterar du inbjudan:</h4>
                            <input type="checkbox" data-toggle="switchbutton" data-onlabel="Ja" data-offlabel="Nej" data-size="sm" name="frmAnswer" data-width="80" data-height="25"> Klicka på knappen för att växla svar.
    

	</div>
                    <br><br>
                            <? echo $HRB; ?>        
							  <button type="submit" class="<? echo $btnSuccess; ?>"><i class="fas fa-check-circle"></i> Spara</button>
							  <? echo $gloAbortButton; ?>
							 </form>
  			 
                            </div>
                        </div>
		</div>
</div>
<!-- End content -->      
<? } ?>