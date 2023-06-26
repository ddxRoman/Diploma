<link rel="stylesheet" type="text/css" href="../css/button.css">
<?php   require_once 'connect.php'; 
        $id = $_GET['id']; ?>
    <h1>Real Delete task? №<?= $id ?></h1>
    <a href="delete_task.php?id=<?=$id?>"><button>YES</button></a>
    <a href="../Taskmanager/Task.php"><button>NO</button></a>
