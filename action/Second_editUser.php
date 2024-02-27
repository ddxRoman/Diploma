<?php
require_once 'connect.php';

$person = mysqli_query($connect, "SELECT * FROM `personal` ORDER BY `id`"); // Подключение к определенной таблице, и получение Статуса записи
$person = mysqli_fetch_all($person); // Выбирает все строки из набора $product и помещает их в массив  $product

session_start();
$id=$_POST['id'];
$name=$_POST['name'];
$surname=$_POST['surname'];
$patronymic=$_POST['patronymic'];
$telephone=$_POST['telephone'];
$mail=$_POST['mail'];
$password=$_POST['password'];
$Newpassword=$_POST['newpassword'];
$Newpassword2=$_POST['newpassword2'];
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

if($Newpassword!=$Newpassword2){
$_SESSION['sms']='Пароли не совпадают';
//  header ('Location: ../folders/addUser.php');
}
 else{ echo "<BR> Парои совпали<br>";
//   header ('Location: ../folders/user_card.php?mail='.$mail);
 if(!move_uploaded_file($_FILES['photo']['tmp_name'],$path)){
    echo "No foto";
mysqli_query($connect, "UPDATE `personal` SET `name` = '$name', `surname` = '$surname', `patronymic` = '$patronymic', `telephone` = '$telephone', `mail` = '$mail', `post` = '$post', 
`department` = '$department', `telegram` = '$telegram', `teams` = '$teams', `zoom` = '$zoom' WHERE `personal`.`id` = '$id'");
}
else{
    mysqli_query($connect, "UPDATE `personal` SET `name` = '$name', `surname` = '$surname', `patronymic` = '$patronymic', `telephone` = '$telephone', `mail` = '$mail', 
    `post` = '$post', `department` = '$department', `telegram` = '$telegram', `teams` = '$teams', `zoom` = '$zoom-',  WHERE `personal`.`id` = '3'");
    echo "YES foto";
}
}

echo "<br>Id ".$id."<br>Id ".$name."<br>Id ".$post."<br>Id ".$department."<br>Id ".$mail."<br>Id ".$zoom."<br>Id ".$path."<br>Id ".$id."<br>Id ".$id."<br>Id ".$id;
?>

