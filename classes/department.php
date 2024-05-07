<?php
require_once('database.php');

class Department
{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getDepartments()
    {
        $sql = "SELECT * FROM tbl_khoavien";
        $result = $this->db->select($sql);
        return $result;
    }

    public function getDepartmentById($id)
    {
        $sql = "SELECT * FROM tbl_khoavien WHERE ma_khoavien = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    // Add new department
    public function addDepartment($data)
    {
        $tenkhoavien = $data['tenkhoavien'];
        $sql = "INSERT INTO tbl_khoavien(ten_khoavien) VALUES(:tenkhoavien)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tenkhoavien', $tenkhoavien);
        $result = $stmt->execute();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    // Update department
    public function updateDepartment($data)
    {
        $tenkhoavien = $data['tenkhoavien'];
        $id = $data['id'];
        $sql = "UPDATE tbl_khoavien SET ten_khoavien = :tenkhoavien WHERE ma_khoavien = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tenkhoavien', $tenkhoavien);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    //
    public function getRoles()
    {
        $sql = " SELECT *FROM tbl_vaitro ";
        $result = $this->db->select($sql);
        return $result;
    }
}
