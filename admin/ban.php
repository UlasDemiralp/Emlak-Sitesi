<?php
session_start();
require_once '../baglan.php';


if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: giris.php');
    exit;
}

if (!isset($_SESSION['username'])) {
    header('Location: giris.php');
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin = $_POST['admin'];
    $sifre = $_POST['sifre'];

   
    $sifre_sha256 = hash('sha256', $sifre);

   
    $eklemeSorgusu = "INSERT INTO yonetim (admin, sifre) VALUES ('$admin', '$sifre_sha256')";
    
    if ($baglanti->query($eklemeSorgusu) === TRUE) {
        echo "Yeni admin başarıyla eklendi.";
       
        header('Location: adminler.php');
        exit;
    } else {
        echo "Hata: " . $eklemeSorgusu . "<br>" . $baglanti->error;
    }
}

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
