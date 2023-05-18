///////// jQuery /////////

let endpoint = 'http://localhost/jwe23_praxisprojekt_thomas/jwe23_yummys_speisekarte/api/v1/kategorien/2/produkte';

// Erstmalige Initialisierung //
$(document).ready(function () {
    $.ajax({
        url: endpoint,
        dataType: 'json',
        type: 'GET',

        success: function (results) {
            //console.log(results);
        }
    })
        .done(dataOutput);
});

/*
// Danach Abfrage alle 10 Sekunden (Funktion "getData") //
$(document).ready(function () {
    setInterval(getData, 10000);
});

function getData() {
    $.ajax({
        url: endpoint,
        dataType: 'json',
        type: 'GET',

        success: function (results) {
            // console.log(results);
        }
    })
        .done(dataOutput);
};
*/

// Danach Output auf Website //
function dataOutput(data) {

    // let produkt = data.result[0]; // Bezeichnung "result" aus API JSON OBJECT!!!!! (Pos. 0)
    // let produkt = data.result; // Bezeichnung "result" aus API JSON OBJECT!!!!! (Alle Pos.)
    let produkte = data.result;
    console.log(produkte);

    const ProduktContainer = document.querySelector('.produkt-container');
    ProduktContainer.innerHTML = '';

    for (let produkt of produkte) {

        const produktItem = document.createElement('div');
        produktItem.className = 'produkt-item';


        const titel = produkt.titel;
        const beschreibung = produkt.beschreibung;
        const waehrung = produkt.waehrung;
        const preis = produkt.preis;


        const descriptionTitel = document.createElement('span');
        descriptionTitel.setAttribute('id', 'description-titel');
        descriptionTitel.textContent = titel;

        const descriptionBeschreibung = document.createElement('span');
        descriptionBeschreibung.setAttribute('id', 'description-beschreibung');
        descriptionBeschreibung.textContent = beschreibung;

        const descriptionPreis = document.createElement('span');
        descriptionPreis.setAttribute('id', 'description-preis');
        descriptionPreis.textContent = waehrung + ' ' + preis;



        ProduktContainer.appendChild(produktItem);
        produktItem.appendChild(descriptionTitel);
        produktItem.appendChild(descriptionBeschreibung);
        produktItem.appendChild(descriptionPreis);

    }
};
