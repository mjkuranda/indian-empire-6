<div id="initFrame" class="flexBox hidden">
    <section>
        <div class="flexBox"><div id="logo" class="flexBox"><img src="favicon.ico" alt="Indian Empire logo" /></div></div>
        <div class="flexBox"><h1 id="title">Indian Empire</h1></div>

        <progress id="loader" max="100" value="0"></progress>
        <div class="flexBox"><div id="info-loader">Loading...</div></div>
    </section>
</div>

<main class="center">
    <div>
        <?php
            $result = mysqli_query($con, "SELECT * FROM `indian_provinces` WHERE `id_player` = '".$_COOKIE['user-id']."'");
            if ($result->num_rows > 0) {
                ?>
                    <p>Your tribe is waiting for your orders!</p>
                    <p>Don't lose your time, chief...</p>
                    <br>
                    <p>Warning! There is quite simply and early version of the game,</p>
                    <p>so dont't expect expanded version of the game! ;D</p>
                    <br>
                    <div class="flexBox"><button id="__game_start" class="button">Continue game!</button></div>
                <?php
            }
            // Otherwise, if you don't have any province...
            else {
                ?>
                    <p>Are you ready for adventure?</p>
                    <p>In this game you become a indian chief of some tribe...</p>
                    <p>The small group of submissive people will be leaded by you!</p>
                    <br>
                    <p>Warning! There is quite simply and early version of the game,</p>
                    <p>so dont't expect expanded version of the game! ;D</p>
                    <br>
                    <div class="flexBox"><button id="__game_start" class="button">Let's start!</button></div>
                <?php
            }
        ?>
    </div>
</main>

<script src="site/game/assets/js/game.js"></script>