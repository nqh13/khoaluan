<?php
session_start();
include('../../classes/user.php');
require_once('../../classes/semester.php');
require_once('../../utils/utility.php');
$semester = new Semester();
$utility = new Utility();
if (isset($_POST['vaitro'])) {
    $vaitro = $_POST['vaitro'];
    $u = new User();
    $dataUser = $u->filterForRole($vaitro);

    if (!empty($dataUser)) {
        echo "Thành công";
    } else {
        echo "Không thành công";
    }
}
// Xử lý thêm dữ liệu học kì.
if (isset($_POST['action']) && $_POST['action'] == "addSemester") {
    $checkXSS = $utility->checkAtackXSS($_POST);
    $checkCSRF = $utility->checkToken($_POST['tokenUser'], $_SESSION['session_token']);
    if ($checkCSRF == true) {
        $addSemester = $semester->addSemester($checkXSS);
        if ($addSemester) {
            echo "Thêm thành công!";
        } else {
            echo "Lỗi, vui lòng thử lại sau!";
        }
    } else {
        echo "Vui lòng xác thực lại!";
    }
}




// Xử lý cập nhật dữ liệu học kì.

if (isset($_POST['action']) && $_POST['action'] == "updateSemester") {
    $checkXSS = $utility->checkAtackXSS($_POST);
    $checkCSRF = $utility->checkToken($_POST['tokenUser'], $_SESSION['session_token']);
    if ($checkCSRF == true) {
        $dataSemester = $semester->updateSemester($checkXSS);
        if ($dataSemester) {
            echo "Cập nhật thành công!";
        } else {
            echo "Lỗi, vui lòng thử lại sau!";
        }
    } else {
        echo "Vui lòng xác thực lại!";
    }
}
