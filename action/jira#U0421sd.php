<?php
require_once 'connect.php';
$JIRA=$_POST['ticketJira'];

if ($JIRA=="" || $JIRA==0){
    header('Location: https://medcloud.csd.com.ua/');
} else if($JIRA>0){
    $name = 'MEDRWK-'.$JIRA;
    $link = 'https://jira.csd.com.ua/browse/MEDRWK-'.$JIRA;
    mysqli_query($connect, "INSERT INTO `helper_log` (`id`, `name`, `link`, `date`) VALUES (NULL, '$name', '$link', NOW());");
    header('Location: '.$link);

} else  if($JIRA<0){  
$name = 'MEDSUP'.$JIRA;
$link = 'https://jira.csd.com.ua/browse/MEDSUP'.$JIRA;
mysqli_query($connect, "INSERT INTO `helper_log` (`id`, `name`, `link`, `date`) VALUES (NULL, '$name', '$link', NOW());");
header('Location: '.$link);
}
?>