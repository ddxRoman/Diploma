<?php
require_once '../connect.php';
session_start();
$content=$_POST['contant'];
$author=$_SESSION['user']['login'];
$id_task=$_POST['id_task'];
$today = date("в H:i:s d-m-Y  "); 
$picture=$_FILES['picture'];
$path='../file/taskmanager_picture/comments/'.time().$_FILES['picture']['name'];
if(!move_uploaded_file($_FILES['picture']['tmp_name'],$path)){
mysqli_query($connect, "INSERT INTO `comments` (`id`, `task_id`, `content`, `owner`, `data`)
VALUES (NULL, '$id_task', '$content', '$author', '$today')");
    } else {
mysqli_query($connect, "INSERT INTO `comments` (`id`, `task_id`, `content`, `owner`, `data`, `pictures`)
 VALUES (NULL, '$id_task', '$content', '$author', '$today', '$path')");
    }
 header ('Location: ../../Taskmanager/task_user.php');
?>
