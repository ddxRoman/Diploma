<?php
session_start();
$status= $_SESSION['user']['status'];
if($_SESSION['user']['status']==9||['user']['status']==1){
$role=1;
}
else {
    header ('Location: Second_site/index_second.php');
}
?>