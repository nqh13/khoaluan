<?php

session_start();
require_once("../../classes/signUpTopic.php");
//Sign up topic


$signUp = new SignUpTopic();

if (isset($_POST['ma_SV']) && $_POST['action'] && $_POST['action'] == 'signUpTopic') {
    $dangky = $signUp->signUpTopic($_POST);

    if (!$dangky) {
        echo "Vui lòng thử lại sau!";
    } else {

        echo "Đăng ký thành công!";
    }
}


//Cancel topic

if (isset($_POST['action']) && $_POST['action'] == "cancelTopic" && isset($_POST['ma_dangky'])) {
    $madk = $_POST['ma_dangky'];
    $signUp->cancelTopicSignUp($madk);
    if ($signUp) {
        echo "success";
    } else {
        echo "fail";
    }
}

// Add Group

if (isset($_POST['action']) && $_POST['action'] == "addGroup" && isset($_POST['ma_SV']) && isset($_POST['nhom'])) {
    $ma_SV = $_POST['ma_SV'];
    $nhom = $_POST['nhom'];

    $checkQuality = $signUp->checkQualityStudent($nhom);
    if ($checkQuality < 2) {
        $signUp->updateGroup($ma_SV, $nhom);
        if ($signUp) {
            echo "Lập nhóm thành công!";
        } else {
            echo "Lỗi, vui lòng thủ lại sau!";
        }
    } else {
        echo "Nhóm đã đủ số lượng!";
    }
}

// Cancel Group 

if (isset($_POST['action']) && $_POST['action'] == "cancelGroup" && isset($_POST['ma_SV']) && isset($_POST['ma_detai'])) {
    
    $cancelGroup = $signUp->cancelGroup($_POST);
    if ($cancelGroup) {
        echo "Hủy nhóm thành công!";
    } else {
        echo "Lỗi, vui lòng thử lại sau!";
    }
}