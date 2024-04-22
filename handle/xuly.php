<?php
require_once('../classes/topic.php');
require_once('../classes/report.php');

$report = new Report();
$topic = new Topic();

if (isset($_POST['action']) == 'delete' && isset($_POST['id'])) {
    $id_topic = $_POST['id'];
    $delete = $topic->deleteTopic($id_topic);

    if ($delete) {
        echo "Xóa thành công";
    } else {
        echo "Xóa thất bại";
    }
}



if (isset($_POST['action']) && $_POST['action'] == 'addTopic') {
    $add = $topic->insertTopic($_POST);
    if (!$add) {
        echo "Thêm thất bại";
    } else {
        echo "Thêm thành công";
    }
}

//Change PassWord

require_once('../classes/user.php');

$user = new User();
if (isset($_POST['changePass']) && isset($_POST['newpassword'])) {
}

//get data Students

require_once('../classes/signUpTopic.php');

$signUp = new SignUpTopic();
if (isset($_POST["action"]) && $_POST["action"] == "getDataStudentSignUp") {
    $id_topic = $_POST["id_topic"];
    $data  = $signUp->getStudent($id_topic);
    $count = $data->rowCount();
    $stt = 1;
    $students = '';

    if ($count == 0) {
        $students = '<tr>
            <td colspan="7" class="text-center "><b>Không có sinh viên đang đăng ký!</b></td>
        </tr>';
    }

    foreach ($data as $data) {
        $students .=
            '<tr>
                <td class="text-center" style="width: 5%">' . $stt++ . '</td>
                <td class="text-center" style="width: 5%">' . $data['ma_nguoidung'] . '</td>
                <td class="text-center" style="width: 10%">' . $data['hoten'] . '</td>
                <td class="text-center" style="width: 10%">
                ' . $data['sodienthoai'] . '
                </td>
                <td class="text-center" style="width: 10%">
                ' . $data['email'] . '
                </td>
                <td class="text-center" style="width: 5%">' . $data['nhom'] . '</td>
                <td style="width: 5%"> </td>
    </tr>';
    }

    echo $students;
}

// Tạo báo cáo.

if (isset($_POST['action'])  && $_POST['action'] == 'createReport') {

    $addReport = $report->createReport($_POST);

    if ($addReport) {

        echo "Tạo báo cáo thành công!";
    } else {

        echo "Vui lòng thử lại lai sau!";
    }
}

// Cập nhật thông tin báo cáo.
if (isset($_POST['action'])  && $_POST['action'] == 'updateInforReport') {
    // var_dump($_POST);
    $updateReport = $report->updateReport($_POST);

    if ($updateReport) {

        echo "Cập nhật thành công!";
    } else {

        echo "Vui lòng thử lại lai sau!";
    }
}

// Xóa báo cáo.
if (isset($_POST['action'])  && $_POST['action'] == 'deleteReport') {
    // var_dump($_POST);
    $id = $_POST['ma_baocao'];
    $deleteReport = $report->deleteReport($id);

    if ($deleteReport) {
        echo "Xóa thành công!";
    } else {

        echo "Vui lòng thử lại lai sau!";
    }
}
