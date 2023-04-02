<?php
require_once 'connect.php';
session_start();
$name=$_POST['name'];
$surname=$_POST['surname'];
$patronymic=$_POST['patronymic'];
$telephone=$_POST['telephone'];
$mail=$_POST['mail'];
$password=$_POST['password'];
$post=$_POST['post'];
$department=$_POST['department'];
$telegram=$_POST['telegram'];
$teams=$_POST['teams'];
$zoom=$_POST['zoom'];
$photo=$_POST['photo'];


$path='../file/personal/'.time().$_FILES['photo']['name'];
if(!move_uploaded_file($_FILES['photo']['tmp_name'],$path)){
    $path='../file/personal/NoFace.png';
mysqli_query($connect, "INSERT INTO `personal` (`id`, `name`, `surname`, `patronymic`, `telephone`,`mail`,`password`,`post`,`department`,`telegram`,`teams`,`zoom`,`photo`)
VALUES (NULL, '$name', '$surname', '$patronymic', '$telephone','$mail','$password','$post','$department','$telegram','$teams','$zoom','$path')");
}
else{
    mysqli_query($connect, "INSERT INTO `personal` (`id`, `name`, `surname`, `patronymic`, `telephone`,`mail`,`password`,`post`,`department`,`telegram`,`teams`,`zoom`,`photo`)
    VALUES (NULL, '$name', '$surname', '$patronymic', '$telephone','$mail','$password','$post','$department','$telegram','$teams','$zoom','$path')");
}
echo $name.'<br>'. $surname.'<br>'. $patronymic.'<br>'. $telephone.'<br>'. $mail.'<br>'. $password.'<br>'. $post.'<br>'. $department.'<br>'. $telegram.'<br>'. $teams.'<br>'. $zoom.'<br>';
header ('Location: ../folders/user_card.php');

?>