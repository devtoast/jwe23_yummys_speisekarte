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

<div></div>
<?php

$produkt = new Produkt($_GET["id"]); // aus URL (wird aus produkt_liste mitgegeben)
//$_GET aus URL

if (!empty($_GET["delete"])) {
    // Wird in Z43 definiert!
    // Bestätigungs-Link Z43 wurde geklickt -> wird aus DB gelöscht
    $produkt->entfernen();
    echo "<p>Das Produkt wurde erfolgreich gelöscht!</p>";
} else {
    echo "<div class='list-delete'>";
    echo "<p><strong>Kategorie:</strong> " . $produkt->kategorie()->bezeichnung . "</p>";
    echo "<p><strong>Titel:</strong> " . $produkt->titel . "</p>";
    echo "<p><strong>Beschreibung:</strong> " . $produkt->beschreibung . "</p>";
    echo "<p><strong>Währung:</strong> " . $produkt->waehrung . "</p>";
    echo "<p><strong>Preis:</strong> " . $produkt->preis . "</p>";
    echo "<p><strong>Menge:</strong> " . $produkt->menge . "</p>";
    echo "<p><strong>Einheit:</strong> " . $produkt->einheit . "</p>";
    echo "<p><strong>Anlagedatum:</strong> " . $produkt->anlagedatum . "</p>";
    echo "<p><strong>Status:</strong> " . $produkt->aktiv . "</p>";

    echo "<p>
    <strong><a href='produkt_liste.php' style='color: green'> Nein, abbrechen</a></strong></p>";
    echo "<p>
    <strong><a href='produkt_loeschen.php?id=" . $produkt->id . "&amp;delete=1' style='color: red'>Ja, löschen</a></strong></p>";
    echo "</div>";
    // Entweder zurück zur "produkt_liste"

    // oder $_GET["delete"] – Funktion "entfernen()" wird aktiv (DbRowAbstract(Klasse Produkt))
    // URL: ….php?id=7&delete=1
    // delete aus Z43 = WICHTIG für oben Z23
}

include "fuss.php";
