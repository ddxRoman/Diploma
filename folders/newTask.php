<?
session_start();
require_once "../function/profilecheck.php";
require_once "../action/connect.php";
require_once "../action/users/StyleAndSettings.php";

if ($_SESSION['user']['status'] != 1936) {
    header('Location: index.php');
    }
    $personal = mysqli_query($connect, "SELECT * FROM `users` ORDER BY `id`"); // Подключение к определенной таблице, и получение Статуса записи
    $personal = mysqli_fetch_all($personal); // Выбирает все строки из набора $product и помещает их в массив  $product
   ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="iframe-body">
    <div class="taskheader">
        <a href="../Taskmanager/task.php"><img class="return" src="../../file/icons/return.png" ></a>
    </div>
    <div class="taskadd">
    <form action="../action/users/add_task_for_user.php" method="POST" enctype="multipart/form-data">
    <input required type="text" name="name" placeholder="Введите название">
    <select name="user"> <?
foreach($personal as $personals){
    
?>
    <option name="id"><?=$personals[0]." ". $personals[1]." ".$personals[3];?></option>

<?}?>
</select>


    <select name="priority"> 
        <option value="0">Заметка </option>
        <option value="1">Надо сделать</option> 
        <option value="2">Срочно </option>
    </select>

    
    <br>
    <label>Суть задачи:</label><br>
    <textarea required type="text" name="body"></textarea><br>
<button type="submit">Сохранить</button><input type="file" name="pic">
    </form>
    </div>
</body>
</html>


