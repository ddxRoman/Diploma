<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
    </head>

<style>
    img.user_photo{
        width: 50px;
        height: 70px;
    }
</style>


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
$id_user=$_SESSION['user']['mail'];

if($type==1936){      
    $user=$_SESSION['user']['name'];

?>
    <body>
    <div class="full">
        <div class="date"> <a href="../action/profile2.php?mail=<?=$id_user?>" target="_Blank"><?= $user ?></a>
        <font  class="post" color="4C4F6B"><b><?= $_SESSION['user']['post'] ?></b></font><br>
    </div>
    <div class="Ava"><a href="../action/profile2.php?mail=<?=$id_user?>" target="_Blank"><img width="50px" class="user_photo" src="<?= $_SESSION['user']['photo'] ?>"></a>
    <a class="exit" href="/action/logout.php"><button>Выйти</button></a>
</div>
    </div>
</body>

<?
} else {
$user=$_SESSION['user']['login']; 

?> 
    <body>
        <div class="full">
            <div class="date"> <a href="../action/profile2.php?mail=<?=$id_user?>" target="_Blank"><?= $user ?></a>
            <font color="4C4F6B"><b><?= $_SESSION['user']['role'] ?></b></font><br>
        </div>
        <div class="Ava"><a href="../action/profile2.php?mail=<?=$id_user?>" target="_Blank"><img src="<?= $_SESSION['user']['avatar'] ?>" width="100%"></a>
        <a class="exit" href="/action/logout.php"><button>Выйти</button></a>
    </div>
        </div>
    </body>
<?}?>
    </html>
