<?
if ($gloUserNew || $gloUserNewClient) {
	echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
?>
<!-- Begin content -->
<div class="row">

    <div class="col-xl-12 col-md-6 mb-4">
        <div class="card mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold brand-title">
                    <? echo $strHeader; ?> / Ändra bild
                </h3>
            </div>
            <!-- Card Body -->
            <div class="card-body">

                <form enctype="multipart/form-data" method="post" class="form-horizontal"
                    action="<? echo $gloBaseModule; ?>&task=image">
                    <input type='hidden' name='BID' value='999' />
                    <input type='hidden' name='MAX_FILE_SIZE' value='2000000000' />

                    <img src="<? echo $gloAvatarsDir . "/" . $gloUserPic; ?>" class="img-thumbnail"
                    style="border-radius: 50%;max-width:200px;"> <br><br>
                    <a href='#' class='<? echo $btnLight; ?>' title='Radera profilbilden' data-id='$rowID'
                        data-bs-toggle='modal' data-bs-target='#delModal1'><i class='far fa-trash-alt'
                            title='Radera profilbilden'></i></a>

                    <br><br>
                    <div class="form-group">
                        <label for="FileImage">Du kan ladda upp en egen bild om du vill:</label>
                        <br>
                        <input type="file" class="form-control" id="FileImage" name="uploadedfile">
                    </div>



                    <hr>
                    <button type="submit" class="<? echo $btnSuccess; ?>"><i class="fas fa-check-circle"></i>
                        Spara</button>
                    <? echo $gloAbortButton; ?>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- CONFIRM DELETE Modal-->
<div class='modal fade' id='delModal1' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
    aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h4 class='modal-title' id='exampleModalLabel'>Är du säker på att du vill ta bort?</h5>
                    <a class='close btn btn-light' data-bs-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>×</span>
                    </a>
            </div>
            <div class='modal-body'>Profilbilden</div>
            <div class='modal-footer'>
                <a class='btn brand-button' href='<? echo $gloBaseModule; ?>&task=removeimage'><i
                        class="fa-solid fa-circle-check"></i> Ja</a>
                <? echo 	$gloModalAbortButton; ?>
            </div>
        </div>
    </div>
</div>

<!-- End content -->
<? } ?>