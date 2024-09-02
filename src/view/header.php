<?php 
require_once('../model/autorize.php');
$user = new User();
$author = $user->get();
?>
<header>
        <p>nickname: <?php echo $author; ?></p>
        <a href="../../index.php">сменить пользователя</a>
        <hr>
</header>