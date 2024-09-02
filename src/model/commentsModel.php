<?php
require_once('../../database/db.php');
class CommentsModel {
    private $db;

    function __construct() {
        $this->db = getConnection();
    }

    function stmtRes($id) {
        $stmt = $this->db->prepare("SELECT * FROM `comments` WHERE `message_id` = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res = ($stmt->get_result()->fetch_all(MYSQLI_ASSOC));
        return $res;
    }

    function view($comments) {
        foreach($comments as $comment) {
            echo "<hr>";
            $author = $comment['author'];
            $content = $comment['content'];
            echo "<h5>$author</h5>";
            echo $content;
        }
    }

    function count($id) {
        return mysqli_num_rows(mysqli_query($this->db, "SELECT * FROM `comments` WHERE `message_id` = $id"));
    }

    function addComment($author, $id, $content) {
        $stmt = $this->db->prepare("INSERT INTO `comments` (`author`, `message_id`, `content`) VALUES (?, ?, ?)");
        $stmt->bind_param('sis', $author, $id, $content);
        $stmt->execute();
    }
}