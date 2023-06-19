<?php

require_once 'connect.php';
session_start();
$author= $_SESSION['user']['login'];
$name = $_POST['newsheader'];
$news = $_POST['news'];
$date = date("в H:i:s d-m-Y"); 

mysqli_query($connect, "INSERT INTO `news` (`id`, `H1`, `contant`, `author`, `date`) VALUES (NULL, '$name', '$news', '$author', '$date');");
header('Location: ../folders/news.php')
?>