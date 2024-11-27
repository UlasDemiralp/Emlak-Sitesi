<?php
session_start();
require_once '../baglan.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CSRF token kontrolü
    if (!isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Geçersiz CSRF tokeni. Form gönderilemedi.");
    }
  
    $username = mysqli_real_escape_string($baglanti, $_POST['admin']);
    $password = mysqli_real_escape_string($baglanti, $_POST['sifre']);

    // Kullanıcı adı ile şifreyi veritabanından al
    $query = "SELECT * FROM yonetim WHERE admin = '$username'";
    $result = mysqli_query($baglanti, $query);

    if ($result) {
        
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            
            $hashed_password = hash('sha256', $password);
            
            if ($hashed_password === $user['sifre']) {
                $_SESSION['username'] = $username;
                header('Location: index.php');
                exit;
            } else {
                echo "Hatalı şifre";
            }
        } else {
            echo "Kullanıcı bulunamadı";
        }
    } else {
        echo "Sorgu hatası: " . mysqli_error($baglanti);
    }
}
?>
