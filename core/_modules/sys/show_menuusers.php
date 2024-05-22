<!-- Begin content -->
<div class="row">

    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <? if ($gloAdminDesign != "customerzone") {  ?>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="m-0 font-weight-bold text-primary"><? echo $strHeader; ?> / Användare och behörigheter</h4>
                </div>
            <? } ?>
            <!-- Card Body -->
            <div class="card-body">
                <p>Här kan du administrera användarkonton och behörigheter.</p>
            </div>
        </div>
    </div>
</div>


<div class="row">


    <!-- Start Card -->
    <div class="col-lg-2 grow">
        <div class="card shadow mb-4 d-flex align-items-center justify-content-center grow">
            <div class="card-body card-body1 p-3 container-fluid">
                <div class="thumb w-100">
                    <center><a href="<? echo $gloBaseModule; ?>&show=access"><i class="fas fa-fw fa-4x hover fa-user-shield text-primary jtooltip" title="Behörigetsnivåer" style="padding: 25px 10px 25px;"></i></a></center>
                </div>
                <div class="w-100 bg-light d-flex p-25 align-items-center justify-content-center">
                    <h6 class="font-weight-bold text-primary pt-3">
                        Behörigetsnivåer <a href="<? echo $gloBaseModule; ?>&show=access"><i class="fas fa-arrow-circle-right jtooltip" title="Behörigetsnivåer"></i></a></h6>
                </div>
            </div>
        </div>
    </div>
    <!-- End Card -->

    <!-- Start Card -->
    <div class="col-lg-2 grow">
        <div class="card shadow mb-4 d-flex align-items-center justify-content-center grow">
            <div class="card-body card-body1 p-3 container-fluid">
                <div class="thumb w-100">
                    <center><a href="<? echo $gloBaseModule; ?>&show=users"><i class="fas fa-fw fa-4x hover fa-user-lock text-primary jtooltip" title="Användare" style="padding: 25px 10px 25px;"></i></a></center>
                </div>
                <div class="w-100 bg-light d-flex p-25 align-items-center justify-content-center">
                    <h6 class="font-weight-bold text-primary pt-3">
                        Användare <a href="<? echo $gloBaseModule; ?>&show=users"><i class="fas fa-arrow-circle-right jtooltip" title="Användare"></i></a></h6>
                </div>
            </div>
        </div>
    </div>
    <!-- End Card -->

    <!-- Start Card -->
    <div class="col-lg-2 grow">
        <div class="card shadow mb-4 d-flex align-items-center justify-content-center grow">
            <div class="card-body card-body1 p-3 container-fluid">
                <div class="thumb w-100">
                    <center><a href="<? echo $gloBaseModule; ?>&show=user_access"><i class="fas fa-fw fa-4x hover fa-user-check text-primary jtooltip" title="Användarbehörigeter" style="padding: 25px 10px 25px;"></i></a></center>
                </div>
                <div class="w-100 bg-light d-flex p-25 align-items-center justify-content-center">
                    <h6 class="font-weight-bold text-primary pt-3">
                        Användarbehörigeter <a href="<? echo $gloBaseModule; ?>&show=user_access"><i class="fas fa-arrow-circle-right" title="Användarbehörigeter"></i></a></h6>
                </div>
            </div>
        </div>
    </div>
    <!-- End Card -->


</div>

<!--<div class="row">

                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-body">
				                    <? echo $gloBackButton; ?>
                                </div>
                            </div>
                        </div>
</div>-->





<!-- End content -->