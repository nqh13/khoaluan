<?php
require_once('database.php');

class Topic
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllTopic()
    {
        $sql = "SELECT * FROM tbl_detai, tbl_loaidetai WHERE tbl_detai.loaidetai = tbl_loaidetai.id_loai";
        $result = $this->db->select($sql);
        return $result;
    }

    public function getTopicByGV($id_gv)
    {
        $sql = "SELECT  * FROM tbl_detai   INNER JOIN tbl_loaidetai ON tbl_detai.loaidetai = tbl_loaidetai.id_loai WHERE tbl_detai.ma_GV = :id_gv";
        $result = $this->db->prepare($sql);
        $result->bindParam(':id_gv', $id_gv);
        $result->execute();
        return $result;
    }

    public function getTopicById($id)
    {
        $sql = "SELECT * FROM tbl_detai INNER JOIN tbl_loaidetai ON tbl_detai.loaidetai = tbl_loaidetai.id_loai WHERE ma_detai = :id";
        $result = $this->db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        return $result;
    }

    public function insertTopic($data)
    {
        $tendetai = $data['tendetai'];
        $ma_GV = $data['ma_GV'];
        $mota = $data['mota'];
        $yeucau = $data['yeucau'];
        $kienthuc = $data['kienthuc'];
        $soluong_SV = $data['soluong_SV'];
        $loaidetai = $data['loai'];
        $ma_nganh = $data['ma_nganh'];
        $sql = "INSERT INTO `tbl_detai` (`tendetai`,`loaidetai`, `ma_GV`, `mota`, `yeucau`, `kienthuc`, `soluong_SV`, `nganh`) 
                VALUES (:tendetai,:loaidetai ,:ma_GV, :mota, :yeucau, :kienthuc, :soluong_SV, :ma_nganh)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tendetai', $tendetai);
        $stmt->bindParam(':loaidetai', $loaidetai);
        $stmt->bindParam(':ma_GV', $ma_GV);
        $stmt->bindParam(':mota', $mota);
        $stmt->bindParam(':yeucau', $yeucau);
        $stmt->bindParam(':kienthuc', $kienthuc);
        $stmt->bindParam(':soluong_SV', $soluong_SV);
        $stmt->bindParam(':ma_nganh', $ma_nganh);
        $stmt->execute();

        return $stmt;
    }

    public function updateTopic($data, $id)
    {
        $tendetai = $data['tendetai'];
        $mota = $data['mota'];
        $yeucau = $data['yeucau'];
        $kienthuc = $data['kienthuc'];
        $loaidetai = $data['loai'];
        $soluong_SV = $data['soluong_SV'];


        $sql = "UPDATE `tbl_detai` 
                SET `tendetai` = :tendetai, `loaidetai` = :loaidetai, `mota` = :mota, `yeucau` = :yeucau, `kienthuc` = :kienthuc, `soluong_SV` = :soluong_SV 
                WHERE `ma_detai` = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tendetai', $tendetai);
        $stmt->bindParam(':loaidetai', $loaidetai);
        $stmt->bindParam(':mota', $mota);
        $stmt->bindParam(':yeucau', $yeucau);
        $stmt->bindParam(':kienthuc', $kienthuc);
        $stmt->bindParam(':soluong_SV', $soluong_SV);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    public function deleteTopic($id)
    {
        $sql = "DELETE FROM `tbl_detai` WHERE `ma_detai` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }
    // Get topic to student


    public function getTopicByStudent($ma_nganh)
    {
        $sql = "SELECT * FROM tbl_detai JOIN tbl_users ON tbl_detai.ma_GV = tbl_users.ma_nguoidung JOIN tbl_khoavien ON tbl_users.khoavien = tbl_khoavien.ma_khoavien JOIN tbl_chuyennganh ON tbl_khoavien.ma_khoavien = tbl_chuyennganh.ma_nganh JOIN tbl_loaidetai ON tbl_detai.loaidetai= tbl_loaidetai.id_loai WHERE tbl_detai.nganh = tbl_chuyennganh.ma_nganh AND tbl_chuyennganh.ma_nganh = :ma_nganh";
        $result = $this->db->prepare($sql);
        $result->bindParam(':ma_nganh', $ma_nganh);
        $result->execute();
        return $result;
    }

    // Get topic to student

}
