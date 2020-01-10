<?php
require_once('tools\db_process.php');
$createDB = "CREATE DATABASE IF NOT EXISTS alltothebottom_by_awr";
$createTableCart = "CREATE TABLE `alltothebottom_by_awr`.`cart` ( `id` INT NOT NULL AUTO_INCREMENT , `cart_id` INT NOT NULL , `goods_id` INT NOT NULL , `amount` INT NOT NULL , `paid` BOOLEAN NOT NULL , `action_time` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$createTableExploring = "CREATE TABLE `alltothebottom_by_awr`.`exploring` ( `id` INT NOT NULL AUTO_INCREMENT , `action_time` DATETIME NOT NULL , `secret_seq` VARCHAR(30) NOT NULL , `country` VARCHAR(50) NULL , `sitename` VARCHAR(50) NOT NULL , `category` VARCHAR(30) NULL , `goods_name` VARCHAR(30) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$createTableIpCountry = "CREATE TABLE `alltothebottom_by_awr`.`ip_country` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `country` VARCHAR(50) NOT NULL , `ip` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$createTablePayments = "CREATE TABLE `alltothebottom_by_awr`.`payments` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` BIGINT NOT NULL , `cart_id` INT NOT NULL , `action_time` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
mysqli_query($link, $createDB);
mysqli_query($link, $createTableCart);
mysqli_query($link, $createTableExploring);
mysqli_query($link, $createTableIpCountry);
mysqli_query($link, $createTablePayments);
header("Location: parseLogs.php");
die();
?>