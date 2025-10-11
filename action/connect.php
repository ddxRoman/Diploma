<?php
error_reporting(E_ERROR | E_PARSE);
$month = date('m')-1;
$connect = mysqli_connect('localhost', 'user','qazwsx','diploma');
// $connect = mysqli_connect('localhost', 'ddx','Beetle19','diploma');
if(!$connect){
    ?>  
   <style>
        .header{
            border: 2px solid  rgb(247, 0, 0);
        }
    </style><? 
}
else{ ?>

<style>
.header{
    border: 2px solid  rgb(57, 182, 67);
        }
        </style>
        
<?  }
$sites_categorie = mysqli_query($connect, "SELECT * FROM `sites_categories` ORDER BY `sequence_number` ASC"); // Подключение к определенной таблице, и получение Статуса записи
$sites_categorie = mysqli_fetch_all($sites_categorie); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$site = mysqli_query($connect, "SELECT * FROM `sites` ORDER BY `id` DESC"); // Подключение к определенной таблице, и получение Статуса записи
$site = mysqli_fetch_all($site); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$helper_log = mysqli_query($connect, "SELECT * FROM `helper_log` ORDER BY `date` DESC"); // Подключение к определенной таблице, и получение Статуса записи
$helper_log = mysqli_fetch_all($helper_log); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$finance = mysqli_query($connect, "SELECT * FROM `expenses` ORDER BY `date` DESC"); // Подключение к определенной таблице, и получение Статуса записи
$finance = mysqli_fetch_all($finance); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$finance_total = mysqli_query($connect, "SELECT DISTINCT YEAR(date) FROM `expenses` "); // Подключение к определенной таблице, и получение Статуса записи
$finance_total = mysqli_fetch_all($finance_total); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$desc_finance = mysqli_query($connect, "SELECT * FROM `expenses` ORDER BY `coast` DESC"); // Подключение к определенной таблице, и получение Статуса записи
$desc_finance = mysqli_fetch_all($desc_finance); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$budget = mysqli_query($connect, "SELECT * FROM `budget` ORDER BY `date` DESC"); // Подключение к определенной таблице, и получение Статуса записи
$budget = mysqli_fetch_all($budget); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$filter = mysqli_query($connect, "SELECT * FROM `expenses` ORDER BY `payer` DESC"); // Подключение к определенной таблице, и получение Статуса записи
$filter = mysqli_fetch_all($filter); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$tracking = mysqli_query($connect, "SELECT * FROM `tracking` ORDER BY `date` DESC"); // Подключение к определенной таблице, и получение Статуса записи
$tracking = mysqli_fetch_all($tracking); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$ventra = mysqli_query($connect, "SELECT * FROM `ventra_home` ORDER BY `street` ASC"); // Подключение к определенной таблице, и получение Статуса записи
$ventra = mysqli_fetch_all($ventra); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$ventra_note = mysqli_query($connect, "SELECT * FROM `ventra_home_notefication` ORDER BY `id` ASC"); // Подключение к определенной таблице, и получение Статуса записи
$ventra_note = mysqli_fetch_all($ventra_note); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$ventra_street = mysqli_query($connect, "SELECT DISTINCT street, street FROM `ventra_home` ORDER BY `street` ASC"); // Подключение к определенной таблице, и получение Статуса записи
$ventra_street = mysqli_fetch_all($ventra_street); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

$ventra_builds_comment = mysqli_query($connect, "SELECT * FROM `ventra_builds_comment` ORDER BY `date` DESC"); // Подключение к определенной таблице, и получение Статуса записи
$ventra_builds_comment = mysqli_fetch_all($ventra_builds_comment); // Выбирает все строки из набора $Comment и помещает их в массив  $Comments

?>