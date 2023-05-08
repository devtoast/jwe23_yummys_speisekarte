<?php

session_start();

//Setzt nur den jeweiligen Eintrag zurück
unset($_SESSION["eingeloggt"]);

// Alle $_SESSION Variablen löschen. - alles wird wieder geleert (z.B. für nächsten Benutzer)
// Setzt alles zurück
session_unset();

// Vernichtet die ganze Session samt Cookie
session_destroy();

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Admin - Yummy</title>

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
                    <h2 id="admin-headline">Sie wurden erfolgreich ausgeloggt!</h2>
                </div>


                <nav id="sub-nav">

                    <ul id="sub-nav-ul">
                        <li class="sub-nav-li"> <a class="sub-nav-li-a" href="../yummys_speisekarte_tom.html">
                                &#9668; Speisekarte</a>
                        </li>

                        <li class="sub-nav-li"> <a class="sub-nav-li-a" href="login.php">Login &#9658;</a> </li>
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