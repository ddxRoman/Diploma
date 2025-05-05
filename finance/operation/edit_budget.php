<?php
require_once '../../action/connect.php';
$id=$_POST['id'];
$date=$_POST['date'];
$name=$_POST['name'];
$summa=$_POST['summa'];


mysqli_query($connect, "UPDATE `budget` SET  `date` = '$date', `payer` = '$name', `summ`= '$summa' WHERE `id` = '$id'");
header('Location: ../details/techical/all_budget.php');

?>