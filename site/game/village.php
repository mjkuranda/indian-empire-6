<?php
    include_once('../../engine/db_manager.php');
    $con = db_connect();
?>
<section id="village" class="">
    <!-- Village title/header section -->
    <div id="village__title" class="textCenter"><h2><?php echo $_POST['params'][0]['name_province']; ?></h2></div>

    <!-- Village goods -->
    <section id="village__goods">
        <h4 id="village__goods__title" class="__title">Village goods</h4>
        <div class="flexBox">
            <table>
                <tr class="village__section__header">
                    <th>Name</th>
                    <th>Amount</th>
                </tr>
                <?php
                    # Set "goods"
                    $goods = [];
                    if (gettype($_POST['params'][0]['goods']) == 'array') $goods = $_POST['params'][0]['goods'];
                    else $goods = json_decode($_POST['params'][0]['goods'], true);

                    # Set "resources' list"
                    $resources = [];
                    $result = mysqli_query($con, "SELECT `name_resource` FROM `indian_resources`");
                    while ($row = mysqli_fetch_array($result)) {
                        array_push($resources, $row);
                    }

                    # Print all
                    foreach ($goods as $g) {
                        ?>
                        <tr class="village__section__row">
                            <td><?php echo $resources[$g[0] - 1]['name_resource']; ?></td>
                            <td><?php echo $g[1]; ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </section>

    <!-- Village population section -->
    <section id="village__population">
        <h4 id="village__population__title" class="__title">Village population</h4>
        <div class="flexBox">
            <table>
                <tr class="village__section__header">
                    <th>Name</th>
                </tr>
                <?php
                    # Set "people"
                    $people = [];
                    if (gettype($_POST['params'][0]['people']) == 'array') $people = $_POST['params'][0]['people'];
                    else $people = json_decode($_POST['params'][0]['people'], true);

                    # Print all
                    foreach ($people as $p) {
                        ?>
                        <tr class="village__section__row">
                            <td><?php echo $p['indian_name'] ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </section>

    <!-- Village building section -->
    <section id="village__building">
    <h4 id="village__building__title" class="__title">Village buildings</h4>
        <div class="flexBox">
            <table>
                <tr class="village__section__header">
                    <th>Name</th>
                </tr>
                <?php
                    # Set "buildings"
                    $buildings = [];
                    if (gettype($_POST['params'][0]['buildings']) == 'array') $buildings = $_POST['params'][0]['buildings'];
                    else $buildings = json_decode($_POST['params'][0]['buildings'], true);

                    # Set "buildings' list"
                    $buildings_names = [];
                    $result = mysqli_query($con, "SELECT `name_building` FROM `indian_buildings` WHERE `id_tribe` = '".$_POST['params']['id_tribe']."'");
                    while ($row = mysqli_fetch_array($result)) {
                        array_push($buildings_names, $row);
                    }

                    # Print all
                    foreach ($buildings as $b) {
                        ?>
                        <tr class="village__section__row">
                            <td><?php echo $buildings_names[$b[0] - 1]['name_building']; ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </section>
</section>