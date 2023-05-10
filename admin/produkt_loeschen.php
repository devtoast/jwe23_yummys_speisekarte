<?php

use WIFI\JUMMY\Speisen\DbRow\Produkt;

include "setup.php";
ist_eingeloggt();
// Ist der Benutzer überhaupt eingeloggt bzw. muss eingeloggt sein
include "kopf.php";
?>


<div id="admin-toptext">
    <h2 id="admin-headline">Produkt löschen</h2>
    <aside id="admin-subline">Sind Sie sicher?</aside>
</div>


<?php

$produkt = new Produkt($_GET["id"]);
//$_GET aus URL

if (!empty($_GET["delete"])) {
    // Wird in Z41 definiert!
    // Bestätigungs-Link Z41 wurde geklickt -> wird aus DB gelöscht
    $produkt->entfernen();
    echo "<p>Das Produkt wurde erfolgreich gelöscht!</p>";
} else {
    echo "<strong>Kategorie:</strong> " . $produkt->kategorie()->bezeichnung . "<br />";
    echo "<strong>Titel:</strong> " . $produkt->titel . "<br />";
    echo "<strong>Beschreibung:</strong> " . $produkt->beschreibung . "<br />";
    echo "<strong>Währung:</strong> " . $produkt->waehrung . "<br />";
    echo "<strong>Preis:</strong> " . $produkt->preis . "<br />";
    echo "<strong>Menge:</strong> " . $produkt->menge . "<br />";
    echo "<strong>Einheit:</strong> " . $produkt->einheit . "<br />";
    echo "<strong>Anlagedatum:</strong> " . $produkt->anlagedatum . "<br />";
    echo "<strong>Status:</strong> " . $produkt->aktiv . "<br />";

    echo "<p>
    <a href='produkt_liste.php'> Nein, abbrechen</a>
    <a href='produkt_loeschen.php?id=" . $produkt->id . "&amp;delete=1'>Ja, löschen</a>
    </p>";
    // delete = WICHTIG für oben Z23
}









include "fuss.php";
