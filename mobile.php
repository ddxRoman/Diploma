<?    
session_start();
$current_year=date("Y");
require_once "function/checkaut.php";
require_once "function/checkrole.php";
require_once "action/connect.php";
// require_once "action/connect_table.php";
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
    <link rel="stylesheet" type="text/css" href="css/mobile-style.css">
    <link rel="stylesheet" type="text/css" href="css/mobile-button.css">
    <link rel="stylesheet" type="text/css" href="css/mobile-profile.css">
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
                            <div>
            <?php 
$now = new DateTime(); // текущее время на сервере
$date = DateTime::createFromFormat("Y-m-d", '2022-10-28'); // задаем дату в любом формате
$interval = $now->diff($date); // получаем разницу в виде объекта DateInterval
if($interval->y>0){
     $days=$interval->days;
}else{ echo "тут вапще щотчык не сработал";}

 ?> <p class="count_married"><?=$days?> Дней </p>

            <?php 
$now = new DateTime(); // текущее время на сервере
$date = DateTime::createFromFormat("Y-m-d", '2022-07-02'); // задаем дату в любом формате
$interval = $now->diff($date); // получаем разницу в виде объекта DateInterval
if($interval->y>0){
     $days=$interval->days;
}else{ echo "тут вапще щотчык не сработал";}

 ?> <p class="count_married"><?=$days?> Дней </p>


            </div>
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
                <a href="folders/knowledge.php" target="_blank">
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
            <? 
            $mailLink=$_SESSION['user']['mail'];
            ?>
            <a href="action/users/settings.php"><button>Настройки</button></a>
            <a href="https://meet.google.com/" target="_blank"><button>Meet</button></a>
            <a href="https://mail.google.com" target="_blank"><button>Почта</button></a>
            <a href="https://topvisor.com/projects/" target="_blank"><button><b>TOP</b><i>visor</i></button></a>
            <a href="https://jira.bizonoff-dev.net/projects/KINDPEOPLE/" target="_blank"><button>Жира</button></a>
            <a href="folders/countsymbolForm.php" target="1"><button>Подсчёт</button></a>
            <a href="folders/creeds.php" target="1"><button>Доступы</button></a>

           </div><!-- Тут заканчивается МИС панель-->

       <div class="body">   <!-- Начало Тела сайта -->
            <div class="lmenu"> 
            <div class="container frame">
                <iframe name="1" src="">
                    
                </iframe>
            </div>

<? foreach($sites_categorie as $sites_categories){
                if($sites_categories[4]==1){?>
    <a href="<?=$sites_categories[3]?>" target="_blank"><button class="document"><?=$sites_categories[1]?></button></a><br>
    <?} else if($sites_categories[4]==0){?>
            <details class="faq-block__item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <summary class="name-part faq-block__question" itemprop="name">
                        <span>
                        <?=$sites_categories[1]?>
                    </span>

            </summary>
                <div itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="faq-block__answer text-section" itemprop="text">
                    <div class="container frame">
<iframe name="1" class="mobile_frame" src="<?=$sites_categories[3]?>">
                    
                </iframe>
            </div>
                    </div>
                </div>
            </details>

<?
} else if($sites_categories[4]==2){?>
    <a href="<?=$sites_categories[3]?>" target="_blank"><button><?=$sites_categories[1]?></button></a><br>
<?
           } else if($sites_categories[4]==3){?>





                <details class="faq-block__item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <summary class="faq-block__question" class="name-part" itemprop="name">
                        <span >
                        <?=$sites_categories[1]?>
                    </span>

            </summary>
                <div itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="faq-block__answer text-section" itemprop="text">
                    <div class="container frame">
<iframe name="1" class="mobile_frame" src="<?=$sites_categories[3]?>">
                    
                </iframe>
            </div>
                    </div>
                </div>
            </details>


              <?}



}?>
<details class="faq-block__item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <summary class="faq-block__question" itemprop="name"><span>Таск Менеджер</span></summary>
                <div itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="faq-block__answer text-section" itemprop="text">
                        



                        <div class="rmenu">
            <?php if ($_SESSION['user']['status'] == 9) { ?><!-- Берем Роль пользователя и проверяем если она равно 9 (у нас это админ) то показываем Правое меню-->
                    <iframe class="taskBootstrap-frame" name="task" src="Taskmanager/task_bootstrap.php">
                    </iframe>

            <?  } else { 
            ?>

                    <iframe class="taskBootstrap-frame" name="task" src="Taskmanager/task_bootstrap.php">
                    </iframe>
                    <?
            }
            ?>
            </div>
                                </div>
                </div>
            </details>


            <!--<a href="folders/docs.php" target="1"><button>Доки</button></a><br>-->
            <!--        <a href="folders/helper.php" target="1"><button>Хелпер</button></a><br>         -->
            <!--        <a href="folders/GooglFolders.php" target="1"><button>Папки</button></a><br>                   -->
            <!--        <a href="folders/Backlog.php" target="1"><button>Старье</button></a><br>-->
            <!--        <a href="folders/mis.php" target="1"><button>Миски</button></a><br>-->
            <!--        <a href="folders/sites.php" target="1"><button class="site_btn">Сайты</button></a><br>-->
            <!--        <a href="https://docs.google.com/spreadsheets/d/1mFn7zDyJ47eAOvhSJ-e8eDeBEnwHVbKv/edit#gid=1585440672" target="_blank"><button class="document">МояДока</button></a><br>-->
            <!--        <a href="https://drive.google.com/drive/u/0/my-drive" target="_blank"><button class="document">ГуглДиск</button></a><br>-->
             </div>




        </div>
        <div class="footer">
                <div>
                    

                    <?php
$apiKey = "72f259ba4f74e5a8d0cbdcebe3a564bd";
$cityId = "542420";
$apiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=ru&units=metric&APPID=" . $apiKey;
$crequest = curl_init();

curl_setopt($crequest, CURLOPT_HEADER, 0);
curl_setopt($crequest, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($crequest, CURLOPT_URL, $apiUrl);
curl_setopt($crequest, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($crequest, CURLOPT_VERBOSE, 0);
curl_setopt($crequest, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($crequest);

curl_close($crequest);
$data = json_decode($response);
$currentTime = time();    
            $temp = $data->main->temp_max;
            $temp = (int)$temp;
?>
        <font class="temperature"><?php echo $temp; ?>°C </font> <br><!-- Температура -->
   <font class="other_parameters"><img src="file/icons/weather/wett.png" width="20px"> <?php echo $data->main->humidity; ?> % <!-- Влажность -->
    <img src="file/icons/weather/wind.png" width="20px"><?php echo $data->wind->speed; ?> м/с<br><!-- Скорость ветра --></font>

                </div>
            <div class="refresh">
            <p class="ink"><img src="file/icons/Logo.png" alt="test"><br>
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
<script>
       $('.info__add').click(function () {
           name= prompt('Введите название кнопки: ', ['Новая кнопка']);
           url= prompt('URL ', ['']);
           if(name!="null" && url!=""){  
         $(this).parent().append($('<a>', { 
           'text': name, 'href': 'http://'+url, 'target': '_blank'}));
        }
        else{}
       }
       );
     </script>