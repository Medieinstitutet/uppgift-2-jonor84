<div class="row mt-1">
  <?
  $DefaultAppImg = $gloCloudsDir . "/moonbird_black_200.png";
  ?>

  <?
  // testapp
  if ($gloClientAccessLevel == 3 || $gloClientAccessLevel == 6 || $gloClientAccessLevel == 9) {
  ?>
    <div class="col-xl-2 grow">
      <div class="card shadow mb-3 d-flex align-items-center justify-content-center grow">
        <div class="card-body card-body1 p-2 container-fluid">
          <div class="thumb w-100 text-center">
            <a href="/testapp"><i class="fa-fw fa-6x hover text-primary fas fa-cubes" style="padding: 12px 5px 12px;" aria-hidden="true" alt="Appar"></i></a>
          </div>
          <div class="w-100 bg-light d-flex p-1 align-items-center justify-content-center">
            <h4 class="font-weight-bold text-primary pt-3 mb-1">
              <a href="/testapp">testapp</a> <a href="/testapp"><i class="fas fa-arrow-circle-right" title="Hantera" aria-hidden="true"></i><span class="sr-only">Hantera</span></a>
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