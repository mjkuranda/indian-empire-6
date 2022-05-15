<main id="user-panel" class="center">
	<h2 class="flexBox">User panel</h2>
	
	<?php include_once('site/user/user-bar.php'); ?>
	
	<section id="user-data">
		<div class="flexBox">
			<!-- Column titles -->
			<section id="col-titles">
				<div>Username:</div>
				<div>E-mail:</div>
				<div>Registered:</div>
			</section>
			<!-- Column content -->
			<section id="col-content">
				<?php
					$row = db_query_assoc("SELECT email, registered FROM users WHERE username = '".$_SESSION['user']."'", $con);
				?>
				<div><?php echo $_SESSION['user']; ?></div>
				<div><?php echo $row['email']; ?></div>
				<div><?php echo $row['registered']; ?></div>
			</section>
		</div>
	</section>
</main>