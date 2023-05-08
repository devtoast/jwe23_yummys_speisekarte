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
}

/* echo "<pre>";
print_r($row);
exit;
*/