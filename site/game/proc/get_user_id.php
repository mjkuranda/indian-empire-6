<?php
    include_once('../../../engine/db_manager.php');
    $con = db_connect();

    # Find id of user
    $result = mysqli_query($con, "SELECT id FROM `users` WHERE `username` = '".$_POST['user']."'");
    $row = mysqli_fetch_array($result);
    $user_id = $row['id'];

    echo json_encode(
        array(
            "id" => $user_id
        )
    );
?>