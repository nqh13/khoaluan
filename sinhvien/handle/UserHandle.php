<?php

session_start();
require_once("../../classes/user.php");


$user = new User();


if (isset($_POST['action']) && $_POST['action'] == 'updateInfo') {

    // $id  = $_POST['id'];
    $p = $user->updateUser($_SESSION['ma_nguoidung'], $_POST);
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