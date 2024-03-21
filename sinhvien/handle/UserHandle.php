<?php

session_start();
require_once("../../classes/user.php");


$user = new User();
// var_dump($_POST);

if (isset($_POST['updateInfo'])) {


    $p = $user->updateUser($_SESSION['ma_nguoidung'], $_POST);
    if ($p) {
        echo '<script>alert("Cập nhật thành công")</script>';
    } else {
        echo '<script>alert("Lỗi cập nhật, vui lòng thử lại sau!")</script>';
    }
    header("location:./../index.php?page=thongtin");
}


// change password


// $user = new User();
if (isset($_POST['action']) == 'changePassword') {
    $er = 0;
    $new_password = $_POST['newPassword'];
    $password = $_POST['password'];
    $ma_nguoidung = $_POST['id_user'];
    $checkpass = $user->checkPassword($ma_nguoidung, $password);
    if ($checkpass == true) {
        $changepass = $user->changePassword($ma_nguoidung, $new_password);
        var_dump($checkpass, "password");

        if ($changepass) {
            echo 'Đã đổi password';
        } else {
            echo 'lỗi';
            $er = 1;
        }
        return $er;
    } else {
        $er = -1;
        return $er;
    }
}
