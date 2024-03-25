<?php

include('./database.php');


class Group
{
    private $db;


    public function __construct()
    {

        $this->db = new Database();
    }


    public function getGroups($ma_detai)
    {
        $sql = "SELECT * 
        FROM tbl_dangkydetai 
        JOIN tbl_users ON tbl_dangkydetai.ma_SV = tbl_users.ma_nguoidung
        JOIN tbl_detai ON tbl_dangkydetai.ma_detai = tbl_detai.ma_detai 
        WHERE tbl_detai.ma_detai = :ma_detai";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':ma_detai', $ma_detai);
        $stmt->execute();
        return $stmt;
    }
}
