<?php
session_start();
?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/button.css">
    </head>
<body>
<?php $accaunt=$_SESSION['user']['login']?>
    <div class="header_no_rules">
<p class="No_rules_plz_autorization"> 
 <?php echo("Ваш аккаунт")?> <a href="profile2.php"><?php echo($accaunt)?></a> <?php echo(" не имеет доступа к этой странице.<br><br>Выберете что делать дальше:")?>
</p>
</div>
<hr class="misPanel-hr" width="85%">
<div class="no_rules_choice">
    <div>

    </div>
    <div>
    <a href="../index.php"><button class="no_rules">На главную</button></a>

</div>
<div class="relogin">
<a href="logout.php"><button class="no_rules">Сменить аккаунт</button></a>
</div>
<div>

</div>
</div>
<div class="no_rules_pictures">
    <img src="../file/icons/Block.png">
</div>
</body>

</html>