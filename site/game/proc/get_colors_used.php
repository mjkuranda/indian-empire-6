<?php
    include_once('../../../engine/db_manager.php');
    $con = db_connect();

    $colors = [];

    $result = mysqli_query($con, "SELECT `id_color` FROM `players`");
    while ($row = mysqli_fetch_array($result)) {
        array_push($colors, $row);
    }

    echo json_encode($colors);
?>