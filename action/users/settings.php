<?php

session_start();
        require_once '../connect.php'; // Проверка подключения к БД
        $id_user= $_SESSION['user']['id'];
        $setting = mysqli_query($connect, "SELECT*FROM `settings_users` WHERE `id_user`='$id_user'"); 
        $setting = mysqli_fetch_assoc($setting);
        $bg_color=$setting['background'];
        $text_color=$setting['text_color'];
echo "Только зашел на страницу, сразу получил то что есть - ".$bg_color;
?>

<style>
body{
    background-color: <?=$bg_color?>;
    color: <?=$text_color?>;
}
button{
    color: <?=$text_color?>;
}
</style>
<div class="links">
                <form action="color.php" name="bg" method="post">
                <table>
<tr>
    <th>Select  background: </th>
    <th><input name="bg" type="color" value="<?=$bg_color?>"><br></th>
</tr>
<tr>
    <th>Select text color:</th>
    <th><input name="txtColor" type="Color" value="<?=$text_color?>"><br></th>
</tr></table>
    <button>Применить</button>
    </form>
    <a href="../../index_admin.php">
    <button>На главную</button>
</a>
        </div>


