<?php
	/*
		This file is run,
		when somebody runs the index.php file.
		Then website add one visit,
		users, who clicked it, will give active status...
	*/
	
	// If somebody is logged in
	if (isset($_SESSION['user'])) {
		// Make active current user
		$sql = "UPDATE users SET last_active = '".date("Y-m-d H:i:s")."' WHERE username = '".$_SESSION['user']."'";
		mysqli_query($con, $sql);
	}
	
	/* If you run any subsite */
	if (isset($_SESSION['user']) && ((!isset($_COOKIE['visit-user']) || ((isset($_COOKIE['visit-user']) && !isset($_COOKIE['user-'.$_SESSION['user']])))))) {
		// Add one visit
		$sql = "UPDATE visits 	SET 	total = total + 1,
										users = users + 1
								WHERE 	date_row = '".date('Y-m-d')."'";
		mysqli_query($con, $sql);
		setcookie('visit-user', 'set', strtotime('today 23:59:59'), '/');
		setcookie('user-'.$_SESSION['user'], 'set', strtotime('today 23:59:59'), '/');
	} else
	if (!isset($_COOKIE['visit-guest'])) {
		/* If you are as guest */
		// Add one visit
		$sql = "UPDATE visits 	SET 	total = total + 1
								WHERE 	date_row = '".date('Y-m-d')."'";
		mysqli_query($con, $sql);	
		setcookie('visit-guest', 'set', strtotime('today 23:59:59'), '/');		
	}
?>