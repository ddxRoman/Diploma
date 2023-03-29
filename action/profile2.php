<?php
require_once 'connect.php';
$name_user = $_GET['id'];
$user = mysqli_query($connect, "SELECT*FROM `users` WHERE `name`='$name_user'");
$user = mysqli_fetch_assoc($user);
$avatar = $user['avatar'];
$NickName = $user['name'];
$mail = $user['email']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
<style>
body{
  background: linear-gradient(90deg, blue, pink);
}
</style>
    <div class="profile">
    <div class="full_profile_page">
    <div class="Ava_profile_page"><img class="" src="<?=$avatar?>">
<a href="settings.php"><button class="GoWork"><img class="logo_settings" src="../file/icons/settings.png"></button></a>
    <div class="date_profile_page">  <?=$NickName;?><br>
    <font color="AAFF6B"><b><?=$mail;?></b></font>  <br><br></div>  
    <div><a href="../index.php"><button class="GoWork">За работу</button></a>
    </div>
    </div>
    </div>
    </div>
</body>
</html>
