<?php 
require_once '../action/connect.php';
require_once '../function/checkaut.php';

$creed = mysqli_query($connect, "SELECT * FROM `creeds` ORDER BY `name` ASC"); // Подключение к определенной таблице, и получение Статуса записи
$creed = mysqli_fetch_all($creed); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Доступы</title>
</head>
<body>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Прод</th>
            <th>Логин</th>
            <th>Пароль</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($creed as $creeds){?>
        <tr>
            <th><a href="<?=$creeds[2]?>" class="link-dark" target="_blank"><?=$creeds[1]?></a> </th>
            <th><?=$creeds[3]?></th>
            <th><?=$creeds[4]?></th>
        </tr>
        <?}?>
    </tbody>
</table>


</body>
</html>