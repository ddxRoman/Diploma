<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/profile.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
    </head>
<?php
session_start();

$status= $_SESSION['user']['status'];
if($status==9){
$role=1;
}
else {
    $role=2;
}

$type = $_SESSION['user']['status'];


if($type==1936){      
    $user=$_SESSION['user']['name'];
?>
    <body>
    <div class="full">
        <div class="date"> <a href="action/profile2.php?id=<?=$user?>" target="_Blank"><?= $user ?></a>
        <font class="post" color="4C4F6B"><b><?= $_SESSION['user']['post'] ?></b></font><br>
            <a class="exit" href="/action/logout.php"><button>Выйти</button></a>
        </div>
        <div class="Ava"><a href="action/profile2.php?id=<?=$user?>" target="_Blank"><img src="<?= $_SESSION['user']['photo'] ?>" width="100%"></a></div>
    </div>
</body>

<?
} else {
$user=$_SESSION['user']['login']; 
?> 
    <body>
        <div class="full">
            <div class="date"> <a href="action/profile2.php?id=<?=$user?>" target="_Blank"><?= $user ?></a>
            <font color="4C4F6B"><b><?= $_SESSION['user']['role'] ?></b></font><br>
                <a class="exit" href="/action/logout.php"><button>Выйти</button></a>
            </div>
            <div class="Ava"><a href="action/profile2.php?id=<?=$user?>" target="_Blank"><img src="<?= $_SESSION['user']['avatar'] ?>" width="100%"></a></div>
        </div>
    </body>
<?}?>
    </html>
