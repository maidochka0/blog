CREATE DATABASE chat;
USE chat;
CREATE TABLE `chat`.`messages` (`id` INT(11) NOT NULL AUTO_INCREMENT , `title` TEXT NOT NULL , `author` TEXT NOT NULL , `content` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `chat`.`comments` (`author` TEXT NOT NULL , `content` TEXT NOT NULL , `message_id` INT(11) NOT NULL ) ENGINE = InnoDB;
CREATE TABLE `chat`.`user` (`nickname` TEXT NOT NULL , `id` INT(11) NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`)) ENGINE = InnoDB;
INSERT INTO `user` (`nickname`, `id`) VALUES ('user', NULL);