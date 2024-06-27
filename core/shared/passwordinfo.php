        <span class="font-weight-bold">Lösenordet måste möta dessa krav:</span>
        <br><br />
        <? $CHECKDOT = "<i class='fa-regular fa-fw fa-circle-check'></i>"; ?>
        <ol class="list-group list-group-ordered">
            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-dark">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><? echo $CHECKDOT; ?> Minst 8 tecken långt och innehålla:</div>
                </div>
            </li>
            <li style="padding-left: 40px;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-dark">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><? echo $CHECKDOT; ?> Minst 1 stor bokstav</div>
                </div>
            </li>
            <li style="padding-left: 40px;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-dark">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><? echo $CHECKDOT; ?> Minst 1 liten bokstav</div>
                </div>
            </li>
            <li style="padding-left: 40px;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-dark">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><? echo $CHECKDOT; ?> Minst 1 siffra</div>
                </div>
            </li>
            <li style="padding-left: 40px;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-dark">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><? echo $CHECKDOT; ?> Minst 1 av f&ouml;ljande specialtecken:</div>
                    <span style="padding-left: 20px;">!@#$%^&*()-_=+{};:,<.></span>
                </div>
            </li>
        </ol>


        <? echo $HRB; ?>
        <a href='#' data-id='Passwordgenerator' data-toggle='modal' data-bs-toggle='modal' data-target='#Modal-Passwordgenerator' data-bs-target='#Modal-Passwordgenerator' class="btn brand-button"><i class="fa-solid fa-key"></i> Lösenordsgenerator</a>