<?php

namespace WIFI\JUMMY;

class Validieren
{
    private array $errors = array();

    /**
     * Prüfen, ob ein Wert (aus Formular) ausgefüllt ist.
     * @param string $wert Der Wert, der auf "ausgefüllt" geprüft werden soll.
     * @param string $feldname Name des Formularfeldes für die FEHLERMELDUNG
     * @return bool False wenn $wert leer ist, ansonsten true.
     */

    public function istAusgefuellt(string $wert, string $feldname): bool
    // feldname käme aus login.php "Benutzer" od. "Passwort" (wird hier nicht gebraucht weil Christian Version)
    {
        if (empty($wert)) {
            $this->errors[] = "{$feldname} war leer!";
            return false;
        } else {
            return true;
        }
    }


    public function fehlerAufgetreten(): bool
    // Ob Fehler aufgetreten ist?
    {
        // return !empty($this->errors); 
        // Gleiches Ergebnis wie unten empty gibt true od. false zurück.

        if (empty($this->errors)) {
            return false;
            // Kein Eintrag im errors-Array - Fehler ist false
        }
        return true;
        // wie oben mit else - andere Schreibweise
    }


    public function fehlerHinzu(string $fehlermeldung): void
    {
        $this->errors[] = $fehlermeldung;
    }


    public function fehlerHtml(): string
    // Fehler ausgeben (wenn aufgetreten)
    {
        if (!$this->fehlerAufgetreten()) {
            return "";
        }

        $ret = "<ul>";
        foreach ($this->errors as $error) {
            $ret .= "<li>{$error}</li>";
        }
        $ret .= "</ul>";
        return $ret;

        // return implode("<br> ", $this->errors);
        // implode — Verbindet Array-Elemente zu einem String
    }
}
