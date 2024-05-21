<div class="row">
  <div class="col-xl-12">

    <div class="card mb-4 pb-0">
      <div class="card-header p-4">
        <div class="col-xl-7">
          <h3 class="m-0 font-weight-bold brand-title">Välkommen <? echo $gloFName; ?>! <img style="max-width: 30px; margin-top: -9px;" src="<? echo $gloImgURL; ?>/hellohand.webp"></h3>
        </div>
        <div class="col-xl-5">
          <div class="qoutebox text-center" style="font-size: 12px; white-space: break-spaces;">Aktiv kundprofil: <span class="font-weight-bold"><? echo $gloClientCompany; ?></span></div>
        </div>
      </div>
      <div class="card-body p-4">
        <div class="row mb-0">
          <div class="col-xl-7">
            <? echo $gloBrandStartappsWelcome; ?>
          </div>
          <div class="col-xl-5 mt-2">
            <div class="qoutebox text-center qouteboxtop"><i class="fas fa-quote-right fa-2x pr-3 brand-title"></i> <? echo $gloShowQoute; ?></div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>