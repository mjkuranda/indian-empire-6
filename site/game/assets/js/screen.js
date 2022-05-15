// Information
console.log('File "screen.js" has started loading...');

// Basic variables
var screens = {
    mapSettle: {
        file: "site/game/mapSettle.php",
        links: [
            "site/game/assets/css/map-config.css"
        ],
        scripts: [
            "site/game/assets/js/screens/mapSettle.js"
        ],
        loadedEvents: false
    },
    village: {
        file: "site/game/village.php",
        links: [
            "site/game/assets/css/village.css"
        ],
        scripts: [
            "site/game/assets/js/screens/village.js"
        ],
        loadedEvents: false
    },
    map: {
        file: "site/game/map.php",
        links: [
            "site/game/assets/css/map-config.css",
            "site/game/assets/css/map.css"
        ],
        scripts: [
            "site/game/modules/color.js",
            "site/game/assets/js/screens/map.js"
        ],
        loadedEvents: false
    }
};
var currentScreen = null;

// Basic functions:
/*
    "params" argument is charged of providing extra parameters.
    For "village" screen there is list of villages.
*/
function loadScreen (screen, params) {
    // Save current screen
    currentScreen = screen;

    // initFrame progress
    let progress = 0, total = 0;

    // Switch on the initFrame
    $('#initFrame').removeClass('hidden').removeClass('loaded');
    changeProgressText('Teleporting to another world...');

    // Calculate how many things you need to remove and add
    total = calculateProgress(screen);
    $('#initFrame').attr('max', total);
    $('#initFrame').attr('value', 0);

    // Remove old things (with "screen" attribute as well)
    changeProgressText('Sweeping dust under the rug...');
    progress += $('body > main, body > section').length;
    progress += $('head script[screen], head link[screen]').length;
    progress++; // Addition <main> tag
    $.when(
        $('body > main, body > section').remove(),
        $('head script[screen], head link[screen]').remove(),
        $('<main></main>').insertAfter('header')
    )
    .then(function () {
        console.log('OKAY, the dust is already under the carpet...');
        addToProgress(progress);

        /* Add file */
        $.when(
            loadGameBar(screen),
            $.ajax({
                url: screens[screen].file,
                async: false,
                method: 'POST',
                data: { "params": params },
                success: function (data) { $('main').append(data); }
            })
        ).then(function () {
            changeProgressText('OK, basis just are...');
            addToProgress(2);

            /* Add scripts */
            $.when(
                loadScripts(screen)
            )
            .then(function () {
                changeProgressText('Some scripts too...');
                addToProgress(screens[screen].links.length + screens[screen].scripts.length);

                /* Add events */
                if (!screens[currentScreen].loadedEvents) {
                    $.when(
                        loadEvents(screen)
                    )
                    .then(finalize());
                } else finalize();
            });
        });
    });
}



// Events functions
function loadEvents (screen) {
    switch (screen) {
        case 'mapSettle':
            $.when(
                initMapSettle()
            )
            .then(function () {
                if (!screens['mapSettle'].loadedEvents) {
                    loadMapSettleEvents();
                    screens['mapSettle'].loadedEvents = true;
                }
            });
        break;

        case 'map':
            if (!screens['map'].loadedEvents) {
                loadMapEvents();
                screens['map'].loadedEvents = true;
            }
        break;
    }
}



/* --- Private functions --- */

// Calculate progress
function finalize () {
    changeProgressText('I guess, all...');
    addToProgress(3);

    // Save changes
    screens[currentScreen].loadedEvents = true;

    /* Switch off the initFrame */
    $('#initFrame').addClass('loaded');
    setTimeout(function () {
        $('#initFrame').addClass('hidden');
    }, 1000);
}

function calculateProgress (screen) {
    let total = 0;

    // Old things
    total += $('body > main, body > section').length;
    total += $('head script[screen], head link[screen]').length;
    // Inserting <main>
    total++;
    // Addition screen file
    total += 2; // e. g. "map.php" and "game-bar"
    // Addition css and scripts files
    total += screens[screen].links.length + screens[screen].scripts.length;
    // Addition events
    total += 3;
    // Switching off the initFrame =)
    total++;

    return total;
}

// Load links and scripts
function loadScripts (screen) {
    screens[screen].links.forEach(el => {
        $('head').append('<link rel="stylesheet" href="' + el + '" screen />');
    });
    screens[screen].scripts.forEach(el => {
        $('head').append('<script src="' + el + '" screen></script>')
    });
}

// Load game-bar
function loadGameBar (screen) {
    // Loading game bar
    $.ajax({
        url: 'site/game/game_bar.php',
        data: { "screen": screen },
        method: 'POST',
        async: false,
        success: function (data) { $('main').append(data); }
    });
}