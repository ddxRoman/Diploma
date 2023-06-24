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
    <th>Select  background: </th>
    <th><input name="bg" type="color" value="<?=$bg_color?>"><br></th>
</tr>
<tr>
    <th>Select text color:</th>
    <th><input name="txtColor" type="color" value="<?=$text_color?>"><br></th>
</tr>
<tr>
    <th>Select button color:</th>
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