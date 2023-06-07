<?php 
$id_user= $_SESSION['user']['id'];
$type= $_SESSION['personal']['status'];
$setting = mysqli_query($connect, "SELECT*FROM `settings_users` WHERE `id_user`='$id_user'"); 
$setting = mysqli_fetch_assoc($setting);
$bg_color=$setting['background'];
$text_color=$setting['text_color'];
$btn_color=$setting['btn_color'];
?>

<style>
body{
    background-color: <?=$bg_color?>;
    color: <?=$text_color?>;
}
button{
    background-color: <?=$btn_color?>;
    color: <?=$text_color?>;
}
</style>