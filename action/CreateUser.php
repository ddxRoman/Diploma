<?php
require_once 'connect.php';
$person = mysqli_query($connect, "SELECT * FROM `users` ORDER BY `id`"); 
$person = mysqli_fetch_all($person); 
$mail=$_POST['mail'];
$check_mail = mysqli_query($connect, "SELECT * FROM `users` WHERE `mail` = '$mail' ");
if(mysqli_num_rows($check_mail)>0){
    $_SESSION['sms']='Пользователь с такой почтой уже существует в системе';
     header ('Location: ../folders/addUser.php');
    } else{
$name=$_POST['name'];
$surname=$_POST['surname'];
$patronymic=$_POST['patronymic'];
$telephone=$_POST['telephone'];
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
if($teams!=''){
$teams ='https://teams.microsoft.com/_#/apps/a2da8768-95d5-419e-9441-3b539865b118/search?q='.$teams;}
else{$teams="";}
 if(!move_uploaded_file($_FILES['photo']['tmp_name'],$path)){
    $path='../file/personal/NoFace.png';
mysqli_query($connect, "INSERT INTO `users` (`id`, `name`, `surname`, `patronymic`, `telephone`,`mail`,`password`,`post`,`department`,`telegram`,`teams`,`zoom`,`photo`)
VALUES (NULL, '$name', '$surname', '$patronymic', '$telephone','$mail','$password','$post','$department','$telegram','$teams','$zoom','$path')");
}
else{ 
    mysqli_query($connect, "INSERT INTO `users` (`id`, `name`, `surname`, `patronymic`, `telephone`,`mail`,`password`,`post`,`department`,`telegram`,`teams`,`zoom`,`photo`)
    VALUES (NULL, '$name', '$surname', '$patronymic', '$telephone','$mail','$password','$post','$department','$telegram','$teams','$zoom','$path')");
}
header ('Location: ../folders/user_card.php?mail='.$mail);
}
?>
