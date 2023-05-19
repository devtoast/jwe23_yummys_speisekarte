<?php

use WIFI\JUMMY\Speisen\DbRow\Produkt;
use WIFI\JUMMY\Speisen\Kategorien;
use WIFI\JUMMY\Validieren;

include "setup.php";
ist_eingeloggt();

$erfolg = false;

// prüfen ob das Formular abgeschickt wurde
if (!empty($_POST)) {

    $validieren = new Validieren();
    $validieren->istAusgefuellt($_POST["kategorie_id"], "Kategorie");
    $validieren->istAusgefuellt($_POST["titel"], "Titel");
    $validieren->istAusgefuellt($_POST["beschreibung"], "Beschreibung");
    $validieren->istAusgefuellt($_POST["waehrung"], "Währung");
    $validieren->istAusgefuellt($_POST["preis"], "Preis");
    $validieren->istAusgefuellt($_POST["menge"], "Menge");
    $validieren->istAusgefuellt($_POST["einheit"], "Einheit");
    $validieren->istAusgefuellt($_POST["anlagedatum"], "Anlagedatum");

    if (!$validieren->fehlerAufgetreten()) {
        // alles ok -> speichern
        $produkt = new Produkt(array(
            "id" => $_GET["id"] ?? null,
            // wenn id vorhanden, dann verwenden, sonst den Wert rechts
            "kategorie_id" => $_POST["kategorie_id"],
            "titel" => $_POST["titel"],
            "beschreibung" => $_POST["beschreibung"],
            "waehrung" => $_POST["waehrung"],
            "preis" => $_POST["preis"],
            "menge" => $_POST["menge"],
            "einheit" => $_POST["einheit"],
            "anlagedatum" => $_POST["anlagedatum"],
            "aktiv" => $_POST["aktiv"]
        ));

        $produkt->speichern();
        $erfolg = true;
    }
}



include "kopf.php";
?>

<div id="admin-toptext">
    <h2 id="admin-headline">Produktanlage</h2>
    <aside id="admin-subline">Bitte Formular ausfüllen</aside>
</div>

<?php
if ($erfolg) {
    echo "<p><strong>Produkt wurde angelegt.</strong><br>";
} else {

    if (!empty($validieren)) {
        echo $validieren->fehlerHtml();
    }

?>

    <form action="produkt_neu.php" method="post">

        <div class="form-item">
            <label for="kategorie_id">Kategorie: </label>
            <select name="kategorie_id" id="kategorie_id">
                <option value="">- Bitte wählen -</option>

                <?php
                $kategorien = new Kategorien();
                $alleKategorien = $kategorien->alleKategorien();
                foreach ($alleKategorien as $kategorie) {
                    echo "<option value='{$kategorie->id}'";
                    if (!empty($_POST["kategorie_id"]) && $_POST["kategorie_id"] == $kategorie->id) {
                        echo " selected";
                    }
                    echo ">{$kategorie->bezeichnung}</option>";
                    // bezeichnung = DIE Bezeichnung in DB
                }
                ?>
            </select>
        </div>


        <div class="form-item">
            <label for="titel">Titel:</label>
            <input type="text" name="titel" id="titel" value="<?php if (!empty($_POST["titel"])) {
                                                                    echo htmlspecialchars($_POST["titel"]);
                                                                } ?>">
        </div>


        <div class="form-item">
            <label for="beschreibung">Beschreibung:</label>
            <textarea name="beschreibung" id="beschreibung"><?php if (!empty($_POST["beschreibung"])) {
                                                                echo htmlspecialchars($_POST["beschreibung"]);
                                                            } ?></textarea>
        </div>


        <div class="form-item">
            <label for="waehrung">Währung: </label>
            <select name="waehrung" id="waehrung">
                <option value="€">€</option>
                <option value="$">$</option>
                <option value="£">£</option>
                <?php if (!empty($_POST["waehrung"])) {
                    echo " selected";
                } ?>
            </select>
        </div>

        <div class="form-item">
            <label for="preis">Preis:</label>
            <input type="number" step="0.01" name="preis" id="preis" value="<?php
                                                                            if (!empty($_POST["preis"])) {
                                                                                echo htmlspecialchars($_POST["preis"]);
                                                                            }  ?>">
        </div>


        <div class="form-item">
            <label for="menge">Menge:</label>
            <input type="number" step="0.01" name="menge" id="menge" value="<?php
                                                                            if (!empty($_POST["menge"])) {
                                                                                echo htmlspecialchars($_POST["menge"]);
                                                                            }  ?>">
        </div>


        <div class="form-item">
            <label for="einheit">Einheit:</label>
            <input type="text" name="einheit" id="einheit" value="<?php
                                                                    if (!empty($_POST["einheit"])) {
                                                                        echo htmlspecialchars($_POST["einheit"]);
                                                                    }  ?>">
        </div>


        <div class="form-item">
            <label for="anlagedatum">Anlagedatum:</label>
            <input type="date" name="anlagedatum" id="anlagedatum" value="<?php
                                                                            if (!empty($_POST["anlagedatum"])) {
                                                                                echo htmlspecialchars($_POST["anlagedatum"]);
                                                                            }  ?>">
        </div>


        <div>
            <label for="aktiv">Aktivieren:</label>
            <input type="radio" name="aktiv" checked="checked" value="0">Aus
            <input type="radio" name="aktiv" value="1">Ein
        </div>
        <!--[value]="1" / value sollte eigentliuch int sein, ist aber nicht/ value als String funktioniert wg. Datenbankeinstellung (tinyint) nicht / ist in diesem Fall der value int od. string?-->

        <div>
            <button type="submit">Produkt speichern</button>
        </div>

    </form>

    <?php
    /*
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    */
    ?>

<?php
}

include "fuss.php";
