<?php //session_start();
        require_once 'connect.php'; // Проверка подключения к БД
        $id = $_GET['id']; // получаем айди из ссылки
?>

    <h1>Real Delete task? №<?= $id ?></h1>
    <a href="delete_task.php?id=<?=$id?>"><button>YES</button></a>
    <a href="../Taskmanager/Task.php"><button>NO</button></a>
