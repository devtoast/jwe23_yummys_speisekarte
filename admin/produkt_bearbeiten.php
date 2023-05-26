<?php

use WIFI\JUMMY\Speisen\DbRow\Produkt;
use WIFI\JUMMY\Speisen\Kategorien;
use WIFI\JUMMY\Validieren;

include "setup.php";
ist_eingeloggt();

$sqlAktuellesDatum = date("Y-m-d");

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
            "aktiv" => $_POST["aktiv"],
            "aenderungsdatum" => $_POST["aenderungsdatum"]
        ));

        $produkt->speichern();
        $erfolg = true;
    }
}



include "kopf.php";
?>

<div id="admin-toptext">
    <h2 id="admin-headline">Produkt bearbeiten</h2>
    <aside id="admin-subline">Bitte Formulardaten anpassen</aside>
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
    /*
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    echo "<pre>";
    print_r($produkt);
    echo "</pre>";
    */
    ?>

    <div class="admin-form">
        <form action="produkt_bearbeiten.php<?php
                                            if (!empty($produkt)) {
                                                echo "?id=" . $produkt->id;
                                            }
                                            ?>" method="post">
            <!-- vorausfüllen -->

            <div class="form-item">
                <label for="kategorie_id">Kategorie: </label>
                <select class="select-item" name="kategorie_id" id="kategorie_id">
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



            <div class="form-item">
                <label for="titel">Titel:</label>
                <input type="text" name="titel" id="titel" value="<?php if (!empty($_POST["titel"])) {
                                                                        echo htmlspecialchars($_POST["titel"]);
                                                                    } else if (!empty($produkt)) {
                                                                        echo htmlspecialchars($produkt->titel);
                                                                    } ?>"> <!-- vorausfüllen -->
            </div>


            <div class="form-item">
                <label for="beschreibung">Beschreibung:</label>
                <textarea name="beschreibung" id="beschreibung"><?php if (!empty($_POST["beschreibung"])) {
                                                                    echo htmlspecialchars($_POST["beschreibung"]);
                                                                } else if (!empty($produkt)) {
                                                                    echo htmlspecialchars($produkt->beschreibung);
                                                                } ?></textarea>
            </div>


            <div class="form-item">
                <label for="waehrung">Währung: </label>
                <select class="select-item" name="waehrung" id="waehrung">
                    <option value="€">€</option>
                    <option value="$">$</option>
                    <option value="£">£</option>
                    <?php if (!empty($_POST["waehrung"])) {
                        echo " selected";
                    } else if (!empty($produkt)) {
                        //  echo "<option value='{$produkt->waherung}'>{$produkt->waherung}</option>";
                        echo " selected";
                    }

                    ?>
                </select>
            </div>

            <div class="form-item">
                <label for="preis">Preis:</label>
                <input type="number" step="0.01" name="preis" id="preis" value="<?php
                                                                                if (!empty($_POST["preis"])) {
                                                                                    echo htmlspecialchars($_POST["preis"]);
                                                                                } else if (!empty($produkt)) {
                                                                                    echo htmlspecialchars($produkt->preis);
                                                                                } ?>">
            </div>


            <div class="form-item">
                <label for="menge">Menge:</label>
                <input type="number" step="0.01" name="menge" id="menge" value="<?php
                                                                                if (!empty($_POST["menge"])) {
                                                                                    echo htmlspecialchars($_POST["menge"]);
                                                                                } else if (!empty($produkt)) {
                                                                                    echo htmlspecialchars($produkt->menge);
                                                                                } ?>">
            </div>


            <div class="form-item">
                <label for="einheit">Einheit:</label>
                <input type="text" name="einheit" id="einheit" value="<?php
                                                                        if (!empty($_POST["einheit"])) {
                                                                            echo htmlspecialchars($_POST["einheit"]);
                                                                        } else if (!empty($produkt)) {
                                                                            echo htmlspecialchars($produkt->einheit);
                                                                        } ?>">
            </div>


            <div class="form-item">
                <label for="anlagedatum">Anlagedatum:</label>
                <input type="date" name="anlagedatum" id="anlagedatum" value="<?php
                                                                                if (!empty($_POST["anlagedatum"])) {
                                                                                    echo htmlspecialchars($_POST["anlagedatum"]);
                                                                                } else if (!empty($produkt)) {
                                                                                    echo htmlspecialchars($produkt->anlagedatum);
                                                                                } ?>">
            </div>


            <div class="radio-aktiv">
                <label for="aktiv">Aktivieren:</label>
                <input type="radio" name="aktiv" checked="checked" value="<?php echo 0 ?>">Aus
                <input type="radio" name="aktiv" value="<?php echo 1 ?>">Ein

                <input type="hidden" name="aenderungsdatum" value="<?php
                                                                    echo htmlspecialchars($sqlAktuellesDatum);
                                                                    ?>">
            </div>

            <!--[value]="1" / value sollte eigentliuch int sein, ist aber nicht/ value als String funktioniert wg. Datenbankeinstellung (tinyint) nicht / ist in diesem Fall der value int od. string?-->

            <div>
                <button class="button-admin" type="submit">Speichern</button>
            </div>

        </form>

    </div>

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
