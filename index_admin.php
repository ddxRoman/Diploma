<?
require_once "function/checkaut.php";
require_once "function/checkrole.php";
require_once "action/connect.php";
$bgColor=$_POST['bg'];
$textColor=$_POST['txtColor'];
if ($_SESSION['user']['status'] != 9) {
    header('Location: index.php');
    }
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
    <title>ORS-Admin</title>
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
                <a href="https://medcloud.csd.com.ua/" target="_blank">
                    <!--  Просто кнопка на Хелпер -->
                    <button class="MD">Админка</button>
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
            
            <a href="Test.php" target="_blank"><button>Test</button></a>
            <button class="info__add">Добавить кнопку</button>




           </div><!-- Тут заканчивается МИС панель-->
        <hr class="misPanel-hr" width="85%"><!-- ХРка полоска -->
       <div class="body">   <!-- Начало Тела сайта -->
            <div class="lmenu"> 
                <div class="links">

                

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
<script>
       
       $('.info__add').click(function () {
           name= prompt('Введите название кнопки: ', ['Новая кнопка']);
         $(this).parent().append($('<a>', {
           'text': name, 'href': 'folders/docs.php', 'target': '1'
         }));
       });
     </script>