<link rel="stylesheet" type="text/css" href="../css/button.css">
<?php 
        require_once 'connect.php'; // Проверка подключения к БД
        $id = $_GET['id']; // получаем айди из ссылки
?>

    <h1>Real Delete task? №<?= $id ?></h1>
    <a href="delete_task_user.php?id=<?=$id?>"><button>YES</button></a>
    <a href="../Taskmanager/task_user.php"><button>NO</button></a>

