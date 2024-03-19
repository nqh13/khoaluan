<?php
require_once('database.php');
class detai
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllTopic()
    {
        $sql = "SELECT * FROM tbl_detai";
        $result = $this->db->select($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
        return $result;
    }
    public function getTopicById($id)
    {
        $sql = "SELECT * FROM tbl_detai WHERE id = '$id'";
        $result = $this->db->select($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
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

        $sql = "INSERT INTO `tbl_detai` (`ma_detai`, `tendetai`, `ma_GV`, `mota`, `yeucau`, `kienthuc`, `soluong_SV`) 
        VALUES (NULL, '$tendetai', '$ma_GV', '$mota ', '$yeucau', '$kienthuc', '$soluong_SV');";
        $insert = $this->db->insert($sql);
        if ($insert) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTopic($data, $id)
    {
        $tendetai = $data['tendetai'];
        $ma_GV = $data['ma_GV'];
        $mota = $data['mota'];
        $yeucau = $data['yeucau'];
        $kienthuc = $data['kienthuc'];
        $soluong_SV = $data['soluong_SV'];

        $sql = "UPDATE `tbl_detai` SET `tendetai` = '$tendetai', `mota` = '$mota', `yeucau` = '$yeucau',         
                `kienthuc` = '$kienthuc', `soluong_SV` = '$soluong_SV' WHERE `tbl_detai`.`ma_detai` = $id;";

        $update =  $this->db->update($sql);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteTopic($id)
    {
        $sql = "DELETE FROM `tbl_detai` WHERE `$id `";
        $delete = $this->db->delete($sql);
        if ($delete) {
            return true;
        } else {
            return false;
        }
    }
}
