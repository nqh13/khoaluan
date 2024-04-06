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
        $query = "SELECT * FROM tbl_chuyennganh WHERE khoavien = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
