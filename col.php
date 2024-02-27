<?    
session_start();
// require_once "function/checkaut.php";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/button.css">
    <title>ORS</title>
</head>

<body>
        <div class="container">
        <div class="row align-items-center">
            <div class="border col-md-3 col-sm-6 col-8 " >  
            <? require_once "folders/quick_transition.php"; ?>
        </div>
            <div class="border col-md-6 col-sm-2 col-2 text-center align-middle">
 <? if($_SESSION['user']['status'] == 9){?>
                    <a href="index_admin.php" target="_self">
                    <!--  Просто кнопка на Админка -->
                    <button class="MD">Админка</button>
                </a><!--  Просто кнопка на Админку-->
                <?} else{?>
                <a href="folders/knowledge.php" target="_blank">
                    <!--  Просто кнопка на Хелпер -->
                    <button class="MD">База знаний</button>
                </a><!--  Просто кнопка на Хелпер --> <?}?>
        </div> 
            <div class="border col-md-3 col-sm-3 col-12  text-end">
 <? require_once "action/profileindex2.php"; ?>
        </div>               
        </div>
    </div>

    <div class="container col-md-12 col-sm-12 col-xs-12 navbar MisPanel" >
           <? $mailLink=$_SESSION['user']['mail'];
            ?>
            <a href="action/users/settings.php" target="_blank"><button><img src="file/icons/settings.png" >Настройки</button></a>
            <a href="https://meet.google.com/" target="_blank"><button><img src="file/icons/yabridg.png">Meet</button></a>
            <a href="https://mail.google.com" target="_blank"><button>Почта</button></a>
            <a href="https://topvisor.com/project/keywords/7394510/#&volumeType=6&priceType=P11" target="_blank"><button><b>TOP</b><i>visor</i></button></a>
            <a href="https://docs.google.com/spreadsheets/d/1831n04opuq0QCen2fzRKy6H8lgLxIxD5sODwKxvh6s4/edit#gid=1808514170" target="_blank"><button>Шорт Аналики</button></a>
            <a href="https://vremya-dobryh.ru/" target="_blank"><button>Время Добрых</button></a>
            <a href="https://jira.bizonoff-dev.net/projects/KINDPEOPLE/" target="_blank"><button>Наша Жира</button></a>
            <a href="https://calendar.google.com/calendar/u/0/r?cid=medcloud.pro@gmail.com" target="_blank"><button>Календарь</button></a>
            <a href="folders/countsymbolForm.php" target="1"><button>Подсчёт</button></a>
           </div><!-- Тут заканчивается МИС панель-->
 <hr class="misPanel-hr" width="100%">
    <!-- ХРка полоска -->
        <div class="container">
            <div class="row">
                <div class="col-md-1 col-sm-3 col-4">
                    <div class="lmenu"> 
                 <a href="folders/docs.php" target="1"><button>Доки</button></a>
                    <a href="folders/helper.php" target="1"><button>Хелпер</button></a>      
                    <a href="/folders/GooglFolders.php" target="1"><button>Папки</button></a>                 
                    <a href="folders/Backlog.php" target="1"><button>Старье</button></a>
                    <a href="folders/mis.php" target="1"><button>Миски</button></a>
                    <a href="folders/sites.php" target="1"><button class="site_btn">Сайты</button></a>
                    <a href="https://docs.google.com/spreadsheets/d/1mFn7zDyJ47eAOvhSJ-e8eDeBEnwHVbKv/edit#gid=1585440672" target="_blank"><button class="document">МояДока</button></a>
                    <a href="https://drive.google.com/drive/u/0/my-drive" target="_blank"><button>ГуглДиск</button></a>
            <? foreach($button as $buttons){
                    ?><a href="<?=$buttons[3]?>" target="_blank"><button><?=$buttons[2]?></button></a>
<?
            }
            ?>
                </div>
                </div>
                <div class="col-md-6 col-sm-9 col-12 frame">
                     <iframe name="1" src="folders/news.php">
                    
                </iframe>
                </div>
                <div class="col-md-5 col-sm-12 text-center rmenu" >
 <?php 
//  if ($_SESSION['user']['status'] == 9) { 
    ?>
    <!-- Берем Роль пользователя и проверяем если она равно 9 (у нас это админ) то показываем Правое меню-->
                <div class="rmenu">
                    <iframe name="task" src="Taskmanager/task_bootstrap.php">
                    </iframe>
                </div>
            <?  
            // } else { 
            ?>
            <!-- <div class="rmenu">
                    <iframe name="task" src="Taskmanager/task_user.php">
                    </iframe>
                </div> -->
            <?
            // }
            ?>
            </div>
<hr>
<footer>
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-2 col-5 text-start"><?require_once 'function/weather.php';?></div>
                    <div class="col-md-6 col-sm-8 col-2 text-center"><p class="ink"><img src="file/icons/Logo.png" alt="test"><br>
                 ORStudio <br> Оксентий Роман Сергеевич Студио <br> Copyright 2022-2023 </p></div>
                    <div class="col-md-3 col-sm-2 col-5 text-center">
                        
                        <div id="clock" class=" h3 clock text-end">         
            <script src="JavaScript/clock.js">
            </script> <!-- Подключение файла с часами-->
            </div><!-- ЧАСЫ-->
                        
                        </div>
                </div>
            </div>
</footer>
</body>
</html>