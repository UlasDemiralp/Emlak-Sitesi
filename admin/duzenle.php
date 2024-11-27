<?php
session_start();
require_once '../baglan.php';

// Güvenli bir şekilde POST verilerini al
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: giris.php');
    exit;
}

if (!isset($_SESSION['username'])) {
    header('Location: giris.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($baglanti, $_GET['id']);
    $sorgu = "SELECT * FROM ev WHERE id='$id'";
    $sonuc = $baglanti->query($sorgu);

    if ($sonuc->num_rows > 0) {
        $row = $sonuc->fetch_assoc();
        $baslik = $row['baslik'];
        $fiyat = $row['fiyat'];
        $adres = $row['adres'];
        $aciklama = $row['aciklama'];
        $bulkat = $row['bulkat'];
        $topm2 = $row['topm2'];
        $odas = $row['odas'];
        $park = $row['park'];
        $telefon = $row['telefon'];
        $category = $row['category'];
    } else {
        echo "Kayıt bulunamadı.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
        // CSRF token kontrolü
     if (!isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Geçersiz CSRF tokeni. Form gönderilemedi.");
     }
    // Güvenli bir şekilde POST verilerini al
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

    // Güncelleme sorgusunu hazırla ve çalıştır
    $guncellemeSorgusu = "UPDATE ev SET baslik='$baslik', fiyat='$fiyat', adres='$adres', aciklama='$aciklama', bulkat='$bulkat', topm2='$topm2', odas='$odas', park='$park', telefon='$telefon', category='$category' WHERE id='$id'";
    
    if ($baglanti->query($guncellemeSorgusu) === TRUE) {
        echo "Veri başarıyla güncellendi.";
        header('Location: listele.php');
        exit;
    } else {
        echo "Hata: " . $guncellemeSorgusu . "<br>" . $baglanti->error;
    }
}
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

$baglanti->close();
?>

<!DOCTYPE html>
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
<body class="aa2" style="background-color: #84a0b2;">
<div class="aa1">
    <div class="form1-container" style="margin-top: 300px;"> 
        <h2>Emlak Güncelle</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="baslik">Başlık:</label>
            <input type="text" id="baslik" name="baslik" value="<?php echo $baslik; ?>" required><br>
            
            <label for="fiyat">Fiyat:</label>
            <input type="number" id="fiyat" name="fiyat" value="<?php echo $fiyat; ?>" required><br>
            
            <label for="adres">Adres:</label>
            <input type="text" id="adres" name="adres" value="<?php echo $adres; ?>" required><br>
            
            <label for="aciklama">Açıklama:</label>
            <textarea id="aciklama" name="aciklama" required><?php echo $aciklama; ?></textarea><br>
            
            <label for="bulkat">Bulunduğu Kat:</label>
            <input type="text" id="bulkat" name="bulkat" value="<?php echo $bulkat; ?>" required><br>
            
            <label for="topm2">Toplam Alan (m²):</label>
            <input type="number" id="topm2" name="topm2" value="<?php echo $topm2; ?>" required><br>
            
            <label for="odas">Oda Sayısı:</label>
            <input type="number" id="odas" name="odas" value="<?php echo $odas; ?>" required><br>
            
            <label for="park">Park Yeri Var mı?</label>
            <select id="park"  name="park" required>
                <option value="Evet" <?php if($park == "Evet") echo 'selected'; ?>>Evet</option>
                <option value="Hayır" <?php if($park == "Hayır") echo 'selected'; ?>>Hayır</option>
            </select><br>
            
            <label for="telefon">Telefon Numarası:</label>
            <input type="tel" id="telefon" name="telefon" value="<?php echo $telefon; ?>" required><br>
            
            <label for="category">Kategori:</label>
            <input type="text" id="category" name="category" value="<?php echo $category; ?>" required><br>
            
            <input type="submit" value="Kaydet">
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
