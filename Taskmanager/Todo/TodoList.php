<?php
// session_start();
require_once '../../action/connect.php';
$todo = mysqli_query($connect, "SELECT * FROM `todo` ORDER BY `id` ASC");
$todo = mysqli_fetch_all($todo);
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
    <div class="full-page">
<h1>Todo Лист</h1>


<?php
foreach($todo as $todos){
    ?>
 <div class="header-todo">
 <form action="action/checkbox.php" method="POST">   
     <div class="block-todo-task"><input type="checkbox" name="formWheelchair" value="Yes"/> 
     <a href="onlytask.php?id=<?=$todos[0]?>"> # <? echo $todos[0]." ".$todos[2];?> 

</a>    </div>
    <br><hr></form>
    <div class="todo-contant"><? echo $todos[3]?></div>
</div>
<?}    
    
    
    ?>
</div>
</body>
</html>