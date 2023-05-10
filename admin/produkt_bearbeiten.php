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
    <h2 id="admin-headline">Produkt bearbeiten</h2>
    <aside id="admin-subline">Bitte Formular anpassen</aside>
</div>

<?php
if ($erfolg) {
    echo "<p><strong>Produkt wurde bearbeitet.</strong><br>";
    // <a href='produkt_liste.php'>Zurück zur Liste</a></p>

} else {

    if (!empty($validieren)) {
        echo $validieren->fehlerHtml();
    }
    if (!empty($_GET["id"])) {
        // bearbeiten-modus - Produktdaten ermitteln
        $produkt = new Produkt($_GET["id"]);
    }


?>
    <?php
    echo "<pre>";
    print_r($produkt);
    echo "</pre>";
    ?>


    <form action="produkt_bearbeiten.php<?php
                                        if (!empty($produkt)) {
                                            echo "?id=" . $produkt->id;
                                        }
                                        ?>" method="post">
        <!-- vorausfüllen -->

        <div>
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
                    } else if (!empty($produkt) && $produkt->kategorie_id == $kategorie->id) {
                        echo " selected";
                        // ACHTUNG ACHTUNG kategorie_id NICHT kategorien_id ACHTUNG ACHTUNG!!!!!
                    }
                    echo ">{$kategorie->bezeichnung}</option>";
                    // bezeichnung = DIE Bezeichnung in DB
                }
                ?>
            </select>
        </div>



        <div>
            <label for="titel">Titel:</label>
            <input type="text" name="titel" id="titel" value="<?php if (!empty($_POST["titel"])) {
                                                                    echo htmlspecialchars($_POST["titel"]);
                                                                } else if (!empty($produkt)) {
                                                                    echo htmlspecialchars($produkt->titel);
                                                                } ?>"> <!-- vorausfüllen -->
        </div>


        <div>
            <label for="beschreibung">Beschreibung:</label>
            <textarea name="beschreibung" id="beschreibung"><?php if (!empty($_POST["beschreibung"])) {
                                                                echo htmlspecialchars($_POST["beschreibung"]);
                                                            } else if (!empty($produkt)) {
                                                                echo htmlspecialchars($produkt->beschreibung);
                                                            } ?></textarea>
        </div>


        <div>
            <label for="waehrung">Währung: </label>
            <select name="waehrung" id="waehrung">
                <option value="€">€</option>
                <option value="$">$</option>
                <option value="£">£</option>
                <?php if (!empty($_POST["waehrung"])) {
                    echo " selected";
                } else if (!empty($produkt)) {
                    echo " selected";
                    echo htmlspecialchars($produkt->waehrung);
                }
                // echo "<option value='{$produkt["waehrung"]}'></option>";
                //echo htmlspecialchars($produkt->waehrung); {$produkt->waehrung}
                ?>
            </select>
        </div>

        <div>
            <label for="preis">Preis:</label>
            <input type="number" step="0.01" name="preis" id="preis" value="<?php
                                                                            if (!empty($_POST["preis"])) {
                                                                                echo htmlspecialchars($_POST["preis"]);
                                                                            } else if (!empty($produkt)) {
                                                                                echo htmlspecialchars($produkt->preis);
                                                                            } ?>">
        </div>


        <div>
            <label for="menge">Menge:</label>
            <input type="number" step="0.01" name="menge" id="menge" value="<?php
                                                                            if (!empty($_POST["menge"])) {
                                                                                echo htmlspecialchars($_POST["menge"]);
                                                                            } else if (!empty($produkt)) {
                                                                                echo htmlspecialchars($produkt->menge);
                                                                            } ?>">
        </div>


        <div>
            <label for="einheit">Einheit:</label>
            <input type="text" name="einheit" id="einheit" value="<?php
                                                                    if (!empty($_POST["einheit"])) {
                                                                        echo htmlspecialchars($_POST["einheit"]);
                                                                    } else if (!empty($produkt)) {
                                                                        echo htmlspecialchars($produkt->einheit);
                                                                    } ?>">
        </div>


        <div>
            <label for="anlagedatum">Anlagedatum:</label>
            <input type="date" name="anlagedatum" id="anlagedatum" value="<?php
                                                                            if (!empty($_POST["anlagedatum"])) {
                                                                                echo htmlspecialchars($_POST["anlagedatum"]);
                                                                            } else if (!empty($produkt)) {
                                                                                echo htmlspecialchars($produkt->anlagedatum);
                                                                            } ?>">
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
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    ?>

<?php
}

include "fuss.php";
