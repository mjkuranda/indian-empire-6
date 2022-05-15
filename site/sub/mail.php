<?php
	/* Finish result */
	$msg = NULL;
?>

<!-- Mail section -->
<main id="mail" class="center">
	<h2 class="flexBox">User messager</h2>
	<!-- Mail bar section -->
	<section id="options" class="flexBox">
		<div class="flexBox">
			<a href="user" title="Back to user panel">
				<svg id="user-settings" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
					<path d="M256,181c-41.353,0-75,33.647-75,75c0,41.353,33.647,75,75,75c41.353,0,75-33.647,75-75C331,214.647,297.353,181,256,181z
						"/>
					<path d="M512,298.305v-84.609l-69.408-13.667c-3.794-12.612-8.833-24.771-15.103-36.343l38.73-58.096l-59.81-59.81l-58.096,38.73
						c-11.572-6.27-23.73-11.309-36.343-15.103L298.305,0h-84.609l-13.667,69.408c-12.612,3.794-24.771,8.833-36.343,15.103
						L105.59,45.78l-59.81,59.81l38.73,58.096c-6.27,11.572-11.309,23.73-15.103,36.343L0,213.695v84.609l69.408,13.667
						c3.794,12.612,8.833,24.771,15.103,36.343L45.78,406.41l59.81,59.81l58.096-38.73c11.572,6.27,23.73,11.309,36.343,15.103
						L213.695,512h84.609l13.667-69.408c12.612-3.794,24.771-8.833,36.343-15.103l58.096,38.73l59.81-59.81l-38.73-58.096
						c6.27-11.572,11.309-23.73,15.103-36.343L512,298.305z M256,361c-57.891,0-105-47.109-105-105s47.109-105,105-105
						s105,47.109,105,105S313.891,361,256,361z"/>
				</svg>
			</a>
			<span class="line"></span>
			<a href="?inbox#mail" title="Inbox">
				<svg id="mail-inbox" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
						<path d="M511.695,105.876L331.709,255.751L512,375.738V109.254C512,108.102,511.881,106.978,511.695,105.876z"/>
						<path d="M315.48,269.264l-22.689,18.893c-10.659,8.876-23.725,13.314-36.79,13.314s-26.132-4.438-36.79-13.314l-22.689-18.893
							L0,400.053v2.694c0,11.161,9.081,20.242,20.242,20.242h471.515c11.161,0,20.242-9.081,20.242-20.242v-2.694L315.48,269.264z"/>
						<path d="M491.832,89.012c-0.025,0-0.05,0-0.074,0H20.242c-0.025,0-0.049,0-0.074,0c-2.858,0.011-4.095,3.652-1.899,5.481
							L203.55,248.777c0.022,0.018,0.044,0.037,0.066,0.055l28.547,23.771c13.812,11.502,33.863,11.502,47.675,0l213.893-178.11
							C495.927,92.663,494.689,89.022,491.832,89.012z"/>
						<path d="M0.305,105.876C0.119,106.978,0,108.1,0,109.254v266.484l180.291-119.988L0.305,105.876z"/>
				</svg>
			</a>
			<a href="?outbox#mail" title="Outbox">
				<svg id="mail-outbox" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
					<polygon points="512,334.076 418.845,257.318 418.845,298.091 276.513,298.091 276.513,370.06 418.845,370.06 418.845,410.833" />
					<polygon points="20.482,101.167 186.711,241.422 352.94,101.167" />
					<polygon points="0,123.137 0,329.215 109.741,215.73" />
					<polygon points="263.681,215.731 314.315,268.091 373.422,268.091 373.422,123.137" />
					<polygon points="240.699,235.122 186.711,280.674 132.723,235.121 21.361,350.281 246.513,350.281 246.513,268.091 272.582,268.091" />
				</svg>
			</a>
			<a href="?sender#mail" title="Send a message">
				<svg id="mail-sender" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
					<polygon points="114,151.065 114,365.545 251.56,263.995" />
					<polygon points="350.53,283.625 313,314.435 275.47,283.625 130.38,390.745 495.62,390.745" />
					<polygon points="374.44,263.995 512,365.545 512,151.065" />
					<rect y="301.6" width="85.67" height="30" />
					<rect x="20" y="241.96" width="65.67" height="30" />
					<rect x="40" y="182.31" width="45.666" height="30" />
					<polygon points="124.97,121.255 313,275.625 501.03,121.255" />
				</svg>
			</a>
		</div>
	</section>
	
	<?php
		if (isset($_SESSION['mail_sent'])) {
			?>
			<div>Mail has been sent...</div>
			<?php
			unset($_SESSION['mail_sent']);
		}
	?>

	<?php
		/* Inbox */
		if (isset($_GET['inbox'])) {
			/*
				Here, you can print all messages,
				which you received!
			*/
			?>
			<!-- Messages sent to you -->
			<section id="mails">
				<div>
				<?php
					/* Print message by message */
					$res = mysqli_query($con, "SELECT 
												m.id,
												u.username,
												m.id_from,
												m.title,
												m.when_sent,
												m.when_opened,
												m.is_removed_to
											FROM mails AS m, users AS u
											WHERE m.id_from = u.id AND
												m.id_to = 
													(
														SELECT id
														FROM users
														WHERE username = '".$_SESSION['user']."'
													)");
										
					$rows = mysqli_num_rows($res);
					
					/* If you have messages */
					if ($rows > 0) {
						?>
						<table>
							<tr class="mail-element">
								<th class="mail-title">Title</th>
								<th class="mail-sender">Sender</th>
								<th class="mail-date-sent">Sent date</th>
							</tr>
						<?php
										
						while($row = mysqli_fetch_array($res)) {
							if (!$row['is_removed_to']) {
							?><tr class="mail-element <?php if ($row['when_opened'] == null) echo "non-read"; ?>" value="<?php echo $row['id']; ?>"  onclick="goToMail(this);">
								<td class="mail-title"><?php echo $row['title']; ?></td>
								<td class="mail-sender"><?php echo $row['username']; ?></td>
								<td class="mail-date-sent"><?php echo $row['when_sent']; ?></td>
							</tr><?php
							}
						}
						?>
						</table>
						<?php
					}
					/* No messages */
					else {
						?>
							<div id="mail-no" class="flexBox">
								<div>Your inbox is empty!</div>
							</div>
						<?php
					}
				?>
				</div>
			</section>
			<?php
		} else
		/* Outbox */
		if (isset($_GET['outbox'])) {
			/*
				Here, you can print all messages,
				which you sent!
			*/
			?>
			<!-- Messages sent to you -->
			<section id="mails">
							<div>
				<?php
					/* Print message by message */
					$res = mysqli_query($con, "SELECT 
												m.id,
												u.username,
												m.id_from,
												m.title,
												m.when_sent,
												m.when_opened,
												m.is_removed_from
											FROM mails AS m, users AS u
											WHERE m.id_to = u.id AND
												m.id_from = 
													(
														SELECT id
														FROM users
														WHERE username = '".$_SESSION['user']."'
													)");
										
					$rows = mysqli_num_rows($res);
					
					/* If you have messages */
					if ($rows > 0) {
						?>
						<table>
							<tr class="mail-element">
								<th class="mail-title">Title</th>
								<th class="mail-sender">Receiver</th>
								<th class="mail-date-sent">Sent date</th>
								<th class="mail-date-opened">Opened date</th>
							</tr>
						<?php
										
						while($row = mysqli_fetch_array($res)) {
							if (!$row['is_removed_from']) {
							?><tr class="mail-element" value="<?php echo $row['id']; ?>" onclick="goToMail(this);">
								<td class="mail-title"><?php echo $row['title']; ?></td>
								<td class="mail-sender"><?php echo $row['username']; ?></td>
								<td class="mail-date-sent"><?php echo $row['when_sent']; ?></td>
								<td class="mail-date-opened"><?php if ($row['when_opened'] == null) echo "The message hasn't been opened yet!"; else echo $row['when_opened']; ?></td>
							</tr><?php
							}
						}
						?>
						</table>
						<?php
					}
					/* No messages */
					else {
						?>
							<div id="mail-no" class="flexBox">Your outbox is empty!</div>
						<?php
					}
				?>
				</div>
			</section>
			<?php
		} else
		/* Sender */
		if (isset($_GET['sender'])) {
			?>
				<form action="" method="POST" class="flexBox">
					<div>
						<div id="mail-title" class="flexBox">Send a message</div>
					
						<div class="mail-element">
							<div><label for="receiver">Message receiver: </label></div>
							<div><input type="text" name="receiver" min="1" max="32" required pattern="^[A-Za-z][A-Za-z0-9]{3,32}" title="You can't use special or white chars! Username must be longer than 2 chars!" /></div>
						</div>
						
						<div class="mail-element">
							<div><label for="title">Message title: </label></div>
							<div><input type="text" name="title" required pattern="^[A-Za-z][A-Za-z0-9]{3,32}" title="You can't use special or white chars! Topic must be longer than 2 chars!" /></div>
						</div>
						
						<div>
							<label for="contents">Message contents: </label>
							<div><textarea rows="10" cols="50" name="contents" required></textarea></div>
						</div>
						
						<div id="chars-counter">0/500</div>
						
						<div id="button-submit">
							<input type="submit" class="button" name="submit" value="Send a message" />
						</div>
					</div>
				
					<?php
						/* Mail validation */
						if (empty($_POST['receiver']) || empty($_POST['title']) || empty($_POST['contents'])) {
							/* Subject empty */
							if (empty($_POST['receiver']))
								$msg .= "<li>You need to refill who you are writing to!</li>";
							/* Title empty */
							if (empty($_POST['title']))
								$msg .= "<li>You need to refill message title!</li>";
							/* Contents empty */
							if (empty($_POST['contents']))
								$msg .= "<li>You need to refill message contents!</li>";
						} else {
							/* Mail variables */
							$receiver = $_POST['receiver'];
							$title	  = $_POST['title'];
							$contents = $_POST['contents'];
							
							/* If doesn't exists such user */
							if (!mysqli_num_rows(mysqli_query($con, "SELECT username FROM users WHERE username = '".$receiver."'")))
								$msg .= "<li>The recipient with the given username does not exist!</li>";
							/* Title is to long */
							if (strlen($title) > 32)
								$msg .= "<li>Title is too long!</li>";
							/* Contents is too long */
							if (strlen($contents) > 500)
								$msg .= "<li>Contents is too long!</li>";
							
							/* If any error occured... */
							if (empty($msg)) {
								$id_receiver = mysqli_fetch_array(mysqli_query($con, "SELECT id FROM users WHERE username = '".$receiver."'"))['id'];
								$id_sender   = mysqli_fetch_array(mysqli_query($con, "SELECT id FROM users WHERE username = '".$_SESSION['user']."'"))['id'];
								
								/* If you don't broadcast message to yourself */
								if ($id_receiver != $id_sender) {
									/* Then add to the db */
									mysqli_query($con, "INSERT INTO mails (id_from, id_to, title, contents)
										VALUES ('$id_sender', '$id_receiver', '$title', '$contents')");
										
									if (!mysqli_error($con))
										echo "Mail has been sent!";
									
									if ($_SERVER['REQUEST_METHOD'] == 'POST') {
										$_SESSION['mail_sent'] = true;
										header("Location: http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."/../mail");
										exit;
									}
								}
								/* Add error */
								else $msg .= "<li>You can't broadcast message to yourself!<li>";
							}
						}
					?>
				
					<?php if (isset($_POST['submit']) && isset($msg) && !empty($msg)) {
						?>
						<div id="statumsg"><?php
						echo '<ul id="errors">'.$msg.'</ul>';
						}?>
						</div>
				</form>
			<?php
		}
	?>
</main>