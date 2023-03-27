<?php
session_start();

if(!$_SESSION['user']){
    header('Location: autorization.php');
}else {
    header('Location: profile.php');
}
?>

<a href="/test/logout.php"><button>Exit</button></a> 
