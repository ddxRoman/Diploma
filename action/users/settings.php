<?php
session_start();
require_once '../connect.php'; // Проверка подключения к БД
require_once 'StyleAndSettings.php'; // Проверка подключения к БД
$id_user= $_SESSION['user']['id'];
$setting = mysqli_query($connect, "SELECT*FROM `settings_users` WHERE `id_user`='$id_user'"); 
$setting = mysqli_fetch_assoc($setting);
$bg_color=$setting['background'];
$text_color=$setting['text_color'];
$btn_color=$setting['btn_color'];

?><head>

        <link rel="stylesheet" href="../../css/fontello.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/style_settings.css">
    </head>
    <style>
        .lmenu button{
            min-width: 150px;
            margin-top: 0.5%;
        }
    </style>
    <body>
<div class="header_settings">
    <a href="../../index_admin.php">
    <a href="../../index.php"><button class="btn-return btn btn-primary btn-lg">На главную</button></a> 
</a>
</div>

<div class=" text-center justify-align-center align-center">
  <button class="btn btn-secondary" data-toggle="button" autocomplete="off" onclick="openCity(event, 'Тема')">Тема</button>
  <button class="btn btn-secondary" data-toggle="button" autocomplete="off" onclick="openCity(event, 'Кнопки')">Кнопки</button>
  <button class="btn btn-secondary" data-toggle="button" autocomplete="off" onclick="openCity(event, 'Шрифты')">Шрифты</button>

</div>

<div id="Тема" class="tabcontent text-center">

                
<form action="color.php" name="bg" method="post">
                <table>
<tr>
    <th>Выберете фоновый цвет: </th>
    <th><input name="bg" type="color" value="<?=$bg_color?>"><br></th>
</tr>
<tr>
    <th>Выберете цвет текста:</th>
    <th><input name="txtColor" type="color" value="<?=$text_color?>"><br></th>
</tr>
<tr>
    <th>Выберете цвет кнопок:</th>
    <th><input name="btn_color" type="color" value="<?=$btn_color?>"><br></th>
</tr>
</table>
    <button class="btn btn-success">Применить</button>
    </form>
</div>

<div id="Кнопки" class="tabcontent text-center">

<h3>Добавление кнопок:</h3>
<form action="addbutton.php?id=<?=$id_user?>" method="post" >
    <input required name="button" type="text" placeholder="Название кнопки">
    <input required type="text" name="url" placeholder="URL кнопки"><br>
    <br>
    <button class="btn btn-success">Добавить</button>
</form>
</div>
<script>
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
<div id="Шрифты" class="tabcontent text-center">

<h3>Настройки шрифта</h3>
Тут пока ничего нет
</div>

<script src="../../js/bootstrap.bundle.min.js"></script>

<!-- <iframe src="../../index.php" class="settings_frame" frameborder="0"></iframe> -->
<div class="settings_preview">
<?require_once "StyleAndSettings.php";?>
<div class="lmenu"> 
            <? 
             foreach($sites_categorie as $sites_categories){
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
           } ?>
             </div>
</div>

</body>
<footer class="footer-fluid text-center">
        <h4>
        Bootstrap
    </h4>
    </footer>