<?php
session_start();
require_once '../baglan.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
       // CSRF token kontrolü
    if (!isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Geçersiz CSRF tokeni. Form gönderilemedi.");
    }
    // POST verilerini güvenli bir şekilde al
    $resim = mysqli_real_escape_string($baglanti, $_FILES['resim']['name']);
    $baslik = mysqli_real_escape_string($baglanti, $_POST['baslik']);
    $fiyat = mysqli_real_escape_string($baglanti, $_POST['fiyat']);
    $adres = mysqli_real_escape_string($baglanti, $_POST['adres']);
    $aciklama = mysqli_real_escape_string($baglanti, $_POST['aciklama']);
    $bulkat = mysqli_real_escape_string($baglanti, $_POST['bulkat']);
    $topm2 = mysqli_real_escape_string($baglanti, $_POST['topm2']);
    $odas = mysqli_real_escape_string($baglanti, $_POST['odas']);
    $park = mysqli_real_escape_string($baglanti, $_POST['park']);
    $telefon = mysqli_real_escape_string($baglanti, $_POST['telefon']);
    $category = mysqli_real_escape_string($baglanti, $_POST['category']);
    
    $resim_dizin = "../resim/" . basename($resim);
    if (move_uploaded_file($_FILES['resim']['tmp_name'], $resim_dizin)) {
       
        $baglanti = new mysqli("localhost", "root", "", "emlak");

     
        if ($baglanti->connect_error) {
            die("Veritabanına bağlanılamadı: " . $baglanti->connect_error);
        }

        $sql = "INSERT INTO ev (resim, baslik, fiyat, adres, aciklama, bulkat, topm2, odas, park, telefon, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $baglanti->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssssssssss", $resim_dizin, $baslik, $fiyat, $adres, $aciklama, $bulkat, $topm2, $odas, $park, $telefon, $category);

            if ($stmt->execute()) {
                echo "Emlak başarıyla eklendi.";
                header("Location: index.php"); 
                exit(); 
            } else {
                echo "Hata: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Hata: Prepare işlemi başarısız.";
        }

        $baglanti->close();
    } else {
        echo "Resim yükleme sırasında bir hata oluştu.";
    }
}
?>
