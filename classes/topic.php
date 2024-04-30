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

    // Get topic by id
    public function getTopicById($id)
    {
        $sql = "SELECT * FROM tbl_detai 
        INNER JOIN tbl_loaidetai ON tbl_detai.loaidetai = tbl_loaidetai.id_loai 
        INNER JOIN tbl_hocki ON tbl_detai.hocki = tbl_hocki.ma_hk
        WHERE ma_detai = :id";
        $result = $this->db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        return $result;
    }
    // Insert new topic
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
        $hocki = $data['hocki'];
        $sql = "INSERT INTO `tbl_detai` (`tendetai`,`loaidetai`, `ma_GV`, `mota`, `yeucau`, `kienthuc`, `soluong_SV`, `nganh`, `hocki`) 
                VALUES (:tendetai,:loaidetai ,:ma_GV, :mota, :yeucau, :kienthuc, :soluong_SV, :ma_nganh , :hocki)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tendetai', $tendetai);
        $stmt->bindParam(':loaidetai', $loaidetai);
        $stmt->bindParam(':ma_GV', $ma_GV);
        $stmt->bindParam(':mota', $mota);
        $stmt->bindParam(':yeucau', $yeucau);
        $stmt->bindParam(':kienthuc', $kienthuc);
        $stmt->bindParam(':soluong_SV', $soluong_SV);
        $stmt->bindParam(':ma_nganh', $ma_nganh);
        $stmt->bindParam(':hocki', $hocki);
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
        $soluong_SV = $data['soluong'];


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
        $sql = "SELECT * FROM tbl_detai JOIN tbl_users ON tbl_detai.ma_GV = tbl_users.ma_nguoidung 
        JOIN tbl_khoavien ON tbl_users.khoavien = tbl_khoavien.ma_khoavien 
        JOIN tbl_chuyennganh ON tbl_khoavien.ma_khoavien = tbl_chuyennganh.ma_nganh 
        JOIN tbl_loaidetai ON tbl_detai.loaidetai= tbl_loaidetai.id_loai
        JOIN tbl_hocki ON tbl_detai.hocki = tbl_hocki.ma_hk 
        WHERE tbl_detai.nganh = :ma_nganh AND  tbl_hocki.trangthai = 1";;
        $result = $this->db->prepare($sql);
        $result->bindParam(':ma_nganh', $ma_nganh);
        $result->execute();
        return $result;
    }

    // Search topics by key word and majors
    public function searchTopic($keyword, $ma_nganh)
    {
        $sql = 'SELECT * 
    FROM tbl_detai 
    JOIN tbl_users ON tbl_detai.ma_GV = tbl_users.ma_nguoidung 
    JOIN tbl_khoavien ON tbl_users.khoavien = tbl_khoavien.ma_khoavien 
    JOIN tbl_chuyennganh ON tbl_khoavien.ma_khoavien = tbl_chuyennganh.ma_nganh 
    JOIN tbl_loaidetai ON tbl_detai.loaidetai = tbl_loaidetai.id_loai 
    WHERE tbl_detai.nganh = :ma_nganh 
    AND (
        tbl_detai.tendetai LIKE :keyword OR
        tbl_detai.mota LIKE :keyword OR
        tbl_detai.yeucau LIKE :keyword OR
        tbl_detai.kienthuc LIKE :keyword
    )';
        $result = $this->db->prepare($sql);
        $result->bindParam(':ma_nganh', $ma_nganh);
        $keyword = "%$keyword%";
        $result->bindParam(':keyword', $keyword);
        $result->execute();
        return $result;
    }


    // Get all topics by  semester
    public function getTopicBySemester($ma_nganh, $id_semester)
    {
        $sql = 'SELECT * FROM tbl_detai JOIN tbl_users ON tbl_detai.ma_GV = tbl_users.ma_nguoidung 
        JOIN tbl_khoavien ON tbl_users.khoavien = tbl_khoavien.ma_khoavien 
        JOIN tbl_chuyennganh ON tbl_khoavien.ma_khoavien = tbl_chuyennganh.ma_nganh 
        JOIN tbl_loaidetai ON tbl_detai.loaidetai= tbl_loaidetai.id_loai 
        JOIN tbl_hocki ON tbl_detai.hocki = tbl_hocki.ma_hk WHERE tbl_detai.nganh = :ma_nganh AND tbl_hocki.ma_hk = :id_semester;';
        $result = $this->db->prepare($sql);
        $result->bindParam(':ma_nganh', $ma_nganh);
        $result->bindParam(':id_semester', $id_semester);
        $result->execute();
        return $result;
    }

    // Get all topics by  semester and ma_GV.
    public function getTopicBySemesterAndGV($id_semester, $ma_GV)
    {
        $sql = "SELECT  * FROM tbl_detai   
        INNER JOIN tbl_loaidetai ON tbl_detai.loaidetai = tbl_loaidetai.id_loai 
        INNER JOIN tbl_hocki ON tbl_detai.hocki = tbl_hocki.ma_hk
        WHERE tbl_detai.ma_GV = :id_gv AND tbl_detai.hocki = :id_semester;";
        $result = $this->db->prepare($sql);
        $result->bindParam(':id_gv', $ma_GV);
        $result->bindParam(':id_semester', $id_semester);
        $result->execute();
        return $result;
    }
}
