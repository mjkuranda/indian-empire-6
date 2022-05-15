/*
    System called `Szarik`.

    To memorise my beloved dog, which was with me during my growing up
    since my childhoods. He passed out on 12th, May 2021.
    This system was created two days ago after his death.

    The latest modification: 2021-05-18
*/

// Variables
const VERSION = {
    number: 'Beta v. 0.1.5',
    date:   'on 2021-05-24'
};
var player  = {
    id_user: -1,
    id_tribe: -1
};
/* Loaded components */
var gameComponents = {
    
    // Attributes
    provinces: false,

    // Functions
    load: function (comp) {
        this[comp] = true;
    }
}

$(document).ready(gameReady);

// When game subsite ready
function gameReady () {
    console.log('File "game.js" has started!');

    $(document).on('click', '#__game_start', gameStart);
    $(document).on('click', '#game-bar-location-back-sec', backScreen);
}

// When it was clicked on the start
function gameStart () {
    console.log('Starting game...');
    $.when(
        $('head').append('<script src="site/game/assets/js/screen.js"></script>'),
        $('head').append('<link rel="stylesheet" href="site/game/assets/css/game.css" />'),
        $('head').append('<script src="js/jquery.cookie.js"></script>')
    )
    .then(function () {
        // Communicate
        console.log('File "screen.js" loaded!');

        // Loading version
        $('#app > div > div:not(:first-child)').remove();
        $('#app > div').append('<div><h4>' + VERSION.number + '</h4></div>');
        $('#app > div').append('<div><h6>' + VERSION.date + '</h6></div>');

        // Preparing...
        handleSubsite();

        // Loading game bar
        // $.ajax({
        //     url: 'site/game/game_bar.php',
        //     data: {  },
        //     method: 'POST',
        //     async: false,
        //     success: function (data) { $('main').append(data); }
        // });
    });
}

/*
    It can handle all subsites (hidden subsite in the game subsite, of course).
    It checks if you have your tribe or not.
    If you don't have, there is loading map with potentiality of choice.
*/
function handleSubsite () {
    // Get the id of user
    let user_id =
    $.ajax({
        url: 'site/game/proc/get_user_id.php',
        dataType: 'JSON',
        data: { "user": $.cookie('user') },
        method: 'POST',
        async: false
    }).responseJSON.id;
    player.id_user = user_id;

    // Check, if you have some villages
    let villages =
    $.ajax({
        url: 'site/game/proc/has_villages.php',
        dataType: 'JSON',
        data: { "id_user": user_id },
        method: 'POST',
        async: false
    }).responseJSON;
    console.log('Villages:', villages);

    // loadScreen('map');
    if (villages.length === 0) loadScreen('mapSettle');
    else {
        // Assign id tribe
        player.id_tribe = villages.id_tribe
        
        // Load the village
        loadScreen('village', villages);
    }
}

/* Back to the world */
function backScreen () {
    loadScreen('map');
}



// Progress function
function updateProgress (progress) {
    $('#loader').attr('value', progress);
}

function addToProgress (progress) {
    let val = $('#loader').attr('value');
    $('#loader').attr('value', val + progress);
}

function changeProgressText (text) {
    $('#info-loader').html(text);
}