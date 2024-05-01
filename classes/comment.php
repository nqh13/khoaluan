<?php
require_once(__DIR__ . './database.php');

class Comment
{
    private $db;

    public function __construct()
    {

        $this->db = new Database();
    }
    // Create Discussion
    public function createDiscussion($data)
    {
        $stmt = $this->db->prepare('INSERT INTO tbl_thaoluan (ma_detai, ma_nguoitao, tieude, noidung) VALUES (:madetai, :nguoitao, :tieude, :noidung)');

        $stmt->bindParam(':madetai', $data['madetai']);
        $stmt->bindParam(':nguoitao', $data['ma_nguoidung']);
        $stmt->bindParam(':tieude', $data['tieude']);
        $stmt->bindParam(':noidung', $data['noidung']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getAllDiscussion()
    {
        $stmt = $this->db->prepare('SELECT * FROM tbl_thaoluan');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getDiscussionById($id)
    {
        $sql = "SELECT * FROM tbl_thaoluan 
        JOIN tbl_detai ON tbl_thaoluan.ma_detai = tbl_detai.ma_detai
        JOIN tbl_users ON tbl_thaoluan.ma_nguoitao = tbl_users.ma_nguoidung
        WHERE tbl_thaoluan.ma_cuocthaoluan = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Get Discussion by ID Topic
    public function getDiscussionByTopicId($id)
    {
        $sql = "SELECT * FROM tbl_thaoluan 
        JOIN tbl_detai ON tbl_thaoluan.ma_detai = tbl_detai.ma_detai
        JOIN tbl_users ON tbl_thaoluan.ma_nguoitao = tbl_users.ma_nguoidung
        WHERE tbl_thaoluan.ma_detai = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Get info discussion 

    public function getInfoDiscussion($manguoidung)
    {
        $sql = "SELECT * FROM tbl_thaoluan JOIN tbl_detai ON tbl_thaoluan.ma_detai = tbl_detai.ma_detai 
        JOIN tbl_users ON tbl_thaoluan.ma_nguoitao = tbl_users.ma_nguoidung WHERE tbl_thaoluan.ma_nguoitao = :manguoidung";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':manguoidung', $manguoidung);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Check Discussion of User
    public function checkDiscussion($mathaoluan, $manguoidung)
    {
        $sql = "SELECT * FROM tbl_thaoluan WHERE ma_nguoitao = :manguoidung AND ma_cuocthaoluan = :mathaoluan";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':manguoidung', $manguoidung);
        $stmt->bindParam(':mathaoluan', $mathaoluan);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    // Update Discussion
    public function updateDiscussion($data)
    {
        $sql = "UPDATE tbl_thaoluan SET tieude = :tieude, noidung = :noidung WHERE ma_cuocthaoluan = :mathaoluan";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tieude', $data['tieude']);
        $stmt->bindParam(':noidung', $data['noidung']);
        $stmt->bindParam(':mathaoluan', $data['mathaoluan']);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
