<?php
require_once '../../../action/connect.php'; 
$category1='По убыванию';

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
$i=0;
$monthget=$_GET['month'];
// $pet_type=$_GET['pet'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/finance/finance-style.css">
</head>
<body>
    <a href="../../operation/reports.php">
        <h1><?=$category1?></h1>
    </a>
    <div class="month_line">
        <ul class="month_ul_reports">
        <?

        foreach($month_list as $month_lists) { 
            $key = array_search ($month_lists, $month_list);
if (($monthget==$key) || (date('m')==$key && $i==0 && $monthget<date('m'))){ 
    $i=1;
    ?>
    <a class="current_month_reports" onchange="this.form.submit()" href="desc_order_reports.php?month=<?=$key?>"><li><?=$month_lists?></li></a> <?
    }else{ 
    ?><a onchange="this.form.submit()" href="desc_order_reports.php?month=<?=$key?>"><li><?=$month_lists?></li></a><?
}
            }?>
        </ul>

    </div>
    <!-- <div class="pet_type">
        <ul>
            <a href="pet_reports.php?pet=cat" onchange="this.form.submit()"><li>Кошка</li></a>
            <a href="pet_reports.php?pet=dog" onchange="this.form.submit()"><li>Собака</li></a>
        </ul>
    </div> -->
<table class="table table-hover">
                        <tr>
                            <th>Дата</th>
                            <th>Категория</th>
                            <th>Транзакция</th>
                            <th>Сумма</th>
                            <th>Плательщик</th>
                        </tr>
                        <?
                        $total=0;
                        $total_Lera=0;
                        $total_Roma=0;

                        foreach($desc_finance as $desc_finances ){
                            if ($monthget == ""){
                                list($year, $month, $day) = explode('-', $desc_finances[1]); // Если формат "день-месяц-год" 
                            if (($month == date('m') && $year == date('Y'))) {
                        ?>
                                <tr>
                                    <td><a href="../date.php?id=<?= $desc_finances[1] ?>" target="details">
                                            <?= $desc_finances[1]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../category.php?id=<?= $desc_finances[2] ?>" target="details">
                                            <?= $desc_finances[2]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../purchase.php?id=<?= $desc_finances[3] ?>" title="<?= $desc_finances[3]; ?>" target="details">
                                            <?= $desc_finances[3]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../coast.php?id=<?= $desc_finances[4] ?>" target="details">
                                            <?= $desc_finances[4]; ?> руб.
                                        </a>
                                    </td>
                                    <td><a href="../payer.php?id=<?= $desc_finances[5] ?>" target="details">
                                            <?= $desc_finances[5]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../hashtag.php?id=<?= $desc_finances[6] ?>" target="details">
                                            <?= $desc_finances[6]; ?>
                                        </a>
                                    </td>
                                </tr>
                        <?
                                $total = $total + $desc_finances[4];
                                if($desc_finances[5]=="Рома") {$total_Roma=$total_Roma+$desc_finances[4]; }
if($desc_finances[5]=='Лера') {$total_Lera=$total_Lera+$desc_finances[4]; }
if($desc_finances[5]=='Общее') {$total_Common=$total_Common+$desc_finances[4]; }
if($desc_finances[2]=='Собака') {$total_Roma=$total_Roma+$desc_finances[4]; }
if($desc_finances[2]=='Кошка') {$total_Lera=$total_Lera+$desc_finances[4]; }
                            }

                        }
                        

                        else {


                                list($year, $month, $day) = explode('-', $desc_finances[1]); // Если формат "день-месяц-год" 
                            if (($month == $monthget && $year == date('Y'))) {

                        ?>
                                <tr>

                                    <td><a href="../date.php?id=<?= $desc_finances[1] ?>" target="details">
                                            <?= $desc_finances[1]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../category.php?id=<?= $desc_finances[2] ?>" target="details">
                                            <?= $desc_finances[2]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../purchase.php?id=<?= $desc_finances[3] ?>" title="<?= $desc_finances[3]; ?>" target="details">
                                            <?= $desc_finances[3]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../coast.php?id=<?= $desc_finances[4] ?>" target="details">
                                            <?= $desc_finances[4]; ?> руб.
                                        </a>
                                    </td>
                                    <td><a href="../payer.php?id=<?= $desc_finances[5] ?>" target="details">
                                            <?= $desc_finances[5]; ?>
                                        </a>
                                    </td>
                                    <td><a href="../hashtag.php?id=<?= $desc_finances[6] ?>" target="details">
                                            <?= $desc_finances[6]; ?>
                                        </a>
                                    </td>
                                </tr>
                        <?
                                $total = $total + $desc_finances[4];
                                if($desc_finances[5]=="Рома") {$total_Roma=$total_Roma+$desc_finances[4]; }
if($desc_finances[5]=='Лера') {$total_Lera=$total_Lera+$desc_finances[4]; }

                            
                        }



                        

                    }

}                       echo "<b>Лера</b> -".$total_Lera."<br> <b>Рома</b> - ".$total_Roma;
?>     
                      
                      <tfoot class="footer_total_line_table">
                        <tr>
                            <td colspan="4" style="text-align:right">ИТОГО:</td>
                            <td>
                                <p class="total_table">
                                    <?=$total?> Руб
                                </p>
                            </td>
                        </tr>
                        
  </tfoot>
                    </table>  
</body>
</html>