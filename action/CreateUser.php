<?php
require_once 'connect.php';

$person = mysqli_query($connect, "SELECT * FROM `personal` ORDER BY `id`"); // Подключение к определенной таблице, и получение Статуса записи
$person = mysqli_fetch_all($person); // Выбирает все строки из набора $product и помещает их в массив  $product

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
$telegram=str_replace('https://t.me/','',$telegram);
if($telegram!=''){
$telegram ='https://web.telegram.org/k/#@'.$telegram;}
else {$telegram==Null;}
$path='../file/personal/'.time().$_FILES['photo']['name'];
$check_mail = mysqli_query($connect, "SELECT * FROM `personal` WHERE `mail` = '$mail' ");
if($teams!=''){
$teams ='https://teams.microsoft.com/_#/apps/a2da8768-95d5-419e-9441-3b539865b118/search?q='.$teams;}
else{$teams="";}

if(mysqli_num_rows($check_mail)>0){
$_SESSION['sms']='Пользователь с такой почтой уже существует в системе';
 header ('Location: ../folders/addUser.php');
} else{
  header ('Location: ../folders/user_card.php?mail='.$mail);
 if(!move_uploaded_file($_FILES['photo']['tmp_name'],$path)){
    $path='../file/personal/NoFace.png';
mysqli_query($connect, "INSERT INTO `personal` (`id`, `name`, `surname`, `patronymic`, `telephone`,`mail`,`password`,`post`,`department`,`telegram`,`teams`,`zoom`,`photo`)
VALUES (NULL, '$name', '$surname', '$patronymic', '$telephone','$mail','$password','$post','$department','$telegram','$teams','$zoom','$path')");
}
else{
    mysqli_query($connect, "INSERT INTO `personal` (`id`, `name`, `surname`, `patronymic`, `telephone`,`mail`,`password`,`post`,`department`,`telegram`,`teams`,`zoom`,`photo`)
    VALUES (NULL, '$name', '$surname', '$patronymic', '$telephone','$mail','$password','$post','$department','$telegram','$teams','$zoom','$path')");
}
}
?>
