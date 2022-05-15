<?php
    include_once('../../../engine/db_manager.php');
    $con = db_connect();

    $province;

    # Get province
    $query = "
        SELECT
            `ip`.`id_province`   AS `id_province`,
            `ip`.`id_player`     AS `id_player`,
            `p`.`id_color`       AS `id_color`,
            `ip`.`buildings`     AS `buildings`,
            `ip`.`goods`         AS `goods`,
            `ip`.`name_province` AS `name_province`
        FROM
            `indian_provinces` AS `ip`
        INNER JOIN
            `players` AS `p`
            ON `ip`.`id_player` = `p`.`id_user`
        WHERE
            `ip`.`id_province` = '".$_POST['id_province']."'
    ";
    $result = mysqli_query($con, $query);
    $province = mysqli_fetch_array($result);

    # Get people
    if (count($province)) {
        $people = [];
        $query = "
            SELECT
                *
            FROM
                `indians`
            WHERE
                `id_province` = '".$_POST['id_province']."'
        ";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            array_push($people, $row);
        }
        $province['people'] = $people;
    }
    
    echo json_encode($province);
?>