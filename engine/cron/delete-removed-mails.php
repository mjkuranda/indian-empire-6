<?php
	require('../db_manager.php');
	$con = db_connect();
	
	mysqli_query($con, "DELETE FROM mails WHERE is_removed_from = 1 AND is_removed_to = 1");
	echo "Result: ".mysqli_error($con);
	
	mysqli_close($con);
?>