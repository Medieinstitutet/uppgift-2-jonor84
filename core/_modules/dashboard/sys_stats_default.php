<div class="row">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold text-primary">SysAdminpanel / Välkommen!</h3>
            </div>
            <div class="card-body">
                Här kan du som system administratör hantera systemet.
            </div>
        </div>
    </div>
</div>

<? //STATS FOR ADMINS

    //users since start
    $strSQLUActive = "SELECT id FROM data_users WHERE user_active ='1'";
    $strResUActive = mysqli_query($SQLlink,$strSQLUActive);
    $numRowUActive = mysqli_num_rows($strResUActive);

    //users since start
    $strSQLUTotal = "SELECT id FROM data_users";
    $strResUTotal = mysqli_query($SQLlink,$strSQLUTotal);
    $numRowUTotal = mysqli_num_rows($strResUTotal);

    $Applink = $gloBase.$gloAdminModule."&show";

?>

<div class="row">

                            <!-- USERS -->
                        <div class="col-xl-3 col-md-6 mb-4 grow">

                            <div class="card cardS bg-white text-black">            
                                <div class="card-body m-1 p-2">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <h4 class="mb-0 font-weight-bold text-primary">Aktiva / Totalt</h4>
                                            <span class="mb-0 font-weight-bold" style="font-size: 28px;"><? echo $numRowUActive; ?> / <? echo $numRowUTotal; ?> ST</span>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-user fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer m-0 p-2 text-right bg-transparent">
                                    <div style="float:right;">
                                        <a class="btn btn-primary" href="<? echo $Applink; ?>=users" class="text-black">
                                        Användare <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>


</div>
