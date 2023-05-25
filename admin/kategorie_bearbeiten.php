<?php

use WIFI\JUMMY\Speisen\DbRow\Kategorie;
use WIFI\JUMMY\Validieren;

include "setup.php";
ist_eingeloggt();

$erfolg = false;


// prüfen ob das Formular abgeschickt wurde
if (!empty($_POST)) {

    $validieren = new Validieren();

    $validieren->istAusgefuellt($_POST["bezeichnung"], "Bezeichnung");

    if (!$validieren->fehlerAufgetreten()) {
        // alles ok -> speichern
        $kategorie = new Kategorie(array(
            "id" => $_GET["id"] ?? null,
            // wenn id vorhanden, dann verwenden, sonst den Wert rechts
            "bezeichnung" => $_POST["bezeichnung"],
        ));

        $kategorie->speichern();
        $erfolg = true;
    }
}

include "kopf.php";
?>

<div id="admin-toptext">
    <h2 id="admin-headline">Kategorie bearbeiten</h2>
    <aside id="admin-subline">Bitte Formulardaten anpassen</aside>
</div>

<?php
if ($erfolg) {
    echo "<p><strong>Kategorie wurde bearbeitet.</strong><br>";
} else {

    if (!empty($validieren)) {
        echo $validieren->fehlerHtml();
    }
    if (!empty($_GET["id"])) {
        // bearbeiten-modus - Produktdaten ermitteln
        $kategorie = new Kategorie($_GET["id"]);
    }


?>

    <?php
    /*
    echo "<pre>";
    print_r($produkt);
    echo "</pre>";
    */
    ?>

    <div class="admin-form">
        <form action="kategorie_bearbeiten.php<?php
                                                if (!empty($kategorie)) {
                                                    echo "?id=" . $kategorie->id;
                                                }
                                                ?>" method="post">
            <!-- vorausfüllen -->

            <div class="form-item">
                <label for="bezeichnung">Titel:</label>
                <input type="text" name="bezeichnung" id="bezeichnung" value="<?php if (!empty($_POST["bezeichnung"])) {
                                                                                    echo htmlspecialchars($_POST["bezeichnung"]);
                                                                                } else if (!empty($kategorie)) {
                                                                                    echo htmlspecialchars($kategorie->bezeichnung);
                                                                                } ?>"> <!-- vorausfüllen -->
            </div>


            <div>
                <button type="submit">Kategorie speichern</button>
            </div>

        </form>
    </div>


<?php
}

include "fuss.php";
