

<?php
require_once '../connect.php';

$id_user=$_GET['id'];
$btn=$_POST['button'];
$url=$_POST['url'];
$http="http://";
$https="https://";

echo "URL - ".$url;

if (strpos($url, $https) !== false) {
mysqli_query($connect, "INSERT INTO `button_user` (`id`, `user_id`, `button`, `url`) 
VALUES (NULL, '$id_user', '$btn', '$url')");
//  header ('Location: ../../index.php');
echo"Протокол изначально был";
}else{ if (strpos($url, $http) !== false) {

    mysqli_query($connect, "INSERT INTO `button_user` (`id`, `user_id`, `button`, `url`) 
    VALUES (NULL, '$id_user', '$btn', '$url')");
echo"Протокол изначально был";

}else{
    $url='https://'.$url;
    mysqli_query($connect, "INSERT INTO `button_user` (`id`, `user_id`, `button`, `url`) 
    VALUES (NULL, '$id_user', '$btn', '$url')");
    echo"Добавлен протокол";
}
}
?>
