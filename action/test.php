<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Пробуем 127.0.0.1:3306... ";
$c1 = @mysqli_connect('MySQL-8.4', 'root', '', '', 3306);
echo $c1 ? "ОК<br>" : "Ошибка: " . mysqli_connect_error() . "<br>";

echo "Пробуем localhost... ";
$c2 = @mysqli_connect('localhost', 'root', '', '', 3306);
echo $c2 ? "ОК<br>" : "Ошибка: " . mysqli_connect_error() . "<br>";