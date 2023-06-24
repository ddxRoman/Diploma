<?
require_once "../function/checkaut.php";
require_once "../function/checkrole.php";
require_once "../action/connect.php";
require_once "../action/users/StyleAndSettings.php";

if ($_SESSION['user']['status'] != 1936) {
    header('Location: ../action/autorization.php');
    }
    $personal = mysqli_query($connect, "SELECT * FROM `users` ORDER BY `id`"); // Подключение к определенной таблице, и получение Статуса записи
    $personal = mysqli_fetch_all($personal); // Выбирает все строки из набора $product и помещает их в массив  $product
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image" href="../file/icons/Logo.png">
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">   <!-- Надо переработать вот тут, почистить и сделать норм настройки -->
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORS-Admin</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#ff0000"/>
    <link rel="manifest" href="JavaScript/manifest.json">
    <script>
        if('serviceWorker' in navigator) {
          navigator.serviceWorker.register('sw.js');
        };
      </script>
</head>

<body>
    <div class="all">
        <!-- Общий блок на всю страницу-->
        <div class="header">
            <!-- Общий Блок на шапку-->
            <div class="quick_transition">
                <!-- Блок С полями в левом верхнем углу-->
                <!-- Подключение файла в котором поля с нашими заказами-->
            </div>
            <div class="knowledge">
                <!--  Просто кнопка на Хелпер -->
                <a href="index.php" target="_self">
                    <!--  Просто кнопка на Хелпер -->
                    <button class="MD">Рабочая область</button>
                </a><!--  Просто кнопка на Хелпер -->
            </div><!--  Просто кнопка на Хелпер -->
            <div class="Right_head">
                <!-- Правый верхний блок с профилем-->
                <? require_once "../action/profileindex.php"; ?>
                <!-- Просто подключение другого файла в этот блок-->
            </div><!-- Правый верхний блок с профилем-->
        </div> <!-- Конец хедера-->
        <div class="MisPanel">
            <!-- Тут начинает МИС панель.-->
            <a href="folders/user_list.php" target="_self"><button>Список сотрудников</button></a>
            <a href="Taskmanager/task_user.php" target="1"><button>Задачи сотрудникам</button></a>
            <a href="folders/addNews.php" target="1"><button>Публикации</button></a>
           </div><!-- Тут заканчивается МИС панель-->
        <hr class="misPanel-hr" width="85%"><!-- ХРка полоска -->
       <div class="body">   <!-- Начало Тела сайта -->
            <div class="lmenu"> 
                <div class="links">
                    
                    
                </div>
             </div>
            <div class="contant">
<table>
<thead>
    <th>Фото</th>
    <th>Фамилия</th>
    <th>Имя</th>
    <th>Отчество</th>
    <th>Номер телефона</th>
    <th>Почта</th>
    <th>Отдел</th>
    <th>Должность</th>
</thead>
<?php
        foreach ($personal as $personals) { // Перебор массива $product c его записью в массив $productS
            ?>
            <tr>
                <td><img class="personal_face" src="<?=$personals[12]?>"> </td>
                <td> <a href="user_card.php?mail=<?=$personals[5]?>"><?=$personals[2]?> </a> </td>
                <td> <a href="user_card.php?mail=<?=$personals[5]?>"><?=$personals[1]?> </a> </td>
                <td> <a href="user_card.php?mail=<?=$personals[5]?>"><?=$personals[3]?> </a> </td>
                <td><?=$personals[4]?> </td>
                <td><?=$personals[5]?> </td>
                <td><?=$personals[8]?> </td>
                <td><?=$personals[7]?> </td>
                <?if($personals[9]!=Null){?>
                <td><a href="<?=$personals[9]?>" target="_self"><img class="logo_messendger"  src="../file/icons/telegram_logo.png" title="Телеграм"></a> </td> <!-- Тут нужна подменя ссылко, десктоп приложение копирует t.me а веб версия это web.telegram -->
                <?} 
                if($personals[10]!=Null){?>
                <td><a href="<?=$personals[10]?>" target="_self"><img class="logo_messendger" src="../file/icons/teams_logo.png" title="Teams" alt="Teams"></a> </td>
                <?} 
                if($personals[11]!=Null){?>
                <td><a href="<?=$personals[11]?>" target="_self"><img class="logo_messendger" src="../file/icons/zoom_logo.png" title="Zoom" alt="Zoom"></a> </td>
                <?}?>
            </tr>    
            <?
        }
      ?>  </table>
                </div>
            <!-- ТАм вообще есть отдельный файл с проверкой, надо с ним поработать -->
        </div>
        <hr class="footer-hr">
        <div class="footer">
                <div></div>
            <div class="refresh">
            <p class="ink"><br><img src="../file/icons/Logo.png" alt="test"><br>
                 ORStudio <br> Оксентий Роман Сергеевич Студио <br> Copyright 2022-2023 </p>
            </div>
            <div id="clock" class="clock">         
            <script src="../JavaScript/clock.js">
            </script> <!-- Подключение файла с часами-->
            </div><!-- ЧАСЫ-->
        </div>
    </div>
</body>
</html>
