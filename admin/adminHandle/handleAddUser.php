<?php
include('../../classes/majors.php');

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
