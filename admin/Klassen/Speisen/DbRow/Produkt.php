<?php

namespace WIFI\JUMMY\Speisen\DbRow;


class Produkt extends DbRowAbstract
{
    protected string $tabelle = "produkte";
    // Tabellenname aus DB - für DbRowAbstract (Übergabe des richtigen Tabellennamens)


    public function kategorie(): Kategorie
    // Klasse Kategorie (= Kategorie.php)
    {
        return new Kategorie($this->kategorien_id);
        // Gibt ein Objekt Kategorie zurück (: Kategorie)
    }
}
