<?    
session_start();
require_once "../../function/profilecheck.php";
require_once "../connect.php";
require_once "StyleAndSettings.php";
$button = mysqli_query($connect, "SELECT * FROM `button_user` WHERE `user_id`=$id_user ");
$button = mysqli_fetch_all($button); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image" href="../../file/icons/Logo/Logo.png">
    <link rel="stylesheet" type="text/css" href="../../css/adminStyle.css">
    <link rel="stylesheet" type="text/css" href="../../css/button.css">
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

            </div>
            <div class="knowledge">
                <? if($_SESSION['user']['status'] == 1936){?>
                    <a href="../../index_admin.php" target="_self">
                    <button class="MD">Админка</button>
                </a>
                <?} else{?>
                <a href="folders/knowledge.php" target="_self">
                    <button class="MD">База знаний</button>
                </a><?}?>
            </div>
            <div class="Right_head">
                <? require "../profileindex.php"; ?>
            </div>
        </div> 
        <div class="MisPanel">
            <? 
            $mailLink=$_SESSION['user']['mail'];
            ?>
            <a href="action/users/settings.php" target="1"><button><img src="../../file/icons/settings.png" >Настройки</button></a>
            <a href="https://<?=$mailLink?>" target="_blank"><button> <img src="../../file/icons/email.png"> Почта</button></a>
            <a href="https://telemost.yandex.ru/j/05547869279270" target="_blank"><button><img src="../../file/icons/yabridg.png">Телемост</button></a>
            <a href="folders/news.php" target="1"><button><img src="../../file/icons/news.png">Новости</button></a>
            <a href="folders/services.php" target="1"><button><img src="../../file/icons/services.png">Сервисы</button></a>
            <a href="folders/discussion.php" target="1"><button><img src="../../file/icons/discussion.png">Обсуждение</button></a>
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
                <?php
session_start();
require_once '../connect.php'; 
require_once 'StyleAndSettings.php'; 
$id_user= $_SESSION['user']['id'];
$setting = mysqli_query($connect, "SELECT*FROM `users` WHERE `id`='$id_user'"); 
$setting = mysqli_fetch_assoc($setting);
$bg_color=$setting['background'];
$text_color=$setting['text_color'];
$btn_color=$setting['btn_color'];
?><head>
    <link rel="stylesheet" type="text/css" href="../../css/style_settings.css">
    </head>
<div class="header_settings">
</a>
</div>
<div class="tab">
  <button class="tablinks" onclick="openCart(event, 'Тема')">Тема</button>
  <button class="tablinks" onclick="openCart(event, 'Кнопки')">Кнопки</button>
</div>
<div id="Тема" class="tabcontent">
<div class="links">
<form action="color.php" name="bg" method="post">
<table>
<tr>
    <th>Цвет фона: </th>
    <th><input name="bg" type="color" value="<?=$bg_color?>"><br></th>
</tr>
<tr>
    <th>Цвета текста:</th>
    <th><input name="txtColor" type="color" value="<?=$text_color?>"><br></th>
</tr>
<tr>
    <th>Цвет кнопок:</th>
    <th><input name="btn_color" type="color" value="<?=$btn_color?>"><br></th>
</tr>
</table>
    <button>Применить</button>
    </form>
        </div>
</div>
<div id="Кнопки" class="tabcontent">
<h3>Добавление кнопок:</h3>
<form action="addbutton.php?id=<?=$id_user?>" method="post" >
    <input required name="button" type="text" placeholder="Название кнопки">
    <input required type="text" name="url" placeholder="URL кнопки"><br>
    <br>
    <button>Добавить</button>
</form>
            </div>
            </div>
                <div class="rmenu">
                <iframe name="task" src="../../Taskmanager/Task.php">
                    </iframe>
                    
</div>
                    
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
<script>
  function openCart(evt, settingsName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(settingsName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>