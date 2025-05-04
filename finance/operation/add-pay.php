<?php
session_start();
require_once '../../action/connect.php';
$date=$_POST['date'];
$_SESSION['last_date']=$date;
$_SESSION['last_payer']=$payer;
$category=$_POST['category'];
$coast=$_POST['coast'];
$payer=$_POST['payer'];
$hashtag=$_POST['hashtag'];
$hashtag = strtolower($hashtag);
$card = $_POST['card'];

if ($card=='on'){$card="Shared"; echo "YES";} 
else $card="Private";

if($category=='Сигареты' && $purchase=' '){
    if ($coast=='') $coast='165';
    $purchase='Сигареты';
} else if($category=='Продукты' && $purchase=''){
    $purchase='Пятёрочка';
}else{
$purchase=$_POST['purchase'];}
echo $date. '<br>' .$category. '<br>' .$purchase. '<br>' .$coast. '<br>' .$payer; 

mysqli_query($connect, "INSERT INTO `expenses` (`id`, `date`, `category`, `purchase`, `coast`, `payer`,`hashtag`, `card`, `time_stamp`) VALUES (NULL, '$date', '$category', '$purchase', '$coast', '$payer','$hashtag','$card', now());");
header('Location: ../finance.php');

?>