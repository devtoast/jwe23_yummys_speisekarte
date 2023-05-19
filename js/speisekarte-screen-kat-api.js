let endpoint = 'http://localhost/jwe23_praxisprojekt_thomas/jwe23_yummys_speisekarte/api/v1/kategorien/list';

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
        .done(dataOutputKat);
});


// Danach Output auf Website //
function dataOutputKat(data) {

    // let produkt = data.result[0]; // Bezeichnung "result" aus API JSON OBJECT!!!!! (Pos. 0)
    // let produkt = data.result; // Bezeichnung "result" aus API JSON OBJECT!!!!! (Alle Pos.)

    let kategorieVs = data.result[0];
    let kategorieHs = data.result[1];
    let kategorieNs = data.result[2];
    let kategorieGe = data.result[3];


    const katBezeichnungVs = kategorieVs.bezeichnung;
    const katBezeichnungHs = kategorieHs.bezeichnung;
    const katBezeichnungNs = kategorieNs.bezeichnung;
    const katBezeichnungGe = kategorieGe.bezeichnung;


    const headlineVs = document.querySelector('#headline-vs');
    headlineVs.innerHTML = katBezeichnungVs;

    const headlineHs = document.querySelector('#headline-hs');
    headlineHs.innerHTML = katBezeichnungHs;

    const headlineNs = document.querySelector('#headline-ns');
    headlineNs.innerHTML = katBezeichnungNs;

    const headlineGe = document.querySelector('#headline-ge');
    headlineGe.innerHTML = katBezeichnungGe;

};