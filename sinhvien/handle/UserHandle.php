<?php

session_start();
require_once("../../classes/user.php");
require_once("../../classes/report.php");
require_once("../../utils/utility.php");


$user = new User();
$utils = new Utility();
$report = new Report();


if (isset($_POST['action']) && $_POST['action'] == 'updateInfo') {

    $checkXSS = $utils->checkAtackXSS($_POST);
    // var_dump($checkXSS);

    // $id  = $_POST['id'];
    $p = $user->updateUser($_SESSION['ma_nguoidung'], $checkXSS);
    if ($p) {
        echo "Cập nhật thành công";
    } else {
        echo "Lỗi cập nhật, vui lòng thử lại sau!";
    }
}


// change password

if (isset($_POST['action']) && $_POST['action'] == 'changePassword') {
    $er = 0;
    $new_password = $_POST['newPassword'];
    $password = $_POST['password'];
    $ma_nguoidung = $_POST['id_user'];
    $checkpass = $user->checkPassword($ma_nguoidung, $password);
    if ($checkpass == true) {
        $changepass = $user->changePassword($ma_nguoidung, $new_password);
        if ($changepass) {
            echo 'Đã đổi password';
        } else {
            echo 'lỗi, vui lòng thử lại';
            $er = 1;
        }
        return $er;
    } else {
        $er = -1;
        return $er;
    }
}

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
