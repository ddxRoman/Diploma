<?
require_once 'connect.php';
$date = $_POST['date'];
$time = $_POST['time'];
$type = $_POST['type'];
$project = $_POST['project'];

// echo $date." --".$time." --".$type." --".$project;

mysqli_query($connect, "INSERT INTO `tracking` (`id`, `date`, `time`, `type`, `project`)
        VALUES (NULL, '$date', '$time', '$type','$project' )");
 header ('Location: ../folders/tracking.php');
?>