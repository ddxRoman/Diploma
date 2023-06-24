<?php session_start(); 
$id_user=$_SESSION['user']['id'];

$status_user = $_SESSION['user']['status'];
require_once '../action/connect.php'; // Прaоверка подключения к БД
require_once "../function/checkaut.php";
require_once "../function/checkrole.php";
require_once "../action/users/StyleAndSettings.php";
?>
<!doctype html>
<html lang="ru">

<head>
    <link rel="stylesheet" type="text/css" href="../css/styleaccordion.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Taskmanager</title>
</head>
<body>
    
<?
$check_task = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `executor` = '$id_user' ");
if(mysqli_num_rows($check_task)<1 && $status_user!=1936){
?> <div class="taskheader"><font class="NoTask"><?= "Для вас нет активных задач";?></font></div>
<?}else{
if($status_user==1936){?>
<div class="taskheader">
            <a class="Aaddtask" href="../action/users/create_task_for_user.php"><button class="addtask_user transition" title="Добавить задачу">+</button></a> <!-- Кнопка добавления таски-->
        </div>
        <?
            $task = mysqli_query($connect, "SELECT * FROM `tasks`  ORDER BY `status` ASC"); // Подключение к определенной таблице, и получение Статуса записи
        }else{
        $task = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `executor`=$id_user ORDER BY `status` ASC"); // Подключение к определенной таблице, и получение Статуса записи
        }
        $task = mysqli_fetch_all($task); // Выбирает все строки из набора $product и помещает их в массив  $product
        $comment = mysqli_query($connect, "SELECT * FROM `comments` ORDER BY `id` ASC "); // Подключение к определенной таблице, и получение Статуса записи
        $comment = mysqli_fetch_all($comment); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments
        foreach ($task as $tasks) { // Перебор массива $product c его записью в массив $tasks
            $k++; ?>
            <script src="../JavaScript/accordion.js"></script> <!-- Cкрипт аккордиона-->
            <div id="accordion" class="accordion" style="max-width: 30rem; margin: 1rem auto;"> <!-- общий див всего акордиона-->
                <div class="accordion__item">
                    <!-------------------------------------------- Проверяем если статус задачи 0, то выводим эти результаты----------------------------->
                    <?  if ($tasks[3] == 0) { ?> 
                        <div class="accordion__header" style="background: linear-gradient(45deg, #c436369a, #d0d7d8, #d0d7d8, #d0d7d8, #c4363667)"> <!-- Верхний див где номер таски и имя -->
                        <a href="#" target="_blank"><p class="number"> № <?= $tasks[0]?>:</p></a><!-- Вот тут ссылка на весь экран-->
                            <p class="nametasks"><?= $tasks[1] ?></p>
                            <? if ($tasks[5] == 0) { // Проверка на статус таски, и вывод приоитета возле названия в заголовке
                            ?><font class="prioritet-task0">Заметка</font><?
                                                                            } else if ($tasks[5] == 1) { ?><font class="prioritet-task1">Надо сделать</font> <?
                                                                                                        } else if ($tasks[5] == 2) { ?><font class="prioritet-task2">Срочно</font><?
                                                                                                        }
                                                                                                            ?>
                        </div>
                        <div class="accordion__body">
                        <form action="../action/statusTask.php?id=<?= $products[0] ?>" method="post" name="form"> <!-- форма с селектами-->
                                <select name="currency" onchange="this.form.submit()">
                                    <? //if ($product[3] == 0) { 
                                    ?> <!-- Проверяем если статус задачи 1 то выводим Селект где первая запись Активный  -->
                                    <option value="0">Актуально</option>
                                    <option value="1">Выполнено</option>
                                    <option value="2">Не актуально</option>
                                    <? //}
                                    ?>
                                </select>
                                <a href="../action/editTask.php?id=<?= $products[0] ?>"><img width="16px" height="16px" title="Редактировать" src="../file/icons/edit.png"></a> <!-- Кнопка редактировать -->
                                <select name="priority" onchange="this.form.submit()"><!-- Селект с сортировкой Статусов задач, выглядит как хуйня, надо переделать что бы тут был запрос и с запроса шел этот статус-->
                                    <? if ($products[5] == 0) { ?>
                                        <option value="0">Backlog</option>
                                        <option value="1">Надо сделать</option>
                                        <option value="2">Нет знаний</option>
                                    <?
                                    } else if ($products[5] == 1) { ?>
                                        <option value="1">Надо сделать</option>
                                        <option value="0">Backlog</option>
                                        <option value="2">Нет знаний</option>
                                    <?
                                    } else if ($products[5] == 2) { ?>
                                        <option value="2">Нет знаний</option>
                                        <option value="1">Надо сделать</option>
                                        <option value="0">Backlog</option>
                                    <?
                                    } ?>
                                </select>
                                <form action="../action/accept_delete.php?id=<?= $products[0] ?>" method="post" name="real_delete">
                                    <a href="../action/accept_delete.php?id=<?= $products[0] ?>"><img src="/file/icons/delete.png" width="16px" height="16px"></a>
                                </form>
                            </form>
                            <div class="accordion__content">
                               <pre> <?= $tasks[2]; ?></pre><?
                                if($tasks[8]=="NULL"){
                                    ?>
                                    
                                    <a href="<?= $tasks[8]; ?>" target="_blank"><img class="pictures-in-tasks" src="<?= $tasks[8]; ?>"></a><?
                                }
                                ?>
                            </div>

                            
                            <?$owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$tasks[4] ");
                            $owner = mysqli_fetch_all($owner);?>


                            <a title="Профиль автора" href="/action/profile2.php?id=<?=$tasks[4];?>" target="_blank">

                                <font class="owner"> <?
                                foreach($owner as $owners){
                                
                                 echo $owners[1];}
                                 ?> </font>
                            </a>
                            <font class="creation_date"><b>Создано:</b> <?= $tasks[7] ?></font>
<!----------------------------------------Начало пати с комментариями------------------------------------------------------------------>
                            <div class="comments-block"><?
                                                        foreach ($comment as $comments) { // Перебор массива $ c его записью в массив $
                                                            if ($comments[1] == $tasks[0]) {//Проверяем если айди таска комента равно айди самого таска то выводим его
                                                               ?><a title="Профиль автора" href="/action/profile2.php?id=<?=$comments[3];?>" target="_blank">
                                <font class="owner-comment"> <? echo $comments[3]; ?> </font>
                            </a><?if($comments[5]!="NO"){
                                                                echo ($comments[4] . "<br><hr>" . $comments[2]  . "<a href='$comments[5]'><img src='$comments[5]' class='pictures-in-tasks'></a> <hr class='end-comments'>");
                                                            } else {
                                                                echo ($comments[4] . "<br><hr>" . $comments[2]."<br>");
                                                            }}
                                                        } ?>
                                                        <div class="block-add-comments">
                                <form action="../action/users/addComents_user.php" method="post" enctype="multipart/form-data">
                                    <textarea class="add-comments" name="contant"></textarea><br>
                                    <input type="file" name="picture"><br>
                                    <input type="hidden" name="id_task" value="<?= $tasks[0] ?>">
                                    <button>Добавить</button>
                                </form>
                                </div>
                            </div>
<!----------------------------------------Конец пати с комментариями------------------------------------------------------------------>
                        <? } // Тут мы закрыли первую проверку, на то статус 0 Актуальный 
                    else  if ($tasks[3] == 1) {  ?>
                            <!---------------------------  Тут мы начали вторую проверку, на то статус 1 Закрыто---------------------------------->
                            <div style="background: linear-gradient(45deg, #58c436, #7ed66a, #b4e3ac, #e9ffe5);" class="accordion__header">
                                <p class="number"> № <s> <?= $tasks[0]  ?> : </p>
                                <p class="nametasks"><?= $tasks[1] ?></s></p>
                            </div>
                            <div class="accordion__body">
                            <font>Выполнено</font> <!-- Проверяем если статус задачи 1 то выводим Селект где первая запись Активный  -->
                                <div color="yellow" class="accordion__content">


                                <pre> <?= $tasks[2]; ?></pre><? 
                                if($tasks[8]=="NULL"){
                                    ?>
                                    
                                    <a href="<?= $tasks[8]; ?>" target="_blank"><img class="pictures-in-tasks" src="<?= $tasks[8]; ?>"></a><?
                                }
                                ?>
                            </div>
 
                            
                            <?$owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$tasks[4] ");
                            $owner = mysqli_fetch_all($owner);?>


                            <a title="Профиль автора" href="/action/profile2.php?id=<?=$tasks[4];?>" target="_blank">

                                <font class="owner"> <?
                                foreach($owner as $owners){
                                
                                 echo $owners[1];}
                                 ?> </font>
                            </a>


                                <font class="creation_date"><b>Создано:</b> <?= $tasks[7] ?></font> <br>
                                <font class="creation_date"><b>Закрыто:</b> <?= $tasks[8] ?></font>
<!----------------------------------------Начало пати с комментариями------------------------------------------------------------------>
<div class="comments-block"><?
                                                        foreach ($comment as $comments) { // Перебор массива $ c его записью в массив $
                                                            if ($comments[1] == $tasks[0]) {//Проверяем если айди таска комента равно айди самого таска то выводим его
                                                                echo ($comments[3] . " " . $comments[4] . "< br><hr>" . $comments[2]  . "<a href='$comments[5]'><img src='$comments[5]' class='pictures-in-tasks'></a> <hr class='end-comments'>");
                                                            }
                                                        } ?>
                                <form action="../action/users/addComents_user.php" method="post" enctype="multipart/form-data">
                                    <textarea class="add-comments" name="contant"></textarea><br>
                                    <input type="file" name="picture"><br>
                                    <input type="hidden" name="id_task" value="<?= $tasks[0] ?>">
                                    <button>Добавить</button>
                                </form>
                            </div>
<!----------------------------------------Конец пати с комментариями------------------------------------------------------------------>
                            <?
                        }  // Тут мы закрыли вторую проверку, на то статус 1 Закрыто 
                        else if ($tasks[3] == 2) { ?>

                                <div style="background: linear-gradient(45deg, #7a7a22, #bdba64, #e3e3ac, #ffffe5);" class="accordion__header">
                                    <p class="number"> № <s> <?= $tasks[0]  ?> : </p>
                                    <p class="nametasks"><?= $tasks[1] ?></s></p>
                                    <font class="prioritet-task0"><? $tasks[7]?></font>

                                </div>
                                <div class="accordion__body">
                                <font>Не актуально</font> <!-- Проверяем если статус задачи 1 то выводим Селект где первая запись Активный  -->
                                    <div color="yellow" class="accordion__content">

                                    <pre> <?= $tasks[2]; ?></pre><? 
                                if($tasks[8]=="NULL"){
                                    ?>
                                    
                                    <a href="<?= $tasks[8]; ?>" target="_blank"><img class="pictures-in-tasks" src="<?= $tasks[8]; ?>"></a><?
                                }
                                ?>
                            </div>

                            
                            <?$owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$tasks[4] ");
                            $owner = mysqli_fetch_all($owner);?>


                            <a title="Профиль автора" href="/action/profile2.php?id=<?=$tasks[4];?>" target="_blank">

                                <font class="owner"> <?
                                foreach($owner as $owners){
                                
                                 echo $owners[1];}
                                 ?> </font>
                            </a>


                                    <font class="creation_date"><b>Создано:</b> <?= $tasks[7] ?></font>
<!----------------------------------------Начало пати с комментариями------------------------------------------------------------------>
<div class="comments-block"><?
                                                        foreach ($comment as $comments) { // Перебор массива $ c его записью в массив $
                                                            if ($comments[1] == $tasks[0]) {//Проверяем если айди таска комента равно айди самого таска то выводим его
                                                                echo ($comments[3] . " " . $comments[4] . "<br><hr>" . $comments[2]  . "<a href='$comments[5]'><img src='$comments[5]' class='pictures-in-tasks'></a> <hr class='end-comments'>");
                                                            }
                                                        } ?>
                                <form action="../action/users/addComents_user.php" method="post" enctype="multipart/form-data">
                                    <textarea class="add-comments" name="contant"></textarea><br>
                                    <input type="file" name="picture"><br>
                                    <input type="hidden" name="id_task" value="<?= $tasks[0] ?>">
                                    <button>Добавить</button>
                                </form>
                            </div>
<!----------------------------------------Конец пати с комментариями------------------------------------------------------------------>
                                <? }
                                ?>
                                <script>
                                    new ItcAccordion(document.querySelector('.accordion'), {
                                        alwaysOpen: true
                                    });
                                </script>
                                </div>
                            </div>
                        <? }}?>

</body>
</html>



<?

if ($role!= 1) {
    header('Location: index.php');
    }

?>


