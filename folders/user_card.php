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
    <h3>Карточка сотрудника</h3>
<?php 
require_once '../action/connect.php';
$mail=$_GET['em'];
$person = mysqli_query($connect, "SELECT * FROM `personal` ORDER BY `id`"); // Подключение к определенной таблице, и получение Статуса записи
$person = mysqli_fetch_all($person); // Выбирает все строки из набора $product и помещает их в массив  $product
    foreach($person as $persons){
        if($persons[5]==$mail){
            ?> 
            <img src="<?=$persons[12]?>" class="user_card_photo">
            <? echo '<br>'."Имя: ", $persons[1], "Фамилия: ". $persons[2]. "Отчество: ". $persons[3]. "Телефон: ". $persons[4]. "Почта: ". 
            $persons[5]."Должность: ". $persons[6]."Отдел: ". $persons[7]. "Telegram: ". $persons[8]."Teams: ". $persons[9]. "Zoom: ".$persons[10]."<br>";
        }
    }


    ?>
</body>
</html>