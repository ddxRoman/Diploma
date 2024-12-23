<?php
require_once '../../action/connect.php';
$id=$_POST['id'];
$date=$_POST['date'];
$category=$_POST['category'];
$purchase=$_POST['purchase'];
$coast=$_POST['coast'];
$payer=$_POST['payer'];
$hashtag=$_POST['hashtag'];
$hashtag = strtolower($hashtag);


mysqli_query($connect, "UPDATE `expenses` SET  `date` = '$date', `category` = '$category', `purchase`= '$purchase', `coast`= '$coast', `payer`= '$payer', `hashtag`= '$hashtag' WHERE `id` = '$id'");
header('Location: ../finance.php');

?>