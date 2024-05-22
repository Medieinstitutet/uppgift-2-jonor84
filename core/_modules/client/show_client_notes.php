<? if (!$SUBPAGECACCESS) {
    echo "<div class='$alertError'>$gloWrongAccess2</div>";
} else { ?>


    <h3>Anteckningar</h3>
    <form class="profile-edit">
        <div class="profile-share border-bottom-0">
            <? echo $rowNotes; ?>
        </div>
        <div class="profile-share border-top-0">
            <!-- <button class="btn btn-success ms-auto"><i class="far fa-edit ms-1"></i> Uppdatera</button> -->
        </div>
    </form>



    <? if ($isReseller || $SystemAdmin) { ?>

        <h3>Anteckningar för Personal <small class="text-dark">(Denna syns inte för kund.)</small></h3>
        <form class="profile-edit">
            <div class="profile-share border-bottom-0">
                <? echo $rowANotes; ?>
            </div>
            <div class="profile-share border-top-0">
                <!-- <button class="btn btn-success ms-auto"><i class="far fa-edit ms-1"></i> Uppdatera</button> -->
            </div>
        </form>


    <? } ?>
<? } ?>