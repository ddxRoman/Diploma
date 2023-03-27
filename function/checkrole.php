<?php
session_start();
$status= $_SESSION['user']['status'];
if($_SESSION['user']['status']==9){
$role=1;
}
else {
    $role=2;
}
?>