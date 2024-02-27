<?php

require_once 'connect.php';
$url=$_POST['url'];
$name=$_POST['name'];
$categories=$_POST['categories'];

mysqli_query($connect, "INSERT INTO `sites` (`id`, `name`, `url`, `categories_id`) VALUES (NULL, '$url', '$name', '$categories');");
header('Location: ../index_admin.php');

?>