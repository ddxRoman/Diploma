<?php
require_once '../action/connect.php';
session_start();
// $select =  ($_POST["select"]);
$name=$_POST['name'];
$body=$_POST['body'];
$prioritet=$_POST['prioritet'];
$author=$_SESSION['user']['login'];
echo $name."<br>  Тело - ". $body;
echo "<br> Приоритет  =  ". $prioritet;
$today = date("d-m-Y в H:i:s "); 
if($name!=''){

mysqli_query($connect, "INSERT INTO `tasks` (`id`, `name`, `content`, `Status`, `owner`, `Priority`, `date`)
 VALUES (NULL, '$name', '$body', '0', '$author', '$prioritet','$today')");


 header ('Location: ../Taskmanager/Task.php');
}
else{
    echo"False";
}

?>
