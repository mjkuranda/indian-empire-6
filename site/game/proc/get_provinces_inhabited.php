<?php
    include_once('../../../engine/db_manager.php');
    $con = db_connect();

    $provinces = [];

    $query = "
        SELECT
            `ip`.`id_province`,
            `ip`.`id_player`,
            `p`.`id_color`,
            `ip`.`buildings`,
            `ip`.`goods`,
            `ip`.`name_province`
        FROM
            `indian_provinces` AS `ip`
        INNER JOIN
            `players` AS `p`
            ON `ip`.`id_player` = `p`.`id_user`
    ";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        array_push($provinces, $row);
    }

    echo json_encode($provinces);
?>