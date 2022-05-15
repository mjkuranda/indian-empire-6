<?php
	require('../db_manager.php');
	$con = db_connect();
	
	mysqli_query($con, "INSERT INTO visits (date_row) VALUES ('".date('Y-m-d')."')");