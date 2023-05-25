<?php

$db = mysqli_connect("localhost", "root", "", "yummys");
mysqli_set_charset($db, "utf8");

mysqli_query($db, "DELETE FROM produkte WHERE aenderungsdatum <= NOW() - INTERVAL 365 DAY AND aktiv = 0");
// Lösche aus der DB "produkte" alle Einträge bei denen das Änderungsdatum kleiner als JETZT, 
// minus 365 Tage (= 1 Jahr) ist (- INTERVAL 1 YEAR sollte auch funktionieren)
// und der "aktiv"-Status auf null (0) steht.

/** 
 * To add or subtract interval unit values for a date or timestamp, 
 * use INTERVAL function with a + or - operator, such as +/- INTERVAL value unit. 
 * For unit, INTERVAL supports the same values as DATE_ADD. For example: DATE '2020-08-08' + INTERVAL '2' day returns 2020-08-10.
 **/

// Bei jeder Änderung würde ein neues Änderungsdatum in der DB gespeichert (inkl. Statusänderung) 
// bzw. war seit Anlage innerhalb eines Jahres noch nie aktiv (Bei Neuanlage wird ebenfalls ein Änderungsdatum mitgegeben und steht initial auf 0).
// D.h.: Das Produkt wurde länger als ein Jahr nicht mehr geändert (oder jemals aktiviert) UND steht auf 0 (inaktiv)