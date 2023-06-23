<?php
session_start();
 require_once 'connect.php';
$login=$_POST['login'];
$password=$_POST['password'];
$check_admin = mysqli_query($connect, "SELECT * FROM `users` WHERE `email`='$login' AND `password` = '$password' ");
$check_user = mysqli_query($connect, "SELECT * FROM `personal` WHERE `mail`='$login' AND `password` = '$password' ");

if(mysqli_num_rows($check_admin)>0) 
{
    $user = mysqli_fetch_assoc($check_admin);

    $_SESSION['user'] = 
    [
        "id"=>$user['id'],
        "login"=>$user['name'],
        "mail"=>$user['email'],
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
        "mail"=>$user['mail'],
        "status"=>$user['status'],
        "photo"=>$user['photo'],
        "post"=>$user['post']
    ];
      header('Location: ../index.php');
}
else{
    function getIp() {
        $keys = [
          'HTTP_CLIENT_IP',
          'HTTP_X_FORWARDED_FOR',
          'REMOTE_ADDR'
        ];
        foreach ($keys as $key) {
          if (!empty($_SERVER[$key])) {
            $ip = trim(end(explode(',', $_SERVER[$key])));
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
              return $ip;
            }
          }
        }
      }
      $ip = getIp();
    mysqli_query($connect, "INSERT INTO `log` (`id`, `err`, `login`, `password`, `ip`)
    VALUES (NULL, 'Попытка авторизации', '$login','$password', '$ip')");
    $_SESSION['sms']='Не верный <br> логин или пароль';
    header('Location: autorization.php');

}
}
?>