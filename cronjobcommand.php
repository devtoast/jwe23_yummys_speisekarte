<?php

//Verbindung herstellen
$db_connection = mysqli_connect("localhost", "root", "", "yummys");
mysqli_set_charset($db_connection, "utf8");

// Verbindung prüfen
// mysqli_connect_error – Gibt die Fehlerbeschreibung des letzten Verbindungsfehlers zurück, falls vorhanden.
// Die Funktion die() entspricht ​​der Funktion exit(). – ist neuer
if (!$db_connection) {
    die("Verbindung zur DB fehlgeschlagen: " . mysqli_connect_error());
} else {
    echo "Verbindung zur DB: OK" . "<br>";
}

// SQL-Befehl (LÖSCHE aus "produkte" WO "aenderungsdatum" kleiner/ist JETZT minus 365 Tage UND der Status "aktiv" auf 0 steht)
$sql_befehl = "DELETE FROM produkte WHERE aenderungsdatum <= NOW() - INTERVAL 365 DAY AND aktiv = 0";

// "mysqli_query" – Abfrage der DB "$db_connection" – Ausführung des Befehls "$sql_befehl"
if (mysqli_query($db_connection, $sql_befehl)) {
    echo "Ein Jahr alte Einträge wurden gelöscht.";
} else {
    echo "Fehler beim löschen: " . mysqli_error($db_connection);
}

// mysqli_close – schließt die vorher geöffnete Datenbankverbindung wieder
mysqli_close($db_connection);


//////// OBJEKTORIENTIERT //////////////////////////////////////////////////////////////////////

/*
//Verbindung herstellen
$db_connection = new mysqli("localhost", "root", "", "yummys");
// Verbindung prüfen
if ($db_connection->connect_error) {
    die("Connection failed: " . $db_connection->connect_error);
}

// SQL-Befehl (LÖSCHE aus "produkte" WO "aenderungsdatum" kleiner/ist JETZT minus 365 Tage UND der Status "aktiv" auf 0 steht)
$sql_befehl = "DELETE FROM produkte WHERE aenderungsdatum <= NOW() - INTERVAL 365 DAY AND aktiv = 0";

// "mysqli_query" – Abfrage der DB "$db_connection" – Ausführung des Befehls "$sql_befehl"
if ($db_connection->query($sql_befehl) === TRUE) {
    echo "Ein Jahr alte Einträge wurden gelöscht.";
} else {
    echo "Fehler beim löschen: " . $db_connection->error;
}

// Verbindung zur DB wieder schließen
$db_connection->close();
*/

/*
echo "<pre>";
print_r($db_connection);
echo "<pre>";
*/

// Lösche aus der DB "produkte" alle Einträge bei denen das Änderungsdatum kleiner als JETZT, 
// minus 365 Tage (= 1 Jahr) ist (- INTERVAL 1 YEAR sollte auch funktionieren)
// und der "aktiv"-Status auf null (0) steht.

/** 
 * To add or subtract interval unit values for a date or timestamp, 
 * use INTERVAL function with a + or - operator, such as +/- INTERVAL value unit. 
 * For unit, INTERVAL supports the same values as DATE_ADD. For example: DATE '2020-08-08' + INTERVAL '2' day returns 2020-08-10.
 **/

// Bei jeder Änderung würde ein neues Änderungsdatum in der DB gespeichert (inkl. Statusänderung) 
// bzw. war seit Anlage innerhalb eines Jahres noch nie aktiv (Bei Neuanlage wird ebenfalls ein Änderungsdatum mitgegeben und steht initial auf 0).
// D.h.: Das Produkt wurde länger als ein Jahr nicht mehr geändert (oder jemals aktiviert) UND steht auf 0 (inaktiv)
