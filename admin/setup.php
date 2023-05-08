<?php

// Projektkonfiguration

const MYSQL_HOST = "localhost";
const MYSQL_USER = "root";
const MYSQL_PASSWORT = "";
const MYSQL_DATENBANK = "yummys";


session_start();
// session_start — Erzeugt eine neue Session oder setzt eine vorhandene fort

spl_autoload_register(
    function (string $klasse) {
        // Projektspezifisches namespace prefix
        $prefix = "WIFI\\JUMMY\\"; // 11 Positionen

        //Basisverzeichnis für das namespace prefix
        // __DIR__ = ist GLEICHER ORDNER in der setup.php liegt -"/Klassen/" = UNTERORDNER
        $basis = __DIR__ . "/Klassen/";

        // Wenn die Klasse das prefix nicht verwendet - abbrechen!
        $laenge = strlen($prefix);
        // strlen — Ermitteln der String-Länge ( WIFI\JUMMY\ - 11)

        if (substr($klasse, 0, $laenge) !== $prefix) {
            // substr — Liefert einen Teil eines Strings
            // wenn die ersten 11 Zeichen nicht das prefix sind
            return;
        }

        // Klasse ohne Prefix
        // der hintere Teil d. Pfades (Packerl\PackerlGross) – (ab Pos. 11)
        // 3. Argument - die übriggebliebenen Zeichen braucht man nicht angeben() 
        $relativ = substr($klasse, $laenge);


        // Dateipfad erstellen
        // Dateipfad zusammenbauen aus $basis (vorderer Teil) . Backslash mit Slash ersetzen . $relativ (hinterer Teil) . Dateiendung (".php")
        $datei = $basis . str_replace("\\", "/", $relativ) . ".php";
        // str_replace — Ersetzt alle Vorkommen des Suchstrings durch einen anderen String

        // Wenn die Datei existiert - einbinden!
        if (file_exists($datei)) {
            include $datei;
        }
    }
);

// Diese funktion überprüft, ob der Benutzer eingeloggt ist
// Falls nicht, wird er automatisch zum Login umgeleitet
function ist_eingeloggt() //Eigenfunktion!!!!!!!!!
{
    if (empty($_SESSION["eingeloggt"])) {
        //Benutzer ist NICHT eingeloggt -> umleiten zum Login
        header("Location: login.php"); // "header" interne Funktion - Weiterleitung zu "login.php" (verwirrender Name!)
        exit; // wird gemacht, um weitere "geheime" Inhalte darunter nicht zum Browser schicken
    }
}
// Benutzer nicht eingeloggt umleiten zu Login
