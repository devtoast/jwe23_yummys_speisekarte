let endpointProd = 'http://localhost/jwe23_praxisprojekt_thomas/jwe23_yummys_speisekarte/api/v1/produkte/list';

// Erstmalige Initialisierung //
$(document).ready(function () {
    $.ajax({
        url: endpointProd,
        dataType: 'json',
        type: 'GET',

        success: function (results) {
            //console.log(results);
        }
    })
        .done(dataOutputProd);
});

/*
// Danach Abfrage alle 10 Sekunden (Funktion "getDataProd") //
$(document).ready(function () {
    setInterval(getDataProd, 10000);
});

function getDataProd() {
    $.ajax({
        url: endpointProd,
        dataType: 'json',
        type: 'GET',

        success: function (results) {
            // console.log(results);
        }
    })
        .done(dataOutputProd);
};
*/

function dataOutputProd(data) {

    // DATEN aus ARRAY filtern (Vorspeisen kat_id 1, Hauptspeisen kat_id 2 usw.)
    // filter – gibt ALLE definierten Werte zurück
    // find – nur den ERSTEN!!!!

    let produkteVs = data.result.filter(produkte => produkte.kategorie_id === "1");
    console.log(produkteVs)

    let produkteHs = data.result.filter(produkte => produkte.kategorie_id === "2");
    console.log(produkteHs)

    let produkteNs = data.result.filter(produkte => produkte.kategorie_id === "3");
    console.log(produkteNs)

    let produkteGe = data.result.filter(produkte => produkte.kategorie_id === "4");
    console.log(produkteGe)


    // Ausgabeort definieren
    const productsOutputVs = document.querySelector('#products-vs');
    // Initial leer
    productsOutputVs.innerHTML = '';

    const productsOutputHs = document.querySelector('#products-hs');
    productsOutputHs.innerHTML = '';

    const productsOutputNs = document.querySelector('#products-ns');
    productsOutputNs.innerHTML = '';

    const productsOutputGe = document.querySelector('#products-ge');
    productsOutputGe.innerHTML = '';


    // Alle Produkte einer Kategorie abfragen und im Ausgabeort ausgeben

    // Vorspeisen
    for (let produkt of produkteVs) {

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


        productsOutputVs.appendChild(produktItem);
        produktItem.appendChild(descriptionTitel);
        produktItem.appendChild(descriptionBeschreibung);
        produktItem.appendChild(descriptionPreis);

    }

    // Hauptspeisen
    for (let produkt of produkteHs) {

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


        productsOutputHs.appendChild(produktItem);
        produktItem.appendChild(descriptionTitel);
        produktItem.appendChild(descriptionBeschreibung);
        produktItem.appendChild(descriptionPreis);

    }

    // Nachspeisen
    for (let produkt of produkteNs) {

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


        productsOutputNs.appendChild(produktItem);
        produktItem.appendChild(descriptionTitel);
        produktItem.appendChild(descriptionBeschreibung);
        produktItem.appendChild(descriptionPreis);

    }

    // Getraenke
    for (let produkt of produkteGe) {

        const produktItem = document.createElement('div');
        produktItem.className = 'produkt-item';

        const titel = produkt.titel;
        const beschreibung = produkt.beschreibung;
        const menge = produkt.menge;
        const einheit = produkt.einheit;
        const waehrung = produkt.waehrung;
        const preis = produkt.preis;

        const descriptionTitel = document.createElement('span');
        descriptionTitel.setAttribute('id', 'description-titel');
        descriptionTitel.textContent = titel;

        const descriptionBeschreibung = document.createElement('span');
        descriptionBeschreibung.setAttribute('id', 'description-beschreibung');
        descriptionBeschreibung.textContent = beschreibung;

        const descriptionEinheit = document.createElement('span');
        descriptionEinheit.setAttribute('id', 'description-einheit');
        descriptionEinheit.textContent = menge + ' ' + einheit;

        const descriptionPreis = document.createElement('span');
        descriptionPreis.setAttribute('id', 'description-preis');
        descriptionPreis.textContent = waehrung + ' ' + preis;


        productsOutputGe.appendChild(produktItem);
        produktItem.appendChild(descriptionTitel);
        produktItem.appendChild(descriptionBeschreibung);
        produktItem.appendChild(descriptionEinheit);
        produktItem.appendChild(descriptionPreis);

    }

};