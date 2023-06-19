<?php session_start(); 
$id_user=$_SESSION['user']['id'];

$status_user = $_SESSION['user']['status'];
require_once '../action/connect.php'; // Прaоверка подключения к БД

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
<?if($status_user==9){?>
<div class="taskheader">
            <a class="Aaddtask" href="../action/users/create_task_for_user.php"><button class="addtask_user transition" title="Добавить задачу">+</button></a> <!-- Кнопка добавления таски-->
        </div>
  
        
        <?
            $task = mysqli_query($connect, "SELECT * FROM `user_task`  ORDER BY `status` ASC"); // Подключение к определенной таблице, и получение Статуса записи
        }else {
        $task = mysqli_query($connect, "SELECT * FROM `user_task` WHERE `id_user`=$id_user ORDER BY `status` ASC"); // Подключение к определенной таблице, и получение Статуса записи
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
                        <form action="../action/statusTask.php?id=<?= $tasks[0] ?>" method="post" name="form"> <!-- форма с селектами-->

                                <font class="status">Актуально</font> <!-- Проверяем если статус задачи 1 то выводим Селект где первая запись Активный  -->
                                <? if($status_user==9){?>
                                <form action="../action/accept_delete_user.php?id=<?= $tasks[0] ?>" method="post" name="real_delete">
                                    <a href="../action/accept_delete_user.php?id=<?= $tasks[0] ?>"><img src="/file/icons/delete.png" width="16px" height="16px"></a>
                                </form>
                            <?}?>
                            <div class="accordion__content">
                               <pre> <?= $tasks[2]; ?></pre><? 
                                if($tasks[8]=="NULL"){
                                    ?>
                                    
                                    <a href="<?= $tasks[8]; ?>" target="_blank"><img class="pictures-in-tasks" src="<?= $tasks[8]; ?>"></a><?
                                }
                                ?>
                            </div>
                            <a title="Профиль автора" href="/action/profile2.php?id=<?=$tasks[4];?>" target="_blank">
                                <font class="owner"> <? echo $tasks[4]; ?> </font>
                            </a>
                            <font class="creation_date"><b>Создано:</b> <?= $tasks[6] ?></font>
<!----------------------------------------Начало пати с комментариями------------------------------------------------------------------>
                            <div class="comments-block"><?
                                                        foreach ($comment as $comments) { // Перебор массива $ c его записью в массив $
                                                            if ($comments[1] == $tasks[0]) {//Проверяем если айди таска комента равно айди самого таска то выводим его
                                                               ?><a title="Профиль автора" href="/action/profile2.php?id=<?=$comments[3];?>" target="_blank">
                                <font class="owner-comment"> <? echo $comments[3]; ?> </font>
                            </a><?
                                                                echo ($comments[4] . "<br><hr>" . $comments[2]  . "<a href='$comments[5]'><img src='$comments[5]' class='pictures-in-tasks'></a> <hr class='end-comments'>");
                                                            }
                                                        } ?>
                                                        <div class="block-add-comments">
                                <form action="../action/addComents.php" method="post" enctype="multipart/form-data">
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
                                <span>   <?= $tasks[2]; ?></span> 
                                    <img src="<?= $tasks[8]; ?>">
                                </div>
                                <a title="Профиль автора" href="/action/profile2.php?id=<?=$tasks[4];?>" target="_blank">
                                <font class="owner"> <? echo $tasks[4]; ?> </font>
                            </a>
                                <font class="creation_date"><b>Создано:</b> <?= $tasks[6] ?></font> <br>
                                <font class="creation_date"><b>Закрыто:</b> <?= $tasks[7] ?></font>
<!----------------------------------------Начало пати с комментариями------------------------------------------------------------------>
<div class="comments-block"><?
                                                        foreach ($comment as $comments) { // Перебор массива $ c его записью в массив $
                                                            if ($comments[1] == $tasks[0]) {//Проверяем если айди таска комента равно айди самого таска то выводим его
                                                                echo ($comments[3] . " " . $comments[4] . "< br><hr>" . $comments[2]  . "<a href='$comments[5]'><img src='$comments[5]' class='pictures-in-tasks'></a> <hr class='end-comments'>");
                                                            }
                                                        } ?>
                                <form action="../action/addComents.php" method="post" enctype="multipart/form-data">
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
                                    <? if ($tasks[5] == 0) { // Проверка на статус таски, и вывод приоитета возле названия в заголовке
                                    ?><font class="prioritet-task0">Backlog</font><?
                                                                            } else if ($tasks[5] == 1) { ?><font class="prioritet-task1">Надо сделать</font> <?
                                                                                                        } else if ($tasks[5] == 2) { ?><font class="prioritet-task2">Нет знаний</font><?
                                                                                                        }?>
                                </div>
                                <div class="accordion__body">
                                <font>Не актуально</font> <!-- Проверяем если статус задачи 1 то выводим Селект где первая запись Активный  -->
                                    <div color="yellow" class="accordion__content">
                                        <?= $tasks[2] ?>
                                        <img src="<?= $tasks[8]; ?>">
                                    </div>
                                    <a title="Профиль автора" href="/action/profile2.php?id=<?=$tasks[4];?>" target="_blank">
                                <font class="owner"> <? echo $tasks[4]; ?> </font>
                            </a>
                                    <font class="creation_date"><b>Создано:</b> <?= $tasks[6] ?></font>
<!----------------------------------------Начало пати с комментариями------------------------------------------------------------------>
<div class="comments-block"><?
                                                        foreach ($comment as $comments) { // Перебор массива $ c его записью в массив $
                                                            if ($comments[1] == $tasks[0]) {//Проверяем если айди таска комента равно айди самого таска то выводим его
                                                                echo ($comments[3] . " " . $comments[4] . "<br><hr>" . $comments[2]  . "<a href='$comments[5]'><img src='$comments[5]' class='pictures-in-tasks'></a> <hr class='end-comments'>");
                                                            }
                                                        } ?>
                                <form action="../action/addComents.php" method="post" enctype="multipart/form-data">
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
                        <? }?>

</body>
</html>