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

$sql = "SELECT * FROM ev";
$stmt = $baglanti->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
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
            <h2>Emlaklar Listele</h2>
            <!-- Tablo başlangıcı -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Resim</th>
                            <th>Başlık</th>
                            <th>Fiyat</th>
                            <th>Adres</th>
                            <th>Açıklama</th>
                            <th>Bulunduğu Kat</th>
                            <th>Toplam m²</th>
                            <th>Oda Sayısı</th>
                            <th>Park</th>
                            <th>Telefon</th>
                            <th>Kategori</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td><img src='../resimler/" . htmlspecialchars($row['resim']) . "' width='100'></td>";
                            echo "<td>" . htmlspecialchars($row['baslik']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['fiyat']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['adres']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['aciklama']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['bulkat']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['topm2']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['odas']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['park']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['telefon']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                            echo "<td><a href='sil.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger'>Sil</a></td>";
                            echo "<td><a href='duzenle.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-primary'>Düzenle</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
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
