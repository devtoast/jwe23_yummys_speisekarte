<?php

$passwort = "lurchi17";
echo $passwort;

echo "<br>";
echo "<br>";

// password_hasch (Einweg Algorythmus) // Datenbankeintrag - 255 Zeichen!!!
// Verschlüsselt PW jedes Mal neu!!! - SUPER SICHER!
//https://www.php.net/manual/de/function.password-hash.php

echo password_hash($passwort, PASSWORD_DEFAULT);
