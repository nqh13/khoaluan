<?php
session_start();
require_once('../classes/topic.php');
require_once('../classes/report.php');
require_once('../utils/utility.php');
require_once('../classes/comment.php');

$report = new Report();
$topic = new Topic();
$utils = new Utility();
$comment = new Comment();

// Delete Topic
if (isset($_POST['action']) == 'delete' && isset($_POST['id'])) {
    $id_topic = $_POST['id'];
    $delete = $topic->deleteTopic($id_topic);

    if ($delete) {
        echo "Xóa thành công";
    } else {
        echo "Xóa thất bại";
    }
}


//Handel Add Topic
if (isset($_POST['action']) && $_POST['action'] == 'addTopic') {

    $checkXSS = $utils->checkAtackXSS($_POST);
    $checkCSRF = $utils->checkToken($_POST['tokenUser'], $_SESSION['session_token']);
    if ($checkCSRF == true) {
        $add = $topic->insertTopic($checkXSS);
        if (!$add) {
            echo "Thêm thất bại";
        } else {
            echo "Thêm thành công";
        }
    } else {
        echo "Lỗi xác thực!";
    }
}

//Handle Updates Topic
if (isset($_POST['action']) && $_POST['action'] == 'updateTopic') {

    $checkCSRF = $utils->checkToken($_POST['tokenUser'], $_SESSION['session_token']);
    $id = $_POST['idTopic'];
    $checkXSS = $utils->checkAtackXSS($_POST);
    if ($checkCSRF == true) {
        $update = $topic->updateTopic($checkXSS, $id);
        if (!$update) {
            echo "Cập nhật thất bại";
        } else {
            echo "Cập nhật thành công";
        }
    } else {
        echo "Lỗi xác thực!";
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
    $button ="";

    if ($count == 0) {
        $students = '<tr>
            <td colspan="8" class="text-center "><b>Không có sinh viên đang đăng ký!</b></td>
        </tr>';
    }

    foreach ($data as $data) {
        if($data['trangthaidangky'] == 1){
                
            $button = ' <button class="btn btn-success btn-sm text-center" type="button" onclick="handleUpdateStatus(' . $data['ma_dangky'] . ',3)"> 
            <i class="fa fa-check mr-1"></i>Chấp nhận </button>';
        }
        else{
            $button = ' <button class="btn btn-danger btn-sm text-center" type="button" onclick="handleUpdateStatus(' . $data['ma_dangky'] . ',1)"> 
            <i class="fa fa-cancel mr-1"></i>Hủy Hướng Dẫn</button>';
        }
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
                <td class="text-center" style="width: 5%"> 
                    <a class="btn btn-primary" id="msg-item-2" rel="nofollow noopener" style="cursor: pointer; border-radius: 10%; " 
                    href="https://zalo.me/' . $data['sodienthoai'] . '" 
                    title="Zalo" target="_blank"><span  
                    style="background-color:#00AFF0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 460.1 436.6">
                    <path fill="currentColor" class="st0" 
                    d="M82.6 380.9c-1.8-.8-3.1-1.7-1-3.5 1.3-1 2.7-1.9 4.1-2.8 13.1-8.5 25.4-17.8 33.5-31.5 6.8-11.4 5.7-18.1-2.8-26.5C69 269.2 48.2 212.5 58.6 145.5 64.5 107.7 81.8 75 107 46.6c15.2-17.2 33.3-31.1 53.1-42.7 1.2-.7 2.9-.9 3.1-2.7-.4-1-1.1-.7-1.7-.7-33.7 0-67.4-.7-101 .2C28.3 1.7.5 26.6.6 62.3c.2 104.3 0 208.6 0 313 0 32.4 24.7 59.5 57 60.7 27.3 1.1 54.6.2 82 .1 2 .1 4 .2 6 .2H290c36 0 72 .2 108 0 33.4 0 60.5-27 60.5-60.3v-.6-58.5c0-1.4.5-2.9-.4-4.4-1.8.1-2.5 1.6-3.5 2.6-19.4 19.5-42.3 35.2-67.4 46.3-61.5 27.1-124.1 29-187.6 7.2-5.5-2-11.5-2.2-17.2-.8-8.4 2.1-16.7 4.6-25 7.1-24.4 7.6-49.3 11-74.8 6zm72.5-168.5c1.7-2.2 2.6-3.5 3.6-4.8 13.1-16.6 26.2-33.2 39.3-49.9 3.8-4.8 7.6-9.7 10-15.5 2.8-6.6-.2-12.8-7-15.2-3-.9-6.2-1.3-9.4-1.1-17.8-.1-35.7-.1-53.5 0-2.5 0-5 .3-7.4.9-5.6 1.4-9 7.1-7.6 12.8 1 3.8 4 6.8 7.8 7.7 2.4.6 4.9.9 7.4.8 10.8.1 21.7 0 32.5.1 1.2 0 2.7-.8 3.6 1-.9 1.2-1.8 2.4-2.7 3.5-15.5 19.6-30.9 39.3-46.4 58.9-3.8 4.9-5.8 10.3-3 16.3s8.5 7.1 14.3 7.5c4.6.3 9.3.1 14 .1 16.2 0 32.3.1 48.5-.1 8.6-.1 13.2-5.3 12.3-13.3-.7-6.3-5-9.6-13-9.7-14.1-.1-28.2 0-43.3 0zm116-52.6c-12.5-10.9-26.3-11.6-39.8-3.6-16.4 9.6-22.4 25.3-20.4 43.5 1.9 17 9.3 30.9 27.1 36.6 11.1 3.6 21.4 2.3 30.5-5.1 2.4-1.9 3.1-1.5 4.8.6 3.3 4.2 9 5.8 14 3.9 5-1.5 8.3-6.1 8.3-11.3.1-20 .2-40 0-60-.1-8-7.6-13.1-15.4-11.5-4.3.9-6.7 3.8-9.1 6.9zm69.3 37.1c-.4 25 20.3 43.9 46.3 41.3 23.9-2.4 39.4-20.3 38.6-45.6-.8-25-19.4-42.1-44.9-41.3-23.9.7-40.8 19.9-40 45.6zm-8.8-19.9c0-15.7.1-31.3 0-47 0-8-5.1-13-12.7-12.9-7.4.1-12.3 5.1-12.4 12.8-.1 4.7 0 9.3 0 14v79.5c0 6.2 3.8 11.6 8.8 12.9 6.9 1.9 14-2.2 15.8-9.1.3-1.2.5-2.4.4-3.7.2-15.5.1-31 .1-46.5z">
                    </path></svg></span><div class="arcu-item-label"><div class="arcu-item-title">
                    Zalo</div></div></a>
                </td>
                <td class="text-center" style="width: 5%">'.$button.'</td>
    </tr>';
    }

    echo $students;
}

//Xử lý trạng thái đăng ký.
if(isset($_POST['action']) && $_POST['action'] == 'updateStatusbyGV'){
    $changeStatus = $signUp->updateStatusSignUp($_POST);
    if($changeStatus){
        echo "Cập nhật thành công!";
    }
    else{
        echo "Lỗi, vui lòng thử lại sau!";
    }
    
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


// Tạo cuộc thảo luận mới.

if (isset($_POST['action']) && $_POST['action'] == 'createDiscussion') {

    $checkXSS = $utils->checkAtackXSS($_POST);
    $checkCSRF = $utils->checkToken($_POST['tokenUser'], $_SESSION['session_token']);
    if ($checkCSRF == true) {
        $createDiscussion = $comment->createDiscussion($checkXSS);
        if ($createDiscussion) {
            echo "Tạo thành công!";
        } else {
            echo "Lỗi, vui lòng thủ lại sau!";
        }
    } 
    else {
        echo "Lỗi xác thực!";
    }
}
//Tạo thảo luận không check CSRF
// if (isset($_POST['action']) && $_POST['action'] == 'createDiscussion') {

//     $checkXSS = $utils->checkAtackXSS($_POST); 
//         $createDiscussion = $comment->createDiscussion($checkXSS);
//         if ($createDiscussion) {
//             echo "Tạo thành công!";
//         } else {
//             echo "Lỗi, vui lòng thủ lại sau!";
//         }
// }
// Xử lý cập nhật cuộc thảo luận.

if (isset($_POST['action']) && $_POST['action'] == 'updateDiscussion') {
    $checkXSS = $utils->checkAtackXSS($_POST);
    $checkCSRF = $utils->checkToken($_POST['tokenUser'], $_SESSION['session_token']);
    if ($checkCSRF == true) {
        $updateDiscussion = $comment->updateDiscussion($checkXSS);
        if ($updateDiscussion) {
            echo "Cập nhật thành công!";
        } else {
            echo "Lỗi, vui bạn thủ lài sau!";
        }
    } else {
        echo "Lỗi xác thực!";
    }
}
