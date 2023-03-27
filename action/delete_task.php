<?php

require_once 'connect.php';// Коннектимся к базе
$id = $_GET['id']; // получаем айди из ссылки
echo "<br>Тот самый  АЙДи_--__--".$id;
mysqli_query($connect, "DELETE FROM `tasks` WHERE `tasks`.`id` = '$id'"); // Подключаем переменную коннект в который данные по таблице, далее удаляем из таблици айди, по пути Таблица.Айди
header('location: ../Taskmanager/Task.php');
?>