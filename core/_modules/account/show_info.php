<? if (!$SUBPAGEUACCESS) {
    echo "<div class='$alertError'>$gloWrongAccess2</div>";
} else { 
?>
    <div class="card">
        <div class="card-body">
        <h3>Information</h3>
        <? echo $HR0; ?>
            <div class="row mt-4">
                <div class="col">
                    <ul class="list-unstyled order-details-list">
                        <? if ($rowPID) {  ?>
                            <li>
                                <div class="fs-14"><span class="me-2  fw-bold">Personnummer: </span><? echo $$rowPID; ?></div>
                            </li>
                        <? } ?>
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">E-post verifierad: </span><? echo $rowVerifiedEmail; ?></div>
                        </li>
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Mobilnummer verifierad: </span><? echo $rowVerifiedPhone; ?></div>
                        </li>
                    </ul>
                </div>

                <div class="col">
                    <ul class="list-unstyled order-details-list">
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Startsida: <i class="fas fa-question-circle text-primary jtooltip" title="Denna sida öppnas direkt när du loggar in."></i> </span><? echo $StartPageName; ?></div>
                        </li>
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Standard Profil: <i class="fas fa-question-circle text-primary jtooltip" title="Denna kundprofil är aktiv direkt när du loggar in."></i> </span><? echo $DefaultProfile; ?></div>
                        </li>
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Standard Språk: <i class="fas fa-question-circle text-primary jtooltip" title="Detta språk är aktivt direkt när du loggar in."></i> </span><? echo $LanguageName; ?></div>
                        </li>
                    </ul>

                </div>

            </div>
        </div>
    </div>
    
    <? if ($rowInfo) { ?>
        <div class="card">
            <div class="card-body">
                <? echo $rowInfo; ?>
            </div>

        </div>
    <? } ?>
<? } ?>