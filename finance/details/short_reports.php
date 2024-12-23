<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/finance/finance-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Отчёт</title>
</head>
<body>
    

<?
require_once '../../action/connect.php';
$mount_today = date("m");
$total_food=0;
$total_common=0;
$total_other=0;
$total_dog=0;
$total_entertainment=0;
$total_smoke=0;
$total_cat=0;
$total_private=0;
$total_health=0;
$month_list = array(
    "1" => "Январь",
    "2" => "Февраль",
    "3" => "Март",
    "4" => "Апрель",
    "5" => "Май",
    "6" => "Июнь",
    "7" => "Июль",
    "8" => "Август",
    "9" => "Сентябрь",
    "10" => "Октябрь",
    "11" => "Ноябрь",
    "12" => "Декабрь",
);

foreach($finance as $finances){ 
    list($year, $month, $day) = explode('-', $finances[1]); // Если формат "день-месяц-год" 
        if($mount_today==$month){
        if($finances[2]=="Продукты")    $total_food=$total_food+$finances[4];
        if($finances[2]=="Общие расходы")    $total_common=$total_common+$finances[4];
        if($finances[2]=="Бытовые расходы")    $total_other=$total_other+$finances[4];
        if($finances[2]=="Собака")      $total_dog=$total_dog+$finances[4];
        if($finances[2]=="Развлечения")    $total_entertainment=$total_entertainment+$finances[4];
        if($finances[2]=="Сигареты")    $total_smoke=$total_smoke+$finances[4];
        if($finances[2]=="Кошка")    $total_cat=$total_cat+$finances[4];
        if($finances[2]=="Личное")    $total_private=$total_private+$finances[4];
        if($finances[2]=="Здоровье")    $total_health=$total_health+$finances[4];
    }
    
}
?>



<h2><a href="../finance.php" target="_blank">Главная</a></h2>
<div class="row">


        <div class="col-8 block_smeta">
        <ul>
    <li><b> <a href="category.php?id=Продукты" title="Продукты" target="details">Продукты</a></b>    - <?=$total_food?> руб.</li>
    <li><b> <a href="category.php?id=Общие расходы" title="Общие" target="details">Общие расходы</a></b>    - <?=$total_common?> руб.</li>
    <li><b> <a href="category.php?id=Бытовые расходы" title="Бытовые" target="details">Бытовые расходы</a></b>    - <?=$total_other?> руб.</li>
    <li><b> <a href="category.php?id=Собака" title="Собака" target="details">Собака</a></b>    - <?=$total_dog?> руб.</li>
    <li><b> <a href="category.php?id=Развлечения" title="Развлечения" target="details">Развлечения</a></b>    - <?=$total_entertainment?> руб.</li>
    <li><b> <a href="category.php?id=Сигареты" title="Сигареты" target="details">Сигареты</a></b>    - <?=$total_smoke?> руб.</li>
    <li><b> <a href="category.php?id=Кошка" title="Кошка" target="details">Кошка</a></b>    - <?=$total_cat?> руб.</li>
    <li><b> <a href="category.php?id=Личное" title="Личное" target="details"> Личное</a></b>    - <?=$total_private?> руб.</li>
    <li><b> <a href="category.php?id=Здоровье" title="Здоровье" target="details"> Здоровье</a></b>    - <?=$total_health?> руб.</li>
</ul>
        </div>
        <div class="col-4 block_smeta">
<ul>
    <li><b>Продукты</b> - <?=$total_food?> руб.</li>
    <li><b>Животные</b> - <?=$total_cat+$total_dog?> руб.</li>


</ul>
    </div>

        </div>

</body>
</html>