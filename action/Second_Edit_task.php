<?php
require_once 'connect.php';
    $name=$_POST['name'];
    $content=$_POST['body'];
    $id=$_POST['id'];
    $avatar=$_FILES['avatar'];
    $path='../file/taskmanager_picture/'.time().$_FILES['avatar']['name'];
    if(!move_uploaded_file($_FILES['avatar']['tmp_name'],$path)){
        mysqli_query($connect, "UPDATE `tasks` SET  `name` = '$name', `content` = '$content', `pictures`= 'NULL' WHERE `id` = '$id'");
        }
        else{
    mysqli_query($connect, "UPDATE `tasks` SET  `name` = '$name', `content` = '$content', `pictures`= '$path' WHERE `id` = '$id'");}
    header ('Location: ../Taskmanager/task_bootstrap.php');
    ?>  
