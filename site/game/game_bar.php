<section id="game-bar" class="flexAround">
    <div id="game-bar-location" class="flexBox">
        <?php
            $icon = null;
            $loc  = null;

            switch ($_POST['screen']) {
                case 'map':
                case 'mapSettle':
                    $icon   = 'language';
                    $loc    = 'World';
                break;

                case 'village':
                    $icon   = 'tribal';
                    $loc    = 'Village';
                break;
            }
        ?>
        <div id="game-bar-location-sec" class="flexBox">
            <img src="site/game/assets/img/map/views/<?php echo $icon; ?>.svg" alt="Game-bar location" />
            <p><?php echo $loc; ?></p>
        </div>

        <?php
            if ($_POST['screen'] == 'village') {
                ?>
                    <div id="game-bar-location-back-sec" class="flexBox">
                        <img src="site/game/assets/img/up-arrow.svg" alt="Back to the world" />
                        <p>Back to the map</p>
                    </div>
                <?php
            }
        ?>
    </div>
    <div id="game-bar-controls" class="flexBox">
        <a href="main" id="game-bar-exit" title="Quit game... :("><img src="site/game/assets/img/exit.svg" alt="Quit game" /></a>
    </div>
</section>