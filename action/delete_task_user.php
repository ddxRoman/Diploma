<?php

require_once 'connect.php';// Коннектимся к базе
$id = $_GET['id']; // получаем айди из ссылки
mysqli_query($connect, "DELETE FROM `user_task` WHERE `user_task`.`id` = '$id'"); // Подключаем переменную коннект в который данные по таблице, далее удаляем из таблици айди, по пути Таблица.Айди
header('location: ../Taskmanager/task_user.php');
?>