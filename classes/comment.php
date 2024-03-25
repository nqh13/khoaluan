<?php
require_once(__DIR__ . './database.php');

class Comment
{
    private $db;

    public function __construct()
    {

        $this->db = new Database();
    }

    public function createDiscussion($data)
    {
        $stmt = $this->db->prepare('INSERT INTO tbl_thaoluan (ma_detai, ma_nguoitao, tieude, noidung) VALUES (:post_id, :user_id, :title, :content)');

        $stmt->bindParam(':post_id', $data['post_id']);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':content', $data['content']);

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
        $stmt = $this->db->prepare('SELECT * FROM tbl_thaoluan WHERE ma_cuocthaoluan = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
