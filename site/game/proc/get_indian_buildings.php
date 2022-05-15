<?php
    include_once('../../../engine/db_manager.php');
    $con = db_connect();

    $buildings = [];

    $result = mysqli_query($con, "SELECT * FROM `indian_buildings` WHERE `id_tribe` = ".$_POST['id_tribe']);
    while ($row = mysqli_fetch_array($result)) {
        array_push($buildings, $row);
    }

    echo json_encode($buildings);
?>