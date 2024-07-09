<?    
session_start();
$current_year=date("Y");
require_once "../function/checkaut.php";
require_once "../function/checkrole.php";
require_once "../action/connect.php";
require_once "../function/check-device.php";
// require_once "action/connect_table.php";
require_once "../action/users/StyleAndSettings.php";
$button = mysqli_query($connect, "SELECT * FROM `button_user` WHERE `user_id`=$id_user "); // Подключение к определенной таблице, и получение Статуса записи
$button = mysqli_fetch_all($button); // Выбирает все строки из набора $product и помещает их в массив  $product
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="icon" type="image" href="../file/icons/Logo/Logo.png">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>ORS</title>

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
                <? 
                // require_once "folders/quick_transition.php"; 
                ?>
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
                <? require_once "../action/profileindex.php"; ?>
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
            <a href="https://jira.bizonoff-dev.net/secure/Dashboard.jspa" target="_blank"><button>Наша Жира</button></a>
            <a href="folders/countsymbolForm.php" target="1"><button>Подсчёт</button></a>
            <a href="folders/creeds.php" target="1"><button>Доступы</button></a>
           </div><!-- Тут заканчивается МИС панель-->
        <hr class="misPanel-hr" width="85%"><!-- ХРка полоска -->
       <div>   <!-- Начало Тела сайта -->









       <div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
       <h3> <?php $developer[1] ?> Developer Name</h3>
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
 <div class="paremetrs_task">

     
     
     <select name="Статус" id="">
         <option value="">Берет потом</option>
          <option value="">Делает</option>
        <option value="">Отдал в тесте</option>
    <option value="">В Тесте у ЦСД</option>
<option value="">Готово к релизу</option>
          <option value="">Закрыто</option>
          </select>
          <select name="" id="">
              <option value="">RWK</option>
        <option value="">SUP</option>
      </select>
    <input placeholder="Номер" type="number">
       <input placeholder="Комментарий" class="task_body" type="text">
    
    
    
    <input placeholder="Дедлайн" type="date" name="" id="">
    </div>
    <div class="other_tasks">

    

    </div>




      </div>
    </div>
  </div>
  
</div>











        </div>



        <hr class="footer-hr">
        <div class="footer">
                <div>

                </div>
            <div class="refresh">
            <p class="ink"><img src="../file/icons/Logo.png" alt="test"><br>
                 ORStudio <br> Оксентий Роман Сергеевич Студио <br> Copyright 2022-<?=$current_year?> </p>
            </div>
            <div id="clock" class="clock">         
            <script src="../JavaScript/clock.js">
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