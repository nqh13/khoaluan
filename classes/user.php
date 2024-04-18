<?php
require_once("database.php");
class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    //Login
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
    //Login admin

    public function loginAdmin($username, $password)
    {
        $sql = "SELECT * FROM tbl_quantrivien WHERE tendangnhap = :username AND matkhau = :password LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $hashed_password = md5($password);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result; // Trả về chỉ một mảng
        } else {
            return false;
        }
    }

    //Get all users

    public function getAllUsers()
    {
        $sql = "SELECT * FROM tbl_users 
                JOIN tbl_khoavien ON tbl_users.khoavien = tbl_khoavien.ma_khoavien 
                JOIN tbl_chuyennganh ON tbl_users.ma_nganh = tbl_chuyennganh.ma_nganh
                JOIN tbl_vaitro ON tbl_users.vaitro = tbl_vaitro.ma_vaitro 
                JOIN tbl_trangthaitk ON tbl_users.trangthai = tbl_trangthaitk.id_trangthaitk";

        $result = $this->db->select($sql);

        return $result;
    }

    //Get information user
    public function getUserInfo($id)
    {
        $sql = "SELECT * FROM tbl_users  
        JOIN tbl_khoavien ON tbl_users.khoavien = tbl_khoavien.ma_khoavien
        JOIN tbl_chuyennganh ON tbl_users.ma_nganh = tbl_chuyennganh.ma_nganh
        WHERE ma_nguoidung = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }
    // Check IDUser
    public function checkIDUser($id)
    {
        $sql = "SELECT * FROM tbl_users WHERE ma_nguoidung = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result !== false);
    }




    // Add new user
    public function  addUser($manguoidung, $hoten,  $email, $sodienthoai,  $diachi, $hinhanh, $password, $khoavien, $chuyennganh, $vaitro,)
    {
        // var_dump($manguoidung, $hoten,  $email, $sodienthoai,  $diachi, $hinhanh, $password, $khoavien, $chuyennganh, $vaitro);
        $hashed_password = md5($password);
        $sql = "INSERT INTO tbl_users (ma_nguoidung,hoten, email, sodienthoai, diachi, hinhanh, matkhau, khoavien, ma_nganh, vaitro) 
        VALUES (:manguoidung,:hoten, :email, :sodienthoai, :diachi, :hinhanh,:password, :khoavien, :chuyennganh, :vaitro)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':manguoidung', $manguoidung);
        $stmt->bindParam(':sodienthoai', $sodienthoai);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':diachi', $diachi);
        $stmt->bindParam(':hinhanh', $hinhanh);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':khoavien', $khoavien);
        $stmt->bindParam(':chuyennganh', $chuyennganh);
        $stmt->bindParam(':vaitro', $vaitro);
        $stmt->execute();
        echo 'username: ' . $manguoidung . ' password: ' . $password;
    }

    //Update information user

    public function updateUser($id, $data)
    {
        $sdt = $data['sdt'];
        $email = $data['email'];
        $diachi = $data['diachi'];

        $sql = "UPDATE `tbl_users` SET  `sodienthoai` = :sdt, `email` = :email, `diachi` = :diachi 
        WHERE `tbl_users`.`ma_nguoidung` = $id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':sdt', $sdt);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':diachi', $diachi);

        $stmt->execute();
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
    // Check Password old
    public function checkPassword($id, $password)
    {
        $sql = "SELECT * FROM tbl_users WHERE ma_nguoidung = :id AND matkhau = :password";
        $stmt = $this->db->prepare($sql);
        $hashed_password = md5($password);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        if ($result) {
            return $result['matkhau'] == md5($password);
        }
        return false;
    }





    //Change password
    public function changePassword($id, $password)
    {
        $hashed_password = md5($password);
        $sql = "UPDATE tbl_users SET matkhau = :password WHERE ma_nguoidung = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }


    // Get role.

    public function getRoles()
    {
        $sql = " SELECT *FROM tbl_vaitro ";
        $result = $this->db->select($sql);
        return $result;
    }
    // Search users by ma_nguoidung
    public function searchUserByID($ma_nguoidung)
    {
        $sql = "SELECT * FROM tbl_users 
        JOIN tbl_khoavien ON tbl_users.khoavien = tbl_khoavien.ma_khoavien 
        JOIN tbl_chuyennganh ON tbl_users.ma_nganh = tbl_chuyennganh.ma_nganh
        JOIN tbl_vaitro ON tbl_users.vaitro = tbl_vaitro.ma_vaitro 
        JOIN tbl_trangthaitk ON tbl_users.trangthai = tbl_trangthaitk.id_trangthaitk WHERE ma_nguoidung = :manguoidung";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':manguoidung', $ma_nguoidung);
        $stmt->execute();
        return $stmt;
    }

    /* Filter Users*/

    public function filterForRole($role)
    {
        $sql = "SELECT * FROM tbl_users 
        JOIN tbl_khoavien ON tbl_users.khoavien = tbl_khoavien.ma_khoavien 
        JOIN tbl_chuyennganh ON tbl_users.ma_nganh = tbl_chuyennganh.ma_nganh
        JOIN tbl_vaitro ON tbl_users.vaitro = tbl_vaitro.ma_vaitro 
        JOIN tbl_trangthaitk ON tbl_users.trangthai = tbl_trangthaitk.id_trangthaitk WHERE vaitro = :role";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        return $stmt;
    }

    /*End Filter */
}
