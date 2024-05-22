<? if (!$SUBPAGECACCESS) {
    echo "<div class='$alertError'>$gloWrongAccess2</div>";
} else { ?>
    <div class="card">
        <div class="card-body">
            <div class="row mt-4">
                <div class="col">
                    <h4><? echo $rowCompany; ?></h4>
                    <ul class="list-unstyled order-details-list">
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Organisationsadmin: </span><? echo $rowOrgadminText; ?></div>
                        </li>
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Hemsida: </span><a href="https://<? echo $rowWebsite; ?>" target="_blank"><? echo $rowWebsite; ?></a></div>
                        </li>
                    </ul>
                </div>

                <div class="col">
                    <h4>Organisation</h4>

                    <ul class="list-unstyled order-details-list">
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Typ: </span><? echo $rowTypeName; ?></div>
                        </li>
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Organisationsnummer: </span><? echo $rowCompanyID; ?></div>
                        </li>
                        <? if ($rowVATID) {  ?>
                            <li>
                                <div class="fs-14"><span class="me-2  fw-bold">VAT ID: </span><? echo $rowVATID; ?></div>
                            </li>
                        <? } ?>

                    </ul>

                </div>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <div class="row mt-4">
                <div class="col">
                    <h4>Meddelanden:</h4>
                    <ul class="list-unstyled order-details-list">
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Meddelanden skickas via: </span><? echo $rowPLetterText; ?></div>
                        </li>
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">E-postadress: </span><? echo $rowEmail; ?></div>
                        </li>
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Adress: </span><? echo $rowPAddress; ?></div>
                        </li>
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Postnummer: </span><? echo $rowPZip; ?></div>
                        </li>
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Ort: </span><? echo $rowPTown; ?></div>
                        </li>
                        <li>
                            <div class="fs-14"><span class="me-2  fw-bold">Land: </span><? echo CountryNameSE($rowPLand); ?></div>
                        </li>
                    </ul>
                </div>

                <div class="col">
                    <h4>Fakturor:</h4>
                    <?
                    if (!$rowNoInvoice) {  ?>
                        <ul class="list-unstyled order-details-list">
                            <li>
                                <div class="fs-14"><span class="me-2  fw-bold">Fakturan skickas via: </span><? echo $rowILetterText; ?></div>
                            </li>
                            <li>
                                <div class="fs-14"><span class="me-2  fw-bold">E-postadress: </span><? echo $rowOrgiemail; ?></div>
                            </li>
                            <li>
                                <div class="fs-14"><span class="me-2  fw-bold">Adress: </span><? echo $rowIAddress; ?></div>
                            </li>
                            <li>
                                <div class="fs-14"><span class="me-2  fw-bold">Postnummer: </span><? echo $rowIZip; ?></div>
                            </li>
                            <li>
                                <div class="fs-14"><span class="me-2  fw-bold">Ort: </span><? echo $rowITown; ?></div>
                            </li>
                            <li>
                                <div class="fs-14"><span class="me-2  fw-bold">Land: </span><? echo CountryNameSE($rowILand); ?></div>
                            </li>
                        </ul>
                    <? } else {
                        echo '<div class="alert alert-warning"><i class="fas fa-exclamation-circle text-dark"></i> <span class="text-dark">Denna kund ska inte faktureras.</span></div>';
                    } ?>
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