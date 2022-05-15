<main class="center">
	<!-- Info about game -->
	<aside>
		<table id="table__visits">
			<tr><th class="table__header" colspan="2">Visits</th></tr>
			<tr><td class="table__title table__highlighted table__interline" colspan="2">Today:&nbsp;
				<?php
					// How many visits today?
					$sql = file_get_contents('sql/select_row_visits_today.sql');
					$row = db_query_assoc($sql, $con);
					echo $row['total'];
				?></td></tr>
			<tr>
				<td class="table__title">Total:</td>
				<td class="table__title">Users:</td>
			</tr>
			<tr>
				<td><?php echo $visits['total']; ?></td>
				<td><?php echo $visits['users']; ?></td>
			</tr>
		</table>

		<table id="table__users">
			<tr><th class="table__header" colspan="2">Users</th></tr>
			<tr><td class="table__title table__highlighted table__interline" colspan="2">Registered today:&nbsp;
				<?php
					// How many users today registered?
					$sql = file_get_contents('sql/select_user_registered_today.sql');
					$row = db_query_assoc($sql, $con);
					echo $row['user_count'];
				?></td></tr>
			<tr>
				<td class="table__title">Total:</td>
				<td class="table__title">Active:</td>
			</tr>
			<tr>
				<td><?php echo $users['registered']; ?></td>
				<td>
					<?php
						// How many active users?
						$sql = file_get_contents('sql/user_active_count.sql');
						$row = db_query_assoc($sql, $con);
						echo $row['user_active_count'];
					?>
				</td>
			</tr>
		</table>
			
		<!-- Logged in? -->	
		<?php
			if (!isset($_SESSION['user'])) {
		?>
				<table id="table__account--create">
					<tr><td class="table__title">Don't have an account?</td></tr>
					<tr><td><a href="reg#reg"><strong>Let's create!</strong></a></td></tr>
				</table>

				<table id="table__account--log--in">
					<tr><td class="table__title">Has an account?</td></tr>
					<tr><td><a href="log#log"><strong>Log in!</strong></a></tr>
				</table>

				<table id="table__account--verify">
					<tr><td><span class="table__title">Has an account but didn't verify? -</span>&nbsp;<a href="verify#verify">do it</a>!</td></tr>
				</table>
		<?php
			}
		?>

		<!-- The newest users -->
		<table id="table__account__newest">
			<tr><td class="table__title">The latest registered users!</td></tr>
			<?php
				// How many the newest users?
				$sql = file_get_contents('sql/select_new_users.sql');
				$result = mysqli_query($con, $sql);
				while($row = mysqli_fetch_assoc($result)) {
					?><tr><td class="table__highlighted"><?php echo $row['username']; ?></td></tr><?php
				}
			?>
		</table>
	</aside>
	
	<!-- News container -->
	<article>
		<?php
			$sql = file_get_contents('sql/select_new_posts.sql');
			$result = mysqli_query($con, $sql);
			while($row = mysqli_fetch_assoc($result)) {
				?>
				<section class="news">
					<h2><?php echo $row['title']; ?></h2>
					<div class="middle">
						<p class="news-text clamp"><?php echo $row['content']; ?></p>
					</div>
					<div class="bottom">
						<p><strong>Posted:</strong>&nbsp;
							<span class="post-diff">
								<?php
									echo '(';
									if ($row['date_diff'] < 1) echo 'Less than 1 moon ago';
									elseif ($row['date_diff'] == 1) echo '1 moon ago';
									elseif ($row['date_diff'] < 30) echo $row['date_diff'].' moons ago';
									else echo 'Many moons ago';
									echo ')';
								?>
							</span>&nbsp;
						<span class="post-date"><?php echo $row['date']; ?></span></p>
						<button class="button" title="Read this post" value="<?php echo $row['id']; ?>">Read more...</button>
					</div>
				</section>
				<?php
			}
		?>
		<section class="news"></section>
	</article>
</main>