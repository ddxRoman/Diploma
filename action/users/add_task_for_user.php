<?php
require_once '../connect.php';
session_start();

$phaa = $_POST['form'];
$name=$_POST['name'];
$body=$_POST['body'];
$name_user=$_POST['user'];
$priority = $_POST['priority'];
$author=$_SESSION['user']['id'];
$id_users = preg_replace("/[a-zA-Zа-яА-Я]/", " ", $name_user); 
$id_users = (int) $id_users;
echo "id=".$id_users."<br>";
echo "USER ".$name_user."<br>";
echo "name - ".$name."<br>  Тело - ". $body;
echo "<br> Приоритет  =  ". $priority."<br>";

$id_users = (int) $id_users;
$today = date("d-m-Y в H:i:s "); 
$picture=$_FILES['pic']['name'];
$path='../../file/taskmanager_picture/'.time().$_FILES['pic']['name'];

echo "TYT".$path;
if(!move_uploaded_file($_FILES['pic']['tmp_name'],$path)){
mysqli_query($connect, "INSERT INTO `user_task` (`id`, `name`, `contant`, `status`, `owner`, `priority`, `date`, `date_close`, `pictures`, `id_user`)
                                         VALUES (NULL, '$name', '$body', '0', '$author', '$priority', '$today', '0', '$path', '$id_users')");
header ('Location: ../../Taskmanager/task_user.php');
} else{
    mysqli_query($connect, "INSERT INTO `user_task` (`id`, `name`, `contant`, `status`, `owner`, `priority`, `date`, `date_close`, `id_user`)
    VALUES (NULL, '$name', '$body', '0', '$author', '$priority', '$today', '0', '$id_users')");
header ('Location: ../../Taskmanager/task_user.php');
}
?>
