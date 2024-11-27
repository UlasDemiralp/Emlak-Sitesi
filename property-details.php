<?php
require_once 'baglan.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = "SELECT * FROM ev";
$result = $mysqli->query($query);

if (!$result) {
  die("Sorgu hatası: " . $mysqli->error);
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <title>Demiralp Emlak</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->
</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <ul class="info">
            <li><i class="fa fa-envelope"></i> info@demiralp.com</li>
            <li><i class="fa fa-map"></i>Rüstempaşa, Bereket Sok No:5, 54600</li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4">
          <ul class="social-links">
            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://x.com/minthu" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Header Area Start ***** -->
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
              <li><a href="index.php" class="active">Anasayfa</a></li>
              <li><a href="properties.php">Emlak</a></li>
              <li><a href="hakkimizda.php">Biz Kimiz</a></li>
              <li><a href="contact.php">Bize Ulaşın</a></li>
              <li><a href="#"><i class="fa fa-calendar"></i> Detaylı bilgi için arayın</a></li>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>


  <div class="single-property section">
    <div class="container">
        <div class="row">
          
            <?php
            
            $row = $result->fetch_assoc();
            $id = $row['id'];
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
            $resim = $row['resim']; 

            $resim_yolu = "resimler/$resim";
            ?>
             <div class="main-content">
                    <h4><?php echo $baslik; ?></h4>
                    </div>
                <div class="col-lg-8">
                   
                    <div class="main-image">
                        <img style="width: 750px; " src="<?php echo $resim_yolu; ?>" alt="">
                    </div>
                    <div class="main-content">
                        <span class="category"><?php echo $category; ?></span>
                        
                        <p>Fiyat:<?php echo $fiyat; ?></p>
                        <p>Açıklama:<?php echo $aciklama; ?></p>
                        <p>Adres:<?php echo $adres; ?></p>
                        <p>Oda Sayısı:<?php echo $odas; ?></p>
                        <p>Park Yeri:<?php echo $park; ?></p>
                        <p>Telefon:<?php echo $telefon; ?></p>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="info-table">
                        <ul>
                            <li>
                                <img src="assets/images/info-icon-01.png" alt="" style="max-width: 52px;">
                                <h4><?php echo $topm2; ?>m²<br><span>Toplam m²</span></h4>
                            </li>
                            <li>
                                <img src="assets/images/info-icon-03.png" alt="" style="max-width: 52px;">
                                <h4><?php echo $fiyat; ?><br><span>Fiyat</span></h4>
                            </li>
                            <li>
                                <img src="assets/images/info-icon-04.png" alt="" style="max-width: 52px;">
                                <h4>Güvenlik<br><span>24/7 Güvenlik</span></h4>
                            </li>
                        </ul>
                    </div>
                </div>
            
        </div>
    </div>
</div>



<footer>
    <div class="container">
      <div class="col-lg-8">
        <p>Telif Hakkı © 2024 Demiralp Emlak., Ltd. Tüm hakları saklıdır.
       </p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>

</body>
</php>