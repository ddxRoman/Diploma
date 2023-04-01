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
$viber=$_POST['viber'];
$whatsapp=$_POST['whatsapp'];
$photo=$_POST['photo'];


$path='../file/personal'.time().$_FILES['photo']['name'];

mysqli_query($connect, "INSERT INTO `personal` (`id`, `name`, `surname`, `patronymic`, `telephone`,`mail`,`password`,`post`,`department`,`telegram`,`viber`,`whatsapp`,`photo`)
VALUES (NULL, '$name', '$surname', '$patronymic', '$telephone','$mail','$password','$post','$department','$telegram','$viber','$whatsapp','$path')");

echo $name.'<br>'. $surname.'<br>'. $patronymic.'<br>'. $telephone.'<br>'. $mail.'<br>'. $password.'<br>'. $post.'<br>'. $department.'<br>'. $telegram.'<br>'. $viber.'<br>'. $whatsapp.'<br>';

header ('Location: ../folders/user_card.php');

?>
