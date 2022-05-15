<?php
    // Jesli brak id w adresie URL
    if (!isset($_GET['id'])) header('location: main');

    $sql = "
        SELECT
                `title`,
                `content`,
                `date`,
                DATEDIFF(NOW(), `date`) AS `date_diff`
        FROM    `posts`
        WHERE   `id` = '".$_GET['id']."'
    ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    // Jesli id posta nie istnieje
    if (!mysqli_num_rows($result)) header('location: main');
?>

<main class="center">
    <section class="margin__horizontal__auto">
        <div class="flexBox"><h2><?php echo $row['title']; ?></h2></div>
        <div class="flexLeft"><p><?php echo $row['content']; ?></p></div>
        <div class="flexRight"><strong>Posted:</strong>&nbsp;
            <span class="post-diff">
                <?php
                    echo '(';
                    if ($row['date_diff'] < 1) echo 'Less than 1 moon ago';
                    elseif ($row['date_diff'] == 1) echo '1 moon ago';
                    elseif ($row['date_diff'] < 30) echo $row['date_diff'].' moons ago';
                    else echo 'Many moons ago';
                    echo ')';
                ?>
            </span>&nbsp;
            <?php echo $row['date']; ?>
        </div>

        <div class="post-nav"><a href="main"><button class="button">Back to main page</button></a></div>
    </section>
</main>