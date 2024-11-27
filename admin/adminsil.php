<?php
session_start();
require_once '../baglan.php'; 

if (!isset($_SESSION['username'])) {
    header('Location: giris.php');
    exit;
}

if (isset($_GET['id'])) {
    // ID'yi alırken tamsayıya dönüştürerek güvenlik sağla
    $id = intval($_GET['id']);

    // Hazırlanan SQL sorgusunda kullan
    $sql = "DELETE FROM yonetim WHERE id = $id";
    if ($baglanti->query($sql) === TRUE) {
        header('Location: adminler.php'); 
        exit;
    } else {
        echo "Error deleting record: " . $baglanti->error;
    }

    $baglanti->close();
}
?>
