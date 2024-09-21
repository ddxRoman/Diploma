<?php
require_once '../../action/connect.php';
$date=$_POST['date'];
$category=$_POST['category'];
$purchase=$_POST['purchase'];
$coast=$_POST['coast'];
$payer=$_POST['payer'];

if($category=='Сигареты'){
    $purchase='Сигареты';
}
echo $date. '<br>' .$category. '<br>' .$purchase. '<br>' .$coast. '<br>' .$payer; 

mysqli_query($connect, "INSERT INTO `expenses` (`id`, `date`, `category`, `purchase`, `coast`, `payer`, `time_stamp`) VALUES (NULL, '$date', '$category', '$purchase', '$coast', '$payer', now());");
header('Location: ../finance.php');

?>