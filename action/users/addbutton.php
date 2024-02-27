

<?php
require_once '../connect.php';

$id_user=$_GET['id'];
$btn=$_POST['button'];
$url=$_POST['url'];

mysqli_query($connect, "INSERT INTO `button_user` (`id`, `user_id`, `button`, `url`) 
VALUES (NULL, '$id_user', '$btn', '$url')");
 header ('Location: ../../index.php');

?>
