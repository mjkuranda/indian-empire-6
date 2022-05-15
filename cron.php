<?php
	// Connect with the db
	include_once('../engine/db_manager.php');
	$con = db_connect();

	// Get the server time:
	$hours    = date('H');
	$minutes  = date('i');

	// Every 24 hours
	// 00:00
	if ($hours == 0 && $minutes == 0) {
		mysqli_query($con, "INSERT INTO visits (`date_row`) VALUES ('".date('Y-m-d')."')");
	}
?>