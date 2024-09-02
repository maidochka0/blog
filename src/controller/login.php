<?php //вызывается только раз
require_once('../model/autorize.php');
$user = new User();
$user->update($_POST['nickname'] ? $_POST['nickname'] : 'user');
header('Location: ../view/main_page.php?offset=0');