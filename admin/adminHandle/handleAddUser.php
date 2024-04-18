<?php
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



if (isset($_POST['action']) && $_POST['action'] == 'themUser') {


    $manguoidung = $_POST['manguoidung'];
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $vaitro = $_POST['vaitro'];
    $id_nganh = $_POST['nganh'];
    $id_khoa = $_POST['khoa'];
    $file = $_FILES['file'];
    $file_name = $_FILES['file']['name'];
    $matkhau = $utils->randomPassword();

    if ($manguoidung == "") {

        $manguoidung =  $utils->randomIDUser();
    }

    $checkXSS = $utils->checkXSS($hoten, $email, $sdt, $diachi, $vaitro, $id_nganh, $id_khoa);
    $checkimg = $utils->checkImageFile($file);
    if ($checkimg == true) {
        $upload_dir = "../../Uploads";

        $file_tmp = $_FILES['file']['tmp_name'];
        if (move_uploaded_file($file_tmp, $upload_dir . '/' . $file['name'])) {
            // echo "Upload thành công-";
        } else {
            // echo "Upload thất bại";
        }
    }

    $u->addUser($manguoidung, $hoten, $email, $sdt, $diachi, $file_name, $matkhau, $id_khoa, $id_nganh, $vaitro);
}
