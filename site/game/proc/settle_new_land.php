<?php
    include_once('../../../engine/db_manager.php');
    $con = db_connect();

    # Find id of user
    $result = mysqli_query($con, "SELECT id FROM `users` WHERE `username` = '".$_POST['user']."'");
    $row = mysqli_fetch_array($result);
    $user_id = $row['id'];

    # Generate people in the village
    $people = [];
    $date = date("Y-m-d H:i:s");
    foreach ($_POST['res']['people'] as $p) {
        $pq = "INSERT INTO `indians` (`id_indian`, `id_tribe`, `time_birth`, `id_province`, `id_partner`, `id_name`, `gender`) VALUES (NULL, '".$p['id_tribe']."', '".$date."', '".$_POST['prov_id']."', NULL, '".$p['id_name']."', '".$p['gender']."')";
        array_push($people, $pq);
    }
    # Add new people
    foreach ($people as $p) {
        mysqli_query($con, $p);
    }

    # Generate list of buildings
    $buildings = [];
    foreach ($_POST['res']['buildings'] as $b) {
        array_push($buildings, [$b['id_building'], $b['id_tribe']]);
    }

    # Generate list of goods
    $goods = [];
    foreach ($_POST['res']['resources'] as $g) {
        array_push($goods, $g);
    }

    # Adding new province
    $b_str = json_encode($buildings); // buildings string
    $g_str = json_encode($goods); // goods string
    $prov = "INSERT INTO `indian_provinces` (`id_province`, `id_player`, `name_province`, `goods`, `buildings`) VALUES ('".$_POST['prov_id']."', '".$user_id."', '".$_POST['prov_nm']."', '".$g_str."', '".$b_str."')";
    mysqli_query($con, $prov);

    # Adding new player
    mysqli_query($con, "INSERT INTO `players` (`id_user`, `id_tribe`, `id_color`) VALUES ('".$user_id."', '".$_POST['id_tribe']."', '".$_POST['id_color']."')");

    echo json_encode(
        array(
            mysqli_error($con),
            $_POST['res']['people'],
            $people
        )
    );
?>