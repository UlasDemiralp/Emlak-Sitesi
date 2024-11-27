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
// CSRF token oluştur
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    
$baglanti->close();
?><!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/anasayfa.css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <script>
        function logout() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send("logout=true");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    window.location.href = "giris.php";
                }
            };
        }
    </script>
</head>
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">
                        <h1>Demiralp</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="emlakek.php">Emlak Ekle</a></li>
                        <li><a href="listele.php">Emlak Listele</a></li>
                        <li><a href="adminler.php">Adminler</a></li>
                        <li><a href="#" onclick="logout()">Çıkış Yap</a></li>
                        <li><a href="#"><span><?php echo $_SESSION['username']; ?></span></a></li>
                    </ul>
                    <a class="menu-trigger">
                        <span>Menu</span>
                    </a>
                  
                </nav>
            </div>
        </div>
    </div>
</header>
<body cllass ="aa2" style="background-color: #84a0b2;">
<div class="aa1" >
    <div class="form1-container" style="margin-top: 330px;"> 
        <h2>Emlak Ekle</h2>
        <form action="cnc.php" method="POST" enctype="multipart/form-data">
            <label for="resim">Resim Yükle:</label>
            <input type="file" id="resim" name="resim" accept="resim/*" required><br>
            
            <label for="baslik">Başlık:</label>
            <input type="text" id="baslik" name="baslik" required><br>
            
            <label for="fiyat">Fiyat:</label>
            <input type="number" id="fiyat" name="fiyat" required><br>
            
            <label for="adres">Adres:</label>
            <input type="text" id="adres" name="adres" required><br>
            
            <label for="aciklama">Açıklama:</label>
            <textarea id="aciklama" name="aciklama" required></textarea><br>
            
            <label for="bulkat">Bulunduğu Kat:</label>
            <input type="text" id="bulkat" name="bulkat" required><br>
            
            <label for="topm2">Toplam Alan (m²):</label>
            <input type="number" id="topm2" name="topm2" required><br>
            
            <label for="odas">Oda Sayısı:</label>
            <input type="number" id="odas" name="odas" required><br>
            
            <label for="park">Park Yeri Var mı?</label>
                <select id="park"  name="park" required>
                  <option value="" disabled selected>Lütfen Seçiniz</option>
                  <option value="Evet">Evet</option>
                  <option value="Hayır">Hayır</option>
                </select><br>
            <label for="telefon">Telefon Numarası:</label>
            <input type="tel" id="telefon" name="telefon" required><br>
            
            <label for="category">Kategori:</label>
            <input type="text" id="category" name="category" required><br>

            <input type="submit" value="Gönder">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
        </form>
    </div>
</div>
<script src="assets/js/main.js"></script>
<script src="assets/js/anasayfa.js"></script>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/isotope.min.js"></script>
<script src="../assets/js/owl-carousel.js"></script>
<script src="../assets/js/counter.js"></script>
<script src="../assets/js/custom.js"></script>
</body>
</html>
