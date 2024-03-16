<?php
session_start();



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
            case 'detai':
                echo ('Đề tài');
                break;
            case 'baocao':
                echo ('Báo cáo');
                break;
            case 'thaoluan':
                echo ('Thảo luận');
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

            default:
                echo "404 NOT FOUND! ";
                break;
        }
        ?>
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Assets/css/style.css" />
</head>

<body>
    <?php

    include('./Views/includes/header.php');

    ?>
    <div class="container-fluid">
        <div class="row">

            <?php
            include("./Views/includes/sidebar.php");

            ?>
            <!-- end side bar -->
            <div class="col-lg-10  col-md-10 col-sm-12  main">
                <nav class="d-flex justify-content-between align-items-center" id="nav-search">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Sinh vien</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
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
                        include("./Views/sinhvien/danhsach.php");
                        break;
                    case 'detai':
                        include("./Views/sinhvien/detaidangky.php");
                        break;
                    case 'baocao':
                        include("./Views/sinhvien/baocao.php");
                        break;
                    case 'thaoluan':
                        include("./Views/sinhvien/thaoluan.php");
                        break;
                    case 'diemso':
                        include("./Views/sinhvien/diemso.php");
                        break;
                    case 'danhgia':
                        include("./Views/sinhvien/danhgia.php");
                        break;
                    case 'doipass':
                        include("./Views/sinhvien/doimatkhau.php");
                        break;
                    case 'doithongtin':
                        include("./Views/sinhvien/doithongtin.php");
                        break;
                    case 'thongtin':
                        include("./Views/sinhvien/user.php");
                        break;
                    case "thembai":
                        include("./Views/sinhvien/nopbaocao.php");
                        break;

                    default:
                        echo "<h3> 404 NOT FOUND! </h3> ";
                        break;
                }

                ?>
            </div>
        </div>


        <?php
        include("./Views/includes/footer.php");

        ?>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>

        <script src="../../Assets/js/index.js"></script>
    </div>
</body>

</html>