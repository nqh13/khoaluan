<?php
require_once('../../classes/user.php');
require_once('../../utils/utility.php');

$user = new User();
$utils = new Utility();

if (isset($_POST['checkedData']) && !empty($_POST['checkedData'])) {
    $checkedData = json_decode($_POST['checkedData'], true);
    $count = count($checkedData);

    // Kiểm tra user đã tồn tại trong cơ sở dữ liệu hay chưa
    if ($count > 0) {
        $existingUsers = [];
        foreach ($checkedData as $key => $userData) {
            $existingUser = $user->checkUserExist($userData['Manguoidung']);
            if ($existingUser) {
                // Nếu user đã tồn tại, thêm vào danh sách các user đã tồn tại
                $existingUsers[] = $userData['Manguoidung'];
                // Loại bỏ user này khỏi danh sách để không lưu vào cơ sở dữ liệu
                unset($checkedData[$key]);
            }
        }

        // Nếu có user đã tồn tại, thông báo cho người dùng
        if (!empty($existingUsers)) {
            echo "Người dùng đã tồn tại: " . implode(', ', $existingUsers) . ".\n";
        }

        // Xử lý lưu user vào cơ sở dữ liệu.
        foreach ($checkedData as $userData) {
            $user->importUserByExcel($userData);
        }

        echo "Đã thêm thành công " . count($checkedData) . " người dùng.";
    }
    else {
        echo "Vui lòng chọn người dùng!";
    }
}
