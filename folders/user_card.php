<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">
    <title>Document</title>
</head>
<body>
<a href="../index_admin.php">Назад</a>
<?php 
require_once '../action/connect.php';
$mail=$_GET['mail'];
$person = mysqli_query($connect, "SELECT * FROM `personal` ORDER BY `mail`"); // Подключение к определенной таблице, и получение Статуса записи
$person = mysqli_fetch_all($person); // Выбирает все строки из набора $product и помещает их в массив  $product
    foreach($person as $persons){
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
                    <a href="<?= $persons[10]?>"><img src="../file/icons/teams_logo.jpg" class="logo_messendger_user_card"></a>
                    <?}if($persons[11]!=Null){?>
                    <a href="<?= $persons[11]?>"><img src="../file/icons/zoom_logo.png" class="logo_messendger_user_card"></a>
                    <?}?>
                </th>
            </tr>
            </table>
       <?}
    }?>
      </div>      
           
</body>
</html>