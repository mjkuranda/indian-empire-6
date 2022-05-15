/*
    The manager of colours
*/
var colorManager = {
    /*
        Returns the complete list of 64 colours.
    */
    getColorsList: function () {
        let cols = [];

        for (i = 0; i < 64; i++) {

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

            // Adding
            cols.push(c);
        }

        return cols;
    },

    /*
        Returns the style tag of colours.
    */
    getStyle: function (cols) {
        let style = '<style screen>';
        cols.forEach(function (el, id) {
            style += '#map .col' + id + '{ fill: #' + el + ' } ';
        });
        style += '</style>';

        return style;
    }
};