<?
require_once "function/profilecheck.php";
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
    <link rel="stylesheet" type="text/css" href="css/adminStyle.css">  
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORS-Admin</title>
    <script>
        if('serviceWorker' in navigator) {
          navigator.serviceWorker.register('sw.js');
        };
      </script>
</head>
<body>
    <div class="all">
        <div class="header">
            <div class="quick_transition">
            </div>
            <div class="knowledge">
                <a href="index.php" target="_self">
                    <button class="MD">Рабочая область</button>
                </a>
            </div>
            <div class="Right_head">
                <? require_once "action/profileindex.php"; ?>
            </div>
        </div>
        <div class="MisPanel">
            <a href="folders/user_list.php" target="_self"><button>Список сотрудников</button></a>
            <a href="Taskmanager/task.php" target="1"><button>Задачи сотрудникам</button></a>
            <a href="folders/addNews.php" target="1"><button>Публикации</button></a>
           </div>
        <hr class="misPanel-hr" width="85%">
       <div class="body">
            <div class="lmenu"> 
                <div class="links">
                </div>
             </div>
            <div class="container">
                <iframe name="1" src="">
                </iframe>
            </div>
            <?php if ($_SESSION['user']['status'] == 9) { ?>
                <div class="rmenu">
                    <iframe name="task" src="Taskmanager/Task.php">
                    </iframe>
                </div>
            <?  } else { 
            ?><div class="not-visible-rmenu"><iframe name="" src=""></iframe></div>
            <?
            }
            ?>
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
            </script>
            </div>
        </div>
    </div>
</body>
</html>