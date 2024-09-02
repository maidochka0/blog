<?php
require_once('../../database/db.php');
class MessagesModel {
    private $db;

    public function __construct($connection = '') {
        $connection = getConnection();
        $this->db = $connection;
    }

    public function viewAllMessages($limit, $offset) {
        $stmt = $this->db->prepare("SELECT * FROM `messages` LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $open_button = '';
        foreach($res as $message) {
            echo "<h3>" . $message['title'] . '</h3>';
            $summary = mb_substr($message['content'], 0, 25);
            if ($summary !== $message['content']) {
                $summary = $summary . '...';
            }
            $id = $message['id'];
            $open_button = "<a href='./single_message_page.php?id=$id'>открыть</a>";
            echo $summary . $open_button;
            echo '<hr>';
        }
    }
    
    public function count() {
        return mysqli_num_rows(mysqli_query($this->db, "SELECT * FROM `messages`"));
    }

    public function title($stmtRes) {
        return $stmtRes['title'];
    }

    public function author($stmtRes) {
        return $stmtRes['author'];
    }

    public function content($stmtRes) {
        return $stmtRes['content'];
    }

    public function stmtRes($id) {
        $stmt = $this->db->prepare("SELECT * FROM `messages` WHERE `id` = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res = ($stmt->get_result()->fetch_all(MYSQLI_ASSOC))[0];
        return $res;
    }

    public function redactTitle($id, $title) {
        $stmt = $this->db->prepare("UPDATE `messages` SET `title` = ? WHERE `messages` . `id` = ?");
        $stmt->bind_param('si', $title, $id);
        $stmt->execute();
    }

    public function redactContent($id, $content) {
        $stmt = $this->db->prepare("UPDATE `messages` SET `content` = ? WHERE `messages` . `id` = ?");
        $stmt->bind_param('si', $content, $id);
        $stmt->execute();
    }

    public function addMessage($author, $title, $content) {
        $stmt = $this->db->prepare("INSERT INTO `messages` (`id`, `title`, `author`, `content`) VALUES (NULL, ?, ?, ?)");
        $stmt->bind_param('sss', $title, $author, $content);
        $stmt->execute();
    }

}