<?
require_once "function/checkaut.php";
require_once "function/checkrole.php";
require_once "action/connect.php";
$bgColor=$_POST['bg'];
$textColor=$_POST['txtColor'];

?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image" href="file/icons/Logo.png">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORS</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<style>
    body{
        background-color: var(--bgColor);
        background-color: <?= $bgColor?>;
        color:<?=$textColor?>;
    }
    button{
        color:<?=$textColor?>;
    }
    .One{
        width: 40px;
        height: 40px;
    }
</style>

<body>
    <div class="all">
        <!-- Общий блок на всю страницу-->
        <div class="header">
            <!-- Общий Блок на шапку-->
            <div class="CSD">
                <!-- Блок С полями в левом верхнем углу-->
                <? require_once "folders/CSD.php"; ?>
                <!-- Подключение файла в котором поля с нашими заказами-->
            </div>
            <div class="knowledge">
                <!--  Просто кнопка на Хелпер -->
                <a href="https://medcloud.csd.com.ua/" target="_blank">
                    <!--  Просто кнопка на Хелпер -->
                    <button class="MD">CSD</button>
                </a><!--  Просто кнопка на Хелпер -->
            </div><!--  Просто кнопка на Хелпер -->
            <div class="Right_head">
                <!-- Правый верхний блок с профилем-->
                <? require_once "action\profileindex.php"; ?>
                <!-- Просто подключение другого файла в этот блок-->
            </div><!-- Правый верхний блок с профилем-->
        </div> <!-- Конец хедера-->
        <div class="MisPanel">
            <!-- Тут начинает МИС панель.-->
            <a href="https://docs.google.com/spreadsheets/d/1f6g5RMrzm2Gn0KAlKBroDGILou2tWEqRqbYQOBQaDqA/edit#gid=38707061" target="_blank"><button>Внедрение</button></a>
            <a href="https://mail.google.com" target="_blank"><button>Почта</button></a>
            <a href="https://docs.google.com/spreadsheets/d/1UFitKlsbTb7Iu5thfGb4YPRPj27RckkjRg_g_kg6Cas/edit" target="_blank"><button>ЧекЛист</button></a>
            <a href="https://docs.google.com/spreadsheets/d/1ECgekNqSGOP5MNWge4o1wIHdl8Ep_wAW/edit#gid=1203791252" target="_blank"><button>Трекинг Хелси</button></a>
            <a href="https://docs.google.com/spreadsheets/d/19YQTTlq0D1Cr2q7G54SXC0jGG9MrvUurH6YdhfSX8Wc/edit#gid=0" target="_blank"><button>Трекинг Общий</button></a>
            <a href="https://docs.google.com/spreadsheets/d/1831n04opuq0QCen2fzRKy6H8lgLxIxD5sODwKxvh6s4/edit#gid=479952363" target="_blank"><button>Шорт Аналики</button></a>
        </div><!-- Тут заканчивается МИС панель-->
        <hr class="misPanel-hr" width="85%"><!-- ХРка полоска -->
       <div class="body">   <!-- Начало Тела сайта -->
            <div class="lmenu"> 
                <div class="links">

                
                <?php if ($_SESSION['user']['status'] == 9) {?>
                <form action="#" name="bg" method="post">
                <table>
<tr>
    <th>Select your backgroundcolor: </th>
    <th><input name="bg" type="color" value="<?=$bgColor?>"><br></th>
</tr>
<tr>
    <th>Select text color:</th>
    <th><input name="txtColor" type="Color" value="<?=$textColor?>"><br></th>
</tr></table>
    <button>Применить</button>
    </form>
    <form action="#" name="bg" method="post">
    <button>Clear</button>
    </form>
                <?} ?>
                </div>
             </div>
            <div class="container">
                <iframe name="1" src="">

   </iframe>
           
            </div>
            <?php if ($_SESSION['user']['status'] == 9) { ?><!-- Берем Роль пользователя и проверяем если она равно 9 (у нас это админ) то показываем Правое меню-->
                <div class="rmenu">
                    <iframe name="task" src="Taskmanager/Task.php">
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
            <p class="ink"><img src="file\icons\Logo.png" alt="test"><br>
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