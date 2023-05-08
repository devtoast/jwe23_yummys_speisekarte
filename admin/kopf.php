<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Yummy</title>

    <link rel="icon" sizes="48x48" href="../img/yummy_logo.ico">
    <link rel="stylesheet" href="../css/admin-base.css">
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>

    <header>

        <div id="admin-header">
            <div class="admin-header-container">

                <img src="../img/yummy_rz.svg" alt="logo-yummys" id="yummy-logo-src">

                <!-- aus login.php (Z 30)($_SESSION["benutzername"])-->
                <p id="login-info-text"><?php echo "Eingeloggt als: " . $_SESSION["benutzername"]; ?></p>

                <img src="../img/side_nav_icon_60x50_w.svg" alt="side-nav-icon" id="side-nav-icon-src" onclick="openSideNav()">

            </div>
        </div>

    </header>

    <div class="admin-main-wrapper">

        <nav class="side-nav" id="side-nav">

            <a href="javascript:void(0)" class="closebtn" onclick="closeSideNav()">&times;</a>
            <ul id="side-nav-ul">
                <li> <a class="main-li-a" href="">Produkte</a> </li>
                <li> <a class="main-li-a" href="produkt_neu.php">Produkt Neu</a> </li>
                <li> <a class="main-li-a" href="">Kategorien</a> </li>
                <li> <a class="main-li-a" href="">Restaurants</a> </li>
                <li> <a class="base-li-a" href="index.php">Start</a> </li>
                <li> <a class="base-li-a" href="logout.php">Ausloggen</a> </li>
            </ul>

        </nav>

        <nav class="top-nav" id="top-nav">

            <ul id="top-nav-ul">
                <li> <a class="base-li-a" href="logout.php">Ausloggen</a> </li>
                <li> <a class="base-li-a" href="index.php">Start</a> </li>
                <li> <a class="main-li-a" href="">Produkte</a> </li>
                <li> <a class="main-li-a" href="produkt_neu.php">Produkt Neu</a> </li>
                <li> <a class="main-li-a" href="">Kategorien</a> </li>
                <li> <a class="main-li-a" href="">Restaurants</a> </li>
            </ul>

        </nav>

        <main>

            <div class="admin-inner-wrapper">