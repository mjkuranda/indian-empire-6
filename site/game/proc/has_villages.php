<?php
    include_once('../../../engine/db_manager.php');
    $con = db_connect();

    # Try to find any village
    $result = mysqli_query($con, "SELECT * FROM `indian_provinces` WHERE `id_player` = '".$_POST['id_user']."'");
    $provinces = [];
    while ($row = mysqli_fetch_array($result)) {
        array_push($provinces, $row);
    }

    # If you find province, find their dwellers/inhabitants
    if (count($provinces) > 0) {
        # "Collect" people
        $result = mysqli_query($con, "SELECT `i`.`id_indian`, `i`.`id_tribe`, `i`.`id_name`, `i_n`.`name_indian` AS `indian_name` FROM `indians` AS `i` INNER JOIN `indian_names` AS `i_n` ON `i`.`id_name` = `i_n`.`id_name` WHERE `i`.`id_province` = '".$provinces[0]['id_province']."'");
        $people = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($people, $row);
        }
    
        # Add people to the province
        $provinces[0]['people'] = $people;
    
        # Add id tribe
        $result = mysqli_query($con, "SELECT `id_tribe` FROM `players` WHERE `id_user` = '".$_POST['id_user']."'");
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_array($result);
            $provinces['id_tribe'] = $row['id_tribe'];
        }
    }

    echo json_encode(
        $provinces
    );
?>