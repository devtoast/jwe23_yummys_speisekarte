<?php

namespace WIFI\JUMMY\Speisen;

use WIFI\JUMMY\Speisen\DbRow\Produkt;
use WIFI\JUMMY\Mysql;


class Produkte
{
    /**
     * Gibt alle Produkte (Gerichte) zurück
     * @return array Ein array mit mehreren Produkt Objekten.
     */

    public function alleProdukte(): array
    {
        $db = Mysql::getInstanz();
        // Mit DB verbinden (aus Mysql)

        $produkteGesamt = array();

        $result = $db->query("SELECT * FROM produkte");
        while ($row = $result->fetch_assoc()) {
            $produkteGesamt[] = new Produkt($row);
            // while Schleife durchläuft alle Einträge in "Tabelle produkte" -> in assoc Array ($produkteGesamt)
            // jeder "row-Eintrag" = ein new Produkt
            // while Schleife endet automatisch wenn kein Eintrag mehr verfügbar ist!
        }
        return $produkteGesamt;
    }


    public function alleProdukteVs(): array
    {
        $db = Mysql::getInstanz();
        // Mit DB verbinden (aus Mysql)

        $produkteGesamtVs = array();

        $result = $db->query("SELECT * FROM produkte WHERE kategorie_id = 1 ORDER BY anlagedatum DESC");
        // ASC – kleinster Wert zuerst / DESC – größter Wert zuerst
        while ($row = $result->fetch_assoc()) {
            $produkteGesamtVs[] = new Produkt($row);
        }
        return $produkteGesamtVs;
    }


    public function alleProdukteHs(): array
    {
        $db = Mysql::getInstanz();
        // Mit DB verbinden (aus Mysql)

        $produkteGesamtHs = array();

        $result = $db->query("SELECT * FROM produkte WHERE kategorie_id = 2 ORDER BY anlagedatum DESC");
        while ($row = $result->fetch_assoc()) {
            $produkteGesamtHs[] = new Produkt($row);
        }
        return $produkteGesamtHs;
    }


    public function alleProdukteNs(): array
    {
        $db = Mysql::getInstanz();
        // Mit DB verbinden (aus Mysql)

        $produkteGesamtNs = array();

        $result = $db->query("SELECT * FROM produkte WHERE kategorie_id = 3 ORDER BY anlagedatum DESC");
        while ($row = $result->fetch_assoc()) {
            $produkteGesamtNs[] = new Produkt($row);
        }
        return $produkteGesamtNs;
    }


    public function alleProdukteGe(): array
    {
        $db = Mysql::getInstanz();
        // Mit DB verbinden (aus Mysql)

        $produkteGesamtGe = array();

        $result = $db->query("SELECT * FROM produkte WHERE kategorie_id = 4 ORDER BY anlagedatum DESC");
        while ($row = $result->fetch_assoc()) {
            $produkteGesamtGe[] = new Produkt($row);
        }
        return $produkteGesamtGe;
    }
}

/* echo "<pre>";
print_r($row);
exit;
*/