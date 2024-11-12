<?
require_once '../../action/connect.php';
$date=$_POST['date_pay'];
$summa=$_POST['summa'];
$contributor=$_POST['contributor'];

echo"TYT". $date."<br>".$contributor."<br>".$summa;

mysqli_query($connect, "INSERT INTO `budget` (`id`, `date`, `summ`, `payer`, `time_stamp`) VALUES (NULL, '$date', '$summa', '$contributor', now());");
header('Location: ../finance.php');

?>