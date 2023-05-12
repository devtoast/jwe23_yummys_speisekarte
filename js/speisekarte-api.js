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


// jQuery

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

// Vanilla

function getApiData(event) {
    fetch("http://localhost/php2/api/v1/rezepte")
        // fetch – abrufen
        .then(function (response) {
            if (response.ok) {
                // Response ok property – ok – Status 200 = "ok"
                console.log(response);
                return response.json();
                // gibt die Daten als "json" aus – json (Java Script Object Notation) (Textformat zum Speichern und Transportieren von Daten)
                // definiert Objekte mit Eigenschaften (Z.B.: Objekt Hauptspeise, Eigenschften: Titel, Bezeichnung; Preis…)
            } else {
                throw new Error("API ERROR")
            }
        })
        .then(function (speise) {
            document.querySelector("#speisen-titel").textContent = `${speise.title}`;
            document.querySelector("#benutzername").textContent = `${speise.benutzername}`;
        })
        .catch(function (error) {
            document.querySelector("#film-title").textContent = error.message;
        });

    /*
    .then(function (content) {
        const ul = document.querySelector("#speisen-liste");
     
        for (let item of content) {

            const li = document.createElement("li")
            
            const id = item.id;
            const titel = item.titel;
            const benutzername = item.benutzername;
     
            li.textContent = titel;
     
            ul.appendChild(li);
        }
    });
    */

}
window.addEventListener("load", getApiData);



/*
const params = new URLSearchParams(window.location.search);
const id = params.get("id");

if (id) {
    fetch(`http://localhost/php2/api/v1/rezepte/${id}`)
        .then(function (response) {
            if (response.ok) {
                console.log(response);
                return response.json();
            }
            else if (response.status === 404) {
                throw new Error("Rezept nicht gefunden");
            } else {
                throw new Error(`API Fehler bei id=${id}`);
            }
        })
        .then(function (speise) {
            document.querySelector("#speisen-titel").textContent = speise.title;
            document.querySelector("#benutzername").textContent = speise.benutzername;
        })
        .catch(function (error) {
            document.querySelector("#speisen-titel").textContent = error.message;
        });
}
*/


/*/////////
function createNode(element) {
    return document.createElement(element);
}

function append(parent, el) {
    return parent.appendChild(el);
}

const ul = document.getElementById('authors');
const url = 'https://randomuser.me/api/?results=10';

fetch(url)
    .then((resp) => resp.json())
    .then(function (data) {
        let authors = data.results;
        console.log(authors);
        return authors.map(function (author) {
            let li = createNode('li');
            let img = createNode('img');
            let span = createNode('span');
            img.src = author.picture.medium;
            span.innerHTML = `${author.name.first} ${author.name.last}`;
            append(li, img);
            append(li, span);
            append(ul, li);
        })
    })
    .catch(function (error) {
        console.log(error);
    });

 */ /////////

/*
function createElements(element) {
    return document.createElement(element);
}

function append(parent, el) {
    return parent.appendChild(el);
}

const ul = document.getElementById('vorspeisen');
const url = 'http://localhost/php2/api/v1/rezepte';

fetch(url)
    .then((resp) => resp.json())
    .then(function (data) {
        let vorspeisen = data.results;
        // console.log(vorspeisen);
        return vorspeisen.map(function (vorspeise) {
            let li = createElements('li');
            // let img = createElements('img');
            let span = createElements('span');
            // img.src = vorspeise.picture.medium;
            span.innerHTML = `${vorspeise.titel} ${vorspeise.benutzername}`;
            // append(li, img);
            append(li, span);
            append(ul, li);
        })
    })
    .catch(function (error) {
        console.log(error);
    });
    */