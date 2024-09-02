<?php 
require_once('../controller/messagesControler.php'); //как будет вести себя каунт при добавлении новых?
require_once('../model/autorize.php');
$user = new User();
$author = $user->get();
//$messagesCount = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `messages`"));
$messages = new MessagesControler();
$limit = 4;
$offset = $messages->offset;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>главная</title>
</head>
<body>
    <?php include('header.php'); ?>
    <section>
        <h2>сообщения: <?php echo $messages->count; ?></h2>
        <p>(до 4 сообщений на странице)</p>
        <p>(до 25(+-1?)символов краткого содержания)</p>
        <form method="POST" action="main_page.php?offset=<?php echo $_GET['offset'];?>">
                    <?php 
                    if (isset($_POST['message'])) {
                        if($_POST['titleContent'] === '') {
                            echo 'error: пустой заголовок<br>';
                        }
                        else if($_POST['contentContent'] === '') {
                            echo 'error: пустое сообщение';
                        }
                        else {
                            $messages->addMessage();
                        }
                    }
                    ?>
                    <textarea name="titleContent" placeholder="заголовок"></textarea>
                    <br>
                    <textarea name="contentContent" placeholder="текст"></textarea>
                    <br>
                    <input type="submit" name="message" value="отправить">
        </form>
        <hr>
        <div>
            <a href="main_page.php?offset=<?php echo max(0, $_GET['offset'] - $messages->limit); ?>">назад</a>
            /
            <a href="main_page.php?offset=<?php echo min($messages->count - ($messages->count % $messages->limit), $_GET['offset'] + $messages->limit); ?>">вперед</a>
        </div>
        <?php $messages->viewAllMessages(); ?>
    </section>
</body>
</html>