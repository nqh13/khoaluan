<?php

session_start();
require_once("../../classes/user.php");

$user = new User();
var_dump($_POST);

if (isset($_POST['updateInfo'])) {


    $p = $user->updateUser($_SESSION['ma_nguoidung'], $_POST);
    if ($p) {
        echo '<script>alert("Cập nhật thành công")</script>';
    } else {
        echo '<script>alert("Lỗi cập nhật, vui lòng thử lại sau!")</script>';
    }
    header("location:./../index.php?page=thongtin");
}
