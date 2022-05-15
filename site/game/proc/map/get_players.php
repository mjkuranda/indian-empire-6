<?php
    include_once('../../../../engine/db_manager.php');
    $con = db_connect();

    # Find all players
    $players = [];
    $q = "
        SELECT 
            `p`.`id_user`,
            `u`.`username`,
            `p`.`id_tribe`
        FROM
            `players` AS `p`
        INNER JOIN `users` AS `u`
            ON `p`.`id_user` = `u`.`id`
    ";
    $result = mysqli_query($con, $q);
    while($row = mysqli_fetch_array($result)) {
        $players[$row['id_user']] = array("username" => $row['username'], "id_tribe" => $row['id_tribe']);
    }

    echo json_encode(
        $players
    );
?>