<?php

require_once('database.php');

class SignUpTopic
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    // sign up topic

    public function signUpTopic($data)
    {
        $ma_SV = $data['ma_SV'];
        $ma_detai = $data['ma_detai'];
        $sql = "INSERT INTO `tbl_dangkydetai` (`ma_SV`, `ma_detai`) VALUES (:ma_SV, :ma_detai)";
        var_dump($ma_SV, $ma_detai, $sql);
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':ma_SV', $ma_SV);
        $stmt->bindParam(':ma_detai', $ma_detai);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // get topic sign up

    public function getTopicSignUp($ma_SV)
    {
        $sql = "SELECT * FROM tbl_dangkydetai 
        JOIN tbl_detai ON tbl_dangkydetai.ma_detai = tbl_detai.ma_detai
        JOIN tbl_users ON tbl_detai.ma_GV = tbl_users.ma_nguoidung 
        JOIN tbl_loaidetai ON tbl_detai.loaidetai = tbl_loaidetai.id_loai 
        JOIN tbl_trangthaidangky ON tbl_dangkydetai.trangthaidangky = tbl_trangthaidangky.ma_TTDK
        WHERE tbl_dangkydetai.ma_SV = :ma_SV";
        $result = $this->db->prepare($sql);
        $result->bindParam(':ma_SV', $ma_SV);
        $result->execute();
        return $result;
    }


    // Cancel topic sign up
    public function cancelTopicSignUp($id_dangky)
    {
        $sql = "DELETE FROM `tbl_dangkydetai` WHERE `ma_dangky` = :id_dangky";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_dangky', $id_dangky);
        $stmt->execute();
        return $stmt;
    }


    //Check sign up topic
    public function checkSignUpTopic($ma_SV)
    {
        $sql = "SELECT * FROM tbl_dangkydetai WHERE ma_SV = :ma_SV";
        $result = $this->db->prepare($sql);
        $result->bindParam(':ma_SV', $ma_SV);
        $result->execute();
        return $result;
    }

    //Count student sign up  a topic
    public function getCountSignUpTopic($ma_detai)
    {

        $sql = "SELECT ma_detai, COUNT(ma_SV) AS `Soluongdk` FROM tbl_dangkydetai WHERE ma_detai = :ma_detai";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(':ma_detai', $ma_detai);
        $statement->execute();

        return $statement;
    }
}
