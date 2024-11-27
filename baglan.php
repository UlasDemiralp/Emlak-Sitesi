<?php
$baglanti = new mysqli("localhost", "root", "", "emlak");

if ($baglanti->connect_error) {
    die("Veritabanına bağlanılamadı: " . $baglanti->connect_error);
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("localhost", "root", "", "emlak");

if ($mysqli->connect_error) {
    die("Veritabanına bağlanılamadı: " . $mysqli->connect_error);
}

?>
