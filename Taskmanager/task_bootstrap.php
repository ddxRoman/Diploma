<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styleaccordion.css">
    <!-- <link rel="stylesheet" type="text/css" href="../css/button.css"> -->
    <title>Document</title>
</head>
<body>
<?php
        require_once '../action/connect.php'; // Проверка подключения к БД
        $product = mysqli_query($connect, "SELECT * FROM `tasks` ORDER BY `status` ASC, `date_close` DESC, `id` DESC "); // Подключение к определенной таблице, и получение Статуса записи
        $product = mysqli_fetch_all($product); // Выбирает все строки из набора $product и помещает их в массив  $product
        $comment = mysqli_query($connect, "SELECT * FROM `comments` ORDER BY `id` ASC "); // Подключение к определенной таблице, и получение Статуса записи
        $comment = mysqli_fetch_all($comment); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments
        foreach ($product as $products) { // Перебор массива $product c его записью в массив $productS
            $iLoveMyPrettyWife++; ?>
<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">

    <!------------------------------------------------------------------------------------- Вывод таски с статусом актуально ----------------------------------------------------------------->

  <? if ($products[3] == 0) { ?>
    <div class="accordion-header" >
      <button  class="accordion-button collapsed<?=$iLoveMyPrettyWife?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?=$iLoveMyPrettyWife?>" aria-expanded="false" aria-controls="flush-collapse<?=$iLoveMyPrettyWife?>" style="background: linear-gradient(45deg, #c436369a, #d0d7d8, #d0d7d8, #d0d7d8, #c4363667)">
      <a href="#" target="_blank"><p class="number"> № <?= $products[0]?>:</p></a><!-- Вот тут ссылка на весь экран-->
                            <p class="nametasks"><?= $products[1] ?></p>
                            <? if ($products[5] == 0) { // Проверка на статус таски, и вывод приоитета возле названия в заголовке
                            ?><font class="prioritet-task0 text-right">Backlog</font><?
                                                                            } else if ($products[5] == 1) { ?><font class="prioritet-task1">Надо сделать</font> <?
                                                                                                        } else if ($products[5] == 2) { ?><font class="prioritet-task2">Нет знаний</font><?
                                                                                                        }
                                                                                                            ?>
      </button>
    </div>
    <div id="flush-collapse<?=$iLoveMyPrettyWife?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
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
                                <div  data-bs-toggle="modal" data-bs-target="#start">
                    <div class="itd_triangle"><img width="16px"  src="../file/icons/delete.png">
                    

                </div>


                    </div>
                            </form>
                    <input type="button" onclick="writeId()" value="ID">
<script>
  function writeId() {
    <?$id=$products[0];?>
    alert(<?=$id?>)
  }
</script>

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
    </div>
    </div>

    <!----------------------------------------------------------- Вывод таски со статусо закрыто ---------------------------------------------------------->
    <?
}

 if ($products[3] == 1) { ?>
  <div class="accordion-header" >
    <button  class="accordion-button collapsed<?=$iLoveMyPrettyWife?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?=$iLoveMyPrettyWife?>" aria-expanded="false" aria-controls="flush-collapse<?=$iLoveMyPrettyWife?>" style="background: linear-gradient(45deg, #58c436, #7ed66a, #b4e3ac, #e9ffe5);">
    <a href="#" target="_blank"><p class="number"> № <?= $products[0]?>:</p></a><!-- Вот тут ссылка на весь экран-->
                          <p class="nametasks"><?= $products[1] ?></p>
    </button>
  </div>
  <div id="flush-collapse<?=$iLoveMyPrettyWife?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
    <div class="accordion-body">
    <form action="../action/statusTask.php?id=<?= $products[0] ?>" method="post" name="form"> <!-- форма с селектами-->
                              <select name="currency" onchange="this.form.submit()">
                                  <? //if ($product[3] == 0) { 
                                  ?> <!-- Проверяем если статус задачи 1 то выводим Селект где первая запись Активный  -->
                                  <option value="1">Закрыто</option>
                                  <option value="0">Актуально</option>
                                  <option value="2">Не актуально</option>
                                  <? //}
                                  ?>
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
  </div>
  </div>




<!-- Вывод тасок со статусом не актуально -->

<!-- Конец вывода всех тасок с любыми статусами -->
<?
}

 if ($products[3] == 2) { ?>
  <div class="accordion-header" >
    <button  class="accordion-button collapsed<?=$iLoveMyPrettyWife?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?=$iLoveMyPrettyWife?>" aria-expanded="false" aria-controls="flush-collapse<?=$iLoveMyPrettyWife?>" style="background: linear-gradient(45deg, #7a7a22, #bdba64, #e3e3ac, #ffffe5);">
    <a href="#" target="_blank"><p class="number"> № <?= $products[0]?>:</p></a><!-- Вот тут ссылка на весь экран-->
                          <p class="nametasks"><?= $products[1] ?></p>
                         
    </button>
  </div>
  <div id="flush-collapse<?=$iLoveMyPrettyWife?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
    <div class="accordion-body">
    <form action="../action/statusTask.php?id=<?= $products[0] ?>" method="post" name="form"> <!-- форма с селектами-->
                              <select name="currency" onchange="this.form.submit()">
                                  <? //if ($product[3] == 0) { 
                                  ?> <!-- Проверяем если статус задачи 1 то выводим Селект где первая запись Активный  -->
                                  <option value="2">Не актуально</option>
                                  <option value="0">Актуально</option>
                                  <option value="1">Выполнено</option>
                                  <? //}
                                  ?>
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
  </div>
  </div>

<? }
        }
?>

<div class="modal fade" id="start" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Вы действительно хотите удалить?</h5>
      </div>
      <div class="modal-body">
      <div class='embed-container'>
      <a href="delete_task.php?id=<?=$id?>"><button type="button">Да</button></a>
      <button type="button">Нет</button>
      </div>
      </div>
    </div>
  </div>
</div>



</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

