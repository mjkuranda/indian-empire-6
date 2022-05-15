<main id="reg">
	<?php include_once('site/reglog/reglog-baner.php'); ?>
	<section id="reglog-form">
		<form action="" method="POST" class="reglog flexBox">
			<div>
				<h2 id="reglog-title" class="flexBox">Register your account</h2>
				<div class="flexBox">
					<label class="reglog-element" for="uname">Input your username: </label>
					<input class="reglog-element" type="text" name="uname" value="" />
				</div>

				<div class="flexBox">
					<label class="reglog-element" for="pass">Input your password: </label>
					<input class="reglog-element" type="password" name="pass" value="" />
				</div>
				
				<div class="flexBox">
					<label class="reglog-element" for="email">Input your e-mail: </label>
					<input class="reglog-element" type="text" name="email" value="" />
				</div>
				
				<div class="flexBox">
					<input type="submit" name="sender" class="button" value="Create" />
				</div>
			</div>
		</form>
		
		<section id="reglog-error" class="flexBox" style="display: none;" >
			<div>
				<?php if (isset($msg) && $msg != null) echo $msg; ?>
			</div>
		</section>
	</section>
</main>

<?php
	/*
		This part is responsible
		for validation and 
		transfering datas from the form.
	*/
	
	if(	isset($_POST['uname']) && !empty($_POST['uname']) AND 
	isset($_POST['email']) && !empty($_POST['email']) &&
	isset($_POST['pass']) && !empty($_POST['pass'])
	) {
		/*
			This part is responsible
			for checking, whether
			exists user with this username 
			or address e-mail...
		*/
		$search = mysqli_query($con, "SELECT username, email FROM users WHERE username = '".$_POST['uname']."' OR email = '".$_POST['email']."'")
					or die(mysqli_error($con));
		$match  = mysqli_num_rows($search);
		
		/* If was found a user... */
		if ($match > 0) {
			$msg = "User with the given address e-mail/username already exists!";
		}
		/* In other case continue... */
		else {
			// User variables
			$name = $_POST['uname'];
			$email = trim(mysqli_real_escape_string($con, $_POST['email']));
			$pass = trim(mysqli_real_escape_string($con, $_POST['pass']));
			
			// Validation
			if (filter_var($email, FILTER_VALIDATE_EMAIL) &&
				preg_match("/^[a-zA-Z][a-zA-Z0-9']{3,31}$/", $name) &&
				preg_match("/^[a-zA-Z0-9!@#$]{8,32}$/", $pass)) {

				// Return Success - Valid Email
				$msg = 'Your account has been made, <br /> please verify it by clicking <a href="verify?email='.$email.'" style="color: blue;">the activation link</a> that has been recevied on your email.';
				
				/* Create hash and random password for the user */
				$hash = rand(0, 1000);
				
				/*
					Send a mysqli_query to the DB.
					Password is generated automatically.
				*/
				if(! mysqli_query($con, "INSERT INTO users (username, password, email, hash) VALUES (
							'". mysqli_real_escape_string($con, $name) ."', 
							'". mysqli_real_escape_string($con, md5($pass)) ."', 
							'". mysqli_real_escape_string($con, $email) ."', 
							'". mysqli_real_escape_string($con, md5($hash)) ."') ")
				) printf("Errormessage: %s\n", mysqli_error($con));
				
				mysqli_query($con, "UPDATE users SET registered = NOW() WHERE username = '".$name."'");
				
				/*
					Send to the user email information
					about account creation.
					This message contains informations about
					your username and password, which were created
					by this system.
				*/
				$to      = $email; // Send email to our user
				$subject = 'Signup | Verification'; // Give the email a subject 
				$message = 'Please copy this code to activate your account: '.$hash;
									 
				$headers = 'From:noreply@indian-empire.000webhostapp.com' . "\r\n"; // Set from headers
				mail($to, $subject, $message, $headers); // Send our email
				
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_SESSION['post'] = true;
					$_SESSION['email'] = $email;
					header("Location: https://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."/../reg");
					exit;
				}
			} else {
				// Return Error - Invalid Email
				$msg = 'The email or password you have entered is invalid, please try again.';
			}
		}
	}

	if (!empty($msg)) {
		echo $msg;
	}
	
	
	
	
	if (isset($_SESSION['post']) && $_SESSION['post']) {
		header('location: https://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'/../verify?email='.$_SESSION['email'].'#verify');
	}
?>