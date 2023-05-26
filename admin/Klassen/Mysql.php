<?php

namespace WIFI\JUMMY;

class Mysql
{
    // Singleton Implementierung START

    // Vermeidet mehrfache Erstellung des selben Objektes.
    // Hier gewünscht, um nicht mehrere Datenbank_Verbindungen
    // gleichzeitig zu öffnen.

    private static ?Mysql $instanz = null;
    // Fragezeichen null oder Mysql (Mysql || null - ginge auch)

    // NEU - Die Typen für Parameter und Rückgabewerte können nun durch ein vorangestelltes Fragezeichen 
    // als nullable gekennzeichnet werden. Das bedeutet, dass neben dem angegebenen Typ 
    // auch null als Parameter übergeben bzw. als Wert zurückgegeben werden kann. 

    public static function getInstanz(): Mysql
    // Nur 1x Datenbankverbindung
    {
        if (!self::$instanz) {
            // null // Doppelpunkte weil static (sonst wäre es Pfeil ->)
            self::$instanz = new Mysql();
            // neues Objekt von sich selbst
        }
        return self::$instanz;
    }

    // Singleton Implementierung ENDE


    private \mysqli $db;
    // (\Backslash bei PHP Eigenobjekten - jedenfalls bei eigenen Namespaces)

    // __construct – PHP ruft diese Funktion automatisch auf, wenn ein Objekt aus einer Klasse erstellt wird.
    private function __construct()
    {
        $this->verbinden();
    }

    private function verbinden(): void
    // void - kein Rückgabewert
    {
        // Mysqli-Objekt erstellen und Verbindung aufbauen 
        // (\Backslash bei PHP Eigenobjekten - jedenfalls bei eigenen Namespaces)
        $this->db = new \mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORT, MYSQL_DATENBANK);
        // aus setup.php

        $this->db->set_charset("utf8");
        // Zeichensatz mitteilen
    }


    public function escape(string $wert): string
    {
        return $this->db->real_escape_string($wert);
        // IMMER mit real_escape_string - Maskiert Sonderzeichen - behandeln!!!!!!!!
        // return mysqli_real_escape_string($db, $wert); – ginge auch
    }


    public function query(string $sqlBefehl): \mysqli_result|bool
    {
        // query – Anfrage, Rückfrage
        $result = $this->db->query($sqlBefehl);
        return $result;
    }
}
