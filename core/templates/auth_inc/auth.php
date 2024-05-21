<?php 

if ($URLCODE) { 
	include 'inc-auth-c.php';
} else if ($gloBANKID == 1) { 
	include 'auth-bankid.php';
} else {
	include 'auth-default.php';
}

?>		