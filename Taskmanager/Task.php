<?php session_start(); ?>
<!doctype html>
<html lang="ru">

<head>
    <link rel="stylesheet" type="text/css" href="../css/styleaccordion.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <!-- <link rel="stylesheet" type="text/css" href="../css/style_redesign.css"> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Taskmanager</title>
</head>

<body>
        <div class="taskheader">
            <a class="Aaddtask" href="../folders/newTask.php"><button class="addtask" title="Добавить задачу">+</button></a> <!-- Кнопка добавления таски-->
        </div>
        <?php
        require_once '../action/connect.php'; // Проверка подключения к БД
        $product = mysqli_query($connect, "SELECT * FROM `tasks` ORDER BY `status` ASC, `date_close` DESC, `id` DESC "); // Подключение к определенной таблице, и получение Статуса записи
        $product = mysqli_fetch_all($product); // Выбирает все строки из набора $product и помещает их в массив  $product
        $comment = mysqli_query($connect, "SELECT * FROM `comments` ORDER BY `id` ASC "); // Подключение к определенной таблице, и получение Статуса записи
        $comment = mysqli_fetch_all($comment); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments
        foreach ($product as $products) { // Перебор массива $product c его записью в массив $productS
            $k++; ?>
            <script src="../JavaScript/accordion.js"></script> <!-- Cкрипт аккордиона-->
            <div id="accordion" class="accordion" style="max-width: 30rem; margin: 1rem auto;"> <!-- общий див всего акордиона-->
                <div class="accordion__item">
                    <!-------------------------------------------- Проверяем если статус задачи 0, то выводим эти результаты----------------------------->
                    <? if ($products[3] == 0) { ?>
                        <div class="accordion__header" style="background: linear-gradient(45deg, #c436369a, #d0d7d8, #d0d7d8, #d0d7d8, #c4363667)"> <!-- Верхний див где номер таски и имя -->
                        <a href="#" target="_blank"><p class="number"> № <?= $products[0]?>:</p></a><!-- Вот тут ссылка на весь экран-->
                            <p class="nametasks"><?= $products[1] ?></p>
                            <? if ($products[5] == 0) { // Проверка на статус таски, и вывод приоитета возле названия в заголовке
                            ?><font class="prioritet-task0">Backlog</font><?
                                                                            } else if ($products[5] == 1) { ?><font class="prioritet-task1">Надо сделать</font> <?
                                                                                                        } else if ($products[5] == 2) { ?><font class="prioritet-task2">Нет знаний</font><?
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


                            <pre> <?= $products[2]; ?></pre><? 
                                if($products[8]!="NULL"){
                                    ?>
                                    
                                    <a href="<?= $products[8]; ?>" target="_blank"><img class="pictures-in-tasks" src="<?= $products[8]; ?>"></a><?
                                }
                                ?>
                            </div>

                            
                            <?$owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$products[4] ");
                            $owner = mysqli_fetch_all($owner);?>


                            <a title="Профиль автора" href="/action/profile2.php?id=<?=$products[4];?>" target="_blank">

                                <font class="owner"> <?
                                foreach($owner as $owners){
                                
                                 echo $owners[1];}
                                 ?> </font>
                            </a>



                            <font class="creation_date"><b>Создано:</b> <?= $products[6] ?></font>
<!----------------------------------------Начало пати с комментариями------------------------------------------------------------------>
                            <div class="comments-block"><?
                                                        foreach ($comment as $comments) { // Перебор массива $ c его записью в массив $
                                                            if ($comments[1] == $products[0]) {//Проверяем если айди таска комента равно айди самого таска то выводим его
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
                                    <input type="hidden" name="id_task" value="<?= $products[0] ?>">
                                    <button>Добавить</button>
                                </form>
                                </div>
                            </div>
<!----------------------------------------Конец пати с комментариями------------------------------------------------------------------>
                        <? } // Тут мы закрыли первую проверку, на то статус 0 Актуальный 
                    else  if ($products[3] == 1) {  ?>
                            <!---------------------------  Тут мы начали вторую проверку, на то статус 1 Закрыто---------------------------------->
                            <div style="background: linear-gradient(45deg, #58c436, #7ed66a, #b4e3ac, #e9ffe5);" class="accordion__header">
                                <p class="number"> № <s> <?= $products[0]  ?> : </p>
                                <p class="nametasks"><?= $products[1] ?></s></p>
                            </div>
                            <div class="accordion__body">
                                <form action="../action/statusTask.php?id=<?= $products[0] ?>" method="post" name="form">
                                    <select name="currency" onchange="this.form.submit()">
                                        <option value="1">Выполнено</option>
                                        <option value="2">Не актуально</option>
                                        <option value="0">Актуально</option>
                                    </select>
                                </form>
                                <div color="yellow" class="accordion__content">

                                <pre> <?= $products[2]; ?></pre><? 
                                if($products[8]=="NULL"){
                                    ?>
                                    
                                    <a href="<?= $products[8]; ?>" target="_blank"><img class="pictures-in-tasks" src="<?= $products[8]; ?>"></a><?
                                }
                                ?>
                            </div>

                            
                            <?$owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$products[4] ");
                            $owner = mysqli_fetch_all($owner);?>


                            <a title="Профиль автора" href="/action/profile2.php?id=<?=$products[4];?>" target="_blank">

                                <font class="owner"> <?
                                foreach($owner as $owners){
                                
                                 echo $owners[1];}
                                 ?> </font>
                            </a>


                                <font class="creation_date"><b>Создано:</b> <?= $products[6] ?></font> <br>
                                <font class="creation_date"><b>Закрыто:</b> <?= $products[7] ?></font>
<!----------------------------------------Начало пати с комментариями------------------------------------------------------------------>
<div class="comments-block"><?
                                                        foreach ($comment as $comments) { // Перебор массива $ c его записью в массив $
                                                            if ($comments[1] == $products[0]) {//Проверяем если айди таска комента равно айди самого таска то выводим его
                                                                echo ($comments[3] . " " . $comments[4] . "< br><hr>" . $comments[2]  . "<a href='$comments[5]'><img src='$comments[5]' class='pictures-in-tasks'></a> <hr class='end-comments'>");
                                                            }
                                                        } ?>
                                <form action="../action/addComents.php" method="post" enctype="multipart/form-data">
                                    <textarea class="add-comments" name="contant"></textarea><br>
                                    <input type="file" name="picture"><br>
                                    <input type="hidden" name="id_task" value="<?= $products[0] ?>">
                                    <button>Добавить</button>
                                </form>
                            </div>
<!----------------------------------------Конец пати с комментариями------------------------------------------------------------------>
                            <?
                        }  // Тут мы закрыли вторую проверку, на то статус 1 Закрыто 
                        else if ($products[3] == 2) { ?>

                                <div style="background: linear-gradient(45deg, #7a7a22, #bdba64, #e3e3ac, #ffffe5);" class="accordion__header">
                                    <p class="number"> № <s> <?= $products[0]  ?> : </p>
                                    <p class="nametasks"><?= $products[1] ?></s></p>
                                    <? if ($products[5] == 0) { // Проверка на статус таски, и вывод приоитета возле названия в заголовке
                                    ?><font class="prioritet-task0">Backlog</font><?
                                                                            } else if ($products[5] == 1) { ?><font class="prioritet-task1">Надо сделать</font> <?
                                                                                                        } else if ($products[5] == 2) { ?><font class="prioritet-task2">Нет знаний</font><?
                                                                                                        }?>
                                </div>
                                <div class="accordion__body">
                                    <form action="../action/statusTask.php?id=<?= $products[0] ?>" method="post" name="form">
                                        <select name="currency" onchange="this.form.submit()">
                                            <option value="2">Не актуально</option>
                                            <option value="1">Выполнено</option>
                                            <option value="0">Актуально</option>
                                        </select>
                                    </form>
                                    <div color="yellow" class="accordion__content">
                                    <pre> <?= $products[2]; ?></pre><? 
                                if($products[8]=="NULL"){
                                    ?>
                                    
                                    <a href="<?= $products[8]; ?>" target="_blank"><img class="pictures-in-tasks" src="<?= $products[8]; ?>"></a><?
                                }
                                ?>
                            </div>

                            
                            <?$owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$products[4] ");
                            $owner = mysqli_fetch_all($owner);?>


                            <a title="Профиль автора" href="/action/profile2.php?id=<?=$products[4];?>" target="_blank">

                                <font class="owner"> <?
                                foreach($owner as $owners){
                                
                                 echo $owners[1];}
                                 ?> </font>
                            </a>
                                    <font class="creation_date"><b>Создано:</b> <?= $products[6] ?></font>
<!----------------------------------------Начало пати с комментариями------------------------------------------------------------------>
<div class="comments-block"><?
                                                        foreach ($comment as $comments) { // Перебор массива $ c его записью в массив $
                                                            if ($comments[1] == $products[0]) {//Проверяем если айди таска комента равно айди самого таска то выводим его
                                                                echo ($comments[3] . " " . $comments[4] . "<br><hr>" . $comments[2]  . "<a href='$comments[5]'><img src='$comments[5]' class='pictures-in-tasks'></a> <hr class='end-comments'>");
                                                            }
                                                        } ?>
                                <form action="../action/addComents.php" method="post" enctype="multipart/form-data">
                                    <textarea class="add-comments" name="contant"></textarea><br>
                                    <input type="file" name="picture"><br>
                                    <input type="hidden" name="id_task" value="<?= $products[0] ?>">
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
                        <? }
                    if ($product[3] == 1) {
                        echo ('AAAa go home nigga');
                    } else ?>
                        </div>
                    <?
             
                    header('Location: ../action/NoRules.php');
                
                    ?>
</body>
</html>