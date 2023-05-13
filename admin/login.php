<?php
include "funktionen.php";

// if (!empty($_POST)) - wenn noch nichts abgeschickt wurde bzw. noch nicht auf den Button geklickt wurde
if (!empty($_POST)) {
    // Validierung
    if (empty($_POST["benutzername"]) || empty($_POST["passwort"])) {
        $error = "Benutzername oder Passwort war nicht ausgefüllt!";
    } else {
        // Benutzer und Passwort werden übergeben
        // => in der DB nachsehen, ob der Benutzer existiert

        // Daten von Formularen/Benutzern ($_GET / $_POST)
        // IMMER mit mysqli_real_escape_string - Maskiert Sonderzeichen - behandeln!, bevor die Daten in einem Datenbankbefehl verwendet werden
        // Funktion escape kommt aus funktionen.php
        $sql_benutzername = escape($_POST["benutzername"]);

        // Datenbank fragen ob der eingegebene Benutzer existiert.
        // Funktion query kommt aus Datei Funktionen
        $result = query("SELECT * FROM benutzer WHERE benutzername='{$sql_benutzername}'");

        // Einen Datensatz aus mysql in ein PHP Array umwandeln
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Benutzername existiert => Passwort prüfen
            if (password_verify($_POST["passwort"], $row["passwort"])) {
                // password_verify vergleicht das generierte Zeichenketten-PW in DB mit dem Klarnamen-PW "#..."
                $_SESSION["eingeloggt"] = true;
                $_SESSION["benutzername"] = $row["benutzername"];
                // Zur Ausgabe in kopf.php

                query("UPDATE benutzer SET login_last=NOW(), login_count=login_count+1 WHERE benutzername = '{$row['benutzername']}'");
                // letztes Login & Anzahl der Logins in DB speichern

                header("Location: index.php");
                // Umleiten zum Admin-System (index.php)
                exit;
            } else {
                // Passwort war falsch -> Fehlermeldung
                // idealerweise die selbe Fehlermeldung, somit kannman nicht darauf scchließen was von beiden (PW od. Benutzer) falsch war
                $error = "Benutzername oder Passwort war falsch!";
            }
        } else {
            // eingegebener Benutzer ist nicht in der DB => Fehlermeldung
            // idealerweise die selbe Fehlermeldung, somit kannman nicht darauf scchließen was von beiden (PW od. Benutzer) falsch war
            $error = "Benutzername oder Passwort war falsch!";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin - Yummy</title>

    <link rel="icon" sizes="48x48" href="../img/yummy_logo.ico">

    <link rel="stylesheet" href="../css/admin-base.css">

</head>

<body>

    <header>
        <div id="admin-header">
            <div class="admin-header-container">

                <img src="../img/yummy_rz.svg" alt="logo-yummys" id="yummy-logo-src">

            </div>
        </div>
    </header>


    <div class="admin-main-wrapper">

        <main>

            <div class="admin-inner-wrapper">

                <div id="admin-toptext">
                    <h2 id="admin-headline">Willkommen im yummy`s&nbsp;Login</h2>
                    <aside id="admin-subline">Bitte geben Sie Ihre Zugangsdaten ein</aside>
                </div>

                <?php
                // Ausgabe des oberen PHP-Codes ($error)
                if (!empty($error)) {
                    echo "<p><b style='color: red; font-family: sans-serif'>{$error}</b></p>";
                }

                ?>

                <div class="admin-form">
                    <form method="post">

                        <div class="form-item">
                            <label for="benutzername">Benutzername:</label>
                            <input type="text" name="benutzername" id="benutzername" placeholder=" Benutzername">
                        </div>

                        <div class="form-item">
                            <label for="passwort">Passwort:</label>
                            <input type="text" name="passwort" id="passwort" placeholder=" Passwort">
                        </div>

                        <div class="form-item-bt">
                            <button id="button-1" type="submit">Einloggen</button>
                        </div>

                    </form>

                </div>

                <nav id="sub-nav">

                    <ul id="sub-nav-ul">
                        <li class="sub-nav-li"> <a class="sub-nav-li-a" href="../yummys_speisekarte_tom.html">
                                &#9668; Speisekarte</a>
                        </li>
                        <li class="sub-nav-li"> <a class="sub-nav-li-a" href="">Super-Admin &#9658;</a> </li>
                    </ul>

                </nav>

            </div>

        </main>

    </div>


    <footer>
        <div id="admin-footer-end">
            <aside id="admin-footer-end-text">&copy; 2023 by <a href="#"><b>yummy`s</b></a> &bull; Alle Rechte
                vorbehalten</aside>
        </div>
    </footer>

    <!--  <script src="../js/login.js"></script> -->

</body>

</html>