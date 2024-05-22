<?php
if ($_SESSION["service"] != "mynewsletters") {
    echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
    // get newsletter data
    $newslettersData = getmyNewsletterClientData($gloUID);
    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
            <h2 class="m-0 font-weight-bold text-primary"><?php echo $strHeader; ?></h2>
            <div class="dropdown no-arrow">
                <span><a class="btn btn-primary btn-sm" role="button" href="<? echo $gloBaseModule; ?>&show=add"><i class="fas fa-plus" title="Skapa"></i> Skapa</a></span>
            </div>
        </div>
        <?php
        if (!empty($newslettersData)) {
        ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped display responsive" style="white-space:nowrap; margin-bottom: 0px;" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
							<th>ID</th>
                            <th>Namn</th>
							<th>Beskrivning</th>
                            <th>Status</th>
                            <th>Inlagd</th>
							<th>Hantera</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
							<th>ID</th>
                            <th>Namn</th>
							<th>Beskrivning</th>
                            <th>Status</th>
                            <th>Inlagd</th>
							<th>Hantera</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
						$EDITICON = "<i class='fas fa-edit text-primary'></i>";
						$REMOVEICON = "<i class='fas fa-times-circle text-danger'></i>";
						$ACTIVEICON = "<i class='fas fa-check-circle text-success'></i>";
						$INACTIVEICON = "<i class='fas fa-times-circle text-dark'></i>";

                        foreach ($newslettersData as $newsletter) {
    
                            echo "<tr>";
                            echo "<td>" . $newsletter['id'] . "</td>";
                            echo "<td>" . $newsletter['name'] . "</td>";
                            echo "<td>" . $newsletter['description'] . "</td>";
                            echo "<td>";
                                if ($newsletter['active']) {
                                    echo $ACTIVEICON;
                                } else {
                                    echo $INACTIVEICON;
                                }
                            echo "</td>";                            echo "<td>" . $newsletter['added'] . "</td>";
                            echo "<td>";
                                echo "<a href='" . $gloBaseModule . "&id=" . $newsletter['id'] . "&show=edit' class='btn btn-light btn-sm' style='display: inline;'>";
                                echo "<input type='hidden' name='frmID' value='" . $newsletter['id'] . "'>";
                                echo "<input type='hidden' name='frmName' value='" . $newsletter['name'] . "'>";
                                echo $EDITICON;
                                echo "</a>";
                                echo "<form action='" . $gloBaseModule . "&task=remove' method='post' style='display: inline;'>";
                                echo "<input type='hidden' name='frmID' value='" . $newsletter['id'] . "'>";
                                echo "<input type='hidden' name='frmName' value='" . $newsletter['name'] . "'>";
                                echo "<button type='submit' class='btn btn-light btn-sm'>".$REMOVEICON."</button>";
                                echo "</form>";
                            echo "</td>";                 
                            echo "</tr>";
                            
                        }
                        ?>
                    </tbody>
                </table>
            </div>
			<? echo $HRB; ?>
			<? echo $gloCloseButton; ?>
        </div>
        <?php } else { ?>
            <div class="card-body">
                Just nu finns det inga aktiva nyhetsbrev.
				<? echo $HRB; ?>
			    <? echo $gloCloseButton; ?>
            </div>
        <?php } ?>
    </div>
<?php
}
?>
<script>
function redirectToSubscriptions() {
    window.location.href = '/mysubscriptions';
}
</script>