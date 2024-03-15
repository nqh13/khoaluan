<header>
    <div class="header">
        <a href="index.php"><img id="logo-header" src="./Uploads/Logo_IUH.png" alt="" style="height: 80px" /></a>
        <div class="" id="info-sv">
            <?php
      if (!isset($_SESSION['MaSV'])) {
        echo ('<a class="" href="login.php"> <i class="fa-solid fa-power-off icon-dropdown"></i>Đăng nhập</a>');
      } else {
        echo ('
        
        <div class="dropdown">
        <div class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa-regular fa-user"></i>
          <span>NGUYỄN QUANG HÀ</span>
        </div>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="?page=thongtin"><i class="fa-solid fa-user icon-dropdown"> </i>Thông
            tin sinh viên</a>
          <a class="dropdown-item" href="?page=login"> <i class="fa-solid fa-power-off icon-dropdown"></i>Đăng
            xuất</a>
        </div>
      </div>
        
        
        ');
      }
      ?>

        </div>
    </div>
</header>