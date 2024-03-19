<?php
require_once('database.php');

class Typetopic
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllType()
    {
        $sql = "SELECT * FROM tbl_loaidetai";
        $result = $this->db->select($sql);
        return $result;
    }
}
