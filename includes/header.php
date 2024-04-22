<?php
$currentTime = time();
$loginTime = $_SESSION['login_time'];

// echo "thời gian sử dụng" .  $currentTime - $loginTime;


if (isset($_GET['action']) == "logout") {
  session_destroy();
  setcookie('ma_nguoidung', $uses['ma_nguoidung'], time() - 3600, "/");
  header('location: ../index.php');
}



if (isset($_SESSION['login_time']) && $currentTime - $loginTime > 3600) {
  session_destroy();
  setcookie('ma_nguoidung', $uses['ma_nguoidung'], time() - 3600, "/");
  header('location: ../index.php');
  exit;
}







?>

<header>
  <div class="header">
    <a href="index.php"><img id="logo-header" src="./../Uploads/Logo_IUH.png" alt="" style="height: 80px" /></a>
    <div class="" id="info-sv">
      <?php
      if (!isset($_SESSION['ma_nguoidung'])) {
        echo ('<a class="" href="login.php"> <i class="fa-solid fa-power-off icon-dropdown"></i>Đăng nhập</a>');
      } else {
        echo ('
        
        <div class="dropdown">
        <div class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa-regular fa-user"></i>
          <span> ' . $_SESSION['hoten'] . ' </span>
        </div>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="?page=thongtin"><i class="fa-solid fa-user icon-dropdown"> 
          </i>Hồ sơ cá nhân</a>
          <a class="dropdown-item" href="index.php?action=logout"> <i class="fa-solid fa-power-off icon-dropdown"></i>Đăng
            xuất</a>
        </div>
      </div>
        
        
        ');
      }
      ?>

    </div>
  </div>
</header>