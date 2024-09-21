<?php
require_once '../../action/connect.php';
$id = $_GET['id']; // получаем айди из ссылки
mysqli_query($connect, "DELETE FROM `expenses` WHERE `expenses`.`id` = '$id'"); // Подключаем переменную коннект в который данные по таблице, далее удаляем из таблици айди, по пути Таблица.Айди
header('Location: ../finance.php');
?>