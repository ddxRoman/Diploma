<?    
session_start();
require_once "function/profilecheck.php";
require_once "action/connect.php";
require_once "action/users/StyleAndSettings.php";
$button = mysqli_query($connect, "SELECT * FROM `button_user` WHERE `user_id`=$id_user ");
$button = mysqli_fetch_all($button); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image" href="file/icons/Logo/Logo.png">
    <link rel="stylesheet" type="text/css" href="css/Style.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <title>ORS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="header">
            <div class="quick_transition">
                <? require_once "folders/quick_transition.php"; ?>
            </div>
            <div class="knowledge">
                <? if($_SESSION['user']['status'] == 1936){?>
                    <a href="index_admin.php" target="_self">
                    <button class="MD">Админка</button>
                </a>
                <?} else{?>
                <a href="folders/knowledge.php" target="_self">
                    <button class="MD">База знаний</button>
                </a><?}?>
            </div>
            <div class="Right_head">
                <? require_once "action/profileindex.php"; ?>
            </div>
        </div> 
        <div class="MisPanel">
            <? 
            $mailLink=$_SESSION['user']['mail'];
            ?>
            <a href="action/users/settings.php" target="_blank"><button><img src="file/icons/settings.png" >Настройки</button></a>
            <a href="https://<?=$mailLink?>" target="_blank"><button> <img src="file/icons/email.png"> Почта</button></a>
            <a href="https://telemost.yandex.ru/j/05547869279270" target="_blank"><button><img src="file/icons/yabridg.png">Телемост</button></a>
            <a href="folders/news.php" target="1"><button><img src="file/icons/news.png">Новости</button></a>
            <a href="folders/services.php" target="1"><button><img src="file/icons/services.png">Сервисы</button></a>
            <a href="folders/discussion.php" target="1"><button><img src="file/icons/discussion.png">Обсуждение</button></a>
           </div>
        <hr class="misPanel-hr" width="85%">
       <div class="body">   
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
                <div class="rmenu">
                    <iframe name="task" src="Taskmanager/task.php">
                        
                    </iframe>
                </div>
        </div>
        <hr class="footer-hr">
        <div class="footer">
                <div>
                    
                </div>
            <div class="refresh">
            <p class="ink"><img src="file/icons/Logo.png" alt="test"><br>
                 ORStudio <br> Оксентий Роман Сергеевич <br> ИСзб-18 </p>
            </div>
            <div id="clock" class="clock">         
            <script src="JavaScript/clock.js">
            </script> 
            </div>
        </div>
    </div>
</body>
</html>