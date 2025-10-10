<?
$current_year=date("Y");
require_once "function/checkaut.php";
require_once "function/checkrole.php";
require_once "action/connect.php";
require_once "action/users/StyleAndSettings.php";
if ($role!= 1) {
    header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image" href="file/icons/Logo.png">
    <!-- <link rel="stylesheet" type="text/css" href="css/adminStyle.css">   Надо переработать вот тут, почистить и сделать норм настройки -->
    <link rel="stylesheet" type="text/css" href="css/mobile-style.css">
    <link rel="stylesheet" type="text/css" href="css/mobile-button.css">
    <link rel="stylesheet" type="text/css" href="css/mobile-profile.css">
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
                    <button class="MD">Админка</button>
                </a><!--  Просто кнопка на Хелпер -->
            </div><!--  Просто кнопка на Хелпер -->
            <div class="Right_head">
                <!-- Правый верхний блок с профилем-->
                <? require_once "action/profileindex.php"; ?>
                <!-- Просто подключение другого файла в этот блок-->
            </div><!-- Правый верхний блок с профилем-->
        </div> <!-- Конец хедера-->
        <div class="MisPanel">



           </div><!-- Тут заканчивается МИС панель-->
        <hr class="misPanel-hr" width="85%"><!-- ХРка полоска -->
       <div class="body">   <!-- Начало Тела сайта -->
            <div class="container_admin">
            <a href="folders/addcreeds.php" target="1"><button class=" btn_mob_menu">Доступы</button></a> <br>

            <a href="folders/addsiteForm.php" target="1"><button class=" btn_mob_menu">Сайты</button></a> <br>
            <a href="https://s2.hostiman.ru/phpmyadmin/index.php"><button class=" btn_mob_menu">БД</button></a> <br>
            <a href="https://my.hostiman.ru/cabinet/services/shared/files/245637"><button class=" btn_mob_menu">Файлы</button></a> <br>
            <a href="folders/TgBotForm.php" target="1"><button class=" btn_mob_menu" class="btn_tg_index btn_mob_menu">Бот</button></a> <br>
            <a href="finance/finance.php" target="_blank"><button class="btn_tg_index btn_mob_menu">Финансы</button></a> <br>
            <!-- <a href="folders\ventor_map.php" target="_blank"><button class="btn_tg_index btn_mob_menu">Карта</button></a> <br> -->
            <a href="folders\ventra.php" target="_blank"><button class="btn_tg_index btn_mob_menu">Вентра</button></a> <br>
            <a href="folders\tracking.php" target=""><button class="btn_tg_index btn_mob_menu">Трек</button></a> <br>
            </div>
            
        </div>
        <hr class="footer-hr">
        <div class="footer">
            
                <div></div>
            
            <div class="refresh">
            <p class="ink"><br><img src="file/icons/Logo.png" alt="test"><br>
                 ORStudio <br> Оксентий Роман Сергеевич Студио <br> Copyright 2022-<?=$current_year?> </p>
            </div>
            <div id="clock" class="clock">         
            <script src="JavaScript/clock.js">
            </script> <!-- Подключение файла с часами-->
            </div><!-- ЧАСЫ-->
        </div>
    </div>
</body>

</html>