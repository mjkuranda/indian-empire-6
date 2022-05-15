/*
    This module generates new village data.
*/

var moduleVillage = {

    /*
        Main function: init
        - tribeId: there is a identity of tribe from tribes.json and from db.
        The same number.

        It generates:
        - people (4 indians)
        - buildings (2 buildings)
        - resources (meat, hides and bones)
    */
    init: function (tribeId) {
        let people      = [];
        let buildings   = [];
        let resources   = [];

        // Get the names of indian
        people = this.getPeople(tribeId);

        // Get the buildings
        buildings = this.getBuildings(tribeId);

        // Get the resources
        resources = [
            [1, 100],
            [2, 250]
        ];

        let result = {
            "people": people,
            "buildings": buildings,
            "resources": resources
        };
        return result;
    },

    /* Private and inner method - not available for other ... */
    getPeople (tribeId) {
        let people = [];

        let indians = 
        JSON.parse(
            $.ajax({
                url: 'site/game/proc/get_indian_names.php',
                async: false,
                dataType: 'JSON',
                data: { "id_tribe": tribeId },
                method: 'POST',
                success: function () {}
            })
            .responseText
        );

        let males   = indians.filter(function (e) { return (e.gender == 1); });
        let females = indians.filter(function (e) { return (e.gender == 0); });

        for (i = 0; i < 2; i++) {
            let id = Math.floor(Math.random() * males.length);
            people.push({
                "id_name": males[id].id_name,
                "id_tribe": males[id].id_tribe,
                "indian_name": males[id].name_indian,
                "gender": males[id].gender
            });
        }
        for (i = 0; i < 2; i++) {
            let id = Math.floor(Math.random() * females.length);
            people.push({
                "id_name": females[id].id_name,
                "id_tribe": females[id].id_tribe,
                "indian_name": females[id].name_indian,
                "gender": females[id].gender
            });
        }

        return people;
    },

    /* Private and inner method - not available for other ... */
    getBuildings (tribeId) {
        let buildings = [];

        let bs = // buildings of the tribe
        JSON.parse(
            $.ajax({
                url: 'site/game/proc/get_indian_buildings.php',
                async: false,
                dataType: 'JSON',
                data: { "id_tribe": tribeId },
                method: 'POST',
                success: function () {}
            })
            .responseText
        );

        for (i = 0; i < 2; i++) {
            buildings.push(bs[0]);
        }
        buildings.push(bs[1]);

        return buildings;
    }
};