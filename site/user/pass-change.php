<main id="pass" class="center">
	<?php include_once('site/user/user-bar.php'); ?>

	<form action="" method="POST" class="reglog" style="height: 320px;">
		<h2 class="flexBox">Changing your password</h2>
		
		<div class="flexBox" style="margin-bottom: 30px;">
			<label class="reglog-element" for="pass-old">Input your old password:</label>
			<input class="reglog-element" type="password" name="pass-old" />
		</div>
		
		<div class="flexBox">
			<label class="reglog-element" for="pass-new">Input your new password:</label>
			<input class="reglog-element" type="password" name="pass-new" />
		</div>
		
		<div class="flexBox">
			<label class="reglog-element" for="pass-new2">Repeat new password:</label>
			<input class="reglog-element" type="password" name="pass-new2" />
		</div>
		
		<div class="flexBox"><input class="button" type="submit" name="submit" value="Reset" /></div>
	</form>

	<?php
		/* If submit was clicked... */
		if (isset($_POST['submit'])) {
			$pass_old  = mysqli_real_escape_string($con, $_POST['pass-old']);
			$pass_new  = mysqli_real_escape_string($con, $_POST['pass-new']);
			$pass_new2 = mysqli_real_escape_string($con, $_POST['pass-new2']);
			
			$pass_user = mysqli_fetch_array(mysqli_query($con, "SELECT password FROM users WHERE username = '".$_SESSION['user']."'"))['password'];

			/* If there are empty */
			if (empty($pass_old) or empty($pass_new) or empty($pass_new2))
				$msg = "No field can be empty!";
			/*
				If the both passwords (from db and inputted
				are the same)...
			*/
			elseif (md5($pass_old) == $pass_user) {
				include('site/valid.php');
				/* If the both don't contain white chars */
				if ($pass_new == remove_white_chars($pass_new) && $pass_new2 == remove_white_chars($pass_new2)) {
					/* If the both passwords are the same (new and new2) */
					if ($pass_new == $pass_new2) {
						/* Change the password in the db */
						mysqli_query($con, "UPDATE users SET password = '".md5($pass_new)."' WHERE username = '".$_SESSION['user']."'") or die(mysqli_error($con));
						
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {
							$_SESSION['post'] = true;
							header("Location: http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."/../pass");
							exit;
						}
						
						$msg = "Action was successful!";
					}
					else $msg = "The new password must be the same like repeated password!";
				}
				else $msg = "Password can't contain white chars!";
			}
			else $msg = "The password you entered does not match your current password!";
		}
	?>

	<div id="statusmsg"><?php if(isset($_POST['submit'])) echo $msg; ?></div>

	<?php
		if (isset($_SESSION['post'])) {
			?>
			<div>Password has been changed...</div>
			<?php
			unset($_SESSION['post']);
		}
	?>

</main>