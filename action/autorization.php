<?php
require_once '../action/connect.php';
session_start();
if($_SESSION['user']) header('Location: ../index.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <style>
body{
  background: linear-gradient(90deg, blue, pink);
}
</style>
    <div class="allAutorize">

    <div class="autorize">
    <a href="https://github.com/ddxRoman"><img src="../file/icons/Logo.png" alt="Logo" title="ORStudio"></a>
    <form action="/action/signin.php" method="post">
    <input required type="text" name="login" placeholder="Логин"><br>
    <input required type="password" name="password" placeholder="Пароль"><br>
<button type="submit">Get to work</button>
</form>

<div class="message">
<p class="sms"> <?echo $_SESSION['sms']; ?> </p> 
</div>
<?
unset($_SESSION['sms']);
?>
</div>
</div>
</body>
</html>