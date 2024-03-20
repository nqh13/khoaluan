<?php

session_start();
require_once("../../classes/signUpTopic.php");
//Sign up topic


$signUp = new SignUpTopic();
if (isset($_POST['ma_SV']) && $_POST['action'] == 'signUpTopic') {
    $signUp->signUpTopic($_POST);
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
