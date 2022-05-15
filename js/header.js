$(document).ready(documentReady);

function documentReady () {
    $(document).on('click', '#nav-char', navCharClick);
    window.onresize = onResize;
}

function navCharClick () {
    // $('#nav-list').fadeToggle('slow');
    $('#nav-list').slideToggle('fast');
}

/*
    On resize the window, manage the nav list to display it
*/
function onResize() {
    if (window.innerWidth >= 1100) $('#nav-list').css('display', 'flex');
    else $('#nav-list').css('display', 'none');
}