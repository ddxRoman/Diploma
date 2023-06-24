<?    
session_start();
require_once "function/checkaut.php";
require_once "function/checkrole.php";
require_once "action/connect.php";
require_once "action/users/StyleAndSettings.php";
$button = mysqli_query($connect, "SELECT * FROM `button_user` WHERE `user_id`=$id_user "); // Подключение к определенной таблице, и получение Статуса записи
$button = mysqli_fetch_all($button); // Выбирает все строки из набора $product и помещает их в массив  $product

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image" href="file/icons/Logo/Logo.png">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORS</title>
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
                <? require_once "folders/quick_transition.php"; ?>
                <!-- Подключение файла в котором поля с нашими заказами-->
            </div>
            <div class="knowledge">
                <!--  Просто кнопка на Хелпер -->
                <? if($_SESSION['user']['status'] == 9){?>
                    <a href="index_admin.php" target="_self">
                    <!--  Просто кнопка на Админка -->
                    <button class="MD">Админка</button>
                </a><!--  Просто кнопка на Админку-->
                <?} else{?>
                <a href="folders/knowledge.php" target="_self">
                    <!--  Просто кнопка на Хелпер -->
                    <button class="MD">База знаний</button>
                </a><!--  Просто кнопка на Хелпер --> <?}?>
            </div><!--  Просто кнопка на Хелпер -->
            <div class="Right_head">
                <!-- Правый верхний блок с профилем-->
                <? require_once "action/profileindex.php"; ?>
                <!-- Просто подключение другого файла в этот блок-->
            </div><!-- Правый верхний блок с профилем-->
        </div> <!-- Конец хедера-->
        <div class="MisPanel">
            <!-- Тут начинает МИС панель.-->
            <? $mailLink=$_SESSION['user']['mail'];
            ?>
            <a href="action/users/settings.php" target="_blank"><button><img src="file/icons/settings.png" >Настройки</button></a>
            <a href="https://<?=$mailLink?>" target="_blank"><button> <img src="file/icons/email.png"> Почта</button></a>
            <a href="https://telemost.yandex.ru/j/05547869279270" target="_blank"><button><img src="file/icons/yabridg.png">Телемост</button></a>
            <a href="folders/news.php" target="1"><button><img src="file/icons/news.png">Новости</button></a>
            <a href="folders/services.php" target="1"><button><img src="file/icons/services.png">Сервисы</button></a>
            <a href="folders/discussion.php" target="1"><button><img src="file/icons/discussion.png">Обсуждение</button></a>
           </div><!-- Тут заканчивается МИС панель-->
        <hr class="misPanel-hr" width="85%"><!-- ХРка полоска -->
       <div class="body">   <!-- Начало Тела сайта -->
            <div class="lmenu"> 

            <? foreach($button as $buttons){
                    ?><a href="<?=$buttons[3]?>" target="_blank"><button><?=$buttons[2]?></button></a>
<?
            }
            ?>

             </div>
            <div class="container">
                <iframe name="1" src="folders/news.php">
                    
                </iframe>
            </div>
            <?php if ($_SESSION['user']['status'] == 1) { ?><!-- Берем Роль пользователя и проверяем если она равно 9 (у нас это админ) то показываем Правое меню-->
                <div class="rmenu">
                    <iframe name="task" src="Taskmanager/Task.php">
                        
                    </iframe>
                </div>
            <?  } else { 
            ?>
            <div class="rmenu">
                    <iframe name="task" src="Taskmanager/task_user.php">
                    </iframe>
                </div>
            <?
            }
            ?>
        </div>
        <hr class="footer-hr">
        <div class="footer">
                <div>
                    
                </div>
            <div class="refresh">
            <p class="ink"><img src="file/icons/Logo.png" alt="test"><br>
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
