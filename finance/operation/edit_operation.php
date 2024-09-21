<?php
require_once '../../action/connect.php';
$id=$_POST['id'];
$date=$_POST['date'];
$category=$_POST['category'];
$purchase=$_POST['purchase'];
$coast=$_POST['coast'];
$payer=$_POST['payer'];


// echo $date. '<br>' .$category. '<br>' .$purchase. '<br>' .$coast. '<br>' .$payer; 

mysqli_query($connect, "UPDATE `expenses` SET  `date` = '$date', `category` = '$category', `purchase`= '$purchase', `coast`= '$coast', `payer`= '$payer' WHERE `id` = '$id'");
header('Location: ../finance.php');

?>