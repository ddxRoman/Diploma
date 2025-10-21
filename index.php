<?    
session_start();
$current_year=date("Y");
require_once "function/checkaut.php";
require_once "function/checkrole.php";
require_once "action/connect.php";
require_once "function/check-device.php";
// require_once "action/connect_table.php";
require_once "action/users/StyleAndSettings.php";
$button = mysqli_query($connect, "SELECT * FROM `button_user` WHERE `user_id`=$id_user "); // Подключение к определенной таблице, и получение Статуса записи
$button = mysqli_fetch_all($button); // Выбирает все строки из набора $product и помещает их в массив  $product

if($role==5){
    header('Location: treker/treeker.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image" href="file/icons/Logo/Logo.png">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css"> -->
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

<style>
    /* === Глобальные стили === */
:root {
  --bg: #f5f6fa;
  --card: #ffffff;
  --text: #222;
  --accent: #3b82f6;
  --accent-hover: #2563eb;
  --border: #e5e7eb;
  --radius: 12px;
  --shadow: 0 4px 10px rgba(0,0,0,0.08);
  --transition: 0.2s ease;
}

* {
  box-sizing: border-box;
  font-family: "Inter", "Segoe UI", Roboto, Arial, sans-serif;
}

body {
  margin: 0;
  /* background: var(--bg); */

  color: var(--text);
  overflow-x: hidden;
}

/* === Основная сетка === */
.all {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

/* === Шапка === */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  /* background: var(--card); */
    background-color: #0000000e;
  padding: 10px 20px;
  box-shadow: var(--shadow);
  border-radius: 0 0 var(--radius) var(--radius);
  /* position: sticky; */
  top: 0;
  z-index: 1000;
}

.header button,
.MisPanel button,
.lmenu button {
  /* background: var(--accent); */

  /* color: white; */
  border: none;
  border-radius: var(--radius);
  padding: 8px 14px;
  font-size: 14px;
  cursor: pointer;
  transition: var(--transition);
}

.header button:hover,
.MisPanel button:hover,
.lmenu button:hover {
  /* background: var(--accent-hover); */
    background-color: #0000000e;
  transform: translateY(-2px);
}

/* === Панель инструментов (МИС) === */
.MisPanel {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
  /* background: var(--card); */
  margin: 20px auto;
  padding: 15px;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  width: 90%;
}

.misPanel-hr {
  border: none;
  border-top: 1px solid var(--border);
  margin: 0 auto 10px auto;
  width: 85%;
}

/* === Основное тело === */
.body {
  display: grid;
  grid-template-columns: 220px 1fr 450px; /* ← было 300px, стало 450px */
  gap: 20px;
  padding: 20px;
  flex-grow: 1;
}

.lmenu, .rmenu {
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 10px;
  overflow-y: auto;
  max-height: calc(100vh - 220px);
}

/* === Кнопки меню === */
.lmenu button {
  width: 100%;
  margin-bottom: 8px;
  text-align: left;
  font-weight: 500;
}

.lmenu button.document {
  background: #10b981;
}

.lmenu button.document:hover {
  background: #059669;
}

/* === iframe === */
.container iframe,
.rmenu iframe {
  width: 100%;
  height: calc(100vh - 220px);
  border: none;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
}

/* === Нижняя часть === */
.footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  /* background: var(--card); */
  padding: 15px 20px;
  box-shadow: var(--shadow);
  border-radius: var(--radius) var(--radius) 0 0;
}

.footer-hr {
  border: none;
  border-top: 1px solid var(--border);
  width: 85%;
  margin: 20px auto 0;
}

/* === Текст и логотип === */
.refresh {
  text-align: center;
  font-size: 13px;
  color: #555;
}

.refresh img {
  height: 40px;
  margin-bottom: 4px;
}

.clock {
  font-weight: bold;
  font-size: 1.1em;
}

/* === Счётчики дней === */
.count_married,
.count_married_anniversary {
  color: var(--accent);
  font-weight: 800;
  text-align: center;
  margin: 6px 0;
}

/* === Адаптивность === */
@media (max-width: 1100px) {
  .body {
    grid-template-columns: 1fr;
  }

  .lmenu,
  .rmenu {
    display: none;
  }

  .MisPanel {
    width: 95%;
  }
}

@media (max-width: 600px) {
  .header {
    flex-direction: column;
    gap: 10px;
    text-align: center;
  }

  .MisPanel button {
    font-size: 13px;
    padding: 6px 10px;
  }
}

</style>

<body>
    <div class="all">
        <!-- Общий блок на всю страницу-->
        <div class="header">
            <!-- Общий Блок на шапку-->
            <div class="my_life_with_wife">
                <!-- Блок С полями в левом верхнем углу-->
                <? 
                // require_once "folders/quick_transition.php"; 
                ?>
                            <div>
            <?php 
$now = new DateTime(); // текущее время на сервере
$date = DateTime::createFromFormat("Y-m-d", '2022-10-28'); // задаем дату в любом формате
$interval = $now->diff($date); // получаем разницу в виде объекта DateInterval

     $days=$interval->days;


?>
<p alt="Дней в Браке" class="count_married"><?=$days?> Дней </p><?


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

                <? 
                // require_once "action/profileindex.php"; 
                ?>
                <!-- Просто подключение другого файла в этот блок-->
            </div><!-- Правый верхний блок с профилем-->
        </div> <!-- Конец хедера-->
        <div class="MisPanel">
            <!-- Тут начинает МИС панель.-->
            <? 
            $mailLink=$_SESSION['user']['mail'];
            ?>
            <a href="action/users/settings.php"><button>Настройки</button></a>
            <a href="https://telemost.yandex.ru/" target="_blank"><button>Телемост</button></a>
            <a href="https://mail.google.com" target="_blank"><button>Почта</button></a>
            <!-- <a href="https://topvisor.com/projects/" target="_blank"><button><b>TOP</b><i>visor</i></button></a> -->
            <a href="https://jira.bizonoff-dev.net/secure/Dashboard.jspa" target="_blank"><button>Наша Жира</button></a>
            <!-- <a href="folders/CsdTasks.php" target="_blank"><button>Задачи</button></a> -->
            <a href="folders/countsymbolForm.php" target="1"><button>Подсчёт</button></a>
            <a href="folders/creeds.php" target="1"><button>Доступы</button></a>
            <!-- <a href="treker/treeker.php" target="1"><button>Трекер</button></a> -->
            <a href="action\parcer\parcer_csd_excel.php" target="1"><button>Парсер</button></a>
           </div><!-- Тут заканчивается МИС панель-->
        <hr class="misPanel-hr" width="85%"><!-- ХРка полоска -->
       <div class="body">   <!-- Начало Тела сайта -->
            <div class="lmenu"> 
            <? 
             foreach($sites_categorie as $sites_categories){
                if ($sites_categories[5]!=0) {
            if($sites_categories[4]==1){?>
                          <a href="<?=$sites_categories[3]?>" target="_blank"><button class="document"><?=$sites_categories[1]?></button></a><br>
            <?} else if($sites_categories[4]==0){?>
          <a href="<?=$sites_categories[3]?>" target="1"><button><?=$sites_categories[1]?></button></a><br>
           <? } else if($sites_categories[4]==2){?>
                <a href="<?=$sites_categories[3]?>" target="_blank"><button><?=$sites_categories[1]?></button></a><br>
            <?
        }
            else if($sites_categories[4]==3){?>
              <a href="<?=$sites_categories[3]?>" target="1"><button><?=$sites_categories[1]?></button></a><br>
            <?}
           } }?>
             </div>
            <div class="container frame">
                <iframe name="1" src="folders/sites.php">
                    
                </iframe>
            </div>
            <?php if ($_SESSION['user']['status'] == 9) { ?><!-- Берем Роль пользователя и проверяем если она равно 9 (у нас это админ) то показываем Правое меню-->
                <div class="rmenu">
                    <iframe name="task" src="Taskmanager/task_bootstrap.php">
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
                    <?require_once 'function/weather.php';?>
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