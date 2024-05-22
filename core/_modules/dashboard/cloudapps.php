<div class="row mt-1">

<?
  // Prenumeranter
  if ($gloClientAccessLevel == 0 || $gloClientAccessLevel == 1) {
?>
    <div class="col-xl-3 grow">
      <div class="card shadow mb-3 d-flex align-items-center justify-content-center grow">
        <div class="card-body card-body1 p-2 container-fluid">
          <div class="thumb w-100 text-center">
            <a href="/newsletters"><i class="fa-fw fa-6x hover text-primary fas fa-mail-bulk" style="padding: 12px 5px 12px;" aria-hidden="true" alt="Appar"></i></a>
          </div>
          <div class="w-100 bg-light d-flex p-1 align-items-center justify-content-center">
            <h4 class="font-weight-bold text-primary pt-3 mb-1">
              <a href="/newsletters">Alla Nyhetsbrev</a> <a href="/newsletters"><i class="fas fa-arrow-circle-right" title="Hantera" aria-hidden="true"></i><span class="sr-only">Hantera</span></a>
            </h4>
          </div>

          <div class="w-100 bg-light d-flex pb-2 align-items-center justify-content-center">
            <small>Utforska</small>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <div class="col-xl-3 grow">
      <div class="card shadow mb-3 d-flex align-items-center justify-content-center grow">
        <div class="card-body card-body1 p-2 container-fluid">
          <div class="thumb w-100 text-center">
            <a href="/mysubscriptions"><i class="fa-fw fa-6x hover text-primary fas fa-user-cog" style="padding: 12px 5px 12px;" aria-hidden="true" alt="Appar"></i></a>
          </div>
          <div class="w-100 bg-light d-flex p-1 align-items-center justify-content-center">
            <h4 class="font-weight-bold text-primary pt-3 mb-1">
              <a href="/mysubscriptions">Mina Prenumerationer</a> <a href="/mysubscriptions"><i class="fas fa-arrow-circle-right" title="Hantera" aria-hidden="true"></i><span class="sr-only">Hantera</span></a>
            </h4>
          </div>

          <div class="w-100 bg-light d-flex pb-2 align-items-center justify-content-center">
            <small>Hantera</small>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
<?
  } ?>

<?
  // Prenumeranter
  if ($gloClientAccessLevel == 2 || $gloClientAccessLevel == 3) {
?>
<div class="col-xl-3 grow">
      <div class="card shadow mb-3 d-flex align-items-center justify-content-center grow">
        <div class="card-body card-body1 p-2 container-fluid">
          <div class="thumb w-100 text-center">
            <a href="/mysubscribers"><i class="fa-fw fa-6x hover text-primary fas fa-user-cog" style="padding: 12px 5px 12px;" aria-hidden="true" alt="Appar"></i></a>
          </div>
          <div class="w-100 bg-light d-flex p-1 align-items-center justify-content-center">
            <h4 class="font-weight-bold text-primary pt-3 mb-1">
              <a href="/mysubscribers">Mina Prenumeranter</a> <a href="/mysubscribers"><i class="fas fa-arrow-circle-right" title="Hantera" aria-hidden="true"></i><span class="sr-only">Hantera</span></a>
            </h4>
          </div>

          <div class="w-100 bg-light d-flex pb-2 align-items-center justify-content-center">
            <small>Hantera</small>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <div class="col-xl-3 grow">
      <div class="card shadow mb-3 d-flex align-items-center justify-content-center grow">
        <div class="card-body card-body1 p-2 container-fluid">
          <div class="thumb w-100 text-center">
            <a href="/mynewsletters"><i class="fa-fw fa-6x hover text-primary fas fa-mail-bulk" style="padding: 12px 5px 12px;" aria-hidden="true" alt="Appar"></i></a>
          </div>
          <div class="w-100 bg-light d-flex p-1 align-items-center justify-content-center">
            <h4 class="font-weight-bold text-primary pt-3 mb-1">
              <a href="/mynewsletters">Mina Nyhetsbrev</a> <a href="/mynewsletters"><i class="fas fa-arrow-circle-right" title="Hantera" aria-hidden="true"></i><span class="sr-only">Hantera</span></a>
            </h4>
          </div>

          <div class="w-100 bg-light d-flex pb-2 align-items-center justify-content-center">
            <small>Utforska</small>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    
<?
  } ?>

<?
  // Admins
  if ($gloClientAccessLevel > 5) {
?>
<div class="col-xl-3 grow">
      <div class="card shadow mb-3 d-flex align-items-center justify-content-center grow">
        <div class="card-body card-body1 p-2 container-fluid">
          <div class="thumb w-100 text-center">
            <a href="/sys"><i class="fa-fw fa-6x hover text-primary fas fa-user-cog" style="padding: 12px 5px 12px;" aria-hidden="true" alt="Appar"></i></a>
          </div>
          <div class="w-100 bg-light d-flex p-1 align-items-center justify-content-center">
            <h4 class="font-weight-bold text-primary pt-3 mb-1">
              <a href="/sys">Adminpanel</a> <a href="/sys"><i class="fas fa-arrow-circle-right" title="Hantera" aria-hidden="true"></i><span class="sr-only">Hantera</span></a>
            </h4>
          </div>

          <div class="w-100 bg-light d-flex pb-2 align-items-center justify-content-center">
            <small>Hantera</small>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    
<?
  } ?>


</div>