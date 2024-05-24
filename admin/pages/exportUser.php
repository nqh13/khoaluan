<?php
require '../../simplexlsxgen-master/src/SimpleXLSXGen.php';
require_once('../../classes/user.php');

$user = new User();

if (isset($_POST['exportUserFilter']) &&  isset($_POST['user_role']) && $_POST['user_role'] != '') {
   $role = $_POST['user_role'];
   $dataUser = $user->filterForRole($role);
   $result =  $dataUser->fetchAll(PDO::FETCH_ASSOC);   
}
else{
    
    $dataUser = $user->getAllUsers();
    $result = $dataUser->fetchAll(PDO::FETCH_ASSOC); 
}

 
// var_dump($result);

if (count($result) > 0) {
    // Chuyển đổi dữ liệu sang UTF-8 nếu cần thiết
    $outputArray = [];
    $header = ['Mã người dùng', 'Tên người dùng', 'Email', 'Số điện thoại', 'Địa chỉ', 'Khoa', 'Ngành', 'Vai trò'];
    array_push($outputArray, $header);

    foreach ($result as $row) {
        $rowArray = [
            $row['ma_nguoidung'],
            $row['hoten'],
            $row['email'],
            $row['sodienthoai'],
            $row['diachi'],
            $row['ten_khoavien'],
            $row['ten_nganh'],
            $row['tenvaitro']
        ];
        array_push($outputArray, $rowArray);
    }

    // Tạo đối tượng SimpleXLSXGen và xuất dữ liệu ra file Excel
    $xlsx = Shuchkin\SimpleXLSXGen::fromArray($outputArray);

    // Đặt tên file và headers cho trình duyệt để tải về
    $filename = 'users_' . time() . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Xuất file Excel ra trình duyệt
    $xlsx->saveAs('php://output');
    exit;
} else {
    echo "No data!";
}
?>
