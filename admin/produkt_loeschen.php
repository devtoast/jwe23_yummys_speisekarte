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
    echo "<p><strong>Kategorie:</strong> " . $produkt->kategorie()->bezeichnung . "</p>" . "<br />";
    echo "<p><strong>Titel:</strong> " . $produkt->titel . "<br />";
    echo "<p><strong>Beschreibung:</strong> " . $produkt->beschreibung . "</p>" . "<br />";
    echo "<p><strong>Währung:</strong> " . $produkt->waehrung . "</p>" . "<br />";
    echo "<p><strong>Preis:</strong> " . $produkt->preis . "</p>" . "<br />";
    echo "<p><strong>Menge:</strong> " . $produkt->menge . "</p>" . "<br />";
    echo "<p><strong>Einheit:</strong> " . $produkt->einheit . "</p>" . "<br />";
    echo "<p><strong>Anlagedatum:</strong> " . $produkt->anlagedatum . "</p>" . "<br />";
    echo "<p><strong>Status:</strong> " . $produkt->aktiv . "</p>" . "<br />";

    echo "<p>
    <strong><a href='produkt_liste.php' style='color: green'> Nein, abbrechen</a></strong></p>";
    echo "<p>
    <a href='produkt_loeschen.php?id=" . $produkt->id . "&amp;delete=1' style='color: red'>Ja, löschen</a></p>";

    // Entweder zurück zur "produkt_liste"

    // oder $_GET["delete"] – Funktion "entfernen()" wird aktiv (DbRowAbstract(Klasse Produkt))
    // URL: ….php?id=7&delete=1
    // delete aus Z41 = WICHTIG für oben Z23
}

include "fuss.php";
