<?php
$JIRA=$_POST['ticketJira'];

if ($JIRA=="" || $JIRA==0){
    header('Location: https://medcloud.csd.com.ua/');
} else if($JIRA>0){
    header('Location: https://jira.csd.com.ua/browse/MEDRWK-'.$JIRA);
} else     header('Location: https://jira.csd.com.ua/browse/MEDSUP'.$JIRA);
?>