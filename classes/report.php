<?php

require_once('database.php');

class Report
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    // Tạo báo cáo mới.
    public function createReport($data)
    {

        $sql = "INSERT INTO `tbl_baocao` (`detai`, `tieude`, `ngaytao`, `ngayhethan`, `ghichu`) VALUES (:detai, :tieude, :ngaytao, :ngayhethan, :ghichu)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':detai', $data['detai']);
        $stmt->bindParam(':tieude', $data['tieude']);
        $stmt->bindParam(':ngaytao', $data['ngaytao']);
        $stmt->bindParam(':ngayhethan', $data['ngayhethan']);
        $stmt->bindParam(':ghichu', $data['ghichu']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Lấy báo cáo theo mã đề tài:
    public function getReportByIdTopic($idTopic)
    {

        $sql = "SELECT * FROM `tbl_baocao` WHERE `detai` = :idTopic";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idTopic', $idTopic);
        $stmt->execute();
        return $stmt;
    }

    // Lấy báo cáo bằng mã báo cáo:

    public function getReportById($id)
    {

        $sql = "SELECT * FROM `tbl_baocao` WHERE `ma_baocao` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }
    // Cập nhật thông tin báo cáo:
    public function updateReport($data)
    {
        $sql = "UPDATE `tbl_baocao` SET `tieude` = :tieude, `ngaytao` = :ngaytao, `ngayhethan` = :ngayhethan, `ghichu` = :ghichu WHERE `ma_baocao` = :mabaocao";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':mabaocao', $data['ma_baocao']);
        $stmt->bindParam(':tieude', $data['tieude']);
        $stmt->bindParam(':ngaytao', $data['ngaytao']);
        $stmt->bindParam(':ngayhethan', $data['ngayhethan']);
        $stmt->bindParam(':ghichu', $data['ghichu']);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Xóa báo cáo:
    public function deleteReport($id)
    {
        $sql = "DELETE FROM `tbl_baocao` WHERE `ma_baocao` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
