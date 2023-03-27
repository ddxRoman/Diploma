<?php
session_start();
require_once '../../action/connect.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);//Вывод реальных ошибок

$id_task=$_GET['id'];
$todo = mysqli_query($connect, "SELECT * FROM `todo` WHERE `id`='$id_task'");
$todo = mysqli_fetch_assoc($todo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="../../css/todolist.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <div class="task-full">
        <? echo "# - ". $id_task;?><br>
        <? echo $todo['contant'];?>
        </div>
</body>
</html>