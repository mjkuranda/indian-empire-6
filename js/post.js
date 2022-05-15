$(document).ready(function () {
    // Dodaj zdarzenie dla kazdego posta
    $(document).on('click', '.button[value]', function () {
        window.location.href = "post?id=" + $(this).attr('value');
    });
});