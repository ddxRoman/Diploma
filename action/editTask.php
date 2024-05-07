<!doctype html>
<html lang="ru">
<head>
    <link rel="stylesheet" type="text/css" href="../css/styleaccordion.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Taskmanager</title>
</head>

<?php
require_once 'connect.php';
$product_id = $_GET['id'];
$product=mysqli_query($connect, "SELECT*FROM `tasks` WHERE `id`='$product_id'");
$product=mysqli_fetch_assoc($product);
?>
    <body>
   
    <form action="Second_Edit_task.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$product['id']?>">
                <label>№<?=$product['id']?>:<?=$product['name']?></label>
                <a href="../Taskmanager/task_bootstrap.php"><img class="return" src="../file/icons/return.png" ></a><br>
                <input type="text" name="name" value="<?=$product['name']?>"><br>
                <textarea type="text" name="body"><?=$product['content']?></textarea><br>
                <input type="file" name="avatar"><br>
                <button type="submit">Сохранить</button>
            </form>
    </body>
</html>