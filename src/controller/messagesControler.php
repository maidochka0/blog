<?php
require_once('../../database/db.php');
require_once('../model/messagesModel.php');
require_once('../model/commentsModel.php');
require_once('../model/autorize.php');

class MessagesControler{
    public $offset;
    public $limit;
    public $count;
    private $message;
    private $comment;

    public function __construct() {
        $this->message = new MessagesModel();
        $this->comment = new CommentsModel();
        $this->limit = 4;
        if(isset($_GET['offset'])) $this->offset = $_GET['offset'];
        $this->count = $this->message->count();
    }

    public function viewAllMessages() {
        $this->message->viewAllMessages($this->limit, $this->offset);
    }
    
    public function title() {
        $id = $_GET['id'];
        $stmtRes = $this->message->stmtRes($id);
        return $this->message->title($stmtRes);
    }

    public function author() {
        $id = $_GET['id'];
        $stmtRes = $this->message->stmtRes($id);
        return $this->message->author($stmtRes);
    }

    public function content() {
        $id = $_GET['id'];
        $stmtRes = $this->message->stmtRes($id);
        return $this->message->content($stmtRes);
    }

    public function viewAllComments() {
        $id = $_GET['id'];
        $stmtRes = $this->comment->stmtRes($id);
        $this->comment->view($stmtRes);
    }

    public function commentCount() {
        $id = $_GET['id'];
        return $this->comment->count($id);
    }

    public function addComment() {
        $id = $_GET['id'];
        $user = new User();
        $this->comment->addComment($user->get(), $id, $_POST['commentContent']);
        $this->singlePageUpdate($id);
    }

    public function redactTitle() {
        $id = $_GET['id'];
        $this->message->redactTitle($id, $_POST['titleContent']);
        $this->singlePageUpdate($id);
    }

    public function redactContent() {
        $id = $_GET['id'];
        $this->message->redactContent($id, $_POST['contentContent']);
        $this->singlePageUpdate($id);
    }

    public function singlePageUpdate($id) {
        header("Location: ../view/single_message_page.php?id=$id");
    }   

    public function addMessage() {
        $user = new User();
        $author = $user->get();
        $title = $_POST['titleContent'];
        $content = $_POST['contentContent'];
        $this->message->addMessage($author, $title, $content);
        $this->mainPageUpdate($this->offset);
    }

    public function mainPageUpdate($offset) {
        header("Location: ../view/main_page.php?offset=$offset");
    }
}