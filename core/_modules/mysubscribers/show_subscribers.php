<?php
if ($_SESSION["service"] != "mysubscribers") {
    echo "<div class='$alertError'>$gloWrongAccess</div>";
} else {
    // Get subscribers for newsletters
    $subscribersData = getClientNewsletterSubscribers();
    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
            <h2 class="m-0 font-weight-bold text-primary"><?php echo $strHeader; ?></h2>
            <div class="dropdown no-arrow">
            </div>
        </div>
        <?php
        if (!empty($subscribersData)) {
        ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped display responsive" style="white-space:nowrap; margin-bottom: 0px;" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Namn</th>
                            <th>E-post</th>
                            <th>Nyhetsbrev</th>
                            <th>Inlagd</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Namn</th>
                            <th>E-post</th>
                            <th>Nyhetsbrev</th>
                            <th>Inlagd</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($subscribersData as $subscriber) {
                            echo "<tr>";
                            echo "<td>" . $subscriber['user_id'] . "</td>"; 
                            echo "<td>" . $subscriber['user_fname'] . " " . $subscriber['user_sname'] . "</td>";
                            echo "<td>" . $subscriber['user_email'] . "</td>";
                            echo "<td>" . $subscriber['newsletter_name'] . "</td>";
                            echo "<td>" . $subscriber['subscription_date'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php echo $HRB; ?>
            <?php echo $gloCloseButton; ?>
        </div>
        <?php } else { ?>
            <div class="card-body">
                Just nu finns det inga aktiva prenumenationer av nyhetsbrev. Gå till <a class="btn btn-primary" href='/newsletters'><i class="fas fa-mail-bulk"></i> Nyhetsbrev</a> om du vill starta en prenumeration.
                <?php echo $HRB; ?>
                <?php echo $gloCloseButton; ?>
            </div>
        <?php } ?>
    </div>
<?php
}
?>
