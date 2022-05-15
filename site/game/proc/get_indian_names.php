<?php
    include_once('../../../engine/db_manager.php');
    $con = db_connect();

    $indians = [];

    $result = mysqli_query($con, "SELECT * FROM `indian_names` WHERE `id_tribe` = ".$_POST['id_tribe']);
    while ($row = mysqli_fetch_array($result)) {
        array_push($indians, $row);
    }

    echo json_encode($indians);
?>