<?php
session_start();

require_once '../baglan.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// CSRF token oluştur
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>


<!DOCTYPE html>
<html lang="tr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
   <link rel="stylesheet" href="assets/css/styles.css">
   <title>Yönetim Paneli Giriş</title>
</head>
<body>
   <div class="login">
      <img src="assets/img/login-bg.png" alt="login image" class="login__img">
      <form action="login.php" method="post" class="login__form">
         <h1 class="login__title">Giriş Yap</h1>
         <div class="login__content">
            <div class="login__box">
               <i class="ri-user-3-line login__icon"></i>
               <div class="login__box-input">
                  <input type="text" required class="login__input" id="admin" name="admin" placeholder=" ">
                  <label  class="login__label">Kullanıcı Adı</label>
               </div>
            </div>
            <div class="login__box">
               <i class="ri-lock-2-line login__icon"></i>
               <div class="login__box-input">
                  <input type="password" required class="login__input" id="sifre" name="sifre" placeholder=" ">
                  <label for="login-pass" class="login__label">Password</label>
                  <i class="ri-eye-off-line login__eye" id="login-eye"></i>
               </div>
            </div>
         </div>
         <button type="submit" class="login__button">Giriş Yap</button>
         <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
      </form>
   </div>
   <script src="assets/js/main.js"></script>
</body>
</html>



