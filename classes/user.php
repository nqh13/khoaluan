<?php
require_once("database.php");
class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($username, $password)
    {
        // Sử dụng Prepared Statement để ngăn chặn SQL Injection
        $sql = "SELECT * FROM tbl_users WHERE ma_nguoidung = :username AND matkhau = :password AND trangthai = '1' ";
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->db->prepare($sql);
        $hashed_password = md5($password); // Tạo một biến tham chiếu
        // Gắn giá trị cho các tham số
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);

        // Thực thi truy vấn
        $stmt->execute();

        // Lấy kết quả
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Trả về kết quả
        return $result;
    }
}
