<?
require_once "function/checkaut.php";
require_once "function/checkrole.php";
require_once "function/check-device-for-admin.php";
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
    <link rel="stylesheet" type="text/css" href="css/adminStyle.css">   <!-- Надо переработать вот тут, почистить и сделать норм настройки -->
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
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
            <!-- Тут начинает МИС панель.-->
            <a href="folders/addcreeds.php" target="1"><button>Доступы</button></a>
            <!--<a href="folders/user_list.php" target="_self"><button>Список сотрудников</button></a>-->
            <!--<a href="Taskmanager/task_user.php" target="1"><button>Задачи сотрудникам</button></a>-->
            <!--<a href="folders/addNews.php" target="1"><button>Добавить Новость</button></a>-->
                        <a href="folders/addsiteForm.php" target="1"><button>Добавить сайт</button></a>
            <a href="https://s2.hostiman.ru/phpmyadmin/index.php"><button>База Данных</button></a>
            <a href="https://my.hostiman.ru/cabinet/services/shared/files/245637"><button>Менеджер файлов</button></a>
            <a href="folders/TgBotForm.php" target="1"><button class="btn_tg_index">Бот</button></a>
            <a href="finance/finance.php" target="_blank"><button class="btn_tg_index">Финансы</button></a>
            <a href="folders\ventor_map.php" target="_blank"><button class="btn_tg_index">Карта</button></a>
            <a href="folders\tracking.php" target=""><button class="btn_tg_index">Трек</button></a>
            
           
           </div><!-- Тут заканчивается МИС панель-->
        <hr class="misPanel-hr" width="85%"><!-- ХРка полоска -->
       <div class="body">   <!-- Начало Тела сайта -->
            <div class="container">
                <iframe name="1" src="">
                </iframe>
            
            </div>
            <!-- ТАм вообще есть отдельный файл с проверкой, надо с ним поработать -->
            <?php if ($_SESSION['user']['status'] == 9) { ?><!-- Берем Роль пользователя и проверяем если она равно 9 (у нас это админ) то показываем Правое меню-->
                <div class="rmenu">
                    <iframe name="task" src="Taskmanager/task_bootstrap.php">
                    </iframe>
                </div>
            <?  } else { 
            ?><div class="not-visible-rmenu"><iframe name="" src=""></iframe></div>
            <?
            }
            ?>
            <!-- </div> -->
        </div>
        <hr class="footer-hr">
        <div class="footer">
            
                <div></div>
            
            <div class="refresh">
            <p class="ink"><br><img src="file/icons/Logo.png" alt="test"><br>
                 ORStudio <br> Оксентий Роман Сергеевич Студио <br> Copyright 2022-2023 </p>
            </div>
            <div id="clock" class="clock">         
            <script src="JavaScript/clock.js">
            </script> <!-- Подключение файла с часами-->
            </div><!-- ЧАСЫ-->
        </div>
    </div>
</body>

</html>