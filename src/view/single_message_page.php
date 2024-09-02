<?php 
require_once('../controller/messagesControler.php');
require_once('../model/autorize.php');
$message = new MessagesControler();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $message->title(); ?></title>
</head>
<body>
    <?php include('header.php'); ?>
    <a href="main_page.php?offset=<?php echo intdiv($_GET['id'], $message->limit) * $message->limit; ?>">на главную</a>
    <hr>
    <?php 
    $user = new User();
    if($user->get() === $message->author() || $user->get() === 'admin') {
        ?><div id="redact_title">
            <form method="POST" action="single_message_page.php?id=<?php echo $_GET['id']?>">
                <?php 
                if(isset($_POST['title_form'])) {
                    ?>
                    <textarea name="titleContent"><?php echo $message->title(); ?></textarea>
                    <br>
                    <input type="submit" name="title" value="редактировать">
                    <?php
                }
                else {
                    if(isset($_POST['title'])) {
                        if($_POST['titleContent'] === '') {
                            echo 'error: пустой заголовок';
                        }
                        else {
                            $message->redactTitle();
                        }
                    }
                    ?>
                <input type="submit" name="title_form" value="редактировать заголовок">
                <?php
                }
                ?>
            </form>
        </div>
        <div id="redact_content">
            <form method="POST" action="single_message_page.php?id=<?php echo $_GET['id']?>">
                <?php 
                if(isset($_POST['contentForm'])) {
                    ?>
                    <textarea name="contentContent"><?php echo $message->content(); ?></textarea>
                    <br>
                    <input type="submit" name="content" value="редактировать">
                    <?php
                }
                else {
                    if(isset($_POST['content'])) {
                        if($_POST['contentContent'] === '') {
                            echo 'error: ничего не отправленно';
                        }
                        else {
                            $message->redactContent();
                        }
                    }
                    ?>
                    <input type="submit" name="contentForm" value="редактировать сообщение">
                    <?php
                }
                ?>
            </form>
        </div><?php
    }?>
    <section id="">
        <h1><?php echo $message->title(); ?></h1>
        <h3><?php echo  'автор статьи: ' . $message->author(); ?></h3>
        <hr>
        <p style="white-space: pre-line;">
            <?php echo ($message->content()); ?>
        </p>
        <hr>
        <section id="comments">
            <h2>коментарии(<?php echo $message->commentCount(); ?>):</h2>
            <div id="add_comment">
                <form method="POST" action="single_message_page.php?id=<?php echo $_GET['id'];?>#comments">
                    <?php 
                    if (isset($_POST['comment'])) {
                        if($_POST['commentContent'] === '') {
                            echo 'error: пустой комментарий<br>';
                        }
                        else {
                            $message->addComment();
                        }
                    }
                    ?>
                    <textarea name="commentContent" placeholder="коментарий"></textarea>
                    <br>
                    <input type="submit" name="comment" value="отправить">
                </form>
            <div>
                <a href='./single_message_page.php?id=<?php echo $_GET['id']; ?>'>обновить коментарии</a>
            </div>
            </div>
            <?php $message->viewAllComments() ?>
        </section>
    </section>
</body>
</html>
