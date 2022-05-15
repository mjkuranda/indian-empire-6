<?php
    include_once('../../../../engine/db_manager.php');
    $con = db_connect();

    # Find all players
    $tribes = [];
    $q = "
        SELECT 
            `t`.`name_tribe`
        FROM
            `indian_tribes` AS `t`
    ";
    $result = mysqli_query($con, $q);
    while($row = mysqli_fetch_array($result)) {
        array_push($tribes, $row['name_tribe']);
    }

    echo json_encode(
        $tribes
    );
?>