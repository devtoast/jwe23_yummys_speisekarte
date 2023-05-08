<?php

namespace WIFI\JUMMY\Speisen\DbRow;

use WIFI\JUMMY\Mysql;
// Erlaubt getInstanz (Die Datenbankverbindung) aus Mysql

abstract class DbRowAbstract
{
    protected string $tabelle;

    private array $daten = array();



    public function __construct(int|array $idOderDaten)
    // oder Daten weil in Produkte Array
    {
        if (is_int($idOderDaten)) {
            // ID wurde übergeben, Daten aus DB ausgeben
            $db = Mysql::getInstanz();
            // Mit DB verbinden (aus Mysql)
            // Oder // $db = \WIFI\JUMMY\Mysql::getInstanz();

            $sqlId = $db->escape($idOderDaten);
            // Maskiert Sonderzeichen

            $result = $db->query("SELECT * FROM {$this->tabelle} WHERE id = '{$sqlId}'");

            $this->daten = $result->fetch_assoc();
        } else {
            $this->daten = $idOderDaten;
            // Fertiges Array wurde übergeben, verwenden wie gegeben. (aus Produkte.php)
        }
    }



    public function __get(string $eigenschaft): mixed
    {
        // __get - PHP Magic
        if (!array_key_exists($eigenschaft, $this->daten)) {
            // array_key - Wie Name aus DB (Argument $eigenschaft)
            throw new \Exception("Die Spalte {$eigenschaft} existiert in der Tabelle nicht!");
        }
        return $this->daten[$eigenschaft];
    }



    public function entfernen(): void
    {
        $db = Mysql::getInstanz();
        // Mit DB verbinden (aus Mysql)

        $sqlId = $db->escape($this->id);
        // Maskiert Sonderzeichen

        $db->query("DELETE FROM {$this->tabelle} WHERE id = '{$sqlId}'");
    }



    public function speichern(): void
    {
        $db = Mysql::getInstanz();
        // Mit DB verbinden (aus Mysql)

        // Felder für SQL-Abfrage zusammenbauen
        $sqlFelder = "";

        foreach ($this->daten as $spaltenname => $formularwert) {
            if ($spaltenname == "id") {
                continue;
            }
            $sqlFormularwert = $db->escape($formularwert);
            $sqlFelder .= "{$spaltenname} = '{$sqlFormularwert}', ";
        }

        $sqlFelder = rtrim($sqlFelder, " ,");
        // Letztes Komma entfernen (rtrim - rechtsTrim)

        if (!empty($this->daten["id"])) {

            $sqlId = $db->escape($this->daten["id"]);
            $db->query("UPDATE {$this->tabelle} SET {$sqlFelder} WHERE id = '{$sqlId}'");
            // in DB bearbeiten und einfügen (UPDATE) - Datensatz bearbeiten
        } else {
            $db->query("INSERT INTO {$this->tabelle} SET {$sqlFelder}");
            // in DB einfügen (INSERT INTO) - neuer Datensatz
        }
    }
}


/*
echo "<pre>";
print_r($this->daten);
echo "</pre>";
*/