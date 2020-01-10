<?php

$dbHost = "127.0.0.1";
$dbUser = "root";
$dbPassword = "";

$link = mysqli_connect($dbHost, $dbUser, $dbPassword);
if(!$link){
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
mysqli_set_charset($link, "utf8")

?>