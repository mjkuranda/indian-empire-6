<?php
	session_start();
	session_destroy();
	
	mysqli_query($con, "UPDATE users SET last_logout = NOW() WHERE username = '".$_COOKIE['user']."'");
	setcookie('user', '', time()-3600*72, "/");
	setcookie('user-id', '', time()-3600*72, "/");
	header('location: log#log');