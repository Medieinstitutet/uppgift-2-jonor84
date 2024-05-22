
<?
// SHOW RIGHT DEFAULT STATS FOR RIGHT service

if ($_SESSION["service"]) {
    include $_SESSION["service"] . "_stats_default.php";
} else {
    // Include stats default - welcome
    include 'stats_default.php';
    // Include start apps
    //include('cloudapps.php');
} ?>