<?php
require_once '../action/connect.php';
session_start();

$name=$_POST['name'];
$body=$_POST['body'];
$prioritet=$_POST['prioritet'];
$author=$_SESSION['user']['login'];
echo $name."<br>  Тело - ". $body;
echo "<br> Приоритет  =  ". $prioritet."<br>";
$today = date("d-m-Y в H:i:s "); 
$picture=$_FILES['pic']['name'];
$path='../file/taskmanager_picture/'.time().$_FILES['pic']['name'];
if($name!=''){
    if(!move_uploaded_file($_FILES['pic']['tmp_name'],$path)){
mysqli_query($connect, "INSERT INTO `tasks` (`id`, `name`, `content`, `Status`, `owner`, `Priority`, `date`)
 VALUES (NULL, '$name', '$body', '0', '$author', '$prioritet','$today')");
 header ('Location: ../Taskmanager/Task.php');
}else{
    mysqli_query($connect, "INSERT INTO `tasks` (`id`, `name`, `content`, `Status`, `owner`, `Priority`, `date`,`pictures`)
 VALUES (NULL, '$name', '$body', '0', '$author', '$prioritet','$today','$path')");
  header ('Location: ../Taskmanager/Task.php');
}
}
else  echo"False";

?>