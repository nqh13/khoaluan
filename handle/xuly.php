<?php
require_once('../classes/.php');
$topic = new Topic();

if (isset($_POST['action']) == 'delete' && isset($_POST['id'])) {
    $id_topic = $_POST['id'];
    $delete = $topic->deleteTopic($id_topic);
    var_dump($delete);
    if ($delete) {
        echo "Xóa thành công";
    } else {
        echo "Xóa thất bại";
    }
}

//Change PassWord

require_once('../classes/user.php');

$user = new User();
if (isset($_POST['changePass']) && isset($_POST['newpassword'])) {
}
