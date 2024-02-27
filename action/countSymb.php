<?php
session_start();
$text=$_POST['text'];
$text = str_replace(array("\r","\n"), '', $text); 
$_SESSION['txt'] = mb_strlen(str_replace(' ', '', $text));
$_SESSION['text']=$text;
$_SESSION['textfull'] =  mb_strlen($text);
$text = mb_strlen(str_replace(' ', '', $text))."<br>";
$text = iconv_strlen(str_replace(' ', '', $text));
header('Location: ../folders/countsymbolForm.php');
?>