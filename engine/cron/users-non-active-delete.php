<?php
	require('../db_manager.php');
	$con = db_connect();
	
	mysqli_query($con, "DELETE FROM users WHERE active = 0");
	echo "Result: ".mysqli_error($con);
	
	mysqli_close($con);
?>