<?php

use WIFI\JUMMY\Speisen\Kategorien;

include "setup.php";
ist_eingeloggt();
include "kopf.php";

?>

<div id="admin-toptext">
    <h2 id="admin-headline">Kategorieliste</h2>
    <aside id="admin-subline">Übersicht und Bearbeiten</aside>
</div>



<?php
echo "<br>";
echo "<table border='1'>";

echo "<thead>";
echo "<th>Id</th>";
echo "<th>Bezeichnung</th>";
echo "<th>Optionen</th>";
echo "</thead>";

echo "<tbody>";

$kategorien = new Kategorien();
$alleKategorien = $kategorien->alleKategorien();

foreach ($alleKategorien as $kategorie) {
    echo "<tr>";

    echo "<td>" . $kategorie->id . "</td>";
    echo "<td>" . $kategorie->bezeichnung . "</td>";
    echo "<td>" . "<a href='kategorie_bearbeiten.php?id={$kategorie->id}'>Bearbeiten</a>" . "</td>";

    echo "</tr>";
}
echo "</tbody>";

echo "</table>";


include "fuss.php";
