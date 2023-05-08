<?php

namespace WIFI\JUMMY\Speisen;

use WIFI\JUMMY\Speisen\DbRow\Kategorie;
use WIFI\JUMMY\Mysql;


class Kategorien
{
    /**
     * Gibt alle Kategorien (Vor-, Nachspeisen…) zurück
     * @return array Ein array mit mehreren Marke Objekten.
     */

    public function alleKategorien(): array
    {
        $db = Mysql::getInstanz();
        // Mit DB verbinden (aus Mysql)

        $kategorienGesamt = array();

        $result = $db->query("SELECT * FROM kategorien");
        while ($row = $result->fetch_assoc()) {
            $kategorienGesamt[] = new Kategorie($row);
            // while Schleife durchläuft alle Einträge in "Tabelle kategorien" -> in assoc Array ($kategorienGesamt)
            // while Schleife endet automatisch wenn kein Eintrag mehr verfügbar ist!
        }
        return $kategorienGesamt;
    }
}

/* echo "<pre>";
print_r($row);
exit;
*/