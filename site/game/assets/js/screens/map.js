/* Loading... */
console.log('File "map.js" is loading...');

// Some variables
var mapData = {
    tribes:  [],
    players: null,
    province: null
};

$(document).ready(mapReady);

function mapReady () {

    // Load data
    mapData.tribes = 
    $.ajax({
        url: 'site/game/proc/map/get_tribes.php',
        dataType: 'JSON',
        async: false
    }).responseJSON;

    mapData.players = 
    $.ajax({
        url: 'site/game/proc/map/get_players.php',
        dataType: 'JSON',
        async: false
    }).responseJSON;

    // Adding colours style
    let cols = colorManager.getColorsList();
    let style = colorManager.getStyle(cols);
    $('head').append(style);

    // Adding provinces
    let provs =
    $.ajax({
        url: 'site/game/proc/get_provinces_inhabited.php',
        dataType: 'JSON',
        async: false
    }).responseJSON;

    provs.forEach(p => {
        $('#prov' + p.id_province).addClass('col' + p.id_color); // addition color id to province
        $('#prov' + p.id_province).attr('player', p.id_player); // addition id_player to province
    });
}

function loadMapEvents () {
    $(document).on('click', '#map-views > div.flexBox > div', function () {
        $('#map-views > div.flexBox > div').removeClass('selected');
        $(this).addClass('selected');

        let n = $(this).attr('title').split(' ')[0].toLowerCase();
        loadMapConfig(n);
    });
    // Map config
    $('#map-views > div.flexBox > div:nth(1)').addClass('selected');
    loadMapConfig('tribal');



    // Province managing
    $(document).on('click', '#map-sea path', clickProvince);
    $(document).on('click', 'button[name=visit__village]', clickVisit);
}

/*
    type - defines type of CSS file
    it can be: terrain, language or tribal mode (view)
*/
function loadMapConfig (type) {
    let script = 'site/game/modules/map/' + type + '.css';
    $.ajax({
        url: script,
        async: false,
        success: function (data) {
            $('head style#map-style').remove(); // Removing previous map config
            $('head').append('<style id="map-style" class="map-' + type + '">' + data + '</style>');
        }
    });
}



/*
    Click province

    Whose province?  classes = [ group, terrain, color[,optional] ]   classes[2] -> defines, whose province is.
    - "unhabitated" - e. g. Greenland Icecap - there is province, where it isn't possible to settle there due to climate and province specifications.
    - undefined (empty)
*/
function clickProvince () {
    let owner   = 0; // no-one
    let yours   = false;
    let prov_id = parseInt(($(this).attr('id')).substr(4));

    // Try to get province
    let prov =
    $.ajax({
        url: 'site/game/proc/get_province.php',
        data: { id_province: prov_id },
        dataType: 'JSON',
        method: 'POST',
        async: false
    }).responseJSON;

    // Does it is someone?
    if ($(this).attr('player')) {
        owner = parseInt($(this).attr('player')); // returns id of user, whose it is
    }
    // No-one or unavailable
    else {
        if (this.classList[2] == 'uninhabited') owner = -1;
    }

    // Does is your province?
    if (parseInt($.cookie('user-id')) == owner) yours = true;
    // console.log(prov, this.classList[2], yours, owner);

    // Print appropriate text
    mapData.province = null;
    $('#prov-desc h3').text($(this).attr('title')); // change province name
    $('#prov-desc').removeClass('hidden');
    $('.prov__desc > div').addClass('hidden');
    switch (owner) {
        case -1:
            $('.prov__desc div.prov__desc__unavailable').removeClass('hidden');
            $('#prov-desc h5').text('Province unavailable to settle');
        break;

        case 0:
            $('.prov__desc div.prov__desc__uninhabited').removeClass('hidden');
            $('#prov-desc h5').text('Province uninhabited');
        break;

        // This province is someone...
        default:
            $('.prov__desc div.prov__desc__inhabited').removeClass('hidden');
            $('#prov-desc h5').text('Province inhabited by player ' + mapData.players[owner].username);

            mapData.province = prov;

            $('.prov__desc div.prov__desc__inhabited span.prov__desc__tribe').html(mapData.tribes[ mapData.players[owner].id_tribe-1 ]);
            $('.prov__desc div.prov__desc__inhabited span.prov__desc__people').html(prov.people.length);
            $('.prov__desc div.prov__desc__inhabited span.prov__desc__chief').html(mapData.players[owner].username);
        break;
    }
}

function clickVisit () {
    // Check, if you have some villages
    let villages =
    $.ajax({
        url: 'site/game/proc/has_villages.php',
        dataType: 'JSON',
        data: { "id_user": $.cookie('user-id') },
        method: 'POST',
        async: false
    }).responseJSON;

    // Teleporting to your village =>
    // loadScreen('village', { 0: mapData.province, "id_tribe": 1 });
    loadScreen('village', villages);
}