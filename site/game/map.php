<section id="map" class="">
    <section id="map-views">
        <div class="flexBox">
            <div title="Terrain View"><img src="site/game/assets/img/map/views/terrain.svg" alt="Terrain View" /></div>
            <div title="Tribal View"><img src="site/game/assets/img/map/views/tribal.svg" alt="Tribal View" /></div>
        </div>
    </section>
    <div id="map-sea">
        <?php
            include_once('assets/img/map/map-america.svg');
        ?>
    </div>

    <!-- Province description -->
    <section id="prov-desc" class="hidden">
        <div class="prov__desc">
            <h3>Province name</h3>
            <h5 class="flexBox">What's province? Empty or ...</h5>
            <div class="prov__desc__unavailable flexBox hidden">
                <div>
                    <p>This province is so cold and unavailable that no-one would dare to settle here.</p>
                    <p>Your indians don't want to think of that as a place to live.</p>
                    <p>It would be better for you to leave this province and look for another one...</p>
                </div>
            </div>
            <div class="prov__desc__uninhabited flexBox hidden">
                <div>
                    <p>This province seems to be pleasure place to live.</p>
                    <p>You can set your tents here if you want!</p>
                    <p>Warning! The current version of the game doesn't provide for a settlement systemon new lands... </p>
                </div>
            </div>
            <div class="prov__desc__inhabited flexBox hidden">
                <div>
                    <p>This land is lived by indians of the <span class="prov__desc__tribe"></span> tribe.</p>
                    <p>Locally lives here <span class="prov__desc__people"></span> indians.</p>
                    <p>These people belongs to chief <span class="prov__desc__chief"></span>.</p>
                </div>
            </div>
            <section class="flexBox"><button class="button" name="visit__village">Visit your village!</button></section>
        </div>
    </section>
</section>