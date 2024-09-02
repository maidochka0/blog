<?php
require_once('../../database/db.php');
class User {

    function __construct() {
    }

    function update($nickname) {
        mysqli_query(getConnection(), "UPDATE `user` SET `nickname` = '$nickname' WHERE `user`.`id` = 1");
    }

    function get() {
        //if(isset((mysqli_query(getConnection(), "SELECT * from `user`")->fetch_all(MYSQLI_ASSOC))[0]['nickname'])) 
        return (mysqli_query(getConnection(), "SELECT * from `user`")->fetch_all(MYSQLI_ASSOC))[0]['nickname'];
    }
}