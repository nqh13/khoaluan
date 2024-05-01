<?php

session_start();
require_once("../../classes/user.php");
require_once("../../classes/report.php");
require_once("../../utils/utility.php");


$user = new User();
$utils = new Utility();
$report = new Report();


// Handle update information user
if (isset($_POST['action']) && $_POST['action'] == 'updateInfo') {

    $checkXSS = $utils->checkAtackXSS($_POST);
    $checktoken = $utils->checkToken($_POST['sessionUser'], $_SESSION['session_token']);

    if ($checktoken == true) {
        $p = $user->updateUser($_SESSION['ma_nguoidung'], $checkXSS);
        if ($p) {
            echo "Cập nhật thành công";
        } else {
            echo "Lỗi cập nhật, vui lòng thử lại sau!";
        }
    } else {
        echo "Vui lòng xác thực lại!";
    }
}




// Xử lý đổi mật khẩu.

if (isset($_POST['action']) && $_POST['action'] == 'changePassword') {
    $new_password = $_POST['newPassword'];
    $password = $_POST['password'];
    $ma_nguoidung = $_POST['id_user'];
    $checktoken = $utils->checkToken($_POST['tokenUser'], $_SESSION['session_token']);
    if ($checktoken == true) {
        $checkpass = $user->checkPassword($ma_nguoidung, $password);
        if ($checkpass == true) {
            $changepass = $user->changePassword($ma_nguoidung, $new_password);
            if ($changepass) {
                echo 'Đã đổi mật khẩu';
            } else {
                echo 'lỗi, vui lòng thử lại';
            }
        } else {
            echo "Mật khẩu cũ không đúng!";
        }
    } else {
        echo "Vui lòng xác thực lại!";
    }
}


//Thêm bài nộp cho báo cáo.
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "addDetailReport") {
    // Kiểm tra xem có dữ liệu tệp được gửi không
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {

        $checkFile = $utils->checkFileUpload($_FILES["file"]);

        if ($checkFile == true) {

            $upload_dir = "../../file_Upload";
            $file_tmp = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $urlFile = $upload_dir . '/' . $_FILES['file']['name'];

            if (move_uploaded_file($file_tmp, $urlFile)) {
                $addDetailReport = $report->addDetailReport($_POST, $urlFile, $fileName);
                if ($addDetailReport) {
                    echo "Đã nộp bào cáo!";
                } else {
                    echo "Nộp thất bại, vui lòng thử lại sau!";
                }
            } else {
                echo "Upload thất bại";
            }
        } else {
            echo $checkFile;
        }
    } else {
        echo "Lỗi tải file";
    }
}

// Sửa bài nộp báo cáo.