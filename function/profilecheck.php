<?php 
session_start();
if(!$_SESSION['user']){header ('Location: action/autorization.php');}
$status= $_SESSION['user']['status'];
if($status==1936){$role=1;}
else {    $role=2;}
?>