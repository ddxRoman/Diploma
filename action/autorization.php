<?php
// require_once '../action/connect.php';
session_start();
// if($_SESSION['user']) header('Location: ../index.php')
// ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styleauth.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORS</title>
</head>

<body>
    <section>
        <div class="container-fluid">
            <div style="min-height: 99vh" class="row align-items-center">
                <div class="col-lg-4 col-md-4 col-sm-1 text-center align-items-center">
                <h2>Bootstrap</h2>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-10 text-center align-items-center">


<!--- ФОТКУ НАДО ЗАМЕИТЬ-->
                <a href="https://github.com/ddxRoman"><img src="../file/icons/Logo/Logo192.png"  alt="Logo" title="ORStudio"></a>
    <form action="/action/signin.php" method="post">
    <input class="input-fluid" required type="text" name="login" placeholder="Логин"><br>
    <input class="input-fluid" required type="password" name="password" placeholder="Пароль"><br>
<button type="submit" >Get to work</button>
</form>

<div class="message">
<p class="sms"> <?echo $_SESSION['sms']; ?> </p> 
</div>
<?
unset($_SESSION['sms']);
?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-1 text-center align-items-center"></div>
            </div>
        </div>
        <footer></footer>
    </section>

</body>

</html>