<?php

require_once('database.php');

class Majors
{

    private $db;

    public function __construct()
    {

        $this->db = new Database();
    }

    // Get all majors
    public function getMajors()
    {
        $query = "SELECT * FROM tbl_chuyennganh";
        $result = $this->db->select($query);
        return $result;
    }

    // Get major by Department ID
    public function getMajorByDepartment($id)
    {
        
        $query = "SELECT * FROM tbl_chuyennganh WHERE khoavien = :id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function countMajorByDepartment($id)
    {
        
        $query = "SELECT COUNT(*) as count FROM tbl_chuyennganh WHERE khoavien = :id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        
        return $statement;
    }

    // Add new major by department
    public function addMajor($data){
        $sql = "INSERT INTO tbl_chuyennganh(ten_nganh, khoavien) VALUES(:tenchuyennganh, :khoavien)";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(':tenchuyennganh', $data['ten_nganh']);
        $statement->bindParam(':khoavien', $data['khoavien']);
        $statement->execute();
        return $statement;
    }

    // Update major by ID
    public function updateMajor($data){
        $sql = "UPDATE tbl_chuyennganh SET ten_nganh = :tenchuyennganh WHERE ma_nganh = :id";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(':tenchuyennganh', $data['ten_nganh']);
        $statement->bindParam(':id', $data['id']);
        $statement->execute();
        return $statement;
    }
    
}
