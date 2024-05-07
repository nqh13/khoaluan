<?php
session_start();
require_once('../../classes/user.php');
require_once('../../classes/semester.php');
require_once('../../classes/department.php');
require_once('../../classes/majors.php');
require_once('../../utils/utility.php');

$department = new Department();
$semester = new Semester();
$major = new Majors();
$utility = new Utility();



//
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

// Xử lý thêm khoa viên mới.
if (isset($_POST['action']) && $_POST['action'] == "addDepartment") {
    $checkCSRF = $utility->checkToken($_POST['tokenUser'], $_SESSION['session_token']);
    $checkXSS = $utility->checkAtackXSS($_POST);
    // var_dump($checkXSS);

    if ($checkCSRF == true) {
        $addDepartment = $department->addDepartment($checkXSS);
        if ($addDepartment) {
            echo "Thêm thành công";
        } else {
            echo "Lỗi, vui lòng thử lại sau!";
        }
    } else {
        echo "Lỗi xác thực!";
    }
}

// Xử lý cập nhật thông tin khoa viên.
if (isset($_POST['action']) && $_POST['action'] == "updateDepartment") {
    //Kiểm tra form và dữ liệu.
    $checkCSRF = $utility->checkToken($_POST['tokenUser'], $_SESSION['session_token']);
    $checkXSS = $utility->checkAtackXSS($_POST);
    if ($checkCSRF == true) {
        $update = $department->updateDepartment($checkXSS);
        if ($update) {
            echo "Cập nhật thành công";
        } else {
            echo "Lỗi, vui lòng thử lại sau!";
        }
    } else {
        echo "Vui lòng xác thực lại!";
    }
}

// Xử lý thêm ngành học mới theo khoa.
if(isset($_POST['action']) && $_POST['action'] == "addMajor"){
    $checkCSRF = $utility->checkToken($_POST['tokenUser'], $_SESSION['session_token']);
    $checkXSS = $utility->checkAtackXSS($_POST);
    if ($checkCSRF == true) {
        $addMajor = $major->addMajor($checkXSS);
        if ($addMajor) {
            echo "Thêm thành công!";
        } else {
            echo "Lỗi, vui lòng thử lại sau!";
        }
    } else {
        echo "Vui lòng xác thực lại!";
    }
}

// Xử lý cập nhật thông tin ngành học.

if(isset($_POST['action']) && $_POST['action'] == "updateMajor"){
    $checkCSRF = $utility->checkToken($_POST['tokenUser'], $_SESSION['session_token']);
    $checkXSS = $utility->checkAtackXSS($_POST);
    if($checkCSRF == true){
        $updateMajor = $major->updateMajor($checkXSS);
        if($updateMajor){
            echo "Cập nhật thành công";
        }else{
            echo "Lỗi, vui lòng thử lại sau!";
        }
    }
    else{
        echo "Vui lòng xác thực lại!";
    }


}
