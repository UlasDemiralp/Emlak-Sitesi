<?php
session_start();
require_once '../baglan.php'; 

if(isset($_POST['logout'])) {
    session_destroy();
    header('Location: giris.php');
    exit;
}
if (!isset($_SESSION['username'])) {
    header('Location: giris.php');
    exit;
}

if (isset($_GET['id'])) {
    // ID'yi alırken tamsayıya dönüştürerek güvenlik sağla
    $id = intval($_GET['id']);

    // Hazırlanan SQL sorgusunda kullan
    $silmeSorgusu = "DELETE FROM ev WHERE id = ?";
    $stmt = $baglanti->prepare($silmeSorgusu);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute() === TRUE) {
        echo "Kayıt başarıyla silindi.";
        header('Location: listele.php');
    } else {
        echo "Hata: " . $baglanti->error;
    }
    $stmt->close();
} else {
    echo "ID belirtilmedi.";
}

$baglanti->close();
?>
