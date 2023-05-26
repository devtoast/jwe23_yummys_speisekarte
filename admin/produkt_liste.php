<?php

use WIFI\JUMMY\Speisen\Produkte;

include "setup.php";
ist_eingeloggt();
include "kopf.php";

?>

<div id="admin-toptext">
    <h2 id="admin-headline">Produktliste</h2>
    <aside id="admin-subline">Übersicht und Bearbeiten</aside>
</div>

<?php

// VORSPEISEN /////////////////////////////////////////////////////////////////

echo "<div class='table-headline'>Vorspeisen</div>";
echo "<br>";

echo "<div style='overflow-x: auto;'>";
echo "<table class='table-admin'>";

echo "<thead>";
echo "<th>Kategorie</th>";
echo "<th>Titel</th>";
echo "<th>Beschreibung</th>";
echo "<th>Währung</th>";
echo "<th>Preis</th>";
echo "<th>Menge</th>";
echo "<th>Einheit</th>";
echo "<th>Anlagedatum</th>";
echo "<th>Status</th>";
echo "<th>Optionen</th>";
echo "</thead>";

echo "<tbody>";

$produkteVs = new Produkte();
$alleProdukteVs = $produkteVs->alleProdukteVs();

foreach ($alleProdukteVs as $vorspeise) {
    echo "<tr>";

    echo "<td>" . $vorspeise->kategorie()->bezeichnung . "</td>";
    echo "<td>" . $vorspeise->titel . "</td>";
    echo "<td>" . $vorspeise->beschreibung . "</td>";
    echo "<td>" . $vorspeise->waehrung . "</td>";
    echo "<td>" . $vorspeise->preis . "</td>";
    echo "<td>" . $vorspeise->menge . "</td>";
    echo "<td>" . $vorspeise->einheit . "</td>";
    echo "<td>" . $vorspeise->anlagedatum . "</td>";
    echo "<td>" . $vorspeise->aktiv . "</td>";
    echo "<td>" . "<a href='produkt_bearbeiten.php?id={$vorspeise->id}'>Bearbeiten</a>" . "<br>"
        . "<a href='produkt_loeschen.php?id={$vorspeise->id}'>Löschen</a>" . "</td>";
    // $vorspeise->id – gibt die id des Einzelproduktes mit (GENAU dieses Produkt wird bearbeitet/gelöscht)

    echo "</tr>";
}
echo "</tbody>";

echo "</table>";
echo "</div>";

// HAUPTSPEISEN /////////////////////////////////////////////////////////////////
echo "<p></p>";
echo "<div class='table-headline'>Hauptspeisen</div>";
echo "<br>";


echo "<table class='table-admin'>";

echo "<thead>";
echo "<th>Kategorie</th>";
echo "<th>Titel</th>";
echo "<th>Beschreibung</th>";
echo "<th>Währung</th>";
echo "<th>Preis</th>";
echo "<th>Menge</th>";
echo "<th>Einheit</th>";
echo "<th>Anlagedatum</th>";
echo "<th>Status</th>";
echo "<th>Optionen</th>";
echo "</thead>";

echo "<tbody>";
$produkteHs = new Produkte();
$alleProdukteHs = $produkteHs->alleProdukteHs();

foreach ($alleProdukteHs as $hauptspeise) {
    echo "<tr>";

    echo "<td>" . $hauptspeise->kategorie()->bezeichnung . "</td>";
    echo "<td>" . $hauptspeise->titel . "</td>";
    echo "<td>" . $hauptspeise->beschreibung . "</td>";
    echo "<td>" . $hauptspeise->waehrung . "</td>";
    echo "<td>" . $hauptspeise->preis . "</td>";
    echo "<td>" . $hauptspeise->menge . "</td>";
    echo "<td>" . $hauptspeise->einheit . "</td>";
    echo "<td>" . $hauptspeise->anlagedatum . "</td>";
    echo "<td>" . $hauptspeise->aktiv . "</td>";
    echo "<td>" . "<a href='produkt_bearbeiten.php?id={$hauptspeise->id}'>Bearbeiten</a>" . "<br>"
        . "<a href='produkt_loeschen.php?id={$hauptspeise->id}'>Löschen</a>" . "</td>";
    // $hauptspeise->id – gibt die id des Einzelproduktes mit (GENAU dieses Produkt wird bearbeitet/gelöscht)

    echo "</tr>";
}
echo "</tbody>";

