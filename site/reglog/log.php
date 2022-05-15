<main id="log">
	<?php include_once('site/reglog/reglog-baner.php'); ?>
	<section id="reglog-form">
			<form action="" method="POST" class="reglog flexBox">
				<div>
					<h2 id="reglog-title" class="flexBox">Log in your account</h2>
					<div class="flexBox">
						<label class="reglog-element" for="uname">Username:</label>
						<input class="reglog-element" type="text" name="uname" value="" />
					</div>
					<div class="flexBox">
						<label class="reglog-element" for="password">Password:</label>
						<input class="reglog-element" type="password" name="password" value="" />
					</div>
					<div class="flexBox">
						<input type="submit" class="button" value="Log in" />
					</div>
				</div>
			</form>
			
			<?php
				$match = 0;
				$msg = null;
				
				if(isset($_POST['uname']) && !empty($_POST['uname']) AND isset($_POST['password']) && !empty($_POST['password'])){
					$username = trim(mysqli_escape_string($con, $_POST['uname']));
					$password = trim(mysqli_escape_string($con, md5($_POST['password'])));
					
					$search = mysqli_query($con, "SELECT id, username, password, active FROM users WHERE username='".$username."' AND password='".$password."' AND active='1'")
								or die(mysqli_error($con)); 
					$match  = mysqli_num_rows($search);
					
					/* If logging in successful */
					if ($match > 0) {
						$msg = 'Login Complete! Thanks';
						$row = mysqli_fetch_array($search);
						// Set cookie / Start Session / Start Download etc...
						session_start();
						setcookie('user', $username, time() + (86400 * 2), "/"); // 86400 - 1 day
						setcookie('user-id', $row['id'], time() + (86400) * 2, "/");
						$_SESSION['user'] = $username;
						mysqli_query($con, "UPDATE users SET last_login = NOW() WHERE username = '".$username."'");
						
						header('location: main');
					} else {
						$msg = 'Login Failed! Please make sure that you enter the correct details and that you have activated your account.';
					}
				}
			?>
			
			<section id="reglog-error" class="flexBox" style="display: <?php if ($msg == null || strlen($msg) == 0) echo 'none'; else echo 'flex'; ?>" >
				<div>
					<?php
						echo 'Matches: '.$match."<br>";
						echo $msg;
					?>
				</div>
			</section>
	</section>
</main>