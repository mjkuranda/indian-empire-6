<?php
	/* This file prints selected message */
	
	/*
		If this message isn't connected with logged in user
		or any user is logged in
		AND id exists!
	*/
	$sql = "SELECT id 
			FROM mails 
			WHERE
				(id_from = (
						SELECT id
						FROM users
						WHERE username = '".$_SESSION['user']."'
					) OR
					id_to = (
						SELECT id
						FROM users
						WHERE username = '".$_SESSION['user']."'
					)
				) AND
				id = ".$_GET['id'];
	
	/*
		If exists such message
	*/
	if (isset($_SESSION['user']) && mysqli_num_rows(mysqli_query($con, $sql))) {
		/*
			Give the datas from message ;)
		*/
		$sql = "SELECT u_from.username AS u1, u_to.username AS u2, mails.id_to AS id_receiver,
						id_from, id_to, when_opened, mails.title, mails.contents
				FROM ((mails
				INNER JOIN users AS u_from ON id_from = u_from.id)
				INNER JOIN users AS u_to   ON id_to   = u_to.id)
				WHERE mails.id = ".$_GET['id'];
		$row = mysqli_fetch_array(mysqli_query($con, $sql));



		/*
			Check, if user is the message receiver,
			then save into db open's date
		*/
		$id_receiver = mysqli_fetch_array(mysqli_query($con, "SELECT id FROM users WHERE username = '".$_COOKIE['user']."'"))['id'];
		if (empty($row['when_opened']) && $row['id_receiver'] == $id_receiver) {
			mysqli_query($con, "UPDATE mails SET when_opened = NOW() WHERE id = '".$_GET['id']."'");
		}
		
		?>
			<section id="mail" class="center">
				<table>
					<tr>
						<th>Sender:</th>
						<th>Receiver:</th>
						<th>Title:</th>
						<th>Date sent:</th>
						<th>Date opened:</th>
					</tr>
					<tr>
						<td><?php echo $row['u1']; ?></td>
						<td><?php echo $row['u2']; ?></td>
						<td><?php echo $row['title']; ?></td>
						<td></td>
						<td></td>
					</tr>
				</table>
				
				<section id="mail-contents">
					<div>Message contents:</div>
					<textarea cols="50" rows="10" disabled><?php echo $row['contents']; ?></textarea>
				</section>
				
				<form action="" method="POST">
					<div>
						<button id="button-back" name="button-back" class="button">Back to the outbox</button>
						<button id="button-delete" name="button-delete" class="button">Delete message</button>
						
						<?php
							if (isset($_POST['button-back'])) header('location: mail?outbox#mail');
							if (isset($_POST['button-delete'])) {
								if ($_COOKIE['user'] == $row['u1']) {
									mysqli_query($con, "UPDATE mails SET is_removed_from = 1 WHERE id = '".$_GET['id']."'");
								} else
								if ($_COOKIE['user'] == $row['u2']) {
									mysqli_query($con, "UPDATE mails SET is_removed_to   = 1 WHERE id = '".$_GET['id']."'");
								}
								//mysqli_query($con, "DELETE FROM	mails WHERE id = '".$_GET['id']."';");
								//header('location: '.$_SERVER["HTTP_REFERER"]);
								header('location: mail#mail');
							}
						?>
					</div>
				</form>
			</section>
		<?php
	}
	/* Redirect to user outbox */
	else header('location: mail?outbox#mail');
?>