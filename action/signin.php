<?php
session_start();
 require_once 'connect.php';
$login=$_POST['login'];
$password=$_POST['password'];
$check_admin = mysqli_query($connect, "SELECT * FROM `users` WHERE `name`='$login' AND `password` = '$password' ");
$check_user = mysqli_query($connect, "SELECT * FROM `personal` WHERE `mail`='$login' AND `password` = '$password' ");

echo "Логин-".$login."<br>"." Пароль-".$password;

if(mysqli_num_rows($check_admin)>0)
{
    $user = mysqli_fetch_assoc($check_admin);

    $_SESSION['user'] = 
    [
        "id"=>$user['id'],
        "login"=>$user['name'],
        "avatar"=>$user['avatar'],
        "role"=>$user['role'],
        "status"=>$user['status']
    ];
   header('Location: ../index_admin.php');
}
else{     if(mysqli_num_rows($check_user)>0)
    {
        $user = mysqli_fetch_assoc($check_user);
     $_SESSION['user'] =
    [
        "id"=>$user['id'],
        "name"=>$user['name'],
        "status"=>$user['status']
    ];

     header('Location: ../index.php');
    echo "User";
    echo ($_SESSION['user']['status']);
}
else{
    $_SESSION['sms']='Не верный <br> логин или пароль';
    header('Location: autorization.php');
}
}
?>