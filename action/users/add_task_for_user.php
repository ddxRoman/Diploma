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

if(!move_uploaded_file($_FILES['pic']['tmp_name'],$path)){
mysqli_query($connect, "INSERT INTO `tasks` (`id`, `name`, `content`, `status`, `owner`, `executor`, `priority`, `date`, `file`, `type`)
                                         VALUES (NULL, '$name', '$body', '0', '$author', '$id_users','$priority', '$today', '$path', '1861')");
header ('Location: ../../Taskmanager/task.php');
} else{
    mysqli_query($connect, "INSERT INTO `tasks` (`id`, `name`, `content`, `status`, `owner`, `executor`, `priority`, `date`, `type`)
    (NULL, '$name', '$body', '0', '$author', '$id_users','$priority', '$today', '1861')");
header ('Location: ../../Taskmanager/task.php');
}
?>
