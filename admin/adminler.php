<?php
session_start();
require_once '../baglan.php';

// Güvenlik önlemleri
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: giris.php');
    exit;
}

if (!isset($_SESSION['username'])) {
    header('Location: giris.php');
    exit;
}

// Güvenli bir şekilde SQL sorgusu hazırla
$sql = "SELECT * FROM yonetim";
$result = $baglanti->query($sql);

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
                        <li><a href="#"><span><?php echo htmlspecialchars($_SESSION['username']); ?></span></a></li>
                    </ul>
                    <a class="menu-trigger">
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>
<body class="aa3" style="background-color: #84a0b2;">
    <div class="aa0">
        <div class="form11-container" style="margin-top: 20px;"> 
            <h2>Adminler</h2>
            <!-- Tablo başlangıcı -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Admin</th>
                            <th>Şifre</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['admin']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['sifre']) . "</td>";
                                echo "<td><a href='adminsil.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger'>Sil</a></td>";
                                echo "<td><a href='adminduz.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-primary'>Düzenle</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Veri bulunamadı.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button onclick="window.location.href='adminekle.php';" class="btn btn-primary">Admin Ekle</button>
            </div>
            <!-- Tablo bitişi -->
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
