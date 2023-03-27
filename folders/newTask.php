<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="iframe-body">
    <div class="taskheader">
        <a href="../Taskmanager/Task.php"><img class="return" src="../file/icons/return.png" ></a>
    </div>
    <div class="taskadd">
    <form action="/action/addtask.php" method="POST" >
    <input required type="text" name="name" placeholder="Введите название">

    
    <select name="prioritet"> 
        <option value="0">Backlog </option>
        <option value=" 1">Надо сделать</option> 
        <option value=" 2">Нет знаний </option>
    </select>


    <br>
    <label>Суть задачи:</label><br>
    <textarea required type="text" name="body"></textarea><br>
<button type="submit">Сохранить</button>
    </form>
    </div>
</body>
</html>
