<?php
session_start();
require_once '../connect.php'; // Проверка подключения к БД
$id_user= $_SESSION['user']['id'];
$setting = mysqli_query($connect, "SELECT*FROM `settings_users` WHERE `id_user`='$id_user'"); 
$setting = mysqli_fetch_assoc($setting);
$bg_color=$setting['background'];
$text_color=$setting['text_color'];
$btn_color=$setting['btn_color'];

?>
<div class="header_settings">
    <a href="../../index_admin.php">
    <button>На главную</button>
</a>
</div>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Тема')">Тема</button>
  <button class="tablinks" onclick="openCity(event, 'Кнопки')">Кнопки</button>
  <button class="tablinks" onclick="openCity(event, 'Профиль')">Профиль</button>
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
    <!-- 2. <input name="button2"  type="text" placeholder="Название кнопки">
    <input  type="url" name="url2" placeholder="URL кнопки"><br>
    3. <input name="button3"  type="text" placeholder="Название кнопки">
    <input  type="url" name="url3" placeholder="URL кнопки"><br>
    4. <input name="button4"  type="text" placeholder="Название кнопки">
    <input  type="url" name="url4" placeholder="URL кнопки"><br>
    5. <input name="button5"  type="text" placeholder="Название кнопки">
    <input  type="url" name="url5" placeholder="URL кнопки"><br> -->
    <br>
    <button>Добавить</button>
</form>
</div>

<div id="Профиль" class="tabcontent">

</div>

<style>
    input{
        margin-top: 5px;
    }
  .tab {
    overflow: hidden;
    border: 1px solid #4CAF50;
    background-color: #C8E6C9;
}

.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
}

.tab button:hover {
    background-color: #FFEB3B;
}

.tab button.active {
    background-color: #4CAF50;
	color: #fff;
}

.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #599735;    
    border-top: none;
}
.header_settings{
    display: grid;
  justify-content: end;

}
body{
    background-color: #999999;
}
</style>

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