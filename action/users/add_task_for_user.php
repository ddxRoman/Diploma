<?php
require_once '../connect.php';
session_start();
$id_users = mysqli_query($connect, "SELECT * FROM `user_task` WHERE `name`=$name `surname`=$surname"); // Подключение к определенной таблице, и получение Статуса записи

$name=$_POST['name'];
$body=$_POST['body'];
$name_user=$_POST['user'];
$prioritet=$_POST['prioritet'];
$author=$_SESSION['user']['login'];
$id=$_POST['id'];
echo "id=".$id."<br>";
echo "USER ".$name_user."<br>";
echo "name - ".$name."<br>  Тело - ". $body;
echo "<br> Приоритет  =  ". $prioritet."<br>";
$today = date("d-m-Y в H:i:s "); 
$picture=$_FILES['pic']['name'];
$path='../file/taskmanager_picture/'.time().$_FILES['pic']['name'];
if($name!=''){
    if(!move_uploaded_file($_FILES['pic']['tmp_name'],$path)){
mysqli_query($connect, "INSERT INTO `user_tasks` (`id`, `name`, `content`, `Status`, `owner`, `Priority`, `date`, `id_user`)
 VALUES (NULL, '$name', '$body', '0', '$author', '$prioritet','$today','$id_user')");
//  header ('Location: ../Taskmanager/Task.php');
}else{
    mysqli_query($connect, "INSERT INTO `user_tasks` (`id`, `name`, `content`, `Status`, `owner`, `Priority`, `date`,`pictures`, `id_user`)
 VALUES (NULL, '$name', '$body', '0', '$author', '$prioritet','$today','$path','$id_user')");
//   header ('Location: ../Taskmanager/Task.php');
}
}
else  echo"False";

?>