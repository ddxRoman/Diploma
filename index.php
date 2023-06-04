<?    
session_start();
require_once "function/checkaut.php";
require_once "function/checkrole.php";
require_once "action/connect.php";

$id_user= $_SESSION['user']['id'];
$type= $_SESSION['personal']['status'];
$setting = mysqli_query($connect, "SELECT*FROM `settings_users` WHERE `id_user`='$id_user'"); 
$setting = mysqli_fetch_assoc($setting);
$bg_color=$setting['background'];
$text_color=$setting['text_color'];

?>
<style>
body{
background-color: <?=$bg_color?>;
color: <?=$text_color?>;
}
button{
color: <?=$text_color?>;
}
</style>




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
                    <button class="MD">CSD</button>
                </a><!--  Просто кнопка на Хелпер --> <?}?>
            </div><!--  Просто кнопка на Хелпер -->
            <div class="Right_head">
                <!-- Правый верхний блок с профилем-->
                <? require_once "action\profileindex.php"; ?>
                <!-- Просто подключение другого файла в этот блок-->
            </div><!-- Правый верхний блок с профилем-->
        </div> <!-- Конец хедера-->
        <div class="MisPanel">
            <!-- Тут начинает МИС панель.-->
            <? $mailLink=$_SESSION['user']['mail'];
            ?>
            <a href="action/users/settings.php"><button>Настройки</button></a>
            <a href="https://<?=$mailLink?>" target="_blank"><button>Почта</button></a>
            <a href="Test.php" target="_blank"><button>Test</button></a>
            <button class="info__add">Добавить кнопку</button>

           </div><!-- Тут заканчивается МИС панель-->
        <hr class="misPanel-hr" width="85%"><!-- ХРка полоска -->
       <div class="body">   <!-- Начало Тела сайта -->
            <div class="lmenu"> 
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
<script>
       
       $('.info__add').click(function () {
           name= prompt('Введите название кнопки: ', ['Новая кнопка']);
         $(this).parent().append($('<a>', {
           'text': name, 'href': 'folders/newTask.php', 'target': '1'
         }));
       });
     </script>