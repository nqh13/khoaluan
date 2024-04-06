<?php
session_start();
if (!isset($_SESSION['vaitro']) && ($_SESSION['vaitro'] != 3)) {
    header('Location: login.php');
}
$pages = "dashboard";

if (isset($_GET['pages'])) {
    $pages = $_GET['pages'];
}



if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin</title>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/images/icon65d669c1-0-e.ico" type="image/x-icon" />
    <link rel="icon" href="assets/images/icon65d669c1-0-e.ico" type="image/x-icon" />


    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet" />

    <!-- themify -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css" />

    <!-- iconfont -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css" />

    <!-- simple line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/simple-line-icons/css/simple-line-icons.css" />

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap/css/bootstrap.min.css" />

    <!-- Chartlist chart css -->
    <link rel="stylesheet" href="assets/plugins/chartist/dist/chartist.css" type="text/css" media="all" />

    <!-- Weather css -->
    <link href="assets/css/svg-weather.css" rel="stylesheet" />

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css" />

    <!-- Responsive.css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" />
</head>

<body class="sidebar-mini fixed">
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <div class="wrapper">
        <!-- Navbar-->

        <?php


        include('./include/header_admin.php');

        ?>
        <!-- Side-Nav-->

        <?php

        include('./include/sidebar_admin.php');

        ?>
        <div class="content-wrapper">
            <!-- Container-fluid starts -->
            <!-- Main content starts -->
            <div class="container-fluid">
                <div class="row">
                    <div class="main-header">
                        <h4>Dashboard</h4>
                    </div>
                </div>

                <?php


                switch ($pages) {
                    case "dashboard":
                        include("./pages/dashboard.php");
                        break;
                    case "user":
                        include("./pages/quanlyUsers.php");
                        break;
                    case "addUser":
                        include("./pages/addUser.php");
                        break;
                }


                ?>


            </div>
            <!-- Main content ends -->
            <!-- Container-fluid ends -->

            <!-- Main content ends -->
            <!-- Container-fluid ends -->
        </div>
    </div>






    <!-- Required Jqurey -->
    <script src="assets/plugins/Jquery/dist/jquery.min.js"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/plugins/tether/dist/js/tether.min.js"></script>

    <!-- Required Fremwork -->
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Scrollbar JS-->
    <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js"></script>

    <!--classic JS-->
    <script src="assets/plugins/classie/classie.js"></script>

    <!-- notification -->
    <script src="assets/plugins/notification/js/bootstrap-growl.min.js"></script>

    <!-- Sparkline charts -->
    <script src="assets/plugins/jquery-sparkline/dist/jquery.sparkline.js"></script>

    <!-- Counter js  -->
    <script src="assets/plugins/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/plugins/countdown/js/jquery.counterup.js"></script>

    <!-- Echart js -->
    <script src="assets/plugins/charts/echarts/js/echarts-all.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>

    <!-- custom js -->
    <script type="text/javascript" src="assets/js/main.min.js"></script>
    <script type="text/javascript" src="assets/pages/dashboard.js"></script>
    <script type="text/javascript" src="assets/pages/elements.js"></script>
    <script src="assets/js/menu.min.js"></script>
    <script>
        var $window = $(window);
        var nav = $(".fixed-button");
        $window.scroll(function() {
            if ($window.scrollTop() >= 200) {
                nav.addClass("active");
            } else {
                nav.removeClass("active");
            }
        });


        //
        $(document).ready(function() {
            $('#id_khoa').change(function() {
                var id_khoa = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "./adminHandle/handleAddUser.php",
                    data: {
                        id_khoa: id_khoa
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#id_nganh').html(data);
                    }
                });

            });
        });
    </script>




</body>

</html>