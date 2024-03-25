<?php

session_start();
require_once("../../classes/signUpTopic.php");
//Sign up topic


$signUp = new SignUpTopic();
if (isset($_POST['ma_SV']) && $_POST['action'] == 'signUpTopic') {
    $dangky = $signUp->signUpTopic($_POST);
}


//Cancel topic

if (isset($_POST['action']) == "cancelTopic" && isset($_POST['ma_dangky'])) {
    $madk = $_POST['ma_dangky'];
    $signUp->cancelTopicSignUp($madk);
    if ($signUp) {
        echo "success";
    } else {
        echo "fail";
    }
}

// Add Group

if (isset($_POST['action']) == "addGroup" && isset($_POST['ma_SV']) && isset($_POST['nhom'])) {
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

// check member group