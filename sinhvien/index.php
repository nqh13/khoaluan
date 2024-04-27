 <?php
    session_start();
    if (!isset($_SESSION['ma_nguoidung']) || $_SESSION['vaitro'] != '1') {
        header('location: ../index.php');
    }
    require_once('./../classes/signUpTopic.php');
    $sign = new SignUpTopic();
    $checkSignUp = $sign->checkSignUpTopic($_SESSION['ma_nguoidung'])->fetchAll(PDO::FETCH_ASSOC);


    ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <title>
         <?php
            $page = "danhsach";

            if ($checkSignUp) {
                $page = "detai";
            }

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }
            switch ($page) {
                case 'danhsach':
                    echo ('Trang chủ');
                    break;
                case 'detai':
                    echo ('Đề tài');
                    break;
                case 'baocao':
                    echo ('Báo cáo');
                    break;
                case 'nopbaocao':
                    echo ('Nộp báo cáo');
                    break;
                case 'thaoluan':
                    echo ('Thảo luận');
                    break;
                case 'chitietthaoluan':
                    echo ('Chi tiết');
                    break;
                case 'taothaoluan':
                    echo ('Tạo Thảo luận');
                    break;
                case 'diemso':
                    echo ('Điểm số');
                    break;
                case 'danhgia':
                    echo ('Đánh giá');
                    break;
                case 'doipass':
                    echo ("Đổi mật khẩu");
                    break;
                case 'doithongtin':
                    echo ("Đổi thông tin");
                    break;
                case 'thongtin':
                    echo ("Thông tin");
                    break;
                case 'thembai':
                    echo ("Nộp bài");
                    break;
                case 'timkiem':
                    echo ("Tìm kiếm");
                    break;

                default:
                    echo "404 NOT FOUND! ";
                    break;
            }
            ?>
     </title>
     <!-- Required meta tags -->
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <link rel="shortcut icon" href="../Uploads/icon65d669c1-0-e.ico" />


     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />


     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" href="./../Assets/css/style.css">
 </head>

 <body>
     <?php

        include('./../includes/header.php');

        ?>
     <div class="container-fluid">
         <div class="row">

             <?php
                include("./../includes/sidebar.php");

                ?>
             <!-- end side bar -->
             <div class="col-lg-10  col-md-10 col-sm-12  main">
                 <nav class="d-flex justify-content-between align-items-center" id="nav-search">
                     <ol class="breadcrumb">
                         <li class="breadcrumb-item  <?php if ($page == 'danhsach') {
                                                            echo 'font-weight-bold';
                                                        } ?>">
                             <a href="index.php">Home</a>
                         </li>
                         <li class="breadcrumb-item font-weight-bold text-primary">
                             <?php
                                switch ($page) {
                                    case 'danhsach':
                                        echo ('');
                                        break;
                                    case 'detai':
                                        echo ('Đề tài');
                                        break;
                                    case 'baocao':
                                        echo ('Báo cáo');
                                        break;
                                    case 'nopbaocao':
                                        echo ('Nộp báo cáo');
                                        break;
                                    case 'thaoluan':
                                        echo ('Thảo luận');
                                        break;
                                    case 'taothaoluan':
                                        echo ('Tạo Thảo luận');
                                        break;
                                    case 'chitietthaoluan':
                                        echo ('Chi tiết thảo luận');
                                        break;
                                    case 'diemso':
                                        echo ('Điểm số');
                                        break;
                                    case 'danhgia':
                                        echo ('Đánh giá');
                                        break;
                                    case 'doipass':
                                        echo ("Đổi mật khẩu");
                                        break;
                                    case 'doithongtin':
                                        echo ("Đổi thông tin");
                                        break;
                                    case 'thongtin':
                                        echo ("Thông tin");
                                        break;
                                    case 'thembai':
                                        echo ("Nộp bài");
                                        break;
                                    case 'timkiem':
                                        echo ("Tìm kiếm");
                                        break;

                                    default:
                                        echo "404 NOT FOUND! ";
                                        break;
                                }


                                ?>

                             </a></li>
                         <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                     </ol>
                     <form action="" method="GET" class="d-flex mr-3">
                         <input type="hidden" name="page" value="timkiem">
                         <input class="form-control me-2" name="key" type="text" placeholder="search" required />
                         <button class="btn btn-primary mx-2" type="submit">
                             <i class="fa-solid fa-magnifying-glass" style="color: #ffffff"></i>
                         </button>
                     </form>

                 </nav>

                 <?php

                    switch ($page) {
                        case 'danhsach':
                            include("./Viewsv/danhsach.php");
                            break;
                        case 'detai':
                            include("./Viewsv/detaidangky.php");
                            break;
                        case 'baocao':
                            include("./Viewsv/danhsachbaocao.php");
                            break;
                        case 'nopbaocao':
                            include("./Viewsv/infobaocao.php");
                            break;
                        case 'thaoluan':
                            include("./../pages/thaoluan.php");
                            break;
                        case 'taothaoluan':
                            include("./../pages/taothaoluan.php");
                            break;
                        case 'chitietthaoluan':
                            include("./../pages/chitietthaoluan.php");
                            break;
                        case 'diemso':
                            include("./Viewsv/diemso.php");
                            break;
                        case 'danhgia':
                            include("./Viewsv/danhgia.php");
                            break;
                        case 'doipass':
                            include("./../pages/doimatkhau.php");
                            break;
                        case 'doithongtin':
                            include("./../pages/doithongtin.php");
                            break;
                        case 'thongtin':
                            include("./../pages/user.php");
                            break;
                        case "thembai":
                            include("./Viewsv/nopbaocao.php");
                            break;
                        case 'timkiem':
                            include("./../pages/timkiem.php");
                            break;

                        default:
                            echo "<h3> 404 NOT FOUND! </h3> ";
                            break;
                    }

                    ?>
             </div>
         </div>


     </div>

     <?php
        include("../includes/footer.php");

        ?>


     <!-- Optional JavaScript -->

     <!-- Optional JavaScript -->
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
     </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
     </script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
     </script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


     <!-- Include jQuery library -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src='./../Assets/js/firebase.js' type="module"></script>
     <script src="./../Assets/js/index.js"></script>

     <!-- <script src="https://www.gstatic.com/firebasejs/5.4.0/firebase.js"></script> -->



 </body>

 </html>