<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/news.css">
    <title>Document</title>
</head>
<body>
<h1>Новости <br></h1>
<?php 
require_once '../action/connect.php';
$new = mysqli_query($connect, "SELECT * FROM `news` ORDER BY `id` DESC "); // Подключение к определенной таблице, и получение Статуса записи
$new = mysqli_fetch_all($new); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments
foreach($new as $news){
    
    
    
    ?>
    


<div class="block_news">
    <h2><?= $news[1]?> </h2>

    <h4><?= $news[4]?> </h4>
    <hr>
    <p>
    <?= $news[2]?> 
    </p><br>

    <?$owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$news[3] ");
      $owner = mysqli_fetch_all($owner);
        foreach($owner as $owners){
    ?><h4><b>Автор:</b> <i><?=$owners[1]?></i></h4> 
    <?}?>
    <hr class="end_news">
    </div>
<?}?>

</body>
</html>


