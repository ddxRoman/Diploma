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
$telegram ='https://web.telegram.org/k/#@'.$telegram;
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



 header ('Location: ../folders/user_card.php?em='.$mail);

?>