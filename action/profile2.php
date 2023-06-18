<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">
    <title>Профиль</title>
</head>
<body>

<?php 

session_start();
$status = $_SESSION['user']['status'];
require_once '../action/connect.php';
require_once '../action/users/StyleAndSettings.php';
$mail=$_GET['mail']; 
if($status!=1936){
$admin = mysqli_query($connect, "SELECT * FROM `users` ORDER BY `email`"); // Подключение к определенной таблице, и получение Статуса записи
$admin = mysqli_fetch_all($admin); // Выбирает все строки из набора $product и помещает их в массив  $product
foreach($admin as $admins){

    if($admins[3]==$mail){
        ?>
        <div class="user_card">
        <table class="user_card_table">
            <thead>    <h2 color="black">Карточка сотрудника</h2></thead>
            <tr>
            <th rowspan="2"><a href="<?= $admins[4]?>"><img src="<?=$admins[4]?>" class="user_card_photo"></a></th>
            <th><br><font class="card"><?= "Код сотрудника:<br>"?></font><?= $admins[0] ?></th>
            <th><font class="card"><?= "Должность:<br>"?></font><?=$admins[5]?></th>
            </tr>
            <tr>
            <th><font class="card"><?= "Логин : <br>"?></font><?= $admins[1]?></th>
            <th><font class="card"><?="Почта: <br>"?></font><?=$admins[3]?></th>
        </tr>
        </table>
   <?
                   $id_user = $admins[0];
$check_id = mysqli_query($connect, "SELECT * FROM `settings_users` WHERE `id_user` = '$id_user' ");
    if(mysqli_num_rows($check_id)<1)
    {
    echo "Добавлены персональные настройки юзера <br>";
    mysqli_query($connect, "INSERT INTO `settings_users` (`id`, `id_user`, `background`, `text_color`) VALUES (NULL, '$id_user', '000000', 'ffffff');");
}
?> <a href="user_list.php"><button>Назад</button></a>
<a href="editUser.php?mail=<?=$admins[5]?>"><button>Редактировать</button></a>

<?
}
}


}else{
$person = mysqli_query($connect, "SELECT * FROM `personal` ORDER BY `mail`"); // Подключение к определенной таблице, и получение Статуса записи
$person = mysqli_fetch_all($person); // Выбирает все строки из набора $product и помещает их в массив  $product
    foreach($person as $persons){
        echo "<br>PERS - ". $persons[5];
        if($persons[5]==$mail){
            ?>
            <div class="user_card">
            <table class="user_card_table">
                <thead>    <h3>Карточка сотрудника</h3></thead>
                <tr>
                <th rowspan="2"><a href="<?= $persons[12]?>"><img src="<?=$persons[12]?>" class="user_card_photo"></a></th>
                <th><br><?= $persons[2], " ",  $persons[1], " ", $persons[3] ?></th>
                <th><?= $persons[4]?></th>
                <th><?= $persons[5]?></th>
                </tr>
                <tr>
                <th><?= $persons[7]?></th>
                <th><?= $persons[8]?></th>
            </tr>
            <tr>
                <th>
                    <?
                     if($persons[9]!=Null){?>
                     <a href="<?= $persons[9]?>"><img src="../file/icons/telegram_logo.png" class="logo_messendger_user_card"></a><?
                    }if($persons[10]!=Null){?>
                    <a href="<?= $persons[10]?>"><img src="../file/icons/teams_logo.png" class="logo_messendger_user_card"></a>
                    <?}if($persons[11]!=Null){?>
                    <a href="<?= $persons[11]?>"><img src="../file/icons/zoom_logo.png" class="logo_messendger_user_card"></a>
                    <?}?>
                </th>
            </tr>
            </table>
       <?
                       $id_user = $persons[0];
    $check_id = mysqli_query($connect, "SELECT * FROM `settings_users` WHERE `id_user` = '$id_user' ");
        if(mysqli_num_rows($check_id)<1)
        {
        echo "Добавлены персональные настройки юзера <br>";
        mysqli_query($connect, "INSERT INTO `settings_users` (`id`, `id_user`, `background`, `text_color`) VALUES (NULL, '$id_user', '000000', 'ffffff');");
}
?> <a href="user_list.php"><button>Назад</button></a>
<a href="editUser.php?mail=<?=$persons[5]?>"><button>Редактировать</button></a>

 <?
}
}}
    ?>
      </div>      
</body>
</html>