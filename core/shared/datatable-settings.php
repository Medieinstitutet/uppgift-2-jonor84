<?php
if ($LOGGEDIN == true) {
    $ASCLIST = array("pages", "countries", "access");
    if (in_array($GETSHOW, $ASCLIST)) {
        $sortingOrder = 'asc';
    } else {
        $sortingOrder = 'desc';
    }

    echo "<script src='core/system/js/datatable-default-$sortingOrder.js'></script>";
}
?>
