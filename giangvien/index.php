 <?php
    session_start();

    if (!isset($_SESSION['ma_nguoidung']) || $_SESSION['vaitro'] != '2') {
        header('location: ../index.php');
    }

    require_once('./../classes/topic.php');
    $topic = new Topic();

    // if (isset($_POST['them'])) {
    //     $_POST['ma_GV'] = $_SESSION['ma_nguoidung'];
    //     $_POST['ma_nganh'] = $_SESSION['ma_nganh'];

    //     $topic->insertTopic($_POST);
    //     echo '<div>Đề tài đã được thêm</div>';
    //     header('location: index.php?page=danhsach');
    //     exit();
    // }

    if (isset($_POST['update']) && isset($_GET['id'])) {
        $id = $_GET['id'];
        $topic->updateTopic($_POST, $id);
        echo '<div>Đề tài đã được cập nhật</div>';
        header('location: index.php?page=danhsach');
        exit();
    }

    ?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <title>
         <?php
            $page = "danhsach";
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }
            switch ($page) {
                case 'danhsach':
                    echo ('Trang chủ');
                    break;
                case 'themdetai':
                    echo ('Thêm mới');
                    break;
                case 'capnhat':
                    echo ('Cập nhật');
                    break;
                case 'danhsachdk':
                    echo ('Danh sách');
                    break;

                case 'thaoluan':
                    echo ('Thảo luận');
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
                case 'baocao':
                    echo ("Báo cáo");
                    break;
                case 'danhgia':
                    echo ("Đánh giá");
                    break;
                case 'chitiet':
                    echo ("Đề tài");
                    break;
                case 'ctbaocao':
                    echo ("Chi tiết");
                    break;
                case 'updatebaocao':
                    echo ("Cập nhật");
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
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
         integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />


     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
         integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" href="./../Assets/css/style.css" />
 </head>

 <body>
     <?php

        include('./../includes/header.php');

        ?>
     <div class="container-fluid">
         <div class="row">

             <?php

                if (isset($_GET['page'])) {
                    $active = $_GET['page'];
                } else {
                    $active = "";
                }

                include("./../includes/sidebargv.php");

                ?>
             <!-- end side bar -->
             <div class="col-lg-10  col-md-10 col-sm-12  main">
                 <nav class="d-flex justify-content-between align-items-center" id="nav-search">
                     <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                         <li class="breadcrumb-item font-weight-bold text-primary">
                             <?php
                                switch ($page) {
                                    case 'danhsach':
                                        echo ('');
                                        break;
                                    case 'themdetai':
                                        echo ('Thêm mới');
                                        break;
                                    case 'capnhat':
                                        echo ('Cập nhật');
                                        break;
                                    case 'thaoluan':
                                        echo ('Thảo luận');
                                        break;
                                    case 'danhsachdk':
                                        echo ('Danh sách');
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
                                    case 'baocao':
                                        echo ("Báo cáo");
                                        break;
                                    case 'danhgia':
                                        echo ("Đánh giá ");
                                        break;
                                    case 'chitiet':
                                        echo ("Đề tài");
                                        break;
                                    case 'ctbaocao':
                                        echo ("Chi tiết báo cáo");
                                        break;
                                    case 'updatebaocao':
                                        echo ("Cập nhật báo cáo");
                                        break;
                                    default:
                                        echo "404 NOT FOUND! ";
                                        break;
                                }

                                ?>

                             </a></li>

                     </ol>
                     <form action="" class="d-flex mr-3">
                         <input class="form-control me-2" name="key" type="text" placeholder="search" required />
                         <button class="btn btn-primary mx-2" type="submit">
                             <i class="fa-solid fa-magnifying-glass" style="color: #ffffff"></i>
                         </button>
                     </form>

                 </nav>

                 <?php

                    switch ($page) {
                        case 'danhsach':
                            include("./Viewgv/danhsachdetai.php");
                            break;
                        case 'themdetai':
                            include("./Viewgv/themdetai.php");
                            break;
                        case 'capnhat':
                            include("./Viewgv/suadetai.php");
                            break;
                        case 'thaoluan':
                            include("./../pages/thaoluan.php");
                            break;
                        case 'danhsachdk':
                            include('./viewgv/danhsachdangki.php');
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
                        case 'danhgia':
                            include("./Viewgv/danhgia.php");
                            break;
                        case 'baocao':
                            include("./Viewgv/baocao.php");
                            break;
                        case 'chitiet':
                            include("./Viewgv/chitietdetai.php");
                            break;
                        case 'ctbaocao':
                            include("./Viewgv/report_detail.php");
                            break;
                        case 'updatebaocao':
                            include("./Viewgv/updatebaocao.php");
                            break;
                        default:
                            echo "<h3> 404 NOT FOUND! </h3> ";
                            break;
                    }

                    ?>
             </div>
         </div>



         <!-- Optional JavaScript -->
         <!-- jQuery first, then Popper.js, then Bootstrap JS -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
             integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
             crossorigin="anonymous">
         </script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
             integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
             crossorigin="anonymous">
         </script>
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
             integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
             crossorigin="anonymous">
         </script>
         <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


         <!-- Include jQuery library -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

         <script src="./../Assets/js/index.js"></script>

     </div>
     <?php
        include("./../includes/footer.php");

        ?>
 </body>

 </html>