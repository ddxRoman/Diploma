<?php
require_once 'connect.php';
session_start();
$name=$_POST['name'];
$url=$_POST['url'];
$login=$_POST['login'];
$password=$_POST['password'];

mysqli_query($connect, "INSERT INTO `creeds` (`id`, `name`, `URL`, `Login`, `Password`) 
VALUES (NULL, '$name', '$url', '$login', '$password');");
header('Location: ../folders/creeds.php')
?>