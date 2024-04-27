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

    // Thêm bài nộp cho báo cáo

    public function addDetailReport($data, $urlFile, $tenFile)
    {
        // Lấy thời gian hiện tại
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $thoigiannop = date("Y-m-d H:i:s");

        $sql = "INSERT INTO `tbl_chitietbaocao` (`ma_baocao`, `ma_sinhvien`, `thoigiannop`,`nhom`,`tenFile`, `Url_File`) 
        VALUES (:ma_baocao, :ma_sinhvien, :thoigiannop, :nhom, :tenFile, :Url_File);";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':ma_baocao', $data['ma_baocao']);
        $stmt->bindParam(':ma_sinhvien', $data['ma_nguoidung']);
        $stmt->bindParam(':nhom', $data['nhom']);
        $stmt->bindParam(':thoigiannop', $thoigiannop);
        $stmt->bindParam(':tenFile', $tenFile);
        $stmt->bindParam(':Url_File', $urlFile);

        // Thực hiện truy vấn
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Lấy thông tin chi tiết báo cáo bằng mã sinh viên và mã báo cáo

    public function getDetailReportById($ma_nguoidung, $ma_baocao)
    {
        $sql = "SELECT * FROM `tbl_chitietbaocao` WHERE `ma_sinhvien` = :ma_sinhvien AND `ma_baocao` = :ma_baocao";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':ma_baocao', $ma_baocao);
        $stmt->bindParam(':ma_sinhvien', $ma_nguoidung);
        $stmt->execute();
        return $stmt;
    }

    // Get list detail report by mabaocao
    public function getListDetailByReportID($ma_baocao)
    {
        $sql = "SELECT * FROM `tbl_chitietbaocao` 
        INNER JOIN `tbl_users` ON `tbl_chitietbaocao`.`ma_sinhvien` = `tbl_users`.`ma_nguoidung`
        INNER JOIN `tbl_baocao` ON `tbl_chitietbaocao`.`ma_baocao` = `tbl_baocao`.`ma_baocao`
        WHERE `tbl_chitietbaocao`.`ma_baocao` = :ma_baocao";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':ma_baocao', $ma_baocao);
        $stmt->execute();
        return $stmt;
    }
}
