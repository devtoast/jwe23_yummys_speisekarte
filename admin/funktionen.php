<?php

// Für index/login/logout/api

session_start();
// interne Funktion - generiert eindeutige Session-ID (immer andere)
// ist auch notwendig, um die $_SESSION zur verfügung zu haben

$db = mysqli_connect("localhost", "root", "", "yummys");
// interne Funktion - Verbindung zum Server herstellen
// Bis zu 4 Parameter - Hostname, Benutzername, Kennwort, Datenbankname ("z.B.: localhost", "root",…)

mysqli_set_charset($db, "utf8");
// interne Funktion - mysql mitteilen, dass unsere Befehle als utf8 kommen


// Abfragen - Eigenfunktion!
function query($sql_befehl)
{
    global $db;
    $result = mysqli_query($db, $sql_befehl) or die(mysqli_error($db) . "<br>" . $sql_befehl);
    return $result;
    // ACHTUNG $result als Variable angeben
    // "die" beendet das Programm bei Fehler
}

// Maskiert Sonderzeichen - Eigenfunktion!
function escape($post_var)
{
    global $db;
    // Holt Variable von Draußen rein
    return mysqli_real_escape_string($db, $post_var);
    // IMMER mit mysqli_real_escape_string - Maskiert Sonderzeichen - behandeln!!!!!!!!
}

// Eigenfunktion!
// Diese funktion überprüft, ob der Benutzer eingeloggt ist
// Falls nicht, wird er automatisch zum Login umgeleitet
function ist_eingeloggt()
{
    if (empty($_SESSION["eingeloggt"])) {
        //Benutzer ist NICHT eingeloggt -> umleiten zum Login
        header("Location: login.php");
        // "header" interne Funktion - Weiterleitung zu "login.php" (verwirrender Name!)
        exit;
        // wird gemacht um weitere "geheime" Inhalte darunter, nicht zum Browser zu schicken
    }
}
