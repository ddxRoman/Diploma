<?php
session_start();
$status= $_SESSION['user']['status'];
if($status==9){
$role=1;
}
else {
    $role=2;
}
?>