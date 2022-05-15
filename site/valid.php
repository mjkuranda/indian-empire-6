<?php
	/*
		Function that removes white chars
		spaces inter words etc....
		
		$str - it's string that (can) contain(s)
		white chars.
	*/
	function remove_white_chars ($str) {
		return preg_replace('/\s+/', '', $str);
	}