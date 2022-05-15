<?php
	/*
		The function, which makes the connection with db.
		The connection is called $con and 
		the function returns it.
	*/
	function db_connect() {
		// Variables
		$servername = "localhost";
		$username = "root";
		$userpass = "";
		$dbname = "id14588949_indianempire";

		// Make the connection
		$con = new mysqli($servername, $username, $userpass, $dbname);
		
		// If error
		if (!$con) {
			die('Connect Error: ' . mysqli_connect_error());
		}
		
		// Return result
		return $con;
	}
	
	
	/*
		The function, which makes the query
		from the user query.
		
		Variable $q is your query.
	*/
	function db_query($q, $con) {
		// Result of your query
		$result = null;
		
		if (!$con->query($q)) {
			printf("Errormessage: %s\n", $con->error);
		}
		// In other case, execute it
		else {
			$result = mysqli_query($con, $q);
		}
		
		// Return it
		return $result;
	}
	
	
	/*
		Function, which returns result as assoc table
		$q is the query.
	*/
	function db_query_assoc($q, $con) {
		$result = db_query($q, $con);
		if($result != null && $result)
			return mysqli_fetch_array($result);
		// In other case, return null
		return null;
	}