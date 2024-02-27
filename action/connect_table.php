<?
session_start();
// require_once '../action/connect.php';
$sites_categorie = mysqli_query($connect, "SELECT * FROM `sites_categories` ORDER BY `sequence_number` ASC"); // Подключение к определенной таблице, и получение Статуса записи
$sites_categorie = mysqli_fetch_all($sites_categorie); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments
?>