echo "</table>";

// NACHSPEISEN /////////////////////////////////////////////////////////////////
echo "<p></p>";
echo "<div class='table-headline'>Nachspeisen</div>";
echo "<br>";


echo "<table class='table-admin'>";

echo "<thead>";
echo "<th>Kategorie</th>";
echo "<th>Titel</th>";
echo "<th>Beschreibung</th>";
echo "<th>Währung</th>";
echo "<th>Preis</th>";
echo "<th>Menge</th>";
echo "<th>Einheit</th>";
echo "<th>Anlagedatum</th>";
echo "<th>Status</th>";
echo "<th>Optionen</th>";
echo "</thead>";

echo "<tbody>";
$produkteNs = new Produkte();
$alleProdukteNs = $produkteNs->alleProdukteNs();

foreach ($alleProdukteNs as $nachtspeise) {
    echo "<tr>";

    echo "<td>" . $nachtspeise->kategorie()->bezeichnung . "</td>";
    echo "<td>" . $nachtspeise->titel . "</td>";
    echo "<td>" . $nachtspeise->beschreibung . "</td>";
    echo "<td>" . $nachtspeise->waehrung . "</td>";
    echo "<td>" . $nachtspeise->preis . "</td>";
    echo "<td>" . $nachtspeise->menge . "</td>";
    echo "<td>" . $nachtspeise->einheit . "</td>";
    echo "<td>" . $nachtspeise->anlagedatum . "</td>";
    echo "<td>" . $nachtspeise->aktiv . "</td>";
    echo "<td>" . "<a href='produkt_bearbeiten.php?id={$nachtspeise->id}'>Bearbeiten</a>" . "<br>"
        . "<a class='table-delete', href='produkt_loeschen.php?id={$nachtspeise->id}'>Löschen</a>" . "</td>";
    // $nachspeise->id – gibt die id des Einzelproduktes mit (GENAU dieses Produkt wird bearbeitet/gelöscht)

    echo "</tr>";
}
echo "</tbody>";

echo "</table>";

// GETRAENKE /////////////////////////////////////////////////////////////////
echo "<p></p>";
echo "<div class='table-headline'>Getränke</div>";
echo "<br>";


echo "<table class='table-admin'>";

echo "<thead>";
echo "<th>Kategorie</th>";
echo "<th>Titel</th>";
echo "<th>Beschreibung</th>";
echo "<th>Währung</th>";
echo "<th>Preis</th>";
echo "<th>Menge</th>";
echo "<th>Einheit</th>";
echo "<th>Anlagedatum</th>";
echo "<th>Status</th>";
echo "<th>Optionen</th>";
echo "</thead>";

echo "<tbody>";
$produkteGe = new Produkte();
$alleProdukteGe = $produkteGe->alleProdukteGe();

foreach ($alleProdukteGe as $getraenk) {
    echo "<tr>";

    echo "<td>" . $getraenk->kategorie()->bezeichnung . "</td>";
    echo "<td>" . $getraenk->titel . "</td>";
    echo "<td>" . $getraenk->beschreibung . "</td>";
    echo "<td>" . $getraenk->waehrung . "</td>";
    echo "<td>" . $getraenk->preis . "</td>";
    echo "<td>" . $getraenk->menge . "</td>";
    echo "<td>" . $getraenk->einheit . "</td>";
    echo "<td>" . $getraenk->anlagedatum . "</td>";
    echo "<td>" . $getraenk->aktiv . "</td>";
    echo "<td>" . "<a href='produkt_bearbeiten.php?id={$getraenk->id}'>Bearbeiten</a>" . "<br>"
        . "<a href='produkt_loeschen.php?id={$getraenk->id}'>Löschen</a>" . "</td>";
    // $getraenk->id – gibt die id des Einzelproduktes mit (GENAU dieses Produkt wird bearbeitet/gelöscht)

    echo "</tr>";
}
echo "</tbody>";

echo "</table>";

// END /////////////////////////////////////////////////////////////////





include "fuss.php";
