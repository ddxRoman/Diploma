<?php session_start(); 
$id_user=$_SESSION['user']['id'];
$status_user = $_SESSION['user']['status'];
require_once '../action/connect.php';
$product = mysqli_query($connect, "SELECT * FROM `tasks` ORDER BY `status` ASC, `date_close` DESC, `id` DESC "); 
$product = mysqli_fetch_all($product);
$comment = mysqli_query($connect, "SELECT * FROM `comments` ORDER BY `id` ASC "); 
$comment = mysqli_fetch_all($comment); 
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
        <div class="taskheader">
            <a class="Aaddtask" href="../folders/newTask.php"><button class="addtask" title="Добавить задачу">+</button></a>
        </div>
        <?php
        foreach ($product as $products) { 
            $owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$products[4] ");
            $owner = mysqli_fetch_all($owner);
            if($products[5]==$id_user || $status_user==1936){
            ?>
            <script src="../JavaScript/accordion.js"></script> 
            <div id="accordion" class="accordion" style="max-width: 30rem; margin: 1rem auto;"> 
                <div class="accordion__item">
                    <? if ($products[3] == 0) { ?>
                        <div class="accordion__header" style="background: linear-gradient(45deg, #c436369a, #d0d7d8, #d0d7d8, #d0d7d8, #c4363667)">
                        <a href="#" target="_blank"><p class="number"> № <?= $products[0]?>:</p></a>
                            <p class="nametasks"><?= $products[1] ?></p>
                            <? if ($products[6] == 0) { 
                            ?><font class="prioritet-task0">Заметка</font><?
                                                                            } else if ($products[5] == 1) { ?><font class="prioritet-task1">Надо сделать</font> <?
                                                                                                        } else if ($products[5] == 2) { ?><font class="prioritet-task2">Срочно</font><?
                                                                                                        }
                                                                                                            ?>
                        </div>
                        <div class="accordion__body">
                            <form action="../action/statusTask.php?id=<?= $products[0] ?>" method="post" name="form">
                                <select name="currency" onchange="this.form.submit()">

                                    <option value="0" >Актуально</option>
                                    <option value="1" >Выполнено</option>
                                    <option value="2" >Не актуально</option>
                                    <? 
                                    ?>
                                </select>
                                <a href="../action/editTask.php?id=<?= $products[0] ?>"><img width="16px" height="16px" title="Редактировать" src="../file/icons/edit.png"></a>
                                <select name="priority" onchange="this.form.submit()">
                                <? if ($products[6] == 0) { ?>
                                        <option value="0" selected>Срочно</option>
                                        <option value="1">Надо сделать</option>
                                        <option value="2">Заметка</option>
                                    <?
                                    } else if ($products[6] == 1) { ?>
                                        <option value="0">Срочно</option>
                                        <option value="1" selected>Надо сделать</option>
                                        <option value="2">Заметка</option>
                                    <?
                                    } else if ($products[6] == 2) { ?>
                                        <option value="0">Срочно</option>
                                        <option value="1">Надо сделать</option>
                                        <option value="2" selected>Заметка</option>
                                    <?
                                    } ?>
                                </select>
                                <form action="../action/accept_delete.php?id=<?= $products[0] ?>" method="post" name="real_delete">
                                    <a href="../action/accept_delete.php?id=<?= $products[0] ?>"><img src="/file/icons/delete.png" width="16px" height="16px"></a>
                                </form>
                            </form>
                            <div class="accordion__content">
                            <pre> <?= $products[2]; ?></pre><? 
                                if($products[9]=="NULL"){
                                    ?>
                                    <a href="<?= $products[9]; ?>" target="_blank"><img class="pictures-in-tasks" src="<?= $products[9]; ?>"></a><?
                                }
                                ?>
                            </div>
                                <a title="Профиль автора" href="/action/profile2.php?id=<?=$products[4];?>" target="_blank">
                                <font class="owner"> <?
                                foreach($owner as $owners){
                                 echo $owners[1];}
                                 ?> </font>
                            </a>
                            <font class="creation_date"><b>Создано:</b> <?= $products[7] ?></font>
                            <div class="comments-block"><?
                                               foreach ($comment as $comments) { 
                                          foreach ($owner as $owners){
                                                          $owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$products[4] ");
                                              $owner = mysqli_fetch_all($owner);
                                         if ($comments[1] == $products[0]) {
                                                if($comments[5]==" "){
                                                
                                                       echo ($owners[1] . " " . $comments[4] . "< br><hr>" . $comments[2]  . "<a href='$comments[5]'><img src='$comments[5]' class='pictures-in-tasks'></a> <hr class='end-comments'>");
                                                              }else{
                                                            echo ($owners[1] . " " . $comments[4] . "< br><hr>" . $comments[2]);
                                                           }}}
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
                        <? } 
                    else  if ($products[3] == 1) {  ?>
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
                                <font class="creation_date"><b>Создано:</b> <?= $products[7] ?></font> 
                                <font class="creation_date"><b>Закрыто:</b> <?= $products[8] ?></font>
<div class="comments-block"><?
                                                        foreach ($comment as $comments) { 
                                                            foreach ($owner as $owners){
                                                                            $owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$products[4] ");
                                                                $owner = mysqli_fetch_all($owner);
                                                           if ($comments[1] == $products[0]) {
                                                                  if($comments[5]==" "){
                                                                  
                                                                         echo ($owners[1] . " " . $comments[4] . "< br><hr>" . $comments[2]  . "<a href='$comments[5]'><img src='$comments[5]' class='pictures-in-tasks'></a> <hr class='end-comments'>");
                                                                                }else{
                                                                              echo ($owners[1] . " " . $comments[4] . "< br><hr>" . $comments[2]);
                                                                             }}}
                                                            } ?>
                                <form action="../action/addComents.php" method="post" enctype="multipart/form-data">
                                    <textarea class="add-comments" name="contant"></textarea><br>
                                    <input type="file" name="picture"><br>
                                    <input type="hidden" name="id_task" value="<?= $products[0] ?>">
                                    <button>Добавить</button>
                                </form>
                            </div>
                            <?
                        }  
                        else if ($products[3] == 2) { ?>
                                <div style="background: linear-gradient(45deg, #7a7a22, #bdba64, #e3e3ac, #ffffe5);" class="accordion__header">
                                    <p class="number"> № <s> <?= $products[0]  ?> : </p>
                                    <p class="nametasks"><?= $products[1] ?></s></p>
                                    <? if ($products[5] == 0) {
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
                                    <font class="creation_date"><b>Создано:</b> <?= $products[7] ?></font>
<div class="comments-block"><?
                                   foreach ($comment as $comments) { 
                                    foreach ($owner as $owners){
                                                    $owner = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`=$products[4] ");
                                        $owner = mysqli_fetch_all($owner);
                                   if ($comments[1] == $products[0]) {
                                          if($comments[5]==" "){
                                          
                                                 echo ($owners[1] . " " . $comments[4] . "< br><hr>" . $comments[2]  . "<a href='$comments[5]'><img src='$comments[5]' class='pictures-in-tasks'></a> <hr class='end-comments'>");
                                                        }else{
                                                      echo ($owners[1] . " " . $comments[4] . "< br><hr>" . $comments[2]);
                                                     }}}
                                    } ?>
                                <form action="../action/addComents.php" method="post" enctype="multipart/form-data">
                                    <textarea class="add-comments" name="contant"></textarea><br>
                                    <input type="file" name="picture"><br>
                                    <input type="hidden" name="id_task" value="<?= $products[0] ?>">
                                    <button>Добавить</button>
                                </form>
                            </div>
                                <? }
                                ?>
                                <script>
                                    new ItcAccordion(document.querySelector('.accordion'), {
                                        alwaysOpen: true
                                    });
                                </script>
                                </div>
                            </div>
                        <?} }?>
                        </div>
                    <?
                    echo "Для вас нет новых задач";
                    ?>
</body>
</html>