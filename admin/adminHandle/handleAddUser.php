<?php
session_start();
include('../../classes/user.php');
include('../../classes/majors.php');
include('../../utils/utility.php');



$u = new User();
$utils = new Utility();




if (isset($_POST['id_khoa'])) {
    $id_khoa = $_POST['id_khoa'];
    $m = new Majors();
    $majors = $m->getMajorByDepartment($id_khoa);


    $options = '';
    foreach ($majors as $major) {
        $options .= '<option value="' . $major['ma_nganh'] . '">' . $major['ten_nganh'] . '</option>';
    }

    echo $options;
}


// Xử lý thêm người dùng mới
// if (isset($_POST['action']) && $_POST['action'] == 'themUser') {


    
//     $file = $_FILES['file'];
//     $file_name = $_FILES['file']['name'];
//     $matkhau = $utils->randomPassword();

//     if ($_POST['manguoidung'] == "") {

//         $_POST['manguoidung'] =  $utils->randomIDUser();
//     }
//     var_dump($_POST);

//     $checkXSS = $utils->checkAtackXSS($_POST);
//     $checkCSRF = $utils->checkToken($_POST['tokenUser'], $_SESSION['session_token']);

//     $checkimg = $utils->checkImageFile($file);

    
//     if($checkCSRF == true){
//          if ($checkimg == true) {
//             $upload_dir = "../../Uploads";
//             $file_tmp = $_FILES['file']['tmp_name'];
//             if (move_uploaded_file($file_tmp, $upload_dir . '/' . $file['name'])) {
//             // $adduser = $u->addUser($checkXSS, $matkhau);
//             } 
//             else {
//                 echo "Lỗi, vui lòng thử lại sau!";
//             }
//         }
//         else{
//             echo $checkimg;
//         }
//     }
//     else{
//         echo "Lỗi xác thực!";
//     }
   

// }

if (isset($_POST['action']) && $_POST['action'] == 'themUser') {
    $manguoidung = $_POST['manguoidung'];
    if ($manguoidung == "") {
        $manguoidung =  $utils->randomIDUser();
    }
    $matkhau = $utils->randomPassword();
    // Kiểm tra XSS và CSRF trước khi xử lý
    $checkXSS = $utils->checkAtackXSS($_POST);
    $checkCSRF = $utils->checkToken($_POST['tokenUser'], $_SESSION['session_token']);

    if ($checkCSRF == true) {
        // Kiểm tra hình ảnh
        $file = $_FILES['file'];
        $checkimg = $utils->checkImageFile($file);
        if ($checkimg == true) {
            // Tải tệp lên nếu hợp lệ
            $upload_dir = "../../Uploads";
            $file_tmp = $_FILES['file']['tmp_name'];
            if (move_uploaded_file($file_tmp, $upload_dir . '/' . $file['name'])) {
                // Thêm người dùng
                
                $adduser = $u->addUser($manguoidung, $checkXSS, $matkhau);
                if ($adduser) {
                    echo "Tài khoản đăng nhập hệ thống.<br> Mã người dùng: " . $manguoidung . " - Mật khẩu: " . $matkhau;
                }
                else {
                    echo "Thêm tài khoản thất bại";
                }
                
            } else {
                // echo "upload ảnh thất bại!";
            }
        } else {
            echo $checkimg;
        }
    } else {
        echo "Lỗi xác thực!";
    }
}

// Đổi trạng thái người dùng:
if (isset($_POST['action']) && $_POST['action'] == 'changeStatusUser') {
    $checkCSRF = $utils->checkToken($_POST['tokenUser'], $_SESSION['session_token']);
    if($checkCSRF == true){
        $changeStatusUser = $u->changeStatusUser($_POST['ma_nguoidung'], $_POST['trangthai']);
        if ($changeStatusUser) {
            echo "Đã đổi trạng thái người dùng!";
        } else {
            echo "Lỗi, vui lòng thử lại sau!";
    }
    }
}
// Xử lý update thông tin người dùng
if (isset($_POST['action']) && $_POST['action'] == 'updateUser') {
    $file = array();
    $file_name = '';

    if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
        $file = $_FILES['file'];
    }
    $idUser = $_POST['id'];
    $checkXSS = $utils->checkAtackXSS($_POST);
    // var_dump($checkXSS);
    // var_dump($file);

    if (!empty($file)) {
        $checkimg = $utils->checkImageFile($file);
        if ($checkimg == true) {
            $upload_dir = "../../Uploads";
            $file_tmp = $_FILES['file']['tmp_name'];
            if (move_uploaded_file($file_tmp, $upload_dir . '/' . $file['name'])) {
                $updateUser = $u->updateUserInfoAdmin($idUser, $checkXSS, $file['name']);
                if ($updateUser) {
                    echo "Cập nhật thành công";
                } else {
                    echo "Cập nhật thất bại";
                }
            } else {
                echo "Upload thất bại";
            }
        } else {
            echo "Vui lòng chọn file ảnh!";
        }
    } else {
        $updateUser = $u->updateUserInfoAdmin($idUser, $checkXSS, $file_name);
        if ($updateUser) {
            echo "Cập nhật thành công!";
        } else {
            echo "Cập nhật thất bại!";
        }
    }
}
