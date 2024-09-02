<?php
require_once('database/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>тестовое задание</title>
</head>
<body>
    <form method="POST" action="./src/controller/login.php">
        <input type="text" placeholder="nickname" name="nickname">
        <br>
        <p>введите admin, чтобы редактировать не только свои статьи</p>
        <hr>
        <input type="submit" value="ok">
    </form> 
</body>
</html>