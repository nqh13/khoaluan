<?php
require_once("database.php");

class Semester
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all semesters
    public function getAllSemesters()
    {

        $sql = "SELECT * FROM tbl_hocki";
        $result = $this->db->select($sql);
        return $result;
    }


    // Get semester by id
    public function getSemesterById($id)
    {
        $sql = "SELECT * FROM tbl_hocki WHERE ma_hocki = :id";
        $result = $this->db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        return $result;
    }

    //get semester by status = true.
    public function getSemesterByStatus($status)
    {
        $sql = "SELECT * FROM tbl_hocki WHERE trangthai = :status";
        $result = $this->db->prepare($sql);
        $result->bindParam(':status', $status);
        $result->execute();
        return $result;
    }

    // Add a new semester
    public function addSemester($data)
    {
        $tenhocki = $data['tenhocki'];
        $trangthai = $data['trangthai'];
        $sql = "INSERT INTO tbl_hocki (tenhocki, trangthai) VALUES (:name_semester, :trangthai)";
        $result = $this->db->prepare($sql);
        $result->bindParam(':name_semester', $tenhocki);
        $result->bindParam(':trangthai', $trangthai);
        $result->execute();
        return $result;
    }

    // Update a semester
    public function updateSemester($data)
    {
        $ma_hk = $data['ma_hk'];
        $tenhocki = $data['tenhocki'];
        $trangthia = $data['trangthai'];

        $sql = "UPDATE tbl_hocki SET tenhocki = :name_semester, trangthai = :trangthai  WHERE ma_hk = :id";
        $result = $this->db->prepare($sql);
        $result->bindParam(':name_semester', $tenhocki);
        $result->bindParam(':trangthai', $trangthia);
        $result->bindParam(':id', $ma_hk);
        $result->execute();
        return $result;
    }

    // Delete a semester
    public function deleteSemester($id)
    {
        $sql = "DELETE FROM tbl_hocki WHERE ma_hocki = :id";
        $result = $this->db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        return $result;
    }
}
