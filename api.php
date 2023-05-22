<?php

// http://localhost/jwe23_praxisprojekt_thomas/jwe23_yummys_speisekarte/api/v1/kategorien/list
// http://localhost/jwe23_praxisprojekt_thomas/jwe23_yummys_speisekarte/api/v1/kategorien/1/produkte
// http://localhost/jwe23_praxisprojekt_thomas/jwe23_yummys_speisekarte/api/v1/kategorien/2/produkte
// http://localhost/jwe23_praxisprojekt_thomas/jwe23_yummys_speisekarte/api/v1/kategorien/3/produkte
// http://localhost/jwe23_praxisprojekt_thomas/jwe23_yummys_speisekarte/api/v1/kategorien/4/produkte
// http://localhost/jwe23_praxisprojekt_thomas/jwe23_yummys_speisekarte/api/v1/produkte/list

require "admin/funktionen.php";
/**
 * Die include- und require-Anweisungen sind identisch, außer bei einem Fehler:
 * require – erzeugt einen schwerwiegenden Fehler (E_COMPILE_ERROR) und stoppt das Skript
 * include – erzeugt nur eine Warnung (E_WARNING) und das Skript wird fortgesetzt
 */

header("Content-Type: application/json");
/**
 * header — Sendet einen HTTP-Header in Rohform
 * Content-Type – es wird ein json ausgegeben ausgeben (kann z.B. auch ein PDF sein)
 */


function fehler($message)
{
    header("HTTP/1.1 404 Not Found");
    // Bei Fehler - http-Statusmeldungen für Clients

    echo json_encode(array(
        // json_encode — Liefert die JSON-Darstellung eines Wertes
        "status" => 0,
        "error" => $message
    ));
    exit;
}

/** 
 * URI (Uniform Resource Identifier) – Der Dateiname
 * URL (Uniform Resource Locator) – Eine Webseitenadresse – ist eine Unterart des URI
 * 
 * z.B.: https://www.w3.org/Icons/WWW/w3c_main.gif – Dateipfad
 * identifiziert eine Datei, auf die mit Hilfe einer Webprotokollanwendung (HTTP, Hypertext Transfer Protocol) 
 * zugegriffen werden kann. Diese befindet sich auf einem Computer mit der Bezeichnung 
 * „www.w3.org“ (der wiederum eindeutig einer bestimmten Internetadresse zugeordnet werden kann). 
 * Innerhalb der Verzeichnisstruktur dieses Computers befindet sich die Datei in einem Pfad namens 
 * „/Icons/WWW/w3c_main.gif“. Zeichenfolgen, die FTP-Adressen (File Transfer Protocol) und E-Mail-Adressen identifizieren, 
 * sind ebenfalls URIs (und stellen genau wie die HTTP-Adresse eine Unterart des URI dar).
 */

// request – Die Anfrage
// request_uri – Abfrage des Datenpfades

/**
 * explode — Teilt eine Zeichenkette anhand einer Zeichenkette
 * 3 Parameter möglich 
 * 1. seperator – (Die Begrenzungszeichenkette)
 * 2. string – (Die Eingabezeichenkette)
 * 3. limit – (aus wievielen Teilen das Rückgabe-ARRAY besteht)
 */


// GET-Parameter aus request_uri entfernen
$request_uri_ohne_get = explode("?", $_SERVER["REQUEST_URI"])[0];
// Aus Anfrage-URI die gewünschte Methode ermitteln
$teile = explode("/api/", $request_uri_ohne_get, 2);
$parameter = explode("/", $teile[1]);

$api_version = ltrim(array_shift($parameter), "vV"); // entfernt vV
if (empty($api_version)) {
    fehler("Bitte API-Version angeben.");
}
// array_shift entfernt den ersten Wert aus einem Array und gibt ihn zurück
// aus diesem lesen wir hier gleich unsere Version raus. (1)


// Leere Einträge aus Parameter-Array entfernen
foreach ($parameter as $k => $v) {
    if (empty($v)) {
        unset($parameter[$k]);
        // unset ($parameter[$k]); – löscht ein einzelnes Element eines Arrays [$k]
        // unset($beispielvariable); – löscht eine einzelne Variable
    } else {
        $parameter[$k] = mb_strtolower($v);
        // Alle Parameter in Kleinbuchstaben umwandeln, falls diese falsch daherkommen
        // mb_ – Multibyte (z.B.: ä,ü…)
    }
}

