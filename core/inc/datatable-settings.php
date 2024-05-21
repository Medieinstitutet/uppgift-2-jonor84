<?php
if ($LOGGEDIN == true) {
    // Check if ascending sorting is required
    $ASCLIST = array("pages", "countries", "access");
    if (in_array($GETSHOW, $ASCLIST)) {
        $sortingOrder = 'asc';
    } else {
        $sortingOrder = 'desc';
    }

    // Include the corresponding DataTables initialization script
    echo "<script src='core/system/js/datatable-default-$sortingOrder.js'></script>";
}
?>
