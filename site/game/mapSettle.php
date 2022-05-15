<section id="map" class="">
    <section id="map-views">
        <div class="flexBox">
            <div title="Terrain View"><img src="site/game/assets/img/map/views/terrain.svg" alt="Terrain View" /></div>
            <div title="Language View"><img src="site/game/assets/img/map/views/language.svg" alt="Language View" /></div>
            <div title="Uninhabited lands View"><img src="site/game/assets/img/map/views/uninhabited.svg" alt="Uninhabited lands View" /></div>
        </div>
    </section>
    <div id="map-sea">
        <?php
            include_once('assets/img/map/map-america.svg');
        ?>
    </div>
    <section id="map-select-info">
        <h1 class="flexBox province__name">Selected: none</h1>
        <div class="flexBox">
            <div>
                <div class="textCenter">Select tribe:</div>
                <select name="select-tribe">
                    <option disabled selected value>--- Select a tribe ---</option>
                </select>
            </div>
            <div>
                <div class="textCenter">Select colour:</div>
                <select name="select-color">
                    <option disabled selected value>--- Select a colour ---</option>
                </select>
            </div>
        </div>
        <div class="flexBox"><button name="play" class="button">Play this tribe here!</button></div>
    </section>
</section>