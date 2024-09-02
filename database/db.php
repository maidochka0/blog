<?php
function getConnection() {
    $connection = mysqli_connect('localhost', 'maid', 'password', 'chat'); //ip, user_name, password, database_name
    if ($connection === false) {
        echo 'fail';
        die();
    }
    return $connection;
}
?>