// Indizes neu zuordnen falls mit doppelten Schrägstrichen aufgerufen wird
$parameter = array_values($parameter);
// array_values — Liefert alle Werte eines Arrays

if (empty($parameter)) {
    fehler("Nach der Version wurde keine Methode übergeben. Prüfen Sie Ihren Aufruf.");
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

// Ab hier ist in $parameter[0] immer die Hauptmethode drin,
// in $parameter[1], etc. die genauere Spezifizierung was angefragt wurde

if ($parameter[0] == "kategorien") {
    if (!empty($parameter[1])) {
        if ($parameter[1] == "list") {
            $ausgabe = array(
                "status" => 1,
                "result" => array()
            );
            // Liste aller Kategorien (Vorspeisen, Hauptspeisen… (ohne Produkte))
            $result = query("SELECT * FROM kategorien ORDER BY id ASC");
            // query – aus funktionen.php
            while ($row = mysqli_fetch_assoc($result)) {
                $ausgabe["result"][] = $row;
            }

            echo json_encode($ausgabe);
            // json_encode — Liefert die JSON-Darstellung eines Wertes
            exit;
        } else {
            if (!empty($parameter[2]) && ($parameter[2] == "produkte")) {
                //echo "Geht";
                $ausgabe = array(
                    "status" => 1,
                    "result" => array()
                );
                $sql_kategorie_id = escape($parameter[1]);
                // $result = query("SELECT * FROM produkte WHERE kategorie_id = '{$sql_kategorie_id}' AND aktiv = 1 ORDER BY produkte.id ASC");
                $result = query("SELECT produkte.titel, produkte.beschreibung, produkte.waehrung, produkte.preis, produkte.menge, produkte.einheit, produkte.kategorie_id FROM produkte WHERE kategorie_id = '{$sql_kategorie_id}' AND aktiv = 1");
                // $produkt = mysqli_fetch_assoc($result); // WEG

                while ($row = mysqli_fetch_assoc($result)) {
                    $ausgabe["result"][] = $row;
                }

                echo json_encode($ausgabe);
                exit;
            } else {
                ///////// ID wurde übergeben - Detail einer Kategorie ausgeben /////////
                $ausgabe = array(
                    "status" => 1
                );
                // Kategoriedaten ermitteln
                $sql_kategorie_id = escape($parameter[1]);
                $result = query("SELECT * FROM kategorien WHERE id = '{$sql_kategorie_id}'");
                $produkt = mysqli_fetch_assoc($result);

                if (!$produkt) {
                    fehler("Mit der id '{$parameter[1]}' wurde keine Kategorie gefunden");
                }
                $ausgabe["produkt"] = $produkt;
                //

                //
                echo json_encode($ausgabe);
                exit;
            }
        }
    }
    ////////////////////////////////////// ALLE PRODUKTE
} else if ($parameter[0] == "produkte") {
    if (!empty($parameter[1])) {
        if ($parameter[1] == "list") {
            // Liste aller Produkte
            $ausgabe = array(
                "status" => 1,
                "result" => array()
            );
            $where = "";
            if (!empty($_GET["suche"])) {
                $sql_suche = escape($_GET["suche"]);
                $where = "WHERE produkte.titel LIKE '%{$sql_suche}%'";
            }
            $result = query("SELECT produkte.id, produkte.titel, produkte.beschreibung, produkte.waehrung, produkte.preis, produkte.menge, produkte.einheit, produkte.kategorie_id FROM produkte WHERE aktiv = 1 ORDER BY produkte.id ASC");
            // Liste aller Produkte
            while ($row = mysqli_fetch_assoc($result)) {
                $ausgabe["result"][] = $row;
            }
            echo json_encode($ausgabe);
            exit;
        }
        //////////////////////////////////////
        else {
            // ID wurde übergeben - Detail eines Produktes ausgeben
            $ausgabe = array(
                "status" => 1
            );
            // Produktdaten ermitteln
            $sql_produkt_id = escape($parameter[1]);
            $result = query("SELECT * FROM produkte WHERE id = '{$sql_produkt_id}'");
            $produkt = mysqli_fetch_assoc($result);

            if (!$produkt) {
                fehler("Mit der id '{$parameter[1]}' wurde kein Produkt gefunden");
            }
            $ausgabe["produkt"] = $produkt;
            //
            //
            echo json_encode($ausgabe);
            exit;
        }
    }
} else {
    fehler("Die Methode '{$parameter[0]}' existiert nicht.");
}


/*
echo "<pre>";
print_r($ausgabe);
echo "</pre>";
*/