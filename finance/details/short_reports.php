<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/finance/finance-style.css">
    <title>Document</title>
</head>
<body>
    

<?
require_once '../../action/connect.php';
$mount_today = date("m");
$total1=0;
$total2=0;
$total3=0;
$total4=0;
$total5=0;
$total6=0;
$total7=0;
$total8=0;
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
        if($finances[2]=="Продукты")    $total1=$total1+$finances[4];
        if($finances[2]=="Общие расходы")    $total2=$total2+$finances[4];
        if($finances[2]=="Собака")      $total3=$total3+$finances[4];
        if($finances[2]=="Развлечения")    $total4=$total4+$finances[4];
        if($finances[2]=="Сигареты")    $total5=$total5+$finances[4];
        if($finances[2]=="Кошка")    $total6=$total6+$finances[4];
        if($finances[2]=="Личное")    $total7=$total7+$finances[4];
        if($finances[2]=="Здоровье")    $total8=$total8+$finances[4];
    }
    
}

?>


<div class="col-6 block_smeta">

        
<ul>
    <li><b><a href="category.php?id=Продукты" title="Продукты" target="details">Продукты</a></b>    - <?=$total1?></li>
    <li><b> <a href="category.php?id=Продукты" title="Продукты" target="details">Общие расходы</a></b>    - <?=$total2?></li>
    <li><b> <a href="category.php?id=Собака" title="Собака" target="details">Собака</a></b>    - <?=$total3?></li>
    <li><b> <a href="category.php?id=Развлечения" title="Развлечения" target="details">Развлечения</a></b>    - <?=$total4?></li>
    <li><b> <a href="category.php?id=Сигареты" title="Сигареты" target="details">Сигареты</a></b>    - <?=$total5?></li>
    <li><b> <a href="category.php?id=Кошка" title="Кошка" target="details">Кошка</a></b>    - <?=$total6?></li>
    <li><b><a href="category.php?id=Личное" title="Личное" target="details"> Личное</a></b>    - <?=$total7?></li>
    <li><b><a href="category.php?id=Здоровье" title="Здоровье" target="details"> Здоровье</a></b>    - <?=$total8?></li>
</ul>

</div>
</body>
</html>