<main id="verify">
	<?php include_once('site/reglog/reglog-baner.php'); ?>
	<section id="reglog-form">
		<form action="" method="POST" class="reglog flexBox">
			<div>
				<h2 id="reglog-title" class="flexBox">Verify your account</h2>
				<div class="flexBox">
				<label class="reglog-element" for="email">Input your e-mail:</label>
				<!-- Email field -->
				<input class="reglog-element" type="text" name="email" 
					<?php
						/*
							If get variable 'email' is set and isn't empty, then
							email field let be hidden for client...
						*/
						if (isset($_GET['email']) and !empty($_GET['email'])) echo 'hidden';
					?> />
				</div>

				<div class="flexBox">
					<label class="reglog-element" for="code">Input your code:</label>
					<input class="reglog-element" type="numeric" name="code" min="0" max="999" />
				</div>
				
				<div class="flexBox">
					<input class="button" type="submit" name="submit" value="Verify your account" />
				</div>
			</div>
		</form>
		
		<section id="reglog-error">
			<div>
				<?php
					if (isset($_SESSION['post'])) {
						$_SESSION['post'] = null;
						echo 'Your account has been made, <br /> please verify it by input activation link that has been recevied on your email.';
					}
				?>
				<?php
					/*
						After clicking the submit button...
					*/
					if (isset($_POST['submit'])) {		
						/*
							Check the email
							NOR logical operator
						*/
						if (!(isset($_GET['email']) or (isset($_POST['email']) && !empty($_POST['email']))))
							echo "You must give email to verify your account!";
						/* 
							If the both email was given :)
							It's against those who want to cheat ;)
						*/
						elseif (isset($_GET['email']) and isset($_POST['email']) and !empty($_POST['email'])) {
							if ($_GET['email'] !== $_POST['email']) {
								echo "You gave two different emails (in URL and in the email field)!";
								//return;
							}
						}
						/* In other case verify... */
						else {
							/*
							Check if address url contains needed variables.
							In other case redirect on main page,
							bacause somebody want to hack to the this subsite,
							however he will redirect.
							*/		
							if (isset($_POST['code']) && !empty($_POST['code']))
								verify($con);
							else
								echo "You must give your got code to verify your account!";
						}
					}
				?>
			</div>
		</section>
	</section>
</main>


<div id="verify-message">
	<?php
		/*
			Function to verify
			Returns result (true/false - success/failure)
		*/
		function verify($con) {
			$mail  = (isset($_GET['email']) ? $_GET['email'] : $_POST['email']);
			
			/* Saving our variables	*/
			$email = mysqli_escape_string($con, $mail);
			$code  = mysqli_escape_string($con, $_POST['code']);
			
			/*
				Comparasion and checking if exists such user
				in the db...
			*/
			$search = mysqli_query($con, 
							"SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".md5($code)."' AND active='0'")
						or die(mysqli_error($con)); 
			$match  = mysqli_num_rows($search);
			
			/*
				Now, verification is following...
				If result returns true (1), then account
				will be activated,
				however if will return false (0),
				you get message about failure...
			*/
			$result = ($match or $match > 1);
			
			if ($match or $match > 1) {
				echo "Your account has been activated! :) \n Welcome in our service!";
				echo "<br>Please, log in now!";
				
				/* Change in the db */
				mysqli_query($con, "UPDATE users SET active = 1 WHERE email = '".$email."'") or die(mysqli_error($con));
				
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_SESSION['post'] = true;
					header("Location: http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."/../mail");
					exit;
				}
			}
			/* failure :( */
			else {
				echo "Uppss... Something wrong :(<br>Attempt account activation failed!<br>Try again!";
			}
			
			// Return the result
			return $result;
		}
	?>
</div>

<?php
	if (isset($_SESSION['post'])) {
		?>
		<div><?php echo 'Your account has been activated! :) \n Welcome in our service!<br>Please, log in now!'; ?></div>
		<?php
		unset($_SESSION['post']);
	}
?>