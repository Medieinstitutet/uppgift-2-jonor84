<?php
if ($_SESSION["service"] != "mysubscriptions") {
    echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
    // get newsletter data
    $newslettersData = getmyNewsletterData();
    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
            <h2 class="m-0 font-weight-bold text-primary"><?php echo $strHeader; ?></h2>
            <div class="dropdown no-arrow">
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
                            <th>Inlagd</th>
							<th>Hantera</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
							<th>ID</th>
                            <th>Namn</th>
							<th>Beskrivning</th>
                            <th>Inlagd</th>
							<th>Hantera</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
						$SHOWICON = "<i class='fas fa-minus-circle text-danger'></i>";
                        $buttonAction = $gloBaseModule."&task=remove";

                        foreach ($newslettersData as $newsletter) {

                            echo "<tr>";
                            echo "<td>" . $newsletter['id'] . "</td>";
                            echo "<td>" . $newsletter['name'] . "</td>";
                            echo "<td>" . $newsletter['description'] . "</td>";
							echo "<td>" . $newsletter['added'] . "</td>";
							echo "<td>";
									echo "<form action='" . $buttonAction . "' method='post'>";
									echo "<input type='hidden' name='frmID' value='" . $newsletter['id'] . "'>";
									echo "<input type='hidden' name='frmName' value='" . $newsletter['name'] . "'>";
									echo "<button type='submit' class='btn btn-light btn-sm'>".$SHOWICON."</button>";
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
                Just nu finns det inga aktiva prenumenationer av nyhetsbrev. Gå till <a class="btn btn-primary" href='/newsletters'><i class="fas fa-mail-bulk"></i> Nyhetsbrev</a> om du vill starta en prenumeration.
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