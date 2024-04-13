<?php
include('../../classes/user.php');

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
