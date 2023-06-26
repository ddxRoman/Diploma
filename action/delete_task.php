<?php
require_once 'connect.php';
$id = $_GET['id']; 
mysqli_query($connect, "DELETE FROM `tasks` WHERE `tasks`.`id` = '$id'"); 
header('location: ../Taskmanager/Task.php');
?>