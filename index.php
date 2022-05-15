<?php
	// Init
	session_start();
	if (ob_get_contents()) {
	    ob_clean();
	}
	ob_start();
	
	// My subsite
	$sub = $_GET['sub'];
	
	/* 
		Check the address...
		When you use http protocol,
		change it on https ;)
	*/
	if ($_SERVER['REQUEST_SCHEME'] == 'http')
		header('location: https://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'/../'.$sub);
	
	/*
		If your address doesn't contain variable 'sub',
		the script alone assigns the value 'main'.
		
		When you are logged in, you can see log/reg/verify subsite.
	*/
	if(!isset($_GET['sub']) or 
		( // logged in
			isset($_GET['sub']) && isset($_SESSION['user']) && !empty($_SESSION['user']) &&
				($sub == 'reg' || $sub == 'log' || $sub == 'verify')
		)
		or
		( // non-logged in
			isset($_GET['sub']) && !isset($_SESSION['user']) && 
			(
				$sub == 'user' || $sub == 'pass' || $sub == 'avatar' || $sub == 'log-out' || $sub == 'log-down' || 
				$sub == 'game' || $sub == 'forum' || $sub == 'mail'
			)
		)
	) // Then
		header('location: https://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'/../main');
	
	if ($_GET['sub'] == 'game' && !(isset($_SESSION['user']) && isset($_COOKIE['user']) && !empty($_COOKIE['user']))) header('location: https://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'/../main');

	// Db connection
	include_once('engine/db_manager.php');
	$con = db_connect();
	
	// Load mecessary files
	include_once('site/updater.php');
	
	// Datas
	$core   = db_query_assoc("SELECT  app_name,
									author_dignity,
									version_number,
									version_type,
									creation_date,
									YEAR(creation_date) AS creation_year,
									last_update_date
							FROM core", $con);
	$users  = db_query_assoc("SELECT COUNT(id) AS registered
							FROM users", $con);
	$visits = db_query_assoc("SELECT SUM(total) AS total, SUM(users) AS users FROM visits", $con);
?>
<!DOCTYPE html>
<html lang="en" translate="yes">
	<head>
		<!-- Config -->
		<meta charset="utf-8" />
		<meta http-equiv="reply-to" content="markoxd105@gmail.com" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="Free and curious game about indian life!" />
		<meta name="keywords" content="indian, wars, game, life, fight" />
		<meta name="author" content="<?php echo $core['author_dignity']; ?>" />
		<meta name="creation-date" content="<?php echo $core['creation_date']; ?>" />
        <title><?php echo $core['app_name']; ?></title>
		<meta name="google" content="yestranslate" />

		<!-- Scripts -->
		<script src="js/jquery-3.5.1.min.js"></script>
		<script src="js/header.js"></script>
		
		<!-- Styles -->
		<link rel="stylesheet" href="css/basic/basic.css" media="all" />
		<link rel="stylesheet" href="css/baner.css" media="all" />
		<link rel="stylesheet" href="css/basic/header.css" media="all" />
		<?php
			// Navigations
			switch($sub) {
				// Main menu
				case 'main':
					?>
					<link rel="stylesheet" href="css/sub/main.css" media="all" />
					
					<!-- Scripts -->
					<!-- <script src="js/main-post.js"></script> -->
					<script src="js/post.js"></script>
					<?php
				break;

				// Post
				case 'post':
					?>
					<link rel="stylesheet" href="css/sub/post.css" media="all" />
					<?php
				break;
				
				// Game
				case 'game':
					?>
					<link rel="stylesheet" href="css/sub/game.css" media="all" />
					<?php
				break;
				
				// Forum
				
				// Help
				
				// Credits
				case 'credits':
					?>
					<link rel="stylesheet" href="css/sub/credits.css" media="all" />
					<?php
				break;
				
				// ==================================
				
				// Registration, Login, Verify
				case 'reg':
				case 'log':
				case 'verify':
					?>
					<link rel="stylesheet" href="css/sub/reglog-main.css" media="all" />
					
					<!-- Scripts -->
					<?php
				break;
				
				// ==================================
				
				// User panel
				case 'user':
					?>
					<link rel="stylesheet" href="css/sub/user-main.css" media="all" />
					<link rel="stylesheet" href="css/sub/user.css" media="all" />
					<?php
				break;
				
				// Password changing
				case 'pass':
					?>
					<link rel="stylesheet" href="css/sub/user-main.css" media="all" />
					<link rel="stylesheet" href="css/sub/reglog-main.css" media="all" />
					<?php
				break;
				
				// Mail messages
				case 'mail':
					?>
					<link rel="stylesheet" href="css/sub/user-main.css" media="all" />
					<link rel="stylesheet" href="css/sub/mail.css" media="all" />
					
					<?php
						if (isset($_GET['sender'])) {
					?>
							<link rel="stylesheet" href="css/sub/mail-sender.css" media="all" />
					<?php
						}
						
						if (isset($_GET['id']) && !empty($_GET['id'])) {
					?>
							<link rel="stylesheet" href="css/sub/mail-id.css" media="all" />
							
							<!-- Scripts -->
							<script src="js/mail-id.js"></script>
					<?php
						}
					?>
					
					<!-- Load scripts -->
					<script src="js/mail-manager.js"></script>
					<?php
				break;
				
				// ==================================
				
				// Error404
				default:
					?>
					<link rel="stylesheet" href="css/sub/error404.css" media="all" />
					<?php
				break;
			}
		?>
		<link rel="stylesheet" href="css/basic/footer.css" media="all" />
		
		<!-- Icon -->
		<link rel="icon" href="favicon.ico" type="image/x-icon" /> 
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> 
	</head>
	<body>
		<!-- Upper border -->
		<div class="web-border"></div>
		<!-- Header, user, navigation -->
		<?php include_once('site/basic/header.php'); ?>
		<!-- Baner bar -->
		<?php 
			if ($sub != 'reg' && $sub != 'log' && $sub != 'verify')
				include_once('site/basic/baner.php');
		?>
		<!-- News, the earliest news and logging -->
		<?php
			// Navigations
			switch($sub) {
				// Main menu
				case 'main':
					include_once('site/sub/main.php');
				break;

				// Post
				case 'post':
					include_once('site/sub/post.php');
				break;
				
				// Game
				case 'game':
					include_once('site/sub/game.php');
				break;
				
				// Forum
				
				// Help
				
				// Credits
				case 'credits':
					include_once('site/sub/credits.php');
				break;
				
				// ==================================
				
				// Registration
				case 'reg':
					include_once('site/reglog/reg.php');
				break;
				
				// Login
				case 'log':
					include_once('site/reglog/log.php');
				break;
				
				// Verify
				case 'verify':
					include_once('site/reglog/verify.php');
				break;
				
				// ==================================
				
				// User panel
				case 'user':
					include_once('site/user/user.php');
				break;
				
				// Password changing
				case 'pass':
					include_once('site/user/pass-change.php');
				break;
				
				// Mail messages
				case 'mail':
					include_once('site/sub/mail.php');
					if (isset($_GET['id']) && !empty($_GET['id']))
						include_once('site/sub/mail-id.php');
				break;
				
				// Log-out
				case 'log-out':
					include_once('site/reglog/log-out.php');
				break;
				
				
				// ==================================
				
				// Error404
				default:
					include_once('site/sub/error404.php');
				break;
			}
		?>
		<!-- Creator -->
		<?php include_once('site/basic/footer.php'); ?>
		<!-- Bottom border -->
		<div class="web-border"></div>
	<body>
</html>