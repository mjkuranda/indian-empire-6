/* Selected province */
var province_id = -1;
var province_name = '';
var tribe_id = -1;
var color_id = -1;

/* Init function */
function initMapSettle () {
    // Load colours
    loadColours();

    // Add settled provinces
    manageProvinces();
    handleProvinces();
}
/* Load select colours */
function loadColours () {

    // Load used colors
    let cols =
    $.ajax({
        url: 'site/game/proc/get_colors_used.php',
        method: 'POST',
        async: false,
        dataType: 'JSON'
    }).responseJSON;

    for (i = 0; i < 64; i++) {
        // Check if it's used
        let used = false;
        for (col of cols) {
            if (col.id_color == i) used = true;
        }

        if (!used) {
            // To binary number
            let bin = i.toString(2);

            // // Add the others 0-s
            let x = 6 - bin.toString().length;
            for (z = 0; z < x; z++) {
                bin = "0" + bin;
            }

            // Converting into hex
            let hex = [];
            let c = '';
            for (h = 0; h < 3; h++) {
                hex[h] = bin.substr(h*2, 2) + '11';
                hex[h] = parseInt(hex[h], 2).toString(16);
                c += hex[h];
            }

            // Adding option
            $('select[name=select-color]').append('<option style="background-color: #' + c + ';" value="' + c + '" num="' + i + '"></option>');
        }
    }
}
/* Add settled provinces */
function manageProvinces () {

    let tribes =
    $.ajax({
        url: 'site/game/assets/data/tribes.json',
        async: false,
        dataType: 'JSON'
    }).responseJSON;

    let provinces =
    $.ajax({
        url: 'site/game/proc/get_provinces_inhabited.php',
        method: 'POST',
        async: false,
        dataType: 'JSON'
    }).responseJSON;

    // For each settled province
    provinces.forEach(function (p) {
        $('#map-sea svg path#prov' + p.id_province).addClass('inhabited');
    });

    // For each province
    $('#map-sea svg path').each(function (id, p) {
        /* 
            If any tribe isn't assigned to the language group,
            then add some class that doesn't allow to settle there...
        */
        if (p.classList[0] != 'gNone' && tribes[p.classList[0]].length == 0) {
            $(p).addClass('inhabited');
        }
    });
}
function handleProvinces () {
    /* Handling province */
    $('#map svg path:not(.uninhabited):not(.inhabited)').on('click', function (e) {
        /* Load provinces component */
        gameComponents.load('provinces');

        // Selecting province
        $('.province__name').html('Selected: ' + $(this).attr('title'));
        $('#map svg path').css('fill', '');
        $(this).css('fill', 'white');

        // Loading available tribes in the province
        let tribes = JSON.parse($.ajax({
            url: 'site/game/assets/data/tribes.json',
            async: false,
            dataType: 'JSON'
        }).responseText);
        let languageGroup = $(this).prop('classList')[0];
        $('select[name=select-tribe] option:not(:first-child)').remove();
        tribes[languageGroup].forEach(el => {
            $('select[name=select-tribe]').append('<option value="' + el.id + '">' + el.name + '</option>');
        });
        $('select[name=select-tribe] option:first-child').prop('selected', true);

        // Save id province
        let prov = $(this).attr('id');
        province_id     = prov.substr(4); // only province number
        province_name   = $(this).attr('title');
    });
}
function loadMapSettleEvents () {
    $(document).on('click', '#map-views > div.flexBox > div', function () {
        $('#map-views > div.flexBox > div').removeClass('selected');
        $(this).addClass('selected');

        let n = $(this).attr('title').split(' ')[0].toLowerCase();
        loadMapConfig(n);
    });
    // Map config
    $('#map-views > div.flexBox > div:nth(2)').addClass('selected');
    loadMapConfig('uninhabited');

    // Select colour
    $('select[name=select-color]').change(function () {
        let o = $('select[name=select-color] option:selected');
        color_id = o.attr('num');
        $('select[name=select-color]').css('background-color', '#' + o.attr('value'));
    });
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
    When you select your province and tribe,
    you clicked "Play game" and there...
*/
function startGame () {
    console.log('Saving your selected tribe and land...');
    
    // Progress bar
    updateProgress(0);
    changeProgressText('Sending your people to build wigwams...');
    $('#initFrame').removeClass('hidden').removeClass('loaded');

    // Remove main content
    $('main').remove();
    $('<main></main>').insertAfter('header')

    $.when(
        $('head').append('<script value="settle" src="site/game/modules/settle.js"></script>')
    )
    .then(function () {
        let result = moduleVillage.init(tribe_id);
        
        $('script[value=settle]').remove();

        let settle =
        $.ajax({
            url: 'site/game/proc/settle_new_land.php',
            dataType: 'JSON',
            data: {res: result, id_tribe: tribe_id, id_color: color_id, prov_id: province_id, prov_nm: province_name, user: $.cookie('user')},
            method: 'POST',
            async: false,
            success: function (data) { console.log(data); }
        });
        console.log('Settle:', settle, settle.responseJSON);

        $('head style#map-style').remove(); // Removing map config
        let params = {
            "0": {
                "id_province": province_id,
                "name_province": province_name,
                "people": result.people,
                "buildings": result.buildings,
                "goods": result.resources
            },
            "id_tribe": tribe_id,
            "id_color": color_id
        };
        console.log("Given params:", params);
        loadScreen('village', params);
    });
}

/* Add event to play this tribe here button */
$('button[name="play"]').on('click', function (e) {
    if ($('select[name=select-tribe]').val() != null && province_id != -1 && color_id != -1) {
        tribe_id = $('select[name=select-tribe]').val();
        startGame();
    }
});

// Map loading
console.log('File "mapSettle.js" is loading...');