/*
let ta_endpoint = 'https://randomuser.me/api/';
// Adresse der externen Datenabfrage – API (application programming interface)

$('.btn-person').click(function () {
    // Bei klick auf den Button wird die Abfrage ausgeführt

    $.ajax({

        url: ta_endpoint, // Adresse des API
        dataType: 'json', // Datentyp
        type: 'GET', // Daten grapschen

        success: function (results) {
            console.log(results);
            // Bei Erfolg Daten in der Konsole anzeigen (da kann man sich schön alle verfügbaren Daten (results in Arrays []) ansehen)
        }

    })

        .done(get_Data);
    // Google sei Dank ;)

});


let ta_foto = $('.person-foto');
let ta_name = $('.individual-name');

function get_Data(data) {

    let ta_person = data.results[0];

    ta_foto.attr('src', ta_person.picture.large),
        // Die selektierten (gewünschten) Daten aus dem gelieferten Array [] (aus results) im HTML ausgeben (in diesem Fall Bild Version-"large")
        ta_name.text(ta_person.name.first + ' ' + ta_person.name.last); // -""- (Vor- und Nachname)
};

*/

////////////////////////////

let endpoint = 'http://localhost/php2/api/v1/rezepte';

$(document).ready(function () {
    $.ajax({
        url: endpoint,
        dataType: 'json',
        type: 'GET',

        success: function (results) {
            console.log(results);
        }
    })
        .done(get_Data);
});

let id = $('#id');
let titel = $('#titel');
let benutzername = $('#benutzername');

function get_Data(data) {
    /*
        let rezept = data.results[0];
    
        id.text(rezept.id);
        titel.text(rezept.titel);
        benutzername.text(rezept.benutzername);
        */
};

////////////////////////////